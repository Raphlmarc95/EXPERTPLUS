<?php

class Auteur_model extends CI_Model
{
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
	* function info
	* @access public
	* @return object
	*
	*/
	function info () {
		$idmembre = $_GET['id'];
		$sql = "SELECT (DATE_FORMAT(CURRENT_DATE, ' %Y') - DATE_FORMAT(date_naissance,  ' %Y') ) as ages, pseudo, nom_prenom, photo, email, description, status, idmembre, telephone FROM membre WHERE idmembre = ? LIMIT 1";
		$req = $this->db->query($sql, array($idmembre));

		if ($req->num_rows() === 1 ) {
			return $req->result();
		} else {
			return $req->result();
			// return false;
		}
	}

	/**
	* function info_auteur_acc
	* @access public
	* @return object
	*
	*/
	function info_auteur_acc () {
		$sql = "SELECT (DATE_FORMAT(CURRENT_DATE, ' %Y') - DATE_FORMAT(date_naissance,  ' %Y') ) as ages, pseudo, nom_prenom, photo, email, description, status, idmembre, telephone FROM membre LIMIT 3";
		$req = $this->db->query($sql);

		if ($req->num_rows() > 0 ) {
			return $req->result();
		} else {
			return $req->result();
			// return false;
		}
	}

	/**
	* function count_ouvrage_auteur
	* @access public
	* @param int $idmembre
	* @return object
	*
	*/
	function count_ouvrage_auteur($idmembre) {		
		$sql = "SELECT count(*) AS NBO FROM ouvrage WHERE id_membre = ?";
		$req = $this->db->query($sql, array($idmembre));

		if ($req->num_rows() > 0 ) {
			return $req->result();
		} else {
			return false;
		}		
	}

	/**
	* function count_event_auteur
	* @access public
	* @param int $idmembre
	* @return object
	*
	*/
	function count_event_auteur($idmembre) {		
		$sql = "SELECT count(*) AS NBE FROM evenement WHERE idmembre = ?";
		$req = $this->db->query($sql, array($idmembre));

		if ($req->num_rows() > 0 ) {
			return $req->result();
		} else {
			// return false;
			return $req->result();
		}		
	}

	/**
	* function count_post_auteur
	* @access public
	* @param int $idmembre
	* @return object
	*
	*/
	function count_post_auteur($idmembre) {		
		$sql = "SELECT count(*) AS NBP FROM f_sujets WHERE idmembre = ?";
		$req = $this->db->query($sql, array($idmembre));

		if ($req->num_rows() > 0 ) {
			return $req->result();
		} else {
			return $req->result();
			// return false;
		}		
	}

	/**
	* function lister_auteur_nom
	* @access public
	* @param string $let
	* @return object
	*
	*/
	function lister_auteur_nom($let) {
		$sql = "SELECT * FROM membre WHERE Upper(status) = 'AUTEUR' AND Upper(pseudo) like '".$let."%' ";
		$req = $this->db->query($sql);

		if ($req->num_rows() > 0) {
			return $req->result();
		} else {
			return $req->result();
			// return false;
		}
	}

	/**
	* function lister_auteur
	* @access public
	* @return object
	*
	*/
	function lister_auteur() {
		$sqli = "SELECT * FROM membre WHERE Upper(status) = 'AUTEUR' "; 
		$reqi = $this->db->query($sqli);
		if ($reqi->num_rows() > 0) {
			return $reqi->result();
		} else {
			return false;
		}
	}

	/**
	* function ferme_compter
	* @access public
	* @param int $idmembre
	* @return void
	*
	*/
	function ferme_compter ($idmembre) {
		$sql = "UPDATE membre SET actif = '0' WHERE idmembre = ?";
		$req = $this->db->query($sql, array($idmembre));
	}

	/**
	* function modifier_compte
	* @access public
	* @param int $idmembre
	* @return object
	*
	*/
	function modifier_compte ($idmembre) {
		$sql = "SELECT * FROM membre WHERE idmembre = ?";
		$query = $this->db->query($sql, array($idmembre) );

		if ($query->num_rows() === 1) {
			return $query->result();
		} else {
			return $query->result();
			// return false;
		}
	}

	/**
	* function modif
	* @access public
	* @param int 	$idmembre
	* @param string $pseudo
	* @param string $nom_prenom
	* @param string $email
	* @param int 	$telephone
	* @param string $desc
	* @param string $foto
	* @return void
	*
	*/
	function modif($idmembre, $pseudo, $nom_prenom, $email,  $telephone, $desc, $foto) {
		
		$sql = "UPDATE membre SET pseudo =?, nom_prenom =?, email =?, telephone =?, description =?, photo =? WHERE idmembre =?";
		$req = $this->db->query($sql, array($pseudo, $nom_prenom, $email,  $telephone, $desc, $foto, $idmembre));
	}

	/**
	* function record_count
	* @access public
	* @return object
	*
	*/
	function record_count() { 
       return $this->db->count_all("membre"); 
    }
 
 	/**
	* function fetch_departments
	* @access public
	* @param int $limit
	* @param int $start
	* @return object
	*
	*/
    function fetch_departments($limit, $start) {
 
       $this->db->limit($limit, $start);
 
       $query = $this->db->get("membre");
 
       if ($query->num_rows() > 0) {
 
           foreach ($query->result() as $row) {
 
               $data[] = $row; 
            } 
           return $data; 
        } 
       return false; 
    }
}