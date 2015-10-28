<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <?='Dashboard'?>
      </div>
      <div class="panel-body">
        <div class="row">

            <div id="cl-wrapper" class="fixed-menu" style="height:auto !important;">
              <div class="container-fluid" id="pcont">
                <div class="stats_bar">
                    <div class="butpro butstyle">
                      <div class="sub"><h4>Admin Users</h4></div>
                      <div class="stat"><a href="<?=base_url().'admin/user';?>"><img src="<?=base_url()?>images/users.png" /></a> </div>
                    </div>

                    <div class="butpro butstyle">
                      <div class="sub"><h4>Site Setting</h4></div>
                      <div class="stat"><a href="<?=base_url().'admin/settings';?>"><img src="<?=base_url()?>images/site_setting.png" /></a> </div>
                    </div>

                    <div class="butpro butstyle">
                        <div class="sub"><h4>Contact Details</h4></div>
                        <div class="stat"><a href="<?=base_url().'admin/settings/contact_details';?>"><img src="<?=base_url()?>images/search_index.png" /></a> </div>
                    </div>

                    <div class="butpro butstyle">
                      <div class="sub"><h4>Change password</h4></div>
                      <div class="stat"><a href="<?=base_url().'admin/settings/change_password';?>"><img src="<?=base_url()?>images/change_password.png" /></a> </div>
                    </div>  

                    <div class="butpro butstyle">
                        <div class="sub"><h4>Mail Settings</h4></div>
                        <div class="stat"><a href="<?=base_url().'admin/settings/email_templates';?>"><img src="<?=base_url()?>images/mail_settings.png" /></a> </div>
                    </div>

                    <div class="butpro butstyle">
                        <div class="sub"><h4>Newsletter</h4></div>
                        <div class="stat"><a href="<?=base_url().'admin/newsletter';?>"><img src="<?=base_url()?>images/newsletter.png" /></a> </div>
                    </div>

                    <div class="butpro butstyle">
                      <div class="sub"><h4>Cms</h4></div>
                      <div class="stat"><a href="<?=base_url().'admin/settings/cms';?>"><img src="<?=base_url()?>images/cms.png" /></a> </div>
                    </div> 

                    <div class="butpro butstyle">
                      <div class="sub"><h4>Job Category</h4></div>
                      <div class="stat"><a href="<?=base_url().'admin/category';?>"><img src="<?=base_url()?>images/category.png" /></a> </div>
                    </div>

                    <div class="butpro butstyle">
                      <div class="sub"><h4>Tags Management</h4></div>
                      <div class="stat"><a href="<?=base_url().'admin/tags';?>"><img src="<?=base_url()?>images/photo_gallery.png" /></a> </div>
                    </div>

                    <div class="butpro butstyle">
                      <div class="sub"><h4>Registered Users</h4></div>
                      <div class="stat"><a href="<?=site_url(ADMIN_PATH.'/member_new')?>"><img src="<?=base_url()?>images/member.png" /></a> </div>
                    </div>    
                </div>
              </div>
            </div>

        </div>
        <!-- row -->
      </div>
      <!-- panel-body -->
    </div>
    <!-- panel panel-default -->  </div>
  <!-- col-lg-12 -->
</div>
<!-- row -->