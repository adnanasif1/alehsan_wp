<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesCashreceivedHandler{

    function __construct() {
        self::init();
    }

    function init() {
        if (zemesrequest::canaddview()) {
            $layout = zemesrequest::getLayout('zemel', null, 'cashreceived');
            switch ($layout) {
                case '_cashreceived':
                    zemesincluder::getObject('cashreceived')->getAllCashreceived();
                    break;
                case '_formcashreceived':
                    $id = zemesrequest::getVar('zemesid');
                    zemesincluder::getObject('cashreceived')->getCashreceivedById($id);
                    break;
            }
            zemesincluder::display($layout , 'cashreceived');
        }
    }


    function save() {
        $data = zemesrequest::get('post');
        $result = zemesincluder::getObject('cashreceived')->storeCashreceived($data);
        $msg = zemesMessages::getMessage($result,'cashreceived');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=cashreceived&zemel=formcashreceived");
        // $url = admin_url("admin.php?page=cashreceived&zemel=cashreceived");
        wp_redirect($url);
        exit;
    }

    function remove() {
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('cashreceived')->deleteCashreceived($id);
        $msg = zemesMessages::getMessage($result,'cashreceived');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=cashreceived&zemel=cashreceived");
        wp_redirect($url);
        exit;
    }

    function publish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('cashreceived')->publishUnpublish($id,1);
        $msg = zemesMessages::getMessage($result,'cashreceived');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=cashreceived&zemel=cashreceived");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }

    function unpublish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('cashreceived')->publishUnpublish($id,0);
        $msg = zemesMessages::getMessage($result,'cashreceived');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=cashreceived&zemel=cashreceived");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }
}
$jjeszemCashreceivedhand = new zemesCashreceivedHandler();
?>