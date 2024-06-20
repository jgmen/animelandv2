<?php

namespace Alice\Animeland\Controller;

use Alice\Animeland\Model\AnimeModel;

class TestRouter {
  public static function index ($id) {
    $animeModel = new AnimeModel;
    $anime = $animeModel->getAnimeById($id);

    require __DIR__ . '/../View/Anime.php';
  }
}
