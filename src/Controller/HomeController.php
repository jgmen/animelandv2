<?php

namespace Alice\Animeland\Controller;

use Alice\Animeland\Form\Auth;

class HomeController {
  public function index() {
    Auth::requireAuth();

    require __DIR__ . '/../View/Home.php';
  }
}
