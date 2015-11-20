<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
    $this->load->view('common/header');
?>

<div class="container">
    <div class="subcontent">
       <?=$content_middle?>
       </div>
    <!--sub content ends here--> 
</div>
<?php $this->load->view('common/footer');?>