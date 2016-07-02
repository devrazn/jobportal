<!DOCTYPE HTML>
<html>
<head>
<title>JobPortal - Hire or Get Hired</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<link href="<?=base_url();?>assets/user/css/bootstrap-3.1.1.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="<?=base_url();?>assets/user/css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
<!--font-Awesome-->
<link href="<?=base_url();?>assets/user/css/font-awesome.css" rel="stylesheet"> 
<link href="<?=base_url();?>assets/user/css/custom.css" rel="stylesheet">
<!--jQuery UI CSS for DatePicker-->
<link href="<?=base_url();?>assets/user/css/jquery-ui.css" rel="stylesheet">

<style type="text/css">
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu>.dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
        margin-left: -1px;
        -webkit-border-radius: 0 6px 6px 6px;
        -moz-border-radius: 0 6px 6px;
        border-radius: 0 6px 6px 6px;
    }

    .dropdown-submenu:hover>.dropdown-menu {
        display: block;
    }

    .dropdown-submenu>a:after {
        display: block;
        content: " ";
        float: right;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
        border-width: 5px 0 5px 5px;
        border-left-color: #ccc;
        margin-top: 5px;
        margin-right: -10px;
    }

    .dropdown-submenu:hover>a:after {
        border-left-color: #fff;
    }

    .dropdown-submenu.pull-left {
        float: none;
    }

    .dropdown-submenu.pull-left>.dropdown-menu {
        left: -100%;
        margin-left: 10px;
        -webkit-border-radius: 6px 0 6px 6px;
        -moz-border-radius: 6px 0 6px 6px;
        border-radius: 6px 0 6px 6px;
    }
</style>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?=base_url();?>assets/user/js/jquery.min.js"></script>
<script src="<?=base_url();?>assets/user/js/bootstrap.min.js"></script>

