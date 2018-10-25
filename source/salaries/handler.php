<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesSalariesHandler{

    function __construct() {
        self::init();
    }

    function init() {
        if (zemesrequest::canaddview()) {
            $layout = zemesrequest::getLayout('zemel', null, 'salaries');
            switch ($layout) {
                case '_salaries':
                    zemesincluder::getObject('salaries')->getAllSalaries();
                    break;
                case '_formsalary':
                    $id = zemesrequest::getVar('zemesid');
                    zemesincluder::getObject('salaries')->getSalaryById($id);
                    break;
            }
            zemesincluder::display($layout , 'salaries');
        }
    }


    function save() {
        $data = zemesrequest::get('post');
        $result = zemesincluder::getObject('salaries')->storeSalary($data);
        $msg = zemesMessages::getMessage($result,'salaries');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=salaries&zemel=formsalary");
        // $url = admin_url("admin.php?page=salaries&zemel=salaries");
        wp_redirect($url);
        exit;
    }

    function remove() {
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('salaries')->deleteSalary($id);
        $msg = zemesMessages::getMessage($result,'salaries');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=salaries&zemel=salaries");
        wp_redirect($url);
        exit;
    }

    function publish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('salaries')->publishUnpublish($id,1);
        $msg = zemesMessages::getMessage($result,'salaries');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=salaries&zemel=salaries");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }

    function unpublish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('salaries')->publishUnpublish($id,0);
        $msg = zemesMessages::getMessage($result,'salaries');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=salaries&zemel=salaries");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }
}
$jjeszemSalarieshand = new zemesSalariesHandler();
?>
