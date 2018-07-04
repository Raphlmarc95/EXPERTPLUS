<?php 

class Notification_model extends CI_Model {
	
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
	* function notification
	* @access public
	* @return bool
	* 
	*/
	function notification () {
		$sql = 'SELECT * FROM evenement WHERE notify = 1';
		return $this->db->query($sql)->result();
	}

	/**
	* function count_notify
	* @access public
	* @return bool
	* 
	*/
	function count_notify () {
		$sql = 'SELECT count(notify) as nbr_notify FROM evenement WHERE notify = 1';
		return $this->db->query($sql)->result();
	}

	/**
	* function vue_notify
	* @access public
	* @return bool
	* 
	*/
	function vue_notify ($notify_id) {
		$sql = 'UPDATE evenement SET notify = 0 WHERE idevenement = ?';
		$this->db->query($sql, array($notify_id));
	}

	/**
	* function count_membre
	* @access public
	* @return bool
	* 
	*/
	function count_membre () {
		$sql = 'SELECT count(idmembre) as nbr_membre FROM membre ';
		return $this->db->query($sql)->result();
	}

	/**
	* function count_evenement
	* @access public
	* @return bool
	* 
	*/
	function count_evenement () {
		$sql = 'SELECT count(idevenement) as nbr_event FROM evenement ';
		return $this->db->query($sql)->result();
	}

	/**
	* function count_post
	* @access public
	* @return bool
	* 
	*/
	function count_post () {
		$sql = 'SELECT count(id) as nbr_sujet FROM f_sujets ';
		return $this->db->query($sql)->result();
	}

	/**
	* function count_ouvrege
	* @access public
	* @return bool
	* 
	*/
	function count_ouvrege() {
		$sql = 'SELECT count(idouvrage) as nbr_ouvrage FROM ouvrage ';
		return $this->db->query($sql)->result();
	}
}