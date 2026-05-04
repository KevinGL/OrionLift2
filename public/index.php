<?php

include "../vendor/autoload.php";
include "../src/Routes/web.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

use App\Services\RoutesManager;
use App\Services\DatabaseManager;

session_start();

$dbManager = new DatabaseManager();

$routesManager = new RoutesManager($routes);
$routesManager->findController($_SERVER["REQUEST_URI"]);