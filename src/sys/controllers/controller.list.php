<?php

class Controller extends BaseController {
  
  public function process() {
    $this->loadAccount();
    $this->styler->setTitle('AllNimes - List');
    $this->styler->init();
    $this->styler->setTemplate('list');
    $this->styler->render();
  }
}

?>