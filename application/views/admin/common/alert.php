<?php
if ($this->session->userdata('flash_msg_type'))
{
    if ($this->session->userdata('flash_msg_type'))
    {
        $flash_class = $this->session->userdata('flash_msg_type');
        $this->session->unset_userdata('flash_msg_type');
    }
    else
    {
        $flash_class = "info";
    }
    

?>
<div class="alert alert-<?php echo $flash_class; ?> fade in" role="alert" >
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
<?php echo $this->session->flashdata('flash_msg'); ?>
</div>
<?php
    
}
?>