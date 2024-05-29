<?php
// Autoload
require_once __DIR__ . '/../vendor/autoload.php';

// Imports
use Alice\Animeland\Controller\FormController;
use Alice\Animeland\Database\Database;          // Database connection
use Alice\Animeland\Core\Router;                // Routing
use Alice\Animeland\Controller\HomeController;  // Home Controller
use Alice\Animeland\Form\FormHandle;

// Connect to database
$connection = new Database();
$connection->connect();

// Controllers
$homeController = new HomeController();
$formController = new FormController();

// Forms handles
$formFormHandle = new FormHandle();

// Router
$router = new Router();

$router->add('GET', '/', fn() => $homeController->index());
$router->add('GET', '/form', fn() => $formController->index());
$router->add('POST', '/forms', fn() => $formFormHandle->index());

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$router->dispatch($requestUri, $requestMethod);

