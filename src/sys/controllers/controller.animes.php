<?php

class Controller {
  private $app;
  private $styler;

  public function __construct($app, $styler) {
    $this->app = $app;
    $this->styler = $styler;
  }

  public function process() {
    $this->styler->setTitle('Allnimes - Animes');
    $this->styler->init();
    $this->styler->setTemplate('animes');
    $this->styler->render();
  }
}

?>