<?php

class Genre {
  private $id = -1;
  private $name = '';
  private $fullName = '';

  public function __construct($id, $name, $fullName) {
    $this->id = $id;
    $this->name = $name;
    $this->fullName = $fullName;
  }

  public function getId() { return $this->id; }
  public function getName() { return $this->name; }
  public function getFullName() { return $this->fullName; }

  public function update() {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE genre SET name=?, full_name=? WHERE id=?;");
    $stmt->execute([$this->name, $this->fullName, $this->id]);
  }

  public function delete() {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM genre WHERE id=?");
    $stmt->execute([$this->id]);
  }
  
  public static function new($name, $fullName) {
    global $pdo;
    $stmt = $pdo->prepare('INSERT INTO genre (name, full_name) VALUES (?, ?);');
    $stmt->execute([$name, $fullName]);
    $instance = new self($pdo->lastInsertId(), $name, $fullName);
    return $instance;
  }

  public static function getById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, name, full_name FROM genre WHERE id=?;");
    $stmt->execute([$id]); 
    $result = $stmt->fetch(PDO::FETCH_NUM);
    if ($result) {
      $genre = new Genre($result[0], $result[1], $result[2]);
      return $genre;
    }
    return null;
  }

  public static function getByName($name, $limit = 1) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, name, full_name FROM genre WHERE name LIKE :name LIMIT :limit;");
    $stmt->bindValue(':name', '%' . $name . '%', PDO::PARAM_STR);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute(); 
    $results = $stmt->fetchAll(PDO::FETCH_NUM);
    if ($results) {
      $genres = [];
      foreach ($results as $result) {
        $genre = new Genre($result[0], $result[1], $result[2]);
        array_push($genres, $genre);
      }
      return $genres;
    }
    return null;
  }

  public static function getByAnimeId($animeId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT genre.id, genre.name, genre.full_name FROM anime_genre JOIN genre ON genre.id = anime_genre.genre_id WHERE anime_id=?;");
    $stmt->execute([$animeId]); 
    $results = $stmt->fetchAll(PDO::FETCH_NUM);
    if ($results) {
      $genres = [];
      foreach ($results as $result) {
        $genre = new Genre($result[0], $result[1], $result[2]);
        array_push($genres, $genre);
      }
      return $genres;
    }
    return null;
  }

  public static function getByMangaId($mangaId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT genre.id, genre.name, genre.full_name FROM manga_genre JOIN genre ON genre.id = manga_genre.genre_id WHERE manga_id=?;");
    $stmt->execute([$mangaId]); 
    $results = $stmt->fetchAll(PDO::FETCH_NUM);
    if ($results) {
      $genres = [];
      foreach ($results as $result) {
        $genre = new Genre($result[0], $result[1], $result[2]);
        array_push($genres, $genre);
      }
      return $genres;
    }
    return null;
  }
}

?>