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
            <form role="form" id="frm" method="post" action="<?=base_url().'admin/category/add'?>">
              <div class="form-group">
                <label>Name</label>
                <input name="name" type='text' class="form-control" placeholder="Enter Category Name" value="<?=set_value('name');?>">
                <?=form_error('name')?>
              </div>
              
              <div class="form-group">
                <label>Status&nbsp;&nbsp;</label>
                <label class="radio-inline">
                    <input type="radio" value="1" name="status" <?php if(set_value('status')==1) echo "checked";?> >Active
                </label>
                <label class="radio-inline">
                    <input type="radio" value="0" name="status" <?php if(set_value('status')==0) echo "checked";?> >Inactive
                </label>
                <?=form_error('status')?>
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
