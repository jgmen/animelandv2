<?php

namespace Alice\Animeland\Api;

use Elastic\Elasticsearch\ClientBuilder;
use Alice\Animeland\Model\AnimeModel;
use Exception;

class Elasticsearch {

  private $hosts = [
      'http://elastic:root@es-container:9200'  // Use o nome do serviço Docker    
  ];

  private $client;

  public function __construct() {
    $this->client = ClientBuilder::create()->setHosts($this->hosts)->build(); 
  }

  public function animeIndex() {   
    $animeModel = new AnimeModel;
    $animes = $animeModel->getAll();

    foreach ($animes as $anime) {
      $params = [
        'index' => 'anime_index',
        'id' => $anime['mal_id'],
        'body' => [
            'mal_id' => $anime['mal_id'],
            'url' => $anime['url'],
            'title' => $anime['title'],
            'title_japanese' => $anime['title_japanese'],
            'synopsis' => $anime['synopsis'],
            'episodes' => $anime['episodes'],
            'duration' => $anime['duration'],
            'airing' => $anime['airing'],
            'year' => $anime['year'],
            'rating' => $anime['rating'],
            'score' => $anime['score'],
            'season' => $anime['season'],
            'status' => $anime['status'],
            'studios' => json_decode($anime['studios'], true),
            'images' => json_decode($anime['images'], true),
            'type' => $anime['type'],
            'cover_url' => $anime['cover_url'],
            'trailer_url' => $anime['trailer_url'],
          'genres' => json_decode($anime['genres'], true)
        ]
      ];
        $response = $this->client->index($params);
    }
  }
  
  public function searchAnime($query) {
    $params = [
      'index' => 'anime_index',
      'body'  => [
        'query' => [
          'match' => [
            'title' => $query
          ]
        ]
      ]
    ];

    try {
      $response = $this->client->search($params);
      return $response['hits']['hits'];
    } catch (Exception $e) {
      echo 'Error searching: ', $e->getMessage(), "\n";
      return [];
    }
  }

}
