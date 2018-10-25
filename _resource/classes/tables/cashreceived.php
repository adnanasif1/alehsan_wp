<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemescashreceivedzTable extends zemesztable{

	public $columns = array(
	    'id'=> '',
	    'customerid'=> '',
	    'cashin'=> '',
	    'cashindate'=> '',
	    'description'=> '',
	    'status'=> '',
	    'created'=> ''
	);

	function __construct() {
		parent::__construct('cashreceived', $this->columns);
   	}
}
?>