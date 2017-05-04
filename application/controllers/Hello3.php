<?php
	if(!defined('BASEPATH')) exit('No direct script access allowed');

	class Hello3 extends CI_Controller{
	// declare variables or class properties
		var $name;
		var $color;
		function __construct(){
			parent::__construct();
			// give default value
			$this->name="Faisal";
			$this->color="red";
			}
		function you($firstname='', $lastname='')// Give variable that can GET value
			{
			$data['name']=($firstname)?$firstname.' '.$lastname:$this->name;
			$data['color']=$this->color;
			// define variable sent to views
			$this->load->view('you_view2',$data);
			}
		}
?>