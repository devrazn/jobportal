<link href="<?=base_url();?>assets/admin/template/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="<?=base_url()?>assets/admin/template/dist/css/dataTables.bootstrap.css" rel="stylesheet">

<!-- DataTables JavaScript -->
    <script src="<?=base_url();?>assets/admin/template/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>assets/admin/template/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<div class="col-md-8 single_right">
    <h3><?php echo $title?></h3>
    <div class="panel-heading">
      <a class="btn btn-primary" href="<?=base_url().'user_profile/add_experience';?>"><i class="fa fa-plus"> </i> Add New Experience</a>   
    </div>
    <div class="well">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-hover" id="employer_jobs-dataTables">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Position</th>
                  <th>Company</th>
                  <th>Started on</th>
                  <th>Duration</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(count($experiences)>0){
                  foreach($experiences as $experience){
                ?>
                <tr id="tr_<?php echo $experience['id']; ?>"> 
                  <td><a href="<?=base_url().'user_profile/edit_experience/'.$experience['id']?>"><?=$experience['title']?></a></td>
                  <td><a href="<?=base_url().'user_profile/edit_experience/'.$experience['id']?>"><?=$experience['position']?></a></td>
                  <td><a href="<?=base_url().'user_profile/edit_experience/'.$experience['id']?>"><?=$experience['company_name']?></a></td>
                  <td><a href="<?=base_url().'user_profile/edit_experience/'.$experience['id']?>"><?=$experience['start_year']?></a></td>
                  <td><a href="<?=base_url().'user_profile/edit_experience/'.$experience['id']?>"><?=$experience['duration']?> <?php if($experience['duration_unit']==1){echo 'Yr';}else{echo 'Month';} ?></a></td>
                  <td>
                    <a class="btn btn-danger delete" data="<?php echo $experience['id'];?>" data-toggle="tooltip" title="Delete"  data-original-title="Delete"><i class="fa fa-trash-o fa-lg"></i> Delete</a>
                  </td>
                </tr>
                      <?php
                          
                        }
                      } else {
                        ?>
                <tr>
                  <td colspan="6">
                    <center>
                      <font color="#FF0000">::You have not uploaded any experience yet..::</font>
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
      $('#employer_jobs-dataTables').dataTable({
              responsive: true,
              sPaginationType: "full_numbers",
              "aaSorting": [3, "asc"]
      });

      <?php $this->load->view('common/ajax_del')?>
  });
</script>
