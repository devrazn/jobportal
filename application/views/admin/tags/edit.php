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
            <form role="form" id="frm" method="post" action="<?=site_url(ADMIN_PATH.'/tags/edit/'.$info['id'])?>">
              <div class="form-group">
                <label>Name</label>
                <input name="name" type='text' class="form-control" placeholder="Enter Category Name" value="<?=set_value('name',$info['name']);?>">
                <?=form_error('name')?>
              </div>
              <div class="form-group">
                <label>Category</label>
                <select name="category_id" class="form-control">
                  <option value=""> Select Category</option>
                  <?php
                      foreach($category_info as $category)
                        {
                          ?>
                             <option value="<?=$category['id']?>" <?php if($category['id']==$info['category_id']) echo "selected";?>>
                                <?=$category['name']?>
                             </option>
                            <?php
                        }
                      ?>
                </select>
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
