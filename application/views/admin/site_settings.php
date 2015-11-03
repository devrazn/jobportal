<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <?=$title?>
      </div>
      <div class="panel-body">
        <div class="row">
          <form role="form" id="frm" method="post" enctype="multipart/form-data" action="<?=site_url(ADMIN_PATH.'/settings/site_settings/')?>">
            <div class='col-lg-12'>
              <?php if(validation_errors()) echo "<p style='color:red'><b>Please enter the required fields correctly.</b></p>"; ?>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Site Name</label>
                <input name="site_name" type='text' class="form-control" placeholder="Enter Site Name" value="<?=set_value('site_name',$info['site_name']);?>">
                <?=form_error('site_name')?>
              </div>

              <div class="form-group">
                <label>Site Title</label>
                <input name="site_title" type='text' class="form-control" placeholder="Enter Site Title" value="<?=set_value('site_title',$info['site_title']);?>">
                <?=form_error('site_title')?>
              </div>
              
              <div class="form-group">
                <label>Site Slogan</label>
                <input name="site_slogan" type='text' class="form-control" placeholder="Enter Site Slogan" value="<?=set_value('site_slogan',$info['site_slogan']);?>">
                <?=form_error('site_slogan')?>
              </div>

              <div class="form-group">
                <label>Site Email</label>
                <input name="site_email" type='text' class="form-control" placeholder="Enter Site Email" value="<?=set_value('site_email',$info['site_email']);?>">
                <?=form_error('sit_email')?>
              </div>

              <div class="form-group">
                <label>Facebook Link</label>
                <input name="facebook" type='text' class="form-control" placeholder="Enter Site's Facebook Link" value="<?=set_value('facebook',$info['facebook']);?>">
                <?=form_error('facebook')?>
              </div>

              <div class="form-group">
                <label>Twitter Link </label>
                <input name="twitter" type='text' class="form-control" placeholder="Enter Site's Twitter Link" value="<?=set_value('twitter',$info['twitter']);?>">
                <?=form_error('twitter')?>
              </div>

              <div class="form-group">
                <label>Youtube Link </label>
                <input name="youtube" type='text' class="form-control" placeholder="Enter Site's Youtube Link" value="<?=set_value('youtube',$info['youtube']);?>">
                <?=form_error('youtube')?>
              </div> 

              <div class="form-group">
                <label>Site Logo</label>
                <?php if($info['logo']!="") { ?>
                  <div class='controls'>
                    <img class="" src="<?=base_url()?>uploads/admin/images/<?=$info['logo']?>">
                  </div>
                <?php } ?>
                <input name="logo" type='file' class="">
                <?=form_error('logo')?>
                <input type="hidden" name="prev_image" value="<?=$info['logo']?>" />
              </div>

              <div class="form-group">
                <label>Meta Keywords</label>
                <textarea class="form-control" name="meta_keywords" rows="5"><?=set_value('meta_keywords',$info['meta_keywords']);?></textarea>
                <?=form_error('meta_keywords')?>
              </div>
            </div>

            <div class='col-lg-6'>
              <div class="form-group">
                <label>Meta Description</label>
                <textarea class="form-control" name="meta_description" rows="5"><?=set_value('meta_description',$info['meta_description']);?></textarea>
                <?=form_error('meta_description')?>
              </div>

              <div class="form-group">
                <label>Authors </label>
                <input name="site_authors" type='text' class="form-control" placeholder="Enter Site's Site Authors" value="<?=set_value('site_authors',$info['site_authors']);?>">
                <?=form_error('site_authors')?>
              </div>

              <div class="form-group">
                <label>Site Offline Message </label>
                <?php
                  if(isset($info['site_offline_msg'])) {
                    $value = stripslashes($info['site_offline_msg']);
                  } else if($this->input->post('site_offline_msg')) {
                    $value = stripslashes($this->input->post('site_offline_msg'));
                  }
                  echo $this->ckeditor->editor('site_offline_msg',$value);
                ?>
                <?=form_error('site_offline_msg')?>
              </div>              

              <div class="form-group">
                <label>Site Status&nbsp;&nbsp;</label>
                <label class="radio-inline">
                    <input type="radio" value="1" name="site_status" <?php if(set_value('site_status',$info['site_status'])==1){echo "checked";}?> >Online
                </label>
                <label class="radio-inline">
                    <input type="radio" value="0" name="site_status" <?php if(set_value('site_status',$info['site_status'])==0) {echo "checked";}?> >Offline
                </label>
                <?=form_error('site_status')?>
              </div>
            </div>
            <!-- /.col-lg-6 -->
          </div>
          <!-- /.col-lg-12 -->

          <legend>&nbsp;</legend>
            <div class='pull-right col-lg-12'>
              <div class='pull-right'>
                <button class="btn btn-success" type="submit">Submit</button>
                <button class="btn btn-warning" type="reset">Reset</button>
              </div>
            </div>

          </form>
        </div>
        <!-- row -->
      </div>
      <!-- panel-body -->
    </div>
    <!-- panel panel-default -->
  </div>
  <!-- col-lg-12 -->
</div>
<!-- row -->