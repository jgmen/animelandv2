<?php

namespace Alice\Animeland\Form;

use Alice\Animeland\Model\AnimeModel;
use Alice\Animeland\Model\EpisodeModel;
use Alice\Animeland\Api\JikanApi;

class Anime {
  public static function index() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
      
      $animeModel = new AnimeModel;
      $episodeModel = new EpisodeModel;
      $jikanApi = JikanApi::getInstance();

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


      $animeEpisodes = [];
      for ($i=1; $i <= $episodes; $i++) {
        array_push($animeEpisodes, $jikanApi->getAnimeEpisodeById($malId, $i));
        sleep(1);
      }


      if ($animeModel->createAnime($malId, $urlMal, $title, $titleJp, $synopsis, $episodes, $duration, $airing, $year, $rating,$score, $season, $status, $studios, $images, $type, $coverUrl, $trailerUrl, $genres)) {
        echo "anime was created \n";
        if ($episodes !== null) {
          foreach ($animeEpisodes as $ep) {
            $info = $ep['data'];
            $episodeModel->createEpisode($info['mal_id'], $info['duration'], $info['title'], $info['synopsis'], $info['aired'], $malId);
            echo "<p> $info[mal_id]: $info[title] <p/>";
          }
        }

      }
      else
        echo "error";
    }
  }
}
