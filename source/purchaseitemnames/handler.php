<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesPurchaseItemNamesHandler{

    function __construct() {
        self::init();
    }

    function init() {
        if (zemesrequest::canaddview()) {
            $layout = zemesrequest::getLayout('zemel', null, 'purchaseitemnames');
            switch ($layout) {
                case '_purchaseitemnames':
                    zemesincluder::getObject('purchaseitemnames')->getAllPurchaseItemNames();
                    break;
                case '_formpurchaseitemname':
                    $id = zemesrequest::getVar('zemesid');
                    zemesincluder::getObject('purchaseitemnames')->getPurchaseItemNameById($id);
                    break;
            }
            zemesincluder::display($layout , 'purchaseitemnames');
        }
    }


    function save() {
        $data = zemesrequest::get('post');
        $result = zemesincluder::getObject('purchaseitemnames')->storePurchaseItemName($data);
        $msg = zemesMessages::getMessage($result,'purchaseitemnames');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=purchaseitemnames&zemel=formpurchaseitemname");
        // $url = admin_url("admin.php?page=purchaseitemnames&zemel=purchaseitemnames");
        wp_redirect($url);
        exit;
    }

    function remove() {
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('purchaseitemnames')->deletePurchaseItemName($id);
        $msg = zemesMessages::getMessage($result,'purchaseitemnames');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=purchaseitemnames&zemel=purchaseitemnames");
        wp_redirect($url);
        exit;
    }

    function publish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('purchaseitemnames')->publishUnpublish($id,1);
        $msg = zemesMessages::getMessage($result,'purchaseitemnames');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=purchaseitemnames&zemel=purchaseitemnames");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }

    function unpublish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('purchaseitemnames')->publishUnpublish($id,0);
        $msg = zemesMessages::getMessage($result,'purchaseitemnames');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=purchaseitemnames&zemel=purchaseitemnames");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }
    
    function updateordering() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $order = zemesrequest::getVar('order');
        $result = zemesincluder::getObject('purchaseitemnames')->setOrdering($id, $order , 'purchaseitemnames');
        $msg = zemesMessages::getMessage($result,'purchaseitemnames');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=purchaseitemnames&zemel=purchaseitemnames");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }
}
$jjeszemPurchaseItemNameshand = new zemesPurchaseItemNamesHandler();
?>