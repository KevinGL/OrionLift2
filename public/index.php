<?php

include "../vendor/autoload.php";
include "../src/Routes/web.php";

use App\Services\RoutesManager;

$routesManager = new RoutesManager($routes);
$routesManager->findController($_SERVER["REQUEST_URI"]);