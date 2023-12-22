<?php

namespace Survey\App;

use Survey\App\Abstracts\AbstractSingleton;
use Survey\App\Databases\AnswerDatabase;
use Survey\App\Databases\SurveysDatabase;
use Survey\App\Databases\VotesDatabase;
use Survey\App\PageOptions\ConfigSurveyPage;
use Survey\App\PageOptions\NewSurveyPage;
use Survey\App\PageOptions\DefaultSurveyPage;
use Survey\App\Providers\AssetsServiceProvider;
use Survey\App\Shortcodes\SurveyShortcode;

/**
 * Class Survey
 * @package Survey\App
 */
class SurveyApp extends AbstractSingleton
{
    public function __construct()
    {
        (new AssetsServiceProvider());
        (new DefaultSurveyPage());
        (new NewSurveyPage());
        (new ConfigSurveyPage());

        (new SurveyShortcode());

        FactoryDatabases::create(new SurveysDatabase('surveys'));
        FactoryDatabases::create(new AnswerDatabase('surveys_answers'));
        FactoryDatabases::create(new VotesDatabase('surveys_votes'));
    }
}