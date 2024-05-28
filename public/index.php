<?php

// Autoload
require_once __DIR__ . '/../vendor/autoload.php';

// Imports
use Alice\Animeland\Controller\HomeController;
use Alice\Animeland\Database\Database;
use Alice\Animeland\Core\Router;

// Connect to database
$connection = new Database();
$connection->connect();

// Routers
$homeController = new HomeController();
$router = new Router();

$router->add('GET', '/', fn() => $homeController->index());

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$router->dispatch($requestUri, $requestMethod);

