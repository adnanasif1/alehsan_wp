<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemessalarieszTable extends zemesztable{

	public $columns = array(
	    'id'=> '',
	    'employeeid'=> '',
	    'details'=> '',
	    'salary'=> '',
	    'amount'=> '',
	    'salarydate'=> '',
	    'status'=> '',
	    'created'=> ''
	);

	function __construct() {
		parent::__construct('salaries', $this->columns);
   	}
}
?>