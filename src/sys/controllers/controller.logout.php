<?php

class Controller extends BaseController {
  
  public function process() {
    unset($_SESSION['logged']);
    unset($_SESSION['accountId']);
    session_destroy();
    header('Location: ./');
    exit();
  }
}

?>