</head>
<body>
<nav class="navbar navbar-default" role="navigation">
	<div class="container">
	    <div class="navbar-header">
	        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
	        </button>
	        <a class="navbar-brand" href="<?=base_url()?>"><img src="<?=base_url().'uploads/admin/images/'.$this->config->item('logo')?>" alt="<?=$this->config->item('site_name')?> - logo"/></a>
	    </div>
	    <!--/.navbar-header-->
	    <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" style="height: 1px;">
	        <ul class="nav navbar-nav">
		        <li class="dropdown">
		            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Jobs<b class="caret"></b></a>
		            <ul class="dropdown-menu">
			            <li><a href="location.html">Contract Jobs</a></li>
			            <li><a href="location.html">Walkin Jobs</a></li>
			            <li><a href="location.html">Jobs by Location</a></li>
			            <li><a href="location.html">Jobs by Function</a></li>
			            <li><a href="location.html">Jobs by Industry</a></li>
			            <li><a href="location.html">Jobs by Company</a></li>
		            </ul>
		        </li>
		        <li class="dropdown">
		            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories<b class="caret"></b></a>
		            <ul class="dropdown-menu" id="dropdown-menu">
			            <?=bootstrap_menu($this->helper_model->get_category_for_menu())?>
		            </ul>
		        </li>
		        <li class="dropdown">
		        	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Services<b class="caret"></b></a>
		            <ul class="dropdown-menu multi-column columns-3">
			            <div class="row">
				            <div class="col-sm-4">
					            <ul class="multi-column-dropdown">
						            <li><a href="services.html">Action</a></li>
						            <li><a href="services.html">Another action</a></li>
						            <li><a href="services.html">Something else here</a></li>
						            <li class="divider"></li>
						            <li><a href="services.html">Separated link</a></li>
						            <li class="divider"></li>
						            <li><a href="services.html">One more separated link</a></li>
					            </ul>
				            </div>
				            <div class="col-sm-4">
					            <ul class="multi-column-dropdown">
						            <li><a href="services.html">Action</a></li>
						            <li><a href="services.html">Another action</a></li>
						            <li><a href="services.html">Something else here</a></li>
						            <li class="divider"></li>
						            <li><a href="services.html">Separated link</a></li>
						            <li class="divider"></li>
						            <li><a href="services.html">One more separated link</a></li>
					            </ul>
				            </div>
				            <div class="col-sm-4">
					            <ul class="multi-column-dropdown">
						            <li><a href="services.html">Action</a></li>
						            <li><a href="services.html">Another action</a></li>
						            <li><a href="services.html">Something else here</a></li>
						            <li class="divider"></li>
						            <li><a href="services.html">Separated link</a></li>
						            <li class="divider"></li>
						            <li><a href="services.html">One more separated link</a></li>
					            </ul>
				            </div>
			            </div>
		            </ul>
		        </li>
		        <li class="dropdown">
		            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Recruiters<b class="caret"></b></a>
		             <ul class="dropdown-menu">
			            <li><a href="login.html">Recruiter Updates</a></li>
			            <li><a href="recruiters.html">Recruiters you are following</a></li>
			            <li><a href="codes.html">Shortcodes</a></li>
		             </ul>
		        </li>
		        <li class="dropdown">
		            <a href="#" class="dropdown-toggle" data-toggle="dropdown">More<b class="caret"></b></a>
		            <ul class="dropdown-menu">
			            <li><a href="jobs.html">Walk-ins</a></li>
			            <li><a href="jobs.html">Bpo Jobs</a></li>
			            <li><a href="jobs.html">Teaching Jobs</a></li>
			            <li><a href="jobs.html">Diploma Jobs</a></li>
			            <li><a href="jobs.html">Tech Support</a></li>
			            <li><a href="jobs.html">Finance Jobs</a></li>
			            <li><a href="jobs.html">Part time Jobs</a></li>
			            <li><a href="jobs.html">Health Care</a></li>
			            <li><a href="jobs.html">Hospitality</a></li>
			            <li><a href="jobs.html">Internships</a></li>
			            <li><a href="jobs.html">Research Jobs</a></li>
			            <li><a href="jobs.html">Defence Jobs</a></li>
		            </ul>
		        </li>
		        <?php
		        if(!($this->helper_model->validate_user_session() || isset($_SESSION['tw_status']) || isset($_SESSION['fb_access_token']))):?>
		        <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Register<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=base_url().'Register';?>">Register As JobSeeker</a></li>
                        <li><a href="<?=base_url().'register/register_employer';?>">Register As Employer</a></li>
                    </ul>
                </li>
                <?php
                	endif;
                ?>

                <?php
                $id = $this->session->userdata('user_id');
		        	if($this->helper_model->validate_user_session() || isset($_SESSION['tw_status']) || isset($_SESSION['gmail_full_name']) || isset($_SESSION['fb_status'])) {
		        		if(isset($_SESSION['tw_status'])) {
		        			$user = $_SESSION['tw_status'];
		        		} else if(isset($_SESSION['fb_status'])) {
		        			$user = $_SESSION['fb_status'];
		        		} else if(isset($_SESSION['gmail_full_name'])) {
		        			$user = $_SESSION['gmail_full_name'];
		        		} else {
		        			$user = $this->session->userdata('name');
		        		}
		        ?>
		        <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, <?=$this->session->userdata('name');?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                    	<li><a href="<?=base_url().'user_profile/jobseeker_details';?>">Profile</a></li>
                    	<li><a href="<?=base_url().'user_profile/change_password';?>">Change Password</a></li>
                        <li><a href="<?=base_url().'user_profile/edit_profile';?>">Update Profile</a></li>
                        <?php 
                        	if($this->session->userdata('user_type') == 2) {
                        ?>
                        <li><a href="<?=base_url().'job/'?>">Post Job</a></li>
                        <?php } else { ?>
                        <li><a href="<?=base_url().'details/upload_resume'?>">Upload Resume</a></li>
                        <?php } ?>
                        <li><a href="<?=base_url().'login_user/logout';?>">Logout</a></li>
                    </ul>
                </li>
                <?php
                	} else {
                ?>
                <li><a href="<?=base_url().'login';?>">Login</a></li>
                <?php
                	}
                ?>

	        </ul>
	    </div>
	    <div class="clearfix"> </div>
	  </div>
	    <!--/.navbar-collapse-->
	</nav>
	<div class="banner_1">
		<div class="container">
			<div id="search_wrapper1">
		   		<div class="clearfix" id="search_form">
		    		<h1>Start your job search</h1>
		    		
		    			<form method="GET" action="<?=base_url().'search'?>">
				 			<input type="text" name="search" value="<?=set_value('search');?>" placeholder="Enter keywords to search..." class="text" required="true">
				 			<?=form_error('search')?>
				 		<label class="btn2 btn-2 btn2-1b"><input type="submit" value="Find Jobs"></label>
				 		</form>
           		</div>
			</div>
  		</div> 
	</div>	
<div class="col-lg-12" id="alert_parent">
	<?php
	    $this->load->view('common/alert');
	?>
</div>