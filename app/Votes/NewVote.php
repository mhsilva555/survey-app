<?php

namespace Survey\App\Votes;

use Survey\App\Answers\UpdateAnswer;
use Survey\App\Surveys\UpdateSurvey;

class NewVote
{
    public static function new()
    {
        global $wpdb;
        $table = $wpdb->prefix.VOTES;

        $nome = sanitize_text_field($_REQUEST['nome']);
        $email = sanitize_text_field($_REQUEST['email']);
        $cpf = sanitize_text_field($_REQUEST['cpf']);
        $answer_id = sanitize_text_field($_REQUEST['answer_id']);
        $survey_id = sanitize_text_field($_REQUEST['survey_id']);

        if ($cpf == '' || $nome == '' || $nome == '') {
            wp_send_json(400);
        }

        ValidateVote::cpfIsValid($cpf);
        ValidateVote::cpfExists($cpf, $survey_id);

        $wpdb->insert($table, [
            'vote_survey_id' => intval($survey_id),
            'vote_answer_id' => intval($answer_id),
            'vote_name' => $nome,
            'vote_email' => $email,
            'vote_cpf' => $cpf,
            'vote_ip' => $_SERVER['REMOTE_ADDR'],
            'vote_timestamp' => date('Y-m-d H:i:s', strtotime('now'))
        ]);

        UpdateAnswer::votes($answer_id);
        $total = UpdateSurvey::totalvotes($survey_id);

        wp_send_json($total);
    }
}