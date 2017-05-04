<?php
	if(! defined('BASEPATH')) exit('No direct script access allowed');

	class Baranggay_model extends CI_Model {
	
		function __construct(){
			parent::__construct();
			$this->load->database("crud050217");
		}

		function lookup($keyword){
	        $this->db->select('brgyCode, brgyDesc')->from('refbrgy');
	        $this->db->like('brgyDesc',$keyword,'after');
	        $query = $this->db->get();    
	        return $query->result();
    	}
	}