<?php

class Controller extends BaseController {
  
  public function process() {
    if (isset($_SESSION['logged'])) {
      header('Location: ./');
      exit();
    }
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
      try {
        $account = Account::getByEmail($email);
        if ($account == null) {
          $this->styler->assign('showForm', true);
          $this->styler->assign('showBubble', true);
          $this->styler->assign('bubbleType', 'error');
          $this->styler->assign('bubbleContent', 'There is no account with this email address.');
          return;
        }
        if ($account->login($password)) {
          $_SESSION['logged'] = true;
          $_SESSION['accountId'] = $account->getId();
          header('Location: ./');
          exit();
        } else {
          $this->styler->assign('showForm', true);
          $this->styler->assign('showBubble', true);
          $this->styler->assign('bubbleType', 'error');
          $this->styler->assign('bubbleContent', 'Wrong or invalid password.');
          return;
        }
      } catch (Exception $e) {
        $this->styler->assign('showForm', true);
        $this->styler->assign('showBubble', true);
        $this->styler->assign('bubbleType', 'error');
        $this->styler->assign('bubbleContent', 'An unknown error has occurred, please try again later.');
      }
    }
    $this->styler->assign('showForm', true);
    $this->styler->assign('showBubble', false);
  }
}

?>