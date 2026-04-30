<?php

namespace App\Services;

class RoutesManager
{
    private $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;

        $this->routes["/error/404"] = ["App\Controllers\Errors\ErrorsController", "error_404"];
    }

    public function findController($url)
    {
        $controllerName = $this->routes[$url][0];
        $method = $this->routes[$url][1];

        if(!class_exists($controllerName) || !method_exists($controllerName, $method))
        {
            header("Location: /error/404"); 
            exit();
        }

        $controller = new $controllerName();
        $controller->$method();
    }
}