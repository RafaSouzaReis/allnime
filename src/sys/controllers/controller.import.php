<?php

useModel('anime');
useModel('manga');

class Controller extends BaseController {
  
  public function process() {
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
    }
  }
}

?>