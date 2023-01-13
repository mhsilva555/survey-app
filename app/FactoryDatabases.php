<?php

namespace Survey\App;

use Survey\App\Abstracts\AbstractDatabases;

class FactoryDatabases
{
    public static function create(AbstractDatabases $databases)
    {
        $databases->registerTable();
    }
}