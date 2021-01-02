<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            
                  <?php
			
				 $a = get_header_menu_options();
			
           $currentModuleId = 0;
            echo '  <ul class="sidebar-menu" data-widget="tree">';
            for($i=0; $i<count($a['headerMenuOptions']); $i++){
                $classActive='';
				$childUiStyle='';
                if($currentModuleId==$a['headerMenuOptions'][$i]['moduleId']){				
                  $classActive='active subdrop';
				  $childUiStyle=' style="display:block !important"';
                }
                if(empty($a['headerMenuOptions'][$i]['configName'])){
                	$a['headerMenuOptions'][$i]['configName'] = 'bank';
                }
                $likUR = "#";
           
				echo'<li class="treeview" data-curr="'.$currentModuleId.'"   data-mid="'.$a['headerMenuOptions'][$i]['moduleId'].'">
					<a href="'.$likUR.'"  ><i class="fa fa-'.$a['headerMenuOptions'][$i]['configName'].'"></i> <span> '.$a['headerMenuOptions'][$i]['moduleName'].' </span>'; 
					
					echo '<span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i></span>';
					echo '</a>';
					
					echo '<ul class="treeview-menu"'.$childUiStyle.'>';
					for($j=0; $j<count($a['headerMenuOptions'][$i]['actions']); $j++){
					if($a['headerMenuOptions'][$i]['actions'][$j]['showInHeaderMenu']==1){
						echo '<li><a href="'.BASE_URL.$a['headerMenuOptions'][$i]['actions'][$j]['actionUrl'].'"><i class="fa fa-circle-o"></i> '.$a['headerMenuOptions'][$i]['actions'][$j]['actionName'].'</a></li>';
						}
					}
					echo'</ul>
				</li>';			
            }
            echo '</ul>';      
         
            ?>
                   
        </div>
    </div>
</div>