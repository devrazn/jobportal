<div class="col-md-9 single_right">
          <div class="but_list">
           <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Job Seeker Details</a></li>
              <li role="presentation"><a href="#qualification" role="tab" id="qualification-tab" data-toggle="tab" aria-controls="qualification">Qualification</a></li>
              <li role="presentation"><a href="#experience" role="tab" id="experience-tab" data-toggle="tab" aria-controls="experience">Experiences</a></li>
            </ul>
        <div id="myTabContent" class="tab-content">
          <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
            <div class="tab_grid row">
            <div class="col-sm-3 single_img">
            <a target="_blank" href="<?=base_url().'uploads/user/images/'.$jobseeker['image']?>">
                <img title="<?=$jobseeker['f_name'].' '.$jobseeker['l_name']?>" alt="<?=$jobseeker['f_name'].' '.$jobseeker['l_name']?> - Image" class="img-responsive img-rounded" src="<?=base_url().'uploads/user/images/'.$jobseeker['image']?>">
            </a>
        </div>
                <div class="col-sm-9 single-para">
                    <dl class="dl-horizontal">
                        <dt>Name</dt>
                        <dd><?=$jobseeker['f_name'].' '.$jobseeker['l_name']?></dd>
                        <dt>Email</dt>
                        <dd><a href='javascript:void(0)' data-toggle="modal" data-target="#myModal"><?=$jobseeker['email']?></a></dd>
                        <dt>Address</dt>
                        <dd><?=$jobseeker['address']?></dd>
                        <dt>Gender</dt>
                        <dd><?=$jobseeker['gender']==0?'Female':'Male'?></dd>
                        <dt>Phone</dt>
                        <dd><?=$jobseeker['phone']?></dd>
                        <dt>DOB</dt>
                        <dd><?=humanize_date($jobseeker['dob_estd'])?> <b>&nbsp;&nbsp;Age:</b> <?=calculate_age_year_from_y_m_d($jobseeker['dob_estd'])?> Yrs</dd>
                        <dt>Marital Status</dt>
                        <dd><?=$jobseeker['marital_status']==0?'Married':'Unmarried'?></dd>
                    </dl>
                </div>
            </div>
            <div class="tab_grid row">
                <div class="well">
                        <h4>BIO</h4>
                        <p class="text-justify"><?=$jobseeker['profile']?></p>
                    </div>
                    <div class="well">
                        <h4>TAGS</h4>
                        <?php 
                            foreach ($tags as $tag) {
                        ?>
                            <a target="_blank" href="<?=base_url()?>employer_profile/search?search=<?=$tag['name']?>" class="btn bg-primary margin"><?=$tag['name']?></a>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Email to <?php echo $jobseeker['f_name'] . ' ' . $jobseeker['l_name']. ' &lt' . $jobseeker['email']. '&gt'?></h4>
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
                                                
                                                <input name='receiver_email' type='hidden' value="<?=$jobseeker['email']?>">
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
          <div role="tabpanel" class="tab-pane fade" id="qualification" aria-labelledby="qualification-tab">
            <div class="tab_grid">
                <h3>Qualifications</h3>
                <?php 
                $count = count($qualifications);
                if($count > 0) {
                $j=0;
                for($i=0; $i<$count/2; $i++) {

            ?>
            <div class="row">
            <?php 
                        while($j < $count) {
                    ?>
                                    <div class="col-lg-6">
                                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="javascript:void(0)" class='fa fa-<?php if($i<1 ) echo 'minus'; else echo 'plus';?>'><?php echo "&nbsp;&nbsp;".$qualifications[$j]['degree'];?></a>
                        </div>
                        <div class="panel-body" <?php if($i>0) echo "style='display:none'" ?>>
                            <dl class="dl-horizontal">
                                                    <dt>Degree</dt>
                                                    <dd><?=$qualifications[$j]['degree']?></dd>
                                                    <dt>Institution</dt>
                                                    <dd><?=$qualifications[$j]['institution']?></dd>
                                                    <dt>Completion Date</dt>
                                                    <dd><?=$qualifications[$j]['completion_date']?></dd>
                                                    <dt><?php 
                                                        if($qualifications[$j]['gpa_pct']<=4) 
                                                            echo 'GPA';
                                                        else echo 'Percentage';
                                                        ?>
                                                    </dt>
                                                    <dd><?=$qualifications[$j]['gpa_pct']?></dd>
                                                </dl>
                                                <?php 
                                                    if($qualifications[$j]['remarks']){
                                                ?>
                                                <div class="well">
                        <h4>Remarks</h4>
                        <p class="text-justify"><?=$qualifications[$j]['remarks']?></p>
                    </div>
                    <?php 
                        }
                    ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                                 <?php
                            $j++;
                            if($j%2==0) {
                                break;
                            }

                        } ?>
                        </div>
                        <?php 
                       } 
                   } else {
                        ?>
                        <p align="center" style="color:red"><b>NO QUALIFICATIONS TO SHOW</b></p>
                        <?php } ?>
              </div>

            </div>

          <div role="tabpanel" class="tab-pane fade" id="experience" aria-labelledby="experience-tab">
            <div class="tab_grid">
                <h3>Experience</h3>
                <?php 
                $count = count($experiences);
                if($count > 0) {
                $j=0;
                for($i=0; $i<$count/2; $i++) {

            ?>
            <div class="row">
            <?php 
                        while($j < $count) {
                    ?>
                                    <div class="col-lg-6">
                                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="javascript:void(0)" class='fa fa-<?php if($i<1 ) echo 'minus'; else echo 'plus';?>'><?php echo "&nbsp;&nbsp;".$experiences[$j]['title'];?></a>
                        </div>
                        <div class="panel-body" <?php if($i>0) echo "style='display:none'" ?>>
                            <dl class="dl-horizontal">
                                                    <dt>Position</dt>
                                                    <dd><?=$experiences[$j]['position']?></dd>
                                                    <dt>Company</dt>
                                                    <dd><?=$experiences[$j]['company_name']?></dd>
                                                    <dt>Started on</dt>
                                                    <dd><?=$experiences[$j]['start_year']?></dd>
                                                    <dt>Duration</dt>
                                                    <dd><?php=$experiences[$j]['duration'].' '.$experiences[$j]['duration_unit']?></dd>
                                                </dl>
                                                <?php 
                                                    if($experiences[$j]['description']){
                                                ?>
                                                <div class="well">
                        <h4>Details</h4>
                        <p class="text-justify"><?=$experiences[$j]['description']?></p>
                    </div>
                    <?php 
                        }
                    ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                                 <?php
                            $j++;
                            if($j%2==0) {
                                break;
                            }

                        } ?>
                        </div>
                        <?php 
                       } 
                   } else {
                        ?>
                        <p align="center" style="color:red"><b>::NO EXPERIENCES TO SHOW::</b></p>
                        <?php } ?>
            </div>
          </div>
      </div>
     </div>
    </div>
   </div>

<script src="<?=base_url();?>assets/ckeditor/ckeditor_js/ckeditor.js"></script>   
<script type="text/javascript">
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


    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('content');
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
            url: "<?=base_url().'employer_profile/send_email'; ?>",
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
</script>