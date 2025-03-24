<?php

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Routing\Router;

session_start();

$authController = new AuthController();
$homeController = new HomeController();

$router = new Router();

$router->addRoute('/register', 'GET', [$authController, 'showRegisterForm']);
$router->addRoute('/register', 'POST', [$authController, 'register']);
$router->addRoute('/login', 'GET', [$authController, 'showLoginForm']);
$router->addRoute('/login', 'POST', [$authController, 'login']);
$router->addRoute('/logout', 'GET', [$authController, 'logout']);
$router->addRoute('/', 'GET', [$homeController, 'index']);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$router->resolve($uri, $method);
