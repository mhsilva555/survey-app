<?php

namespace Survey\App\PageOptions;

use Survey\App\Abstracts\AbstractPagesOptions;
use Survey\App\Facades\View;

class NewSurveyPage extends AbstractPagesOptions
{
    public function setPageOption()
    {
        add_submenu_page(
            DEFAULT_SURVEY_SLUG
            , 'Nova Enquete'
            , 'Nova Enquete'
            , 'administrator'
            , NEW_SURVEY_SLUG
            , [$this, 'callbackPageOption']
        );
    }

    public function callbackPageOption()
    {
        View::render('new-survey');
    }
}