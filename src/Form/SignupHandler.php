<?php

namespace Alice\Animeland\Form;

use Alice\Animeland\Database\Database;

class SignupHandler {

  private $db;
  private $stmt;


  public function __construct() {
    $this->db = new Database();
    $this->db->connect();
    $this->stmt = $this->db->getConn();
  } 

  public function index() { 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      $password = htmlspecialchars($_POST['password']);

      // Basic Validation
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        return;
      }

      if (strlen($password) < 10) {
        echo "Password must be at least 10 characters";
        return;
      }

      // Hash password
      $hashed_password = password_hash($password, PASSWORD_BCRYPT);

      // Insertion
      $this->stmt = $this->stmt->prepare("INSERT INTO users (email, password_hash) VALUES (:email, :password)");
      $this->stmt->bindParam(':email', $email);
      $this->stmt->bindParam(':password', $hashed_password);  

      if ($this->stmt->execute()) {
        echo "Account created successfully!";
        // redirect with javascript
        echo '<meta http-equiv="refresh" content="2;url=/">';
      } else {
        echo "Error: " . $this->stmt->error;
      }

    } else
      echo "invalid request :(";
  }
}
