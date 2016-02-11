<?php
if ($this->session->flashdata('flash_msg_public_user'))
{
    if ($this->session->userdata('flash_msg_type_public_user'))
    {
        $flash_class = $this->session->userdata('flash_msg_type_public_user');
        $this->session->unset_userdata('flash_msg_type');
    }
    else
    {
        $flash_class = "info";
    }
    

?>
<br>
    <div class="col-lg-12">
        <div class="alert alert-<?php echo $flash_class; ?> fade in" role="alert" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        <?php echo $this->session->flashdata('flash_msg_public_user'); ?>
        </div>
    </div>

<?php
}
?>