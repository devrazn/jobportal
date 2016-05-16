<!--DataTables Responsive CSS -->
<link href="<?=base_url();?>assets/admin/template/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="<?=base_url()?>assets/admin/template/dist/css/dataTables.bootstrap.css" rel="stylesheet">

<!-- DataTables JavaScript -->
    <script src="<?=base_url();?>assets/admin/template/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>assets/admin/template/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<div class="col-md-8 single_right">
    <h3><?=$employer_details["f_name"]?></h3>
    <div class="row_1">
        <div class="col-sm-3 single_img">
      		
      			<img src="<?=base_url().'uploads/user/'.$employer_details["image"]?>" class="img-responsive" alt="<?=$employer_details["f_name"]?>" title="<?=$employer_details["f_name"]?>"/>
      		
        </div>
        <div class="col-sm-9 single-para">
            <dl class="dl-horizontal">
                <dt>Name</dt>
                <dd><?=$employer_details['f_name']?></dd>
                <?php
                    if($employer_details['company_type']):
                ?>
                <dt>Company Type</dt>
                <dd><?=$employer_details['company_type']?></dd>
                <?php
                    endif;
                ?>
                <dt>Established</dt>
                <dd><?=$employer_details['dob_estd']?></dd>
                <?php
                    if($employer_details['website']):
                ?>
                <dt>Website</dt>
                <dd><?=$employer_details['website']?></dd>
                <?php
                    endif;
                ?>
                <dt>Email</dt>
                <dd><?=$employer_details['email']?></dd>
                <dt>Address</dt>
                <dd><?=$employer_details['address']?></dd>
            </dl>
        </div>
        <div class="clearfix"> </div>
    </div>
    <?php
        if($employer_details['profile']):
    ?>
    <div class="well">
        <h4>Profile</h4>
        <p class="text-justify"><?=$employer_details['profile']?></p>
    </div>
    <?php
        endif;
    ?>
    <?php
        if($employer_details['benefits']):
    ?>
    <div class="well">
        <h4>Company Benifits</h4>
        <p class="text-justify"><?=$employer_details['benefits']?></p>
    </div>
    <?php
        endif;
    ?>
    <div class="well">
        <h4>Posted Jobs</h4>
        <div class="dataTable_wrapper">
            <table class="table table-striped table-hover" id="employer_jobs-dataTables">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Position</th>
                  <th>Openings</th>
                  <th>Published Date</th>
                  <th>Deadline</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(count($employer_jobs)>0){
                  foreach($employer_jobs as $job){
                ?>
                <tr> 
                  <td><a href="<?=base_url().'jobs/'.$job['id']?>"><?=$job['title']?></a></td>
                  <td><a href="<?=base_url().'jobs/'.$job['id']?>"><?=$job['position']?></a></td>
                  <td><a href="<?=base_url().'jobs/'.$job['id']?>"><?=$job['openings']?></a></td>
                  <td><a href="<?=base_url().'jobs/'.$job['id']?>"><?=humanize_date($job['published_date'])?></a></td>
                  <td><a href="<?=base_url().'jobs/'.$job['id']?>"><?=humanize_date($job['deadline_date'])?></a></td>
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
</div>

<script>
    $(document).ready(function() {
        $('#employer_jobs-dataTables').dataTable({
                responsive: true,
                sPaginationType: "full_numbers",
                "aaSorting": []
                //"order": [[ 3, "desc" ]]
        });
    });
</script>
