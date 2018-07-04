<?php
class Evenement_model extends CI_Model {

	/**
	 * function __construct.
	 * 
	 * @access public
	 * @return void
	 */ 	
 	function __construct() {
		$this->load->database();		
 		parent::__construct();

 		$this->load->helper('form');
 		$this->load->library('form_validation');
 	}

 	/**
	 * function add evenement 
	 * 
	 * @access public
	 * @param string nom
	 * @param int 	 user_id
	 * @param string lieuEvent
	 * @param Date   dateEvent
	 * @param string descEvent
	 * @param Date   datedebutEvent
	 * @param Date   datefinEvent
	 * @param string Activites
	 * @param double prix
	 * @param string pointDevente
	 * @param string foto
	 * @return bool
	 *
	 */
 	function add($nom,$user_id,$lieuEvent,$dateEvent,$descEvent, $datedebutEvent,$datefinEvent,$Activites,$prix,$pointDevente,$foto) {
    	$data = array(
    		'titre'				=> $nom,
    		'idmembre'			=> $user_id,
    		'lieuEvenement'		=> $lieuEvent,
    		'description'		=> $descEvent,

    		'date_debut'		=> $datedebutEvent,
    		'date_fin'			=> $datefinEvent,
    		'activite'			=> '1',
    		'prix'				=> $prix,
    		'point_de_vente'	=> $pointDevente,
    		'photo'				=> $foto,
			'date_creation'		=>  date('Y-m-j H:i:s'),
			'notify'			=> '1'			
    	);
    	return $this->db->insert('evenement', $data);
	}

	/**
	 * function lister.
	 * 
	 * @access public
	 * @return array object
	 */ 
	function lister() {
		// $r = setlocale(LC_TIME, "fr_FR", "French");
		$r = "SET lc_time_names = 'fr_FR'";
		$sql = 'SELECT  DATE_FORMAT(evenement.date_debut, "%d %M %Y") as event_mois, DATE_FORMAT(evenement.date_debut, "%a %d %M %Y %r") as event_deb, DATE_FORMAT(evenement.date_fin, "%a %d %M %Y %r") as event_fin, evenement.idevenement, evenement.photo, evenement.titre, evenement.lieuEvenement, evenement.description, evenement.date_creation, evenement.activite, evenement.date_debut, evenement.date_fin, evenement.prix, evenement.point_de_vente, membre.photo AS m_foto, membre.pseudo, membre.email, evenement.idmembre FROM evenement INNER JOIN membre on evenement.idmembre = membre.idmembre ORDER BY idevenement';

		$req1 = $this->db->query($r);
		$req = $this->db->query($sql);

		if ($req->num_rows() > 0) {
			return $req->result_object();
		} else {
			return $req->result_object();
			// return 'pas de nouvelle evenement';
		}		
	}

	/**
	 * function lister_event_index.
	 * 
	 * @access public
	 * @return array object
	 */ 
	function lister_event_index() {
		$r = "SET lc_time_names = 'fr_FR'";
		$sql = 'SELECT  DATE_FORMAT(evenement.date_debut, "%d %M %Y") as event_mois, DATE_FORMAT(evenement.date_debut, "%a %d %M %Y %r") as event_deb, DATE_FORMAT(evenement.date_fin, "%a %d %M %Y %r") as event_fin, evenement.idevenement, evenement.photo, evenement.titre, evenement.lieuEvenement, evenement.description, evenement.date_creation, evenement.activite, evenement.date_debut, evenement.date_fin, evenement.prix, evenement.point_de_vente,membre.photo AS m_foto, membre.pseudo, membre.email, evenement.idmembre FROM evenement INNER JOIN membre on evenement.idmembre = membre.idmembre ORDER BY idevenement LIMIT 3';
		$this->db->query($r);
		$req = $this->db->query($sql);

		if ($req->num_rows() > 0) {
			return $req->result_object();
		} else {
			return $req->result_object();
			// return 'pas de nouvelle evenement';
		}		
	}

	/**
	 * function record_count.
	 * 
	 * @access public
	 * @return one object
	 */ 
	function record_count() {
		return $this->db->count_all("evenement");
	}

	/**
	 * function fetch_data.
	 * 
	 * @access public
	 * @param int limit
	 * @param int id
	 * @return array object
	 */ 
	function fetch_data($limit, $id) {
		$this->db->limit($limit);
		$this->db->where('idevenement', $id);
		$query = $this->db->get("evenement");
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	/**
	 * function delete.
	 * 
	 * @access public
	 * @param int limit
	 * @return bool
	 */
	function delete ($idevenement) {
		$sql = 'DELETE FROM evenement WHERE idevenement = ?';
		return $this->db->query($sql, array($idevenement));
	}

	/**
	 * function modifier_evenement.
	 * 
	 * @access public
	 * @return bool
	 */
	function modifier_evenement(){
  		// $user_id = $this->session->userdata('idmembre');
  		$idevenement = trim($this->input->post('idEvent')); 
  		$titreEvent  = trim($this->input->post('titreEvent'));

  		$datedebutEvent  = trim($this->input->post('datedebutEvent'));
  		$datefinEvent    = trim($this->input->post('datefinEvent'));

  		$req = "UPDATE evenement SET titre = ? WHERE idevenement = ?, date_debut = ?, date_fin = ? ";
  		return $this->db->query($req, array($titreEvent, $idevenement, $datedebutEvent, $datefinEvent));    
    }

    /**
	 * function evenement_membre.
	 * 
	 * @access public
	 * @return array object
	 */
    function evenement_membre() {
      
        if (isset($_GET['id'])) {
            $id_membre = $_GET['id'];
            $r = "SET lc_time_names = 'fr_FR'";
            $sql = 'SELECT  DATE_FORMAT(evenement.date_debut, "%d %M %Y") as event_mois, DATE_FORMAT(evenement.date_debut, "%a %d %M %Y %r") as event_deb, DATE_FORMAT(evenement.date_fin, "%a %d %M %Y %r") as event_fin, evenement.idevenement, evenement.photo, evenement.titre, evenement.lieuEvenement, evenement.description, evenement.date_creation, evenement.activite, evenement.date_debut, evenement.date_fin, evenement.prix, evenement.point_de_vente,membre.photo AS m_foto, membre.pseudo, membre.email, evenement.idmembre FROM evenement INNER JOIN membre on evenement.idmembre = membre.idmembre WHERE membre.idmembre = ?';
            $req = $this->db->query($sql, array($id_membre));

            if ( $req->num_rows() > 0 ) {
                return $req->result();
            } else {
                return false;
            }
        }
    }
}