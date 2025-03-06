<?php

/** @var Phroute\Phroute\RouteCollector $route */

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Core\Asset\Asset;

$route->get('/', [HomeController::class, 'index']);
$route->get('/login', [AuthController::class, 'login']);

// Route for serving images ( DON'T REMOVE THIS LINE )
$route->get('/assets/uploads/{fileName}', function ($fileName) {
  Asset::downloadImage($fileName);
});
