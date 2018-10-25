<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesCashreceivedClass{

    function __construct() {}

    function getCashreceivedById($id) {
        if(!is_numeric($id)) return false;
        $query = "SELECT * FROM ".zemesdb::$prefix."zememailsystem_cashreceived WHERE id = ".$id;
        zememailsystem::$items[0] = zemesdb::get_row($query);
        return;
    }

    function getAllCashreceived() {
        $customername = zemesrequest::getVar('customername');
        $inquery='';
        if ($customername) {
            $inquery = " WHERE customers.name LIKE '%$customername%' ";
        }
        zememailsystem::$items['filter']['customername'] = $customername;

        //pagination
        $query = "SELECT COUNT(cr.id) 
            FROM ".zemesdb::$prefix."zememailsystem_cashreceived AS cr
            JOIN ".zemesdb::$prefix."zememailsystem_customers AS customers ON customers.id = cr.customerid";
        $query .= $inquery;
        $total = zemesdb::get_var($query);
        zememailsystem::$pager['total'] = $total;
        zememailsystem::$pager['pagination'] = zememailsystem::getPagination($total);

        //data
        $query = "SELECT cr.* , customers.name AS customername
            FROM ".zemesdb::$prefix."zememailsystem_cashreceived AS cr
            JOIN ".zemesdb::$prefix."zememailsystem_customers AS customers ON customers.id = cr.customerid";

        $query .= $inquery;
        $query .= " ORDER BY cr.cashindate DESC";
        $query .= " LIMIT ".zememailsystem::$pager['offset']." , ".zememailsystem::$pager['limit'];
        zememailsystem::$items[0] = zemesdb::get_results($query);

        return;
    }

    function storeCashreceived($data) {
        if(empty($data)) return false;
        
        // Get cashin row for customers
        $row_old = false;
        if( is_numeric($data['id'])){
            $query = "SELECT customerid,cashin FROM ".zemesdb::$prefix."zememailsystem_cashreceived WHERE id = ".$data['id'];
            $row_old = zemesdb::get_row($query);
        }
        // End

        $row = zemesincluder::getTable('cashreceived');
        if (!$row->bind($data)) {
            return SAVE_ERROR;
        }
        if (!$row->store()) {
            return SAVE_ERROR;
        }
        
        // Update Receiveables entries
        $this->updateAccountReceiveable($data , $row_old);

        return SAVED;
    }

    private function updateAccountReceiveable($data , $row_old){
        $_errors = array();
        $data['cashindate'] = date('Y-m-d' , strtotime($data['cashindate']));
        if(is_numeric($data['id'])){
            if($row_old AND is_numeric($row_old->customerid)){
                if($row_old->customerid != $data['customerid']){
                    $query = "UPDATE ".zemesdb::$prefix."zememailsystem_accountreceiveables SET totalcashin = totalcashin - ".$row_old->cashin." WHERE customerid = ".$row_old->customerid;
                    $res = zemesdb::query($query);
                    if($res === false){
                        $_errors[] = 1;
                    }
                    // now update balance column
                    $query = "UPDATE ".zemesdb::$prefix."zememailsystem_accountreceiveables 
                        SET balance = (totalsale - totalcashin) WHERE customerid = ".$row_old->customerid;
                    $res = zemesdb::query($query);
                    if($res === false){
                        $_errors[] = 2;
                    }
                    // End balce comlun
                    $query = "SELECT totalcashin FROM ".zemesdb::$prefix."zememailsystem_accountreceiveables WHERE customerid = ".$data['customerid'];
                    $totalcashin = zemesdb::get_var($query);
                    if(is_numeric($totalcashin)){
                        $query = "UPDATE ".zemesdb::$prefix."zememailsystem_accountreceiveables SET totalcashin = totalcashin + ".$data['cashin']." , lastcashin = '".$data['cashindate']."' WHERE customerid = ".$data['customerid'];
                        $res = zemesdb::query($query);
                        if($res === false){
                            $_errors[] = 3;
                        }
                    }else{ 
                        // insert entry if new customer is not in receiveables
                        $query = "INSERT INTO ".zemesdb::$prefix."zememailsystem_accountreceiveables 
                            (id, customerid, totalcashin, lastcashin) VALUES
                            ('', ".$data['customerid']." , ".$data['cashin']." , '".$data['cashindate']."')";
                        $res = zemesdb::query($query);
                        if($res === false){
                            $_errors[] = 4;
                        }
                    }
                }else{
                    if($row_old->cashin > $data['cashin']){
                        $difference = $row_old->cashin - $data['cashin'];

                        $query = "UPDATE ".zemesdb::$prefix."zememailsystem_accountreceiveables SET totalcashin = totalcashin - ".$difference." WHERE customerid = ".$data['customerid'];
                        $res = zemesdb::query($query);
                        if($res === false){
                            $_errors[] = 5;
                        }
                    }elseif($row_old->cashin < $data['cashin']){
                        $difference = $data['cashin'] - $row_old->cashin;
                        
                        $query = "UPDATE ".zemesdb::$prefix."zememailsystem_accountreceiveables SET totalcashin = totalcashin + ".$difference." WHERE customerid = ".$data['customerid'];
                        $res = zemesdb::query($query);
                        if($res === false){
                            $_errors[] = 6;
                        }
                    }
                }
            }else{
                $_errors[] = 7;
            }
        }else{ // new case entry in receiveables
            $query = "SELECT totalcashin FROM ".zemesdb::$prefix."zememailsystem_accountreceiveables WHERE customerid = ".$data['customerid'];
            $totalcashin = zemesdb::get_var($query);
            if(is_numeric($totalcashin)){
                $query = "UPDATE ".zemesdb::$prefix."zememailsystem_accountreceiveables SET totalcashin = totalcashin + ".$data['cashin']." , lastcashin = '".$data['cashindate']."' WHERE customerid = ".$data['customerid'];
                $res = zemesdb::query($query);
                if($res === false){
                    $_errors[] = 8;
                }
            }else{ // new case entry in receiveables
                $query = "INSERT INTO ".zemesdb::$prefix."zememailsystem_accountreceiveables 
                    (id, customerid, totalcashin, lastcashin) VALUES
                    ('', ".$data['customerid']." , ".$data['cashin']." , '".$data['cashindate']."')";
                $res = zemesdb::query($query);
                if($res === false){
                    $_errors[] = 9;
                }
            }
        }

        // now update balance column and lastcashin Date column
        $query = "UPDATE ".zemesdb::$prefix."zememailsystem_accountreceiveables 
            SET balance = (totalsale - totalcashin) , lastcashin = (SELECT cashindate FROM ".zemesdb::$prefix."zememailsystem_cashreceived WHERE customerid = ".$data['customerid']." ORDER BY cashindate DESC LIMIT 0 , 1 ) WHERE customerid = ".$data['customerid'];
        $res = zemesdb::query($query);
        if($res === false){
            $_errors[] = 10;
        }
        // End balce comlun

        if(!empty($_errors)){
            print_r($_errors);
            die('<br /> Contact to system administrator !');
        }else{
            return true;
        }
    }


    function deleteCashreceived($id) {
        if(!is_numeric($id)) return false;

        // Get sale row for receiveables
        $query = "SELECT customerid,cashin FROM ".zemesdb::$prefix."zememailsystem_cashreceived WHERE id = ".$id;
        $row_old = zemesdb::get_row($query);
        // End

        $row = zemesincluder::getTable('cashreceived');
        if (true) {
            if (!$row->delete($id)) {
                return DELETE_ERROR;
            }
        }else{
            return IN_USE;
        }
        // Delete Also from receiveables
        $query = "UPDATE ".zemesdb::$prefix."zememailsystem_accountreceiveables SET totalcashin = totalcashin - ".$row_old->cashin." WHERE customerid = ".$row_old->customerid;
        $res = zemesdb::query($query);
        if($res === false){
            return DELETE_ERROR;
        }
        // now update balance column
        $query = "UPDATE ".zemesdb::$prefix."zememailsystem_accountreceiveables 
            SET balance = (totalsale - totalcashin) WHERE customerid = ".$row_old->customerid;
        $res = zemesdb::query($query);
        if($res === false){
            return DELETE_ERROR;
        }
        // End balce comlun

        return DELETED;
    }

    function publishUnpublish($id , $status) {
        if(!is_numeric($status)) return false;
        $row = zemesincluder::getTable('cashreceived');
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
