<div class="col-md-8">
  <?php
    foreach ($content_jobs as $job_item):
    ?>
        <div class="col_1">
            <div class="col-sm-4 row_2">
        <a href="<?=base_url().'jobs/'.$job_item['id']?>"><img src="<?=base_url().'uploads/user/'.$job_item['image']?>" class="img-responsive" alt=""/></a>
      </div>
      <div class="col-sm-8 row_1">
        <h4><a href="<?=base_url().'jobs/'.$job_item['id']?>"><?=$job_item['title']?></a></h4>
        <h6><?=$job_item['category_name']?> <span class="dot"></span><b>Deadline: </b> <?=$this->helper_model->print_humanize_date($job_item['deadline_date'])?></h6>
        <p><?=$job_item['job_description']?></p>
        <div class="social">  
          <a class="btn_1" href="#">
            <i class="fa fa-facebook fb"></i>
            <span class="share1 fb">Share</span>                
          </a>
          <a class="btn_1" href="#">
            <i class="fa fa-twitter tw"></i>
            <span class="share1">Tweet</span>               
          </a>
          <a class="btn_1" href="#">
            <i class="fa fa-google-plus google"></i>
            <span class="share1 google">Share</span>
          </a>
         </div>
      </div>
      <div class="clearfix"> </div>
       </div>
       <?php
        endforeach;
      ?>
     </div>
     <div class="clearfix"> </div>