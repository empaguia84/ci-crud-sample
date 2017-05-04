<?php

	if(! defined('BASEPATH')) exit('No direct script access allowed');
	class Users extends CI_Controller {

		function __construct(){
			parent::__construct();
			#$this->load->helper('url');
			$this->load->model('users_model');
		}

		public function index(){
			$data['user_list'] = $this->users_model->get_all_users();
			$this->load->view('header');
			$this->load->view('show_users', $data);
			$this->load->view('footer');
		}
			
		public function add_form(){
			//$this->load->view('insert');
			$this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			/*			
			$this->form_validation->set_rules('name', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required',
					array('required' => 'You must provide a %s.')
			);
			$this->form_validation->set_rules('mobile', 'Mobile', 'required');
			$this->form_validation->set_rules('address', 'Address', 'required');
			*/
			/*Setting Rules Using an Array*/
			/*
			$config = array(
			array(
					'field' => 'name',
					'label' => 'Username',
					'rules' => 'required'
				),
			array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'required',
					'errors' => array(
							'required' => 'You must provide an %s.',
					),
				),
			array(
					'field' => 'mobile',
					'label' => 'Mobile',
					'rules' => 'required'
				),
			array(
					'field' => 'address',
					'label' => 'Address',
					'rules' => 'required'
				)
			);
			
			$this->form_validation->set_rules($config);
			*/
			
			/*Cascading Rules*/
			
			$this->form_validation->set_rules(
				'name', 'Username',
				'required|min_length[5]|max_length[12]|is_unique[users.name]',
				array(
					'required'	=> '%s is required.',
					'is_unique' => 'This %s already exists.' 
				)
			);
			
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]',
				array(
					'required'	  => '%s is required.',
					'valid_email' => 'This is not a %s',
					'is_unique'   => 'This %s already exists.' 
				)
			);

			$this->form_validation->set_rules(
				'mobile', 'Mobile', 
				'required|exact_length[11]|numeric|is_unique[users.mobile]',
				array(
					'numeric'		=> 'Numbers Only Allowed',
					'is_unique' => 'This %s already exists.'
				)
			);

			$this->form_validation->set_rules(
				'address', 'Address', 
				'required|min_length[8]|max_length[96]|alpha_numeric_spaces|is_unique[users.address]',
				array(
					'alpha_numeric_spaces'	=> 'Alphabet, Numbers and Spaces Are Only Allowed',
					'is_unique'     				=> 'This %s already exists.'
				)
			);
			
			//$this->form_validation->set_rules('userfile', 'Picture','required');

      if($this->form_validation->run() == FALSE){			
				$this->load->view('header');
				$this->load->view('insert');                
				$this->load->view('footer');    
      }
      else{
      	$this->insert_new_user();
      }            
		}		

		public function insert_new_user(){
			$udata['name'] = $this->input->post('name');
			$udata['email'] = $this->input->post('email');
			$udata['address'] = $this->input->post('address');
			$udata['mobile'] = $this->input->post('mobile');
			//$udata['image'] = $this->input->post('userfile');
			
			$res1 = $this->users_model->insert_users_to_db($udata);
			$res2 = $this->users_model->do_upload(); //execute the upload function
			if($res1 && $res2){
				header('location:'.base_url()."index.php/users/".$this->index());
			}
		}
		
		public function edit(){
			$this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');

      $id = $this->uri->segment(3);
			$data['user'] = $this->users_model->getById($id);

      $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			$this->form_validation->set_rules(
				'name', 'Username',
				'required|min_length[5]|max_length[12]|edit_unique[users.name.'.$id.']',
				array(
					'required' => '%s Required.'
				)
			);
			
			$this->form_validation->set_rules('email', 'Email','required|valid_email|edit_unique[users.email.'.$id.']');

			$this->form_validation->set_rules('mobile', 'Mobile',	'required|exact_length[11]|numeric|edit_unique[users.mobile.'.$id.']'
			);

			$this->form_validation->set_rules(
				'address', 'Address', 
				'required|min_length[8]|max_length[96]|alpha_numeric_spaces|edit_unique[users.address.'.$id.']',
				array(
					'alpha_numeric_spaces' => 'Alphabet, Numbers and Spaces Are Only Allowed'
				)
			);
			
      if($this->form_validation->run() == FALSE){  
        $id = $this->uri->segment(3);
				$data['user'] = $this->users_model->getById($id);    	
				$this->load->view('header');
				$this->load->view('edit', $data);
				$this->load->view('footer');
      }
      else{
      	$this->update();
      }
		}
		
		public function update(){
			$mdata['name']=$_POST['name'];
			$mdata['email']=$_POST['email'];
			$mdata['address']=$_POST['address'];
			$mdata['mobile']=$_POST['mobile'];
			$res=$this->users_model->update_info($mdata, $_POST['id']);
			if($res){
				header('location:'.base_url()."index.php/users/".$this->index());
			}
		}
			
		public function delete($id){
			$this->users_model->delete_a_user($id);
			$this->index();
		}			
	}
?>
