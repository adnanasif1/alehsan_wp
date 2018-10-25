<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemespurchaseszTable extends zemesztable{

	public $columns = array(
	    'id'=> '',
	    'purchaseitemnameid'=> '',
	    'note'=> '',
	    'quantity'=> '',
	    'rate'=> '',
	    'unit'=> '',
	    'total'=> '',
	    'purchasedate'=> '',
	    'status'=> '',
	    'created'=> ''
	);

	function __construct() {
		parent::__construct('purchases', $this->columns);
   	}
}
?>