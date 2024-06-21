<?php

namespace Alice\Animeland\Controller;

use Alice\Animeland\Controller\HomeController;
use Alice\Animeland\Controller\SignupController;
use Alice\Animeland\Controller\EpisodeController;
use Alice\Animeland\Form\SignupHandler;
use Alice\Animeland\Controller\LoginController;
use Alice\Animeland\Form\Authenticate;
use Alice\Animeland\Controller\AnimeController;
use Alice\Animeland\Controller\AdminController;
use Alice\Animeland\Form\Anime;
use Alice\Animeland\Core\Macaw;

Macaw::get('/anime', fn() => HomeController::index());
Macaw::get('/anime/(:num)', fn($id) => AnimeController::index($id));
Macaw::get('/anime/(:num)/(:num)', fn($id, $ep) =>  EpisodeController::index($id, $ep));
Macaw::get('/signup', fn() => SignupController::index());
Macaw::get('/search/(:any)', fn ($search) => SearchController::index($search));
Macaw::get('/login', fn() => LoginController::index());
Macaw::get('/admin/dashboard', fn() => AdminController::index());

// Form Handles
Macaw::post('/signup', fn() => SignupHandler::index());
Macaw::post('/login', fn() => Authenticate::index());
Macaw::post('/anime', fn () => Anime::index());

Macaw::dispatch();
