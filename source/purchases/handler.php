<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesPurchasesHandler{

    function __construct() {
        self::init();
    }

    function init() {
        if (zemesrequest::canaddview()) {
            $layout = zemesrequest::getLayout('zemel', null, 'purchases');
            switch ($layout) {
                case '_purchases':
                    zemesincluder::getObject('purchases')->getAllPurchases();
                    break;
                case '_formpurchases':
                    $id = zemesrequest::getVar('zemesid');
                    zemesincluder::getObject('purchases')->getPurchasesById($id);
                    break;
            }
            zemesincluder::display($layout , 'purchases');
        }
    }

    function save() {
        $data = zemesrequest::get('post');
        $result = zemesincluder::getObject('purchases')->storePurchases($data);
        $msg = zemesMessages::getMessage($result,'purchases');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=purchases&zemel=formpurchases");
        wp_redirect($url);
        exit;
    }
    function remove() {
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('purchases')->deletePurchases($id);
        $msg = zemesMessages::getMessage($result,'purchases');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=purchases&zemel=purchases");
        wp_redirect($url);
        exit;
    }

    function publish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('purchases')->publishUnpublish($id,1);
        $msg = zemesMessages::getMessage($result,'purchases');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=purchases&zemel=purchases");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }

    function unpublish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('purchases')->publishUnpublish($id,0);
        $msg = zemesMessages::getMessage($result,'purchases');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=purchases&zemel=purchases");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }
}
$jjeszemPurchaseshand = new zemesPurchasesHandler();
?>