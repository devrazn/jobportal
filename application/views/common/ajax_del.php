$(document).on('click', '.delete', function(event){    
        if( ! confirm("Are you sure to delete this <?=$ajax['name']?>?")){
          return false;
        } else {
        _this=$(this);
        var id = _this.attr('data');
        _this_tr_html = _this.closest('tr').html();

        jQuery.ajax({
          url: "<?=base_url().$ajax['request_controller']; ?>" + id,
          dataType: 'json',
          beforeSend: function(){
            _this.closest('tr').html("<td colspan='<?=$ajax['tbl_col_num']?>' align='center'><img src='<?php echo base_url('assets/ajax/images/ajax-loader_dark.gif');?>' ></td>");
          },
          success: function(data) {
            if(data['response']) {
              $('#tr_'+id).remove();
              var responseHTML = "<div role='alert' class='alert alert-success fade in' id='alert'>" + 
                            "<button aria-label='Close' data-dismiss='alert' class='close' type='button'>" + 
                            "<span aria-hidden='true'>×</span>" +
                            "</button>" + 
                            'Experience Deleted Successfully' + 
                            "</div>";
              $('.alert').remove();
              $(".alert_parent").append(responseHTML);
              $('html, body').animate({
                scrollTop: $("body").offset().top
              }, 1000);
            } else {
              $('#tr_'+id).html(_this_tr_html);
              var responseHTML = "<div role='alert' class='alert alert-danger fade in' id='alert'>" + 
                            "<button aria-label='Close' data-dismiss='alert' class='close' type='button'>" + 
                            "<span aria-hidden='true'>×</span>" +
                            "</button>" + 
                            data['message'] + 
                            "</div>";
              $('.alert').remove();
              $(".alert_parent").append(responseHTML);
              $('html, body').animate({
                scrollTop: $("body").offset().top
              }, 1000);
            }
          }
        }); 
      }              
    });