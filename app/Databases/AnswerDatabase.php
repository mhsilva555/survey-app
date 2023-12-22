<?php

namespace Survey\App\Databases;

use Survey\App\Abstracts\AbstractDatabases;
use Survey\App\Facades\Databases;

class AnswerDatabase extends AbstractDatabases
{
    public function registerTable()
    {
        Databases::newTable($this->table, [
            "answer_id INT(11) NOT NULL AUTO_INCREMENT",
            "answer_survey_id INT(11) NOT NULL",
            "answer_text VARCHAR(255) NOT NULL",
            "answer_totalvotes INT DEFAULT 0",
            "answer_image VARCHAR(255)",
            "answer_timestamp VARCHAR(255) NOT NULL",
            "PRIMARY KEY (answer_id)"
        ]);
    }
}