<?php

namespace Survey\App\Abstracts;

/**
 * Class AbstractSingleton
 * @package Survey\App\Abstracts
 */
abstract class AbstractSingleton
{
    private static $instances = [];

    abstract function __construct();

    public static function singleton(): AbstractSingleton
    {
        $cls = static::class;

        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }
}