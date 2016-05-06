<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="col-md-8 single_right">
    <div class="container">
        <div class="single">  
    	   <div class="form-container">
            <h2><?php echo $title;?></h2>
            <form role="form" method="post" action="<?=base_url().'user_profile/update_info/'.$user_detail['id']?>" enctype="multipart/form-data">
                <input type="hidden" name='id' value="<?php echo $user_detail['id'];?>">
    	        <input type="hidden" name='user_type' value="<?php echo $user_detail['user_type'];?>">
                <div class="form-group">
    	            <div class="form-group col-md-12">
    	                <label class="col-md-3 control-lable">Company/Organization Name</label>
    	                <div class="col-md-4">
    	                    <input type="text" name="f_name" class="form-control"  placeholder="Enter Full Name of the Company/Organization" value="<?=set_value('f_name',$user_detail['f_name']);?>"/>
    	                    <?= form_error('f_name') ?>
                        </div>
    	            </div>
    	        </div>
                <div class="form-group">
                    <div class="form-group col-md-12">
                        <label class="col-md-3 control-lable">Company/Organization Logo</label>
                        <div class="col-md-4">
                            <?php if($user_detail['image']!="") { ?>
                                <img src="<?=base_url()?>uploads/user/<?=$user_detail['image']?>" style="height:inherit;width:inherit;" />
                            <?php
                            }
                            ?>
                            <input type="file" name="image">
                            <input type="hidden" name="prev_image" value="<?=$user_detail['image']?>" />
                            <?= form_error('image') ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group col-md-12">
                        <label class="col-md-3 control-lable">Phone</label>
                        <div class="col-md-4">
                           <input type="text" name="phone" class="form-control input-sm" value="<?=set_value('phone',$user_detail['phone']);?>"/>
                        <?= form_error('phone') ?>
                        </div>
                    </div>
                </div>
        	    <div class="form-group">
                    <div class="form-group col-md-12">
                        <label class="col-md-3 control-lable">Established Year</label>
                        <div class="col-md-4">
                            <input type="text" name="dob_estd" id="datepicker" class="form-control input-sm" value="<?=set_value('dob_estd',$user_detail['dob_estd']);?>"/>
                        <?= form_error('dob_estd') ?>
                        </div>
                    </div>
                </div>
        	    <div class="form-group">
        	        <div class="form-group col-md-12">
        	            <label class="col-md-3 control-lable">Address</label>
        	            <div class="col-md-4">
                            <textarea cols="39" rows="6" name="address"><?=set_value('address',$user_detail['address']);?></textarea>
        	            <?= form_error('address') ?>
                        </div>
                    </div>
        	    </div>
                <div class="form-group">
                    <div class="form-group col-md-12">
                        <label class="col-md-3 control-lable">Website</label>
                        <div class="col-md-4">
                           <input type="text" name="website" class="form-control input-sm" value="<?=set_value('website',$user_detail['website']);?>"/>
                        <?= form_error('website') ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group col-md-12">
                        <label class="col-md-3 control-lable">Newsletter Subscription</label>
                        <div class="col-md-4">
                            <input type="hidden" name="newsletter_subscription" value="0" />
                            <input type="checkbox" name="newsletter_subscription" value="1" <?php if(set_value('newsletter_subscription',$user_detail['newsletter_subscription'])=='1'){echo "checked";}?> />
                            Would you like to receive our newsletter? 
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-actions floatRight">
                        <input type="submit" value="Update" class="btn btn-primary btn-sm">
                    </div>
                </div>
        </form>
        </div>
     </div>
    </div>
</div>
