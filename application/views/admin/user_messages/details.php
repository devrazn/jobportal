<div class="row">
  <div class="col-lg-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <?='Message Details'?>
      </div>
      <div class="panel-body">
        <div class="row">
          
        <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <?=$message['subject']?>
                            <p class="pull-right">
                              <?=humanize_date_time($message['received_date_time'])?>
                            </p>
                        </div>
                        <div class="panel-body">
                            <p><?=$message['message']?></p>
                        </div>
                        <div class="panel-footer">
                        <?=$message['name']?>
                          <a href='javascript:void(0)' data-toggle="modal" data-target="#myModal" class="pull-right"><p class="fa fa-reply-all">
                            &lt<?=$message['email']?>&gt</p>
                          </a>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Email to <?php echo $message['name'] . ' &lt' . $message['email'] . '&gt'?></h4>
                                        </div>
                                        <div id='modal_body'  class="modal-body">
                                            <form role="form" id="email_form">
                                                <?php if(validation_errors()) echo "<div style='color:red'><b>Please enter the required fields correctly.</b></div>";?>          
                                                <div id='subject' class="form-group">
                                                    <label>Subject</label>
                                                    <input name="subject" type="text" class="form-control" size="50" value="re: <?=set_value('subject', $message['subject']);?>">
                                                    <?=form_error('subject')?>
                                                </div>

                                                <div id='content_div' class="form-group">
                                                    <label>Message</label>
                                                    <textarea id="content" name="content" rows="10" cols="80">
                                                    </textarea>
                                                    <?=form_error('content')?>
                                                </div>
                                                
                                                <input name='email' type='hidden' value="<?=$message['email']?>">
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

        </div>
        <a onClick="return doConfirm()" href="<?=site_url(ADMIN_PATH.'/messages/delete_message/'.$message['id']) ?>" data-toggle="tooltip" class="btn btn-danger pull-right">Delete <i class="fa fa-times"></i></a>
        
      </div>
      <!-- row -->
    </div>
    <!-- panel-body -->
  </div>
  <!-- panel panel-default -->
  </div>
  <!-- col-lg-12 -->
</div>
<!-- row -->

<script>
function doConfirm() {
  msg=confirm("Are you sure you want to delete this message Permanently?");
  if(msg != true) {
    return false;
  }
}
</script>

<script src="<?=base_url();?>assets/ckeditor/ckeditor_js/ckeditor.js"></script>
<script type="text/javascript">
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('content');
    });

    $(document).ready(function(){
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
                url: "<?=base_url().'admin/messages/reply'?>",
                data: values,
                dataType: 'json',
                beforeSend: function(){
                    $('#action_email').html("<img src='<?php echo base_url('assets/ajax/images/ajax-loader_dark.gif');?>' >");
                },

                success: function (data) {
                    $('#action_email').html(divHTML);
                    if(data['status']=='success') {
                        var responseHTML = "<div role='alert' class='alert alert-success fade in' id='alert'>" + 
                            "<button aria-label='Close' data-dismiss='alert' class='close' type='button'>" + 
                            "<span aria-hidden='true'>×</span>" +
                            "</button>" + 
                            data['message'] + 
                            "</div>";

                        $("#alert_parent").append(responseHTML);
                        $('#myModal').modal('hide');
                        $('html, body').animate({
                            scrollTop: $("body").offset().top
                        }, 1000);

                    } else if (data['status']=='validation_error') {
                            var responseHTML = "<p class='ci_error' style='color:red'><b>" + data["message"] + "</b></p>";

                            $("#modal_body").prepend(responseHTML);
                            if(data['subject']) {
                                $("#subject").append(data['subject']);
                            }
                            if(data['content']) {
                                $("#content_div").append(data['content']);
                            }
                            $('#myModal').scrollTop(0);                     

                    } else if (data['status']=='unknown_error') {
                      alert(data['message']);

                            var responseHTML = "<div role='alert' class='alert alert-danger fade in' id='alert'>" + 
                            "<button aria-label='Close' data-dismiss='alert' class='close' type='button'>" + 
                            "<span aria-hidden='true'>×</span>" +
                            "</button>" + 
                            data['message'] + 
                            " Click <a target='_blank' href='" + admin_path + "error_log'>here</a> to view the error log." +
                            "</div>";
                            $("#modal_body").prepend(responseHTML);
                            $('#myModal').scrollTo(".btn-danger");
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