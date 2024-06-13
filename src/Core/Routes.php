<?php

namespace Source\Core;
use CoffeeCode\Router\Router;
use Source\Routes\Admin;

class Routes
{
    function __construct()
    {

        $router = new Router(BASE_URL);
        $router->namespace("Source\\Controller");

        new Admin($router);
        
        $router->dispatch();

        if ($router->error()) {
            $router->redirect("error");
        }
    }
}