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
                  <th>Parent Category</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
              <?php
                  if(count($categories)>0){
                  foreach($categories as $category){
                ?>
                <tr id="tr_<?php echo $category['id']; ?>"> 
                  <td><a href="<?=site_url(ADMIN_PATH.'/category/edit/'.$category['id'])?>"><?=$category['name']?></a></td>
                  <td><?php 
                        foreach($categories as $category2){
                          if($category2['id'] == $category['parent_id']){
                            echo $category2["name"];
                          }
                        }
                    ?></td>

                  <td>
                    <a class="btn btn-danger delete" data-id="<?php echo $category['id'];?>" data-toggle="tooltip" title="Delete"  data-original-title="Delete"><i class="fa fa-trash-o fa-lg"></i> Delete</a>
                  </td>
                </tr>
                      <?php
                          
                        }
                      } else {
                        ?>
                <tr>
                  <td colspan="3">
                    <center>
                      <font color="#FF0000">::No Categories Yet.::</font>
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


<script type="text/javascript">
$(document).ready(function() {
    $('#dataTables-example').dataTable({
      responsive: true,
      sPaginationType: "full_numbers",
      "columnDefs": [{
      "defaultContent": "-",
      "targets": "_all"
      }]
    });

    $('body').on('click', '.delete', function(e) {
      setDelete('admin/category/delete_category_ajax/','4',this,'Category');
    });

  });
</script>
