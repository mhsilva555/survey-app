<?php

namespace Survey\App\Providers;

use Survey\App\Facades\Options;
use Survey\App\PageOptions\DefaultSurveyPage;

class AssetsServiceProvider
{
    private $permissions = [
        "toplevel_page_".DEFAULT_SURVEY_SLUG,
        "enquetes_page_".NEW_SURVEY_SLUG,
        "enquetes_page_".CONFIG_SURVEY_SLUG,
    ];

    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'styles']);
        add_action('admin_enqueue_scripts', [$this, 'scripts']);
        add_filter('script_loader_tag', [$this, 'asyncDefer'], 10, 2);
        add_action('wp_enqueue_scripts', [$this, 'scriptsFront']);
    }

    public function styles($hook)
    {
        if (in_array($hook, $this->permissions)):
            wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css', [], '5.9.0');
            wp_enqueue_style('styles', SURVEY_PLUGIN_URI . '/resources/build/css/styles.min.css', [], false);
        endif;
    }

    function asyncDefer($tag, $handle) {
        $scripts_async_defer = array('recaptcha');
    
        if (in_array($handle, $scripts_async_defer)) {
            $tag = str_replace(' src=', ' async defer src=', $tag);
        }
    
        return $tag;
    }

    public function scriptsFront()
    {
        wp_enqueue_style('front-css', SURVEY_PLUGIN_URI . '/resources/build/css/front.min.css', [], false);
        
        wp_enqueue_script('front-js', SURVEY_PLUGIN_URI . '/resources/build/js/front.min.js', ['jquery'], false, true);

        if ($site_key = Options::get('recaptcha_site_key')):
            wp_enqueue_script('recaptcha', 'https://www.google.com/recaptcha/api.js', [], null, true);
        endif;

        wp_localize_script('front-js', 'wp', [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'recaptcha_site_key' => Options::get('recaptcha_site_key'),
        ]);
    }

    public function scripts($hook)
    {
        if (in_array($hook, $this->permissions)):
            wp_enqueue_media();
            wp_enqueue_script('repeater', SURVEY_PLUGIN_URI . '/resources/build/js/jquery.repeater.min.js', [], false, true);
            wp_enqueue_script('app', SURVEY_PLUGIN_URI . '/resources/build/js/app.min.js', ['jquery'], false, true);

            wp_localize_script('app', 'obj', [
                'ajaxurl' => admin_url('admin-ajax.php'),
                'adminurl' => admin_url(),
                'ajax_nonce' => wp_create_nonce(-1),
                'edit_survey' => isset($_GET['page']) && $_GET['page'] == 'survey-managment',
            ]);
        endif;
    }
}