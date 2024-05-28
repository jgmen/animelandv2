<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Alice\Animeland\Controller\HomeController;
use Alice\Animeland\Database\Database;

$connection = new Database();
$connection->connect();

$controller = new HomeController();
$controller->index();




