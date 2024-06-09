<?php
// Autoload
require_once __DIR__ . '/../vendor/autoload.php';

use Alice\Animeland\Api\CrunchyApi;

CrunchyApi::Download("GRDQPM1ZY/alone-and-lonesome");

// Migration
require '../src/Migration.php';

// Routes
require '../src/Controller/Controller.php';
