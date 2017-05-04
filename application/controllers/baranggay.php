<?php

	if(! defined('BASEPATH')) exit('No direct script access allowed');
	class Baranggay extends CI_Controller {

		function __construct(){
			parent::__construct();
			}

		function index($offset = 0){
			$this->load->model('baranggay_model');
			$this->load->library('table','pagination');
			$this->load->helper('form', 'url');
			$this->load->database(); //load library database		
		
			$num_rows=$this->db->count_all("refbrgy");

			$config['base_url'] = base_url().'index.php/baranggay/index';
			$config['total_rows'] = $num_rows;
			$config['per_page'] = 10;
			$config['num_links'] = 5;
			$config['use_page_numbers'] = TRUE;
 			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['prev_link'] = '&laquo;';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['next_link'] = '&raquo;';

			$this->pagination->initialize($config);

			$this->db->select('a.brgyDesc, b.citymunDesc, c.provDesc, d.regDesc');
			$this->db->where('a.citymunCode = b.citymunCode AND b.provCode = c.provCode AND c.regCode = d.regCode');
			//$this->db->order_by('d.regDesc');
			$data['records']=$this->db->get('refbrgy a, refcitymun b, refprovince c, refregion d', $config['per_page'],$offset);

			$header = array('Baranggay', 'City/Municipality', 'Province', 'Region'); // create table header

			$tmpl = array ( 'table_open' => '<table class="table table-bordered table-striped table-condensed">' );
			$this->table->set_template($tmpl);
			$this->table->set_heading($header);// apply a heading with a header that was created
			$this->load->view('header');
			//$this->load->view('baranggays/index');
			$this->load->view('baranggays',$data); // load content view with data taken from the users table
			$this->load->view('footer');
		
		}

		public function lookup(){
        // process posted form data
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $query = $this->Baranggay_model->lookup($keyword); //Search DB
        if( ! empty($query) )
        {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach( $query as $row )
            {
                $data['message'][] = array( 
                                        'id'=>$row->brgyCode,
                                        'value'=>$row->brgyDesc,
                                        ''
                                     );  //Add a row to array
            }
        }
        if('IS_AJAX')
        {
            echo json_encode($data); //echo json string if ajax request
              
        }
        else
        {
            $this->load->view('baranggays/',$data); //Load html view of search results
        }
    }
	}


