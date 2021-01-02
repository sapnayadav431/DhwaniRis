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
<link href ="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
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
								<form name="submit" method="post" data-parsley-validate="" id="edit_district_frm" action="<?php echo SITE_ROOT_URL.$module_action; ?>">
                                    <table class="table table-striped table-bordered" id = "example1">
                                       <tr>
									   <td align="right" class="col-sm-4"><label><b>State Name</b><sup><i class="fa fa-asterisk text-danger"></i></sup></label></td>
										<td align="left">
											<?php
											if(!empty($state)){
												
												$totalRow=count($state); ?>
												<select name="state" required class="form-control select2">
												<?php for($i=0; $i<($totalRow); $i++){ ?>
												<option <?php ($state[$i]['id']==$data['parent'] ? 'selected' : '')?> value="<?php echo $state[$i]['id'];?>"><?php echo $state[$i]['name'];?></option>
												<?php } ?>
												</select>
											<?php }
											?>
										</td>	
									   </tr>
										<tr>
											<td align="right"><label><b>District Name</b><sup><i class="fa fa-asterisk text-danger"></i></sup></label></td>
											<td align="left"><input type="text"  name="district" required value="<?php echo $data['name'];?>" class="form-control">
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
	
	$(function () {	
	 $('.select2').select2();
    
  });	
	</script>
	
	


    </body>
</html>

