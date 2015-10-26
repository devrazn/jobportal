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
            <form role="form" id="frm" method="post" action="<?=site_url(ADMIN_PATH.'/user/edit/'.$info['id'])?>">
                <div class="form-group">
                  <label>Email</label>
                  <input name="email" type='text' class="form-control" placeholder="Enter Email" value="<?=set_value('email',$info['email']);?>">
                  <?=form_error('email')?>
                </div>
           
                <div class="form-group">
                  <label>First Name</label>
                  <input name="f_name" type='text' class="form-control" placeholder="Enter First Name" value="<?=set_value('f_name',$info['f_name']);?>">
                  <?=form_error('f_name')?>
                </div>

                <div class="form-group">
                  <label>Last Name</label>
                  <input name="l_name" type='text' class="form-control" placeholder="Enter Last Name" value="<?=set_value('l_name',$info['l_name']);?>">
                  <?=form_error('l_name')?>
                </div>

                <div class="form-group">
                  <label>Address</label>
                  <input name="address" type='text' class="form-control" placeholder="Enter Address" value="<?=set_value('address',$info['address']);?>">
                  <?=form_error('address')?>
                </div>

                <div class="form-group">
                  <label>Established</label>
                  <input name="dob_estd" type='text' class="form-control" value="<?=set_value('dob_estd',$info['dob_estd']);?>">
                  <?=form_error('dob_estd')?>
                </div>

                <div class="form-group">
                  <label>Company Type</label>
                  <input name="company_type" type='text' class="form-control" placeholder="Enter Company Type" value="<?=set_value('company_type',$info['company_type']);?>">
                  <?=form_error('company_type')?>
                </div>

                <div class="form-group">
                  <label>Profile</label>
                  <input name="profile" type='text' class="form-control" placeholder="Enter Password" value="<?=set_value('profile',$info['profile']);?>">
                  <?=form_error('profile')?>
                </div>

                <div class="form-group">
                  <label>Benefits</label>
                  <input name="benefits" type='text' class="form-control" placeholder="Enter Benefits" value="<?=set_value('benefits',$info['benefits']);?>">
                  <?=form_error('benefits')?>
                </div>
            
                <div class="form-group">
                  <label>Status&nbsp;&nbsp;</label>
                  <label class="radio-inline">
                      <input type="radio" value="1" name="status" <?php if(set_value('status',$info['status'])==1){echo "checked";}?> >Active
                  </label>
                  <label class="radio-inline">
                      <input type="radio" value="0" name="status" <?php if(set_value('status',$info['status'])==0) {echo "checked";}?> >Inactive
                  </label>
                  <?=form_error('status')?>
              </div>
              <button class="btn btn-success" type="submit">Update</button>
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
