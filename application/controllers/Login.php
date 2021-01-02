<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    public $datalayer, $projectName;
	
    public function __construct() {
        parent::__construct();
		
        $this->load->model('Login_Model');       
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');  
		
    }

    public function index() {
		
		 $this->load->view('login/login_page', $this->datalayer);
		
	}

    

    /* -----------------------Login Validate------------------------------------- */

    public function userValidate() {
	
		if ($this->input->post('login'))
		{
			
           $username =     $this->input->post('username'); //filter username
            $password =  $this->input->post('password'); //filter password
           
            
            $this->form_validation->set_rules('username', 'Username', 'trim|required', array('required' => 'Email Or Employee Id is mandatory !!'));
            $this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'Password is Mandatory !!'));
            
            if ($this->form_validation->run()) {
					
                    $validateUserData = $this->Login_Model->validateUserExist("$username"); //validate user by email account
					
						if($validateUserData['status'] == 1) {
							
							$validateInfo = $this->Login_Model->validateUserAC($username,$password);							
							if($validateInfo['status'] == 1){
							 $userinfo = $validateInfo['info'];
							 $_SESSION['id'] = $userinfo['id'];
							 $_SESSION['name'] = $userinfo['name'];
							 $_SESSION['profile_picture'] = $userinfo['profile_picture'];
							 $this->load->view('dashboard/dashboard', $this->datalayer);
							}
						}
						else
						{
							
							$this->datalayer['error_msg_key'] = "Invalid Username Password";
						}
					
					
			} else {
			   redirect('app/login');
			}
		}
    }

    /* ------------------------Login Session Setup End------------------------ */
    /* --------------------------Logout------------------------------------- */

    public function logout(){        
            session_destroy(); //destroy all session
            redirect('app/login');
        
    }

}
