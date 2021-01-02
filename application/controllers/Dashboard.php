<?php

//die("hgyhjgujhgjuhgjh");
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public $datalayer, $projectName;

    public function __construct() {
        parent::__construct();
       
    }
	

    public function loaddashboard() {
	     
        $this->load->view('dashboard/dashboard', $this->datalayer);
    }

}
