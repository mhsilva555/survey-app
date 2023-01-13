<?php

namespace Survey\App\Surveys;

use Carbon\Carbon;
use Survey\App\MediaUpload;

class SaveSurvey
{
    public static function question()
    {
        global $wpdb;
        $surveys = $wpdb->prefix.SURVEYS;

        $question = sanitize_text_field($_REQUEST['question']);
        $survey_image = sanitize_text_field($_REQUEST['foto-capa']);

        $survey = $wpdb->insert($surveys, [
            'survey_question' => $question,
            'survey_active' => 1,
            'survey_timestamp' => date('Y-m-d H:i:s', strtotime('now')),
            'survey_image' => $survey_image
        ]);

        if (!$survey) {
            return null;
        }

        return $wpdb->insert_id;
    }

    public static function answers(int $survey_id)
    {
        global $wpdb;
        $answers = $wpdb->prefix.ANSWERS;

        $answers_request = $_REQUEST['list_answers'] ?? null;

        foreach ($answers_request as $answer) {
            $wpdb->insert($answers, [
                'answer_survey_id' => $survey_id,
                'answer_text' => $answer['answer'],
                'answer_image' => $answer['image-answer-url'],
                'answer_timestamp' => date('Y-m-d H:i:s', strtotime('now'))
            ]);
        }
    }
}