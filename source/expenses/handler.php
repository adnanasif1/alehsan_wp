<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesExpensesHandler{

    function __construct() {
        self::init();
    }

    function init() {
        if (zemesrequest::canaddview()) {
            $layout = zemesrequest::getLayout('zemel', null, 'expenses');
            switch ($layout) {
                case '_expenses':
                    zemesincluder::getObject('expenses')->getAllExpenses();
                    break;
                case '_formexpense':
                    $id = zemesrequest::getVar('zemesid');
                    zemesincluder::getObject('expenses')->getExpenseById($id);
                    break;
            }
            zemesincluder::display($layout , 'expenses');
        }
    }


    function save() {
        $data = zemesrequest::get('post');
        $result = zemesincluder::getObject('expenses')->storeExpense($data);
        $msg = zemesMessages::getMessage($result,'expenses');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=expenses&zemel=formexpense");
        // $url = admin_url("admin.php?page=expenses&zemel=expenses");
        wp_redirect($url);
        exit;
    }

    function remove() {
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('expenses')->deleteExpense($id);
        $msg = zemesMessages::getMessage($result,'expenses');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=expenses&zemel=expenses");
        wp_redirect($url);
        exit;
    }

    function publish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('expenses')->publishUnpublish($id,1);
        $msg = zemesMessages::getMessage($result,'expenses');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=expenses&zemel=expenses");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }

    function unpublish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('expenses')->publishUnpublish($id,0);
        $msg = zemesMessages::getMessage($result,'expenses');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=expenses&zemel=expenses");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }
}
$jjeszemExpenseshand = new zemesExpensesHandler();
?>
