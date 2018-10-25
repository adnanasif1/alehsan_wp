<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesPurchasesClass{

    function __construct() {}

    function getPurchasesById($id) {
        if(!is_numeric($id)) return false;
        $query = "SELECT * FROM ".zemesdb::$prefix."zememailsystem_purchases WHERE id=".$id;
        zememailsystem::$items[0] = zemesdb::get_row($query);
        return;
    }

    function getAllPurchases() {
        $itemname = zemesrequest::getVar('itemname');
        if ($itemname) {
            $inquery = " WHERE piname.itemname LIKE '%itemname%' ORDER BY purchasedate DESC";
        }else{
            $inquery = " ORDER BY p.purchasedate DESC";
        }
        zememailsystem::$items['filter']['itemname'] = $itemname;

        //pagination
        $query = "SELECT COUNT(p.id) 
            FROM ".zemesdb::$prefix."zememailsystem_purchases AS p
            JOIN ".zemesdb::$prefix."zememailsystem_purchaseitemnames AS piname ON piname.id = p.purchaseitemnameid ";
        $query .= $inquery;
        $total = zemesdb::get_var($query);
        zememailsystem::$pager['total'] = $total;
        zememailsystem::$pager['pagination'] = zememailsystem::getPagination($total);

        //data
        $query = "SELECT p.* , piname.itemname AS title
            FROM ".zemesdb::$prefix."zememailsystem_purchases AS p
            JOIN ".zemesdb::$prefix."zememailsystem_purchaseitemnames AS piname ON piname.id = p.purchaseitemnameid";
        $query .= $inquery;
        $query .= " LIMIT ".zememailsystem::$pager['offset']." , ".zememailsystem::$pager['limit'];
        zememailsystem::$items[0] = zemesdb::get_results($query);
        return;
    }

    function storePurchases($data) {
        if(empty($data)) return false;

        $row = zemesincluder::getTable('purchases');
        if(is_numeric($data['quantity']) AND is_numeric($data['rate'])){
            if($data['unit'] == 1){
                $total =  $data['quantity'] * $data['rate'];
            }elseif($data['unit'] == 2){
                $rate_per_kg = $data['rate'] / 37.324;
                $total =  $data['quantity'] * $rate_per_kg;
            }else{
                return false;
            }
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
        return SAVED;
    }


    function deletePurchases($id) {
        if(!is_numeric($id)) return false;
        $row = zemesincluder::getTable('purchases');
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
        $row = zemesincluder::getTable('purchases');
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