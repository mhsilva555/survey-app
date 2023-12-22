<?php

namespace Survey\App\PageOptions;

use Survey\App\Abstracts\AbstractPagesOptions;
use Survey\App\Facades\Options;
use Survey\App\Facades\View;

class ConfigSurveyPage extends AbstractPagesOptions
{
    public function setPageOption()
    {
        add_submenu_page(
            DEFAULT_SURVEY_SLUG
            ,'Configurações'
            ,'Configurações'
            ,'administrator'
            ,CONFIG_SURVEY_SLUG
            ,[$this, 'callbackPageOption']
        );
    }

    public function callbackPageOption()
    {
        $data = [
            'recaptcha_site_key' => Options::get('recaptcha_site_key'),
            'recaptcha_secret_key' => Options::get('recaptcha_secret_key'),
        ];

        View::render('config-survey', $data);
    }
}