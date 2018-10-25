<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemescustomerszTable extends zemesztable{

	public $columns = array(
	    'id'=> '',
	    'name'=> '',
	    'shopname'=> '',
	    'emailaddress'=> '',
	    'mobile'=> '',
	    'phone'=> '',
	    'address'=> '',
	    'status'=> '',
	    'created'=> '',
	);

	function __construct() {
		parent::__construct('customers', $this->columns);
   	}
}
?>