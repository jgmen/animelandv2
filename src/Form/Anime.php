<?php

namespace Alice\Animeland\Form;

use Alice\Animeland\Model\AnimeModel;

class Anime {
  public static function index() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
      
      $animeModel = new AnimeModel;

      $malId = isset($_POST['mal_id']) ? $_POST['mal_id'] : '';
      $title = isset($_POST['title']) ? $_POST['title'] : '';
      $urlMal = isset($_POST['url']) ? $_POST['url'] : '';
      $titleJp = isset($_POST['title_japanese']) ? $_POST['title_japanese'] : '';
      $synopsis = isset($_POST['synopsis']) ? $_POST['synopsis'] : '';
      $episodes = isset($_POST['episodes']) ? $_POST['episodes'] : '';
      $duration = isset($_POST['duration']) ? $_POST['duration'] : '';
      $airing = isset($_POST['answer']) ? ($_POST['answer'] == 'true' ? 1 : 0) : 0;
      $year = isset($_POST['year']) ? $_POST['year'] : '';
      $rating = isset($_POST['rating']) ? $_POST['rating'] : '';
      $score = isset($_POST['score']) ? $_POST['score'] : '';
      $season = isset($_POST['season']) ? $_POST['season'] : '';
      $status = isset($_POST['status']) ? $_POST['status'] : '';
      $studios = json_encode(isset($_POST['studios']) ? $_POST['studios'] : []);
      $images = json_encode(isset($_POST['images']) ? $_POST['images'] : []);
      $type = isset($_POST['mal_id']) ? $_POST['type'] : '';
      $coverUrl = isset($_POST['cover_url']) ? $_POST['cover_url'] : '';
      $trailerUrl = isset($_POST['trailer_url']) ? $_POST['trailer_url'] : '';
      $genres = json_encode(isset($_POST['genres']) ? $_POST['genres'] : []);  

      $animeModel = new AnimeModel;

      $malId = isset($_POST['mal_id']) ? $_POST['mal_id'] : '';
      $title = isset($_POST['title']) ? $_POST['title'] : '';
      $urlMal = isset($_POST['url']) ? $_POST['url'] : '';
      $titleJp = isset($_POST['title_japanese']) ? $_POST['title_japanese'] : '';
      $synopsis = isset($_POST['synopsis']) ? $_POST['synopsis'] : '';
      $episodes = isset($_POST['episodes']) ? $_POST['episodes'] : '';
      $duration = isset($_POST['duration']) ? $_POST['duration'] : '';
      $airing = isset($_POST['answer']) ? ($_POST['answer'] == 'true' ? 1 : 0) : 0;
      $year = isset($_POST['year']) ? $_POST['year'] : '';
      $rating = isset($_POST['rating']) ? $_POST['rating'] : '';
      $score = isset($_POST['score']) ? $_POST['score'] : '';
      $season = isset($_POST['season']) ? $_POST['season'] : '';
      $status = isset($_POST['status']) ? $_POST['status'] : '';
      $studios = (isset($_POST['studios']) ? $_POST['studios'] : []);
      $images = (isset($_POST['images']) ? $_POST['images'] : []);
      $type = isset($_POST['mal_id']) ? $_POST['type'] : '';
      $coverUrl = isset($_POST['cover_url']) ? $_POST['cover_url'] : '';
      $trailerUrl = isset($_POST['trailer_url']) ? $_POST['trailer_url'] : '';
      $genres = (isset($_POST['genres']) ? $_POST['genres'] : []);  

      if ($animeModel->createAnime($malId, $urlMal, $title, $titleJp, $synopsis, $episodes, $duration, $airing, $year, $rating,$score, $season, $status, $studios, $images, $type, $coverUrl, $trailerUrl, $genres))
        echo "ok";
      else
        echo "error";
    }
  }
}
