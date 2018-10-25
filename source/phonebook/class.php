<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesPhonebookClass{

    function __construct() {}

    function getPhonebookById($id) {
        if(!is_numeric($id)) return false;
        $query = "SELECT * FROM ".zemesdb::$prefix."zememailsystem_phonebook WHERE id=".$id;
        zememailsystem::$items[0] = zemesdb::get_row($query);
        return;
    }

    function getAllPhonebook() {
        $name = zemesrequest::getVar('searchname');
        $inquery='';
        if ($name) {
            $inquery = " WHERE name LIKE '%$name%' ORDER BY name";
        }else{
            $inquery = " ORDER BY name";
        }
        zememailsystem::$items['filter']['searchname'] = $name;

        //pagination
        $query = "SELECT COUNT(id) FROM ".zemesdb::$prefix."zememailsystem_phonebook";
        $query .= $inquery;
        $total = zemesdb::get_var($query);
        zememailsystem::$pager['total'] = $total;
        zememailsystem::$pager['pagination'] = zememailsystem::getPagination($total);

        //data
        $query = "SELECT * FROM ".zemesdb::$prefix."zememailsystem_phonebook";
        $query .= $inquery;
        $query .= " LIMIT ".zememailsystem::$pager['offset']." , ".zememailsystem::$pager['limit'];
        zememailsystem::$items[0] = zemesdb::get_results($query);

        return;
    }

    function storePhonebook($data) {
        if(empty($data)) return false;
        if($data['id']==''){
            $result = $this->isPhonebookExist($data['name']);
            if ($result == true){
                return ALREADY_EXIST;
            }
        }
        $row = zemesincluder::getTable('phonebook');
        if (!$row->bind($data)) {
            return SAVE_ERROR;
        }
        if (!$row->store()) {
            return SAVE_ERROR;
        }
        return SAVED;
    }

    function deletePhonebook($id) {
        if(!is_numeric($id)) return false;
        $row = zemesincluder::getTable('phonebook');
        if ($this->canDeletePhonebook($id) == true) {
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
        $row = zemesincluder::getTable('phonebook');
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

    function canDeletePhonebook($id) {
        return true;
    }

    function isPhonebookExist($name) {
        $query = "SELECT COUNT(id) FROM ".zemesdb::$prefix."zememailsystem_phonebook WHERE name = '{$name}'";
        $result = zemesdb::get_var($query);
        if ($result > 0)
            return true;
        else
            return false;
    }

    function getPhonebookForCombo() {
        $query = "SELECT id, name AS text FROM `".zemesdb::$prefix."zememailsystem_phonebook` WHERE status = 1";
        $query.= " ORDER BY name ASC";
        $rows = zemesdb::get_results($query);
        return $rows;
    }
}
?>