<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemessettingsclass {

    function __construct(){}

    function getZeminitSettings() {
        include_once(ABSPATH.'wp-admin/includes/plugin.php');
        if (is_plugin_active('zem-email-system/zem-email-system.php')) {
            if( ! get_option('zemes_industry_name'))
                update_option('zemes_industry_name', get_bloginfo ('name'));
            if( ! get_option('zemes_industry_mobile'))
                update_option('zemes_industry_mobile', '123-123-123');
            if( ! get_option('zemes_industry_email'))
                update_option('zemes_industry_email', get_bloginfo ('admin_email'));
            if( ! get_option('zemes_p_size'))
                update_option('zemes_p_size', 10 );
            zememailsystem::$settings['pagination_default_size'] = get_option('zemes_p_size');
        }
    }

    function setQuickSettingsAjax(){
        $indname = zemesrequest::getVar('indname');
        $indmobile = zemesrequest::getVar('indmobile');
        $indemail = zemesrequest::getVar('indemail');
        $psize = zemesrequest::getVar('psize');
        $error = false;
        if( update_option('zemes_industry_name', $indname))
            $error = true;
        if( update_option('zemes_industry_mobile', $indmobile))
            $error = true;
        if( update_option('zemes_industry_email', $indemail))
            $error = true;
        if( update_option('zemes_p_size', $psize))
            $error = true;
        if($error)
            return 'ok';
    }
}
?>
