<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesSalesHandler{

    function __construct() {
        self::init();
    }

    function init() {
        if (zemesrequest::canaddview()) {
            $layout = zemesrequest::getLayout('zemel', null, 'sales');
            switch ($layout) {
                case '_sales':
                    zemesincluder::getObject('sales')->getAllSales();
                    break;
                case '_formsale':
                    $id = zemesrequest::getVar('zemesid');
                    zemesincluder::getObject('sales')->getSaleById($id);
                    break;
            }
            zemesincluder::display($layout , 'sales');
        }
    }


    function save() {
        $data = zemesrequest::get('post');
        $result = zemesincluder::getObject('sales')->storeSale($data);
        $msg = zemesMessages::getMessage($result,'sales');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=sales&zemel=formsale");
        // $url = admin_url("admin.php?page=sales&zemel=sales");
        wp_redirect($url);
        exit;
    }

    function remove() {
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('sales')->deleteSale($id);
        $msg = zemesMessages::getMessage($result,'sales');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=sales&zemel=sales");
        wp_redirect($url);
        exit;
    }

    function publish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('sales')->publishUnpublish($id,1);
        $msg = zemesMessages::getMessage($result,'sales');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=sales&zemel=sales");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }

    function unpublish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('sales')->publishUnpublish($id,0);
        $msg = zemesMessages::getMessage($result,'sales');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=sales&zemel=sales");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }
}
$jjeszemSaleshand = new zemesSalesHandler();
?>