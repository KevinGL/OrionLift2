<?php

namespace App\Services;

class RoutesManager
{
    private $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;

        $this->routes["/error/404"] = ["App\Controllers\Errors\ErrorsController", "error_404"];
        $this->routes["/error/403"] = ["App\Controllers\Errors\ErrorsController", "error_403"];
    }

    public function findController($url)
    {
        $controllerName = $this->routes[$url][0];
        $method = $this->routes[$url][1];

        if(!array_key_exists($url, $this->routes) || !class_exists($controllerName) || !method_exists($controllerName, $method))
        {
            header("Location: /error/404");
            exit();
        }

        $controller = new $controllerName();
        $controller->$method();
    }
}