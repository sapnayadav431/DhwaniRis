<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

  public $datalayer, $modelInstance;
	
	function __construct()
	{
		//The Call Parent constructor
		parent::__construct();   
        
        $this->load->model('Master_Model');
	}
	/* ----------------------state_listing------------------------ */
	function state_listing(){
		
		$query="SELECT * from state where type='S' and parent='0'";
        $datarecord = $this->Master_Model->findAll($query);
        $this->datalayer['data'] = $datarecord;
		$this->load->view('masters/state_master', $this->datalayer);
    }
	   
	/* ----------------------add state------------------------ */
	public function add_state()
	{
        $state = $this->input->post('state',TRUE);	
		
		$param = array(
	   'name' => $state,
	   'type' => 'S',
	   'parent' => 0
	   );
	   
	   $table = 'state';
		
	   
	    if($this->input->post('submit',TRUE))
		{
			$this->form_validation->set_rules('state', 'State Name','required');
			
						
			if ($this->form_validation->run() != FALSE)
			{
				$validateState = $this->Master_Model->validateExist($table,$param);
				
                if ($validateState['status'] != 1) 
				{
					$this->Master_Model->insert($table,$param);
					$this->datalayer['success_msg_key'] ='State Added Successfully';
				}
				else{
					$this->datalayer['error_msg_key']='State Already Exists';
				}
			}
			else
			{
				$this->datalayer['error_msg_key']='Something went Wrong';
			}
		}
		
			$this->load->view('masters/add_state', $this->datalayer);
	} 


		
	/* ----------------------edit State ------------------------ */
	public function edit_state($id)
	{
		$state = $this->input->post('state',TRUE);
		
		
		
		$param = array(
		'id' => $id,
	   'name' => $state,
	   'type' => 'S',
	   'parent' => 0
	   );
	   
	   $table = 'state';
		
	   
	    if($this->input->post('submit',TRUE))
		{
			$this->form_validation->set_rules('state', 'State Name','required');
			
						
			if ($this->form_validation->run() != FALSE)
			{
				
					$this->Master_Model->update($table,$param);
					$this->datalayer['success_msg_key'] = 'State Updated Successfully';
				
			}
			else
			{
				$this->datalayer['error_msg_key']='Something went Wrong';
			}
		}
			$query="SELECT * FROM state WHERE id=".$id;
			
			$this->datalayer['data']=$this->Master_Model->get_row_record($query);
			
			
			$this->load->view('masters/edit_state', $this->datalayer);
	}
	
	
	/* ----------------------view state------------------------ */
	public function view_state($id)
	{
		$query="SELECT * FROM state WHERE id=".$id;
		
		
		$this->datalayer['data']=$this->Master_Model->get_row_record($query);
		
		$this->load->view('masters/view_state', $this->datalayer);
	}
	
	/* ----------------------district_listing------------------------ */
	function district_listing(){
		
		$query="select a.*,b.name as state_name from state a, state b where a.parent=b.id and a.type='D' and a.parent!='0' order by state_name";
        $datarecord = $this->Master_Model->findAll($query);
        $this->datalayer['data'] = $datarecord;
		$this->load->view('masters/district_master', $this->datalayer);
    }
	
	/* ----------------------add district------------------------ */
	public function add_district()
	{
        $state = $this->input->post('state',TRUE);
		$district = $this->input->post('district',TRUE);
		
		
		
		$param = array(
	   'name' => $district,
	   'type' => 'D',
	   'parent' => $state
	   );
	   
	   $table = 'state';
		
	   
	    if($this->input->post('submit',TRUE))
		{
			$this->form_validation->set_rules('state', 'State Name','required');
			$this->form_validation->set_rules('district', 'District Name','required');
						
			if ($this->form_validation->run() != FALSE)
			{
				$validateDistrict = $this->Master_Model->validateExist($table,$param);
				
                if ($validateDistrict['status'] != 1) 
				{
					$this->Master_Model->insert($table,$param);
					$this->datalayer['success_msg_key'] = 'District Added Successfully';
				}
				else{
					$this->datalayer['error_msg_key']='District Already Exists';
				}
			}
			else
			{
				$this->datalayer['error_msg_key']='Something went Wrong';
			}
		}
			$this->datalayer['state']= $this->Master_Model->findAll("select * from state where type='S' and parent='0' order by name asc");
			$this->load->view('masters/add_district', $this->datalayer);
	} 
	
	/* ----------------------edit district ------------------------ */
	public function edit_district($id)
	{
		$state = $this->input->post('state',TRUE);
		$district = $this->input->post('district',TRUE);
		
		
		
		$param = array(
		'id' => $id,
		'name' => $district,
		'type' => 'D',
		'parent' => $state
		
	   );
	   
	   $table = 'state';
		
	   
	    if($this->input->post('submit',TRUE))
		{
			$this->form_validation->set_rules('state', 'State Name','required');
			$this->form_validation->set_rules('district', 'District Name','required');
			
						
			if ($this->form_validation->run() != FALSE)
			{
				
					$this->Master_Model->update($table,$param);
					$this->datalayer['success_msg_key'] = 'District Updated Successfully';
				
			}
			else
			{
				$this->datalayer['error_msg_key']='Something went Wrong';
			}
		}
			$query="SELECT * FROM state WHERE id=".$id;
			
			$this->datalayer['data']=$this->Master_Model->get_row_record($query);
			
			$this->datalayer['state']= $this->Master_Model->findAll("select * from state where type='S' and parent='0' order by name asc");
			$this->load->view('masters/edit_district', $this->datalayer);
	}
	
	
	/* ----------------------view district------------------------ */
	public function view_district($id)
	{
		$query="select a.*,b.name as state_name from state a, state b where a.parent=b.id and a.type='D' and a.parent!='0' and a.id=".$id;
		
		$this->datalayer['data']=$this->Master_Model->get_row_record($query);
		
		$this->load->view('masters/view_district', $this->datalayer);
	}
	
	/* ----------------------child listing------------------------ */
	public function child_listing()
	{
		
		$query="select ch.*,a.name as state_name,b.name as district_name,ch.* from state a  inner Join childs ch on a.id=  ch.state  inner Join state b on b.id=  ch.district";
		
		$this->datalayer['data'] = $this->Master_Model->findAll($query);
		
		$this->load->view('masters/child_master', $this->datalayer);
			
	}
	
	
	/* ----------------------add child------------------------ */
	public function add_child()
	{
		$name = $this->input->post('name',TRUE);
		$password = sha1($this->input->post('password',TRUE));
		$sex = $this->input->post('sex',TRUE);
		$dob = date("Y-m-d", strtotime($this->input->post('dob',TRUE)));
		$f_name = $this->input->post('f_name',TRUE);
		$m_name = $this->input->post('m_name',TRUE);
		$state = $this->input->post('state',TRUE);
		$district = $this->input->post('district',TRUE);
		
		$param = array(
	   'name' => $name,
	   'password' => $password,
	   'sex' => $sex,
	   'father_name' => $f_name,
	   'mother_name' => $m_name,
	   'dob' => $dob,
	   'state' => $state,
	   'district' => $district	     
	   );
		
	   $table = 'childs';
		
	   
	    if($this->input->post('submit',TRUE))
		{
			$this->form_validation->set_rules('name', 'Name','required');
			$this->form_validation->set_rules('password', 'Password','required');
			$this->form_validation->set_rules('sex', 'Sex','required');
			$this->form_validation->set_rules('dob', 'DOB','required');
			$this->form_validation->set_rules('f_name', 'Father Name','required');
			$this->form_validation->set_rules('m_name', 'Mother Name','required');
			$this->form_validation->set_rules('state', 'State Name','required');
			$this->form_validation->set_rules('district', 'District Name','required');
						
			if ($this->form_validation->run() != FALSE)
			{
				$validateChild = $this->Master_Model->validateExist($table,$param);
				
                if ($validateChild['status'] != 1) 
				{	
					$id = $this->Master_Model->insert($table,$param);
					
					$config = array(
					'upload_path' => FCPATH.'public/img/child_images/',
					'allowed_types' => "gif|jpg|png|jpeg",
					'overwrite' => TRUE,
					'max_size' => "2048000", 
					'max_height' => "768",
					'max_width' => "1024"
					);
				
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload('photo'))
					{ 			
						 $this->datalayer['error_msg_key'] = "Error In Uploding Photo";
					}
					else
					{						
						$imageDetailArray = $this->upload->data();
						$image =  $imageDetailArray['file_name'];
						$param2=array('id'=>$id,'profile_picture' => $image);						
						$this->Master_Model->update($table,$param2);
					}
					
					$this->datalayer['success_msg_key'] = "Child Added Successfully";
					
				}
				else{
					$this->datalayer['error_msg_key']= "Child Already Exists";
				}
			}
			else
			{
				$this->datalayer['error_msg_key']="Something Went Wrong";
			}
		}
		
			$this->datalayer['state']= $this->Master_Model->findAll("select * from state where type='S' order by name asc");
			
			
			$this->load->view('masters/add_child', $this->datalayer);
	}
	
	/* ----------------------edit child ------------------------ */
	public function edit_child($id)
	{
		$name = $this->input->post('name',TRUE);
		$password = sha1($this->input->post('password',TRUE));
		$sex = $this->input->post('sex',TRUE);
		$dob = date("Y-m-d", strtotime($this->input->post('dob',TRUE)));
		$f_name = $this->input->post('f_name',TRUE);
		$m_name = $this->input->post('m_name',TRUE);
		$state = $this->input->post('state',TRUE);
		$district = $this->input->post('district',TRUE);
		
		$param = array(
		'id' => $id,
	   'name' => $name,
	   'password' => $password,
	   'sex' => $sex,
	   'father_name' => $f_name,
	   'mother_name' => $m_name,
	   'dob' => $dob,
	   'state' => $state,
	   'district' => $district	     
	   );
		
	   $table = 'childs';
		
	   
	    if($this->input->post('submit',TRUE))
		{
			$this->form_validation->set_rules('name', 'Name','required');
			$this->form_validation->set_rules('password', 'Password','required');
			$this->form_validation->set_rules('sex', 'Sex','required');
			$this->form_validation->set_rules('dob', 'DOB','required');
			$this->form_validation->set_rules('f_name', 'Father Name','required');
			$this->form_validation->set_rules('m_name', 'Mother Name','required');
			$this->form_validation->set_rules('state', 'State Name','required');
			$this->form_validation->set_rules('district', 'District Name','required');
						
			if ($this->form_validation->run() != FALSE)
			{
				
					$this->Master_Model->update($table,$param);
					
					$config = array(
					'upload_path' => FCPATH.'public/img/child_images/',
					'allowed_types' => "gif|jpg|png|jpeg",
					'overwrite' => TRUE,
					'max_size' => "2048000", 
					'max_height' => "768",
					'max_width' => "1024"
					);
				
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload('photo'))
					{ 			
						 $this->datalayer['error_msg_key'] = "Error In Uploding Photo";
					}
					else
					{						
						$imageDetailArray = $this->upload->data();
						$image =  $imageDetailArray['file_name'];
						$param2=array('id'=>$id,'profile_picture' => $image);						
						$this->Master_Model->update($table,$param2);
					}
					$this->datalayer['success_msg_key'] = "Child Updated Successfully";
					
				
			}
			else
			{
				$this->datalayer['error_msg_key']="Something Went Wrong";
			}
		}
			$query="select ch.*,a.name as state_name,b.name as district_name,ch.* from state a  inner Join childs ch on a.id=  ch.state  inner Join state b on b.id=  ch.district where ch.id=".$id;
			
			
			$this->datalayer['child_data']=$this->Master_Model->get_row_record($query);
			
			$this->datalayer['state']= $this->Master_Model->findAll("select * from state where type='S' order by name asc");
			
			$this->load->view('masters/edit_child', $this->datalayer);
	}
	
	/* ----------------------view child------------------------ */
	public function view_child($id)
	{
		$query="select ch.*,a.name as state_name,b.name as district_name,ch.* from state a  inner Join childs ch on a.id=  ch.state  inner Join state b on b.id=  ch.district where ch.id=".$id;
		
		$this->datalayer['data']=$this->Master_Model->get_row_record($query);
		
		$this->load->view('masters/view_child', $this->datalayer);
	}
	
}
