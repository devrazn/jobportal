<div class="col-md-8 single_right">
	 	   <div class="login-form-section">
                <div class="login-content">
                    <form role="form"  method="post" action="<?=base_url().'login_user/login_process'?>" enctype="multipart/form-data">
                        <div class="section-title">
                            <h3>LogIn to your Account</h3>
                        </div>
                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-user"></i></span>
                                <input type="text" name="email" id="email" class="form-control"  placeholder="Enter Email" value="<?php if(set_value('email')) echo set_value('email'); else if(isset($_COOKIE['user_email'])) echo $_COOKIE['user_email']; ?>"/>
                        		<?= form_error('email') ?>
                            </div>
                        </div>
                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-key"></i></span>
                                <input type="password" name="password" class="form-control"  placeholder="Enter Password" value="<?php if(isset($_COOKIE['user_pw'])) echo $_COOKIE['user_pw']; ?>"/>
                        		<?= form_error('password') ?>
                            </div>
                        </div>
                    	<div class="forgot">
						 	<div class="login-check">
				 				<label class="checkbox1"><input type="checkbox" name="remember_me" checked=""><i> </i>Remember Me</label>
				         	</div>
				 		  	<div class="login-para">
				 				<p><a href="<?=base_url();?>login_user/forgot_pass"> Forgot Password? </a></p>
				 		 	</div>
					     	<div class="clearfix"> </div>
			        	</div>
						<div class="login-btn">
					   		<input type="submit" value="Log in">
						</div>
                    </form>
					<div class="login-bottom">
					 <p>With your social media account</p>
					 <div class="social-icons">
						<div class="button">
						<?php
								$fb = new Facebook\Facebook([
								'app_id' => '535759006585393', 
								'app_secret' => '7b747f50721cd007c6b802f54d16793c',
								'default_graph_version' => 'v2.2',
								]);
								$helper = $fb->getRedirectLoginHelper();
								$loginUrl = $helper->getLoginUrl('http://www.jobportal.com/api_login/fb_callback');
						?>		
							<a class="tw" href="<?=base_url().'api_login/twitter';?>" target=""> <i class="fa fa-twitter tw2"> </i><span>Twitter</span>
							<div class="clearfix"> </div></a>
							<a class="fa" href="<?= $loginUrl;?>"> <i class="fa fa-facebook tw2"> </i><span>Facebook</span>
							<div class="clearfix"> </div></a>
							<a class="go" href="<?=base_url().'api_login/gmail';?>" target=""><i class="fa fa-google-plus tw2"> </i><span>Google+</span>
							<div class="clearfix"> </div></a>
							<div class="clearfix"> </div>
						</div>
						<h4>Don,t have an Account? <a href="<?=base_url().'register';?>"> Register Now!</a></h4>
					 </div>
		           </div>
                </div>
         </div>
</div>

   
