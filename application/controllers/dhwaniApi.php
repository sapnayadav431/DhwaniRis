  <?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dhwaniApi extends CI_Controller {

		
        function __construct(){
                //The Call Parent constructor
                parent::__construct();
                $this->load->model('Master_Model');
				$this->load->model('Login_Model');
				
				
        }
		
        /* ----------------------get states------------------------ */
		public function getStates()
		{
			
			$query = "select  * FROM state WHERE type = 'S'";
			$states=  $this->Master_Model->findAll($query);
			
			if($states){
				$stateData= array(
					'states' => $states,					
					'status' => '200',
					'error' => 'false',
					'message' => 'Success'
				);
			}else {
				$stateData = array(
					'status' => '400',
					'error' => 'true',
					'message' => 'not found'
				);
			}
			echo json_encode($stateData);

		}
		
		/* ----------------------get district------------------------ */
		public function getDistricts()
		{
			
			$query = "select  * FROM state WHERE type = 'D'";
			$districts=  $this->Master_Model->findAll($query);
			
			if($districts){
				$districtData= array(
					'states' => $districts,					
					'status' => '200',
					'error' => 'false',
					'message' => 'Success'
				);
			}else {
				$districtData = array(
					'status' => '400',
					'error' => 'true',
					'message' => 'not found'
				);
			}
			echo json_encode($districtData);

		}
		/* ----------------------get childs------------------------ */
		public function getChilds()
		{
			
			$query = "select  * FROM childs";
			$childs=  $this->Master_Model->findAll($query);
			
			if($childs){
				$childData= array(
					'states' => $childs,					
					'status' => '200',
					'error' => 'false',
					'message' => 'Success'
				);
			}else {
				$childData = array(
					'status' => '400',
					'error' => 'true',
					'message' => 'not found'
				);
			}
			echo json_encode($childData);

		}
		/* ----------------------add state------------------------ */
		public function add_state()
		{
			$state = $this->input->post('state',TRUE);
			$this->form_validation->set_rules('state', 'The field', 'required|alpha');		
			if($this->form_validation->run() != FALSE) 
			{
				$param = array(
			   'name' => $state,
			   'type' => 'S',
			   'parent' => 0
			   );
		   
				$table = 'state';	   
			
					$validateState = $this->Master_Model->validateExist($table,$param);
					
					if ($validateState['status'] != 1) 
					{
						$addState = $this->Master_Model->insert($table,$param);
						
						$resultData= array(					
						'status' => '200',
						'error' => 'false',
						'message' => 'State Added Successfully!'
						);
						
					}
					else{
						$resultData = array(
						'status' => '400',
						'error' => 'true',
						'message' => 'State Already Exixts!'
						);
					}
			
			}
			else{
				$resultData = array(
				'status' => '400',
				'error' => 'true',
				'message' => 'Invalid Input !'
				);
			}
			echo json_encode($resultData);
				
		} 
		
		/* ----------------------add district------------------------ */
		public function add_district()
		{
				$state = $this->input->post('state',TRUE);		
				$district = $this->input->post('district',TRUE);		
				
				
					$this->form_validation->set_rules('state', 'The field', 'required|numeric|xss_clean');
					$this->form_validation->set_rules('district', 'The field', 'required|alpha');
					if($this->form_validation->run() != FALSE)
					{
							$param = array(
							'name' => $district,
							'type' => 'D',
							'parent' => $state
							);
							
							$table = 'state';				
							$validateDistrict = $this->Master_Model->validateExist($table,$param);
									
							if ($validateDistrict['status'] != 1) 
							{
								if($this->Master_Model->insert($table,$param))
								{
									$resultData = array(
									'status' => '200',
									'error' => 'true',
									'message' => 'District Added Successfully !'
									);
								}
							}		
							else
							{							
								$resultData = array(
								'status' => '400',
								'error' => 'true',
								'message' => 'District Already Exists !'
								);
							}
				
									
						}		 
						else{
							$resultData = array(
							'status' => '400',
							'error' => 'true',
							'message' => 'Invalid Input !'
							);
						}
			
				echo json_encode($resultData);
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
			
				$this->form_validation->set_rules('name', 'Name','required');
				$this->form_validation->set_rules('password', 'Password','required');
				$this->form_validation->set_rules('sex', 'Sex','required');
				$this->form_validation->set_rules('dob', 'DOB','required');
				$this->form_validation->set_rules('f_name', 'Father Name','required');
				$this->form_validation->set_rules('m_name', 'Mother Name','required');
				$this->form_validation->set_rules('state', 'State Name','required');
				$this->form_validation->set_rules('district', 'District Name','required');
					
			if($this->form_validation->run() != FALSE)
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
							 $resultData = array(
							'status' => '400',
							'error' => 'true',
							'message' => 'Error In Upload !'
							);
						}
						else
						{						
							$imageDetailArray = $this->upload->data();
							$image =  $imageDetailArray['file_name'];
							$param2=array('id'=>$id,'profile_picture' => $image);						
							$this->Master_Model->update($table,$param2);
						}
						
							$resultData = array(
							'status' => '200',
							'error' => 'true',
							'message' => 'Child Added Successfully !'
							);
						
					}
					else{
						$resultData = array(
						'status' => '400',
						'error' => 'true',
						'message' => 'Child Already Exists !'
						);
					}
				
			}
			else{
					$resultData = array(
					'status' => '400',
					'error' => 'true',
					'message' => 'Invalid Input !'
					);
				}
		
			echo json_encode($resultData);
		}
	
		/* -----------------------Login Validate------------------------------------- */

		public function userValidate() 
		{
			$username =     $this->input->post('username'); 
			$password =  $this->input->post('password'); 
			   
				
				$this->form_validation->set_rules('username', 'Username', 'trim|required', array('required' => 'Name is mandatory !!'));
				$this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'Password is Mandatory !!'));
				
				if ($this->form_validation->run()) {
						
						$validateUserData = $this->Login_Model->validateUserExist("$username"); //validate user by email account
						
							if($validateUserData['status'] == 1) 
							{
								
								$validateInfo = $this->Login_Model->validateUserAC($username,$password);							
								if($validateInfo['status'] == 1)
								{
									 $userinfo = $validateInfo['info'];
									 $_SESSION['id'] = $userinfo['id'];
									 $_SESSION['name'] = $userinfo['name'];
									 $_SESSION['profile_picture'] = $userinfo['profile_picture'];
									 $resultData = array(
										'status' => '200',
										'error' => 'true',
										'message' => 'Login Successfully!'
										);
								}
								else
								{								
									$resultData = array(
									'status' => '400',
									'error' => 'true',
									'message' => 'Invalid username or password!'
									);
								}
							}else{
								$resultData = array(
									'status' => '400',
									'error' => 'true',
									'message' => 'User Not Exixts!'
									);
							}
							
				} else {
				   $resultData = array(
					'status' => '400',
					'error' => 'true',
					'message' => 'Invalid Input!'
					);
				}
			echo json_encode($resultData);
		}
		
		/* --------------------------Logout------------------------------------- */
		public function logout()        
		{	  
				if(session_destroy())
				{
					$resultData = array(
					'status' => '200',
					'error' => 'true',
					'message' => 'Logout Successfully !'
					);
				}else{
					$resultData = array(
					'status' => '400',
					'error' => 'true',
					'message' => 'Something! Went Wrong'
					);
				}
				echo json_encode($resultData);
			
		}
		
 }