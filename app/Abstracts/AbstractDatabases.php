<?php

namespace Survey\App\Abstracts;

abstract class AbstractDatabases
{
    /**
     * @var string
     */
    public $table;

    /**
     * AbstractDatabases constructor.
     * @param string $table
     */
    public function __construct(string $table)
    {
        $this->table = $table;
    }

    /**
     * @return mixed
     */
    abstract public function registerTable();
}