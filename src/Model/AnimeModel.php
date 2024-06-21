<?php

namespace Alice\Animeland\Model;

use Alice\Animeland\Database\Database;
use PDO;
use PDOException;

class AnimeModel {
  private PDO $conn;
  private string $table = 'anime';

  public function __construct() {
    $this->conn = Database::getConn();
  }

  private function sanitize($data): string {
    return htmlspecialchars(strip_tags($data));
  }

  private function validateBoolean($data): bool {
    return filter_var($data, FILTER_VALIDATE_BOOLEAN);
  }

  public function createAnime(
    $mal_id = null, 
    $url = '', 
    $title = '', 
    $title_japanese = '', 
    $synopsis = '', 
    $episodes = 0, 
    $duration = '', 
    $airing = false, 
    $year = 0, 
    $rating = '', 
    $score = 0.0, 
    $season = '', 
    $status = '', 
    $studios = [], 
    $images = [], 
    $type = '', 
    $cover_url = '', 
    $trailer_url = '', 
    $genres = [])
    : bool {
    try {

      if ($this->animeExists($mal_id) == true) {
        echo "anime already exists \n";
        throw new PDOException;
        return false;
      }


      $query = 'INSERT INTO ' . $this->table .
      ' (mal_id, url, title, title_japanese, synopsis, episodes, duration, airing, year, rating, score, season, status, studios, images, type, cover_url, trailer_url, genres)' .
      ' VALUES (:mal_id, :url, :title, :title_japanese, :synopsis, :episodes, :duration, :airing, :year, :rating, :score, :season, :status, :studios, :images, :type, :cover_url, :trailer_url, :genres)';

      $stmt = $this->conn->prepare($query);

      // Sanitize and store values in variables
      $urlSanitized = $this->sanitize($url);
      $titleSanitized = $this->sanitize($title);
      $titleJapaneseSanitized = $this->sanitize($title_japanese);
      $synopsisSanitized = $this->sanitize($synopsis);
      $durationSanitized = $this->sanitize($duration);
      $ratingSanitized = $this->sanitize($rating);
      $seasonSanitized = $this->sanitize($season);
      $statusSanitized = $this->sanitize($status);
      $typeSanitized = $this->sanitize($type);
      $coverUrlSanitized = $this->sanitize($cover_url);
      $trailerUrlSanitized = $this->sanitize($trailer_url);

      // Sanitize and Encode Data
      $studiosJson = json_encode($studios);
      $imagesJson = json_encode($images);
      $genresJson = json_encode($genres);

      // Bind parameters using variables
      $stmt->bindParam(':mal_id', $mal_id, PDO::PARAM_INT);
      $stmt->bindParam(':url', $urlSanitized, PDO::PARAM_STR);
      $stmt->bindParam(':title', $titleSanitized, PDO::PARAM_STR);
      $stmt->bindParam(':title_japanese', $titleJapaneseSanitized, PDO::PARAM_STR);
      $stmt->bindParam(':synopsis', $synopsisSanitized, PDO::PARAM_STR);
      $stmt->bindParam(':episodes', $episodes, PDO::PARAM_INT);
      $stmt->bindParam(':duration', $durationSanitized, PDO::PARAM_STR);
      $stmt->bindParam(':airing', $airing, PDO::PARAM_BOOL);
      $stmt->bindParam(':year', $year, PDO::PARAM_INT); // Use $year directly, since it's already an integer
      $stmt->bindParam(':rating', $ratingSanitized, PDO::PARAM_STR);
      $stmt->bindParam(':score', $score, PDO::PARAM_STR);
      $stmt->bindParam(':season', $seasonSanitized, PDO::PARAM_STR);
      $stmt->bindParam(':status', $statusSanitized, PDO::PARAM_STR);
      $stmt->bindParam(':studios', $studiosJson, PDO::PARAM_STR);
      $stmt->bindParam(':images', $imagesJson, PDO::PARAM_STR);
      $stmt->bindParam(':type', $typeSanitized, PDO::PARAM_STR);
      $stmt->bindParam(':cover_url', $coverUrlSanitized, PDO::PARAM_STR);
      $stmt->bindParam(':trailer_url', $trailerUrlSanitized, PDO::PARAM_STR);
      $stmt->bindParam(':genres', $genresJson, PDO::PARAM_STR);

      return $stmt->execute();
    } catch (PDOException $e) {
      return false;
    }
  }

  public function getAll(): array {
    try {
      $query = "SELECT * FROM $this->table";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return [];
    }
  }

  public function getAnimeById(int $id): ?array {
    try {
      $query = 'SELECT * FROM ' . $this->table . ' WHERE mal_id = :mal_id';
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':mal_id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    } catch(PDOException $e) {
      return null;
    }
  }

  public function updateAnime(
    int $mal_id,
    array $updateData
): bool {
    try {
        if (!$this->animeExists($mal_id)) {
          return false;
        }

        $setClause = [];
        foreach ($updateData as $key => $value) {
            switch ($key) {
                case 'url':
                case 'title':
                case 'title_japanese':
                case 'synopsis':
                case 'duration':
                case 'rating':
                case 'season':
                case 'status':
                case 'type':
                case 'cover_url':
                case 'trailer_url':
                    $setClause[] = "$key = :$key";
                    break;
                case 'episodes':
                case 'year':
                    $setClause[] = "$key = :$key";
                    break;
                case 'airing':
                    $setClause[] = "airing = :airing";
                    break;
                case 'score':
                    $setClause[] = "score = :score";
                    break;
                case 'studios':
                case 'images':
                case 'genres':
                    $setClause[] = "$key = :$key";
                    $value = json_encode($value);
                    break;
                default:
                  break;
            }
        }

        $query = 'UPDATE ' . $this->table .
            ' SET ' . implode(', ', $setClause) .
            ' WHERE mal_id = :mal_id';

        $stmt = $this->conn->prepare($query);

        // Bind Parameters
        foreach ($updateData as $key => &$value) {
            switch ($key) {
                case 'airing':
                    $stmt->bindParam(':airing', $value, PDO::PARAM_BOOL);
                    break;
                case 'score':
                case 'episodes':
                case 'year':
                    $stmt->bindParam(":$key", $value, PDO::PARAM_INT);
                    break;
                default:
                    $stmt->bindParam(":$key", $value, PDO::PARAM_STR);
                    break;
            }
        }

        // Bind mal_id parameter
        $stmt->bindParam(':mal_id', $mal_id, PDO::PARAM_INT);

        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
        return false;
    }
  }

  private function animeExists(int $mal_id): bool {
    $query = 'SELECT COUNT(*) FROM ' . $this->table . ' WHERE mal_id = :mal_id';
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':mal_id', $mal_id, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    return $count > 0;
  }
}
