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
	  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
	  


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php $this->load->view('common/topbar'); ?>
            <!-- Top Bar End -->
            <!-- ========== Left Sidebar Start ========== -->
            <?php $this->load->view('common/sidebar'); ?>
			
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
										$a = get_header_menu_options();	
										
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
												$this->load->view('common/listing_links',array('arrAllLinks'=>array(0=>array('link'=>SITE_ROOT_URL.'/Master/add_'.$moduleName,'class'=>'addIcon','label'=>'Add State'))));
											} 
											?>
										</div>
									<br>
                                <div class="row">
                                    <table class="table table-striped table-bordered" id = "example1">
                                            <thead>
												<tr>
												<th>SNO</th>
												<th>Name</th>												
												<th>Action</th>
												</tr>
											</thead>
										<tbody>
											<?php 
											
											if(is_array($data) && count($data)>0)
											{
											$i = 1;
												foreach($data as $row)
												{
													
													?>
													<tr>
														<td><?php echo $i; ?></td>
														<td><?php echo $row['name']; ?></td>														
														<td>
														<?php
																  
															$arrAllLinks=array();
															if(check_module_action_access($a['actionLists'], 'Master/edit_'.$moduleName)){
																
																$arrAllLinks[]=array('link'=>SITE_ROOT_URL.'/Master/edit_'.$moduleName.'/'.$row['id'],'label'=>'Modify','class'=>'modify');
															} 
															if(check_module_action_access($a['actionLists'], 'Master/view_'.$moduleName)){
																$arrAllLinks[]=array('link'=>SITE_ROOT_URL.'/Master/view_'.$moduleName.'/'.$row['id'],'label'=>'View','class'=>'viewIcon'); 
															} 
															 if(count($arrAllLinks)){
																$this->load->view('common/listing_links',array('arrAllLinks'=>$arrAllLinks));
															}
														 
														  ?>
														</td>
													</tr>
													<?php
													$i++;
												}
												
											} else { ?>
												<div class="form-group form-group no-records-found"><label><strong class="text-danger"><i class="ti-face-sad text-pink"></i> <?php echo $this->lang->line('Who0ps!_No_Records_Found'); ?></strong></label></div> 
											<?php } ?>
										</tbody>
									</table>
									
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
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
		




  
  <script>
	
	 $(function () {
    $('#example1').DataTable();

  });
  
   
		
	</script>
	
	


    </body>
</html>

