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
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>User Type</th>
                  <th>DoB/Estd</th>
                  <th>Company Type</th>
                  <th>Status</th>
                  <th>Options</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(count($user_list)>0){
                  foreach($user_list as $user){
                ?>
                <tr>
                  <td><a href="<?=site_url(ADMIN_PATH.'/user/details/'.$user['id'])?>"><?=$user['f_name']." ".$user['l_name']?></a></td>
                  <td><?=$user['email']?></td>
                  <td><?=$user['address']?></td>
                  <td><?php 
                        if($user['user_type']==1){
                          echo 'Job Seeker';
                        } else {
                          echo 'Employer';
                        }
                      ?>
                  </td>
                  <td><?=$user['dob_estd']?></td>
                  <td><?=$user['company_type']?></td>
                  <td><?php 
                        if($user['verification_status']==0){
                          echo 'Not Verified';
                        } else if ($user['verification_status']==1){
                          if($user['user_type']==1){
                            echo 'Verified';
                          } else {
                            echo "Email Verified";
                          }
                        } else if ($user['verification_status']==2){
                          echo 'Admin Verified';
                        } 
                      ?>
                  </td>
                  <td>
                    <a href="<?=site_url(ADMIN_PATH.'/user/edit/'.$user['id']) ?>" data-toggle="tooltip" title="Edit" class="btn btn-effect-ripple btn-xs btn-success"  data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                  </td>
                </tr>
                      <?php
                          
                        }
                      } else {
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

<script type="text/javascript">
  $(document).on('click','.status_checks',function(){
  var status = ($(this).hasClass("btn-success")) ? '0' : '1';
  var msg = (status=='0')? 'Deactivate' : 'Activate';
  if(confirm("Are you sure to "+ msg)){
    var current_element = $(this);
    url = "user/change_status";
    $.ajax({
    type:"POST",
    url: url,
    data: {id:$(current_element).attr('data'),status:status},
    success: function(data)
      {   
        //debugger;
        location.reload();
      }
    });
    }      
  });
</script>

<script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable({
                responsive: true,
                sPaginationType: "full_numbers"
        });
    });
</script>
