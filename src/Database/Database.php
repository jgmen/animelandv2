<?php

namespace Alice\Animeland\Database;

use PDO;
use PDOException;

class Database {
  private $host;
  private $db_name;
  private $username;
  private $password;
  private static $conn = null;

  public function __construct() {
    $this->host = getenv('DB_HOST');
    $this->username = getenv('DB_USERNAME');
    $this->password = getenv('DB_PASSWORD');
    $this->db_name = getenv('DB_DATABASE');

    $connString = "pgsql:host={$this->host};dbname={$this->db_name}";

    try {
      self::$conn = new PDO($connString, $this->username, $this->password);
      self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
  }

 public static function getConn() {
    if (self::$conn === null) {
      new self();
    }
    return self::$conn;
  }

  private function __clone() {}
  public function __wakeup() {}
}
