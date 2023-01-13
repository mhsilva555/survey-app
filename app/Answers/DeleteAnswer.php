<?php

namespace Survey\App\Answers;

class DeleteAnswer
{
    public static function delete($answer_id)
    {
        global $wpdb;
        $table = $wpdb->prefix.ANSWERS;

        $wpdb->delete($table, ['answer_id' => $answer_id]);
    }
}