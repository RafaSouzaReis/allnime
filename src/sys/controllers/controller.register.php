<?php

class Controller extends BaseController {
  
  public function process() {
    if (isset($_SESSION['logged'])) {
      header('Location: ./');
      exit();
    }
    $this->register();
    $this->styler->setTitle('AllNimes - Register');
    $this->styler->init();
    $this->styler->setTemplate('register');
    $this->styler->render();
  }

  public function register() {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
      $email = $_POST['email'];
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->styler->assign('showForm', true);
        $this->styler->assign('showBubble', true);
        $this->styler->assign('bubbleType', 'error');
        $this->styler->assign('bubbleContent', 'Invalid email.');
        return;
      }
      $username = $_POST['username'];
      if (strlen($username) < 3 || strlen($username) > 32) {
        $this->styler->assign('showForm', true);
        $this->styler->assign('showBubble', true);
        $this->styler->assign('bubbleType', 'error');
        $this->styler->assign('bubbleContent', 'Username must be between 3 and 32 characters long.');
        return;
      }
      if (!preg_match("/^[a-zA-Z0-9]([._-](?![._-])|[a-zA-Z0-9]){3,18}[a-zA-Z0-9]$/", $username)) {
        $this->styler->assign('showForm', true);
        $this->styler->assign('showBubble', true);
        $this->styler->assign('bubbleType', 'error');
        $this->styler->assign('bubbleContent', 'Username does not follow naming rules.');
        return;
      }
      $rawPassword = $_POST['password'];
      if (strlen($rawPassword) < 8 || strlen($rawPassword) > 64) {
        $this->styler->assign('showForm', true);
        $this->styler->assign('showBubble', true);
        $this->styler->assign('bubbleType', 'error');
        $this->styler->assign('bubbleContent', 'Password must be between 8 and 64 characters long.');
        return;
      }
      if (Account::getByEmail($email) != null) {
        $this->styler->assign('showForm', true);
        $this->styler->assign('showBubble', true);
        $this->styler->assign('bubbleType', 'error');
        $this->styler->assign('bubbleContent', 'There is already an account with that email address.');
        return;
      }
      if (Account::getByUsername($username) != null) {
        $this->styler->assign('showForm', true);
        $this->styler->assign('showBubble', true);
        $this->styler->assign('bubbleType', 'error');
        $this->styler->assign('bubbleContent', 'There is already an account with that username.');
        return;
      }
      $password = password_hash($rawPassword, PASSWORD_DEFAULT);
      try {
        $account = Account::new($email, $password, $username);
        $this->styler->assign('showBubble', true);
        $this->styler->assign('bubbleType', 'success');
        $this->styler->assign('bubbleContent', 'Account created successfully!');
      } catch (Exception  $e) {
        $this->styler->assign('showBubble', true);
        $this->styler->assign('bubbleType', 'error');
        $this->styler->assign('bubbleContent', 'Failed to create account, try again later.');
      }
    }
    $this->styler->assign('showForm', true);
    $this->styler->assign('showBubble', false);
  }
}

?>