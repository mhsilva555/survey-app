<?php

namespace Survey\App\Surveys;

class GetSurveyByID
{
    public static function get($survey_id)
    {
        global $wpdb;
        $surveys = $wpdb->prefix.SURVEYS;
        $answers = $wpdb->prefix.ANSWERS;

        $survey = $wpdb->get_results("SELECT * FROM {$surveys} AS s INNER JOIN {$answers} AS a
        ON s.survey_id = a.answer_survey_id WHERE survey_id = '{$survey_id}'", OBJECT);

        return $survey;
    }
}