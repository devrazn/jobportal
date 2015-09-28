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