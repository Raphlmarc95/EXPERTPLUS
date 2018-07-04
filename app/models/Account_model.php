<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

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
	* function fetch
	* @access public
	* @param int $user_id
	* @return bool
	*
	*/
	function fetch($user_id){
		$sql = "SELECT * FROM membre WHERE idmembre = ? ";
		$req = $this->db->query($sql, array($user_id));
		if ($req->num_rows() === 1) {
			return $req->result();
		}else {
			return false;
		}
	}

	/**
	* function confirmation
	* @access public
	* @return array object
	*
	*/
    function confirmation(){

		$user_id = htmlspecialchars($this->uri->segment(3));
		$token   = htmlspecialchars($this->uri->segment(4));

		$req = $this->db->SELECT('*');
		$req = $this->db->from('inscription');
		$req = $this->db->where('idinscription', $user_id);
		$req = $this->db->get();

		if($req->num_rows() === 1){

			foreach ($req->result() as $user) {
				if ($user && $user->confirm_token == $token) {
					$this->db->query('UPDATE inscription SET confirm_token = NULL, token_confirmed = NOW() WHERE idinscription ='. $user_id);

					$data = array(
						'idmembre' 			=> '', 
						'pseudo' 			=> $user->pseudo,
						'photo' 			=> $user->photo,
						'nom_prenom' 		=> $user->nom_prenom,
						
						'mot_de_passe'  	=> $user->mot_de_passe,
						'email' 			=> $user->email,
						'telephone' 			=> $user->telephone,
						'date_naissance' 	=> $user->date_naissance,
						'status' 			=> $user->status,
						'description' 		=> $user->description,
						'actif'				=> '1'
						);
					$this->db->insert('membre', $data);
				}else{
					// echo "pas ok";
				}				
			}	
			return $req->result_object();
		}else{
			return false;
		}
    }

    /**
	* function password_fotgot
	* @access public
	* @param string $reset_token
	* @param string $email
	* @return object
	*
	*/
    function password_fotgot($reset_token, $email){
		$req = $this->db->SELECT('*');
		$req = $this->db->from('membre');
		$req = $this->db->where('email', $email);
		$req = $this->db->get();

		if($req->num_rows() == 1){
			
			foreach ($req->result() as $user) {
				if ($user && $user->email === $email) {
					$sql = 'UPDATE membre SET reset_token = ? WHERE email = ?';
					// $this->db->query($sql, array($reset_token ,$email) );

					if ( $this->db->query($sql, array($reset_token ,$email) ) ) {
						return $this->send_confirmation_pass($reset_token, $email);
					}
				}else{
					// echo "pas ok";
				}				
			}	
			return $req->result_object();
		}else{
			 return false;
		}
	}

	/**
	* function password_reset
	* @access public
	* @param string $reset_token
	* @return object
	*
	*/
	function password_reset( $reset_token ){
 	
		$req = $this->db->SELECT('*');
		$req = $this->db->from('membre');
		$req = $this->db->where('reset_token', $reset_token);
		$req = $this->db->get();

		if($req->num_rows() === 1){	
			return $req->result_object();
		}else{
			// echo "Token invalid !!";
			return false;
		}
	} 

	/**
	* function update_pass
	* @access public
	* @param string $mot_de_passe
	* @return bool
	*
	*/
	function update_pass($mot_de_passe){

		$query = "UPDATE membre SET reset_token = NULL, reset_token_at = NOW(), mot_de_passe = ? ";
		$req = $this->db->query($query, array($mot_de_passe));

		if ($req) {
			return true;
		}else {
			return false;
		}
	}

	/**
	* function send_confirmation_pass
	* @access public
	* @param string $reset_token
	* @param string $email
	* @return void
	*
	*/
	function send_confirmation_pass($reset_token, $email) {
		
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
		$registration_date = $this->db->select('reset_token')->from('membre')->where('email', $email)->get()->row('reset_token');
		
		// prepare the email
		$this->email->from($email_address, $email_address);
		$this->email->to($email);
		$this->email->subject('Email de réinitialisation de mot de passe.');
		$message  = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body>';
		// $message .= "Hi " . $pseudo . ",<br><br>";
		// $message .= "Cliquez sur ce lien pour valider la réinitialisation votre mot de passe " . base_url() . "<br><br>";
		$message .= "Cliquez sur ce lien: <a href=\"" . base_url() . "account/password_reset/" . $reset_token . "\">pour confirme votre email et réinitialiser votre mot de passe</a>";
		$message .= "</body></html>";
		$this->email->message($message);
		
		// send the email and return status
		return $this->email->send();		
	}

	/**
	* function desactive_compte
	* @access public
	* @return void
	*
	*/
	function desactive_compte() {
		$idmembre = $_GET['idmembre'];
		$sql = "UPDATE membre SET actif = 0 WHERE idmembre = ?";
		$req = $this->db->query($sql, array($idmembre));
	}
}