<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <?=$title?>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-lg-6">
            <form role="form" id="frm" method="post" action="<?=base_url().'admin/settings/change_password'?>">
              <div class="form-group">
                <label>Current Password</label>
                <input name="cPassword" type='password' class="form-control" placeholder="Enter Current Password">
                <?=form_error('cPassword')?>
              </div>

              <div class="form-group">
                <label>New Password</label>
                <input name="password" type='password' class="form-control" placeholder="Enter New Password">
                <?=form_error('password')?>
              </div>

              <div class="form-group">
                <label>Confirm Password</label>
                <input name="confirmPassword" type='password' class="form-control" placeholder="Re-type Your New Password">
                <?=form_error('confirmPassword')?>
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