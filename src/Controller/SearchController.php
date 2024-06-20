<?php

namespace Alice\Animeland\Controller;

use Alice\Animeland\Api\Elasticsearch;

class SearchController {
  public static function index(string $search) {

    $es = new Elasticsearch;

    $results = $es->searchAnime($search);

    require __DIR__ . '/../View/Search.php';
  }
}
