<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemesemployeeszTable extends zemesztable{

	public $columns = array(
	    'id'=> '',
	    'name'=> '',
	    'phone'=> '',
	    'advance'=> '',
	    'address'=> '',
	    'reference'=> '',
	    'referencephone'=> '',
	    'joiningdate'=> '',
	    'leavedate'=> '',
	    'status'=> '',
	    'created'=> ''
	);

	function __construct() {
		parent::__construct('employees', $this->columns);
   	}
}
?>