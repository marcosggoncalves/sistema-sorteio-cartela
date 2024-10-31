<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . './routes.php'; 

use CooperTest\Utils\RouteConfig;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new RouteConfig($routes);
$router->resolve();
