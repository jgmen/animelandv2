<?php

namespace Alice\Animeland\Model;

use Alice\Animeland\Database\Database;
use PDO;
use PDOException;

class AnimeModel {

  private PDO $conn;
  private $table = 'anime';

  public function __construct() {
    $this->conn = Database::getConn();
  }

  public function createAnime($mal_id, $url, $title, $title_japanese, $synopsis, $episodes, $duration, $airing, $year, $rating, $score, $season, $status, $studios, $images, $type, $cover_url, $trailer_url, $genres) {
    try {
      $query = 'INSERT INTO ' . $this->table .
      ' (mal_id, url, title, title_japanese, synopsis, episodes, duration, airing, year, rating, score, season, status, studios, images, type, cover_url, trailer_url, genres)' .
      ' VALUES (:mal_id, :url, :title, :title_japanese, :synopsis, :episodes, :duration, :airing, :year, :rating, :score, :season, :status, :studios, :images, :type, :cover_url, :trailer_url, :genres)';
      
      $stmt = $this->conn->prepare($query);

      // Clean Data
      $mal_id = htmlspecialchars(strip_tags($mal_id));
      $url = htmlspecialchars(strip_tags($url));
      $title = htmlspecialchars(strip_tags($title));
      $title_japanese = htmlspecialchars(strip_tags($title_japanese));
      $synopsis = htmlspecialchars(strip_tags($synopsis));
      $episodes = htmlspecialchars(strip_tags($episodes));
      $duration = htmlspecialchars(strip_tags($duration));
      $airing = filter_var($airing, FILTER_VALIDATE_BOOLEAN);
      $year = htmlspecialchars(strip_tags($year));
      $rating = htmlspecialchars(strip_tags($rating));
      $score = htmlspecialchars(strip_tags($score));
      $season = htmlspecialchars(strip_tags($season));
      $status = htmlspecialchars(strip_tags($status));
      $studios = json_encode($studios);
      $images = json_encode($images);
      $type = htmlspecialchars(strip_tags($type));
      $cover_url = htmlspecialchars(strip_tags($cover_url));
      $trailer_url = htmlspecialchars(strip_tags($trailer_url));
      $genres = json_encode($genres);

      // Bind
      $stmt->bindParam(':mal_id', $mal_id, PDO::PARAM_INT);
      $stmt->bindParam(':url', $url, PDO::PARAM_STR);
      $stmt->bindParam(':title', $title, PDO::PARAM_STR);
      $stmt->bindParam(':title_japanese', $title_japanese, PDO::PARAM_STR);
      $stmt->bindParam(':synopsis', $synopsis, PDO::PARAM_STR);
      $stmt->bindParam(':episodes', $episodes, PDO::PARAM_INT);
      $stmt->bindParam(':duration', $duration, PDO::PARAM_STR);
      $stmt->bindParam(':airing', $airing, PDO::PARAM_BOOL);
      $stmt->bindParam(':year', $year, PDO::PARAM_INT);
      $stmt->bindParam(':rating', $rating, PDO::PARAM_STR);
      $stmt->bindParam(':score', $score, PDO::PARAM_STR);
      $stmt->bindParam(':season', $season, PDO::PARAM_STR);
      $stmt->bindParam(':status', $status, PDO::PARAM_STR);
      $stmt->bindParam(':studios', $studios, PDO::PARAM_STR);
      $stmt->bindParam(':images', $images, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
      $stmt->bindParam(':cover_url', $cover_url, PDO::PARAM_STR);
      $stmt->bindParam(':trailer_url', $trailer_url, PDO::PARAM_STR);
      $stmt->bindParam(':genres', $genres, PDO::PARAM_STR);

      if($stmt->execute())
        return true;
      else 
        return false;
    } catch (PDOException $e) {
      echo "error: $e";
      return false;
    }
  }

  public function getAll() {
    try {
      $query = "SELECT * FROM $this->table";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "error: $e";
    }
  }

  public function getAnimeById(int $id) {
    try {
      $query = 'SELECT * FROM ' . $this->table . ' WHERE mal_id = :mal_id';
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':mal_id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
      echo "error: $e";
    }
  }
}
