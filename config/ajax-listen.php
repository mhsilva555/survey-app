<?php

use Survey\App\Facades\Options;
use Survey\App\Surveys\SaveSurvey;
use Survey\App\Surveys\UpdateSurvey;

function save_survey()
{
    $nonce = wp_verify_nonce($_REQUEST['nonce']);

    if (!$nonce) {
       wp_send_json(400);
    }

    if ($_REQUEST['question'] == '' || !isset($_REQUEST['list_answers'])) {
        wp_send_json(400);
    }

    if (isset($_REQUEST['update'])) {
        $update_id = sanitize_text_field($_REQUEST['update']);
        UpdateSurvey::update($update_id);
    }

    $survey_id = SaveSurvey::question();

    if (!$survey_id) {
        wp_send_json(400);
    }

    SaveSurvey::answers($survey_id);

    wp_send_json($survey_id);
}
add_action('wp_ajax_save_survey', 'save_survey');

function delete_image() {
    $survey_id = $_REQUEST['survey_id'] ?? null;

    if (!$survey_id) {
        wp_send_json(400);
    }

    $delete = UpdateSurvey::deleteImage($survey_id);
    wp_send_json($delete);
}
add_action('wp_ajax_delete_image', 'delete_image');

function config_survey()
{
    $nonce = wp_verify_nonce($_REQUEST['nonce']);

    if (!$nonce) {
       wp_send_json(400, 400);
    }

    if (empty($_REQUEST['fields'])) {
        wp_send_json(400, 400);
    }

    $recaptcha_site_key = sanitize_text_field($_REQUEST['fields']['recaptcha_site_key'] ?? '');
    $recaptcha_secret_key = sanitize_text_field($_REQUEST['fields']['recaptcha_secret_key'] ?? '');

    Options::update('recaptcha_site_key', $recaptcha_site_key);
    Options::update('recaptcha_secret_key', $recaptcha_secret_key);

    wp_send_json(200, 200);
}
add_action('wp_ajax_config_survey', 'config_survey');


function delete_survey()
{
    $survey_id = $_REQUEST['survey_id'];
    \Survey\App\Surveys\DeleteSurvey::delete($survey_id);
}
add_action('wp_ajax_delete_survey', 'delete_survey');


function new_vote()
{
    \Survey\App\Votes\NewVote::new();
}
add_action('wp_ajax_new_vote', 'new_vote');
add_action('wp_ajax_nopriv_new_vote', 'new_vote');


function add_new_answer()
{
    \Survey\App\Facades\View::render('partials.repeater');
    wp_die();
}
add_action('wp_ajax_add_new_answer', 'add_new_answer');


function get_survey_result()
{
    \Survey\App\Surveys\GetSurveyResult::get();
    exit();
}
add_action('wp_ajax_get_survey_result', 'get_survey_result');
add_action('wp_ajax_nopriv_get_survey_result', 'get_survey_result');
