<!DOCTYPE html>

<html>

    <?php $this->load->view('common/head'); 
	
	?>

    <style>
        .h4,h4{
            font-size: 15px;
        }
        .h2, h2 {
            font-size: 24px;
        }
        .btn{
            padding: 5px 9px;
        }

    </style>
    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php $this->load->view('common/topbar'); ?>
            <!-- Top Bar End -->
            <!-- ========== Left Sidebar Start ========== -->
            <?php $this->load->view('common/sidebar'); ?>
			<?php $a = get_header_menu_options();	
			$module_action = '/'.$this->uri->segments[1].'/'.$this->uri->segments[2].'/'.$this->uri->segments[3];
			?>
            <!-- Left Side bar End -->
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
						<div class="row">
                            <div class="col-sm-12">
                                <ol class="breadcrumb">
									<li>
									<a href="#">Admin Center</a>
									</li>
                                    <li>
                                        <a href="#"><?php
										
											$controllerActionName=$this->uri->segment(2);
											$arrControllerActionName=explode('_',$controllerActionName);
											$moduleName=$arrControllerActionName[0];
											$module=$arrControllerActionName[1];
											echo ucwords($moduleName).' '.ucwords($module);
											?></a>
                                    </li>
                                   </ol>
                            </div>
                        </div>
                        <!-- Page-Title -->
                         <div class="box box-primary">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="container">
                                        <div class="row">
                                            <?php
											if(check_module_action_access($a['actionLists'], 'Master/add_'.$moduleName)){
												$this->load->view('common/listing_links',array('arrAllLinks'=>array(0=>array('link'=>SITE_ROOT_URL.'/Master/add_'.$moduleName,'class'=>'addIcon','label'=>'Add City'))));
											} 
											?>
										</div>
									
                                <div class="row">
								<form name="submit" method="post" data-parsley-validate="" id="view_city_frm" action="<?php echo SITE_ROOT_URL.$module_action; ?>">
                                    <table class="table table-striped table-bordered" id = "example1">
                                        <tr>
											<td align="right" class="col-sm-4"><b>Profile Picture</b></td>
											<td align="left"><img src = 
												"<?php echo !empty($data['profile_picture']) ? BASE_URL."public/img/child_images/". $data['profile_picture'] : BASE_URL."public/img/employee_images/no_image.png" ?>"
												height="130px"; width="130px"; alt="No Image" ></td>
										</tr>
										<tr>
											<td align="right" class="col-sm-4"><b>Name</b></td>
											<td align="left"><?php echo $data['name']; ?></td>
										</tr>
										 <tr>
											<td align="right" class="col-sm-4"><b>Sex</b></td>
											<td align="left"><?php if($data['sex'] == 'M'){echo 'Male';}else{echo 'Female';}?></td>
										</tr>
										 <tr>
											<td align="right" class="col-sm-4"><b>Date Of Birth</b></td>
											<td align="left"><?php echo date('d-m-Y',strtotime($data['dob'])); ?></td>
										</tr>
										 <tr>
											<td align="right" class="col-sm-4"><b>Father Name</b></td>
											<td align="left"><?php echo $data['father_name']; ?></td>
										</tr>
										<tr>
											<td align="right" class="col-sm-4"><b>Mother Name</b></td>
											<td align="left"><?php echo $data['mother_name']; ?></td>
										</tr>
										<tr>
											<td align="right" class="col-sm-4"><b>State</b></td>
											<td align="left"><?php echo $data['district_name']; ?></td>
										</tr>
										<tr>
											<td align="right" class="col-sm-4"><b>District</b></td>
											<td align="left"><?php echo $data['state_name']; ?></td>
										</tr>
										
										
										<tr>
											 <td colspan="2">
											<?php
											$controllerActionName=$this->uri->segment(2);
											$arrControllerActionName=explode('_',$controllerActionName);
											$moduleName=$arrControllerActionName[1];
											
											if(check_module_action_access($a['actionLists'], 'Master/'.$moduleName.'_listing')){
											?>
											<a href="<?php echo SITE_ROOT_URL;?>/master/<?php echo $moduleName ?>_listing/" class="cancelButton btn btn-primary">Back</a>
											<?php } 
											?>
											
										
											<?php
											if(check_module_action_access($a['actionLists'], 'Master/edit_'.$moduleName.'')){
											?>
											 <a href="<?php echo SITE_ROOT_URL;?>/master/edit_<?php echo $moduleName ?>/<?php echo $data['id']; ?>" class="editButton btn btn-success">Edit</a>
											<?php } 
											?>
										</td>
									</tr>
									</table>
									</form>
                                </div>
								
							</div>
                            </div>

                            </div> <!-- end Panel -->
                        </div> <!-- container -->

                    </div> <!-- content -->
                </div>
					
                            </div>
                        </div>
                        
           
        </div> <!-- content -->
        <!-- END wrapper -->
        <?php $this->load->view('common/footerjs'); ?>
 <script>
	
		
	</script>
	
	


    </body>
</html>

