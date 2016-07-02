<link href="<?=base_url();?>assets/admin/template/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="<?=base_url()?>assets/admin/template/dist/css/dataTables.bootstrap.css" rel="stylesheet">

<!-- DataTables JavaScript -->
    <script src="<?=base_url();?>assets/admin/template/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>assets/admin/template/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<div class="col-md-8 single_right">
    <h3><?php echo $title;?></h3>
    <div class="panel-heading">
      <a class="btn btn-primary" href="<?=base_url().'user_profile/add_qualification';?>"><i class="fa fa-plus"> </i> Add New Qualification</a>   
    </div>
    <div class="well">
        <div class="dataTable_wrapper">
        <table id="employer_qualification_dataTables" class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>Degree</th>
                  <th>Institution</th>
                  <th>Completion Date</th>
                  <th>GPA/Percentage</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(count($qualification)>0){
                  foreach($qualification as $qualification){
                ?>
                <tr id="tr_<?php echo $qualification['id']; ?>">
                  <td><a href="<?=base_url().'user_profile/edit_qualification/'.$qualification['id']?>"><?=$qualification['degree']?></a></td>
                  <td><a href="<?=base_url().'user_profile/edit_qualification/'.$qualification['id']?>"><?=$qualification['institution']?></a></td>
                  <td><a href="<?=base_url().'user_profile/edit_qualification/'.$qualification['id']?>"><?=$qualification['completion_date']?></a></td>
                  <td><a href="<?=base_url().'user_profile/edit_qualification/'.$qualification['id']?>"><?=$qualification['gpa_pct']?></a></td>
                  <td><a class="btn btn-danger delete" data="<?php echo $qualification['id'];?>" data-toggle="tooltip" title="Delete"  data-original-title="Delete"><i class="fa fa-trash-o fa-lg"></i> Delete</a></td>
                </tr>
                      <?php
                          
                        }
                      } else {
                        ?>
                <tr>
                  <td colspan="5">
                    <center>
                      <font color="#FF0000">::You have not uploaded any qualification yet..::</font>
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
    $('#employer_qualification_dataTables').dataTable({
            responsive: true,
            sPaginationType: "full_numbers",
            "aaSorting": [4, "asc"]
            //"order": [[ 3, "desc" ]]
    });

    <?php $this->load->view('common/ajax_del')?>
  });
</script>
