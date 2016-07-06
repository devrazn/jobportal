<link href="<?=base_url();?>assets/admin/template/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="<?=base_url()?>assets/admin/template/dist/css/dataTables.bootstrap.css" rel="stylesheet">

<!-- DataTables JavaScript -->
    <script src="<?=base_url();?>assets/admin/template/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>assets/admin/template/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<div class="col-md-8 single_right">
    <h3><?php echo $title?></h3>
    <div class="panel-heading">
      <a class="btn btn-primary" href="<?=base_url().'employer_profile/post_job_view';?>"><i class="fa fa-plus"> </i> Post New Job</a>   
    </div>
    <div class="well">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-hover" id="employer_jobs-dataTables">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Position</th>
                  <th>Openings</th>
                  <th>Published Date</th>
                  <th>Deadline</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(count($jobs)>0){
                  foreach($jobs as $job){
                ?>
                <tr id="tr_<?php echo $job['id']; ?>"> 
                  <td><a href="<?=base_url().'employer_profile/edit_job/'.$job['id']?>"><?=$job['title']?></a></td>
                  <td><a href="<?=base_url().'employer_profile/edit_job/'.$job['id']?>"><?=$job['position']?></a></td>
                  <td><a href="<?=base_url().'employer_profile/edit_job/'.$job['id']?>"><?=$job['openings']?></a></td>
                  <td><a href="<?=base_url().'employer_profile/edit_job/'.$job['id']?>"><?=humanize_date($job['published_date'])?></a></td>
                  <td><a href="<?=base_url().'employer_profile/edit_job/'.$job['id']?>"><?=humanize_date($job['deadline_date'])?></a></td>
                  <td>
                    <a class="btn btn-danger delete" data="<?php echo $job['id'];?>" data-toggle="tooltip" title="Delete"  data-original-title="Delete"><i class="fa fa-trash-o fa-lg"></i> Delete</a>
                  </td>
                </tr>
                      <?php
                          
                        }
                      } else {
                        ?>
                <tr>
                  <td colspan="6">
                    <center>
                      <font color="#FF0000">::You have not posted any jobs..::</font>
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
