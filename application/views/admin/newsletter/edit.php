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
            <form role="form" id="frm" method="post" action="<?=site_url(ADMIN_PATH.'/newsletter/edit/'.$info['id'])?>">
              <div class="form-group">
                <label>Subject</label>
                <input name="subject" type='text' class="form-control" placeholder="Enter Subject" value="<?=set_value('subject',$info['subject']);?>">
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
