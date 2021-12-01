<?php

useModel('manga');

class Controller extends BaseController {
  
  public function process() {
    $this->loadAccount();
    $this->styler->assign('recent', Manga::getNews());
    $this->styler->assign('trending', Manga::getTrending());
    if ($this->account == null) {
      $this->styler->assign('recommended', Manga::getRandom());
    } else {
      $this->styler->assign('myList', Manga::getWatchLater($this->account->getId()));
      $this->styler->assign('watchAgain', Manga::getAlreadyWatched($this->account->getId()));
      $this->styler->assign('recommended', Manga::getRecommended($this->account->getId()));
    }
    $this->styler->setTitle('AllNimes - Mangas');
    $this->styler->init();
    $this->styler->setTemplate('mangas');
    $this->styler->render();
  }
}

?>