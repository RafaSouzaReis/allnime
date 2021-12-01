<?php

useModel('anime');
useModel('manga');

class Controller extends BaseController {
  
  public function process() {
    if (isset($_POST['search'])) {
      $search = $_POST['search'];
      $response = [
        'results' => []
      ];
      $animes = Anime::getByName($search, 3);
      if ($animes) {
        foreach ($animes as $result) {
          array_push($response['results'], [
            'id' => $result->getId(),
            'name' => $result->getName(),
            'picture' => $result->getPicture(),
            'type' => 0,
          ]);
        }
      }
      $mangas = Manga::getByName($search, 3);
      if ($mangas) {
        foreach ($mangas as $result) {
          array_push($response['results'], [
            'id' => $result->getId(),
            'name' => $result->getName(),
            'picture' => $result->getPicture(),
            'type' => 1,
          ]);
        }
      }
      print(json_encode($response));
    } else {
      print('{"results":[]}');
    }
  }
}

?>