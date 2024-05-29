<?php

namespace Alice\Animeland\Form;

class Auth { 
  private static function isAuthenticated() {
    session_start();
    return isset($_SESSION['user_id']);
  }

  public static function requireAuth() {
      if (!self::isAuthenticated()) {
      echo  "You must be logged in to access this page";
      exit();
      }
  }
}
