<?php
class WpcWidgetManager{
  private $widgets = [];

  public function addWidget($wConfig){
    $widgets.array_push($this->widgets,$wconfig);
  }

  //recorremos todas las secciones en busca de widgets
  public function findStaticWidgets($secciones){
    foreach ($secciones as $sec) {
      if ($sec['type_class'] == WpcWidgetContainer) {
        $this->addWidget($sec['widget_data']);
      } elseif(isset($sec['content']))
          $this->findStaticWidgets($sec['content']);

    }
  }

  //registramos todos los widgets del template
  public function registerWidgets(){

    foreach ($this->widgets as $w)
      register_sidebar($w);
  }

}
 ?>
