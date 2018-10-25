<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemesexpensetypeszTable extends zemesztable{

	public $columns = array(
	    'id'=> '',
	    'itemname'=> '',
	    'ordering'=> '',
	    'isdefault'=> '',
	    'status'=> '',
	    'created'=> '',
	);

	function __construct() {
		parent::__construct('expensetypes', $this->columns);
   	}
}
?>