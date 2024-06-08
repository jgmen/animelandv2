<?php

namespace Alice\Animeland\Api;

class JikanApi {
  private static $baseUrl = "https://api.jikan.moe/v4/";
  private static $instance = null;

  private function __construct() { 
  }

  private function __clone() {}

  public static function getInstance() {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  private function getRequest($endpoint) {
    $url = self::$baseUrl . $endpoint;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Content-Type: application/json'
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($httpCode == 200) {
      return json_decode($response, true);
    } else {
        return [
          'error' => 'Request failed with status code ' . $httpCode,
          'response' => $response
        ];
    }
  }

  public function getAnimeById(int $id) {
    return $this->getRequest("anime/$id");
  }

  public function getAnimeEpisodes(int $id) {
    return $this->getRequest("anime/$id/episodes");
  }
}
