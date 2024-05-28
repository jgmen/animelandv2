<?php

namespace Alice\Animeland\Controller;

use Alice\Animeland\Model\HelloWorld;

class HomeController {
  public function index() {
    $model = new HelloWorld();
    $message = $model->getMessage();
    require __DIR__ . '/../View/Home.php';
  }
}
