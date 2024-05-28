<?php

namespace Alice\Animeland\Database;

use PDO;
use PDOException;

class Database {
  private $host;
  private $db_name;
  private $username;
  private $password;
  private $conn;

  public function __construct() {
    $this->host = getenv('DB_HOST');
    $this->username = getenv('DB_USERNAME');
    $this->password = getenv('DB_PASSWORD');
    $this->db_name = getenv('DB_DATABASE');
  }

  public function connect() {
    $connString = "pgsql:host={$this->host};dbname={$this->db_name}";
    $this->conn = null;

    try {
      $this->conn = new PDO($connString, $this->username, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Connection error: " . $e->getMessage();
    }
  }

  public function getConn() {
    if ($this->conn != null)
      return $this->conn;
    else
      return new PDOException();
  }
}
