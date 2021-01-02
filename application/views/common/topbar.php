<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
           <!-- <a href="index.html" class="logo"><i class="icon-c-logo">BB</i><span>Broker Bazaar</span></a>-->
            <!-- Image Logo here -->
            <a href="<?php echo base_url('app/home'); ?>" class="logo">
                <span><img src="https://dhwaniris.in/wp-content/uploads/2018/08/Dhwani-Logo_Versions-e1533798168980.png" alt="Samara" height="45" title="Samara"></span>
            </a>
        </div>
    </div>
<?php //die("okk");?>
    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">
                <div class="pull-left">
                    <button class="button-menu-mobile open-left waves-effect waves-light">
                        <i class="md md-menu" title=""></i>
                    </button>
                    <span class="clearfix"></span>

                </div>
                

                <ul class="nav navbar-nav navbar-right pull-right">


                    <li>
                        <a href="#" class="text-weight">Welcome: <?php echo $_SESSION['name']; ?></a>
                    </li>
                    <li class="dropdown top-menu-item-xs">
                        <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                            <img src = 
							"<?php echo !empty($_SESSION['profile_picture']) ? BASE_URL."public/img/child_images/". $_SESSION['profile_picture'] : BASE_URL."public/img/child_images/no_image.jpg" ?>"
							height="130px"; width="130px"; alt="No Image" >
                        </a>
                        
						<ul class="dropdown-menu">
							<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							  <span class="hidden-xs"><?php $sessData = $this->session->all_userdata();
								echo  $_SESSION['name']; ?></span>
							</a>
      
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url('app/logout'); ?>"><i class="fa fa-sign-out m-r-10 text-danger"></i>Logout</a></li>
                        </ul>
                 
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>