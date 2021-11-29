<?php

class Account {
  public $id = -1;
  public $email = '';
  public $password = '';
  public $username = '';

  public function __construct($id, $email, $password, $username) {
    $this->id = $id;
    $this->email = $email;
    $this->password = $password;
    $this->username = $username;
  }
 
  public function save() {

  }

  public static function new($email, $password, $username) {
    global $pdo;
    $stmt = $pdo->prepare('INSERT INTO account (email, password, username) VALUES(?, ?, ?)');
    $stmt->execute([$email, $password, $username]); 
    $instance = new self($pdo->lastInsertId(), $email, $password, $username);
    return $instance;
  }

  public static function getById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, email, password, username FROM account WHERE id=?");
    $stmt->execute([$id]); 
    $result = $stmt->fetch(PDO::FETCH_NUM);
    if ($result) {
      $account = Account::new($result[0], $result[1], $result[2], $result[3]);
      return $account;
    }
    return null;
  }

  public static function getByEmail($email) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, email, password, username FROM account WHERE email=?");
    $stmt->execute([$email]); 
    $result = $stmt->fetch(PDO::FETCH_NUM);
    if ($result) {
      $account = new Account($result[0], $result[1], $result[2], $result[3]);
      return $account;
    }
    return null;
  }

  public static function getByUsername($username) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, email, password, username FROM account WHERE username=?");
    $stmt->execute([$username]); 
    $result = $stmt->fetch(PDO::FETCH_NUM);
    if ($result) {
      $account = new Account($result[0], $result[1], $result[2], $result[3]);
      return $account;
    }
    return null;
  }
}

?>