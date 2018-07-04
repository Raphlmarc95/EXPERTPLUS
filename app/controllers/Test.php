<?php 

class Test extends CI_Controller {
	
	/**
 	* function __construct
 	* @access public
 	* @return void
 	*
 	*/
	function __construct()
	{
		parent::__construct();
	}

	/**
 	* function index
 	* @access public
 	* @return void
 	*
 	*/
	function index() {
		$this->output->enable_profiler(true);
	}	
}