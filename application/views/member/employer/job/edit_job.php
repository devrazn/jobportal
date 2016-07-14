<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="col-md-8 single_right">
    <div class="single">  
        <div class="form-container">
            <h2><?php echo $title;?></h2>
            <form role="form"  method="post" action="<?=base_url().'employer_profile/edit_job/'.$job['id']?>">
                <div class="form-group col-md-8">
                    <label class="col-md-3 control-lable">Title</label>
                    <div class="col-md-5">
                        <input type="text" name="title" class="form-control my-control"  placeholder=" Enter Title" value="<?= set_value('title', $job['title']) ?>"/>
                     <?= form_error('title') ?>
                    </div>
                </div>
                <div class="form-group col-md-8">
                    <label class="col-md-3 control-lable">Position</label>
                    <div class="col-md-5">
                       <input type="text" name="position" class="form-control my-control" placeholder="Enter Position" value="<?= set_value('position', $job['position']) ?>"/>
                     <?= form_error('position') ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group col-md-8">
                        <label class="col-md-3 control-lable">Openings</label>
                        <div class="col-md-5">
                           <input type="text" name="openings" class="form-control my-control" placeholder="Enter Openings" value="<?= set_value('openings',$job['openings']) ?>"/>
                         <?= form_error('openings', $job['openings']) ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group col-md-8">
                        <label class="col-md-3 control-lable">Location</label>
                        <div class="col-md-5">
                        <input type="text" name="location" class="form-control my-control" placeholder="Enter Location" value="<?= set_value('location',$job['location']) ?>"/>
                         <?= form_error('location', $job['location']) ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                	<div class="form-group col-md-8">
                		<label class="col-md-3 control-lable">Qualification</label>
                		<div class="col-md-5">
                           <input type="text" name="qualification" class="form-control my-control" placeholder="Enter Qualification" value="<?= set_value('qualification', $job['qualification']);?>"/>
                			<?php echo form_error('qualification');?>
                		</div>
                	</div>
                </div>
                <div class="form-group">
                	<div class="form-group col-md-8">
                		<label class="col-md-3 control-lable">Experience</label>
                		<div class="col-md-5">
                			<input type="text" name="experience" class="form-control my-control" placeholder="Enter Experience" value="<?=set_value('experience', $job['experience']) ?>"/>
                			<?php echo form_error('experience');?>
                		</div>
                	</div>
                </div>
                <div class="form-group">
                	<div class="form-group col-md-8">
                		<label class="col-md-3 control-lable">Salary</label>
                		<div class="col-md-5">
                			<input type="text" name="salary" class="form-control my-control" placeholder="Enter Salary" value="<?= set_value('salary', $job['salary']) ?>"/>
                			<?php echo form_error('salary');?>
                		</div>
                	</div>
                </div>

                <div class="form-group">
                	<div class="form-group col-md-8">
                	<label class="col-md-3 control-lable">Category</label>
                		<div class="col-md-5">
                		<select name="category_id" class="form-control my-control"  id="category">
                			<option value=""> Select Category</option>
                			<?php
                				foreach ($categories as $key => $value) {
                			?>
                				<option value="<?php echo $value["name"];?>" <?php if(isset($_POST['category_id']) && $_POST['category_id']==$value['name']) echo 'selected'; ?>><?php echo $value["name"];?></option>
                				<?php }
                			?>
                		</select>
                			<?php echo form_error('category_id');?>
                		</div>
                	</div>
                </div>
                <div class="form-group">
                    <div class="form-group col-md-8">
                        <label class="col-md-3 control-lable">Job Descriptions</label>
                        <div class="col-md-5">
                        	<textarea cols="39" rows="6" name="job_description"><?= set_value('job_description',$job['job_description']); ?> </textarea>  
                        <?= form_error('job_description') ?>
                        </div>
                    </div>
                </div>

        	    <div class="form-group">
        	        <div class="form-group col-md-8">
        	            <label class="col-md-3 control-lable">Requirements</label>
        	            <div class="col-md-5">
        	            <input type="tel" name="requirements" class="form-control my-control" placeholder="Enter Requirements" value="<?= set_value('requirements',$job['requirements']); ?>"/>
        	            <?= form_error('requirements') ?>
                        </div>
                    </div>
        	    </div>
                
                <div class="form-group">
                    <div class="form-group col-md-8">
                        <label class="col-md-3 control-lable">Facilities</label>
                        <div class="col-md-5">
                           <input type="text" name="facilities" class="form-control my-control" placeholder="Enter Facilities" value="<?= set_value('facilities',$job['facilities']) ?>"/>
                        <?= form_error('facilities') ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group col-md-8">
                        <label class="col-md-3 control-lable">Additional Info</label>
                        <div class="col-md-5">
                           <input type="text" name="additional_info" class="form-control my-control" placeholder="Enter Additional Info" value="<?= set_value('additional_info',$job['additional_info']) ?>"/>
                        <?= form_error('additional_info') ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group col-md-8">
                        <label class="col-md-3 control-lable">Deadline Date</label>
                        <div class="col-md-5">
                           <input type="text" name="deadline_date" id="datepicker" placeholder="Enter date in YYYY-MM-DD format" class="form-control my-control" value="<?= set_value('deadline_date',$job['deadline_date'])?>"/>
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
                <div class="form-group col-md-12">
                	<div class="form-actions floatRight">
                		<input type="submit" value="Add" class="btn btn-primary btn-sm">
                	</div>
                </div>
            </form>
        </div>
    </div>
</div>