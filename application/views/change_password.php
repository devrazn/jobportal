<div class="col-md-8 single_right">
	 	   <div class="login-form-section">
                <div class="login-content">
                    <form role="form"  method="post" action="<?=base_url().'user_profile/change_password'?>" enctype="multipart/form-data">
                        <div class="section-title">
                            <h3>Change Password</h3>
                        </div>
                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-key"></i></span>
                                <input type="password" name="cur_password" class="form-control"  placeholder="Enter Current Password" value=""/>
                                <?= form_error('cur_password') ?>
                            </div>
                        </div>
                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-key"></i></span>
                                <input type="password" name="new_password" id="password1" class="form-control"  placeholder="Enter New Password" value=""/>
                        		<?= form_error('new_password') ?>
                            </div>
                        </div>
                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-key"></i></span>
                                <input type="password" name="c_password" class="form-control" equalsTo="#password1" placeholder="Confirm Password" value=""/>
                        		<?= form_error('c_password') ?>
                            </div>
                        </div>
						<div class="login-btn">
					   		<input type="submit" value="Submit">
						</div>
                    </form>
                </div>
         </div>
</div>

   
