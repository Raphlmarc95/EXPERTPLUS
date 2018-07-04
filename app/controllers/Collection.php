<?php

class Collection extends CI_Controller {

	/**
	* function __construct
	* @access public 
	* @return void
	*
	*/	
	function __construct() {
 		parent::__construct();
 		$this->load->helper(array('url'));
 		$this->load->library(array('session'));
 		$this->load->model('Collection_model');
 		$this->load->model('Notification_model');
 		$this->load->model('Recherche_model');
 		$this->load->model('login_model');

 		$this->load->helper('form');
		$this->load->library('form_validation');
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
 	public function index() {
 		if ( isset( $_GET['search'] ) ) {
  			$this->search_x();
 		} else {
			$this->notify();
			$this->load->view('collection/collection');
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
			$fetch = $this->Recherche_model->search($search); // var_dump($fetch);
			
			$data->fetch = $fetch;
			$this->notify();
			$this->load->view('search', $data); 
		} else {
			redirect('login/index');
		}
	}

	/**
	* function inserer_livre
	* @access public 
	* @return void
	*
	*/
	function inserer_livre(){
			$this->load->library('upload');
			if ($this->input->post('ajout_ouvrage')) {
				if (!empty($this->input->post('titre')) AND !empty($this->input->post('isbn'))
					AND !empty($this->input->post('edition')) AND !empty($this->input->post('pages')) ) {

				 	$config['upload_path']      = 'assets/web/img';
					$config['allowed_types']    = 'jpg|png|jpeg|JPG|PNG|JPEG';
					$config['max_size']         = '10240';
					// $config['max_width']        = '1024';
					// $config['max_height']       = '1024';
					$config['file_ext_tolower'] = true;
					$config['encrypt_name']     = true;

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ( ! $this->upload->do_upload('livreChemin') ) {
						$error = array('error' => $this->upload->display_errors());
						$_SESSION['flash']['success'] = 'La taille maximal pour upload est de 18Mo ';
						$this->load->view('collection/collection');
					} else {
						$data =  $this->upload->data();					
					}

					$data =  $this->upload->data();
						$foto 	  = $data['file_name'];

						$t = $this->form_uploaded_doc();
							     
					$titre 				   = trim($this->input->post('titre'));
					$isbn  				   = trim($this->input->post('isbn'));
					$edition 			   = trim($this->input->post('edition'));
					$langue 			   = trim($this->input->post('langue'));
					$categorie 			   = trim($this->input->post('categorie'));
					$pages 				   = trim($this->input->post('pages'));
					$pointVente 		   = trim($this->input->post('pointVente'));
					$desc 		   		   = trim($this->input->post('desc'));
					 
					$this->Collection_model->ajouter_ouvrage($titre, $isbn, $edition, $langue, $categorie, $pages, $pointVente, $desc, $foto, $t);

					$this->notify();
					$_SESSION['flash']['success'] = 'Vous avez ajoute un ouvrage';
					$this->load->view('collection/collection');
					$this->load->view('templates/footer');	
				} else {
					$_SESSION['flash']['alert'] = 'Veuiller remplir tous les champs';
					$this->notify();
					$this->load->view('collection/collection');
				}
			} else {
				$this->notify();
				$this->load->view('collection/collection');
			}
	}

	/**
	* function form_uploaded_doc
	* @access public 
	* @return $book_path
	*
	*/
	// uploaded doc only pdf
    function form_uploaded_doc() {
		$config['upload_path']      = 'assets/web';
		$config['max_size']         = '20400';
		$config['allowed_types']    = 'pdf|PDF';
		$config['encrypt_name']     = true;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload('couvertureOuvragePath') ) {
			$error = array('error' => $this->upload->display_errors());
			$_SESSION['flash']['success'] = 'La taille maximal pour upload est de 18Mo ';
			$this->load->view('collection/collection');
		} else {
			$data =  $this->upload->data();					
		}
		
		$data =  $this->upload->data(); 
 		return $book_path	  = $data['file_name'];  	     
    }

    /**
	* function ouvrage_membre
	* @access public 
	* @return void
	*
	*/
    function ouvrage_membre() {
        $req = $this->Collection_model->ouvrage_membre();
        $d = new stdClass();

        $d->req = $req; 
        $this->notify();
        $this->load->view('collection/auteur_ouvrage', $d);
    }
}