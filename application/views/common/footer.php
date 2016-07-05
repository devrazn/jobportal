<div class="footer">
	<div class="container">
		<div class="col-md-3 grid_3">
			<h4>Navigate</h4>
			<ul class="f_list f_list1">
				<li><a href="<?=base_url()?>">Home</a></li>
				<li><a href="<?=base_url()?>login">Sign In</a></li>
				<li><a href="<?=base_url()?>register">Join Now</a></li>
				<li><a href="<?=base_url()?>about_us">About</a></li>
				<li><a href="<?=base_url()?>f_a_qs">FAQs</a></li>
			</ul>
			<ul class="f_list">
				<li><a href="<?=base_url()?>t_a_c">Terms of Use</a></li>
				<li><a href="<?=base_url()?>how_it_works">How it Works</a></li>
				<li><a href="<?=base_url()?>advertise">Advertise</a></li>
				<li><a href="<?=base_url()?>contact_us">Contact Us</a></li>
			</ul>
			<div class="clearfix"> </div>
		</div>
		<div class="col-md-3 grid_3">
			<h4>Twitter Widget</h4>
			<div class="footer-list">
			  <ul>
				<li><i class="fa fa-twitter tw1"> </i><p><span class="yellow"><a href="#">consectetuer</a></span> adipiscing elit web design</p></li>
				<li><i class="fa fa-twitter tw1"> </i><p><span class="yellow"><a href="#">consectetuer</a></span> adipiscing elit web design</p></li>
				<li><i class="fa fa-twitter tw1"> </i><p><span class="yellow"><a href="#">consectetuer</a></span> adipiscing elit web design</p></li>
			  </ul>
			</div>
		</div>
		<div class="col-md-3 grid_3">
			<h4>Seeking</h4>
			<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. </p>
		</div>
		<div class="col-md-3 grid_3">
			<h4>Sign up for our newsletter</h4>
			<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam.</p>
			<form>
				<input type="text" class="form-control" placeholder="Enter your email">
				<button type="button" class="btn red">Subscribe now!</button>
		    </form>
		</div>
		<div class="clearfix"> </div>
	</div>
</div>

</body>
</html>


<script src="<?=base_url();?>assets/user/js/jquery-ui.min.js"></script>
<script type="text/javascript">
	$('#datepicker').datepicker({
		dateFormat: 'yy-mm-dd',
		changeYear: true,
		yearRange: "1950:" + new Date('y')
	});

	var baseUrl = "<?php echo base_url();?>";
</script>

<script type="application/x-javascript"> 
	addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
</script>