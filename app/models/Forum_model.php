<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_model extends CI_Model {

	/**
	* function __construct
	*
	* @access public
	* @return void 
	* 
	*/
	function __construct() {		
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('url'));
	}

	/**
	* function nouveau_sujet
	*
	* @access public
	* @param int id_user
	* @param String sujet
	* @param Sting categorie 
	* 
	*/
	function nouveau_sujet($user_id, $ts, $tc){
		$cat = htmlspecialchars($this->input->post('categorie'));

		$sql = "SELECT * FROM f_categorie";
		$req = $this->db->query($sql);
		if ($req->num_rows()) {
			foreach ($req->result() as $key) {
				if ($key->contenu_c !== $cat ) {
					// return false;
				} else {
					
					$data = array (
						'idmembre'				=> $user_id,
						'id_categorie'			=> $key->id,
						'sujet'					=> $ts,
						'contenu_s'				=> $tc,
						'date_hres_creation'	=> date('Y-m-j H:i:s')
					);
					$this->db->insert('f_sujets', $data);

					$sql = "SELECT * FROM f_sujets WHERE id = ? AND idmembre = ?";

					$sujet_id 	= $this->db->insert_id();
					$user_id 	= $this->session->userdata('idmembre');

					$req = $this->db->query($sql, array($sujet_id, $user_id));
				}
			}
		}
	}

	/**
	* function comment
	* @access public
	* @param int id_sujet
	* @param String comment 
	* 
	*/
	function comment($id_sujet, $cm) {

		$sql = "SELECT * FROM f_sujets WHERE id = ".$id_sujet;

		$user_id 	= $this->session->userdata('idmembre');
		$pseudo 	= $this->session->userdata('pseudo');
		$foto 		= $this->session->userdata('photo');

		$req = $this->db->query($sql, array($user_id));
		if($req->num_rows()){
			foreach ($req->result() as $key ) {
				$sujet_id = $key->id ;

				$query = "INSERT INTO f_messages ( id_sujet, date_hres_edition, contenu_m, idmembre, pseudo_poster, photo) VALUES ( ?, CURRENT_TIMESTAMP(), ?, ?, ?, ?) ";
				$req1 = $this->db->query($query, array($sujet_id, $cm, $user_id, $pseudo, $foto ));
			}
		}
	}

	/**
	* function get_sujet_cat
	* @access public
	* @return object 
	* 
	*/
	function get_sujet_cat(){
		$sql = "SELECT * FROM f_categorie";
		$req 	= $this->db->query($sql );

		if ($req->num_rows()) {
			return $req->result();
		} else {
			// false;
			return $req->result() ;
		}
	}
	
	/**
	* function get_forums
	*
	* @return array object
	* 
	*/
	function get_forums() {
		$this->db->order_by('id', 'DESC');
		$this->db->limit(14);
		return $this->db->get('f_sujets')->result();		
	}

	/**
	* function get_topic_mem
	* @param int membre_id
	* @return object
	* 
	*/
	function get_topic_mem($membre_id) {
		
		$this->db->select("membre.pseudo, membre.photo");
		$this->db->from('f_sujets'); 
		$this->db->join('membre', 'membre.idmembre = f_sujets.idmembre');
		$this->db->where('membre.idmembre', $membre_id);
		return $this->db->get()->row();		
	}

	/**
	* function get_forum_topics
	* @param int f_msg_id
	* @return array object
	* 
	*/
	function get_forum_topics($f_msg_id) {		
		$this->db->from("f_messages");
		$this->db->where('id', $f_msg_id);
		return $this->db->get()->result();		
	}

	/**
	* function count_forum_posts
	* @param int f_suj_id
	* @return array object
	* 
	*/
	function count_forum_posts($f_suj_id) {		
		$this->db->select("f_messages.id_sujet,f_messages.contenu_m");
		$this->db->from('f_messages');
		$this->db->join('f_sujets', 'f_messages.id_sujet = f_sujets.id');
		$this->db->where('f_sujets.id', $f_suj_id);
		$this->db->group_by('f_messages.id');
		return count($this->db->get()->result());		
	}

	/**
	* function fetch_forum_posts
	* @param int f_suj_id
	* @return array object
	* 
	*/
	function fetch_forum_posts($f_suj_id) { 
		$this->db->from('f_sujets');
		$this->db->join('f_categorie', 'f_sujets.id_categorie = f_categorie.id');
		$this->db->where('f_sujets.id', $f_suj_id);
		return $this->db->get()->result();
	}

	/**
	* function get_topic_cat
	* @param int cat_id
	* @return object
	* 
	*/
	function get_topic_cat($cat_id) {
		$this->db->select("contenu_c");
		$this->db->from('f_categorie');
		$this->db->where('id', $cat_id);
		return $this->db->get()->row();
	}

	/**
	* function get_topic_post
	* @param int f_suj_id
	* @return array object
	* 
	*/
	function get_topic_post($f_suj_id) {
		$this->db->select("contenu_m, pseudo_poster,date_hres_edition, id_sujet, photo");
		$this->db->from('f_messages');
		$this->db->where('id_sujet', $f_suj_id);
		return $this->db->get()->result();
	}

	/**
	* function sujet_valid
	* @param int sujet_id
	* @param String sujet
	* @return array object
	* 
	*/
	function sujet_valid ($sujet_id, $sujet){
		$sql = "SELECT * FROM f_sujets WHERE id = ? AND sujet = ?" ;
		$r = $this->db->query($sql, array($sujet_id, $sujet));
		if ($r->num_rows() === 1) {
			return $r->result();
		} else {
			echo "Sujet not exist ..";
		}
	}

	/**
	* function forum_membre
	* @return array object
	* 
	*/
	function forum_membre() {
      
        if (isset($_GET['id'])) {
            $id_membre = $_GET['id'];
            $sql = "SELECT * FROM f_sujets WHERE idmembre = ?";
            $req = $this->db->query($sql, array($id_membre));

            if ( $req->num_rows() > 0 ) {
                return $req->result();
            } else {
                return false;
            }
        }
    }
}