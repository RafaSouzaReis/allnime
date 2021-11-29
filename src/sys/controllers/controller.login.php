<?php

useModel('account');

class Controller {
  private $app;
  private $styler;

  public function __construct($app, $styler) {
    $this->app = $app;
    $this->styler = $styler;
  }

  public function process() {
    $this->login();
    $this->styler->setTitle('AllNimes - Login');
    $this->styler->init();
    $this->styler->setTemplate('login');
    $this->styler->render();
  }

  public function login() {
    if (isset($_POST['email']) && isset($_POST['password'])) {
      $email = $_POST['email'];
      $password = $_POST['password'];
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->styler->assign('showForm', true);
        $this->styler->assign('showBubble', true);
        $this->styler->assign('bubbleType', 'error');
        $this->styler->assign('bubbleContent', 'Invalid email.');
        return;
      }
      if (strlen($password) < 8 || strlen($password) > 64) {
        $this->styler->assign('showForm', true);
        $this->styler->assign('showBubble', true);
        $this->styler->assign('bubbleType', 'error');
        $this->styler->assign('bubbleContent', 'Password must be between 8 and 64 characters long.');
        return;
      }
    }
  }
}

?>