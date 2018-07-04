<?php 

class Rechercher extends CI_Controller {
	
	/**
 	* function __construct
 	* @access public
 	* @return void
 	*
 	*/
	function __construct() 	{
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
				$this->load->model('Notification_model');
		$this->load->model('Recherche_model');
	}

	/**
 	* function index
 	* @access public
 	* @return void
 	*
 	*/
	function index(){
		// $search = $_GET['search']; 
		if ($_GET['search']) {
			$search = $_GET['search'];
			$fetch = $this->Recherche_model->search($search);
			if ($fetch) {
				foreach ($fetch as $key) {
					$data = array(
						'pseudo'			=> $key->pseudo,
						'email'				=> $key->email,
						'sexe'				=> $key->sexe,
						'date_naissance'	=> $key->date_naissance,
						'status'			=> $key->status,
						'photo'				=> $key->photo,
						'nom_prenom'		=> $key->nom_prenom
					);				
				}
				$this->notify();
				$this->load->view('search', $data); 
			}
		}
	}

	/**
 	* function notify
 	* @access public
 	* @return void
 	*
 	*/
	function notify () {
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
	}
}