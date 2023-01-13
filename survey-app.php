<?php

if (!function_exists('add_action')) {
    wp_die();
}

/*
Plugin Name: Survey App - Enquetes Online
Description: Criação de Enquetes Online com Gestão de Resultados.
Version: 1.0
Author: Marcos Henrique
Author URI: https://mhsilva555.github.io
License: MIT
Textdomain: survey
*/

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/defines.php';
require_once __DIR__ . '/config/ajax-listen.php';
require_once __DIR__ . '/bootstrap/app.php';
