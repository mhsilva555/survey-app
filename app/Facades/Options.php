<?php

namespace Survey\App\Facades;

class Options
{
    public static function get($option)
    {
        return get_option($option);
    }

    public static function update($option, $value, $autoload = true):void
    {
        update_option($option, $value, $autoload);
    }
}