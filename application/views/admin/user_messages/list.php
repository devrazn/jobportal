<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <?php 
          echo $title;
          $new_msg_count = $this->helper_model->count_admin_new_messages();
          if($new_msg_count>0)
            echo " (" . $new_msg_count . ")";
          ?>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
          <div class="dataTable_wrapper">
            <table class="table table-striped table-hover" id="message-dataTables">
              <thead>
                <tr>
                  <th>Subject</th>
                  <th>Name</th>
                  <th>From</th>
                  <th>Received On</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(count($messages)>0){
                  foreach($messages as $message){
                ?>
                <tr <?php if($message['read_flag']==0) echo "style='font-weight:bold'"?> > 
                  <td><a href="<?=site_url(ADMIN_PATH.'/messages/details/'.$message['id'])?>"><?=$message['subject']?></a></td>
                  <?php if($message['user_id']!=NULL) {
                  ?>
                  <td><a href="<?=site_url(ADMIN_PATH.'/user/details/'.$message['user_id'])?>"><?=$message['name']?></a></td>
                  <?php
                    } else {
                  ?>
                  <td><a href="<?=site_url(ADMIN_PATH.'/messages/details/'.$message['id'])?>"><?=$message['name']?></a></td>
                  <?php
                    }
                  ?>
                  <td><a href="<?=site_url(ADMIN_PATH.'/messages/details/'.$message['id'])?>"><?=$message['email']?></a></td>
                  <td><a href="<?=site_url(ADMIN_PATH.'/messages/details/'.$message['id'])?>">
                  <?=humanize_date_time($message['received_date_time'])?>
                  </a></td>
                  <td>
                    <a href="<?=site_url(ADMIN_PATH.'/messages/delete_message/'.$message['id']) ?>" data-toggle="tooltip" title="Delete" class="btn btn-effect-ripple btn-xs btn-danger delete"  data-original-title="Delete"><i onClick="return doConfirm()" class="fa fa-times"></i></a>
                  </td>
                </tr>
                      <?php
                          
                        }
                      } else {
                        ?>
                <tr>
                  <td colspan="5">
                    <center>
                      <font color="#FF0000">::No Messages Yet.::</font>
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

<script>
    $(document).ready(function() {
        $('#message-dataTables').dataTable({
                responsive: true,
                sPaginationType: "full_numbers",
                "aaSorting": []
                //"order": [[ 3, "desc" ]]
        });
    });
</script>
