<?php

	class Users_model extends CI_Model {
		var $original_path;
		var $thumbnail_path;
		var $icon_path;

		function __construct(){
			parent::__construct();
			$this->load->database("crud050217");
			//
		  $this->original_path 	= realpath(APPPATH.'../assets/images/uploads/original');
	   	$this->thumbnail_path = realpath(APPPATH.'../assets/images/uploads/thumbnail');
    	$this->icon_path 			= realpath(APPPATH.'../assets/images/uploads/icon');
		}

		public function get_all_users(){
			$query = $this->db->get('users');
			return $query->result();
		}
			
		public function insert_users_to_db($data){
			return $this->db->insert('users', $data);
		}
		
		public function getById($id){
			$query = $this->db->get_where('users',array('id'=>$id));
			return $query->row_array();
		}	
		
		public function update_info($data,$id){
			$this->db->where('users.id',$id);
			return $this->db->update('users', $data);
		}
		
		public function delete_a_user($id){
			$this->db->where('users.id',$id);
			return $this->db->delete('users');
		}

		function do_upload(){
	    $this->load->library('image_lib');
	    $config = array(
		    'allowed_types'     => 'jpg|jpeg|gif|png', //only accept these file types
		    'max_size'          => 2048, //2MB max
		    'upload_path'       => $this->original_path //upload directory
	  	);
	 
	    $this->load->library('upload', $config);
	    $this->upload->do_upload(); //fixes

	    $image_data = $this->upload->data(); //upload the image
	 		$insert_data = array('image' => $image_data['file_name']);

	 		$LastID = $this->db->insert_id();
	 		
	 		$this->update_info($insert_data,$LastID);			

	    //your desired config for the resize() function
	    $config = array(
	    'file_name'     		=> $image_data['file_name'],
	    'source_image'      => $image_data['full_path'], //path to the uploaded image
	    'new_image'         => $this->thumbnail_path, //path to
	    'maintain_ratio'    => true,
	    'width'             => 640,
	    'height'            => 350
	    );
	 		
	    $this->load->library('image_lib', $config);

	    //this is the magic line that enables you generate multiple thumbnails
	    //you have to call the initialize() function each time you call the resize()
	    //otherwise it will not work and only generate one thumbnail
	    $this->image_lib->initialize($config);
	    $this->image_lib->resize();
	 
	    $config = array(
	    'file_name'     		=> $image_data['file_name'],
	    'source_image'      => $image_data['full_path'],
	    'new_image'         => $this->icon_path,
	    'maintain_ratio'    => true,
	    'width'             => 128,
	    'height'            => 128
	    );

	    //here is the second thumbnail, notice the call for the initialize() function again
	    $this->load->library('image_lib', $config);
	    $this->image_lib->initialize($config);
	    $this->image_lib->resize();
	    return $config;
  	}
	}
