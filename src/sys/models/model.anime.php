<?php

class Anime {
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

  public function isAnime() { return true; }

  public function update() {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE anime SET name=?, full_name=?, description=?, picture=?, kitsu_id=?, type=?, age_group=?, release_date=? WHERE id=?;");
    $stmt->execute([$this->name, $this->fullName, $this->description, $this->picture, $this->kitsuId, $this->type, $this->ageGroup, $this->releaseDate, $this->id]);
  }

  public function delete() {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM anime WHERE id=?");
    $stmt->execute([$this->id]);
  }

  public function updateScore($v) {
    if ($v) {
      global $pdo;
      $stmt = $pdo->prepare("UPDATE anime SET score = score + 1 WHERE id=?;");
      $stmt->execute([$this->id]);
    } else {
      global $pdo;
      $stmt = $pdo->prepare("UPDATE anime SET score = score - 1 WHERE id=?;");
      $stmt->execute([$this->id]);
    }
  }

  public function isAlreadyWatched($accountId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id FROM already_watched WHERE account_id=? AND anime_id=?;");
    $stmt->execute([$accountId, $this->id]);
    $result = $stmt->fetch(PDO::FETCH_NUM);
    return $result == true;
  }

  public function setAlreadyWatched($accountId, $v) {
    global $pdo;
    if ($v) {
      $stmt = $pdo->prepare("INSERT IGNORE INTO already_watched (account_id, anime_id) VALUES (?, ?);");
      $stmt->execute([$accountId, $this->id]);
      $stmt = $pdo->prepare("DELETE FROM watch_later WHERE account_id=? AND anime_id=?;");
      $stmt->execute([$accountId, $this->id]);
    } else {
      $stmt = $pdo->prepare("DELETE FROM already_watched WHERE account_id=? AND anime_id=?;");
      $stmt->execute([$accountId, $this->id]);
    }
  }

  public function isWatchLater($accountId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id FROM watch_later WHERE account_id=? AND anime_id=?;");
    $stmt->execute([$accountId, $this->id]);
    $result = $stmt->fetch(PDO::FETCH_NUM);
    return $result == true;
  }

  public function setWatchLater($accountId, $v) {
    global $pdo;
    if ($v) {
      $stmt = $pdo->prepare("INSERT IGNORE INTO watch_later (account_id, anime_id) VALUES (?, ?);");
      $stmt->execute([$accountId, $this->id]);
    } else {
      $stmt = $pdo->prepare("DELETE FROM watch_later WHERE account_id=? AND anime_id=?;");
      $stmt->execute([$accountId, $this->id]);
    }
  }
  
  public static function new($name, $fullName, $description, $picture, $kitsuId, $type, $ageGroup, $releaseDate) {
    global $pdo;
    $stmt = $pdo->prepare('INSERT INTO anime (name, full_name, description, picture, kitsu_id, type, age_group, release_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?);');
    $stmt->execute([$name, $fullName, $description, $picture, $kitsuId, $type, $ageGroup, $releaseDate]); 
    $instance = new self($pdo->lastInsertId(), $name, $fullName, $description, $picture, $kitsuId, $type, $ageGroup, $releaseDate, 0);
    return $instance;
  }

  public static function getById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, name, full_name, description, picture, kitsu_id, type, age_group, release_date, score FROM anime WHERE id=?;");
    $stmt->execute([$id]); 
    $result = $stmt->fetch(PDO::FETCH_NUM);
    if ($result) {
      $anime = new Anime($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
      return $anime;
    }
    return null;
  }

