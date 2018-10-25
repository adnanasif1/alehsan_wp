<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesEmployeesHandler{

    function __construct() {
        self::init();
    }

    function init() {
        if (zemesrequest::canaddview()) {
            $layout = zemesrequest::getLayout('zemel', null, 'employees');
            switch ($layout) {
                case '_employees':
                    zemesincluder::getObject('employees')->getAllEmployees();
                    break;
                case '_formemployee':
                    $id = zemesrequest::getVar('zemesid');
                    zemesincluder::getObject('employees')->getEmployeeById($id);
                    break;
            }
            zemesincluder::display($layout , 'employees');
        }
    }


    function save() {
        $data = zemesrequest::get('post');
        $result = zemesincluder::getObject('employees')->storeEmployee($data);
        $msg = zemesMessages::getMessage($result,'employees');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        // $url = admin_url("admin.php?page=employees&zemel=employees");
        $url = admin_url("admin.php?page=employees&zemel=formemployee");
        wp_redirect($url);
        exit;
    }

    function remove() {
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('employees')->deleteEmployee($id);
        $msg = zemesMessages::getMessage($result,'employees');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=employees&zemel=employees");
        wp_redirect($url);
        exit;
    }

    function publish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('employees')->publishUnpublish($id,1);
        $msg = zemesMessages::getMessage($result,'employees');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=employees&zemel=employees");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }

    function unpublish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('employees')->publishUnpublish($id,0);
        $msg = zemesMessages::getMessage($result,'employees');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=employees&zemel=employees");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }
}
$jjeszemEmployeeshand = new zemesEmployeesHandler();
?>