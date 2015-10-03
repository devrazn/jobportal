 <!-- jQuery -->
    <!--<script src="../bower_components/jquery/dist/jquery.min.js"></script>-->
    <script src="<?=base_url();?>assets/admin/template/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <!--<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>-->
    <script src="<?=base_url();?>assets/admin/template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <!--<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>-->
    <script src="<?=base_url();?>assets/admin/template/bower_components/metisMenu/dist/metisMenu.js"></script>

    <!-- Custom Theme JavaScript -->
    <!--<script src="../dist/js/sb-admin-2.js"></script>-->
    <script src="<?=base_url();?>assets/admin/template/dist/js/sb-admin-2.js"></script>

     <!-- DataTables JavaScript -->
    <script src="<?=base_url();?>assets/admin/template/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>assets/admin/template/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- DataTables JavaScript -->
    <!-- <script src="../assets/admin/template/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../assets/admin/template/js/plugins/dataTables/dataTables.bootstrap.js"></script> -->

    <!-- Custom Theme JavaScript -->

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

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

</body>

</html>
