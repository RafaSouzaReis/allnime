<?php

class Controller extends BaseController {
  
  public function process() {
    $this->styler->setTitle('AllNimes - About');
    $this->styler->init();
    $this->styler->setTemplate('about');
    $this->styler->render();
  }
}

?>