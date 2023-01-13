<?php

namespace Survey\App\Surveys;

use Survey\App\Answers\UpdateAnswer;

class UpdateSurvey
{
    public static function update($survey_id)
    {
        global $wpdb;
        $table = $wpdb->prefix.SURVEYS;

        $survey_question = sanitize_text_field($_REQUEST['question']);
        $survey_image = sanitize_text_field($_REQUEST['foto-capa']);
        $survey_active = $_REQUEST['ativa'] ? 1 : 0;
        $answer_list = $_REQUEST['list_answers'];

        $wpdb->update($table, [
            'survey_question' => $survey_question,
            'survey_image' => $survey_image,
            'survey_active' => $survey_active,
        ], ['survey_id' => $survey_id]);

        UpdateAnswer::update($answer_list, $survey_id);
    }

    public static function totalvotes($survey_id)
    {
        global $wpdb;
        $table = $wpdb->prefix.SURVEYS;

        $votes = $wpdb->get_row("SELECT survey_totalvotes FROM {$table} WHERE survey_id = '{$survey_id}'", OBJECT);

        if (!$votes->survey_totalvotes) {
            $wpdb->update($table, ['survey_totalvotes' => 1], ['survey_id' => $survey_id]);
            return;
        }

        $wpdb->query("UPDATE {$table} SET survey_totalvotes = survey_totalvotes + 1 WHERE survey_id = {$survey_id}");

        return $votes->survey_totalvotes + 1;
    }
}