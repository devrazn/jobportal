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
        <h2>Register Form</h2>
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
    	               <input type="password" name="cpassword" class="form-control" autocomplete="off" equalTo="#reg_password"  placeholder="Retype your Password"/>
                     <?php echo form_error('cpassword');?>
                    </div>
    	        </div>
    	    </div>
    	    <div class="form-group">
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-lable">Gender</label>
                        <div class="col-md-4">
                            <label class="radio-inline">
                                <input type="radio" value="M" name="gender" <?php if(set_value('gender')==1) echo "checked";?> >Male
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="F" name="gender" <?php if(set_value('gender')==0) echo "checked";?> >Female
                            </label>
                            <?= form_error('gender') ?>
                        </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-lable">Image</label>
                    <div class="col-md-4">
                       <input type="file" name="image" value="<?= set_value('image') ?>" accept="gif|GIF|png|PNG|jpg|JPG|jpeg|JPEG">
                    <?= form_error('image') ?>
                    </div>
                </div>
            </div>
             <div class="form-group">
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-lable">Phone</label>
                    <div class="col-md-4">
                       <input type="text" name="phone" class="form-control input-sm" value="<?= set_value('phone') ?>"/>
                    <?= form_error('phone') ?>
                    </div>
                </div>
            </div>
    	    <div class="form-group">
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-lable">Date of birth</label>
                    <div class="col-md-4">
                        <input type="text" name="dob_estd" id="datepicker" class="form-control input-sm" value="<?= set_value('dob_estd')?>"/>
                    <?= form_error('dob_estd') ?>
                    </div>
                </div>
            </div>
    	    <div class="form-group">
    	        <div class="form-group col-md-12">
    	            <label class="col-md-3 control-lable">Address</label>
    	            <div class="col-md-4">
                        <textarea cols="39" rows="6" name="address" value="<?= set_value('address') ?>"> </textarea>
    	            <?= form_error('address') ?>
                    </div>
                </div>
    	    </div>


            <!-- <div class="form-group">
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-lable">Company Type</label>
                    <div class="col-md-4">
                        <select name="company_type" class="form-control">
                            <option value="">Select</option>
                            <option value="Test" <?php echo set_select('company_type', 'Test'); ?>>Test</option>
                            <option value="Test1" <?php echo set_select('company_type', 'Test1'); ?>>Test1</option>
                        </select>
                        <?= form_error('company_type') ?>
                    </div>
            </div> -->
            <!-- <div class="form-group">
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-lable">Profile</label>
                    <div class="col-md-4">
                        <textarea cols="39" rows="6" name="profile" value="<?= set_value('profile') ?>"> </textarea>
                    <?= form_error('profile') ?>
                    </div>
                </div>
            </div> -->
            <!-- <div class="form-group">
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-lable">Benefits</label>
                    <div class="col-md-4">
                        <textarea cols="39" rows="6" name="benefits" value="<?= set_value('benefits') ?>"> </textarea>
                    <?= form_error('benefits') ?>
                    </div>
                </div>
            </div> -->
            <!-- <div class="form-group">
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-lable">Website</label>
                    <div class="col-md-4">
                       <input type="text" name="website" class="form-control input-sm" value="<?= set_value('website') ?>"/>
                    <?= form_error('website') ?>
                    </div>
                </div>
            </div> -->
            <div class="form-group">
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-lable">Marital Status</label>
                        <div class="col-md-4">
                            <label class="radio-inline">
                                <input type="radio" value="S" name="marital_status" <?php if(set_value('marital_status')==1) echo "checked";?>>Single
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="M" name="marital_status" <?php if(set_value('marital_status')==0) echo "checked";?>>Marrried
                            </label>
                        <?= form_error('marital_status') ?>
                        </div>
                </div>
            </div>
           <!--  <div class="form-group">
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-lable">User Type</label>
                    <div class="col-md-4">
                        <select name="user_type" class="form-control">
                            <option value="">Select</option>
                            <option value="Job Seeker" <?php echo set_select('user_type', 'Job Seeker'); ?>>Job Seeker</option> 
                            <option value="Employer" <?php echo set_select('user_type', 'Employer'); ?>>Employer</option>  
                        </select>
                        <?= form_error('user_type') ?>
                    </div>
            </div> -->
            <div class="form-group">
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-lable">Newsletter Subscription</label>
                    <div class="col-md-4">
                        <input type="hidden" name="newsletter_subscription" value="0" />
                        <input type="checkbox" name="newsletter_subscription" value="1" <?php if ($this->input->post('newsletter_subscription') == 1) echo "checked"?>/>
                        Would you like to receive our newsletter? 
                    </div>
                </div>
            </div>

            <!-- <div class="form-group">
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-lable">Status</label>
                        <div class="col-md-4">
                            <label class="radio-inline">
                                <input type="radio" value="1" name="status" <?php if(set_value('status')==1) echo "checked";?> >Active
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="0" name="status" <?php if(set_value('status')==0) echo "checked";?> >Inactive
                            </label>
                            <?= form_error('status') ?>
                        </div>
                </div>
            </div> -->
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