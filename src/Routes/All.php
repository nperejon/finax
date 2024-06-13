<?php

namespace Source\Routes;
class All
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
        $this->router->post("/", "Login:post", "login.post");
        $this->router->get("/logout", "Login:logout", "login.logout");

        $this->router->get("/home", "Home:index", "home.index");
        $this->router->get("/entradas", "Entries:index", "entries.index");
    }
}