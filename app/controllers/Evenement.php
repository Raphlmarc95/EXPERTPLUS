<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evenement extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

    function ajouter()	{
    	if($this->input->post('addEvent')){
    		if( !empty($this->input->post('nomEvent')) AND !empty($this->input->post('lieuEvent')) AND
    			!empty($this->input->post('dateEvent')) AND !empty($this->input->post('descEvent')) ) {

	    		// $photo = trim($this->input->post('photo'));
	    		$nom = trim($this->input->post('nomEvent'));
	 			$user_id = $this->db->insert_id();
	    		$lieuEvent = trim($this->input->post('lieuEvent'));
	    		$dateEvent = trim($this->input->post('dateEvent'));
	    		$descEvent = trim($this->input->post('descEvent'));

	    		$config['upload_path']          = 'assets/avatar/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
				$config['max_size']             = 0;
				$config['max_width']            = 180;
				$config['max_height']           = 240;

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
				    $this->event->add($data);
				}else {
	    		$req = $this->event->add($nom,$user_id,$lieuEvent,$dateEvent,$descEvent );
				}
	    			$_SESSION['flash']['success'] = 'L\'evenement a ete mise a jour.';
	    			$this->load->view('templates/header');
					$this->load->view('evenement/ajouter');	    	
    		} else { 
    			$_SESSION['flash']['danger'] = 'Veuille remplir tous les champs';
				$this->load->view('templates/header');
				$this->load->view('evenement/ajouter');
			}
    	} else {
    		$this->load->view('templates/header');
			$this->load->view('evenement/ajouter');
    	}
	}

	function lister() {
		$req = $this->event->lister();
		if ($req) {
			foreach ($req as $key) {
				$data = array(
					'photo'  => $key->photo,
					'nom'  => $key->nom,
					'lieuEvenement'  => $key->lieuEvenement,
					'dateEvenement'  => $key->dateEvenement
				);
			}
		}
		$this->load->view('templates/header');
		$this->load->view('evenement/lister', $data);
	}

	function modifier()	{
		$this->load->view('templates/header');
		$this->load->view('evenement/modifier');
	}

	function enlever()	{
		$this->load->view('templates/header');
		$this->load->view('evenement/suprimer');
	}
}