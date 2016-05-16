<div class="col-md-8 single_right">
    <h3><?=$job_details["title"]?></h3>
    <div class="row_1">
        <div class="col-sm-3 single_img">
            <a href="<?=base_url().'employer/'.$job_details["user_id"]?>">
                <img src="<?=base_url().'uploads/user/'.$job_details["image"]?>" class="img-responsive" alt="<?=$job_details["f_name"]?>" title="<?=$job_details["f_name"]?>"/>
            </a>
        </div>
        <div class="col-sm-9 single-para">
            <dl class="dl-horizontal">
                <dt>Title</dt>
                <dd><?=$job_details['title']?></dd>
                <dt>Category</dt>
                <dd><?=$job_details["category_name"]?></dd>
                <dt>Position</dt>
                <dd><?=$job_details['position']?></dd>
                <dt>Employer</dt>
                <dd><a href="<?=base_url().'employer/'.$job_details['user_id']?>"><?=$job_details['f_name']?></a></dd>
                <dt>Experience</dt>
                <dd><?=$job_details['experience']?></dd>
                <dt>Salary</dt>
                <dd>
                    <?php 
                        if($job_details['salary']){
                            echo $job_details['salary'];
                        } else {
                            echo "Undisclosed";
                        }
                    ?>
                </dd>
                <dt>Openings</dt>
                <dd><?=$job_details['openings']?></dd>
                <dt>Published On</dt>
                <dd>
                    <?=humanize_date($job_details['published_date'])?>&nbsp;&nbsp;&nbsp;
                        <?php
                                    $age_day = calculate_age_day_signed($job_details['published_date']);
                                    if($age_day==0) echo ' (Today)';
                                    else if($age_day==1) echo ' (Yesterday)';
                                    else {
                                        echo '(' . abs($age_day) . ' Days Ago)';
                                    }
                                ?>
                </dd>
                <dt>Deadline</dt>
                <?php 
                    $deadline_day = calculate_age_day_signed($job_details['deadline_date']);
                ?>
                <dd <?php if($deadline_day<0) echo "style='color:red'"?> >
                    <?=humanize_date($job_details['deadline_date'])?>&nbsp;&nbsp;&nbsp;
                    
                    <?php
                        $deadline_day = calculate_age_day_signed($job_details['deadline_date']);
                        if($deadline_day==0){
                            echo ' (Today)';
                        } else if($deadline_day == 1) {
                            echo ' (Tomorrow)';
                        } else if($deadline_day==-1){
                            echo ' (Yesterday)';
                        } else if($deadline_day>1) {
                            echo " (After " . abs($deadline_day) . ' Days)';
                        } else if($deadline_day<-1) {
                            echo '(' . abs($deadline_day) . ' Days ago) (Expired)';
                        }
                    ?>
                </dd>
                <dt>Address</dt>
                <dd><?=$job_details['location']?></dd>
            </dl>
        </div>
        <div class="clearfix"> </div>
    </div>
    <div class="well">
        <h4>Qualification</h4>
        <p class="text-justify"><?=$job_details['qualification']?></p>
    </div>
    <div class="well">
        <h4>Requirements</h4>
        <p class="text-justify"><?=$job_details['requirements']?></p>
    </div>

    <div class="well">
        <h4>Job Description / Responsibilities</h4>
        <p class="text-justify"><?=$job_details['job_description']?></p>
    </div>

<?php
if($job_details['facilities']):
?>
    <div class="well">
        <h4>Facilities</h4>
        <p class="text-justify"><?=$job_details['facilities']?></p>
    </div>
<?php
endif;
?>

<?php
if($job_details['additional_info']):
?>
    <div class="well">
        <h4>Facilities</h4>
        <p class="text-justify"><?=$job_details['additional_info']?></p>
    </div>
