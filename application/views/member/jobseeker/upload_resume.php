<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="col-md-8 single_right">
   <div class="single">  
      <div class="form-container">
         <h2><?php echo $title;?></h2>
         <form  method="post" action="<?=base_url().'user_profile/upload_resume'?>" enctype="multipart/form-data">
            <div class="form-group col-md-12">
            <label class="col-md-3 control-lable"></label>
               <div class="col-md-4">
                  <input type="hidden" name="title" value="<?= set_value('title') ?>"/>
                  <?= form_error('title') ?>
               </div>
            </div>
            <div class="form-group col-md-12">
               <label class="col-md-3 control-lable">Upload Resume</label>
               <div class="col-md-4">
                  <input type="file" name="resume" value="<?= set_value('resume') ?>"/>
                  <?= form_error('resume') ?>
               </div>
            </div>
            <div class="form-group">
               <div class="form-actions floatRight">
                  <input type="submit" value="Post Your CV" class="btn btn-primary btn-sm">
               </div>
            </div>
         </form>
      </div>
   </div>
</div>