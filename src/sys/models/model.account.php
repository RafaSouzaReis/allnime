<?php

class Account {
  private $id = -1;
  private $email = '';
  private $password = '';
  private $username = '';

  public function __construct($id, $email, $password, $username) {
    $this->id = $id;
    $this->email = $email;
    $this->password = $password;
    $this->username = $username;
  }
 
  public function getId() { return $this->id; }
  public function getEmail() { return $this->email; }
  public function getPassword() { return $this->password; }
  public function getUsername() { return $this->username; }

  public function setEmail($email) { $this->email = $email; }
  public function setPassword($password) { $this->password = $password; }
  public function setUsername($username) { $this->username = $username; }

  public function update() {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE account SET email=?, password=?, username=? WHERE id=?;");
    $stmt->execute([$this->email, $this->password, $this->username, $this->id]);
  }

  public function delete() {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM account WHERE id=?");
    $stmt->execute([$this->id]);
  }

  public function login($rawPassword) {
    return password_verify($rawPassword, $this->password);
  }

  public static function new($email, $password, $username) {
    global $pdo;
    $stmt = $pdo->prepare('INSERT INTO account (email, password, username) VALUES (?, ?, ?);');
    $stmt->execute([$email, $password, $username]); 
    $instance = new self($pdo->lastInsertId(), $email, $password, $username);
    return $instance;
  }

  public static function getById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, email, password, username FROM account WHERE id=?;");
    $stmt->execute([$id]); 
    $result = $stmt->fetch(PDO::FETCH_NUM);
    if ($result) {
      $account = new Account($result[0], $result[1], $result[2], $result[3]);
      return $account;
    }
    return null;
  }

  public static function getByEmail($email) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, email, password, username FROM account WHERE email=?;");
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
    $stmt = $pdo->prepare("SELECT id, email, password, username FROM account WHERE username=?;");
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