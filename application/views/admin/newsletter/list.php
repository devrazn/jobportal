<script>
    $(document).on('click', '.delete', function(event){    
        if( ! confirm("Are you sure to perform this operation?"))
            return false;
        _this=$(this);
        var id = $(this).attr('data');
        
        jQuery.ajax({
            url: "<?=base_url().'admin/newsletter/delete_newsletter'; ?>/"+id,
            beforeSend: function(){_this.html("<img src='<?php echo base_url('images/ajax-loader.gif');?>' >")},
            success: function(data) {
               _this.closest('tr').remove();                  
            }
        });               
    });

    $(document).on('click', '.change_status', function(){
        _this=$(this);
        id=_this.attr("data");
        
        jQuery.ajax({
            url : "<?=base_url().'admin/newsletter/change_status'; ?>/"+id,
            beforeSend: function(){_this.html("<img src='<?php echo base_url('images/ajax-loader.gif');?>' >")},
            success: function(data) {
              if(data == 'Active') {
                _this.removeClass('btn-danger').addClass('btn-success');
              } else {
                _this.removeClass('btn-success').addClass('btn-danger');
              }
                _this.html(data);
        }
        });         
    });  
</script>

<div class="panel-heading">
    <a class="btn btn-primary" href="<?=base_url().'admin/newsletter/add';?>">Add New</a>   
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
                  <th>Subject</th>
                  <th>Send</th>
                  <th>Status</th>
                  <th>Options</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                    if(count($newsletter_list)>0){
                    foreach($newsletter_list as $newsletter){
                  ?>
                <tr>
                  <td><?=$newsletter['subject']?></td>
                  <td><a href="<?=site_url(ADMIN_PATH.'/newsletter/send_newsletter/'.$newsletter['id'])?>">
                    SEND
                    </a></td>
                  <td><i href="javascript:void(0)" data="<?php echo $newsletter['id'];?>" class="change_status btn <?php echo ($newsletter['status'])? 'btn-success' : 'btn-danger'?>"><?php echo ($newsletter['status'])? 'Active' : 'Inactive'?></i></td>
                  <td>
                    <a href="<?=site_url(ADMIN_PATH.'/newsletter/edit/'.$newsletter['id']) ?>" data-toggle="tooltip" title="Edit" class="btn btn-effect-ripple btn-xs btn-success"  data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                    <a href="<?=site_url(ADMIN_PATH.'/newsletter/delete_newsletter/'.$newsletter['id']) ?>" data-toggle="tooltip" title="Delete" class="btn btn-effect-ripple btn-xs btn-warning delete"  data-original-title="Delete"><i onClick="return doConfirm()" class="fa fa-times"></i></a>
                    <?php
                      }
                    ?>
                  </td>    
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