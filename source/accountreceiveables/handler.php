<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesAccountreceiveablesHandler{

    function __construct() {
        self::init();
    }

    function init() {
        if (zemesrequest::canaddview()) {
            $layout = zemesrequest::getLayout('zemel', null, 'accountreceiveables');
            switch ($layout) {
                case '_accountreceiveables':
                    zemesincluder::getObject('accountreceiveables')->getAllAccountreceiveables();
                    break;
            }
            zemesincluder::display($layout , 'accountreceiveables');
        }
    }
}
$jjeszemAccountreceiveableshand = new zemesAccountreceiveablesHandler();
?>