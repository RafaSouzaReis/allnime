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
      $anime = new Anime($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
      return $anime;
    }
    return null;
  }

  public static function getByName($name, $limit = 1) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, name, full_name, description, picture, kitsu_id, type, age_group, release_date, score FROM manga WHERE name LIKE :name LIMIT :limit;");
    $stmt->bindValue(':name', '%' . $name . '%', PDO::PARAM_STR);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute([$id]); 
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