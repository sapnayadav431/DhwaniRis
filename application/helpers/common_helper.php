<?php

 function get_header_menu_options(){
            
			
			$query = "SELECT e.actionUrl, f.displayName as moduleName, e.displayName as actionName, e.showInHeaderMenu, f.id as moduleId, f.configName, f.moduleTag module_tag
			FROM module_actions e inner join modules f on f.id = e.moduleId 
			group by e.id  ORDER BY f.flow asc, e.flow asc";

   
            $arrHeaderMenu=get_rows_record($query);
			
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
               
					 $currentModuleId = 'a';
					$moduleName = '1';
               
					return array("headerMenuOptions" => $arrMenuData, "actionLists" => $arrModuleActionsList,"arrActionModuleId" =>$arrActionModuleId,"arrHeaderMenuModuleId" =>$arrHeaderMenuModuleId,"currentModuleId" =>$currentModuleId,"moduleName" =>$moduleName,"arrAction"=>$arrAction);
				
            }
        }
		
		
 function get_rows_record($query)
        {
				$CI = & get_instance();
                $master=$CI->db;
                $resulset   = $master->query($query);
                $total_rows =$resulset->num_rows();
				$result		=array();
				if($total_rows>0)
				{
						foreach($resulset->result_array() as $row)
						{
								data_stripslashes($row);
								
								array_push($result,$row);
						}
				}
				//print_r($result);die;
                return $result;
        }
		
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
/* ------------------------------check_module_action_access---------------------------- */
 
if ( ! function_exists('pr'))
{
    function pr($obj)
    {
        echo '<pre>';
                print_r($obj);
                echo '</pre>';
    }
}
 
 
function check_module_action_access($actionLists, $action)
	{ 
                //echo $action;pr($actionLists);die;
                $arrActionParam=explode('/', $action);
                if(strtolower($arrActionParam[0])=='common')
                    return true;
		else if(count($actionLists) && in_array($action,$actionLists))
                    return true;
                else
                    return false;
	}
