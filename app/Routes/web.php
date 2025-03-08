<?php

/** @var Phroute\Phroute\RouteCollector $route */

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Core\Asset\Asset;

$route->get('/', [HomeController::class, 'index']);
$route->get('/profile', [HomeController::class, 'profile']);
$route->get('/courses', [HomeController::class, 'courses']);
$route->get('/courses/{id}', [HomeController::class, 'courseDetail']);
$route->any('/login', [AuthController::class, 'login']);
$route->any('/forgot-password', [AuthController::class, 'forgotPassword']);
$route->any('/password/reset/{token}', [AuthController::class, 'resetPassword']);

// Route for serving images ( DON'T REMOVE THIS LINE )
$route->get('/assets/uploads/{fileName}', function ($fileName) {
  Asset::downloadImage($fileName);
});
