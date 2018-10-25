<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesSalesClass{

    function __construct() {}

    function getSaleById($id) {
        if(!is_numeric($id)) return false;
        $query = "SELECT * FROM ".zemesdb::$prefix."zememailsystem_sales WHERE id = ".$id;
        zememailsystem::$items[0] = zemesdb::get_row($query);
        return;
    }

    function getAllSales() {
        $purchaser = zemesrequest::getVar('purchaser');
        $itemname = zemesrequest::getVar('itemname');
        $inquery = ' WHERE 1 = 1';
        if ($purchaser) {
            $inquery .= " AND customers.name LIKE '%$purchaser%'";
        }
        if ($itemname) {
            $inquery .= " AND siname.itemname LIKE '%$itemname%'";
        }

        zememailsystem::$items['filter']['purchaser'] = $purchaser;
        zememailsystem::$items['filter']['itemname'] = $itemname;

        //pagination
        $query = "SELECT COUNT(sales.id) 
            FROM ".zemesdb::$prefix."zememailsystem_sales AS sales
            JOIN ".zemesdb::$prefix."zememailsystem_customers AS customers ON customers.id = sales.customerid
            JOIN ".zemesdb::$prefix."zememailsystem_saleitemnames AS siname ON siname.id = sales.saleitemnameid";
        $query .= $inquery;
        $total = zemesdb::get_var($query);
        zememailsystem::$pager['total'] = $total;
        zememailsystem::$pager['pagination'] = zememailsystem::getPagination($total);

        //data
        $query = "SELECT sales.* , customers.name AS customername, siname.itemname AS saleitemname
            FROM ".zemesdb::$prefix."zememailsystem_sales AS sales
            JOIN ".zemesdb::$prefix."zememailsystem_customers AS customers ON customers.id = sales.customerid
            JOIN ".zemesdb::$prefix."zememailsystem_saleitemnames AS siname ON siname.id = sales.saleitemnameid";

        $query .= $inquery;
        $query .= " ORDER BY sales.saledate DESC";
        $query .= " LIMIT ".zememailsystem::$pager['offset']." , ".zememailsystem::$pager['limit'];
        zememailsystem::$items[0] = zemesdb::get_results($query);

        return;
    }

    function storeSale($data) {
        if(empty($data)) return false;

        // Get sale row for receiveables
        $row_old = false;
        if( is_numeric($data['id'])){
            $query = "SELECT customerid,total,saledate FROM ".zemesdb::$prefix."zememailsystem_sales WHERE id = ".$data['id'];
            $row_old = zemesdb::get_row($query);            
        }
        // End

        $row = zemesincluder::getTable('sales');
        if(is_numeric($data['quantity']) AND is_numeric($data['rate']) AND is_numeric($data['customerid'])){
            $total =  $data['quantity'] * $data['rate'];
            if(is_numeric($data['carriage']))
                $total += $data['carriage'];
            $data['total'] = $total;
        }else{
            return false;
        }
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
        $data['saledate'] = date('Y-m-d' , strtotime($data['saledate']));
        if(is_numeric($data['id'])){
            if($row_old AND is_numeric($row_old->customerid)){
                if($row_old->customerid != $data['customerid']){
                    $query = "UPDATE ".zemesdb::$prefix."zememailsystem_accountreceiveables SET totalsale = totalsale - ".$row_old->total." WHERE customerid = ".$row_old->customerid;
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
                    $query = "SELECT totalsale FROM ".zemesdb::$prefix."zememailsystem_accountreceiveables WHERE customerid = ".$data['customerid'];
                    $totalsale = zemesdb::get_var($query);
                    if(is_numeric($totalsale)){
                        $query = "UPDATE ".zemesdb::$prefix."zememailsystem_accountreceiveables SET totalsale = totalsale + ".$data['total']." , lastsale = '".$data['saledate']."' WHERE customerid = ".$data['customerid'];
                        $res = zemesdb::query($query);
                        if($res === false){
                            $_errors[] = 3;
                        }
                    }else{ 
                        // insert entry if new customer is not in receiveables
                        $query = "INSERT INTO ".zemesdb::$prefix."zememailsystem_accountreceiveables 
                            (id, customerid, totalsale, lastsale) VALUES
                            ('', ".$data['customerid']." , ".$data['total']." , '".$data['saledate']."')";
                        $res = zemesdb::query($query);
                        if($res === false){
                            $_errors[] = 4;
                        }
                    }
                }else{
                    if($row_old->total > $data['total']){
                        $difference = $row_old->total - $data['total'];

                        $query = "UPDATE ".zemesdb::$prefix."zememailsystem_accountreceiveables SET totalsale = totalsale - ".$difference." WHERE customerid = ".$data['customerid'];
                        $res = zemesdb::query($query);
                        if($res === false){
                            $_errors[] = 5;
                        }
                    }elseif($row_old->total < $data['total']){
                        $difference = $data['total'] - $row_old->total;
                        
                        $query = "UPDATE ".zemesdb::$prefix."zememailsystem_accountreceiveables SET totalsale = totalsale + ".$difference." WHERE customerid = ".$data['customerid'];
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
            $query = "SELECT totalsale FROM ".zemesdb::$prefix."zememailsystem_accountreceiveables WHERE customerid = ".$data['customerid'];
            $totalsale = zemesdb::get_var($query);
            if(is_numeric($totalsale)){
                $query = "UPDATE ".zemesdb::$prefix."zememailsystem_accountreceiveables SET totalsale = totalsale + ".$data['total']." , lastsale = '".$data['saledate']."' WHERE customerid = ".$data['customerid'];
                $res = zemesdb::query($query);
                if($res === false){
                    $_errors[] = 8;
                }
            }else{ // new case entry in receiveables
                $query = "INSERT INTO ".zemesdb::$prefix."zememailsystem_accountreceiveables 
                    (id, customerid, totalsale, lastsale) VALUES
                    ('', ".$data['customerid']." , ".$data['total']." , '".$data['saledate']."')";
                $res = zemesdb::query($query);
                if($res === false){
                    $_errors[] = 9;
                }
            }
        }

        // now update balance column and LastSale Date
        $query = "UPDATE ".zemesdb::$prefix."zememailsystem_accountreceiveables 
            SET balance = (totalsale - totalcashin) , lastsale = (SELECT saledate FROM ".zemesdb::$prefix."zememailsystem_sales WHERE customerid = ".$data['customerid']." ORDER BY saledate DESC LIMIT 0 , 1 ) WHERE customerid = ".$data['customerid'];
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

    function deleteSale($id) {
        if(!is_numeric($id)) return false;
        // Get sale row for receiveables
        $query = "SELECT customerid,total FROM ".zemesdb::$prefix."zememailsystem_sales WHERE id = ".$id;
        $row_old = zemesdb::get_row($query);
        // End
        $row = zemesincluder::getTable('sales');
        if (true) {
            if (!$row->delete($id)) {
                return DELETE_ERROR;
            }
        }else{
            return IN_USE;
        }
        // Delete Also from receiveables
        $query = "UPDATE ".zemesdb::$prefix."zememailsystem_accountreceiveables SET totalsale = totalsale - ".$row_old->total." WHERE customerid = ".$row_old->customerid;
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
        $row = zemesincluder::getTable('sales');
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
