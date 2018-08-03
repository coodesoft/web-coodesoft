<?php
class WpcSection{
  protected $data      = [
    'id' => '', 'class' => '', 'content' => '', 'page_id' => '',
    'widget_data' => [],
    'content_element_attr' => [
      //'tag'   => 'div',
      //'id'    => '',
      //'class' => '',
    ],
    'style' => [],
  ];

  protected $container = 'section';
  protected $isRow     = true;

  public function setIsRow($v){$this->isRow = $v;}

  public function __construct($data){
    $this->data = $data;

    if (isset($this->data['container']))
      $this->container = $this->data['container'];
  }

  public function printHTML(){
    $class = new $this->data['type_class']($this->data);
    $class->printHTML();
  }

  protected function printInitHTML(){
    if ($this->isRow) echo '<div class="row">';

    if ($this->container != ''){
      echo '<'.$this->container.' class="';
      if($this->data['class'] == '') echo 'col';
      echo ' '.$this->data['class'].'" id="'.$this->data['id'].'">';
    }

    //si se define que el contenido estara dentro de un elemnto
    if (isset($this->data['content_element_attr']['tag'])){
      echo '<'.$this->data['content_element_attr']['tag'].' class="'.$this->data['content_element_attr']['class'].'" id="'.$this->data['content_element_attr']['id'].'">';
    }

    // si se definio que antes del contenido va otro elemento como un titulo por ejemplo
    if (isset($this->data['beforeToContent'])){
      $class = new $this->data['beforeToContent']['type_class']($this->data['beforeToContent']);
      $class->printHTML();
    }
  }

  protected function printEndHTML(){
    // si se definio que antes del contenido va otro elemento como un titulo por ejemplo
    if (isset($this->data['AfterToContent'])){
      $class = new $this->data['AfterToContent']['type_class']($this->data['AfterToContent']);
      $class->printHTML();
    }

    if (isset($this->data['content_element_attr']['tag']))
      echo '</'.$this->data['content_element_attr']['tag'].'>';

    if ($this->container != '')
      echo '</'.$this->container.'>';

    if ($this->isRow)
      echo '</div>';
  }
}

class WpcSectionPage extends WpcSection{

  public function printHTML(){
    $this->printInitHTML();
    if ($this->data['page_id'] == '')
      echo 'Esta sección no tiene ninguna pagina asociada';
    else
      echo get_page($this->data['page_id'])->post_content;
    $this->printEndHTML();
  }
}

class WpcColsContainer extends WpcSection{

  public function printHTML(){
    $this->printInitHTML();
    foreach ($this->data['content'] as $cont) {
      // creamos una nueva instancia de seccion con el contenido de la columna
      $clase = new WpcSection($cont);
      $clase->setIsRow(false);
      $clase->printHTML();
    }
    $this->printEndHTML();
  }
}

class WpcWidgetContainer extends WpcSection{

  public function printHTML(){
    $this->printInitHTML();
    get_sidebar($this->data['widget_data']['id']);
    $this->printEndHTML();
  }
}

class WpcSectionMenu extends WpcSection{

  public function __construct($data){
    add_theme_support('nav-menus');

    if (function_exists('register_nav_menus'))
        register_nav_menus(['main' => $data['menu_options']['id']]);

    parent::__construct($data);
  }

  public function printHTML(){
    echo '<nav class="navbar navbar-toggleable-md ';echo $this->data['menu_options']['class']; echo '">
      <button class="navbar-toggler navbar-toggler-';echo $this->data['menu_options']['btn_align'];
    echo '" type="button" data-toggle="collapse" data-target="#'.$this->data['menu_options']['id'].'" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="'.$this->data['menu_options']['brand']['url'].'">'.$this->data['menu_options']['brand']['content'].'</a>';
    wp_nav_menu([
      'menu'              => $this->data['menu_options']['id'],
      'depth'             => 2,
      'container'         => 'div',
      'container_class'   => 'collapse navbar-collapse',
      'container_id'      => $this->data['menu_options']['id'],
      'menu_class'        => 'navbar-nav mr-auto',
      'walker'            => new bs4navwalker,
    ]);

    echo '</nav>';
  }
}

class WpcSectionPosts extends WpcSection{

  public function printHTML(){ //se imprime la lista de todos los posts
    $this->printInitHTML();
    $c = 0;
    //abrimos el div correspondiente a agrupar las tarjetas
    if (isset($this->data['posts_p_fila'])) echo '<div class="card-group">';
    //si se especifica una categoria establecemos el correpondiente filtro
    if (isset($this->data['category'])) query_posts('category_name='.$this->data['category']);
    //listamos los posts
    if (have_posts()) {
	     while (have_posts()) {
		       the_post();
           $this->printPostHTML();
           $c++;
           if (isset($this->data['posts_p_fila']) && $c==$this->data['posts_p_fila']){
             $c=0;
             if (isset($this->data['posts_p_fila'])) echo '</div><div class="card-group">';
           }
       }
    }
    if (isset($this->data['posts_p_fila']))echo '</div>';
    $this->printEndHTML();
  }

  protected function printPostHTML(){
      echo '<div class="card" >';
      the_post_thumbnail('medium',['class' => 'card-img-top']);
      echo '
        <div class="card-block">
          <h4 class="card-title">';the_title(); echo '</h4>
          <small class="card-text">';the_excerpt(); echo'</small>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Publicado el: ';the_time('j/m/Y'); echo '</li>
        </ul>
        <div class="card-footer">
          <a href="';the_permalink(); echo '" class="card-link">Leer Más</a>
        </div>
      </div>';
  }
}

class WpcSectionSinglePost extends WpcSectionPosts{

  protected function printPostHTML(){
    echo '<article>';
    $this->printHTMLHeader();
    echo '<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">';
    $this->printHTMLContent();
    $this->printHTMLComents();
    echo '</div></article>';
  }

  private function printHTMLContent(){
    echo '<div class="post">';
    the_content();
    echo '</div>';
  }

  private function printHTMLComents(){
    echo '<div class="comentarios">';
    comments_template();
    echo '</div>';
  }

  private function printHTMLHeader(){
    echo '<header class="post-header">
      <div class="text-center">
        <h2>'; the_title(); echo '</h2>
        <small>Publicado el ';the_time('j/m/Y'); echo '</small>
      </div>
    </header>';
  }
}

 ?>
