<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <?=$title?>
      </div>
      <!-- /.panel-heading -->

      <div class="panel-body">
        <div class="row">
          <div class="col-lg-6">
              <form role="form" method="post" action="<?=site_url(ADMIN_PATH.'/newsletter/send_newsletter/'.$info['id'])?>">
                <?php if(validation_errors()) echo "<div style='color:red'><b>Please enter the required fields correctly.</b></div>"; ?>
                
                <div class="form-group">
                  <label>Send To</label>
                  <div class="radio">
                      <label>
                          <input type="radio" name="receiver_options" id="single" value="1" <?php if(set_value('receiver_options')=='1') echo "checked";?>>Single:&nbsp; <input class='form-control' size='100' type="text" name="receiver" id="receiver_email" value="<?php if((set_value('receiver_options')=='single') && (set_value('receiver')!='')) echo set_value('receiver');?>" <?php if(form_error('receiver')) echo 'autofocus'?>>&nbsp;&nbsp; <?=form_error('receiver')?>
                      </label>
                  </div>
                  <div class="radio">
                      <label>
                          <input type="radio" name="receiver_options" id="optionsRadios2" value="2">All Subscribers
                      </label>
                  </div>
                  <div class="radio">
                      <label>
                          <input type="radio" name="receiver_options" id="optionsRadios3" value="3">All Subscribers registered as job seekers
                      </label>
                  </div>
                  <div class="radio">
                      <label>
                          <input type="radio" name="receiver_options" id="optionsRadios3" value="4">All Subscribers registered as employeers
                      </label>
                  </div>
                  <div class="radio">
                      <label>
                          <input type="radio" name="receiver_options" id="optionsRadios3" value="5">All verified users who are also subscribers
                      </label>
                  </div>
                  <div class="radio">
                      <label>
                          <input type="radio" name="receiver_options" id="optionsRadios3" value="6">All unverified users
                      </label>
                  </div>
                <?=form_error('receiver_options')?> 
                </div>
                    
                <div class="form-group">
                    <label>Subject</label>
                    <input name="subject" type="text" class="form-control" size="50" value="<?=set_value('subject',$info['subject']);?>">
                    <?=form_error('subject')?>
                </div>

                <div class="form-group">
                  <label>Content</label>
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
                           
                <div class="form-group">
                    <label>Send From</label>
                    <input name="sender" type="text" id='sender' class="form-control" size="50" placeholder="Enter sender email" value="<?=set_value('sender', $mail_settings['smtp_user']);?>">
                    <?=form_error('sender')?>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input name="password" type="password" id='password' class="form-control" size="50" placeholder="Enter password for <?=set_value('sender', $mail_settings['smtp_user']);?>">
                    <?=form_error('password')?>
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
  $("input:radio[name=receiver_options]:first-child").click(function(){
    if($(this).val()==1){
      $("#receiver_email").slideDown().focus();
      
    }else{
      $("#receiver_email").slideUp();
    }
  });

  $("#receiver_email").click(function(){
    $("#single").prop("checked", true);
  });

  $('#sender').on('input', function() {
    $("#password").attr("placeholder", "Enter password for " + $('#sender').val());
  });
</script>
