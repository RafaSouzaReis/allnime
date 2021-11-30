<?php

useModel('anime');
useModel('manga');

class Controller extends BaseController {
  
  public function process() {
    $this->loadAccount();
    $this->styler->assign('recent', Anime::getNews());
    $this->styler->setTitle('AllNimes');
    $this->styler->init();
    $this->styler->setTemplate('home');
    $this->styler->render();
  }
}

?>