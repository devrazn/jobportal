<!DOCTYPE HTML>
<html>
<head>
<title>Seeking an Job Portal Category Flat Bootstarp Resposive Website Template | Home :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<link href="<?=base_url();?>assets/user/css/bootstrap-3.1.1.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="<?=base_url();?>assets/user/css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
<!--font-Awesome-->
<link href="<?=base_url();?>assets/user/css/font-awesome.css" rel="stylesheet"> 
<!--jQuery UI CSS for DatePicker-->
<link href="<?=base_url();?>assets/user/css/jquery-ui.css" rel="stylesheet">

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
	        <a class="navbar-brand" href="<?=base_url()?>"><img src="<?=base_url();?>uploads/admin/images/logo.png" alt=""/></a>
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
			            <?php
                            //$top_menu = $this->helper_model->bootstrap_menu($menu_items);
                             $menu_items = $this->helper_model->get_category();
                             $top_menu = $this->helper_model->bootstrap_menu_user($menu_items);
                             echo $top_menu;
                        ?>
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
		        <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Register<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=base_url().'register';?>">Register As JobSeeker</a></li>
                        <li><a href="<?=base_url().'register/register_employeer';?>">Register As Employer</a></li>
                    </ul>
                </li>
		        <li><a href="<?=base_url().'login'?>">Login</a></li>
		        <li><a href="resume.html">Upload Resume</a></li>
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
		    		<p>
				 		<input type="text" onblur="if (this.value == '') {this.value = 'Enter Keyword(s)';}" onfocus="this.value = '';" value="Enter Keyword(s)" placeholder=" " class="text">
				 		<input type="text" onblur="if (this.value == '') {this.value = 'Location';}" onfocus="this.value = '';" value="Location" placeholder=" " class="text">
				 		<label class="btn2 btn-2 btn2-1b"><input type="submit" value="Find Jobs"></label>
					</p>
           		</div>
			</div>
  		</div> 
	</div>	
<div class="col-lg-12">
	<?php
	    $this->load->view('common/alert');
	?>
</div>
