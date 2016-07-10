<div class="col-lg-12 alert_parent" id="alert_parent">
<?php
if ($this->session->flashdata('user_flash_msg'))
{
    if ($this->session->userdata('user_flash_msg_type'))
    {
        $flash_class = $this->session->userdata('user_flash_msg_type');
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
        <?php echo $this->session->flashdata('user_flash_msg'); ?>
        </div>
    </div>

<?php
    //$this->session->unset_flashdata('user_flash_msg');
}
?>
</div>