<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesExpenseItemNamesClass{

    function __construct() {}

    function getExpenseItemNameById($id) {
        if(!is_numeric($id)) return false;
        $query = "SELECT * FROM ".zemesdb::$prefix."zememailsystem_expenseitemnames WHERE id = ".$id;
        zememailsystem::$items[0] = zemesdb::get_row($query);
        return;
    }

    function getAllExpenseItemNames() {
        $itemname = zemesrequest::getVar('itemname');
        $inquery='';
        if ($itemname) {
            $inquery = " WHERE itemname LIKE '%$itemname%' ORDER BY ordering ASC";
        }else{
            $inquery = " ORDER BY ordering ASC";
        }
        zememailsystem::$items['filter']['itemname'] = $itemname;

        //pagination
        $query = "SELECT COUNT(id) FROM ".zemesdb::$prefix."zememailsystem_expenseitemnames";
        $query .= $inquery;
        $total = zemesdb::get_var($query);
        zememailsystem::$pager['total'] = $total;
        zememailsystem::$pager['pagination'] = zememailsystem::getPagination($total);

        //data
        $query = "SELECT * FROM `".zemesdb::$prefix."zememailsystem_expenseitemnames`";
        $query .= $inquery;
        $query .= " LIMIT ".zememailsystem::$pager['offset']." , ".zememailsystem::$pager['limit'];
        zememailsystem::$items[0] = zemesdb::get_results($query);

        return;
    }

    function isExpenseItemExist($name) {
        $query = "SELECT COUNT(id) FROM ".zemesdb::$prefix."zememailsystem_expenseitemnames WHERE itemname = '$name'";
        $result = zemesdb::get_var($query);
        if ($result > 0)
            return true;
        else
            return false;
    }

    function storeExpenseItemName($data) {
        if(empty($data)) return false;

        if($data['id'] == ''){
            $result = $this->isExpenseItemExist($data['itemname']);
            if ($result == true){
                return ALREADY_EXIST;
            }
            $query = "SELECT MAX(`ordering`) FROM `". zemesdb::$prefix."zememailsystem_expenseitemnames`";
            $ordering = zemesdb::get_var($query);
            if(!$ordering) $ordering = 0;
            $ordering = $ordering + 1;
            $data['ordering'] = $ordering;
        }

        $row = zemesincluder::getTable('expenseitemnames');

        if (!$row->bind($data)) {
            return SAVE_ERROR;
        }
        if (!$row->store()) {
            return SAVE_ERROR;
        }
        return SAVED;
    }

    function canDeleteExpenseItemName($id){
        if(!is_numeric($id)) return false;
        $query = "SELECT COUNT(id) FROM `". zemesdb::$prefix."zememailsystem_expenses` WHERE expenseitemnameid = ".$id;
        $total = zemesdb::get_var($query);
        if(is_numeric($total)){if ($total > 0) {$result = false; }else{$result = true; } }else{$result = false; }
        return $result;
    }

    function deleteExpenseItemName($id) {
        if(!is_numeric($id)) return false;
        $row = zemesincluder::getTable('expenseitemnames');
        if ($this->canDeleteExpenseItemName($id)) {
            if (!$row->delete($id)) {
                return DELETE_ERROR;
            }
        }else{
            return IN_USE;
        }
        return DELETED;
    }

    function setOrdering($id , $order , $table_name) {
        if (!is_numeric($id))
            return false;
        if($table_name){
            $table_name = zemesdb::$prefix."zememailsystem_".$table_name;
        }else{ 
            return false;
        }
        if ($order == 'down') {
            $order = ">";
            $sort = "ASC";
            $res = ORDERDOWN;
        } else {
            $order = "<";
            $sort = "DESC";
            $res = ORDERUP;
        }
        $query = "SELECT t.ordering,t.id,t2.ordering AS ordering2 FROM `". $table_name."` AS t, `". $table_name."` AS t2 WHERE t.ordering $order t2.ordering AND t2.id = $id ORDER BY t.ordering $sort LIMIT 1";
        $result = zemesdb::get_row($query);
        if($result){
            $query = "UPDATE `". $table_name."` SET ordering = " . $result->ordering . " WHERE id = " . $id;
            zemesdb::query($query);
            $query = "UPDATE `". $table_name."` SET ordering = " . $result->ordering2 . " WHERE id = " . $result->id;
            zemesdb::query($query);
        }else{
            $res = false;
        }
        return $res;
    }

    function publishUnpublish($id , $status) {
        if(!is_numeric($status)) return false;
        $row = zemesincluder::getTable('expenseitemnames');
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
    
    function getExpenseItemNamesCombo() {
        $query = "SELECT id , itemname AS text FROM `". zemesdb::$prefix."zememailsystem_expenseitemnames` WHERE status = 1 ORDER BY ordering ASC";
        $list = zemesdb::get_results($query);
        return $list;
    }
}
?>