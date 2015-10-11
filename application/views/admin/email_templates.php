<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <?=$title?>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-lg-6">
            <form role="form" id="frm" method="post" name="frm" action="<?=site_url(ADMIN_PATH.'/settings/email_templates')?>">
              <?php if(validation_errors()) echo "<div class = 'error' style='color:red'><b>Please enter the required fields</b></div>"; ?>

              <div class="form-group">
                <label>Select Template</label>
                <select class="form-control" name="temp_name" onChange="doSubmitForm(this.form)">
                  <option value="REGISTRATION" <?php if($info['template_code']=="REGISTRATION"){echo "selected";}?>>REGISTRATION</option>
                  <option value="FORGOT_PWD" <?php if($info['template_code']=="FORGOT_PWD"){echo "selected";}?>>FORGOT PASSWORD</option>
                  <option value="NEWSLETTER_SUBSCRIBED" <?php if($info['template_code']=="NEWSLETTER_SUBSCRIBED"){echo "selected";}?>>NEWSLETTER SUBSCRIBED</option>
                  <option value="NEWSLETTER_UNSUBSCRIBED" <?php if($info['template_code']=="NEWSLETTER_UNSUBSCRIBED"){echo "selected";}?>>NEWSLETTER UNSUBSCRIBED</option>
                </select>
              </div>

              <div class="form-group">
                <label>Subject</label>
                <input name="subject" type='text' class="form-control" placeholder="Enter Subject for the Email" value="<?=set_value('subject',$info['subject']);?>">
                <?=form_error('subject')?>
              </div>

              <div class="form-group">
                <label>Legends</label><br>
                  <small><strong>[USERNAME]</strong> = Member Username</small><br />
                  <small><strong>[EMAIL]</strong> = Email address</small><br />
                  <small><strong>[DATE]</strong> =  Date</small><br />
                  <small><strong>[SITENAME]</strong> = Name of the Site</small><br />
                  <small><strong>[LINK]</strong> = Link</small><br />
              </div>

              <div class="form-group">
                <label>Email Body</label>
                <?php
                  if(isset($info['content'])) {
                    $value = stripslashes($info['content']);
                  } else if($this->input->post('content')) {
                    $value = stripslashes($this->input->post('content'));
                  }
                  echo $this->ckeditor->editor('content',$value);
                ?>
                <?=form_error('content')?>
              </div>

              <button class="btn btn-success" type="submit">Submit</button>
              <button class="btn btn-warning" type="reset">Reset</button>
              
            </form>
          </div>
          <!-- col-lg-6 -->
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


<script type="text/javascript">
  function doSubmitForm(fm){
    document.location = "<?=site_url(ADMIN_PATH.'/settings/email_templates/')?>/" + fm.temp_name.value;
  }
</script>