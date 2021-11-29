<?php

class Controller extends BaseController {
  
  public function process() {
    $this->loadAccount();
    $this->styler->setTitle('AllNimes - Mangas');
    $this->styler->init();
    $this->styler->setTemplate('mangas');
    $this->styler->render();
  }
}

?>