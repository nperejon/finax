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
        $this->router->post("/entradas", "Entries:post", "entries.post");
        $this->router->get("/entrada/remove/{id}", "Entries:deleteinput", "entries.deleteinput");
        $this->router->get("/saida/remove/{id}", "Entries:deleteoutput", "entries.deleteoutput");
        $this->router->get("/moedas", "Currency:index", "currency.index");
        $this->router->get("/perfil", "Profile:index", "profile.index");
    }
}