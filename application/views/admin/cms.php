<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <?=$title?>
      </div>
      <div class="panel-body">
        <div class="row">

            <form role="form" id="frm" method="post" name="frm" action="<?=site_url(ADMIN_PATH.'/settings/cms')?>">
              <?php if(validation_errors()) echo "<div class = 'error' style='color:red'><b>Please enter the required fields</b></div>"; ?>

              <div class="col-lg-6">
              <div class="form-group">
                <label>Select CMS Page</label>
                <select class="form-control" name="cms_page" onChange="doSubmitForm(this.form)">
                  <?php
                    foreach ($select_info as $select_key):
                  ?>
                    <option value="<?=$select_key['title']?>" <?php if($info['title']==$select_key['title']){echo "selected";}?>><?=$select_key['head_text']?></option>
                  <?php
                    endforeach;
                    ?>
                </select>
              </div>

              <div class="form-group">
                <label>Page Title</label>
                <input name="page_title" type='text' class="form-control" placeholder="Enter Heading for the Page" value="<?=set_value('page_title',$info['page_title']);?>">
                <?=form_error('page_title')?>
              </div>

              <div class="form-group">
                <label>Heading</label>
                <input name="head_text" type='text' class="form-control" placeholder="Enter Heading for the Page" value="<?=set_value('head_text',$info['head_text']);?>">
                <?=form_error('head_text')?>
              </div>

              <div class="form-group">
                <label>Meta Keywords</label>
                <textarea class="form-control" name="meta_keywords" rows="5"><?=set_value('meta_keywords',$info['meta_keywords']);?></textarea>
                <?=form_error('meta_keywords')?>
              </div>

              <div class="form-group">
                <label>Meta Description</label>
                <textarea class="form-control" name="meta_description" rows="5"><?=set_value('meta_description',$info['meta_description']);?></textarea>
                <?=form_error('meta_description')?>
              </div>

            </div> 
            <!-- col-lg-6 -->

            <div class='col-lg-6'>
              <div class="form-group">
                <label>Contents</label>
                <?php
                  if(isset($info['content'])) {
                    $value = stripslashes($info['content']);
                  } else {
                    $value = stripslashes($this->input->post('content'));
                  }
                  echo $this->ckeditor->editor('content',$value);
                ?>
                <?=form_error('content')?>
              </div>

              <div class="form-group">
                <label>Status&nbsp;&nbsp;</label>
                <label class="radio-inline">
                    <input type="radio" value="1" name="status" <?php if(set_value('status',$info['status'])=='1'){echo "checked";}?> >Active
                </label>
                <label class="radio-inline">
                    <input type="radio" value="0" name="status" <?php if(set_value('status',$info['status'])=='0') {echo "checked";}?> >Inactive
                </label>
                <?=form_error('status')?>
              </div>

              <button class="btn btn-success" type="submit">Submit</button>
              <button class="btn btn-warning" type="reset">Reset</button>

            </div>
          <!-- col-lg-6 -->

              
            </form>
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


<script type="text/javascript">
  function doSubmitForm(fm){
    document.location = "<?=site_url(ADMIN_PATH.'/settings/cms/')?>/" + fm.cms_page.value;
  }
</script>