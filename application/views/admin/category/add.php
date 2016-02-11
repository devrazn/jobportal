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
                <label>Parent Category</label><p style="color:blue">Select only if you want to create a subcategory</p>
                <select name = "parent_id" class="form-control">
                  <option>Select Parent Category</option>
                  <?php
                  $category = $this->helper_model->get_category();
                  $category_options = $this->helper_model->multilevel_select($category);
                  echo $category_options;
                ?>
                </select>
              </div>
              
              <div class="form-group">
                <label>Status&nbsp;&nbsp;</label>
                <label class="radio-inline">
                    <input type="radio" value="active" name="status" <?php if(set_value('status')=='active') echo "checked";?> >Active
                </label>
                <label class="radio-inline">
                    <input type="radio" value="inactive" name="status" <?php if(set_value('status')=='inactive') echo "checked";?> >Inactive
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
