<?php

namespace Survey\App\Answers;

class CreateAnswer
{
    public static function create($answer, $survey_id)
    {
        global $wpdb;
        $table = $wpdb->prefix.ANSWERS;

        $wpdb->insert($table, [
            'answer_survey_id' => $survey_id,
            'answer_text' => $answer['answer'],
            'answer_image' => $answer['image-answer-url'],
            'answer_timestamp' => date('Y-m-d H:i:s', strtotime('now'))
        ]);
    }
}