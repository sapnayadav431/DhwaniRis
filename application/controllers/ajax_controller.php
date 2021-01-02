<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_controller extends CI_Controller {

	
	function __construct(){
	        //The Call Parent constructor
	        parent::__construct();      
		$this->load->model('Master_Model');  
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');  
		$this->load->library('session');      
	}
	
    
	
	public function get_district()
	{
	    $state = $this->input->get('state',TRUE);
		
			$query="SELECT * from state where parent ='".$state."' and type='D'";
			$this->datalayer['district'] = $this->Master_Model->findAll($query);
		
		echo json_encode($this->datalayer['district']);  
    }
	
	
}

