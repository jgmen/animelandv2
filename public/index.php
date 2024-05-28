<?php

require_once __DIR__ . '/../vendor/autoload.php';
//require 'vendor/autoload.php';

use Alice\Animeland\HelloWorld;

$hello = new HelloWorld();
echo $hello->sayHello();
