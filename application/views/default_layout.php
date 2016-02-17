<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
    $this->load->view('common/header');
?>

    <div class="container">
   <div class="single">

   <?php
        $this->load->view('common/sidebar');
    ?>

	   <?php
    		$this->load->view($page);
		?>
    </div>
</div>

<?php
    $this->load->view('common/footer');
?>