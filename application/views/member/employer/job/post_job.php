<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="col-md-8 single_right">
	<div class="container">
	    <div class="single">  
	        <div class="form-container">
	            <h2><?php echo $title;?></h2>
	            <form role="form"  method="post" action="<?=base_url().'employer_profile/post_job'?>">
	                <div class="form-group col-md-12">
	                    <label class="col-md-3 control-lable">Title</label>
	                    <div class="col-md-4">
	                        <input type="text" name="title" class="form-control"  placeholder=" Enter Title" value="<?= set_value('title') ?>"/>
	                     <?= form_error('title') ?>
	                    </div>
	                </div>
	                <div class="form-group col-md-12">
	                    <label class="col-md-3 control-lable">Position</label>
	                    <div class="col-md-4">
	                       <input type="text" name="position" class="form-control" placeholder="Enter Position" value="<?= set_value('position') ?>"/>
	                     <?= form_error('position') ?>
	                    </div>
	                </div>
	                <div class="form-group">
	                    <div class="form-group col-md-12">
	                        <label class="col-md-3 control-lable">Openings</label>
	                        <div class="col-md-4">
	                           <input type="text" name="openings" class="form-control" placeholder="Enter Openings" value="<?= set_value('openings') ?>"/>
	                         <?= form_error('openings') ?>
	                        </div>
	                    </div>
	                </div>
	                <div class="form-group">
	                    <div class="form-group col-md-12">
	                        <label class="col-md-3 control-lable">Location</label>
	                        <div class="col-md-4">
	                        <input type="text" name="location" class="form-control" placeholder="Enter Location" value="<?= set_value('location') ?>"/>
	                         <?= form_error('location') ?>
	                        </div>
	                    </div>
	                </div>
	                <div class="form-group">
	                	<div class="form-group col-md-12">
	                		<label class="col-md-3 control-lable">Qualification</label>
	                		<div class="col-md-4">
	                           <input type="text" name="qualification" class="form-control" placeholder="Enter Qualification" value="<?= set_value('qualification') ?>"/>
	                			<?php echo form_error('qualification');?>
	                		</div>
	                	</div>
	                </div>
	                <div class="form-group">
	                	<div class="form-group col-md-12">
	                		<label class="col-md-3 control-lable">Experience</label>
	                		<div class="col-md-4">
	                			<input type="text" name="experience" class="form-control" placeholder="Enter Experience" value="<?=set_value('experience') ?>"/>
	                			<?php echo form_error('experience');?>
	                		</div>
	                	</div>
	                </div>
	                <div class="form-group">
	                	<div class="form-group col-md-12">
	                		<label class="col-md-3 control-lable">Salary</label>
	                		<div class="col-md-4">
	                			<input type="text" name="salary" class="form-control" placeholder="Enter Salary" value="<?= set_value('salary') ?>"/>
	                			<?php echo form_error('salary');?>
	                		</div>
	                	</div>
	                </div>

	                <div class="form-group">
	                	<div class="form-group col-md-12">
	                	<label class="col-md-3 control-lable">Category</label>
	                		<div class="col-md-4">
	                		<select name="category_id" class="form-control"  id="category">
	                			<option value=""> Select Category</option>
	                			<?=$category_options = multilevel_select_job_category($categories, 0, array(), 0, set_value('category_id'));?>
	                		</select>
	                			<?php echo form_error('category_id');?>
	                		</div>
	                	</div>
	                </div>
	                <div class="form-group">
	                    <div class="form-group col-md-12">
	                        <label class="col-md-3 control-lable">Job Descriptions</label>
	                        <div class="col-md-4">
	                        	<textarea cols="39" rows="6" name="job_description"><?= set_value('job_description') ?> </textarea>  
	                        <?= form_error('job_description') ?>
	                        </div>
	                    </div>
	                </div>

	        	    <div class="form-group">
	        	        <div class="form-group col-md-12">
	        	            <label class="col-md-3 control-lable">Requirements</label>
	        	            <div class="col-md-4">
	        	            <input type="tel" name="requirements" class="form-control input-sm" placeholder="Enter Requirements" value="<?= set_value('requirements') ?>"/>
	        	            <?= form_error('requirements') ?>
	                        </div>
	                    </div>
	        	    </div>
	                
	                <div class="form-group">
	                    <div class="form-group col-md-12">
	                        <label class="col-md-3 control-lable">Facilities</label>
	                        <div class="col-md-4">
	                           <input type="text" name="facilities" class="form-control input-sm" placeholder="Enter Facilities" value="<?= set_value('facilities') ?>"/>
	                        <?= form_error('facilities') ?>
	                        </div>
	                    </div>
	                </div>
	                <div class="form-group">
	                    <div class="form-group col-md-12">
	                        <label class="col-md-3 control-lable">Additional Info</label>
	                        <div class="col-md-4">
	                           <input type="text" name="additional_info" class="form-control input-sm" placeholder="Enter Additional Info" value="<?= set_value('additional_info') ?>"/>
	                        <?= form_error('additional_info') ?>
	                        </div>
	                    </div>
	                </div>
	                <div class="form-group">
	                    <div class="form-group col-md-12">
	                        <label class="col-md-3 control-lable">Deadline Date</label>
	                        <div class="col-md-4">
	                           <input type="text" name="deadline_date" id="datepicker" placeholder="Enter date in YYYY-MM-DD format" class="form-control input-sm" value="<?= set_value('deadline_date')?>"/>
	                        <?= form_error('deadline_date') ?>
	                        </div>
	                    </div>
	                </div>
	                <div class="form-group">
	                	<div class="form-group col-md-12">
                            <?php $checkboxValues = explode(",", $temp_procedure);?>
                                <label class="col-md-3 control-lable">Application Procedure</label>
                                <div class="col-md-4">
	                                <label class="checkbox-inline">
	                                    <input type="checkbox" name="application_procedure[]" value="0" <?php if(in_array("0", $checkboxValues)) echo 'checked';?> >Apply in Writing
	                                </label>
	                                <label class="checkbox-inline">
	                                    <input type="checkbox" name="application_procedure[]" value="1" <?php if(in_array("1", $checkboxValues)) echo 'checked';?> >Apply via Company's Email
	                                </label>
	                                <label class="checkbox-inline">
	                                    <input type="checkbox" name="application_procedure[]" value="2" <?php if(in_array("2", $checkboxValues)) echo 'checked';?> >Apply via JobPortal
	                                </label>
	                            	<?= form_error('application_procedure') ?>
	                            </div>
	                    </div>
                    </div>
	                <div class="form-group">
	                    <div class="form-actions floatRight">
	                        <input type="submit" value="POST" class="btn btn-primary btn-sm">
	                    </div>
	                </div>
	            </form>
	        </div>
	    </div>
	</div>
</div>