<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesExpenseItemNamesHandler{

    function __construct() {
        self::init();
    }

    function init() {
        if (zemesrequest::canaddview()) {
            $layout = zemesrequest::getLayout('zemel', null, 'expenseitemnames');
            switch ($layout) {
                case '_expenseitemnames':
                    zemesincluder::getObject('expenseitemnames')->getAllExpenseItemNames();
                    break;
                case '_formexpenseitemname':
                    $id = zemesrequest::getVar('zemesid');
                    zemesincluder::getObject('expenseitemnames')->getExpenseItemNameById($id);
                    break;
            }
            zemesincluder::display($layout , 'expenseitemnames');
        }
    }


    function save() {
        $data = zemesrequest::get('post');
        $result = zemesincluder::getObject('expenseitemnames')->storeExpenseItemName($data);
        $msg = zemesMessages::getMessage($result,'expenseitemnames');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=expenseitemnames&zemel=formexpenseitemname");
        // $url = admin_url("admin.php?page=expenseitemnames&zemel=expenseitemnames");
        wp_redirect($url);
        exit;
    }

    function remove() {
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('expenseitemnames')->deleteExpenseItemName($id);
        $msg = zemesMessages::getMessage($result,'expenseitemnames');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=expenseitemnames&zemel=expenseitemnames");
        wp_redirect($url);
        exit;
    }

    function publish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('expenseitemnames')->publishUnpublish($id,1);
        $msg = zemesMessages::getMessage($result,'expenseitemnames');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=expenseitemnames&zemel=expenseitemnames");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }

    function unpublish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('expenseitemnames')->publishUnpublish($id,0);
        $msg = zemesMessages::getMessage($result,'expenseitemnames');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=expenseitemnames&zemel=expenseitemnames");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }
    
    function updateordering() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $order = zemesrequest::getVar('order');
        $result = zemesincluder::getObject('expenseitemnames')->setOrdering($id, $order , 'expenseitemnames');
        $msg = zemesMessages::getMessage($result,'expenseitemnames');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=expenseitemnames&zemel=expenseitemnames");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }
}
$jjeszemExpenseItemNameshand = new zemesExpenseItemNamesHandler();
?>