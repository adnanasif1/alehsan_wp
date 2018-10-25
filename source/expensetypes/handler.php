<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesExpenseTypesHandler{

    function __construct() {
        self::init();
    }

    function init() {
        if (zemesrequest::canaddview()) {
            $layout = zemesrequest::getLayout('zemel', null, 'expensetypes');
            switch ($layout) {
                case '_expensetypes':
                    zemesincluder::getObject('expensetypes')->getAllExpenseTypes();
                    break;
                case '_formexpensetype':
                    $id = zemesrequest::getVar('zemesid');
                    zemesincluder::getObject('expensetypes')->getExpenseTypeById($id);
                    break;
            }
            zemesincluder::display($layout , 'expensetypes');
        }
    }


    function save() {
        $data = zemesrequest::get('post');
        $result = zemesincluder::getObject('expensetypes')->storeExpenseType($data);
        $msg = zemesMessages::getMessage($result,'expensetypes');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=expensetypes&zemel=formexpensetype");
        // $url = admin_url("admin.php?page=expensetypes&zemel=expensetypes");
        wp_redirect($url);
        exit;
    }

    function remove() {
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('expensetypes')->deleteExpenseType($id);
        $msg = zemesMessages::getMessage($result,'expensetypes');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=expensetypes&zemel=expensetypes");
        wp_redirect($url);
        exit;
    }

    function publish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('expensetypes')->publishUnpublish($id,1);
        $msg = zemesMessages::getMessage($result,'expensetypes');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=expensetypes&zemel=expensetypes");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }

    function unpublish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('expensetypes')->publishUnpublish($id,0);
        $msg = zemesMessages::getMessage($result,'expensetypes');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=expensetypes&zemel=expensetypes");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }
    
    function updateordering() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $order = zemesrequest::getVar('order');
        $result = zemesincluder::getObject('expensetypes')->setOrdering($id, $order , 'expensetypes');
        $msg = zemesMessages::getMessage($result,'expensetypes');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=expensetypes&zemel=expensetypes");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }
}
$jjeszemExpenseTypeshand = new zemesExpenseTypesHandler();
?>