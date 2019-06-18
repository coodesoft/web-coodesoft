<?php
class WpcSectionPodsGrid extends WpcSectionPosts{

  private $podsData = ['id'=>'', 'limit'=>-1,
                        'campos' => [],
                      ];

  private $vista = 'previa';

  public function __construct($data){
    parent::__construct($data);
    $this->podsData = $data['pods'];
  }

  public function printHTML(){ //se imprime la lista de todos los posts
    $this->printInitHTML();
    $c = 0;
    //abrimos el div correspondiente a agrupar las tarjetas
    if (isset($this->data['posts_p_fila'])) echo '<div class="card-group">';
    //listamos los pods
    $this->printPods();
    if (isset($this->data['posts_p_fila'])) echo '</div>';
    $this->printEndHTML();
  }

  private function printPods(){
    $params = [
      'limit' => $this->podsData['limit'],
    ];

    $pd = pods($this->podsData['id'],$params);

    if ( 0 < $pd->total() ) {

      while ( $pd->fetch() ) {
        $this->printCardHeader();

        $this->printCampos($pd);

        $this->printCardFooter();
        $c++;
        if (isset($this->data['posts_p_fila']) && $c==$this->data['posts_p_fila']){
          $c=0;
          if (isset($this->data['posts_p_fila'])) echo '</div><div class="card-group">';
        }
      }
    }
  }

  private function printCampos($pd){
    
    if (isset($this->podsData['campos'])){

      $idCampos = $this->podsData['campos'];
      foreach ($idCampos as $v) {
        $clase = new $v['type_class']($v,$pd);
        $clase->printHTML();
      }
    }
  }

  private function printCardHeader(){
      echo '<div class="card" >';
      echo '<div class="card-block">';
  }

  private function printCardFooter(){
    echo '
      </div>
    </div>';
  }
}
 ?>
