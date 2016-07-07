<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
    $this->load->view('common/header');
?>

    <div class="container">
   <div class="single">

    <?php
      if($this->session->userdata('user_type') == 2) {
        $this->load->view('common/employer_sidebar');
      } else {
        $this->load->view('common/jobseeker_sidebar');
      }
    ?>

	   	<?php
    		$this->load->view($page);
		?>
    </div>
</div>

<?php
    $this->load->view('common/footer');
?>