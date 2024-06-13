<?php

namespace Source;

use Source\Core\Routes;

class App
{
    public function __construct()
    {
        new Routes();
    }
}