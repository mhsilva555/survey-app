<?php

namespace Survey\App\Surveys;

use Survey\App\Facades\View;

class GetSurveyResult
{
    public static function get()
    {
        global $wpdb;
        $table = $wpdb->prefix.ANSWERS;
        $survey_id = sanitize_text_field($_REQUEST['survey_id']) ?? null;

        if (!$survey_id) {
            wp_send_json(null);
        }

        $results = $wpdb->get_results("SELECT * FROM {$table} WHERE answer_survey_id = '{$survey_id}' ORDER BY answer_totalvotes DESC", OBJECT);

        View::render('partials.survey-results', ['results' => $results]);
    }
}