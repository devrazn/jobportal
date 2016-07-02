<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="col-md-8 single_right">
    <div class="single">
        <div class="form-container">
            <h2><?php echo $title?></h2>
            <form role="form"  method="post" action="<?=base_url().'user_profile/add_qualification'?>" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="form-group col-md-12">
                        <label class="col-md-3 control-lable">Degree</label>
                        <div class="col-md-4">
                            <input type="text" name="degree" class="form-control my-control"  placeholder="Enter Degree" value="<?= set_value('degree') ?>"/>
                            <?= form_error('degree') ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group col-md-12">
                        <label class="col-md-3 control-lable">Institution</label>
                        <div class="col-md-4">
                            <input type="text" name="institution" class="form-control my-control" placeholder="Enter Institution" value="<?= set_value('institution') ?>"/>
                            <?= form_error('institution') ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group col-md-12">
                        <label class="col-md-3 control-lable">Completion Date</label>
                        <div class="col-md-4">
                            <select name="completion_date" class="form-control my-control">
                                <option value="">Select Year</option>
                                <?php 
                                for($i=date("Y"); $i>=1900; $i--):
                                    ?>
                                <option value="<?=$i?>" <?php if(set_value('dob_estd')==$i) echo "selected"; ?>><?=$i?></option>
                                <?php
                                endfor;
                                ?>
                            </select>
                            <?= form_error('completion_date') ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group col-md-12">
                        <label class="col-md-3 control-lable">GPA/Percentage</label>
                        <div class="col-md-4">
                            <input type="text" name="gpa_pct" class="form-control my-control" placeholder="Enter GPA/Percentage" value="<?= set_value('gpa_pct') ?>"/>
                            <?= form_error('gpa_pct') ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group col-md-12">
                        <label class="col-md-3 control-lable">Remarks</label>
                        <div class="col-md-4">
                            <textarea cols="47" rows="6" name="remarks"><?=set_value('remarks');?></textarea>
                            <?= form_error('remarks') ?>
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
