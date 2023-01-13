<?php

date_default_timezone_set('America/Sao_Paulo');

use Survey\App\Providers\AssetsServiceProvider;
use Survey\App\SurveyApp;

/**
 * Singleton Plugin
 */
SurveyApp::singleton();