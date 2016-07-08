<link href="<?=base_url();?>assets/admin/template/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="<?=base_url()?>assets/admin/template/dist/css/dataTables.bootstrap.css" rel="stylesheet">

<!-- DataTables JavaScript -->
    <script src="<?=base_url();?>assets/admin/template/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>assets/admin/template/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<div class="col-md-8 single_right">
    <h3><?php echo $title?></h3>
    <div class="well">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-hover" id="employer_notification_dataTables">
              <thead>
                <tr>
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Job Title</th>
                  <th>Position</th>
                  <th>Deadline Date</th>
                  <th>Job Applied Date</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(count($data)>0){
                  foreach($data as $data){ 

                ?>
                  <tr <?php if($data['read_flag']==0) echo "style='font-weight:bold'"?>> 
                    <td><a href="<?php echo base_url().'employer_profile/user_details/'.$data["user_map_job_id"]?>"><?=$data['f_name'].' '.$data['l_name']?></a></td>
                    <td><a href="<?php echo base_url().'employer_profile/user_details/'.$data["user_map_job_id"]?>"><?=$data['email']?></a></td>
                    <td><a href="<?=base_url().'jobs/'.$data["job_id"]?>"><?=$data['title']?></a></td>
                    <td><a href="<?=base_url().'jobs/'.$data["job_id"]?>"><?=$data['position']?></a></td>
                    <td><a href="<?=base_url().'jobs/'.$data["job_id"]?>"><?=$data['deadline_date']?></a></td>
                    <td><a href=""><?=$data['applied_date']?></a></td>
                </tr>
                      <?php
                          
                        }
                      } else {
                        ?>
                <tr>
                  <td colspan="5">
                    <center>
                      <font color="#FF0000">::Jobs not applied yet..::</font>
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
</div>

<script>
  $(document).ready(function() {

    $('#employer_notification_dataTables').dataTable({
      responsive: true,
      sPaginationType: "full_numbers",
      "aaSorting": [3, "asc"],

      "columnDefs": [{
        "defaultContent": "-",
        "targets": "_all"
      }]
    });
  });
</script>
