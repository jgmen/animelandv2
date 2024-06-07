<?php
// Autoload
require_once __DIR__ . '/../vendor/autoload.php';

// Imports
use Alice\Animeland\Core\Ralts;
use Alice\Animeland\Controller\HomeController;  // Home Controller
use Alice\Animeland\Controller\SignupController;
use Alice\Animeland\Form\SignupHandler;
use Alice\Animeland\Controller\LoginController;
use Alice\Animeland\Form\Authenticate;
use Alice\Animeland\Controller\TestRouter;

// Migration
require '../src/Migration.php';

// Routes
Ralts::get('/animes', fn() => HomeController::index());
Ralts::get('/signup', fn() => SignupController::index());
Ralts::get('/login', fn() => LoginController::index());

// Form Handles
Ralts::post('/signup', fn() => SignupHandler::index());
Ralts::post('/login', fn() => Authenticate::index());

Ralts::get('/teste/(:num)', fn($id) => TestRouter::index($id));


Ralts::dispatch();
