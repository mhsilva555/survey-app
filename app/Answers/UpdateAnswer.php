<?php

namespace Survey\App\Answers;

class UpdateAnswer
{
    public static function update($answers, $survey_id)
    {
        if (empty($answers)) {
            return null;
        }

        global $wpdb;
        $table = $wpdb->prefix.ANSWERS;

        if ($_REQUEST['answers_exclude'] != "") {
            $excludes = explode(",", $_REQUEST['answers_exclude']);

            foreach ($excludes as $exclude) {
                DeleteAnswer::delete($exclude);
            }
        }

        foreach ($answers as $answer) {
            if ($answer['answer_id'] == '') {
                CreateAnswer::create($answer, $survey_id);
            }

            $data = [
                'answer_text' => $answer['answer'],
                'answer_image' => $answer['image-answer-url'],
                'answer_totalvotes' => $answer['total_votes_answer']
            ];

            $wpdb->update($table, $data, ['answer_id' => $answer['answer_id']]);
        }

        wp_send_json($survey_id);
    }

    public static function votes($answer_id)
    {
        global $wpdb;
        $table = $wpdb->prefix.ANSWERS;

        $votes = $wpdb->get_row("SELECT answer_totalvotes FROM {$table} WHERE answer_id = '{$answer_id}'", OBJECT);

        if (!$votes->answer_totalvotes) {
            $wpdb->update($table, ['answer_totalvotes' => 1], ['answer_id' => $answer_id]);
            return;
        }

        $wpdb->query("UPDATE {$table} SET answer_totalvotes = answer_totalvotes + 1 WHERE answer_id = {$answer_id}");
    }
}