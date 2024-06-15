<?php

namespace Alice\Animeland\Controller;

use Alice\Animeland\Model\AnimeModel;
use Alice\Animeland\Model\EpisodeModel;

class EpisodeController {
  public static function index ($id, $ep) {
    $episodeModel = new EpisodeModel();
    $episode = $episodeModel->getAnimeEpisodeById($id, $ep);

    $animeModel = new AnimeModel();
    $anime = $animeModel->getAnimeById($id);

    require __DIR__ . '/../View/Episode.php';
  }
}
