<?php

namespace Survey\App\Surveys;

use Survey\App\Answers\DeleteAnswer;
use Survey\App\Answers\GetAnswers;

class DeleteSurvey
{
    public static function delete($survey_id)
    {
        global $wpdb;
        $survey = $wpdb->prefix.SURVEYS;

        $wpdb->delete($survey, ['survey_id' => $survey_id]);

        $answers = GetAnswers::all($survey_id);

        if (empty($answers)) {
            wp_send_json(null);
        }

        foreach ($answers as $answer) {
            DeleteAnswer::delete($answer->answer_id);
        }

        wp_send_json(200);
    }
}