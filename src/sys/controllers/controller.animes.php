<?php

useModel('anime');

class Controller extends BaseController {

  public function process() {
    $this->loadAccount();
    $this->styler->assign('recent', Anime::getNews());
    $this->styler->assign('trending', Anime::getTrending());
    if ($this->account == null) {
      $this->styler->assign('recommended', Anime::getRandom());
    } else {
      $this->styler->assign('myList', Anime::getWatchLater($this->account->getId()));
      $this->styler->assign('watchAgain', Anime::getAlreadyWatched($this->account->getId()));
      $this->styler->assign('recommended', Anime::getRecommended($this->account->getId()));
    }
    $this->styler->setTitle('AllNimes - Animes');
    $this->styler->init();
    $this->styler->setTemplate('animes');
    $this->styler->render();
  }
}

?>