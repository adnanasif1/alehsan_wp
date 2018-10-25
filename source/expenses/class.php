<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesExpensesClass{

    function __construct() {}

    function getExpenseById($id) {
        if(!is_numeric($id)) return false;
        $query = "SELECT * FROM ".zemesdb::$prefix."zememailsystem_expenses WHERE id = ".$id;
        zememailsystem::$items[0] = zemesdb::get_row($query);
        return;
    }

    function getAllExpenses() {
        $expensename = zemesrequest::getVar('expensename');
        $expensetype = zemesrequest::getVar('expensetype');
        $inquery = ' WHERE 1 = 1 ';
        if ($expensename) {
            $inquery .= " AND ein.itemname LIKE '%$expensename%'";
        }
        if ($expensetype) {
            $inquery .= " AND etype.itemname LIKE '%$expensetype%'";
        }

        zememailsystem::$items['filter']['expensename'] = $expensename;
        zememailsystem::$items['filter']['expensetype'] = $expensetype;

        //pagination
        $query = "SELECT COUNT(exp.id) FROM ".zemesdb::$prefix."zememailsystem_expenses AS exp
            JOIN ".zemesdb::$prefix."zememailsystem_expenseitemnames AS ein ON ein.id = exp.expenseitemnameid
            JOIN ".zemesdb::$prefix."zememailsystem_expensetypes AS etype ON etype.id = exp.expensetypeid";
        $query .= $inquery;
        $total = zemesdb::get_var($query);
        zememailsystem::$pager['total'] = $total;
        zememailsystem::$pager['pagination'] = zememailsystem::getPagination($total);

        //data
        $query = "SELECT ein.itemname AS expensename , etype.itemname AS expensetype , exp.*
            FROM ".zemesdb::$prefix."zememailsystem_expenses AS exp
            JOIN ".zemesdb::$prefix."zememailsystem_expenseitemnames AS ein ON ein.id = exp.expenseitemnameid
            JOIN ".zemesdb::$prefix."zememailsystem_expensetypes AS etype ON etype.id = exp.expensetypeid";

        $query .= $inquery;
        $query .= " ORDER BY exp.expensedate DESC";
        $query .= " LIMIT ".zememailsystem::$pager['offset']." , ".zememailsystem::$pager['limit'];
        zememailsystem::$items[0] = zemesdb::get_results($query);

        return;
    }

    function storeExpense($data) {
        if(empty($data)) return false;
        $row = zemesincluder::getTable('expenses');
        if(is_numeric($data['price'])){

        }else{
            return false;
        }
        if (!$row->bind($data)) {
            return SAVE_ERROR;
        }
        if (!$row->store()) {
            return SAVE_ERROR;
        }
        return SAVED;
    }

    function deleteExpense($id) {
        if(!is_numeric($id)) return false;
        $row = zemesincluder::getTable('expenses');
        if (true) {
            if (!$row->delete($id)) {
                return DELETE_ERROR;
            }
        }else{
            return IN_USE;
        }
        return DELETED;
    }

    function publishUnpublish($id , $status) {
        if(!is_numeric($status)) return false;
        $row = zemesincluder::getTable('expenses');
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
}
?>