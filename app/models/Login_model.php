<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	/**
	* function __construct
	* @access public
	* @return void
	* 
	*/
	function __construct() {
		
		parent::__construct();
		$this->load->database();
	}

	/**
	* function sign_in
	* @access public
	* @param string $pseudo
	* @param string $pass
	* @return object
	* 
	*/
	function sign_in($pseudo, $pass){
		
		$this->db->select('*');
		$this->db->from('membre');
		$this->db->where('pseudo', $pseudo);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		}else{
			return false;
		}
	}

	/**
	* function check_if_pseudo_exists
	* @access public
	* @return bool
	* 
	*/
	function check_if_pseudo_exists($pseudo){
		$this->db->WHERE('pseudo', $pseudo);
		$req = $this->db->get('inscription');
		if ($req->num_rows() > 0) {
			return false;
		}else {
			return true;
		}
    }

    /**
	* function check_if_email_exists
	* @access public
	* @param string $email
	* @return bool
	* 
	*/
    function check_if_email_exists($email){
    	$this->db->WHERE('email', $email);
		$req = $this->db->get('inscription');
		if ($req->num_rows() > 0) {
			# code...
			return false;
		}else {
			return true;
		}    	
    }

    /**
	* function sign_up
	* @access public
	* @return void
	* 
	*/
	function sign_up(){

		$nom = $this->input->post('nom_prenom');
		$sex = $this->input->post('sexe');
		$dat = $this->input->post('date_naissance');
		$pseu = $this->input->post('pseudo');
		$pass = sha1($this->input->post('mot_de_passe'));	
		$ema = $this->input->post('email'); 
		$sta = $this->input->post('mem');
		$desc = $this->input->post('desc');
		$telephone = $this->input->post('telephone');
		
		$co = $this->security->get_csrf_hash();
		$to = $this->input->post('token_confirmed');
		$pho = $this->upload->file_name;

		$data = array(
			'idinscription'		=> '',
			'nom_prenom' 	 	=> $nom,
			'sexe' 			 	=> $sex,
			'date_naissance' 	=> $dat,
			'pseudo'		 	=> $pseu,
			'mot_de_passe' 	 	=> $pass,
			'email'   		 	=> $ema,
			'telephone'   		=> $telephone,
			'status'			=> $sta,
			'description'		=> $desc,

			'token_confirmed'	=> $to,
			'confirm_token' 	=> $co,
			'photo'				=> $pho				
		);		
			
		if ($this->db->insert('inscription', $data)) {
			$user_id = $this->db->insert_id();
			$token 	 = $this->security->get_csrf_hash();
			//send confirmation email
			return $this->send_confirmation_email($ema, $user_id, $token);			
		}
	}

	/**
	* function send_confirmation_email
	* @access private
	* @param string $ema
	* @param int    $user_id
	* @param string $token
	* @return void
	* 
	*/
	private function send_confirmation_email($ema, $user_id, $token) {
		
		// load email library and url helper
		$this->load->library('email');
		$this->load->helper('url');
		
		// get the site email address
		$email_address = $this->config->item('site_email');

		// initialize the email configuration
		$this->email->initialize(array(
			'mailtype' => 'html',
			'charset'  => 'utf-8'
		));
		
		// get user registration date
		$registration_date = $this->db->select('token_confirmed')->from('inscription')->where('idinscription', $user_id)->get()->row('token_confirmed');
		
		// prepare the email
		$this->email->from($email_address, $email_address);
		$this->email->to($ema);
		$this->email->subject('Email de confirmation de compte.');
		$message  = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body>';
		// $message .= "Hi " . $pseudo . ",<br><br>";
		// $message .= "Cliquez sur ce lien pour valider votre compte " . base_url() . "<br><br>";
		$message .= "Cliquez sur ce lien: <a href=\"" . base_url() . "account/confirmation/" . $user_id . "/" . $token . "\">pour confirme votre compte.</a>";
		$message .= "</body></html>";
		$this->email->message($message);
		
		// send the email and return status
		// return $this->email->send();		
		$this->email->send();		
	}

	/**
	* function confirm_account
	* @access public
	* @param string $pseudo
	* @param string $hash
	* @return bool
	* 
	*/
	function confirm_account($pseudo, $hash) {		
		// find the email for the given user
		$email = $this->db->select('email')
			->from('inscription')
			->where('pseudo', $pseudo)
			->get()
			->row('email');
		
		$token_confirmation = $this->db->select('token_confirmed')
			->from('inscription')
			->where('pseudo', $pseudo)
			->get()
			->row('token_confirmed');

		// if the user from the url exists
		if ($email && $token_confirmation) {
			
			if (sha1($email . $token_confirmation) === $hash) {
				
				$data = array('token_confirmed' => date('Y-m-j H:i:s'));
				$this->db->where('pseudo', $pseudo);
				return $this->db->update('inscription', $data);				
			}
			return false;			
		}
		return false;		
	}

	/**
	* function visiteurs
	* @access public
	* @return void
	* 
	*/
	function visiteurs () {
		$select = "SELECT adresse_ip FROM visiteurs WHERE adresse_ip='".$_SERVER['REMOTE_ADDR']."';";
	    $stmt_entrees = $this->db->query($select);

	    if($stmt_entrees->num_rows() == 0)  {
	        // On insere une nouvelle ligne en base de données
	        $requete = "INSERT INTO visiteurs (adresse_ip, temps) VALUES ('".$_SERVER['REMOTE_ADDR']."','".date('Y-m-j H:i:s')."');";
    	} else {
    		// On met a jour le temps du visiteur en base de données
      		$requete = "UPDATE visiteurs SET temps='".date('Y-m-j H:i:s')."'WHERE adresse_ip = '".$_SERVER['REMOTE_ADDR']."';"."\n";
    	}
    	$this->db->query($requete);

    	$timestamp_5min = date('Y-m-j H:i:s') - (60 * 5); // Etat du timestamp il y a 5 minutes
	    $requete = "DELETE FROM visiteurs WHERE temps < ". $timestamp_5min.";"; 
	    $stmt = $this->db->query($requete);
	}

	/**
	* function confirm_account
	* @access public
	* @return bool
	* 
	*/
	function count_nbr_visiteur() {
		$sql = "SELECT count(id) AS nbr_visiteurs FROM visiteurs";
		return $this->db->query($sql)->result();
	}
}