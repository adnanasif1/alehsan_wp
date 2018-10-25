<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesCustomersHandler{

    function __construct() {
        self::init();
    }

    function init() {
        if (zemesrequest::canaddview()) {
            $layout = zemesrequest::getLayout('zemel', null, 'customers');
            switch ($layout) {
                case '_customers':
                    zemesincluder::getObject('customers')->getAllCustomers();
                    break;
                case '_formcustomer':
                    $id = zemesrequest::getVar('zemesid');
                    zemesincluder::getObject('customers')->getCustomerById($id);
                    break;
            }
            zemesincluder::display($layout , 'customers');
        }
    }


    function save() {
        $data = zemesrequest::get('post');
        $result = zemesincluder::getObject('customers')->storeCustomer($data);
        $msg = zemesMessages::getMessage($result,'customers');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        // $url = admin_url("admin.php?page=customers&zemel=customers");
        $url = admin_url("admin.php?page=customers&zemel=formcustomer");
        wp_redirect($url);
        exit;
    }

    function remove() {
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('customers')->deleteCustomer($id);
        $msg = zemesMessages::getMessage($result,'customers');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=customers&zemel=customers");
        wp_redirect($url);
        exit;
    }

    function publish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('customers')->publishUnpublish($id,1);
        $msg = zemesMessages::getMessage($result,'customers');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=customers&zemel=customers");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }

    function unpublish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('customers')->publishUnpublish($id,0);
        $msg = zemesMessages::getMessage($result,'customers');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=customers&zemel=customers");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }
}
$jjeszemCustomershand = new zemesCustomersHandler();
?>