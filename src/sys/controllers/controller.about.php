<?php

class Controller extends BaseController {
  
  public function process() {
    $this->loadAccount();
    $this->styler->setTitle('AllNimes - About');
    $this->styler->init();
    $this->styler->setTemplate('about');
    $this->styler->render();
  }
}

?>