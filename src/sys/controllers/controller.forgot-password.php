<?php

class Controller extends BaseController {
  
  public function process() {
    $this->styler->setTitle('AllNimes - Forgot Password');
    $this->styler->init();
    $this->styler->setTemplate('forgot-pwd');
    $this->styler->render();
  }
}

?>