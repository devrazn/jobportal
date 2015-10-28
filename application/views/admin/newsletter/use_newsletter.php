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
              <form role="form" method="post" action="<?=site_url(ADMIN_PATH.'/newsletter/send_newsletter/'.$info['id'])?>">
                
                <div class="form-group">
                  <label>Send To</label>
                  <input name="" type="text" class="form-control required" size="50" value="<?=$info['title']?>">
                      <?=form_error('title')?> 
                </div>
                    
                <div class="form-group">
                    <label>Heading</label>
                    <input name="title" type="text" class="form-control required" size="50" value="<?=$info['title']?>">
                      <?=form_error('title')?>
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
                    <label>Send From</label>
                      <input name="sender" type="text" class="form-control required" size="50" value="jobportal@gmail.com">
                      <?=form_error('sender')?>
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
