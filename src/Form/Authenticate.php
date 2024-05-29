<?php

namespace Alice\Animeland\Form;

use Alice\Animeland\Database\Database;
use PDO;
use PDOException;

class Authenticate {
  public function index() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      $password = htmlspecialchars($_POST['password']);

      // Basic validation
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Use a Valid email";
      }

      try {
        
        session_start();
        
        $db = new Database();
        $db->connect();
        $conn = $db->getConn();

        // Compare user password
        $stmt = $conn->prepare("SELECT id, password_hash FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($user && password_verify($password, $user['password_hash'])) {
          echo "connect :)";
          $_SESSION['user_id'] = $user['id'];
          $_SESSION['email'] = $email;
          echo '<meta http-equiv="refresh" content="2;url=/">';
        } else {
          echo "wrong password";
          echo '<meta http-equiv="refresh" content="2;url=/">';
        }

      } catch (PDOException $e) {
        echo "error: $e";
      }
    } else {
      echo "invalid request";
    }
  }
}
