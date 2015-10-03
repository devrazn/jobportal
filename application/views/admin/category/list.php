<div class="panel-heading">
  <a class="btn btn-primary" href="<?=base_url().'admin/category/add';?>">Add New</a>   
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <?=$title?>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
          <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Options</th>
                </tr>
              </thead>
              <tbody>
            <?php
              if(count($category_list)>0){
              foreach($category_list as $category){
            ?>
                <tr>
                  <td><?=$category['name']?></td>
                  <td>
               <?php 
       if($category['status']=='1')
      {
      ?>
            Active -> <a href="<?=site_url(ADMIN_PATH.'/category/change_status/1/'.$category['id'])?>">Deactivate</a>
            <?php
      }
      else if($category['status']=='0')
      {
        ?>
            Inactive -> <a href="<?=site_url(ADMIN_PATH.'/category/change_status/0/'.$category['id'])?>">Activate</a>
            <?php
      }
  ?>



            <?php //$category['status']?></td>
     
                  <td><a href="<?=site_url(ADMIN_PATH.'/category/edit/'.$category['id']) ?>" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-success"  data-original-title="Edit"><i class="fa fa-pencil"></i></a>
  
    <a href="<?=site_url(ADMIN_PATH.'/category/delete_category/'.$category['id']) ?>" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-warning"  data-original-title="Delete"><i onClick="return doConfirm()" class="fa fa-times"></i></a>         <?php
 }
 ?></td>    
          
                </tr>
        <?php
            
          }
      else
        {
          ?>
                        <tr>
                          <td colspan="5">
                            <center>
                              <font color="#FF0000">::No Records Yet.::</font>
                            </center>
                          </td>
                        </tr>
        <?php
          
        }
      ?>
        
		              </tbody>
     
            </table>
		</div>
        <!-- dataTable_wrapper -->
	</div>
    <!-- panel-body -->
</div>
<!-- panel panel-default -->
            </div>
            <!-- col-lg-12 -->
            </div>
            <!-- row -->
            

<script>
function doConfirm() {
  msg=confirm("Are you sure you want to delete this Permanently?");
  if(msg != true) {
    return false;
  }
}
</script>
