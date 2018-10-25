<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesAccountreceiveablesClass{

    function __construct() {}

    function getAllAccountreceiveables() {
        $customername = zemesrequest::getVar('customername');
        $inquery='';
        if ($customername) {
            $inquery = " WHERE customer.name LIKE '%$customername%'";
        }

        zememailsystem::$items['filter']['customername'] = $customername;
        
        //pagination
        $query = "SELECT COUNT(ar.id) 
            FROM ".zemesdb::$prefix."zememailsystem_accountreceiveables AS ar
            JOIN ".zemesdb::$prefix."zememailsystem_customers AS customer ON customer.id = ar.customerid";
        $query .= $inquery;
        $total = zemesdb::get_var($query);
        zememailsystem::$pager['total'] = $total;
        zememailsystem::$pager['pagination'] = zememailsystem::getPagination($total);

        $query = "SELECT customer.name AS customername, customer.phone, customer.mobile ,ar.customerid, ar.totalsale, ar.totalcashin, ar.balance, ar.lastsale, ar.lastcashin
            FROM ".zemesdb::$prefix."zememailsystem_customers AS customer
            JOIN ".zemesdb::$prefix."zememailsystem_accountreceiveables AS ar ON ar.customerid = customer.id";

        $query .= $inquery;
        $query .= " ORDER BY ar.balance DESC";
        $query .= " LIMIT ".zememailsystem::$pager['offset']." , ".zememailsystem::$pager['limit'];
        zememailsystem::$items[0] = zemesdb::get_results($query);

        return;
    }

    function validateBalanceAjax(){
        $customerid = zemesrequest::getVar('customerid');
        if( ! is_numeric($customerid))
            return 'error';
        //pagination
        $query = "SELECT IFNULL((SELECT SUM(sale.total) FROM ".zemesdb::$prefix."zememailsystem_sales AS sale WHERE sale.customerid = $customerid) , 0 )
                - IFNULL((SELECT SUM(cr.cashin) FROM ".zemesdb::$prefix."zememailsystem_cashreceived AS cr WHERE cr.customerid = $customerid) , 0 ) AS balance";
        $balance = zemesdb::get_var($query);
        return $balance;
    }
}
?>