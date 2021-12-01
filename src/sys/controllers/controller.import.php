<?php

useModel('anime');
useModel('manga');
useModel('genre');



class Controller extends BaseController {
  
  public function process() {
    $headers = $this->app->getHeaders();
    if (!isset($headers['dev-key'])) {
      exit("No dev key!");
    }
    if ($headers['dev-key'] != DEVKEY) {
      exit("Invalid dev key!");
    }
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data == null) exit("Bad request.");
    if ($data['type'] == 'anime') {
      try {
        $data = $data['data'];
        $manga = Anime::new($data['name'], $data['fullName'], $data['description'], $data['picture'], $data['kitsuId'], $data['type'], $data['ageGroup'], $data['releaseDate']);
        exit("Ok - Added");
      } catch (Exception $e) {
        exit($e->getMessage());
      }
    } else if ($data['type'] == 'manga') {
      try {
        $data = $data['data'];
        $manga = Manga::new($data['name'], $data['fullName'], $data['description'], $data['picture'], $data['kitsuId'], $data['type'], $data['ageGroup'], $data['releaseDate']);
        exit("Ok - Added");
      } catch (Exception $e) {
        exit($e->getMessage());
      }
    } else if ($data['type'] == 'genre') {
      try {
        $data = $data['data'];
        $genre = Genre::new($data['slug'], $data['name']);
        exit("Ok - Added");
      } catch (Exception $e) {
        exit($e->getMessage());
      }
    } else if ($data['type'] == 'anime-genre') {
      try {
        $data = $data['data'];
        $genre = Genre::getByName($data['slug'])[0];
        if ($genre == null) {
          exit("Failed to select genre by slug");
        }
        $anime = Anime::getByKitsuId($data['animeId']);
        if ($anime == null) {
          exit("Failed to select anime by kitsuId");
        }
        global $pdo;
        $stmt = $pdo->prepare("INSERT IGNORE INTO anime_genre (anime_id, genre_id) VALUES (?, ?);");
        $stmt->execute([$anime->getId(), $genre->getId()]);
        exit("Ok - Added");
      } catch (Exception $e) {
        exit($e->getMessage());
      }
    } else if ($data['type'] == 'manga-genre') {
      try {
        $data = $data['data'];
        $genre = Genre::getByName($data['slug'])[0];
        if ($genre == null) {
          exit("Failed to select genre by slug");
        }
        $manga = Manga::getByKitsuId($data['mangaId']);
        if ($manga == null) {
          exit("Failed to select manga by kitsuId");
        }
        global $pdo;
        $stmt = $pdo->prepare("INSERT IGNORE INTO manga_genre (manga_id, genre_id) VALUES (?, ?);");
        $stmt->execute([$manga->getId(), $genre->getId()]);
        exit("Ok - Added");
      } catch (Exception $e) {
        exit($e->getMessage());
      }
    }
  }
}

?>