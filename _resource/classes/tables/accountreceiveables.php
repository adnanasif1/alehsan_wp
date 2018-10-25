<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemesaccountreceiveableszTable extends zemesztable{

	public $columns = array(
	    'id'=> '',
	    'customerid'=> '',
	    'totalsale'=> '',
	    'totalcashin'=> '',
	    'balance'=> '',
	    'lastsale'=> '',
	    'lastcashin'=> ''
	);

	function __construct() {
		parent::__construct('accountreceiveables', $this->columns);
   	}
}
?>