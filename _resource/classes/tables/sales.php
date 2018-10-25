<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemessaleszTable extends zemesztable{

	public $columns = array(
	    'id'=> '',
	    'customerid'=> '',
	    'saleitemnameid'=> '',
	    'description'=> '',
	    'quantity'=> '',
	    'rate'=> '',
	    'carriage'=> '',
	    'total'=> '',
	    'saledate'=> '',
	    'status'=> '',
	    'created'=> ''
	);

	function __construct() {
		parent::__construct('sales', $this->columns);
   	}
}
?>