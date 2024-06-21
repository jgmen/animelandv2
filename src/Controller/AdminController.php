<?php

namespace Alice\Animeland\Controller;
use Alice\Animeland\Api\Elasticsearch;

class AdminController {
  public static function index() { 
    include __DIR__ .'/../View/AdminDashBoard.php' ;
  }
}
