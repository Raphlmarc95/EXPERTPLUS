<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auteur extends CI_Controller {

	/**
	* function __construct
	* @access public 
	* @return void
	*
	*/
	function __construct(){
		parent::__construct();
		$this->load->model('Auteur_model');
		$this->load->helper(array('url'));
		$this->load->library(array('session'));
		$this->load->model('Notification_model');
		$this->load->model('Recherche_model');
		$this->load->model('login_model');

		$this->load->helper('form');
		// $this->load->helper('form_validation');

		$this->load->library("pagination");
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

	/**
	* function index
	* @access public 
	* @return void
	*
	*/
	function index() {
		$data = new stdClass(); 
       // $this->load->view("evenement/Test", $data);
		if ( isset( $_GET['search'] )) {
			$this->search_x();
		} else {
			
			if (!isset($_GET['lettre']) ) {
				$auteurs = $this->Auteur_model->lister_auteur();
				
				$data->auteurs  = $auteurs;
				$this->notify();
				// $this->load->view('templates/header');
				$this->load->view('auteur/index', $data );
				$this->load->view('templates/footer');
			} else {
				$let = $_GET['lettre'];
				$auteurs = $this->Auteur_model->lister_auteur_nom($let);
				
				$data->auteurs  = $auteurs;
				$this->notify();
				// $this->page();
				// $this->load->view('templates/header');
				$this->load->view('auteur/index', $data);
				$this->load->view('templates/footer');
				// $this->page();
			}
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
			$fetch = $this->Recherche_model->search($search); var_dump($fetch);
			
			$data->fetch = $fetch;
			$this->notify();
			$this->load->view('search', $data); 
		} else {
			redirect('login/index');
		}
	}

	/**
	* function info
	* @access public 
	* @return void
	*
	*/
	function info() {
		if ( isset( $_GET['search'] )) {
			$this->search_x();
		} else {
			$data = new stdClass();
			$auteurs = $this->Auteur_model->info();

			foreach ($auteurs as $auteur ) { 
				$auteur->nbr_ouvrage = $this->Auteur_model->count_ouvrage_auteur($auteur->idmembre); 
				$auteur->nbr_event = $this->Auteur_model->count_event_auteur($auteur->idmembre); 
				$auteur->nbr_post = $this->Auteur_model->count_post_auteur($auteur->idmembre);

				$auteur->modify = $this->Auteur_model->modifier_compte($auteur->idmembre);
			}

			$data->auteurs  = $auteurs;

			// $this->load->view('templates/header');
			$this->notify();
			$this->load->view('auteur/info', $data);
			$this->load->view('templates/footer');
		}
	}

	/**
	* function ferme_compter
	* @access public 
	* @return void
	*
	*/
	function ferme_compter() {
		$idmembre = $_GET['id'];
		$this->Auteur_model->ferme_compter($idmembre);
		
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		redirect('login/index');
	}

	/**
	* function modifier_compte
	* @access public 
	* @return void
	*
	*/
	function modifier_compte() {
		if ( 	!empty($this->input->post('pseudo')) AND !empty($this->input->post('nom_prenom'))
			AND !empty($this->input->post('email'))  AND !empty($this->input->post('telephone')) 	 ) {
			
			$idmembre = $this->input->post('id');
			$pseudo = $this->input->post('pseudo');

			$nom_prenom = trim($this->input->post('nom_prenom'));
			$email = trim($this->input->post('email'));
			$mot_de_passe = trim(sha1($this->input->post('mot_de_passe')));
			$telephone = trim($this->input->post('telephone'));
			$desc = trim($this->input->post('desc'));

			$config['upload_path']      = 'assets/avatar/';
			$config['allowed_types']    = 'gif|jpg|png|GIF|JPG|PNG';
			$config['max_size']         = '5170';
			$config['max_width']        = '1024';
			$config['max_height']       = '1024';
			// $config['file_ext_tolower'] = true;
			$config['overwrite'] 		= true;
			$config['encrypt_name']     = true;

			$this->load->library('upload', $config);

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('userimage') ) {
				// $_SESSION['flash']['danger'] = 'l\'images n\'a pas pu etre upload il faut un format : gif | jpg | png | jpeg ' ;
				$error = array('error' => $this->upload->display_errors());
			} 
				$data =  $this->upload->data();
				$foto = $this->upload->file_name;
								
			$this->Auteur_model->modif($idmembre, $pseudo, $nom_prenom, $email, $telephone, $desc, $foto);		
		
			redirect('auteur/info?id='.$idmembre);
		} else {
			$_SESSION['flash']['alert'] = "Veuillez remplir tous les champs";
			redirect('auteur/info?id='.$this->session->userdata('idmembre'));
		}
	}

	// function page() {
 
 //       $config = array();
 
 //       $config["base_url"] = base_url() . "auteur/page";
 
 //       $config["total_rows"] = $this->Auteur_model->record_count();
 
 //       $config["per_page"] = 1;
 
 //       $config["uri_segment"] = 3;
 
 //       $this->pagination->initialize($config);
 
 //       $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 
 //       $data["results"] = $this->Auteur_model->fetch_departments($config["per_page"], $page);
 
 //       $data["links"] = $this->pagination->create_links();
 
	// 	// $this->load->view('evenement/Test');
 //        // $this->load->view("templates/footer", $data);
	// 	$this->load->view('templates/header');
 //    	$this->load->view("auteur/index");
 //    }

    // function p() {
    // 	$this->page();
    // }
}