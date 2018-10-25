<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemesphonebookzTable extends zemesztable{

	public $columns = array(
	    'id'=> '',
	    'name'=> '',
	    'mobile'=> '',
	    'address'=> '',
	    'status'=> '',
	    'created'=> '',
	);

	function __construct() {
		parent::__construct('phonebook', $this->columns);
   	}
}
?>