<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesPhonebookHandler{

    function __construct() {
        self::init();
    }

    function init() {
        if (zemesrequest::canaddview()) {
            $layout = zemesrequest::getLayout('zemel', null, 'phonebook');
            switch ($layout) {
                case '_phonebook':
                    zemesincluder::getObject('phonebook')->getAllPhonebook();
                    break;
                case '_formphonebook':
                    $id = zemesrequest::getVar('zemesid');
                    zemesincluder::getObject('phonebook')->getPhonebookById($id);
                    break;
            }
            zemesincluder::display($layout , 'phonebook');
        }
    }


    function save() {
        $data = zemesrequest::get('post');
        $result = zemesincluder::getObject('phonebook')->storePhonebook($data);
        $msg = zemesMessages::getMessage($result,'phonebook');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        // $url = admin_url("admin.php?page=phonebook&zemel=phonebook");
        $url = admin_url("admin.php?page=phonebook&zemel=formphonebook");
        wp_redirect($url);
        exit;
    }

    function remove() {
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('phonebook')->deletePhonebook($id);
        $msg = zemesMessages::getMessage($result,'phonebook');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=phonebook&zemel=phonebook");
        wp_redirect($url);
        exit;
    }

    function publish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('phonebook')->publishUnpublish($id,1);
        $msg = zemesMessages::getMessage($result,'phonebook');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=phonebook&zemel=phonebook");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }

    function unpublish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('phonebook')->publishUnpublish($id,0);
        $msg = zemesMessages::getMessage($result,'phonebook');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=phonebook&zemel=phonebook");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }
}
$jjeszemPhonebookhand = new zemesPhonebookHandler();
?>