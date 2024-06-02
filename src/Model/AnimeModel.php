<?php

namespace Alice\Animeland\Model;

use Alice\Animeland\Database\Database;
use PDO;
use PDOException;

class AnimeModel {


  private $db;
  private PDO $conn;
  private $table = 'anime';

  public function __construct() {
    $this->db = new Database();
    $this->db->connect();
    $this->conn = $this->db->getConn();
  }

  public function createAnime($title, $description, $release_date, $studio, $age_rating, $status, $cover_url, $trailer_url) {

    try {
      $query = 'INSERT INTO ' . $this->table .
      ' (title, description, release_date, studio, age_rating, status, cover_url, trailer_url)' .
      ' VALUES (:title, :description, :release_date, :studio, :age_rating, :status, :cover_url, :trailer_url)';
      
      $stmt = $this->conn->prepare($query);

      // Clean Data
      $title = htmlspecialchars(strip_tags($title));
      $description = htmlspecialchars(strip_tags($description));
      $release_date = htmlspecialchars(strip_tags($release_date));
      $studio = htmlspecialchars(strip_tags($studio));
      $age_rating = htmlspecialchars(strip_tags($age_rating));
      $status = htmlspecialchars(strip_tags($status));
      $cover_url = htmlspecialchars(strip_tags($cover_url));
      $trailer_url = htmlspecialchars(strip_tags($trailer_url));

      // Bind
      $stmt->bindParam(':title', $title);
      $stmt->bindParam(':description', $description);
      $stmt->bindParam(':release_date', $release_date);
      $stmt->bindParam(':studio', $studio);
      $stmt->bindParam(':age_rating', $age_rating);
      $stmt->bindParam(':status', $status);
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
      $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
      echo "error: $e";
    }
  }

  public static function teste() {
    echo "teste";
  }
}

