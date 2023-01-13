<?php

namespace Survey\App\Surveys;

class GetSurveys
{
    public static function gelAll()
    {
        global $wpdb;
        $surveys = $wpdb->prefix.SURVEYS;

        $surveys = $wpdb->get_results("SELECT * FROM {$surveys}", OBJECT);

        return $surveys;
    }
}