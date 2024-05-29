<?php

namespace Alice\Animeland\Controller;

use Alice\Animeland\Model\HelloWorld;
use Alice\Animeland\Form\Auth;



class HomeController {
  public function index() {
    Auth::requireAuth();
    $model = new HelloWorld();
    $message = $model->getMessage();
    require __DIR__ . '/../View/Home.php';
  }
}
