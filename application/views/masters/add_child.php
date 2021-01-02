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
			$module_action = '/'.$this->uri->segments[1].'/'.$this->uri->segments[2];
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
												$this->load->view('common/listing_links',array('arrAllLinks'=>array(0=>array('link'=>SITE_ROOT_URL.'/Master/add_'.$moduleName,'class'=>'addIcon','label'=>'Add Child'))));
											} 
											?>
										</div>
									
                                <div class="row">
								<form name="submit" method="post" data-parsley-validate="" id="add_state_frm" action="<?php echo SITE_ROOT_URL.$module_action; ?>" enctype="multipart/form-data">
                                    <table class="table table-striped table-bordered" id = "example1">
                                       <tr>
									   <td align="right" class="col-sm-4"><label><b>Name</b><sup><i class="fa fa-asterisk text-danger"></i></sup></label></td>
										<td align="left"><input type="text" class="form-control"  placeholder="Name" name="name" required autocomplete = "off"></td>
										</tr>
										<tr>
									   <td align="right" class="col-sm-4"><label><b>Password</b><sup><i class="fa fa-asterisk text-danger"></i></sup></label></td>
										<td align="left"><input type="password" class="form-control"  placeholder="Password" name="password" required autocomplete = "off"></td>
										</tr>
									   <tr>
									   <td align="right" class="col-sm-4"><label><b>Sex</b><sup><i class="fa fa-asterisk text-danger"></i></sup></label></td>
										<td align="left">									
												<select name="sex" class="form-control select2" required>
												<option value="" disabled selected>Select Sex</option>												
												<option value="M">Male</option>
												<option value="M">Female</option>
												</select>												
										</td>	
									   </tr>
									   <tr>
									   <td align="right" class="col-sm-4"><label><b>Date of Birth</b><sup><i class="fa fa-asterisk text-danger"></i></sup></label></td>
										<td align="left"><input type="text" placeholder="Date of Birth" autocomplete="off" class="form-control pull-right" id="Datepicker" name="dob"></td>
										</tr>
										<tr>
									   <td align="right" class="col-sm-4"><label><b>Father's Name</b><sup><i class="fa fa-asterisk text-danger"></i></sup></label></td>
										<td align="left"><input type="text" class="form-control"  placeholder="Father's Name" name="f_name" required autocomplete = "off"></td>
										</tr>
										<tr>
									   <td align="right" class="col-sm-4"><label><b>Mother's Name</b><sup><i class="fa fa-asterisk text-danger"></i></sup></label></td>
										<td align="left"><input type="text" class="form-control"  placeholder="Mother's Name" name="m_name" required autocomplete = "off"></td>
										</tr>
										<tr>
									   <td align="right" class="col-sm-4"><label><b>State Name</b><sup><i class="fa fa-asterisk text-danger"></i></sup></label></td>
										<td align="left">
											<?php
											if(!empty($state)){
														
												$totalRow=count($state);?>
												<select name="state"  id="state" class="form-control select2" required>
												<option value="">Select State</option>
												<?php for($i=0; $i<($totalRow); $i++){ ?>
												<option value="<?php echo $state[$i]['id'];?>"><?php echo $state[$i]['name'];?></option>
												<?php  } ?>
												</select>
											<?php }
											?>
											
										</td>	
									   </tr>
									   <tr>
									   <td align="right" class="col-sm-4"><label><b>District Name</b><sup><i class="fa fa-asterisk text-danger"></i></sup></label></td>
										<td align="left">
											<select class="form-control select2"  name= "district"  id="district" required>
											<option value="" selected disabled>Select District</option>
											</select>
										</td>	
									   </tr>
									   <tr>
									   <td align="right" class="col-sm-4"><label><b>Profile Photo</b><sup><i class="fa fa-asterisk text-danger"></i></sup></label></td>
										<td align="left"><input type="file" name="photo" class="form-control"
													 accept="image/png, image/jpeg, image/jpg " ></td>
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
											<input type="submit" name="submit" class="btn btn-success"  value="Submit">
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
	$('#Datepicker').datepicker({
      autoclose: true,
	   dateFormat: "dd-mm-YYYY"
    });
	$('#state').change(function(){
	var state = $('#state').val();
		  $.ajax({
		  type: "GET",
		  data: {'state':state},
		  url: "<?php echo BASE_URL ?>ajax_controller/get_district", 
		  success: function(result){
			$('#district').empty();  
			var district_name = JSON.parse(result);  
			var district_list = '';
			district_list += "<option value ='' selected disabled>Select District</option>"; 
			 $(district_name).each(function (k,v) {
				 district_list += "<option value ='"+v['id']+"'>"+v['name']+" </option>"; 
			 });
			 
			$('#district').append(district_list);  
			}
		});
	});
		
	</script>
	
	


    </body>
</html>

