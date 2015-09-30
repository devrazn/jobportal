<script type="text/javascript">
$(document).ready(function()
{
        $("#frm").validate({
                            debug:false,
                            onBlur:true,
                            errorElement: "p",
                            errorClass:"err"
                                 });
});
</script>

<!-- Page Wrapper -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Job Category</h1>                         
            </div>

            <form id="frm" method="post" class="form-horizontal" action="<?=site_url(ADMIN_PATH.'/category/edit/'.$info['id'])?>">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-2"> Name</label>
                    <div class="col-lg-7">
                        <input name="name" type="text" class="form-control required" value="<?=set_value('name',$info['name']);?>">
                        <?=form_error('name')?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-2">Status</label>
                    <div class="col-lg-7">
                        <input name="status" type="radio" value="1" <?php if($info['status']=="1")  echo "checked"?> />Active
                        <input name="status" type="radio" value="0" <?php if($info['status']=="0")  echo "checked"?> />InActive
                    </div>
                </div>     
                <input type="hidden" name="id" value="<?=$info['id']?>" />                         
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-2"></label>
                    <div class="col-lg-7">          
                      <input type="submit" value="UPDATE" class="navigation_button btn btn-primary"/>
                    </div>          
                </div>
            </form>
        </div>
                <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->