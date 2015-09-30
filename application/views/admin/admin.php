<script type="text/javascript">
var siteurl='<?=base_url()?>';
</script>

 <!-- DataTables JavaScript -->
    <script src="<?=base_url()?>admin/template/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?=base_url()?>admin/template/js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable( {
        stateSave: true
    });
    });
    </script>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
    $this->load->view('admin/common/header');
?>

<?php
    $this->load->view('admin/common/sidenav');
?>

  <?php
        $this->load->view($main);
    ?>
<?php
    $this->load->view('admin/common/footer');
?>