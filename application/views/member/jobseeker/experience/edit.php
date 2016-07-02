<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="col-md-8 single_right">
        <div class="single">  
           <div class="form-container">
            <h2><?php echo $title;?></h2>
            <form role="form" method="post" action="<?=base_url().'user_profile/edit_experience/'.$experience['id']?>">
            <?=validation_errors()?>
            <div class="form-group col-md-8">
                    <div class="form-group">
                        <label class="col-md-3 control-lable">Title</label>
                        <div class="col-md-5">
                            <input type="text" name="title" class="form-control my-control"  placeholder="Enter title for the experience" value="<?=set_value('title', $experience['title']);?>"/>
                        </div>
                        <?=form_error('title')?>
                    </div>
                </div>
                <div class="form-group col-md-8">
                    <div class="form-group">
                        <label class="col-md-3 control-lable">Postition / Designation</label>
                        <div class="col-md-5">
                            <input type="text" name="position" class="form-control my-control"  placeholder="Enter Your Position/Designation" value="<?=set_value('position', $experience['position']);?>"/>
                        </div>
                        <?=form_error('position')?>
                    </div>
                </div>
                <div class="form-group col-md-8">
                    <div class="form-group">
                        <label class="col-md-3 control-lable">Company Name</label>
                        <div class="col-md-5">
                            <input type="text" name="company_name" class="form-control my-control" placeholder="Enter Company Name" value="<?=set_value('company_name', $experience['company_name']);?>"/>
                        </div>
                        <?= form_error('company_name') ?>
                    </div>
                </div>
                <div class="form-group col-md-8">
                    <div class="form-group">
                        <label class="col-md-3 control-lable">Start Year</label>
                        <div class="col-md-5">
                            <select name="start_year" class="form-control my-control">
                                <option value="">Select Year</option>
                                <?php 
                                    for($i=date("Y"); $i>=1900; $i--):
                                ?>
                                <option value="<?=$i?>" <?php if(set_value('start_year', $experience['start_year']) == $i) echo "selected"; ?>><?=$i?></option>
                                <?php
                                    endfor;
                                ?>
                            </select>
                        </div>
                        <?= form_error('start_year') ?>
                    </div>
                </div>
                <div class="form-group col-md-8">
                    <div class="form-group">
                        <label class="col-md-3 control-lable">Duration</label>
                        <div class="col-md-5">
                            <input type="number" step="1" min="0" max="50" name="duration" class="form-control my-control" placeholder="Enter how long you worked in the company." value="<?=set_value('duration',$experience['duration']);?>"/>
                            <?= form_error('duration') ?>
                            <select name="duration_unit" class="form-control">
                                <option value="1" <?php  if(set_value('duration_unit', $experience['duration_unit'])==1){echo 'selected';}?>>Year</option>
                                <option value="2" <?php  if(set_value('duration_unit', $experience['duration_unit'])==2){echo 'selected';}?>>Month</option>
                            </select>
                        <?= form_error('duration_unit') ?>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-8">
                    <div class="form-group">
                        <label class="col-md-3 control-lable">Description</label>
                        <div class="col-md-5">
                            <textarea name="description" rows='5' class="form-control my-control" placeholder="Enter a short description about your experience there."><?=set_value('description', $experience['description']);?></textarea>
                        </div>
                        <?= form_error('duration_unit') ?>
                    </div>
                </div>

                <div class="form-group col-md-8">
                    <div class="form-actions floatRight">
                        <input type="submit" value="Update" class="btn btn-primary btn-sm">
                    </div>
                </div>
        </form>
        </div>
     </div>
</div>
                