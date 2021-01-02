<?php
$arrITagClassMap=array(
						'viewIcon'=>'fa-eye',
						'editIcon'=>'fa-pencil',
						'default'=>'fa-folder',
						'addIcon'=>'fa-plus',
						'addButton' => 'fa-plus',						
						'modify' => 'fa fa-edit',
						'uploadIcon' => 'fa fa-upload'						
						);
$arrATagClassMap=array(
						'viewIcon'=>'btn-success',
						'editIcon'=>'btn-success',
						'default'=>'btn-success',
						'addIcon'=>'btn-success  pull-right margin-bottom-10',						
						'modify' => 'btn-success',
						'addButton'=>'btn-success'						
						);

if(!empty($arrAllLinks)){

	foreach($arrAllLinks as $arrLink){
		$arrATagClassMap[$arrLink['class']]=empty($arrATagClassMap[$arrLink['class']])?$arrATagClassMap['default']:$arrATagClassMap[$arrLink['class']];
		$arrITagClassMap[$arrLink['class']]=empty($arrITagClassMap[$arrLink['class']])?$arrITagClassMap['default']:$arrITagClassMap[$arrLink['class']];
		echo '<a href="'.$arrLink['link'].'" class="btn '.$arrATagClassMap[$arrLink['class']].'  btn-sm"><i class="fa '.$arrITagClassMap[$arrLink['class']].'"></i> '.$arrLink['label'].' </a>&nbsp;';

	}
	

	
}
?>