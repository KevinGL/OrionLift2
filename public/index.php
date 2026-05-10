<?php

include "../vendor/autoload.php";
include "../src/Routes/web.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

use App\Services\RoutesManager;
use App\Services\DatabaseManager;

session_start();

if(isset($_SESSION["flash"]))
{
    echo '<div>' . $_SESSION["flash"] . '</div>';
    unset($_SESSION["flash"]);
}

$dbManager = new DatabaseManager();

$routesManager = new RoutesManager($routes);
$routesManager->findController($_SERVER["REQUEST_URI"]);