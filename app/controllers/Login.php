<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->model('login_model');
	}

    function index()	{
		$this->load->view('templates/header');
		$this->load->view('index');
	}

	function sign_in() {
		// create the data object
		$data = new stdClass();

		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');

		if ($this->input->post('sign_in')) {

			if ( !empty(trim($this->input->post('pseudo'))) AND !empty(trim($this->input->post('mot_de_passe'))) ) {

		 	$pseudo =  trim($this->input->post('pseudo'));	
			$pass   =  sha1(trim($this->input->post('mot_de_passe')));
		    $result =  $this->login_model->sign_in($pseudo, $pass);
		    if(!$result) {
		    	$_SESSION['flash']['danger'] = 'Ce compte n\'est pas actif, merci de verifier votre addresse mail pour la confirmation.';
				$this->load->view('templates/header');
				$this->load->view('sign_in');			    
			}else {
				foreach ($result as $user) {
			    	if ( !empty($user->pseudo) && $user->mot_de_passe === $pass ) {
			    		$sess_array = array( 
						    'pseudo' => $pseudo,
						    'idmembre' => $user->idmembre,
						    'photo' => $user->photo,
						    'is_logged_in ' => TRUE 
						); 
						$this->session->set_userdata($sess_array);	
						$user = $this->session->userdata();

						redirect('account');
			    	} else if( $user->mot_de_passe != $pass ) {
				    		$_SESSION['flash']['danger'] = 'Connexion incorrect ';
							$this->load->view('templates/header');
							$this->load->view('sign_in');

				    	} else {
				    		$this->load->view('templates/header');
							$this->load->view('sign_in', $data);
				    	}
				    }
				}	 
			}  else {
				$_SESSION['flash']['danger'] = 'Veuillez remplir tous les champs ';
				$this->load->view('templates/header');
				$this->load->view('sign_in');
			}		
		} else {
			$this->load->view('templates/header');
			$this->load->view('sign_in');
		}
    }

    // function check_if_pseudo_exists($request_pseudo){
    // 	$pseudo_available = $this->login->check_if_pseudo_exists($request_pseudo);
    // 	if ($pseudo_available) {
    // 		return TRUE;
    // 	}else {
    // 		return FALSE ;
    // 	}
    // }

    function check_if_email_exists($request_email){
    	$email_available = $this->login_model->check_if_email_exists($request_email);
    	if ($email_available) {
    		return TRUE;
    	}else {
    		return FALSE ;
    	}    	
    }

    function ckeck_format_nom_prenom($nom_prenom) {
    	if (!preg_match('/^[a-zA-Z ]+$/', trim($this->input->post('nom_prenom')))) {
    		return FALSE ;
    	}else {
    		return TRUE ;
    	}
    }

    function ckeck_format_sexe($sexe){
    	if (!preg_match('/^[a-zA-Z]+$/', trim($this->input->post('sexe')))) {
    		return FALSE ;    		
    	} else {
    		return TRUE ;
    	}
    }

    function sexe_valide(){
		if ( (trim($this->input->post('sexe')) === 'Masculin') OR (trim($this->input->post('sexe')) === 'Feminin') ){
			return TRUE;
		} else {
			return FALSE ;
		}
    }

    function ckeck_format_pseudo($pseudo){
    	if (!preg_match('/^[a-zA-Z0-9_]+$/', trim($this->input->post('pseudo')))) {
    		return false ;
    	} else {
    		return TRUE ;
    	}
    } 

    function ckeck_format_email($email){
    	if (filter_var(trim($this->input->post('email')), FILTER_VALIDATE_EMAIL) ) {
    		return FALSE ;
    	} else {
    		return TRUE ;
    	}
    }

    function ckeck_status_found($mem){
    	if (empty(trim($this->input->post('mem')))) {
    		return FALSE ;    		
    	} else {
    		return TRUE ;
    	}
    }
    function ckeck_datenaiss_found($date_naissance){
    	if (empty(trim($this->input->post('date_naissance')))) {
    		return FALSE ;    		
    	} else {
    		return TRUE ;
    	}
    }

	public function sign_up() {
		// create the data object
		$data = new stdClass();

		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');

		// set validation rules
		$this->form_validation->set_rules('nom_prenom', 'nom complet', 'trim|required|htmlspecialchars|callback_ckeck_format_nom_prenom');
		$this->form_validation->set_rules('pseudo', 'nom d\'utilisateur', 'trim|required|min_length[6]|max_length[12]|htmlspecialchars|callback_ckeck_format_pseudo');
		$this->form_validation->set_rules('mot_de_passe', 'mot de passe', 'trim|required|min_length[8]|htmlspecialchars');
		$this->form_validation->set_rules('mot_de_passe_c', 'mot de passe de confirmation', 'trim|min_length[8]|htmlspecialchars|matches[mot_de_passe]');
		$this->form_validation->set_rules('pseudo', 'nom d\'utilisateur', 'trim|required|min_length[6]|max_length[12]|htmlspecialchars|callback_ckeck_format_pseudo');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|htmlspecialchars|callback_check_if_email_exists');
		$this->form_validation->set_rules('date_naissance', 'date naissance', 'trim|required|htmlspecialchars|callback_ckeck_datenaiss_found');
		$this->form_validation->set_rules('mem', '', 'trim|required|htmlspecialchars|callback_ckeck_status_found');


		if ($this->form_validation->run() === FALSE) {

			// validation not ok, send validation errors to the view
			$this->load->view('templates/header');
			$this->load->view('form_register', $data);
		} else {
		
			if($this->input->post('save')) {

				if (!empty(trim($this->input->post('nom_prenom'))) AND !empty(trim($this->input->post('sexe')))
					 AND !empty(trim($this->input->post('date_naissance'))) AND !empty(trim($this->input->post('email'))) 
					 AND !empty(trim($this->input->post('pseudo'))) AND !empty(trim($this->input->post('mot_de_passe'))) 
					 AND !empty(trim($this->input->post('mot_de_passe_c'))) AND !empty(trim($this->input->post('mem')))  )  {

					$config['upload_path']          = 'assets/avatar/';
					// $config['allowed_types']        = 'gif|jpg|png|jpeg';
					// $config['max_size']             = 0;
					// $config['max_width']            = 180;
					// $config['max_height']           = 240;

					$config['allowed_types']    = 'gif|jpg|png';
					$config['max_size']         = 2048;
					$config['max_width']        = 1024;
					$config['max_height']       = 1024;
					$config['file_ext_tolower'] = true;
					$config['encrypt_name']     = true;

					$this->load->library('upload', $config);

					// $this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ( ! $this->upload->do_upload('userfile') )
					{
						// $_SESSION['flash']['danger'] = 'l\'images n\'a pas pu etre upload il faut un format : gif | jpg | png | jpeg ' ;
						$error = array('error' => $this->upload->display_errors());
					}
					else
					{
						// $data = array('upload_data' => $this->upload->data());
						$data =  $this->upload->data();					
					}
					if (!empty($data)) {
					    $this->login_model->sign_up($data);
					}else {
						$this->login_model->sign_up();
					}

					$_SESSION['flash']['success'] = 'Un mail de confirmation vous a été envoyé ';		
					$this->load->view('templates/header');
					$this->load->view('sign_in');

				}else {				
					$this->load->view('templates/header');
					$_SESSION['flash']['danger'] = 'Remplir tous les champs ';
					$this->load->view('form_register');
				}
			} 
		}
	}
}