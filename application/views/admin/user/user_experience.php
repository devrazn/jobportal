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
            <form role="form" id="frm" method="post" action="<?=site_url(ADMIN_PATH.'/experience/edit/'.$info['id'])?>">
                <div class="form-group">
                  <label>UserName</label>
                  <input name="user_id" type='text' class="form-control" readonly value="<?=set_value('user_id',$info['user_id']);?>">
                </div>
           
                <div class="form-group">
                  <label>Position</label>
                  <input name="position" type='text' class="form-control" readonly value="<?=set_value('position',$info['position']);?>">
                </div>

                <div class="form-group">
                  <label>Company Name</label>
                  <input name="company_name" type='text' class="form-control" readonly value="<?=set_value('company_name',$info['company_name']);?>">
                </div>

                <div class="form-group">
                  <label>Duration</label>
                  <input name="duration" type='text' class="form-control" readonly value="<?=set_value('duration',$info['duration']);?>">
                </div>

                <div class="form-group">
                  <label>Description</label>
                  <input name="description" type='text' class="form-control" readonly value="<?=set_value('description',$info['description']);?>">
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
