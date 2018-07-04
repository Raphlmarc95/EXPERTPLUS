<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	var $data = array();
	/**
	* function __construct
	* @access public 
	* @return void
	*
	*/
	function __construct(){
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->model('account_model');
		$this->load->model('Collection_model');
		$this->load->model('Notification_model');
		$this->load->model('Recherche_model');

		$this->load->model('evenement_model');
		$this->load->model('Auteur_model');
		$this->load->model('login_model');
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

			$notification->membres = $this->Notification_model->count_membre();

			$notification->event = $this->Notification_model->count_evenement();
			$notification->post  = $this->Notification_model->count_post();
			$notification->ouvrage  = $this->Notification_model->count_ouvrege();
		}

		$data->notifications = $notifications;

		$this->load->view('templates/header', $data);
		
	}
 	
 	/**
	* function index
	* @access public 
	* @return void
	*
	*/
	function index() {
		if ( isset( $_GET['search'] )) {
			$this->search_x();
		} else {
			// $data = new stdClass();


			$data = new stdClass();
			$auteurs = $this->Auteur_model->info_auteur_acc();
			foreach ($auteurs as $auteur ) { 
				$auteur->nbr_ouvrage = $this->Auteur_model->count_ouvrage_auteur($auteur->idmembre); 
				$auteur->nbr_event = $this->Auteur_model->count_event_auteur($auteur->idmembre); 
				$auteur->nbr_post = $this->Auteur_model->count_post_auteur($auteur->idmembre);
			}
			$data->auteurs  = $auteurs;
			$this->notify();
			// $this->load->view('templates/header');
			$this->load->view('index', $data);
	        $this->load->view('templates/footer');			
		}
	}
	
	/**
	* function search_x
	* @access public 
	* @return void
	*
	*/
	function search_x(){
		$data = new stdClass();	
		if ($_GET['search']) {
			$search = $_GET['search'];
			$fetch = $this->Recherche_model->search($search);
			
			$data->fetch = $fetch;
			$this->notify();
			$this->load->view('search', $data); 
		} else {
			redirect('login/index');
		}
	}

	/**
	* function logout
	* @access public 
	* @return void
	*
	*/
	function logout() {
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		   		
		header('Location:index');
	}

	/**
	* function confirmation
	* @access public 
	* @return void
	*
	*/
    function confirmation(){
		$user_id = $this->uri->segment(3);
		$token = $this->uri->segment(4);

		$this->load->helper('form');
		
		$result  = $this->account_model->confirmation($user_id, $token);
		if ($result) {
			foreach ($result as $user) {
				if ($user && $user->confirm_token === $token) {
					$_SESSION['flash']['success'] = 'Votre compté a étè confirmé avec succés' ;
					// $this->load->view('templates/header');
					$this->notify();
					$this->load->view('compte/connexion');
				} else {
					// $this->load->view('templates/header');
					$this->notify();
					$_SESSION['flash']['alert'] = 'Ce token n\'est plus valide' ;
					$this->load->view('compte/connexion');
				}				
			}			
		} else {
			// $this->load->view('templates/header');
			$this->notify();
			$_SESSION['flash']['alert'] = 'Ce token n\'est plus valide' ;
		    $this->load->view('compte/connexion');
		}
    }

    /**
	* function pass_fotgot
	* @access public 
	* @return void
	*
	*/
    function pass_fotgot() {
    	$this->load->helper('form');

    	if (!empty(trim($this->input->post('email')))) {

			$email = trim($this->input->post('email'));
			$reset_token = $this->security->get_csrf_hash();
			 
			$req = $this->account_model->password_fotgot($reset_token, $email); 
			 
			if ($req) {		
				$_SESSION['flash']['success'] = 'Un mail de réinitialisation vous a été envoyé ';		
		
				// $this->load->view('templates/header');
				$this->notify();
				// $this->load->view('compte/mail_recup');
				$this->load->view('compte/connexion');

			} else{
				$_SESSION['flash']['alert'] = 'Aucun compter ne correspond a cet email ';
				// $this->Exceptions->show_error();
				// $this->load->view('templates/header');
				$this->notify();
				$this->load->view('compte/mail_recup');
			}
		} else {
			// $this->load->view('templates/header');
			$this->notify();
			$this->load->view('compte/mail_recup');
		}
    }

    /**
	* function password_reset
	* @access public 
	* @return void
	*
	*/
    function password_reset(){
    	$this->load->helper('form');
    	$this->load->library('form_validation');

		$reset_token = $this->uri->segment(3);
        
		$result  = $this->account_model->password_reset($reset_token);
		if ($result) {
			foreach ($result as $user) {
				if ($user && $user->reset_token == $reset_token) {
					// $this->load->view('templates/header');
					$this->notify();
					$this->load->view('compte/pass_reset');
				} else{
					// $this->load->view('templates/header');
					$this->notify();
					$_SESSION['flash']['alert'] = 'Ce token n\'est plus valide ' ;
					$this->load->view('compte/pass_reset');
				}				
			} 		
		} else {
			// $this->load->view('templates/header');
			$this->notify();
			$_SESSION['flash']['alert'] = 'Ce token n\'est plus valide ' ;
			$this->load->view('compte/connexion');
		}
    }

    /**
	* function update
	* @access public 
	* @return void
	*
	*/
    function update_pass(){
    	$this->load->helper('form');
    	$this->load->library('form_validation');
    	$this->form_validation->set_rules('mot_de_passe', 'nouveau mot de passe', 'trim|required|min_length[8]|htmlspecialchars');
		$this->form_validation->set_rules('mot_de_passe_c', 'mot de passe de confirmation', 'trim|required|min_length[8]|htmlspecialchars|matches[mot_de_passe]');

		if ($this->form_validation->run() === FALSE) {
			// $this->load->view('templates/header');
			$this->notify();
			$this->load->view('compte/pass_reset');
		}else {
			$mot_de_passe = sha1($this->input->post('mot_de_passe'));
			$query = $this->account_model->update_pass($mot_de_passe);
			if ($query) {
				$_SESSION['flash']['success'] = 'Votre mot de passe a été modifier avec succés ';
				// $this->load->view('templates/header');
				$this->notify();
				$this->load->view('compte/connexion');
			}else {
				$_SESSION['flash']['alert'] = 'Une erreur ce produit lors de la mise a jour de votre mot de passe ';
				// $this->load->view('templates/header');
				$this->notify();
				$this->load->view('compte/mail_recup');
			}			
		}
    }
}