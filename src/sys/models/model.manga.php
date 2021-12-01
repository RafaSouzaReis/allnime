<?php

class Manga {
  private $id = -1;
  private $name = '';
  private $fullName = '';
  private $description = '';
  private $picture = '';
  private $kitsuId = -1;
  private $type = -1;
  private $ageGroup = -1;
  private $releaseDate = '';
  private $score = 0;

  public function __construct($id, $name, $fullName, $description, $picture, $kitsuId, $type, $ageGroup, $releaseDate, $score) {
    $this->id = $id;
    $this->name = $name;
    $this->fullName = $fullName;
    $this->description = $description;
    $this->picture = $picture;
    $this->kitsuId = $kitsuId;
    $this->type = $type;
    $this->ageGroup = $ageGroup;
    $this->releaseDate = $releaseDate;
    $this->score = $score;
  }

  public function getId() { return $this->id; }
  public function getName() { return $this->name; }
  public function getFullName() { return $this->fullName; }
  public function getDescription() { return $this->description; }
  public function getPicture() { return $this->picture; }
  public function getKitsuId() { return $this->kitsuId; }
  public function getType() { return $this->type; }
  public function getAgeGroup() { return $this->ageGroup; }
  public function getReleaseDate() { return $this->releaseDate; }
  public function getScore() { return $this->score; }

  public function setName($name) { $this->name = $name; }
  public function setFullName($fullName) { $this->fullName = $fullName; }
  public function setDescription($description) { $this->description = $description; }
  public function setPicture($picture) { $this->picture = $picture; }
  public function setKitsuId($kitsuId) { $this->kitsuId = $kitsuId; }
  public function setType($type) { $this->type = $type; }
  public function setAgeGroup($ageGroup) { $this->ageGroup = $ageGroup; }
  public function setReleaseDate($releaseDate) { $this->releaseDate = $releaseDate; }

  public function isAnime() { return false; }

  public function update() {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE manga SET name=?, full_name=?, description=?, picture=?, kitsu_id=?, type=?, age_group=?, release_date=? WHERE id=?;");
    $stmt->execute([$this->name, $this->fullName, $this->description, $this->picture, $this->kitsuId, $this->type, $this->ageGroup, $this->releaseDate, $this->id]);
  }

  public function delete() {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM manga WHERE id=?");
    $stmt->execute([$this->id]);
  }

  public function updateScore($v) {
    if ($v) {
      global $pdo;
      $stmt = $pdo->prepare("UPDATE manga SET score = score + 1 WHERE id=?;");
      $stmt->execute([$this->id]);
    } else {
      global $pdo;
      $stmt = $pdo->prepare("UPDATE manga SET score = score - 1 WHERE id=?;");
      $stmt->execute([$this->id]);
    }
  }
  
  public function isAlreadyRead($accountId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id FROM already_read WHERE account_id=? AND manga_id=?;");
    $stmt->execute([$accountId, $this->id]);
    $result = $stmt->fetch(PDO::FETCH_NUM);
    return $result == true;
  }

  public function setAlreadyRead($accountId, $v) {
    global $pdo;
    if ($v) {
      $stmt = $pdo->prepare("INSERT IGNORE INTO already_read (account_id, manga_id) VALUES (?, ?);");
      $stmt->execute([$accountId, $this->id]);
      $stmt = $pdo->prepare("DELETE FROM read_later WHERE account_id=? AND manga_id=?;");
      $stmt->execute([$accountId, $this->id]);
    } else {
      $stmt = $pdo->prepare("DELETE FROM already_read WHERE account_id=? AND manga_id=?;");
      $stmt->execute([$accountId, $this->id]);
    }
  }

  public function isReadLater($accountId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id FROM read_later WHERE account_id=? AND manga_id=?;");
    $stmt->execute([$accountId, $this->id]);
    $result = $stmt->fetch(PDO::FETCH_NUM);
    return $result == true;
  }

  public function setReadLater($accountId, $v) {
    global $pdo;
    if ($v) {
      $stmt = $pdo->prepare("INSERT IGNORE INTO read_later (account_id, manga_id) VALUES (?, ?);");
      $stmt->execute([$accountId, $this->id]);
    } else {
      $stmt = $pdo->prepare("DELETE FROM read_later WHERE account_id=? AND manga_id=?;");
      $stmt->execute([$accountId, $this->id]);
    }
  }

  public static function new($name, $fullName, $description, $picture, $kitsuId, $type, $ageGroup, $releaseDate) {
    global $pdo;
    $stmt = $pdo->prepare('INSERT INTO manga (name, full_name, description, picture, kitsu_id, type, age_group, release_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?);');
    $stmt->execute([$name, $fullName, $description, $picture, $kitsuId, $type, $ageGroup, $releaseDate]);
    $instance = new self($pdo->lastInsertId(), $name, $fullName, $description, $picture, $kitsuId, $type, $ageGroup, $releaseDate, 0);
    return $instance;
  }

  public static function getById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, name, full_name, description, picture, kitsu_id, type, age_group, release_date, score FROM manga WHERE id=?;");
    $stmt->execute([$id]); 
    $result = $stmt->fetch(PDO::FETCH_NUM);
    if ($result) {
      $manga = new Manga($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
      return $manga;
    }
    return null;
  }

