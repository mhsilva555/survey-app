<?php

namespace Survey\App\Databases;

use Survey\App\Abstracts\AbstractDatabases;
use Survey\App\Facades\Databases;

class SurveysDatabase extends AbstractDatabases
{
    public function registerTable()
    {
        Databases::newTable($this->table, [
            "survey_id INT(11) NOT NULL AUTO_INCREMENT",
            "survey_question VARCHAR(255) NOT NULL",
            "survey_active INT(1) NOT NULL",
            "survey_timestamp VARCHAR(255) NOT NULL",
            "survey_totalvotes INT",
            "survey_image VARCHAR(255)",
            "PRIMARY KEY (survey_id)"
        ]);
    }
}