<?php

namespace Survey\App\Databases;

use Survey\App\Abstracts\AbstractDatabases;
use Survey\App\Facades\Databases;

class VotesDatabase extends AbstractDatabases
{
    public function registerTable()
    {
        Databases::newTable($this->table, [
            "vote_id INT(11) NOT NULL AUTO_INCREMENT",
            "vote_survey_id INT(11) NOT NULL",
            "vote_answer_id INT(11) NOT NULL",
            "vote_name VARCHAR(150) NOT NULL",
            "vote_email VARCHAR(150) NOT NULL",
            "vote_cpf VARCHAR(20) NOT NULL",
            "vote_ip VARCHAR(30) NOT NULL",
            "vote_timestamp VARCHAR(255) NOT NULL",
            "PRIMARY KEY (vote_id)"
        ]);
    }
}