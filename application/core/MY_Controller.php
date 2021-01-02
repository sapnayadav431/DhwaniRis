<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * My Controller Class
 * This Class Represents the My Controller extend the CI_Controller class.
 * have some function that used in all site admin controllers
 *
 * @package     My Controller
 * @author		Schools
 */
class MY_Controller extends CI_Controller
{
        /*
        * contain the logged username value
        */
       
        public $datalayer;
        
        /**
        * The default constructor for My_Controller class.
        * @access	public
        */
        

        
      
        
        private function get_header_menu_options($loggedUserId){
            $this->load->model('Master_Model');
			
			$query = "SELECT e.actionUrl, f.displayName moduleName, e.displayName as actionName, e.showInHeaderMenu, f.id as moduleId, f.configName, f.moduleTag module_tag
			FROM tbl_user_master a 
			inner join user_role_map b on a.user_id = b.userid
			inner join roles c on c.id = b.roleId
			inner join role_action_map d on d.roleId = c.id
			inner join module_actions e on e.id = d.moduleActionId and e.isActive = '1'
			inner join modules f on f.id = e.moduleId and f.isActive = '1'
			where a.user_id = '$loggedUserId'  group by e.id  ORDER BY f.flow asc, e.flow asc";

      
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
                
                $this->datalayer['headerMenuOptions']=$arrMenuData;
                $this->datalayer['actionLists']=$arrModuleActionsList;
                $this->datalayer['arrActionModuleId']=$arrActionModuleId;
                $this->datalayer['arrHeaderMenuModuleId']=$arrHeaderMenuModuleId;
				$action=$this->uri->segments[1].'/'.$this->uri->segments[2];
				 $this->datalayer['currentModuleId']=$this->datalayer['arrActionModuleId'][$action];
                $moduleId=$this->datalayer['currentModuleId'];
                $moduleHeaderMenuIndex = array_search($moduleId, $this->datalayer['arrHeaderMenuModuleId']);
                $this->datalayer['moduleName']=$this->datalayer['headerMenuOptions'][$moduleHeaderMenuIndex]['moduleName'];
            
			
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
				//print_r($result);die;
                return $result;
        }
       
        
       

        // --------------------------------------------------------------------

        /**
        * check user validation
        *
        * @access	public
        * @param	string
        * @return	boolean
        */
       

        
        
       

        // --------------------------------------------------------------------

        /**
        * add slashes to data or data array
        *
        * @access	public
        * @param	string/array
        * @return	string/array
        */
       

         // --------------------------------------------------------------------

        /**
        * strip slashes from data or data array
        *
        * @access	public
        * @param	string/array
        * @return	string/array
        */
        function data_stripslashes(&$input)
        {
                if(is_array($input))
                {
                        foreach($input as $k=>$v)
                        {
                                $input[$k]      =stripslashes(trim($v));
                        }
                }
                else
                {
                        $input      =stripslashes(trim($input));
                }

               
        }

       
}
?>
