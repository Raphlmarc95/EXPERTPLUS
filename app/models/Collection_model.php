<?php 

class Collection_model extends CI_Model {
	
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
    * function lister
    * @access public
    * @return object
    *
    */
	function lister () {
		$sql = "SELECT * FROM ouvrage GROUP BY idouvrage DESC LIMIT 5";
		$req = $this->db->query($sql);
		
		if ($req->num_rows() > 0) {
			return $req->result_object();
		} else {
			return false;
		}
	}

    /**
    * function lister_categories
    * @access public
    * @return object
    *
    */
	function lister_categories () {
		$sql = " SELECT * FROM l_categories ";
		$req = $this->db->query();
		
		if ($req->num_rows() > 0) {
			return $req->result_object();
		} else {
			return false;
		}
	}

    /**
    * function lister_by_categorie
    * @access public
    * @return object
    *
    */
	function lister_by_categorie () {
		$sql = "SELECT * FROM ouvrage INNER JOIN l_categories ON ouvrage.id_l_cat = l_categories.id";
		$req = $this->db->query();
		
		if ($req->num_rows() > 0) {
			return $req->result_object();
		} else {
			return false;
		}
	}

    /**
    * function lister_by_id
    * @access public
    * @return void
    *
    */
	function lister_by_id () {
		$sql = "SELECT ouvrage.langue, ouvrage.titre, ouvrage.description, ouvrage.edition, ouvrage.images, ouvrage.isbn, ouvrage.pages, ouvrage.point_de_vente, membre.pseudo, membre.photo, membre.email, l_categories.cat_nom FROM ouvrage INNER JOIN l_categories, membre WHERE ouvrage.id_l_cat = l_categories.id AND membre.idmembre = ouvrage.id_membre";
		$req = $this->db->query();
		
		if ($req->num_rows() > 0) {
			return $req->result_object();
		} else {
			return false;
		}
	}

    /**
    * function ajouter_ouvrage
    * @access public
    * @param string $titre
    * @param int    $isbn
    * @param string $edition
    * @param string $langue
    * @param string $categorie
    * @param int    $pages
    * @param string $pointVente
    * @param string $desc
    * @param string $foto
    * @param string $t
    * @return void
    *
    */
	function ajouter_ouvrage($titre, $isbn, $edition, $langue, $categorie, $pages, $pointVente, $desc, $foto, $t){
  		$user_id = $this->session->userdata('idmembre');
        $data = array(
    		// 'idouvrage'				=> '',
            'titre'  				=> $titre,
            'isbn'  				=> $isbn, 
            'edition'				=> $edition,

            'langue'				=> $langue,
            'categorie'				=> $categorie, 
            'pages'					=> $pages,
            'point_de_vente'		=> $pointVente,
            'date_a_jour'			=> date('Y-m-j H:i:s'),
            'description'			=> $desc,
            'livre_path'			=> $t,
            'images' 				=> $foto,
            'id_membre'				=> $user_id,
            'notify'                => '1'
        );

        $this->db->insert('ouvrage', $data);        
    }

    /**
    * function cat_ro
    * @access public
    * @return object
    *
    */
    function cat_ro() {
    	$req = "SELECT membre.pseudo, membre.email, ouvrage.categorie, ouvrage.langue, ouvrage.edition, ouvrage.isbn, ouvrage.pages, ouvrage.point_de_vente, ouvrage.idouvrage, ouvrage.images, ouvrage.titre, ouvrage.livre_path, ouvrage.description FROM ouvrage INNER JOIN membre ON membre.idmembre = ouvrage.id_membre WHERE categorie = 'recit' ";
    	$sql = $this->db->query($req);
    	if ($sql->num_rows() > 0) {
    	  return $sql->result();
    	} else {
    		// return false;
    		// return 'Donne not found !';
    	  return $sql->result();
    	}
    }

    /**
    * function cat_thea
    * @access public
    * @return object
    *
    */
    function cat_thea() {
    	$req = "SELECT membre.pseudo, membre.email, ouvrage.categorie, ouvrage.langue, ouvrage.edition, ouvrage.isbn, ouvrage.pages, ouvrage.point_de_vente, ouvrage.idouvrage, ouvrage.images, ouvrage.titre, ouvrage.livre_path, ouvrage.description FROM ouvrage INNER JOIN membre ON membre.idmembre = ouvrage.id_membre WHERE categorie = 'theatre' ";
    	$sql = $this->db->query($req);
    	if ($sql->num_rows() > 0) {
    	  return $sql->result();
    	} else {
    		// return false;
    		return $sql->result();
    	}   	
    }

    /**
    * function cat_poe
    * @access public
    * @return object
    *
    */
    function cat_poe() {
    	$req = "SELECT membre.pseudo, membre.email, ouvrage.categorie, ouvrage.langue, ouvrage.edition, ouvrage.isbn, ouvrage.pages, ouvrage.point_de_vente, ouvrage.idouvrage, ouvrage.images, ouvrage.titre, ouvrage.livre_path, ouvrage.description FROM ouvrage INNER JOIN membre ON membre.idmembre = ouvrage.id_membre WHERE categorie = 'poetique' ";
    	$sql = $this->db->query($req);
    	if ($sql->num_rows() > 0) {
    	  return $sql->result();
    	} else {
    		// return false;
    		return $sql->result();
    	}
    }

    /**
    * function cat_lit
    * @access public
    * @return object
    *
    */
    function cat_lit() {
        $req = "SELECT membre.pseudo, membre.email, ouvrage.categorie, ouvrage.langue, ouvrage.edition, ouvrage.isbn, ouvrage.pages, ouvrage.point_de_vente, ouvrage.idouvrage, ouvrage.images, ouvrage.titre, ouvrage.livre_path, ouvrage.description FROM ouvrage INNER JOIN membre ON membre.idmembre = ouvrage.id_membre WHERE categorie = 'litterature' ";
        $sql = $this->db->query($req);
        if ($sql->num_rows() > 0) {
          return $sql->result();
        } else {
            // return false;
            return $sql->result();
        }
    }

    /**
    * function index_livres
    * @access public
    * @return object
    *
    */
    function index_livres() {
        $req = "SELECT membre.pseudo, membre.email, ouvrage.categorie, ouvrage.langue, ouvrage.edition, ouvrage.isbn, ouvrage.pages, ouvrage.point_de_vente, ouvrage.idouvrage, ouvrage.images, ouvrage.titre, ouvrage.livre_path, ouvrage.description FROM ouvrage INNER JOIN membre ON membre.idmembre = ouvrage.id_membre ORDER BY ouvrage.idouvrage LIMIT 5 ";
        $sql = $this->db->query($req);
        if ($sql->num_rows() > 0) {
          return $sql->result();
        } else {
            // return false;
            return $sql->result();
        }
    }

    /**
    * function ouvrage_membre
    * @access public
    * @return object
    *
    */
    function ouvrage_membre() {
      
        if (isset($_GET['id'])) {
            $id_membre = $_GET['id'];
            $sql = "SELECT * FROM ouvrage a JOIN membre b on a.id_membre=b.idmembre
              WHERE id_membre = ?";
            $req = $this->db->query($sql, array($id_membre));

            if ( $req->num_rows() > 0 ) {
                return $req->result();
            } else {
                return false;
            }
        }
    }
}