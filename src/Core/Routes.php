<?php

namespace Source\Core;
use CoffeeCode\Router\Router;
use Source\Routes\All;

class Routes
{
    function __construct()
    {
        $router = new Router(BASE_URL);
        $router->namespace("Source\\Controller");

        new All($router);
        
        $router->dispatch();

        if ($router->error()) {
            $router->redirect("error");
        }
    }
}