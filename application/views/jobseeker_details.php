<div class="col-md-8 single_right">
    <h3><?=$jobseeker_details["f_name"]?></h3>
    <div class="row_1">
        <div class="col-sm-3 single_img">
            <img src="<?=base_url().'uploads/user/'.$jobseeker_details["image"]?>" class="img-responsive img-rounded" alt="<?=$jobseeker_details["f_name"]?>" title="<?=$jobseeker_details["f_name"]?>"/>
        </div>
        <div class="col-sm-9 single-para">
            <dl class="dl-horizontal">
                <dt>Name</dt>
                <dd><?=$jobseeker_details['f_name'].' '.$jobseeker_details['l_name']?></dd>
                <dt>Email</dt>
                <dd><?=$jobseeker_details['email']?></dd>
                <dt>Address</dt>
                <dd><?=$jobseeker_details['address']?></dd>
                <dt>Gender</dt>
                <dd><?=$jobseeker_details['gender']==0?'Female':'Male'?></dd>
                <dt>Phone</dt>
                <dd><?=$jobseeker_details['phone']?></dd>
                <dt>DOB</dt>
                <dd><?=$jobseeker_details['dob_estd']?></dd>
                <dt>Marital Status</dt>
                <dd><?=$jobseeker_details['marital_status']==0?'Married':'Unmarried'?></dd>
            </dl>
        </div>
        <br />

    <h2>Qualification</h2>
    <div class="panel panel-default">
        <div class="row"></div>
            <table class="table">
                <thead>
                <tr>
                    <th>Degree</th>
                    <th>Institution</th>
                    <th>Completion Date</th>
                    <th>GPA</th>
                </tr>
                </thead>
                <?php  foreach($qualification as $row) { ?>
                <tr>
                    <td><?=$row['degree']?></td>
                    <td><?=$row['institution']?></td>
                    <td><?=$row['completion_date']?></td>
                    <td><?=$row['gpa_pct']?></td>
                </tr>
            <?php }?>
            </table>
        </div>
    </div> <br />
    
    <h2>Experience</h2>
    <div class="panel panel-default">
        <div class="row"></div>
            <table class="table">
                <thead>
                <tr>
                    <th>Position</th>
                    <th>Company Name</th>
                    <th>Start Year</th>
                    <th>Duration</th>
                    <th>Description</th>
                </tr>
                </thead>
                <?php  foreach($experience as $row) { ?>
                <tr>
                    <td><?=$row['position']?></td>
                    <td><?=$row['company_name']?></td>
                    <td><?=$row['start_year']?></td>
                    <td><?=$row['duration'].' '.$row['duration_unit']?></td>
                </tr>
            <?php }?>
            </table>
        </div>
    </div>
</div>


