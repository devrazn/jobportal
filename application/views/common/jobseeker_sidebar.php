<div class="col-md-4">
	<div class="col_3">
	   	  	<h3>Menu</h3>
	   	  	<ul class="list_2">
	   	  		<li><a href="<?=base_url().'user_profile'?>">Update My Profile</a></li>
	   	  		<li><a href="<?=base_url().'user_profile/change_password'?>">Change Password</a></li>
	   	  		<li><a href="<?=base_url().'user_profile/upload_resume'?>">Upload Resume</a></li>
	   	  		<li><a href="<?=base_url().'user_profile/experience'?>">Manage My Experiences</a></li>
	   	  		<li><a href="<?=base_url().'user_profile/qualification'?>">Manage My Qualifications</a></li>
	   	  		<li><a href="<?=base_url().'user_profile/notifications'?>">Notifications</a></li>
	   	  	</ul>
	   	  </div>
	   	  <div class="col_3">
	   	  	<h3>Jobs You Have Applied Jobs</h3>
	   	  	<ul class="list_1">
	   	  	<?php
	   	  		$applied_jobs = $this->helper_model->get_applied_jobs($this->session->userdata('user_id'));
	   	  		foreach($applied_jobs as $job):
	   	  	?>
	   	  		<li><a href="<?=base_url().'jobs/'.$job['job_id']?>"><?php echo $job["title"]; ?></a></li>
	   	  		<?php
	   	  			endforeach;
	   	  		?>
	   	  	</ul>
	   	  </div>
	 </div>