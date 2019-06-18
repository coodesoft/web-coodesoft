<?php
class WpcSectionTitle {

  protected $data;

  public function __construct($data){
    $this->data = $data;
  }

  public function printHTML(){
    echo '<div class="'.$this->data['class'].'">';
    echo    '<h2>'.$this->data['title'].'</h2>';
    echo    '<h4>'.$this->data['subTitle'].'</h4>';
    echo '</div>';
  }
}
 ?>
