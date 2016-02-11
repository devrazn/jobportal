<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
    $this->load->view('common/header');
?>

    <div class="container">
   <div class="single">

   	<h2><?=$cms_contents['head_text']?></h2>
       <div class="about_top">
	     <div class="box_7">
  			<div class="list styled custom-list custom-list1">
  				<?=$cms_contents['content']?>
			</div>
	     </div>
	     <div class="clearfix"> </div>
	   </div>

    </div>
</div>

<?php
    $this->load->view('common/footer');
?>