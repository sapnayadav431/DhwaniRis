<!DOCTYPE html>
<html>
    <?php $this->load->view('common/head'); ?>

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
		.vkm
		{
			color: #811522;
			font-weight: 600;
			text-transform: uppercase;
		}
    </style>
    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php $this->load->view('common/topbar'); ?>
            <!-- Top Bar End -->
            <!-- ========== Left Sidebar Start ========== -->
            <?php $this->load->view('common/sidebar');
			
			?>
            <!-- Left Side bar End -->
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <!-- Page-Title -->
                        <div class="row">
                            <h2 align="center" class="vkm">Welcome to Dhwani IRs</h2>
							<span><img src="<?php echo base_url(); ?>public/img/child_images/Capture.png" width ="900" height="500" style="margin-left:100px;"/></span>
                        </div>
                        <!-- end col -->
                    </div> <!-- end row -->

                </div>
            </div> <!-- container -->

           
        </div> <!-- content -->
        <!-- END wrapper -->
        <?php $this->load->view('common/footerjs'); ?>


    </body>
</html>