  public static function getByKitsuId($kitsuId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, name, full_name, description, picture, kitsu_id, type, age_group, release_date, score FROM anime WHERE kitsu_id=?;");
    $stmt->execute([$kitsuId]); 
    $result = $stmt->fetch(PDO::FETCH_NUM);
    if ($result) {
      $anime = new Anime($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
      return $anime;
    }
    return null;
  }

  public static function getByName($name, $limit = 1) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, name, full_name, description, picture, kitsu_id, type, age_group, release_date, score FROM anime WHERE name LIKE :name LIMIT :limit;");
    $stmt->bindValue(':name', '%' . $name . '%', PDO::PARAM_STR);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute(); 
    $results = $stmt->fetchAll(PDO::FETCH_NUM);
    if ($results) {
      $animes = [];
      foreach ($results as $result) {
        $anime = new Anime($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
        array_push($animes, $anime);
      }
      return $animes;
    }
    return null;
  }

  public static function getNews($limit = 15) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, name, full_name, description, picture, kitsu_id, type, age_group, release_date, score FROM anime ORDER BY release_date DESC LIMIT :limit;");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute(); 
    $results = $stmt->fetchAll(PDO::FETCH_NUM);
    if ($results) {
      $animes = [];
      foreach ($results as $result) {
        $anime = new Anime($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
        array_push($animes, $anime);
      }
      return $animes;
    }
    return null;
  }

  public static function getTrending($limit = 15) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, name, full_name, description, picture, kitsu_id, type, age_group, release_date, score FROM anime ORDER BY score DESC LIMIT :limit;");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute(); 
    $results = $stmt->fetchAll(PDO::FETCH_NUM);
    if ($results) {
      $animes = [];
      foreach ($results as $result) {
        $anime = new Anime($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
        array_push($animes, $anime);
      }
      return $animes;
    }
    return null;
  }

  public static function getRandom($limit = 15) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT anime.id, anime.name, anime.full_name, anime.description, anime.picture, anime.kitsu_id, anime.type, anime.age_group, anime.release_date, anime.score FROM anime ORDER BY RAND() LIMIT :limit;");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute(); 
    $results = $stmt->fetchAll(PDO::FETCH_NUM);
    if ($results) {
      $animes = [];
      foreach ($results as $result) {
        $anime = new Anime($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
        array_push($animes, $anime);
      }
      return $animes;
    }
    return null;
  }

  public static function getSimilar($animeId, $limit = 15) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT anime.id, anime.name, anime.full_name, anime.description, anime.picture, anime.kitsu_id, anime.type, anime.age_group, anime.release_date, anime.score FROM anime_genre JOIN anime ON anime.id = anime_genre.anime_id WHERE anime_genre.genre_id IN (SELECT anime_genre.genre_id FROM anime_genre WHERE anime_genre.anime_id = :animeId) GROUP BY anime.id ORDER BY RAND() LIMIT :limit;");
    $stmt->bindValue(':animeId', $animeId, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute(); 
    $results = $stmt->fetchAll(PDO::FETCH_NUM);
    if ($results) {
      $animes = [];
      foreach ($results as $result) {
        $anime = new Anime($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
        array_push($animes, $anime);
      }
      return $animes;
    }
    return null;
  }

  public static function getRecommended($accountId, $limit = 15) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT anime.id, anime.name, anime.full_name, anime.description, anime.picture, anime.kitsu_id, anime.type, anime.age_group, anime.release_date, anime.score FROM anime_genre JOIN anime ON anime.id = anime_genre.anime_id WHERE anime_genre.genre_id IN (SELECT anime_genre.genre_id FROM already_watched JOIN anime_genre ON anime_genre.anime_id = already_watched.anime_id WHERE already_watched.account_id = :accountId) GROUP BY anime.id ORDER BY RAND() LIMIT :limit;");
    $stmt->bindValue(':accountId', $accountId, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute(); 
    $results = $stmt->fetchAll(PDO::FETCH_NUM);
    if ($results) {
      $animes = [];
      foreach ($results as $result) {
        $anime = new Anime($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
        array_push($animes, $anime);
      }
      return $animes;
    }
    return null;
  }

  public static function getWatchLater($accountId, $limit = 15) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT anime.id, anime.name, anime.full_name, anime.description, anime.picture, anime.kitsu_id, anime.type, anime.age_group, anime.release_date, anime.score FROM watch_later JOIN anime ON anime.id = watch_later.anime_id WHERE watch_later.account_id = :accountId ORDER BY watch_later.creation_date LIMIT :limit;");
    $stmt->bindValue(':accountId', $accountId, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute(); 
    $results = $stmt->fetchAll(PDO::FETCH_NUM);
    if ($results) {
      $animes = [];
      foreach ($results as $result) {
        $anime = new Anime($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
        array_push($animes, $anime);
      }
      return $animes;
    }
    return null;
  }

  public static function getAlreadyWatched($accountId, $limit = 15) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT anime.id, anime.name, anime.full_name, anime.description, anime.picture, anime.kitsu_id, anime.type, anime.age_group, anime.release_date, anime.score FROM already_watched JOIN anime ON anime.id = already_watched.anime_id WHERE already_watched.account_id = :accountId ORDER BY RAND() LIMIT :limit;");
    $stmt->bindValue(':accountId', $accountId, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute(); 
    $results = $stmt->fetchAll(PDO::FETCH_NUM);
    if ($results) {
      $animes = [];
      foreach ($results as $result) {
        $anime = new Anime($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
        array_push($animes, $anime);
      }
      return $animes;
    }
    return null;
  }

}

?>