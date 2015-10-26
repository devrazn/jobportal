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
            <form role="form" id="frm" method="post" action="<?=site_url(ADMIN_PATH.'/qualification/edit/'.$info['id'])?>">
                <div class="form-group">
                  <label>User Name</label>
                  <input name="user_id" type='text' class="form-control" readonly value="<?=set_value('user_id',$info['user_id']);?>">
                </div>
           
                <div class="form-group">
                  <label>Degree</label>
                  <input name="degree" type='text' class="form-control" readonly value="<?=set_value('degree',$info['degree']);?>">
                </div>

                <div class="form-group">
                  <label>Institution</label>
                  <input name="institution" type='text' class="form-control" readonly value="<?=set_value('institution',$info['institution']);?>">
                </div>

                <div class="form-group">
                  <label>Completion Date</label>
                  <input name="completion_date" type='text' class="form-control" readonly value="<?=set_value('completion_date',$info['completion_date']);?>">
                </div>

                <div class="form-group">
                  <label>GPA</label>
                  <input name="gpa" type='text' class="form-control" readonly value="<?=set_value('gpa',$info['gpa']);?>">
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
