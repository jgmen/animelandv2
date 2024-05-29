<?php

namespace Alice\Animeland\Form;

class FormHandle {
  public function index() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = htmlspecialchars($_POST['name']);
      $email = htmlspecialchars($_POST['email']);

      $data = array(
      "name" => "$name",
      "email" => "$email",
      );

      echo "$name $email";
    } else
      echo "invalid request :(";
  }
}
