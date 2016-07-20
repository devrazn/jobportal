<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <!-- <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div> -->
            </li>
            <li>
                <a href="<?=base_url('admin');?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Settings<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?=base_url().'admin/settings/site_settings';?>">Site Settings</a>
                    </li>
                    <li>
                        <a href="<?=base_url().'admin/settings/email_settings';?>">Email Settings</a>
                    </li>
                    <li>
                        <a href="<?=base_url().'admin/settings/change_password';?>">Change Password</a>
                    </li>
                    <li>
                        <a href="<?=base_url().'admin/settings/email_templates';?>">Email Templates</a>
                    </li>
                    <li>
                        <a href="<?=base_url().'admin/settings/cms';?>">Content Management</a>
                    </li>
                    <li>
                        <a href="<?=base_url().'admin/settings/contact_details';?>">Contact Details</a>
                    </li>
                    <li>
                        <a href="<?=base_url().'admin/error_log';?>"><i class="fa fa-edit fa-fw"></i>Recent Error Log</a>
                    <li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="<?=base_url().'admin/user';?>"><i class="fa fa-edit fa-fw"></i>User Management</a>
            </li>

            <li>
                <a href="<?=base_url().'admin/messages';?>">
                    <i class="fa fa-envelope fa-fw"></i>
                    User Messages <?php 
                                    $new_msg = $this->helper_model->count_admin_new_messages();
                                    if($new_msg>0)
                                        echo "<b>(" . $new_msg . ")</b>";
                                ?>
                </a>
            </li>

            <li>
                <a href="<?=base_url().'admin/category';?>"><i class="fa fa-table fa-fw"></i>Job Category Management</a>
            </li>

            <li>
                <a href="<?=base_url().'admin/newsletter';?>"><i class="fa fa-table fa-fw"></i>Newsletters</a>
            </li>

            <li>
                <a href="<?=base_url().'admin/tags';?>"><i class="fa fa-table fa-fw"></i>Tags Management</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
        </nav>