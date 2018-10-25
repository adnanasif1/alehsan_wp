<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemespurchaseitemnameszTable extends zemesztable{

	public $columns = array(
	    'id'=> '',
	    'itemname'=> '',
	    'ordering'=> '',
	    'isdefault'=> '',
	    'status'=> '',
	    'created'=> '',
	);

	function __construct() {
		parent::__construct('purchaseitemnames', $this->columns);
   	}
}
?>