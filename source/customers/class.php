<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesCustomersClass{

    function __construct() {}

    function getCustomerById($id) {
        if(!is_numeric($id)) return false;
        $query = "SELECT * FROM ".zemesdb::$prefix."zememailsystem_customers WHERE id=".$id;
        zememailsystem::$items[0] = zemesdb::get_row($query);
        return;
    }

    function getAllCustomers() {
        $name = zemesrequest::getVar('searchname');
        $inquery='';
        if ($name) {
            $inquery = " WHERE name LIKE '%$name%' ORDER BY name";
        }else{
            $inquery = " ORDER BY name";
        }
        zememailsystem::$items['filter']['searchname'] = $name;

        //pagination
        $query = "SELECT COUNT(id) FROM ".zemesdb::$prefix."zememailsystem_customers";
        $query .= $inquery;
        $total = zemesdb::get_var($query);
        zememailsystem::$pager['total'] = $total;
        zememailsystem::$pager['pagination'] = zememailsystem::getPagination($total);

        //data
        $query = "SELECT customer.* , (SELECT SUM(sales.total) FROM ".zemesdb::$prefix."zememailsystem_sales AS sales WHERE sales.customerid = customer.id) AS totalpurchased
                    FROM ".zemesdb::$prefix."zememailsystem_customers AS customer";
        $query .= $inquery;
        $query .= " LIMIT ".zememailsystem::$pager['offset']." , ".zememailsystem::$pager['limit'];
        zememailsystem::$items[0] = zemesdb::get_results($query);

        return;
    }

    function storeCustomer($data) {
        if(empty($data)) return false;
        if($data['id']==''){
            $result = $this->isCustomerExist($data['name']);
            if ($result == true){
                return ALREADY_EXIST;
            }
        }
        $row = zemesincluder::getTable('customers');
        if (!$row->bind($data)) {
            return SAVE_ERROR;
        }
        if (!$row->store()) {
            return SAVE_ERROR;
        }
        return SAVED;
    }

    function deleteCustomer($id) {
        if(!is_numeric($id)) return false;
        $row = zemesincluder::getTable('customers');
        if ($this->customerCanDelete($id) == true) {
            if (!$row->delete($id)) {
                return DELETE_ERROR;
            }
        }else{
            return IN_USE;
        }
        return DELETED;
    }

    function customerCanDelete($id) {
        $query = "SELECT (COUNT(sales.id) FROM `".zemesdb::$prefix."zememailsystem_sales` AS sales WHERE sales.customerid = $id 
                        + 
                        COUNT(cr.id) FROM `".zemesdb::$prefix."zememailsystem_cashreceived` AS cr WHERE cr.customerid = $id ) AS total";
        $total = zemesdb::get_var($query);
        if(is_numeric($total)){if ($total > 0) {$result = false; }else{$result = true; } }else{$result = false; }
        return $result;
    }

    function publishUnpublish($id , $status) {
        if(!is_numeric($status)) return false;
        $row = zemesincluder::getTable('customers');
        if($status==1){
            if($row->update(array('id' => $id, 'status' => 1))){
                return PUBLISHED;
            }else{
                return PUBLISH_ERROR;
            }
        }elseif($status==0){
            if($row->update(array('id' => $id, 'status' => 0))){
                return UN_PUBLISHED;
            }else{
                return UN_PUBLISH_ERROR;
            }
        }
    }


    function isCustomerExist($name) {
        $query = "SELECT COUNT(id) FROM ".zemesdb::$prefix."zememailsystem_customers WHERE name = '$name'";
        $result = zemesdb::get_var($query);
        if ($result > 0)
            return true;
        else
            return false;
    }

    function getCustomersForCombo() {
        $query = "SELECT id, name AS text FROM `".zemesdb::$prefix."zememailsystem_customers` WHERE status = 1";
        $query.= " ORDER BY text ASC";
        $rows = zemesdb::get_results($query);
        return $rows;
    }
}
?>