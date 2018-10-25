<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesSalariesClass{

    function __construct() {}

    function getSalaryById($id) {
        if(!is_numeric($id)) return false;
        $query = "SELECT * FROM ".zemesdb::$prefix."zememailsystem_salaries WHERE id = ".$id;
        zememailsystem::$items[0] = zemesdb::get_row($query);
        return;
    }

    function getAllSalaries() {
        $employeename = zemesrequest::getVar('employeename');
        $inquery = '';
        if ($employeename) {
            $inquery = " WHERE employee.name LIKE '%$employeename%' ";
        }
        zememailsystem::$items['filter']['employeename'] = $employeename;

        //pagination
        $query = "SELECT COUNT(sal.id) FROM ".zemesdb::$prefix."zememailsystem_salaries AS sal
            JOIN ".zemesdb::$prefix."zememailsystem_employees AS employee ON employee.id = sal.employeeid";
        $query .= $inquery;
        $total = zemesdb::get_var($query);
        zememailsystem::$pager['total'] = $total;
        zememailsystem::$pager['pagination'] = zememailsystem::getPagination($total);

        //data
        $query = "SELECT sal.*, employee.name AS employeename
            FROM ".zemesdb::$prefix."zememailsystem_salaries AS sal
            JOIN ".zemesdb::$prefix."zememailsystem_employees AS employee ON employee.id = sal.employeeid";

        $query .= $inquery;
        $query .= " ORDER BY sal.salarydate DESC";
        $query .= " LIMIT ".zememailsystem::$pager['offset']." , ".zememailsystem::$pager['limit'];
        zememailsystem::$items[0] = zemesdb::get_results($query);

        return;
    }

    function storeSalary($data) {
        if(empty($data)) return false;

        $i = 0;
        $salary = 0;
        foreach ($data['amount'] as $value) {
            if(is_numeric($value))
                $salary += $value;
            else
                unset($data['amount'][$i]);
            $i++;
        }

        $data['salary'] = $salary;
        $data['amount'] = array_values($data['amount']);
        $data['amount'] = (empty($data['amount'])) ? '' : json_encode($data['amount']);

        $row = zemesincluder::getTable('salaries');
        if (!$row->bind($data)) {
            return SAVE_ERROR;
        }
        if (!$row->store()) {
            return SAVE_ERROR;
        }
        return SAVED;
    }

    function deleteSalary($id) {
        if(!is_numeric($id)) return false;
        $row = zemesincluder::getTable('salaries');
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
        $row = zemesincluder::getTable('salaries');
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