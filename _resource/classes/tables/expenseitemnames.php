<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemesexpenseitemnameszTable extends zemesztable{

	public $columns = array(
	    'id'=> '',
	    'itemname'=> '',
	    'ordering'=> '',
	    'isdefault'=> '',
	    'status'=> '',
	    'created'=> '',
	);

	function __construct() {
		parent::__construct('expenseitemnames', $this->columns);
   	}
}
?>