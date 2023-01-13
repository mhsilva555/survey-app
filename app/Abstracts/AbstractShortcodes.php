<?php

namespace Survey\App\Abstracts;

abstract class AbstractShortcodes
{
    abstract public function __construct();

    abstract public function render($atts);
}