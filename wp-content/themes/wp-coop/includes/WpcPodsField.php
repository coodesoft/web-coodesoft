<?php
class WpcPodsField {
  protected $data;
  protected $pod;

  public function __construct($data,$pd){
    $this->data = $data;
    $this->pod  = $pd;
  }

  protected function printHTML(){
  }
}

class WpcPodsFieldImg extends WpcPodsField{

  public function printHTML(){
    echo '<img src="'.$this->pod->display($this->data['id']).'" />';
  }
}

class WpcPodsFieldText extends WpcPodsField{

  public function printHTML(){
    echo '<'.$this->data['tag'].'>';
    echo $this->pod->display($this->data['id']);
    echo '</'.$this->data['tag'].'>';
  }
}

class WpcPodsFieldLink extends WpcPodsField{

  public function printHTML(){

  }
}
 ?>
