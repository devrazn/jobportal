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