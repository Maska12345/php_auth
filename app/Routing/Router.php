<?php

namespace App\Routing;

class Router
{
    private $routes = [];

    public function addRoute($uri, $method, $action)
    {
        $this->routes[$uri][$method] = $action;
    }

    public function resolve($uri, $method)
    {
        if (isset($this->routes[$uri][$method])) {
            call_user_func($this->routes[$uri][$method]);
        } else {
            header("Location: /");
            exit;
        }
    }
}
