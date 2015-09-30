<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
    $this->load->view('admin/common/header');
?>

<?php
    $this->load->view('admin/common/sidenav');
?>

 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2><?php echo $this->uri->segment(2); ?></h2> <small><h2><?php echo $this->uri->segment(3); ?></h2></small>
                        <!-- <h1 class="page-header">
                        </h1> -->

                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i><?php if($this->uri->segment(1)!='') echo ' '.$this->uri->segment(1);?>
                                <?php if($this->uri->segment(2)!='') echo '/ '.$this->uri->segment(2);?>
                          
                        </li>
                        </ol>
                        
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

<?php
    $this->load->view('admin/common/alert');
?>

                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    
<?php
    $this->load->view('admin/common/footer');
?>