<?php

namespace Survey\App\Abstracts;

abstract class AbstractPagesOptions
{
    public $args;

    public function __construct()
    {
        add_action('admin_menu', [$this, 'setPageOption']);
    }

    abstract public function setPageOption();

    abstract public function callbackPageOption();
}