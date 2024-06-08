<?php

namespace Alice\Animeland\Controller;

use Alice\Animeland\Core\Ralts;
use Alice\Animeland\Controller\HomeController;
use Alice\Animeland\Controller\SignupController;
use Alice\Animeland\Form\SignupHandler;
use Alice\Animeland\Controller\LoginController;
use Alice\Animeland\Form\Authenticate;
use Alice\Animeland\Controller\TestRouter;


Ralts::get('/anime', fn() => HomeController::index());
Ralts::get('/anime/(:num)', fn($id) => TestRouter::index($id));
Ralts::get('/signup', fn() => SignupController::index());
Ralts::get('/login', fn() => LoginController::index());
Ralts::get('/teste/(:num)', fn($id) => TestRouter::index($id));

// Form Handles
Ralts::post('/signup', fn() => SignupHandler::index());
Ralts::post('/login', fn() => Authenticate::index());


Ralts::dispatch();
