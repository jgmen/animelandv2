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

  public function createAnime($mal_id, $url, $title, $title_japanese, $synopsis, $episodes, $duration, $airing, $year, $rating, $studio, $score, $season, $status, $studios, $images, $type, $cover_url, $trailer_url) {

    try {
      $query = 'INSERT INTO ' . $this->table .
      ' (mal_id, url, title, title_japanese, synopsis, episodes, duration, airing, year, rating, studio, score, season, status, studios, images, type, cover_url, trailer_url)' .
      ' VALUES (:mal_id, :url, :title, :title_japanese, :synopsis, :episodes, :duration, :airing, :year, :rating, :studio, :score, :season, :status, :studios, :images, :type, :cover_url, :trailer_url)';
      
      $stmt = $this->conn->prepare($query);

      // Clean Data
      $mal_id = htmlspecialchars(strip_tags($mal_id));
      $url = htmlspecialchars(strip_tags($url));
      $title = htmlspecialchars(strip_tags($title));
      $title_japanese = htmlspecialchars(strip_tags($title_japanese));
      $synopsis = htmlspecialchars(strip_tags($synopsis));
      $episodes = htmlspecialchars(strip_tags($episodes));
      $duration = htmlspecialchars(strip_tags($duration));
      $airing = htmlspecialchars(strip_tags($airing));
      $year = htmlspecialchars(strip_tags($year));
      $rating = htmlspecialchars(strip_tags($rating));
      $studio = htmlspecialchars(strip_tags($studio));
      $score = htmlspecialchars(strip_tags($score));
      $season = htmlspecialchars(strip_tags($season));
      $status = htmlspecialchars(strip_tags($status));
      $studios = htmlspecialchars(strip_tags($studios));
      $images = htmlspecialchars(strip_tags($images));
      $type = htmlspecialchars(strip_tags($type));
      $cover_url = htmlspecialchars(strip_tags($cover_url));
      $trailer_url = htmlspecialchars(strip_tags($trailer_url));

      // Bind
      $stmt->bindParam(':mal_id', $mal_id);
      $stmt->bindParam(':url', $url);
      $stmt->bindParam(':title', $title);
      $stmt->bindParam(':title_japanese', $title_japanese);
      $stmt->bindParam(':synopsis', $synopsis);
      $stmt->bindParam(':episodes', $episodes);
      $stmt->bindParam(':duration', $duration);
      $stmt->bindParam(':airing', $airing, PDO::PARAM_BOOL);
      $stmt->bindParam(':year', $year);
      $stmt->bindParam(':rating', $rating);
      $stmt->bindParam(':studio', $studio);
      $stmt->bindParam(':score', $score);
      $stmt->bindParam(':season', $season);
      $stmt->bindParam(':status', $status);
      $stmt->bindParam(':studios', $studios, PDO::PARAM_STR);
      $stmt->bindParam(':images', $images, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type);
      $stmt->bindParam(':cover_url', $cover_url);
      $stmt->bindParam(':trailer_url', $trailer_url);

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
