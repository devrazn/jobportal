$(document).ready(function(e) {
	$('body').on('click', '.twitter_share', function(e) {
		var getShareId = $(this).data('val'),
		twLink, fbLink,gLink;
		twLink = 'https://twitter.com/share?url=' + baseUrl + 'home/job_share/' + getShareId;
		$('.twitter_share').attr('href', twLink);
		var width = 575,
		height = 400,
		left = ($(window).width() - width) / 2,
		top = ($(window).height() - height) / 2,
		url = this.href,
		opts = 'status=1' +
		',width=' + width +
		',height=' + height +
		',top=' + top +
		',left=' + left;
		window.open(url, 'twitter', opts);
		return false;
	});

	$('body').on('click', '.facebook_share', function(e) {
 		e.preventDefault();
 		var getShareId = $(this).data('val');
 		fbLink = href = "https://www.facebook.com/sharer/sharer.php?src=bm&u=" + baseUrl + 'home/job_share/' + getShareId;
 		var x = $('.facebook_share').attr('href', fbLink);
 		window.open($(this).attr('href'), 'fbShareWindow', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
 		return false;
 	});

 	$('body').on('click', '.gmail_share', function(e) {
 		e.preventDefault();
 		var getShareId = $(this).data('val');
 		gLink = href = 'https://plus.google.com/share?url=' + baseUrl + 'home/job_share/' + getShareId;
 		var x = $('.gmail_share').attr('href', gLink);
 		window.open($(this).attr('href'), 'gmail', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
 		return false;
 	});
});

function setDelete(del_url,tbl_col_num,element,name) {
    _this=$(element);
    var id = _this.data('id');
    _this_tr_html = _this.closest('tr').html();
    var del_url = del_url;
    var loading_img = baseUrl+'assets/ajax/images/ajax-loader_dark.gif';
    var tbl_col_num = tbl_col_num;
    var name = name;

    alertify.confirm("Are you sure you want to perform this operation?", function (e) {
        if (e) {

            jQuery.ajax({
                url: baseUrl +del_url + id,
                dataType: 'json',
                beforeSend: function(){
                    _this.closest('tr').html("<td colspan='"+tbl_col_num+"' align='center'><img src='"+loading_img+"' ></td>");
                },
                success: function(data) {
                debugger;
                    if(data['response']) {
                        $('#tr_'+id).remove();
                            var responseHTML = "<div role='alert' class='alert alert-success fade in' id='alert'>" + 
                                        "<button aria-label='Close' data-dismiss='alert' class='close' type='button'>" + 
                                        "<span aria-hidden='true'>×</span>" +
                                        "</button>" + 
                                        name +'  Deleted Successfully' + 
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
        } else {
            return false;
        }
    }); 
}

function getAddress() {
    var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {});

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        console.log(place.address_components);
    });
}