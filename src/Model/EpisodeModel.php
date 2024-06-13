<?php

namespace Alice\Animeland\Model;

use Alice\Animeland\Database\Database;
use PDO;
use PDOException;

class EpisodeModel {
  private PDO $conn;
  private $table = 'episode';

  public function __construct() {
    $this->conn = Database::getConn();
  }

  public function createEpisode($mal_id, $episodeNumber, $duration, $title, $synopsis, $aired, $anime_id) {
    try {

      $query = 'INSERT INTO ' . $this->table .
      ' (mal_id , episode_number , duration, title, synopsis, aired ,anime_id )'.
      ' VALUES(:mal_id, :episode_number, :duration, :title, :synopsis, :aired, :anime_id)';

      $stmt = $this->conn->prepare($query);

       // Clean Data
      $mal_id = htmlspecialchars(strip_tags($mal_id));
      $episodeNumber = htmlspecialchars(strip_tags($episodeNumber));
      $duration = htmlspecialchars(strip_tags($duration));
      $title = htmlspecialchars(strip_tags($title));
      $synopsis = htmlspecialchars(strip_tags($synopsis));
      $aired = htmlspecialchars(strip_tags($aired));
      $anime_id = htmlspecialchars(strip_tags($anime_id));

      // Bind Parameters
      $stmt->bindParam(':mal_id', $mal_id);
      $stmt->bindParam(':episode_number', $episodeNumber);
      $stmt->bindParam(':duration', $duration);
      $stmt->bindParam(':title', $title);
      $stmt->bindParam(':synopsis', $synopsis);
      $stmt->bindParam(':aired', $aired);
      $stmt->bindParam(':anime_id', $anime_id);

      // Execute the query
      if ($stmt->execute()) {
          return true;
      } else {
          return false;
      }
    } catch (PDOException $e) {
      echo "error: $e";
    }
  }

  public function getAllByAnimeId($animeId) {
    try {
      $query = 'SELECT * FROM ' . $this->table . ' WHERE anime_id == ' . $animeId;
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo $e;
    }
  }
}
