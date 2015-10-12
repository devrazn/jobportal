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
            <form role="form" id="frm" method="post" action="<?=site_url(ADMIN_PATH.'/category/edit/'.$info['id'])?>">
              <div class="form-group">
                <label>Name</label>
                <input name="name" type='text' class="form-control" placeholder="Enter Category Name" value="<?=set_value('name',$info['name']);?>">
                <?=form_error('name')?>
              </div>
              
              <div class="form-group">
                <label>Status&nbsp;&nbsp;</label>
                <label class="radio-inline">
                    <input type="radio" value="active" name="status" <?php if(set_value('status',$info['status'])=='active'){echo "checked";}?> >Active
                </label>
                <label class="radio-inline">
                    <input type="radio" value="inactive" name="status" <?php if(set_value('status',$info['status'])=='inactive') {echo "checked";}?> >Inactive
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
