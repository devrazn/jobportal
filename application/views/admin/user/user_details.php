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
                        <li class="active"><a href="#info" data-toggle="tab">Personal Info</a>
                        </li>
                        <li><a href="#qualification" data-toggle="tab">Qualification</a>
                        </li>
                        <li><a href="#experience" data-toggle="tab">Experience</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <div class="tab-pane fade in active" id="info">

                    
                        <div class="panel-body">
                            <img src="<?=base_url().'uploads/user/'.$user_info['image']?>" class="img-responsive img-rounded" style="max-width:400px; width:200px">
                            <dl class="dl-horizontal">
                                <dt>Full Name</dt>
                                <dd><?=$user_info['f_name']. ' '.$user_info['l_name']?></dd>
                                <dt>Date of Birth</dt>
                                <dd>
                                    <?php
                                        $date = date_create_from_format('Y-m-d', $user_info['dob_estd']);
                                        $age = DateTime::createFromFormat('Y-m-d', $user_info['dob_estd'])->diff(new DateTime('now'))->y;
                                        echo date_format($date,  'jS M Y'); 
                                    ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Age </b><?=$age.' yrs'?></dd>
                                <dt>Gender</dt>
                                <dd><?php if( strcasecmp($user_info['gender'], 'm') == 0 ) echo 'Male'; else echo 'Female';?></dd>
                                <dt>Email</dt>
                                <dd><a href='javascript:void(0)'data-toggle="modal" data-target="#myModal"><?=$user_info['email']?></a></dd>
                                <dt>Marital Status</dt>
                                <dd><?php echo ($user_info['marital_status'])? 'Married' : 'Single'?></dd>
                                <dt>Address</dt>
                                <dd><?=$user_info['address']?></dd>
                                <dt>Phone</dt>
                                <dd><?=$user_info['phone']?></dd>
                            </dl>
                            <dl>
                                <dd>
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
                                                    <label>Content</label>
                                                    <textarea id="content" name="content" rows="10" cols="80">
                                                    </textarea>
                                                    <?=form_error('content')?>
                                                </div>
                                                           
                                                <div id='sender_div' class="form-group">
                                                    <label>Send From</label>
                                                    <input name="sender" type="text" id="sender" class="form-control" size="50" placeholder="Enter sender email" value="<?=set_value('sender', $mail_settings['smtp_user']);?>">
                                                    <?=form_error('sender')?>
                                                </div>
                                                
                                                <div id='password_div' class="form-group">
                                                    <label>Password</label>
                                                    <input name="password" type="password" id='password' class="form-control" size="50" placeholder="Enter password for <?=set_value('sender', $mail_settings['smtp_user']);?>">
                                                    <?=form_error('password')?>
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

                        <form class='ajax_form col-lg-6' role="form" id="frm" method="post" action="">           
                            <div class="form-group">
                              <label>Status&nbsp;&nbsp;</label>
                              <label class="radio-inline">
                                  <input type="radio" value="1" name="status" <?php if(set_value('status',$user_info['status'])==1){echo "checked";}?> >Active
                              </label>
                              <label class="radio-inline">
                                  <input type="radio" value="0" name="status" <?php if(set_value('status',$user_info['status'])==0) {echo "checked";}?> >Unverified
                              </label>
                              <label class="radio-inline">
                                  <input type="radio" value="2" name="status" <?php if(set_value('status',$user_info['status'])==2) {echo "checked";}?> >Suspended
                              </label>
                              <label class="radio-inline">
                                  <input type="radio" value="3" name="status" <?php if(set_value('status',$user_info['status'])==3) {echo "checked";}?> >Blocked
                              </label>
                              <?=form_error('status')?>
                            </div>
                            <div id='action_status_user'>
                                <a id='change_status_user' class='btn btn-success' type='submit'>Update Status</a>
                                <button class='btn btn-warning' type='reset'>Reset</button>
                            </div>
                        </form>
                

                        </div>
                        <br>
                        <div class="tab-pane fade" id="qualification">
                                <?php
                                    $i=0;
                                    foreach($qualification as $row) {
                                        if($i%2==0) echo "<div class='col-lg-12'>";
                                ?>
                                    <div class="col-lg-6">
                                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="javascript:void(0)"class='fa fa-<?php if($i<=1 ) echo 'minus'; else echo 'plus';?>'><?php echo "&nbsp;&nbsp;".$row['degree'];?></a>
                        </div>
                        <div class="panel-body" <?php if($i>1) echo "style='display:none'" ?>>
                            <dl class="dl-horizontal">
                                                    <dt>Degree</dt>
                                                    <dd><?=$row['degree']?></dd>
                                                    <dt>Institution</dt>
                                                    <dd><?=$row['institution']?></dd>
                                                    <dt>Completion Date</dt>
                                                    <dd><?=$row['completion_date']?></dd>
                                                    <dt><?php 
                                                        if($row['gpa_pct']<=4) 
                                                            echo 'GPA';
                                                        else echo 'Percentage';
                                                        ?>
                                                    </dt>
                                                    <dd><?=$row['gpa_pct']?></dd>
                                                </dl>
                                                <?php 
                                                    if($row['remarks']){
                                                ?>
                                                <div class="well">
                        <h4>Remarks</h4>
                        <p class="text-justify"><?=$row['remarks']?></p>
                    </div>
                    <?php 
                        }
                    ?>
                        <form class='qualification_form' role="form" id="frm" method="post" action="">           
                            <div class="form-group">
                              <label>Status&nbsp;&nbsp;</label>
                              <label class="radio-inline">
                                  <input type="radio" value="1" name="status" <?php if(set_value('status',$row['status'])==1){echo "checked";}?> >Active
                              </label>
                              <label class="radio-inline">
                                  <input type="radio" value="0" name="status" <?php if(set_value('status',$row['status'])==0) {echo "checked";}?> >Inactive
                              </label>
                              <?=form_error('status')?>
                            </div>
                            <input type="hidden" name="id" value="<?=$row['id']?>">
                            <div class='action_status_qualification'>
                                <button class='btn btn-success' type='submit'>Update Status</button>
                                <button class='btn btn-warning' type='reset'>Reset</button>
                            </div>
                        </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                                <?php
                                    $i++;
                                    if($i%2==0) echo "</div>";
                                    }
                                ?>
                            </div>
                            <div class="tab-pane fade" id="experience">
                                
                                <?php
                                    $i=0;
                                    foreach($experience as $row) {
                                        if($i%2==0) echo "<div class='col-lg-12'>";
                                ?>
                                    <div class="col-lg-6">
                                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="javascript:void(0)"class='fa fa-<?php if($i<=1 ) echo 'minus'; else echo 'plus';?>'><?php echo "&nbsp;&nbsp;".$row['position'];?></a>
                        </div>
                        <div class="panel-body" <?php if($i>1) echo "style='display:none'" ?>>
                            <dl class="dl-horizontal">
                                                    <dt>Position</dt>
                                                    <dd><?=$row['position']?></dd>
                                                    <dt>Company</dt>
                                                    <dd><?=$row['company_name']?></dd>
                                                    <dt>Start Year</dt>
                                                    <dd><?=$row['start_year']?></dd>
                                                    <dt>Duration</dt>
                                                    <dd>
                                                        <?php
                                                            echo $row['duration'] . ' ' . ucfirst($row['duration_unit']);
                                                            if($row['duration']>1) echo 's';
                                                        ?>
                                                    </dd>
                                                </dl>
                                                <?php 
                                                    if($row['description']){
                                                ?>
                                                <div class="well">
                        <h4>Job Description</h4>
                        <p class="text-justify"><?=$row['description']?></p>
                    </div>
                    <?php 
                        }
                    ?>

                    <form class='experience_form' role="form" id="frm" method="post" action="">           
                            <div class="form-group">
                              <label>Status&nbsp;&nbsp;</label>
                              <label class="radio-inline">
                                  <input type="radio" value="1" name="status" <?php if(set_value('status',$row['status'])==1){echo "checked";}?> >Active
                              </label>
                              <label class="radio-inline">
                                  <input type="radio" value="0" name="status" <?php if(set_value('status',$row['status'])==0) {echo "checked";}?> >Inactive
                              </label>
                              <?=form_error('status')?>
                            </div>
                            <input type="hidden" name="id" value="<?=$row['id']?>">
                            <div class='action_status_experience'>
                                <button class='btn btn-success' type='submit'>Update Status</button>
                                <button class='btn btn-warning' type='reset'>Reset</button>
                            </div>
                        </form>

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    </div>
                                <?php
                                    $i++;
                                    if($i%2==0) echo "</div>";
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
    

    $(document).on('click', '#change_status_user', function(){
        _this=$(this);
        var status =  $("[name='status']:checked").val();

        if(confirm("Are you sure to update status?")) {
            var id = <?=$user_info['id']?>;
            var divHTML =  $('#action_status_user').html();
        
            jQuery.ajax({
                url: "<?=base_url().'admin/user/change_status'; ?>/" + status + '/' + id,
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
                            "Experience Status Updated Successfully" + 
                            "</div>";

                        $('.alert').remove();
                        $("#alert_parent").append(responseHTML);
                        $('html, body').animate({
                            scrollTop: $("body").offset().top
                        }, 1000);
                    } else {
                        var responseHTML = "<div role='alert' class='alert alert-warning fade in' id='alert'>" + 
                            "<button aria-label='Close' data-dismiss='alert' class='close' type='button'>" + 
                            "<span aria-hidden='true'>×</span>" +
                            "</button>" + 
                            "An Unknown Error Occured. Please Try Again Later" + 
                            "</div>";

                        $('.alert').remove();
                        $("#alert_parent").append(responseHTML);
                        $('html, body').animate({
                            scrollTop: $("body").offset().top
                        }, 1000);
                    }
                }
            });
        } else {
            return false
        }    
    });

    $(document).on('click', '.fa', function(){
        if($(this).hasClass('fa-minus')){
            $(this).closest('.col-lg-6').find('.panel-body').slideUp();
            $(this).removeClass('fa-minus').addClass('fa-plus');
             $('html, body').animate({
                scrollBottom: $(this).closest('.col-lg-6').find('.panel-body').offset().top
            }, 1000);

        } else if ($(this).hasClass('fa-plus')){
            $(this).closest('.col-lg-6').find('.panel-body').slideDown();
            $(this).removeClass('fa-plus').addClass('fa-minus');
            $('html, body').animate({
                scrollTop: $(this).closest('.col-lg-6').find('.panel-body').offset().top
            }, 1000);
        }
    });

    $(document).ready(function(){
        $('#sender').on('input', function() {
            $("#password").attr("placeholder", "Enter password for " + $('#sender').val());
        });


        $('.experience_form').on('submit', function (e) {
            e.preventDefault();
            if(confirm("Are you sure to update status?")) {

                _thisButtons = $(this).find('.action_status_experience');
                var divHTML =  _thisButtons.html();
                _thisButtons.html("<img src='<?php echo base_url('assets/ajax/images/ajax-loader_dark.gif');?>' >");
                var values = $(this).serializeArray();

                $.ajax({
                    type: 'post',
                    url: "<?=base_url().'admin/user/update_experience_status'; ?>",
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
                                "Experience Status Updated Successfully" + 
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
                            "An Unknown Error Occured. Please Try Again Later" + 
                            "</div>";

                            $("#alert_parent").append(responseHTML);
                            $('html, body').animate({
                                scrollTop: $("body").offset().top
                            }, 1000);
                        }
                    },

                    error:function(data) {
                        _thisButtons.html(divHTML);
                        var responseHTML = "<div role='alert' class='alert alert-danger fade in' id='alert'>" + 
                            "<button aria-label='Close' data-dismiss='alert' class='close' type='button'>" + 
                            "<span aria-hidden='true'>×</span>" +
                            "</button>" + 
                            "An Unknown Error Occured. Please try again later." 
                            "</div>";
                        alert(parseJSON(data));
                            
                        $("#alert_parent").append(responseHTML);
                        $('html, body').animate({
                                scrollTop: $("body").offset().top
                        }, 1000);
                    }
                }); 
            } else {
                return false;
            }
        });


        $('.qualification_form').on('submit', function (e) {
            e.preventDefault();
            if(confirm("Are you sure to update status?")) {

                _thisButtons = $(this).find('.action_status_qualification');
                var divHTML =  _thisButtons.html();
                _thisButtons.html("<img src='<?php echo base_url('assets/ajax/images/ajax-loader_dark.gif');?>' >");
                var values = $(this).serializeArray();

                $.ajax({
                    type: 'post',
                    url: "<?=base_url().'admin/user/update_qualification_status'; ?>",
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
                                "Qualification Status Updated Successfully" + 
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
                            "An Unknown Error Occured. Please Try Again Later" + 
                            "</div>";

                            $("#alert_parent").append(responseHTML);
                            $('html, body').animate({
                                scrollTop: $("body").offset().top
                            }, 1000);
                        }
                    },

                    error:function(data) {
                        var responseHTML = "<div role='alert' class='alert alert-danger fade in' id='alert'>" + 
                                "<button aria-label='Close' data-dismiss='alert' class='close' type='button'>" + 
                                "<span aria-hidden='true'>×</span>" +
                                "</button>" + 
                                "An Unknown Error Occured. Please try again later." 
                                "</div>";
                            
                         $("#alert_parent").append(responseHTML);
                         $('html, body').animate({
                                scrollTop: $("body").offset().top
                        }, 1000);
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
            $('.ci_error').remove()

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

                            var responseHTML = "<div role='alert' class='alert alert-warning fade in' id='alert'>" + 
                            "<button aria-label='Close' data-dismiss='alert' class='close' type='button'>" + 
                            "<span aria-hidden='true'>×</span>" +
                            "</button>" + 
                            data['error_description'] + 
                            "</div>";

                            $("#modal_body").prepend(responseHTML);
                            $('#myModal').scrollTop(0);
                            if(data['subject']) {
                                $("#subject").append(data['subject']);
                            }
                            if(data['content']) {
                                $("#content_div").append(data['content']);
                            }
                            if(data['password']) {
                                $("#password_div").append(data['password']);
                            }
                            if(data['sender_div']) {
                                $("#sender").append(data['sender']);
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
