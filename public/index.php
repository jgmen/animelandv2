<?php
// Autoload
require_once __DIR__ . '/../vendor/autoload.php';

// Migration
require '../src/Migration.php';

// Routes
require '../src/Controller/Controller.php';

use Alice\Animeland\Api\Elasticsearch;

// $es = new Elasticsearch();
// $es->animeIndex();
// $searchResults = $es->searchAnime('kono');

// // Formatação dos resultados para exibição no navegador
// $formattedResults = array_map(function($hit) {
//     return $hit['_source']['title'];
// }, $searchResults);

// // Exibir resultados no navegador
// echo implode(', ', $formattedResults);
