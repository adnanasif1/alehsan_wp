<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemesexpenseszTable extends zemesztable{

	public $columns = array(
	    'id'=> '',
	    'expenseitemnameid'=> '',
	    'expensetypeid'=> '',
	    'note'=> '',
	    'price'=> '',
	    'expensedate'=> '',
	    'status'=> '',
	    'created'=> ''
	);

	function __construct() {
		parent::__construct('expenses', $this->columns);
   	}
}
?>