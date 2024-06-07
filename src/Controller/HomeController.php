<?php

namespace Alice\Animeland\Controller;

use Alice\Animeland\Form\Auth;
use Alice\Animeland\Model\AnimeModel;

class HomeController {
  public static function index() {
    Auth::requireAuth();


    $animeModel = new AnimeModel();

    $animes = $animeModel->getAll();
       
    require __DIR__ . '/../View/Home.php';
  }
}
