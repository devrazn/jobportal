<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
    $this->load->view('common/header');
?>

 <script type="text/javascript">
//     $(document).ready(function()
//         {
//             $("#frmRegister").validate({
//                 debug:false,
//                 onBlur:true,
//                 errorElement: "p",
//                 errorClass:"alert-warning"
                
//             });
//         });
 </script>

<div class="container">
    <div class="single">  
	   <div class="form-container">
        <h2>Register as Jobseeker</h2>
        <form role="form" id="frmRegister" method="post" action="<?=base_url().'register/add_user/1'?>" enctype="multipart/form-data">
	        <div class="form-group">
	            <div class="form-group col-md-12">
	                <label class="col-md-3 control-lable">First Name</label>
	                <div class="col-md-4">
	                    <input type="text" name="f_name" class="form-control"  placeholder="Enter First Name" value="<?= set_value('f_name') ?>"/>
	                 <?= form_error('f_name') ?>
                    </div>
	            </div>
	        </div>
            <div class="form-group">
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-lable">Last Name</label>
                    <div class="col-md-4">
                        <input type="text" name="l_name" class="form-control" placeholder="Enter Last Name" value="<?= set_value('l_name') ?>"/>
                     <?= form_error('l_name') ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
    	        <div class="form-group col-md-12">
    	            <label class="col-md-3 control-lable">Email</label>
    	            <div class="col-md-4">
    	               <input type="text" name="email" class="form-control" placeholder="Enter Email" value="<?= set_value('email') ?>"/>
    	             <?= form_error('email') ?>
                    </div>
    	        </div>
    	    </div>
    	    <div class="form-group">
    	        <div class="form-group col-md-12">
    	            <label class="col-md-3 control-lable">Password</label>
    	            <div class="col-md-4">
    	               <input type="password" name="password" id="reg_password" class="form-control" placeholder="Enter Password" value=""/>
    	             <?= form_error('password') ?>
                    </div>
    	        </div>
    	    </div>
    	    <div class="form-group">
    	        <div class="form-group col-md-12">
    	            <label class="col-md-3 control-lable">Confirm Password</label>
    	            <div class="col-md-4">
    	               <input type="password" name="cpassword" class="form-control" autocomplete="off" equalsTo="#reg_password"  placeholder="Retype your Password"/>
                     <?php echo form_error('cpassword');?>
                    </div>
    	        </div>
    	    </div>
    	    <div class="form-group">
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-lable">Gender</label>
                    <div class="col-md-4">
                        <label class="radio-inline">
                            <input type="radio" value="1" name="gender" <?php if(set_value('gender')=='1') echo "checked";?> >Male
                        </label>
                        <label class="radio-inline">
                            <input type="radio" value="0" name="gender" <?php if(set_value('gender')=='0') echo "checked";?> >Female
                        </label>
                        <?= form_error('gender') ?>
                    </div>
                </div>
            </div>
             
            </div>
    	    <div class="form-group">
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-lable">Date of birth</label>
                    <div class="col-md-4">
                        <input type="text" name="dob_estd" id="datepicker" placeholder="Enter date in YYYY-MM-DD format" class="form-control input-sm" value="<?= set_value('dob_estd')?>"/>
                    <?= form_error('dob_estd') ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-lable">Marital Status</label>
                        <div class="col-md-4">
                            <label class="radio-inline">
                                <input type="radio" value="1" name="marital_status" <?php if(set_value('marital_status')=='0') echo "checked";?>>Unmarried
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="0" name="marital_status" <?php if(set_value('marital_status')=='1') echo "checked";?>>Marrried
                            </label>
                        <?= form_error('marital_status') ?>
                        </div>
                </div>
            </div>
           
            <div class="form-group">
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-lable">Newsletter Subscription</label>
                    <div class="col-md-4">
                        <!-- <input type="hidden" name="newsletter_subscription" value="0" /> -->
                        <input type="checkbox" name="newsletter_subscription" value="1" <?php if ($this->input->post('newsletter_subscription') == 1) echo "checked"?>/>
                        Would you like to receive our newsletter? 
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-actions floatRight">
                    <input type="submit" value="Register" class="btn btn-primary btn-sm">
                </div>
            </div>
    </form>
    </div>
 </div>
</div>

<?php
    $this->load->view('common/footer');
?>