  public static function getByKitsuId($kitsuId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, name, full_name, description, picture, kitsu_id, type, age_group, release_date, score FROM manga WHERE kitsu_id=?;");
    $stmt->execute([$kitsuId]); 
    $result = $stmt->fetch(PDO::FETCH_NUM);
    if ($result) {
      $manga = new Manga($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
      return $manga;
    }
    return null;
  }

  public static function getByName($name, $limit = 1) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, name, full_name, description, picture, kitsu_id, type, age_group, release_date, score FROM manga WHERE name LIKE :name LIMIT :limit;");
    $stmt->bindValue(':name', '%' . $name . '%', PDO::PARAM_STR);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute(); 
    $results = $stmt->fetchAll(PDO::FETCH_NUM);
    if ($results) {
      $mangas = [];
      foreach ($results as $result) {
        $manga = new Manga($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
        array_push($mangas, $manga);
      }
      return $mangas;
    }
    return null;
  }

  public static function getNews($limit = 15) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, name, full_name, description, picture, kitsu_id, type, age_group, release_date, score FROM manga ORDER BY release_date DESC LIMIT :limit;");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute(); 
    $results = $stmt->fetchAll(PDO::FETCH_NUM);
    if ($results) {
      $mangas = [];
      foreach ($results as $result) {
        $manga = new Manga($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
        array_push($mangas, $manga);
      }
      return $mangas;
    }
    return null;
  }

  public static function getTrending($limit = 15) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, name, full_name, description, picture, kitsu_id, type, age_group, release_date, score FROM manga ORDER BY score DESC LIMIT :limit;");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute(); 
    $results = $stmt->fetchAll(PDO::FETCH_NUM);
    if ($results) {
      $mangas = [];
      foreach ($results as $result) {
        $manga = new Manga($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
        array_push($mangas, $manga);
      }
      return $mangas;
    }
    return null;
  }

  public static function getRandom($limit = 15) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, name, full_name, description, picture, kitsu_id, type, age_group, release_date, score FROM manga ORDER BY RAND() LIMIT :limit;");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute(); 
    $results = $stmt->fetchAll(PDO::FETCH_NUM);
    if ($results) {
      $mangas = [];
      foreach ($results as $result) {
        $manga = new Manga($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
        array_push($mangas, $manga);
      }
      return $mangas;
    }
    return null;
  }

  public static function getSimilar($mangaId, $limit = 15) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT manga.id, manga.name, manga.full_name, manga.description, manga.picture, manga.kitsu_id, manga.type, manga.age_group, manga.release_date, manga.score FROM manga_genre JOIN manga ON manga.id = manga_genre.manga_id WHERE manga_genre.genre_id IN (SELECT manga_genre.genre_id FROM manga_genre WHERE manga_genre.manga_id = :mangaId) GROUP BY manga.id ORDER BY RAND() LIMIT :limit;");
    $stmt->bindValue(':mangaId', $mangaId, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute(); 
    $results = $stmt->fetchAll(PDO::FETCH_NUM);
    if ($results) {
      $mangas = [];
      foreach ($results as $result) {
        $manga = new Manga($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
        array_push($mangas, $manga);
      }
      return $mangas;
    }
    return null;
  }

  public static function getRecommended($accountId, $limit = 15) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT manga.id, manga.name, manga.full_name, manga.description, manga.picture, manga.kitsu_id, manga.type, manga.age_group, manga.release_date, manga.score FROM manga_genre JOIN manga ON manga.id = manga_genre.manga_id WHERE manga_genre.genre_id IN (SELECT manga_genre.genre_id FROM already_read JOIN manga_genre ON manga_genre.manga_id = already_read.manga_id WHERE already_read.account_id = :accountId) GROUP BY manga.id ORDER BY RAND() LIMIT :limit;");
    $stmt->bindValue(':accountId', $accountId, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute(); 
    $results = $stmt->fetchAll(PDO::FETCH_NUM);
    if ($results) {
      $mangas = [];
      foreach ($results as $result) {
        $manga = new Manga($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
        array_push($mangas, $manga);
      }
      return $mangas;
    }
    return null;
  }

  public static function getWatchLater($accountId, $limit = 15) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT manga.id, manga.name, manga.full_name, manga.description, manga.picture, manga.kitsu_id, manga.type, manga.age_group, manga.release_date, manga.score FROM read_later JOIN manga ON manga.id = read_later.manga_id WHERE read_later.account_id = :accountId ORDER BY read_later.creation_date LIMIT :limit;");
    $stmt->bindValue(':accountId', $accountId, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute(); 
    $results = $stmt->fetchAll(PDO::FETCH_NUM);
    if ($results) {
      $mangas = [];
      foreach ($results as $result) {
        $manga = new Manga($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
        array_push($mangas, $manga);
      }
      return $mangas;
    }
    return null;
  }

  public static function getAlreadyWatched($accountId, $limit = 15) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT manga.id, manga.name, manga.full_name, manga.description, manga.picture, manga.kitsu_id, manga.type, manga.age_group, manga.release_date, manga.score FROM already_read JOIN manga ON manga.id = already_read.manga_id WHERE already_read.account_id = :accountId ORDER BY RAND() LIMIT :limit;");
    $stmt->bindValue(':accountId', $accountId, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute(); 
    $results = $stmt->fetchAll(PDO::FETCH_NUM);
    if ($results) {
      $mangas = [];
      foreach ($results as $result) {
        $manga = new Manga($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
        array_push($mangas, $manga);
      }
      return $mangas;
    }
    return null;
  }

}

?>