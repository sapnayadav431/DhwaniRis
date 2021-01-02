<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommonError extends MY_Controller {

	
	 
	function __construct(){
	        //The Call Parent constructor
	        parent::__construct();      
		//$this->load->model('admin/user_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');  
		$this->load->library('session');      
	}
	
        function index(){
           $this->load->view('error'); 
        }
}

