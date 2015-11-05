<!-- Page-Level Demo Scripts - Tables - Use for reference -->

<script type="text/javascript">
    var siteurl='<?=base_url()?>';
</script>

<script type="text/javascript">
	$(document).ready(function()
	{
	        $("#frm").validate({
	                            debug:false,
	                            onBlur:true,
	                            errorElement: "p",
	                            errorClass:"err"
	                                 });
	});
</script>

<script type="text/javascript">
		alertify.defaults.glossary.title= 'Job Portal';
		alertify.defaults.glossary.ok= 'Ok';
		alertify.defaults.glossary.cancel= 'Cancel';
</script>

</body>
</html>
