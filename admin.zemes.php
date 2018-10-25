<?php

if (!defined('ABSPATH')) die('Access Denied');

class zememailsystemadmin {

    function __construct() {
        add_action('admin_menu', array($this, 'zemadminmenu'));
    }

    function zemadminmenu() {
        add_menu_page(__('Zem Email System Control Panel', 'zem_emailsystem'),
                __('Zem Email System', 'zem_emailsystem'),
                'manage_options',
                'zememailsystem',
                array($this, 'kickAdminPage'),
                ''
        );
        add_submenu_page('zememailsystem',
                __('ZEM Purchases', 'zem_emailsystem'),
                __('Purchases', 'zem_emailsystem'),
                'manage_options',
                'purchases',
                array($this, 'kickAdminPage') 
        );
        add_submenu_page('zememailsystem',
                __('ZEM Sales', 'zem_emailsystem'),
                __('Sales', 'zem_emailsystem'),
                'manage_options',
                'sales',
                array($this, 'kickAdminPage') 
        );
        add_submenu_page('zememailsystem',
                __('ZEM Expenses', 'zem_emailsystem'),
                __('Expenses', 'zem_emailsystem'),
                'manage_options',
                'expenses',
                array($this, 'kickAdminPage') 
        );
        add_submenu_page('zememailsystem',
                __('ZEM Salaries', 'zem_emailsystem'),
                __('Salaries', 'zem_emailsystem'),
                'manage_options',
                'salaries',
                array($this, 'kickAdminPage') 
        );
        add_submenu_page('zememailsystem',
                __('ZEM Cash In', 'zem_emailsystem'),
                __('Cash In', 'zem_emailsystem'),
                'manage_options',
                'cashreceived',
                array($this, 'kickAdminPage') 
        );
        add_submenu_page('zememailsystem',
                __('ZEM Phonebook', 'zem_emailsystem'),
                __('Phonebook', 'zem_emailsystem'),
                'manage_options',
                'phonebook',
                array($this, 'kickAdminPage') 
        );
        
        add_submenu_page('zememailsystem_hide',
                __('ZEM Configuration', 'zem_emailsystem'),
                __('Settings', 'zem_emailsystem'),
                'manage_options',
                'settings',
                array($this, 'kickAdminPage') 
        );
        add_submenu_page('zememailsystem_hide',
                __('ZEM Employees', 'zem_emailsystem'),
                __('Employees', 'zem_emailsystem'),
                'manage_options',
                'employees',
                array($this, 'kickAdminPage') 
        );
        add_submenu_page('zememailsystem_hide',
                __('ZEM Customers', 'zem_emailsystem'),
                __('Customers', 'zem_emailsystem'),
                'manage_options',
                'customers',
                array($this, 'kickAdminPage') 
        );
        add_submenu_page('zememailsystem_hide',
                __('ZEM Receiveables', 'zem_emailsystem'),
                __('Receiveables', 'zem_emailsystem'),
                'manage_options',
                'accountreceiveables',
                array($this, 'kickAdminPage') 
        );
        add_submenu_page('zememailsystem_hide',
                __('ZEM Purchase Items', 'zem_emailsystem'),
                __('Purchase Items', 'zem_emailsystem'),
                'manage_options',
                'purchaseitemnames',
                array($this, 'kickAdminPage') 
        );
        add_submenu_page('zememailsystem_hide',
                __('ZEM Sale Items', 'zem_emailsystem'),
                __('Sale Items', 'zem_emailsystem'),
                'manage_options',
                'saleitemnames',
                array($this, 'kickAdminPage') 
        );
        add_submenu_page('zememailsystem_hide',
                __('ZEM Expense Items', 'zem_emailsystem'),
                __('Expense Items', 'zem_emailsystem'),
                'manage_options',
                'expenseitemnames',
                array($this, 'kickAdminPage') 
        );
        add_submenu_page('zememailsystem_hide',
                __('ZEM Expense Types', 'zem_emailsystem'),
                __('Expense Types', 'zem_emailsystem'),
                'manage_options',
                'expensetypes',
                array($this, 'kickAdminPage') 
        );
    }

    function kickAdminPage() {
        zememailsystem::addStyleSheets();
        $page = zemesrequest::getVar('page');
        zemesincluder::includeFile($page);
    }
}
$zememailsystemadmin = new zememailsystemadmin();

?>
