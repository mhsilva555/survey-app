<?php

namespace Survey\App\PageOptions;

use Survey\App\Abstracts\AbstractPagesOptions;
use Survey\App\Facades\View;

class DefaultSurveyPage extends AbstractPagesOptions
{
    public function setPageOption()
    {
        add_menu_page(
            'Enquetes',
            'Enquetes',
            'administrator',
            DEFAULT_SURVEY_SLUG,
            [$this, 'callbackPageOption'],
            'dashicons-list-view',
            5
        );
    }

    public function callbackPageOption()
    {
        if (isset($_GET['edit_survey']) && $_GET['edit_survey'] != '') {
            View::render('new-survey', ['survey_id' => $_GET['edit_survey']]);

            return;
        }

        View::render('painel');
    }
}