<?php

namespace Survey\App\Answers;

class GetAnswers
{
    public static function all($survey_id)
    {
        global $wpdb;
        $table = $wpdb->prefix.ANSWERS;

        $answers = $wpdb->get_results("SELECT * FROM {$table} WHERE answer_survey_id = {$survey_id}", OBJECT);

        return $answers;
    }
}