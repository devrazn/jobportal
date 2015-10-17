<div class="panel-heading">
  <a class="btn btn-primary" href="<?=base_url().'admin/tags/add';?>">Add New</a>   
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
                  <th>Category</th>
                  <th>Status</th>
                  <th>Options</th>
                </tr>
              </thead>
              <tbody>
            <?php
              if(count($tags_list)>0){
              foreach($tags_list as $tags){
            ?>
                <tr>
                  <td><?=$tags['name']?></td>
                  <td><?=$this->category_model->category_name_by_id($tags['category_id'])?></td>
                <td>
               <?php 
       if($tags['status']=='1')
      {
      ?>
            Active :: <a href="<?=site_url(ADMIN_PATH.'/tags/change_status/1/'.$tags['id'])?>">Deactivate</a>
            <?php
      }
      else if($tags['status']=='0')
      {
        ?>
            Inactive :: <a href="<?=site_url(ADMIN_PATH.'/tags/change_status/0/'.$tags['id'])?>">Activate</a>
            <?php
      }
  ?>
        <td><a href="<?=site_url(ADMIN_PATH.'/tags/edit/'.$tags['id']) ?>" data-toggle="tooltip" title="Edit" class="btn btn-effect-ripple btn-xs btn-success"  data-original-title="Edit"><i class="fa fa-pencil"></i></a>
  
    <a href="<?=site_url(ADMIN_PATH.'/tags/delete_tags/'.$tags['id']) ?>" data-toggle="tooltip" title="Delete" class="btn btn-effect-ripple btn-xs btn-warning"  data-original-title="Delete"><i onClick="return doConfirm()" class="fa fa-times"></i></a>
    <?php
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
    $(document).ready(function() {
        $('#dataTables-example').dataTable({
                responsive: true,
                sPaginationType: "full_numbers"
        });
    });
    </script>
            

<script>
function doConfirm() {
  msg=confirm("Are you sure you want to delete this Permanently?");
  if(msg != true) {
    return false;
  }
}
</script>
