<div class="col-md-8 single_right">
	 	   <div class="login-form-section">
                <div class="login-content">
                    <form role="form"  method="post" action="<?=base_url().'login_user/forgot_pass_validation'?>" enctype="multipart/form-data">
                        <div class="section-title">
                            <h3>Forgot Password</h3>
                        </div>
                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-user"></i></span>
                                <input type="text" name="email" class="form-control"  placeholder="Enter Email" value=""/>
                        		<?= form_error('email') ?>
                            </div>
                        </div>
						<div class="login-btn">
					   		<input type="submit" value="Submit">
						</div>
                    </form>
                </div>
         </div>
</div>

   
