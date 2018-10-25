<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesEmployeesClass{

    function __construct() {}

    function getEmployeeById($id) {
        if(!is_numeric($id)) return false;
        $query = "SELECT * FROM ".zemesdb::$prefix."zememailsystem_employees WHERE id=".$id;
        zememailsystem::$items[0] = zemesdb::get_row($query);
        return;
    }

    function getAllEmployees() {
        $name = zemesrequest::getVar('searchname');
        $inquery='';
        if ($name) {
            $inquery = " WHERE name LIKE '%$name%' ORDER BY name ASC ";
        }else{
            $inquery = " ORDER BY name ASC ";
        }
        zememailsystem::$items['filter']['searchname'] = $name;

        //pagination
        $query = "SELECT COUNT(id) FROM ".zemesdb::$prefix."zememailsystem_employees";
        $query .= $inquery;
        $total = zemesdb::get_var($query);
        zememailsystem::$pager['total'] = $total;
        zememailsystem::$pager['pagination'] = zememailsystem::getPagination($total);

        //data
        $query = "SELECT emp.* FROM ".zemesdb::$prefix."zememailsystem_employees AS emp";
        $query .= $inquery;
        $query .= " LIMIT ".zememailsystem::$pager['offset']." , ".zememailsystem::$pager['limit'];
        zememailsystem::$items[0] = zemesdb::get_results($query);

        return;
    }

    function storeEmployee($data) {
        if(empty($data)) return false;
        if($data['id']==''){
            $result = $this->isEmployeeExist($data['name']);
            if ($result == true){
                return ALREADY_EXIST;
            }
        }
        $row = zemesincluder::getTable('employees');
        if (!$row->bind($data)) {
            return SAVE_ERROR;
        }
        if (!$row->store()) {
            return SAVE_ERROR;
        }
        return SAVED;
    }

    function deleteEmployee($id) {
        if(!is_numeric($id)) return false;
        $row = zemesincluder::getTable('employees');
        if ($this->canDeleteEmployee($id) == true) {
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
        $row = zemesincluder::getTable('employees');
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

    function canDeleteEmployee($id) {
        if(!is_numeric($id)) return false;
        $query = "SELECT COUNT(id) FROM `". zemesdb::$prefix."zememailsystem_salaries` WHERE employeeid = ".$id;
        $total = zemesdb::get_var($query);
        if(is_numeric($total)){if ($total > 0) {$result = false; }else{$result = true; } }else{$result = false; }
        return $result;
    }

    function isEmployeeExist($name) {
        $query = "SELECT COUNT(id) FROM ".zemesdb::$prefix."zememailsystem_employees WHERE name = '{$name}'";
        $result = zemesdb::get_var($query);
        if ($result > 0)
            return true;
        else
            return false;
    }

    function getEmployeesForCombo() {
        $query = "SELECT id, name AS text FROM `".zemesdb::$prefix."zememailsystem_employees` WHERE status = 1";
        $query.= " ORDER BY name ASC";
        $rows = zemesdb::get_results($query);
        return $rows;
    }
}
?>