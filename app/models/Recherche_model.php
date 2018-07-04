<?php 

class Recherche_model extends CI_Model {
	
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
	* function search
	* @access public
	* @param string $search
	* @return void
	* 
	*/
	function search($search){
		
		$sql = "
			SELECT idmembre, pseudo, 'MEMBRE' AS type FROM membre WHERE Upper(pseudo) = ? || Upper(pseudo) like '".$search."%'
			UNION 
			(
			SELECT idevenement, titre, 'EVENEMENT' AS type FROM evenement WHERE Upper(titre) = ? || Upper(titre) like '".$search."%' 
			)
			UNION SELECT idouvrage, titre, 'OUVRAGE' AS type FROM ouvrage WHERE Upper(titre) = ? || Upper(titre) like '".$search."%' 
		";

		$query = $this->db->query($sql, array($search, $search, $search)); // var_dump($query);

		if ($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			// echo "Data not found ..";
			// return false;
			return $query->result();
		}
	}

}