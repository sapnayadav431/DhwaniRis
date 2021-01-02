<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model {
    /* ---------------VALIDATE USER EXIST with email and empid-------------------- */

    public function validateUserExist($username) {
       $qry = $this->db->where('name', $username)               
                ->get('childs');
				
        if ($qry->num_rows() > 0) {
            $resultData['status'] = TRUE;
            $resultData['info'] = $qry->row_array();
        } else {
            $resultData['status'] = FALSE;
        }
	
        return $resultData;

    }
	
	  public function get_header_menu_options($loggedUserId){
            
			
			$query = "SELECT e.actionUrl, f.displayName moduleName, e.displayName as actionName, e.showInHeaderMenu, f.id as moduleId, f.configName, f.moduleTag module_tag
			FROM childs a inner join module_actions e on e.id = d.moduleActionId and e.isActive = '1'
			inner join modules f on f.id = e.moduleId and f.isActive = '1'
			where a.id = '$loggedUserId'  group by e.id  ORDER BY f.flow asc, e.flow asc";

      
            $arrHeaderMenu=$this->get_rows_record($query);
            if(empty($arrHeaderMenu)){
                
            }else{
                $arrModuleActionsList=array();
                $arrMenuData=array();                
                $arrAllActions=array();
                $arrHeaderMenuModuleId=array();
                $arrActionModuleId=array();
                for($i=0; $i<count($arrHeaderMenu); $i++){
                    
                    $arrAction=array('actionName'=>$arrHeaderMenu[$i]['actionName'],'actionUrl'=>$arrHeaderMenu[$i]['actionUrl'],'showInHeaderMenu'=>$arrHeaderMenu[$i]['showInHeaderMenu']);
                    $arrModuleActionsList[]=$arrHeaderMenu[$i]['actionUrl'];
                    $arrActionModuleId[$arrHeaderMenu[$i]['actionUrl']]=$arrHeaderMenu[$i]['moduleId'];
                    if($arrHeaderMenu[$i]['showInHeaderMenu']=='1'){
                        $moduleHeaderMenuIndex=count($arrHeaderMenuModuleId);
                        if(in_array($arrHeaderMenu[$i]['moduleId'],$arrHeaderMenuModuleId)){
                            $moduleHeaderMenuIndex = array_search($arrHeaderMenu[$i]['moduleId'], $arrHeaderMenuModuleId);
                        }else{
                            $arrHeaderMenuModuleId[]=$arrHeaderMenu[$i]['moduleId'];
                            $arrMenuData[$moduleHeaderMenuIndex]=array('moduleName'=>$arrHeaderMenu[$i]['moduleName'],'configName'=>strtolower($arrHeaderMenu[$i]['configName']) , 'module_tag'=>$arrHeaderMenu[$i]['module_tag'], 'moduleId'=>$arrHeaderMenu[$i]['moduleId']);
                        }
                        $arrMenuData[$moduleHeaderMenuIndex]['actions'][]=$arrAction;
                    }
                    
                    
                }
                //echo '<pre>';print_r($arrMenuData);die;
                $this->datalayer['headerMenuOptions']=$arrMenuData;
                $this->datalayer['actionLists']=$arrModuleActionsList;
                $this->datalayer['arrActionModuleId']=$arrActionModuleId;
                $this->datalayer['arrHeaderMenuModuleId']=$arrHeaderMenuModuleId;
            }
        }
		
		
		function get_rows_record($query)
        {
			
                $master=$this->db;
                $resulset   = $master->query($query);
                $total_rows =$resulset->num_rows();
				$result		=array();
				if($total_rows>0)
				{
						foreach($resulset->result_array() as $row)
						{
								$this->data_stripslashes($row);
								//$result[]=$row;
								
								array_push($result,$row);
						}
				}
				//print_r($result);
                return $result;
        }
		
	
		
    /* ---------------VALIDATE USER ACCOUNT-------------------- */

    public function validateUserAC($username, $pwd) {
		
        $customwhere = "(name='$username')";
      $qry = $this->db->where($customwhere)
                ->where('password', sha1($pwd))
                ->get('childs');
				
        if ($qry->num_rows() > 0) {
			
            $resultData['status'] = TRUE;
            $resultData['info'] = $qry->row_array();
        } else {
			
            $resultData['status'] = FALSE;
        }
		
        return $resultData;
    }

    


    

}
