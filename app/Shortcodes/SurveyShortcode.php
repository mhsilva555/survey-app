<?php

namespace Survey\App\Shortcodes;

use Survey\App\Abstracts\AbstractShortcodes;
use Survey\App\Facades\View;
use Survey\App\Surveys\GetSurveyByID;

class SurveyShortcode extends AbstractShortcodes
{
    public function __construct()
    {
        add_shortcode('survey', [$this, 'render']);
    }

    public function render($atts)
    {
        $default = shortcode_atts(['id' => ''], $atts);

        if($default['id'] == '') {
            return;
        }

        $survey = GetSurveyByID::get($default['id']);

        ob_start();
        View::render('partials.survey-view-shortcode', ['data' => $survey]);
        return ob_get_clean();
    }
}