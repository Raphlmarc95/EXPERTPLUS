<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		$this->load->model('login_model');
		$this->load->model('Notification_model');
		$this->load->model('Collection_model');
		$this->load->model('Recherche_model');
	}

	/**
	* function notify
	* @access public 
	* @return void
	*
	*/
	function notify() {
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
    	$this->login_model->visiteurs();
    	if ( isset( $_GET['search'] ) ) {
  			$this->search_x();
 		} else {
	    	$this->load->model('evenement_model');
	    	$this->load->model('Auteur_model');
	    	$data = new stdClass();
			$auteurs = $this->Auteur_model->info_auteur_acc();

			foreach ($auteurs as $auteur ) { 
				$auteur->nbr_ouvrage = $this->Auteur_model->count_ouvrage_auteur($auteur->idmembre); 
				$auteur->nbr_event = $this->Auteur_model->count_event_auteur($auteur->idmembre); 
				$auteur->nbr_post = $this->Auteur_model->count_post_auteur($auteur->idmembre);
			}

		    $this->notify();
		    // $this->count_membre();

			$data->auteurs  = $auteurs;
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
	* function count_membre
	* @access public 
	* @return void
	*
	*/
	function count_membre() {
		$data = new stdClass();			

		$membres = $this->Notification_model->count_membre();

		$data->membres = $membres;

		$this->load->view('templates/header', $data);
	}

	/**
	* function sign_in
	* @access public 
	* @return void
	*
	*/
	function sign_in() {
		// create the data object
		$data = new stdClass();

		$this->load->helper('form');
		$this->load->library('form_validation');

		if ($this->input->post('sign_in')) {

			if ( !empty(trim($this->input->post('pseudo'))) AND !empty(trim($this->input->post('mot_de_passe'))) ) {

		 	$pseudo =  trim($this->input->post('pseudo'));	
			$pass   =  sha1(trim($this->input->post('mot_de_passe')));
		    $result =  $this->login_model->sign_in($pseudo, $pass);
		    if(!$result) {
		    	$_SESSION['flash']['alert'] = 'Ce compte n\'est pas actif, merci de verifier votre addresse mail pour la confirmation.';
		    	$this->notify();
				// $this->load->view('templates/header');
				$this->load->view('compte/connexion');
				$this->load->view('templates/footer');			    
			}else {
				foreach ($result as $user) {
			    	if ( !empty($user->pseudo) && $user->mot_de_passe === $pass && $user->actif === '1') {
			    		$sess_array = array(
			    			'status' 		=> $user->status,
						    'pseudo' 		=> $pseudo,
						    'idmembre' 		=> $user->idmembre,
						    'photo' 		=> $user->photo,
						    'is_logged_in ' => TRUE 
						); 
						$this->session->set_userdata($sess_array);	
						$user = $this->session->userdata();

						redirect('account');
						// current_url('http://localhost/biblioplus/collection/index');
			    	} else if( $user->mot_de_passe != $pass ) {
				    		$_SESSION['flash']['alert'] = 'Connexion incorrect ';
				    		$this->notify();
							// $this->load->view('templates/header');
							$this->load->view('compte/connexion');
							$this->load->view('templates/footer');

				    	} elseif (!empty($user->pseudo) && $user->actif === '0' ) {
				    		$_SESSION['flash']['info'] = 'Cet compte n\'est plus actif ';
				    		$this->notify();
				    		// $this->load->view('templates/header');
							$this->load->view('compte/connexion');
				    	} else {
				    		$this->notify();
				    		// $this->load->view('templates/header');
							$this->load->view('compte/connexion', $data);
							$this->load->view('templates/footer');
				    	}
				    }
				}	 
			}  else {
				$_SESSION['flash']['alert'] = 'Veuillez remplir tous les champs ';
				// $this->load->view('templates/header');
				$this->notify();
				$this->load->view('compte/connexion');
				$this->load->view('templates/footer');
			}		
		} else {
			// $this->load->view('templates/header');
			$this->notify();
			$this->load->view('compte/connexion');
			$this->load->view('templates/footer');
		}
    }

    /**
	* function check_if_pseudo_exists
	* @access public 
	* @return bool
	*
	*/
    function check_if_pseudo_exists($request_pseudo){
    	$pseudo_available = $this->login_model->check_if_pseudo_exists($request_pseudo);
    	if ($pseudo_available) {
    		return TRUE;
    	}else {
    		return FALSE ;
    	}
    }

    /**
	* function check_if_email_exists
	* @access public 
	* @return bool
	*
	*/
    function check_if_email_exists($request_email){
    	$email_available = $this->login_model->check_if_email_exists($request_email);
    	if ($email_available) {
    		return TRUE;
    	}else {
    		return FALSE ;
    	}    	
    }

    /**
	* function ckeck_format_nom_prenom
	* @access public 
	* @return bool
	*
	*/
    function ckeck_format_nom_prenom($nom_prenom) {
    	if (!preg_match('/^[a-zA-Z ]+$/', trim($this->input->post('nom_prenom')))) {
    		return FALSE ;
    	}else {
    		return TRUE ;
    	}
    }

    /**
	* function ckeck_format_sexe
	* @access public 
	* @return bool
	*
	*/
    function ckeck_format_sexe($sexe){
    	if (!preg_match('/^[a-zA-Z]+$/', trim($this->input->post('sexe')))) {
    		return FALSE ;    		
    	} else {
    		return TRUE ;
    	}
    }

    /**
	* function sexe_valide
	* @access public 
	* @return bool
	*
	*/
    function sexe_valide(){
		if ( (trim($this->input->post('sexe')) === 'Masculin') OR (trim($this->input->post('sexe')) === 'Feminin') ){
			return TRUE;
		} else {
			return FALSE ;
		}
    }

    /**
	* function ckeck_format_pseudo
	* @access public 
	* @return bool
	*
	*/
    function ckeck_format_pseudo($pseudo){
    	if (!preg_match('/^[a-zA-Z0-9_]+$/', trim($this->input->post('pseudo')))) {
    		return false ;
    	} else {
    		return TRUE ;
    	}
    } 

    /**
	* function ckeck_format_email
	* @access public 
	* @return bool
	*
	*/
    function ckeck_format_email($email){
    	if (filter_var(trim($this->input->post('email')), FILTER_VALIDATE_EMAIL) ) {
    		return FALSE ;
    	} else {
    		return TRUE ;
    	}
    }

    /**
	* function ckeck_status_found
	* @access public 
	* @return bool
	*
	*/
    function ckeck_status_found($mem){
    	if (empty(trim($this->input->post('mem')))) {
    		return FALSE ;    		
    	} else {
    		return TRUE ;
    	}
    }

    /**
	* function ckeck_datenaiss_found
	* @access public 
	* @return bool
	*
	*/
    function ckeck_datenaiss_found($date_naissance){
    	if (empty(trim($this->input->post('date_naissance')))) {
    		return FALSE ;    		
    	} else {
    		return TRUE ;
    	}
    }

    /**
	* function ckeck_format_telephone
	* @access public 
	* @return bool
	*
	*/
    function ckeck_format_telephone($telephone){
    	if (!preg_match('/^[0-9_]+$/', trim($this->input->post('telephone')))) {
    		return false ;
    	} else {
    		return TRUE ;
    	}
    }

    /**
	* function sign_up
	* @access public 
	* @return void
	*
	*/
	function sign_up() {
		$data = new stdClass();

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('telephone', 'telephone', 'trim|required|callback_ckeck_format_telephone');
		$this->form_validation->set_rules('email', 'email', 'trim|required|callback_check_if_email_exists');
		$this->form_validation->set_rules('pseudo', 'pseudo', 'trim|required|callback_check_if_pseudo_exists');
		$this->form_validation->set_rules('mot_de_passe', 'mot de passe', 'trim|required|min_length[8]|htmlspecialchars');
		$this->form_validation->set_rules('mot_de_passe_c', 'mot de passe de confirmation', 'trim|min_length[8]|htmlspecialchars|matches[mot_de_passe]');

		if ($this->form_validation->run() === FALSE ) {
			// $_SESSION['flash']['success'] = 'Un mail de confirmation vous a été envoyé ';
			$this->notify();
			$this->load->view('compte/inscription');
			$this->load->view('templates/footer');
		} else {
			if($this->input->post('save')) {

				if (!empty(trim($this->input->post('nom_prenom'))) AND !empty(trim($this->input->post('sexe')))
					 AND !empty(trim($this->input->post('date_naissance'))) AND !empty(trim($this->input->post('email'))) 
					 AND !empty(trim($this->input->post('pseudo'))) AND !empty(trim($this->input->post('mot_de_passe'))) 
					 AND !empty(trim($this->input->post('mot_de_passe_c'))) AND !empty(trim($this->input->post('mem')))  )  {
					if ( $this->input->post('mot_de_passe_c') === $this->input->post('mot_de_passe') ) {
						# code...
						$config['upload_path']          = 'assets/avatar/';
						$config['allowed_types']    = 'gif|jpg|png|GIF|JPG|PNG';
						$config['max_size']         = '2048';
						$config['max_width']        = '1024';
						$config['max_height']       = '1024';
						$config['file_ext_tolower'] = true;
						$config['encrypt_name']     = true;

						$this->load->library('upload', $config);

						$this->upload->initialize($config);

						if ( ! $this->upload->do_upload('userimage') ) {
							// $_SESSION['flash']['danger'] = 'l\'images n\'a pas pu etre upload il faut un format : gif | jpg | png | jpeg ' ;
							$error = array('error' => $this->upload->display_errors());
						}
						else {
							$data =  $this->upload->data();					
						}
						if (!empty($data)) {
						    $this->login_model->sign_up($data);
						}else {
							$this->login_model->sign_up();
						}

						$_SESSION['flash']['success'] = 'Un mail de confirmation vous a été envoyé ';		
						// $this->load->view('templates/header');
						 $this->notify();
						$this->load->view('compte/connexion');
					} else {
						$this->notify();
						$_SESSION['flash']['alert'] = 'Les mot de passe doit être identique';
						$this->load->view('compte/inscription');
						$this->load->view('templates/footer');
					}

				}else {				
					// $this->load->view('templates/header');
					$this->notify();
					$_SESSION['flash']['alert'] = 'Veuiller remplir tous les champs ';
					$this->load->view('compte/inscription');
					$this->load->view('templates/footer');
				}
			} else {
				$this->notify();
				$this->load->view('compte/inscription');
				$this->load->view('templates/footer');
			}
		}
	}

	function pas_trouve() {
		$this->load->view('templates/header');
		$this->load->view('errors/html/error_general');		
	}
}