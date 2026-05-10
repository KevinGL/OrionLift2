<?php

$routes =
[
    "/" => ["App\Controllers\Home\HomeController", "index"],
    "/login" => ["App\Controllers\Home\HomeController", "login"],
    "/dashboard" => ["App\Controllers\Home\HomeController", "dashboard"],
    "/dashboard_admin" => ["App\Controllers\Home\HomeController", "dashboardAdmin"],
    "/logout" => ["App\Controllers\Home\HomeController", "logout"],
    "/teams" => ["App\Controllers\Team\TeamController", "index"],
    "/teams/add" => ["App\Controllers\Team\TeamController", "add"]
];