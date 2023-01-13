<?php

namespace Survey\App\Facades;

use Fiskhandlarn\Blade;

class View
{
    public static function render($template, $data = [])
    {
        $blade = new Blade(SURVEY_PLUGIN_PATH . '/resources/views', SURVEY_PLUGIN_PATH . '/storage/cache');
        echo $blade->render($template, $data);
    }
}