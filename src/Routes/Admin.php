<?php

namespace Source\Routes;
class Admin
{
    private $router;
    
    function __construct($router)
    {
        $this->router = $router;
        $this->login();
    }

    private function login()
    {
        $this->router->get("/", "Login:index", "login.index");
    }
}