<?php
endif;
?>

    <div class="well">
        <h4>Application Procedure (Apply in any one of the following ways)</h4>
        <?php
            if($deadline_day>=0) {
        ?>
        <?php $checkboxValues = explode(",", $job_details["application_procedure"]); ?>
        <?php if(in_array("0", $checkboxValues)): ?>
        <li>
        Apply in Writing to:
            <ul>
                <address><p>
                    <?php $addressValues = explode(",", $job_details["address"]); ?>
                    <strong><?=$job_details['f_name'] . ','?></strong>
                    <br><?=$addressValues['0'];?>
                    <br><?=$addressValues['1'] . ', ' . $addressValues['2'];?>
                    <br>
                    <abbr title="Phone">P: </abbr><?=$job_details['phone']?>
                </p></address>
            </ul>
        </li>
        <?php
            endif;
        ?>

        <?php if(in_array("1", $checkboxValues)): ?>
        <li>
        Apply via email to:
            <ul>
                <p><strong><?=$job_details['email']?></strong></p>
            </ul>
        </li>
        <?php
            endif;
        ?>

        <?php if(in_array("2", $checkboxValues)): ?>
        <li>
        Apply via JobPortal:
            <ul><?php
                    if(!$this->helper_model->validate_user_session()) {
                        echo "<div>Please <a onClick='apply()' href='" . base_url() . "login'>login</a> to apply.</div>";
                    } else {
                        if($this->session->userdata('user_type')==1) {
                            if(!$this->helper_model->check_job_app_status($job_details['job_id'])) {
                ?>
                <p id="apply_button">
                    <a id="job_apply" href="javascript:void(0)" class="btn btn-default pull-left">Apply Now</a><br>
                </p>
                <?php
                    } else {
                        echo "<div style='color:red'>You've applied for this job.</div>";
                    }
                }
                ?>
                <?php
                    }
                ?>
            </ul>
        </li>
        <?php
            endif;
        ?>
        <?php
            } else {
                echo "<div style='color:red'>Job Application Date Expired.</div>";
            }
        ?>

    </div>
</div>
<?php
    if($deadline_day>=0 && !$this->helper_model->check_job_app_status($job_details['job_id']) && $this->session->userdata('user_type')==1):
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#apply_button").on('click', function(e) {

            e.preventDefault();
            if(confirm("Are you sure you want to apply for this job?")) {
                var divHTML =  $('#apply_button').html();

                $.ajax({
                    type: 'post',
                    url: "<?=base_url()?>" + "home/job_apply/",
                    data: { job_id: "<?=$job_details['job_id']?>" },
                    beforeSend: function(){
                        $('#apply_button').html("<img src='<?php echo base_url('assets/ajax/images/ajax-loader_dark.gif');?>' >");
                    },

                    success: function(data) {
                        //alert(data);
                        
                        if(data == 'success'){
                            $('#apply_button').html("<p style='color:red'>You've applied for this job.</p>");
                            var responseHTML = "<br><div class='col-lg-12'>" + 
                                "<div role='alert' class='alert alert-success fade in' id='alert'>" + 
                                "<button aria-label='Close' data-dismiss='alert' class='close' type='button'>" + 
                                "<span aria-hidden='true'>×</span>" +
                                "</button>" + 
                                "Your application for this job has been posted. The employer will contact you for further notice." + 
                                "</div>" + 
                                "</div>";

                            $('.alert').remove();
                            $("#alert_parent").append(responseHTML);
                            $('html, body').animate({
                                scrollTop: $("body").offset().top
                            }, 1000);
                        } else {
                            $('#apply_button').html(divHTML);
                            var responseHTML = "<br><div class='col-lg-12'>" + 
                                "<div role='alert' class='alert alert-warning fade in' id='alert'>" + 
                                "<button aria-label='Close' data-dismiss='alert' class='close' type='button'>" + 
                                "<span aria-hidden='true'>×</span>" +
                                "</button>" + 
                                "An Unknown Error Occured in server. Please Try Again Later" + 
                                "</div>" + 
                                "</div>";

                            $('.alert').remove();
                            $("#alert_parent").append(responseHTML);
                            $('html, body').animate({
                                scrollTop: $("body").offset().top
                            }, 1000);
                        }
                    },

                    error: function(data) {
                        alert("Connection error. Please try again later.")
                        $('#apply_button').html(divHTML);
                        $('html, body').animate({
                                scrollTop: $("body").offset().top
                            }, 1000);
                    }
                });
            } else {
                return false;
            }
        })
    })
</script>
<?php
    endif;
?>