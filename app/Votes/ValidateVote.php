<?php

namespace Survey\App\Votes;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
use Egulias\EmailValidator\Validation\RFCValidation;

class ValidateVote
{
    public static function cpfExists($cpf, $survey_id)
    {
        global $wpdb;
        $table = $wpdb->prefix.VOTES;

        $result = $wpdb->get_row("SELECT * FROM {$table} WHERE vote_cpf = '{$cpf}' AND vote_survey_id = '{$survey_id}'", OBJECT);

        if ($result) {
            wp_send_json(403);
        }
    }

    public static function cpfIsValid($cpf)
    {
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        if (strlen($cpf) != 11) {
            wp_send_json(401);
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            wp_send_json(401);
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                wp_send_json(401);
            }
        }
    }

    public static function emailIsValid($email)
    {
        $validator = new EmailValidator();
        $multipleValidations = new MultipleValidationWithAnd([
            new RFCValidation(),
            new DNSCheckValidation()
        ]);
        $response = $validator->isValid($email, $multipleValidations);

        if (!$response) {
            wp_send_json(401);
        }
    }

    public static function emailExists($email, $survey_id)
    {
        global $wpdb;
        $table = $wpdb->prefix.VOTES;

        $result = $wpdb->get_row("SELECT vote_email FROM {$table} WHERE vote_email = '{$email}' AND vote_survey_id = '{$survey_id}'", OBJECT);

        if ($result) {
            wp_send_json(403);
        }
    }

    public static function checkVoteRegister($survey_id)
    {
        global $wpdb;
        $table = $wpdb->prefix.VOTES;
        $ip = $_SERVER['REMOTE_ADDR'];

        $result = $wpdb->get_row("SELECT vote_ip FROM {$table} WHERE vote_ip = '{$ip}' AND vote_survey_id = '{$survey_id}'", OBJECT);

        if ($result) {
            wp_send_json(403);
        }
    }
}