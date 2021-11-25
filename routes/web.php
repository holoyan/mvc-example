<?php

$route = new \Core\Route();

use App\Http\Controllers\UserController;

$route->get('home/{id}', [UserController::class, 'home']);
$route->get('/profile', [UserController::class, 'getProfile']);
$route->get('home/{id}/foo', [UserController::class, 'foo']);
$route->get('foo/{id}/bar/{name}', [UserController::class, 'fooBar']);
$route->get('/dashboard', [UserController::class, 'dashboard']);

$route->post('/user', [UserController::class, 'store']);

$route->get('/', [UserController::class, 'getProfile']);

return $route;