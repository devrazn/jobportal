<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <?=$title?>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-lg-6">
            <form role="form" id="frm" method="post" action="<?=base_url().'admin/settings/email_settings'?>">
              <?php if(validation_errors()) echo "<p style='color:red'><b>Please enter the required fields correctly.</b></p>"; ?>
              <div class="form-group">
                  <label>Mail Type</label>
                  <input name="mailtype" type='text' class="form-control" placeholder="Enter Mail Type" value="<?=set_value('mailtype',$info['mailtype']);?>">
                  <?=form_error('mailtype')?>
                </div>

                <div class="form-group">
                  <label>Protocol</label>
                  <input name="protocol" type='text' class="form-control" placeholder="Enter Protocol" value="<?=set_value('protocol',$info['protocol'])?>">
                  <?=form_error('protocol')?>
                </div>

                <div class="form-group">
                  <label>SMTP Host</label>
                  <input name="smtp_host" type='text' class="form-control" placeholder="Enter SMTP Host" value="<?=set_value('smtp_host',$info['smtp_host'])?>">
                  <?=form_error('smtp_host')?>
                </div>

                <div class="form-group">
                  <label>SMTP Port</label>
                  <input name="smtp_port" type='text' class="form-control" placeholder="Enter SMTP Port" value="<?=set_value('smtp_port',$info['smtp_port'])?>">
                  <?=form_error('smtp_port')?>
                </div>

                <div class="form-group">
                  <label>SMTP Username</label>
                  <input name="smtp_user" type='text' id='smtp_user' class="form-control" placeholder="Enter SMTP Username" value="<?=set_value('smtp_user',$info['smtp_user'])?>">
                  <?=form_error('smtp_user')?>
                </div>

                <div class="form-group">
                  <label>Receive Emails At</label>
                  <input name="receive_email" type='text' class="form-control" placeholder="Enter email address to receive replies" value="<?=set_value('receive_email',$info['receive_email'])?>">
                  <?=form_error('receive_email')?>
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