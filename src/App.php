<?php

namespace Source;

use Source\Core\Routes;
use Source\Database\Database;

class App
{
    public function __construct()
    {
        Database::createDatabase();
        new Routes();
    }
}