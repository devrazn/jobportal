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

            <?php //echo $this->table->generate(); ?>

            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr>
                  <!-- <th>Id</th> -->
                  <th>Name</th>
                  <th>Parent Category</th>
                  <th>Status</th>
                  <th>Delete</th>
                  <!-- <th>Options</th> -->
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
                    <td><i id="cell_<?php echo $category['id']; ?>" href="javascript:void(0)" dataId="<?php echo $category['id'];?>" dataStatus="<?php echo $category['status'];?>" class="change_status btn <?php echo ($category['status'])? 'btn-success' : 'btn-danger'?>"><?php echo ($category['status'])? 'Active' : 'Inactive'?></i></a></td>
                  <td>
                    <a class="btn btn-danger delete" data="<?php echo $category['id'];?>" data-toggle="tooltip" title="Delete"  data-original-title="Delete"><i class="fa fa-trash-o fa-lg"></i> Delete</a>
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

    $(document).on('click', '.delete', function(event){    
      if( ! confirm("Are you sure to delete this product?")){
        return false;
      } else {
        _this=$(this);
        var id = _this.attr('data');
        _this_tr_html = _this.closest('tr').html();
  
        jQuery.ajax({
          url: "<?=base_url().'admin/category/delete_category_ajax/'; ?>" + id,
          dataType: 'json',
          beforeSend: function(){
            _this.closest('tr').html("<td colspan='4' align='center'><img src='<?php echo base_url('assets/ajax/images/ajax-loader_dark.gif');?>' ></td>");
          },
          success: function(data) {
            if(data['response']) {
              $('#tr_'+id).remove();
              var responseHTML = "<div role='alert' class='alert alert-success fade in' id='alert'>" + 
                                "<button aria-label='Close' data-dismiss='alert' class='close' type='button'>" + 
                                "<span aria-hidden='true'>×</span>" +
                                "</button>" + 
                                "Category Deleted Successfully" + 
                                "</div>";
              $('.alert').remove();
              $("#alert_parent").append(responseHTML);
              $('html, body').animate({
                  scrollTop: $("body").offset().top
              }, 1000);
            } else {
              $('#tr_'+id).html(_this_tr_html);
              var responseHTML = "<div role='alert' class='alert alert-danger fade in' id='alert'>" + 
                            "<button aria-label='Close' data-dismiss='alert' class='close' type='button'>" + 
                            "<span aria-hidden='true'>×</span>" +
                            "</button>" + 
                            data["msg"] + 
                            "</div>";
              $('.alert').remove();
              $("#alert_parent").append(responseHTML);
              $('html, body').animate({
                  scrollTop: $("body").offset().top
              }, 1000);
            }
          }
        });
      }              
    });

    $(document).on('click', '.change_status', function(){
      _this=$(this);
      var id = _this.attr('dataId');
      var status = _this.attr('dataStatus');
      _this_tr_html = _this.closest('tr').html();
      cell_id=_this.attr('id');
      
      jQuery.ajax({
        url : "<?=base_url().'admin/category/change_status_ajax'; ?>/" + status + "/" + id,
        beforeSend: function(){
          _this.closest('tr').html("<td colspan='4' align='center'><img src='<?php echo base_url('assets/ajax/images/ajax-loader_dark.gif');?>' ></td>");
        },
        success: function(data) {
          $('#tr_'+id).html(_this_tr_html);
          if(status == '1') {
            $('#' + cell_id).attr("dataStatus", '0');
            $('#' + cell_id).removeClass('btn-success').addClass('btn-danger');
            $('#' + cell_id).html("Inactive");
          } else {
            $('#' + cell_id).attr("dataStatus", '1');
            $('#' + cell_id).removeClass('btn-danger').addClass('btn-success');
            $('#' + cell_id).html("Active");
          }
        }
      });         
    });

  });
</script>
