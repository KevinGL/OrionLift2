<?php

$routes =
[
    "/" => ["App\Controllers\Home\HomeController", "index"],
    "/login" => ["App\Controllers\Home\HomeController", "login"],
    "/dashboard" => ["App\Controllers\Home\HomeController", "dashboard"],
    "/logout" => ["App\Controllers\Home\HomeController", "logout"]
];