<?php 
 /**
 * 
 */
 class Notification extends CI_Controller {
 	
 	/**
 	* function __construct
 	* @access public
 	* @return void
 	*
 	*/
 	function __construct() {
 		parent::__construct();
 		$this->load->model('Notification_model');
 		$this->load->library(array('session'));
		$this->load->helper(array('url'));
 	}

 	/**
 	* function index
 	* @access public
 	* @return void
 	*
 	*/
 	function index () {
 		$data = new stdClass();

 		if (isset($_GET['notify_id'])) {
 			$notify_id = $this->uri->segment(3);
			$this->Notification_model->vue_notify($notify_id);
 		}			

		$notifications = $this->Notification_model->count_notify();
		
		foreach ($notifications as $notification ) {
			$notification->event_notify = $this->Notification_model->notification();
		}

		$data->notifications = $notifications;

		$this->load->view('templates/header', $data);
		$this->load->view('templates/notif');
		// $this->load->view('evenement/modifier', $data); 
	}
}