<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__.'/../autoload.php';

$request = new App\Request();
$response = new App\Response();
$router = new App\Router($request);
$container = new \App\Container();

(new App\App($request, $response, $router, $container))->run();