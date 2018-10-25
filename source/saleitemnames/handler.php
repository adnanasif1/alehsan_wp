<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesSaleItemNamesHandler{

    function __construct() {
        self::init();
    }

    function init() {
        if (zemesrequest::canaddview()) {
            $layout = zemesrequest::getLayout('zemel', null, 'saleitemnames');
            switch ($layout) {
                case '_saleitemnames':
                    zemesincluder::getObject('saleitemnames')->getAllSaleItemNames();
                    break;
                case '_formsaleitemname':
                    $id = zemesrequest::getVar('zemesid');
                    zemesincluder::getObject('saleitemnames')->getSaleItemNameById($id);
                    break;
            }
            zemesincluder::display($layout , 'saleitemnames');
        }
    }


    function save() {
        $data = zemesrequest::get('post');
        $result = zemesincluder::getObject('saleitemnames')->storeSaleItemName($data);
        $msg = zemesMessages::getMessage($result,'saleitemnames');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=saleitemnames&zemel=formsaleitemname");
        // $url = admin_url("admin.php?page=saleitemnames&zemel=saleitemnames");
        wp_redirect($url);
        exit;
    }

    function remove() {
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('saleitemnames')->deleteSaleItemName($id);
        $msg = zemesMessages::getMessage($result,'saleitemnames');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=saleitemnames&zemel=saleitemnames");
        wp_redirect($url);
        exit;
    }

    function publish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('saleitemnames')->publishUnpublish($id,1);
        $msg = zemesMessages::getMessage($result,'saleitemnames');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=saleitemnames&zemel=saleitemnames");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }

    function unpublish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('saleitemnames')->publishUnpublish($id,0);
        $msg = zemesMessages::getMessage($result,'saleitemnames');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=saleitemnames&zemel=saleitemnames");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }

    function updateordering() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $order = zemesrequest::getVar('order');
        $result = zemesincluder::getObject('saleitemnames')->setOrdering($id, $order , 'saleitemnames');
        $msg = zemesMessages::getMessage($result,'saleitemnames');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=saleitemnames&zemel=saleitemnames");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }

}
$jjeszemSaleItemNameshand = new zemesSaleItemNamesHandler();
?>