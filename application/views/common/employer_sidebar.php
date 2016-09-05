<div class="col-md-3">
	<div class="col_3">
		<h3>Menu</h3>
		<ul class="list_2">
			<li><a href="<?=base_url().'employer_profile'?>">View My Profile</a></li>
			<li><a href="<?=base_url().'employer_profile/update_profile'?>">Update My Profile</a></li>
			<li><a href="<?=base_url().'employer_profile/change_password'?>">Change Password</a></li>
			<li><a href="<?=base_url().'employer_profile/post_job_view'?>">Post Job</a></li>
			<li><a href="<?=base_url().'employer_profile/job'?>">My Jobs</a></li>
			<li>
				<a href="<?=base_url().'employer_profile/notifications';?>">Jobs Applied Notifications
					<?php 
						$new_msg = $this->helper_model->count_jobs_applied();
						if($new_msg>0)
							echo "<b>(" . $new_msg . ")</b>";
					?>
				</a>
			</li>
		</ul>
	</div>
	<div class="col_3">
		<h3>Jobs You Have Posted</h3>
		<ul class="list_1">
			<?php
			$jobs = $this->helper_model->get_jobs_by_employer_id($this->session->userdata('user_id'));
			foreach($jobs as $job):
				?>
			<li><a href="<?=base_url().'employer_profile/edit_job/'.$job['id']?>"><?php echo $job["title"]; ?></a></li>
			<?php
			endforeach;
			?>
		</ul>
	</div>
</div>