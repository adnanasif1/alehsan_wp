<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemessaleitemnameszTable extends zemesztable{

	public $columns = array(
	    'id'=> '',
	    'itemname'=> '',
	    'ordering'=> '',
	    'isdefault'=> '',
	    'status'=> '',
	    'created'=> '',
	);

	function __construct() {
		parent::__construct('saleitemnames', $this->columns);
   	}
}
?>