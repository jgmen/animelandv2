<?php
// Autoload
require_once __DIR__ . '/../vendor/autoload.php';

// Imports
use Alice\Animeland\Core\Router;                // Routing
use Alice\Animeland\Controller\HomeController;  // Home Controller
use Alice\Animeland\Controller\SignupController;
use Alice\Animeland\Form\SignupHandler;
use Alice\Animeland\Controller\LoginController;
use Alice\Animeland\Form\Authenticate;

// Migration
require '../src/Migration.php';

// import Controllers
$homeController = new HomeController();
$signup = new SignupController();
$logion = new LoginController();

// import Forms handles
$signupHandler = new SignupHandler();
$autenticationHandler = new Authenticate();

// Router
$router = new Router();

// Routes
$router->add('GET', '/', fn() => $homeController->index());
$router->add('GET', '/signup', fn() => $signup->index());
$router->add('GET', '/login', fn() => $logion->index());

// Form Handles
$router->add('POST', '/signup', fn() => $signupHandler->index());
$router->add('POST', '/login', fn() => $autenticationHandler->index());

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$router->dispatch($requestUri, $requestMethod);

