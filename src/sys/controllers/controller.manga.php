<?php

useModel('manga');
useModel('genre');

class Controller extends BaseController {

  public function process() {
    if (!isset($_GET['id'])) {
      header('Location: ./');
      exit();
    }
    $this->loadAccount();
    $manga = Manga::getById($_GET['id']);
    if ($manga == null) {
      header('Location: ./');
      exit();
    }
    $this->styler->assign('manga', $manga);

    $genres = Genre::getByMangaId($manga->getId());
    if ($genres != null) {
      $this->styler->assign('genres', $genres);
    } else {
      $this->styler->assign('genres', []);
    }

    $similar = Manga::getSimilar($manga->getId());
    if ($similar == null) {
      $similar = Manga::getRandom();
    }
    $this->styler->assign('similar', $similar);

    if ($this->account != null) {
      if (isset($_POST['readLater'])) {
        $manga->setReadLater($this->account->getId(), $_POST['readLater'] == '1');
      }
  
      $isReadLater = $manga->isReadLater($this->account->getId());
      $this->styler->assign('readLater', $isReadLater);
  
      if (isset($_POST['alreadyRead'])) {
        $manga->setAlreadyRead($this->account->getId(), $_POST['alreadyRead'] == '1');
        $manga->updateScore($_POST['alreadyRead'] == '1');
      }
  
      $isAlreadyRead = $manga->isAlreadyRead($this->account->getId());
      $this->styler->assign('alreadyRead', $isAlreadyRead);
    }

    $this->styler->setTitle('AllNimes - ' . $manga->getName());
    $this->styler->init();
    $this->styler->setTemplate('manga');
    $this->styler->render();
  }
}

?>