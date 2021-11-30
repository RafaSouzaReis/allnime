<?php

useModel('anime');

class Controller extends BaseController {

  public function process() {
    if (!isset($_GET['id'])) {
      header('Location: ./');
      exit();
    }
    $this->loadAccount();
    $anime = Anime::getById($_GET['id']);
    if ($anime == null) {
      header('Location: ./');
      exit();
    }
    $this->styler->assign('anime', $anime);

    $similar = Anime::getSimilar($anime->getId());
    if ($similar == null) {
      $similar = Anime::getRandom();
    }
    $this->styler->assign('similar', $similar);

    if ($this->account != null) {
      if (isset($_POST['watchLater'])) {
        $anime->setWatchLater($this->account->getId(), $_POST['watchLater'] == '1');
      }
  
      $isWatchLater = $anime->isWatchLater($this->account->getId());
      $this->styler->assign('watchLater', $isWatchLater);
  
      if (isset($_POST['alreadyWatched'])) {
        $anime->setAlreadyWatched($this->account->getId(), $_POST['alreadyWatched'] == '1');
        $anime->updateScore($_POST['alreadyWatched'] == '1');
      }
  
      $isAlreadyWatched = $anime->isAlreadyWatched($this->account->getId());
      $this->styler->assign('alreadyWatched', $isAlreadyWatched);
    }

    $this->styler->setTitle('AllNimes - Anime');
    $this->styler->init();
    $this->styler->setTemplate('anime');
    $this->styler->render();
  }
}

?>