<div class="row" id='top'>
  <div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?=$title?>
                </div>
                <!-- .panel-heading -->
                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#info" data-toggle="tab">Employer Info</a>
                        </li>
                        <li><a href="#jobs" data-toggle="tab">Jobs <?='(' . count($jobs) . ')'?></a>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <div class="tab-pane fade in active" id="info">

                    
                        <div class="panel-body">
                            <img src="<?=base_url().'uploads/user/images/'.$user_info['image']?>" class="img-responsive img-rounded" style="max-width:400px; width:200px">
                            <dl class="dl-horizontal">
                                <dt>Employer / Company</dt>
                                <dd><?=$user_info['f_name']?></dd>
                                <dt>Established</dt>
                                <dd><?=$user_info['dob_estd']?>
                                    <?php
                                        $age = calculate_age_from_year($user_info['dob_estd']); 
                                    ?> &nbsp;(<?php
                                                                        echo $age . ' Yr';
                                                                        if($age>1) echo 's';
                                                                    ?> ago)
                                </dd>
                                <?php 
                                    if($user_info['company_type']):
                                ?>
                                <dt>Type</dt>
                                <dd><?=$user_info['company_type']?></dd>
                                <?php
                                    endif;
                                ?>
                                <?php 
                                    if($user_info['website']):
                                ?>
                                <dt>Website</dt>
                                <dd><a href="<?=$user_info['website']?>" target="_blank"><?=$user_info['website']?></a></dd>
                                <?php
                                    endif;
                                ?>
                                <dt>Email</dt>
                                <dd><a href='javascript:void(0)' data-toggle="modal" data-target="#myModal"><?=$user_info['email']?></a></dd>
                                <dt>Address</dt>
                                <dd><?=$user_info['address']?></dd>
                                <dt>Phone</dt>
                                <dd><?=$user_info['phone']?></dd>
                            </dl>
                            <dl>
                                <dd>

                                    <?php if($user_info['benefits']) { ?>
                    <div class="col-lg-6">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Employee Benefits
                            </div>
                            <div class="panel-body">
                                <?=$user_info['benefits']?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                

                                    <div class="well">
                                        <h4><b>Profile</b></h4>
                                        <p class="text-justify"><?=$user_info['profile']?></p>
                                    </div> 
                                </dd>
                            </dl>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Email to <?php echo $user_info['f_name'] . ' ' . $user_info['l_name']. ' &lt' . $user_info['email']. '&gt'?></h4>
                                        </div>
                                        <div id='modal_body'  class="modal-body">
                                            <form role="form" id="email_form">
                                                <?php if(validation_errors()) echo "<div style='color:red'><b>Please enter the required fields correctly.</b></div>";?>          
                                                <div id='subject' class="form-group">
                                                    <label>Subject</label>
                                                    <input name="subject" type="text" class="form-control" size="50" value="<?=set_value('subject');?>">
                                                    <?=form_error('subject')?>
                                                </div>

                                                <div id='content_div' class="form-group">
                                                    <label>Message</label>
                                                    <textarea id="content" name="content" rows="10" cols="80">
                                                    </textarea>
                                                    <?=form_error('content')?>
                                                </div>
                                                           
                                                <input name='receiver_email' type='hidden' value="<?=$user_info['email']?>">
                                                <div id='action_email'>
                                                    <button id='#send_email' class="btn btn-success" type="submit">Send</button>
                                                    <button class="btn btn-warning" type="reset">Reset</button>
                                                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                        </div>
                        <!-- /.panel-body -->

                        <form class='col-lg-12' role="form" id="employer_form" method="post" action="">
                            <div class="form-group">
                                <label>Feature on the homepage slider&nbsp;&nbsp;</label>
                                <label class="radio-inline">
                                    <input type="radio" value="1" name="feature_in_slider" <?php if(set_value('feature_in_slider',$user_info['feature_in_slider'])==1){echo "checked";}?> >Yes
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" value="0" name="feature_in_slider" <?php if(set_value('feature_in_slider',$user_info['feature_in_slider'])==0) {echo "checked";}?> >No
                                </label>
                                <?=form_error('feature_in_slider')?>
                            </div>
                            <div class="form-group">
                              <label>Verification Status&nbsp;&nbsp;</label>
                              <label class="radio-inline">
                                  <input type="radio" value="0" name="verification_status" <?php if(set_value('verification_status',$user_info['verification_status'])==0){echo "checked";}?> >Unverified
                              </label>
                              <label class="radio-inline">
                                  <input type="radio" value="1" name="verification_status" <?php if(set_value('verification_status',$user_info['verification_status'])==1) {echo "checked";}?> >Email Verified
                              </label>
                              <label class="radio-inline">
                                  <input type="radio" value="2" name="verification_status" <?php if(set_value('verification_status',$user_info['verification_status'])==2) {echo "checked";}?> >Email &amp Admin Verified
                              </label>
                                <?=form_error('verification_status')?>
                            </div>
                            <div class="form-group">
                              <label>Account Status&nbsp;&nbsp;</label>
                              <label class="radio-inline">
                                  <input type="radio" value="1" name="account_status" <?php if(set_value('account_status',$user_info['account_status'])==1) {echo "checked";}?> >Active
                              </label>
                              <label class="radio-inline">
                                  <input type="radio" value="2" name="account_status" <?php if(set_value('account_status',$user_info['account_status'])==2) {echo "checked";}?> >Suspended
                              </label>
                              <label class="radio-inline">
                                  <input type="radio" value="3" name="account_status" <?php if(set_value('account_status',$user_info['account_status'])==3) {echo "checked";}?> >Blocked
                              </label>
                            <?=form_error('account_status')?>
                            </div>
                            <input type='hidden' name='id' value="<?=$user_info['id']?>" >
                            <div id='action_status_user'>
                                <button id='change_status_user' class='btn btn-success' type='submit'>Update Status</button>
                                <button class='btn btn-warning' type='reset'>Reset</button>
                            </div>
                        </form>
                

                        </div>
                        <br>
                        <div class="tab-pane fade" id="jobs">
                                <?php
                                    $i=0;
                                    foreach($jobs as $row) {
                                ?>
                                    <div class="col-lg-12">
                                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="javascript:void(0)"class='fa fa-plus'><?php echo "&nbsp;&nbsp;".$row['title'];?></a>
                        </div>
                        <div class="panel-body" style='display:none'>
                            <dl class="dl-horizontal">
                                <dt>Category</dt>
                                <dd><?=$this->category_model->category_name_by_id($row['category_id'])?></dd>
                                                    <dt>Title</dt>
                                                    <dd><?=$row['title']?></dd>
                                                    <dt>Position</dt>
                                                    <dd><?=$row['position']?></dd>
                                                    <dt>Published On</dt>
                                                    <dd>
                                                        <?=humanize_date($row['published_date'])?>&nbsp;&nbsp;&nbsp;
                                                            <?php
                                                                        $age_day = calculate_age_day($row['published_date']);
                                                                        if($age_day==0) echo ' (Today)';
                                                                        else if($age_day==1) echo ' (Yesterday)';
                                                                        else {
                                                                            echo '(' . $age_day . ' Days ago)';
                                                                        }
                                                                    ?>
                                                    </dd>
                                                    <dt>Deadline</dt>
                                                    <dd>
                                                        <?=humanize_date($row['deadline_date'])?>&nbsp;&nbsp;&nbsp;
                                                        
                                                        <?php
                                                            $age_day = calculate_age_day_signed($row['deadline_date']);
                                                            if($age_day==0){
                                                                echo ' (Today)';
                                                            } else if($age_day == 1) {
                                                                echo ' (Tomorrow)';
                                                            } else if($age_day==-1){
                                                                echo ' (Yesterday)';
                                                            } else if($age_day>1) {
                                                                echo " (After " . abs($age_day) . ' Days)';
                                                            } else if($age_day<-1) {
                                                                echo '(' . abs($age_day) . ' Days ago)';
                                                            }
                                                        ?>
                                                    </dd>
                                                    <dt>Location</dt>
                                                    <dd><?=$row['location']?></dd>
                                                    <dt>Qualification</dt>
                                                    <dd><?=$row['qualification']?></dd>
                                                    <dt>Experience</dt>
                                                    <dd><?php 
                                                            echo $row['experience'];
                                                        ?>
                                                    </dd>
                                                    <dt>Salary</dt>
                                                    <dd><?php 
                                                            if($row['salary']>0) {
                                                                echo $row['salary'];
                                                            } else {
                                                                echo "Undisclosed";
                                                            }
                                                        ?>
                                                    </dd>
                                                </dl>

                                                <div class="well">
                        <h4>Requirements</h4>
                        <p class="text-justify"><?=$row['requirements']?></p>
                    </div>

                    <div class="well">
                        <h4>Job Description / Responsibilities</h4>
                        <p class="text-justify"><?=$row['job_description']?></p>
                    </div>

                    <?php
                        if($row['facilities']){
                    ?>
                            <div class="well">
                                <h4>Facilities</h4>
                                <p class="text-justify"><?=$row['facilities']?></p>
                            </div>
                    <?php
                        }
                    ?>

                        <form class='job_form' role="form" id="frm" method="post" action="">
                            <div class="form-group">
                            <?php $checkboxValues = explode(",", $row["application_procedure"]); ?>
                                <label>Application Procedure &nbsp;&nbsp;</label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="application_procedure[]" value="0" <?php if(in_array("0", $checkboxValues)) echo 'checked';?> >Apply in Writing
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="application_procedure[]" value="1" <?php if(in_array("1", $checkboxValues)) echo 'checked';?> >Apply via Company's Email
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="application_procedure[]" value="2" <?php if(in_array("2", $checkboxValues)) echo 'checked';?> >Apply via JobPortal
                                </label>
                            </div>

                            <div class="form-group">
                              <label>Status&nbsp;&nbsp;</label>
                              <label class="radio-inline">
                                  <input type="radio" value="1" name="status" <?php if(set_value('status',$row['status'])==1){echo "checked";}?> >Active
                              </label>
                              <label class="radio-inline">
                                  <input type="radio" value="0" name="status" <?php if(set_value('status',$row['status'])==0) {echo "checked";}?> >Inactive
                              </label>
                              <label class="radio-inline">
                                  <input type="radio" value="2" name="status" <?php if(set_value('status',$row['status'])==2) {echo "checked";}?> >Closed
                              </label>
                              <?=form_error('status')?>
                            </div>
                            <input type="hidden" name="id" value="<?=$row['id']?>">
                            <div class='action_status_job'>
                                <button class='btn btn-success' type='submit'>Update this Job</button>
                                <button class='btn btn-warning' type='reset'>Reset</button>
                            </div>
                        </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                                <?php
                                    $i++;
                                    }
                                ?>
                            </div>
                        </div>

                    </div>
                    <!-- .panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>

    </div>
    <!-- col-lg-12 -->
</div>
<!-- row -->

<script src="<?=base_url();?>assets/ckeditor/ckeditor_js/ckeditor.js"></script>
<script type="text/javascript">
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('content');
    });


    $(document).on('click', '.fa', function(){
        if($(this).hasClass('fa-minus')){
            $(this).closest('.col-lg-12').find('.panel-body').slideUp();
            $(this).removeClass('fa-minus').addClass('fa-plus');
             $('html, body').animate({
                scrollBottom: $(this).closest('.col-lg-12').find('.panel-body').offset().top
            }, 1000);

        } else if ($(this).hasClass('fa-plus')){
            $(this).closest('.col-lg-12').find('.panel-body').slideDown();
            $(this).removeClass('fa-plus').addClass('fa-minus');
            $('html, body').animate({
                scrollTop: $(this).closest('.col-lg-12').find('.panel-body').offset().top
            }, 1000);
        }
    });

    $(document).ready(function(){
        $('#employer_form').on('submit', function (e) {
            e.preventDefault();
            if(confirm("Are you sure to update this employer?")) {
                var divHTML =  $('#action_status_user').html();
                var values = $(this).serializeArray();

                $.ajax({
                    type: 'post',
                    url: "<?=base_url().'admin/user/update_employer_status'; ?>",
                    data: values,
                    beforeSend: function(){
                        $('#action_status_user').html("<img src='<?php echo base_url('assets/ajax/images/ajax-loader_dark.gif');?>' >");
                    },

                    success: function(data) {
                        $('#action_status_user').html(divHTML);
                        if(data == 'success'){
                            //alert('Status Updated Successfully');
                            var responseHTML = "<div role='alert' class='alert alert-success fade in' id='alert'>" + 
                                "<button aria-label='Close' data-dismiss='alert' class='close' type='button'>" + 
                                "<span aria-hidden='true'>×</span>" +
                                "</button>" + 
                                "Employer Info Updated Successfully" + 
                                "</div>";

                            $('.alert').remove();
                            $("#alert_parent").append(responseHTML);
                            $('html, body').animate({
                                scrollTop: $("body").offset().top
                            }, 1000);
                        } else {
                            var responseHTML = "<div role='alert' class='alert alert-danger fade in' id='alert'>" + 
                                "<button aria-label='Close' data-dismiss='alert' class='close' type='button'>" + 
                                "<span aria-hidden='true'>×</span>" +
                                "</button>" + 
                                //"An Unknown Error Occured. Please Try Again Later" + 
                                data +
                                "</div>";

                            $('.alert').remove();
                            $("#alert_parent").append(responseHTML);
                            $('html, body').animate({
                                scrollTop: $("body").offset().top
                            }, 1000);
                        }
                    },

                    error: function(data) {
                        $('#action_status_user').html(divHTML);
                        alert("An unknown error occured. Please try again later");
                    }
                });
            } else {
                return false
            }    
        });

        $('#sender').on('input', function() {
            $("#password").attr("placeholder", "Enter password for " + $('#sender').val());
        });

        $('.job_form').on('submit', function (e) {
            e.preventDefault();
            if(confirm("Are you sure to update this job?")) {

                _thisButtons = $(this).find('.action_status_job');
                var divHTML =  _thisButtons.html();
                _thisButtons.html("<img src='<?php echo base_url('assets/ajax/images/ajax-loader_dark.gif');?>' >");
                var values = $(this).serializeArray();

                $.ajax({
                    type: 'post',
                    url: "<?=base_url().'admin/user/update_job_status_and_procedure'; ?>",
                    data: values,
                    beforeSend: function(){
                        _thisButtons.html("<img src='<?php echo base_url('assets/ajax/images/ajax-loader_dark.gif');?>' >");
                    },

                    success: function (data) {
                       _thisButtons.html(divHTML);
                        if(data=='success') {
                            var responseHTML = "<div role='alert' class='alert alert-success fade in' id='alert'>" + 
                                "<button aria-label='Close' data-dismiss='alert' class='close' type='button'>" + 
                                "<span aria-hidden='true'>×</span>" +
                                "</button>" + 
                                "Job Status Updated Successfully" + 
                                "</div>";

                            $("#alert_parent").append(responseHTML);
                            $('html, body').animate({
                                scrollTop: $("body").offset().top
                            }, 1000);

                        } else {
                            var responseHTML = "<div role='alert' class='alert alert-warning fade in' id='alert'>" + 
                            "<button aria-label='Close' data-dismiss='alert' class='close' type='button'>" + 
                            "<span aria-hidden='true'>×</span>" +
                            "</button>" + 
                            "An Unknown Error Occured. Please Try Again Later." + 
                            "</div>";

                            $("#alert_parent").append(responseHTML);
                            $('html, body').animate({
                                scrollTop: $("body").offset().top
                            }, 1000);
                        }
                    },

                    error: function(data) {
                        _thisButtons.html(divHTML);
                        alert("An unknown error occured. Please try again later.");
                    }
                });
            } else {
                return false;
            }
        });

        $('#email_form').on('submit', function (e) {
            var divHTML =  $('#action_email').html();
            e.preventDefault();
            var content = CKEDITOR.instances['content'].getData();
            var values = $('#email_form').serializeArray();
            values.push({name: 'content', value: content});
            $('.alert').remove();
            $('.ci_error').remove();

            $.ajax({
                type: 'post',
                url: "<?=base_url().'admin/user/send_email'; ?>",
                data: values,
                dataType: 'json',
                beforeSend: function(){
                    $('#action_email').html("<img src='<?php echo base_url('assets/ajax/images/ajax-loader_dark.gif');?>' >");
                },

                success: function (data) {
                    $('#action_email').html(divHTML);
                    if(data['error_title']=='success') {
                        var responseHTML = "<div role='alert' class='alert alert-success fade in' id='alert'>" + 
                            "<button aria-label='Close' data-dismiss='alert' class='close' type='button'>" + 
                            "<span aria-hidden='true'>×</span>" +
                            "</button>" + 
                            data['error_msg'] + 
                            "</div>";

                        $("#alert_parent").append(responseHTML);
                        $('#myModal').modal('hide');
                        $('html, body').animate({
                            scrollTop: $("body").offset().top
                        }, 1000);

                    } else {
                        if (data['error_title']=='validation_error') {

                            var responseHTML = "<p class='ci_error' style='color:red'><b>Please enter the required fields correctly.</b></p>";

                            $("#modal_body").prepend(responseHTML);
                            $('#myModal').scrollTop(0);
                            if(data['subject']) {
                                $("#subject").append(data['subject']);
                            }
                            if(data['content']) {
                                $("#content_div").append(data['content']);
                            }                           

                        } else if (data['error_title']=='email_error') {
                            var responseHTML = "<div role='alert' class='alert alert-danger fade in' id='alert'>" + 
                            "<button aria-label='Close' data-dismiss='alert' class='close' type='button'>" + 
                            "<span aria-hidden='true'>×</span>" +
                            "</button>" + 
                            data['error_msg'] + 
                            " Click <a target='_blank' href='" + admin_path + "error_log'>here</a> to view the error log." +
                            "</div>";
                            $("#modal_body").prepend(responseHTML);
                            $('#myModal').scrollTop(0);
                        }
                    }
                },

                error:function(data) {
                    $('#action_email').html(divHTML);
                    var responseHTML = "<div role='alert' class='alert alert-danger fade in' id='alert'>" + 
                            "<button aria-label='Close' data-dismiss='alert' class='close' type='button'>" + 
                            "<span aria-hidden='true'>×</span>" +
                            "</button>" + 
                            "Unknown Error. " + 
                            "Please try again later. Click <a target='_blank' href='" + admin_path + "error_log'>here</a> to view the error log." 
                            "</div>";
                        
                    $("#modal_body").prepend(responseHTML);
                    $('#myModal').scrollTop(0);
                }
            });
        });
    });
</script>
