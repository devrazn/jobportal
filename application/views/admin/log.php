<div class="row">
	<div class="col-lg-12">
    	<div class="panel panel-default">
      		<div class="panel-heading">
        		<?php 
              if($this->session->userdata('error_log_title')){
                echo $this->session->userdata('error_log_title');
              } else {
                echo 'Log Report';
              }
            ?>
      		</div>
          <!-- /.panel-heading -->
      		 <div class="panel-body">
        			<?php
                if($this->session->userdata('error_log')){
                  echo $this->session->userdata('error_log');
                } else {
                  echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;No recent error log available.</p>";
                }
              ?>
      		</div>
      		<!-- panel-body -->
    	</div>
    	<!-- /.panel panel-default -->  
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->