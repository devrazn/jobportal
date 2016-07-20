<div class="col-md-8 single_right">
	      <div class="but_list">
	       <div data-example-id="togglable-tabs" role="tabpanel" class="bs-example bs-example-tabs">
			<ul role="tablist" class="nav nav-tabs" id="myTab">
			  <li class="active" role="presentation"><a aria-expanded="true" aria-controls="home" data-toggle="tab" role="tab" id="home-tab" href="#home">Search results for "<?=$title?>"</a></li>
			</ul>
		<div class="tab-content" id="myTabContent">
		  <div aria-labelledby="home-tab" id="home" class="tab-pane fade active in" role="tabpanel">

		  <?php
		  	foreach($search_results as $search_result):
		  ?>
		    <div class="tab_grid">
			    <div class="col-sm-3 loc_1">
			    	<a href="<?=base_url().'employer/'.$search_result['user_id']?>"><img style="height: 140px; width: 100%; display: block;" data-holder-rendered="true" src="<?=base_url().'uploads/user/'.$search_result['image']?>" alt="<?=$search_result['f_name']?>" title="<?=$search_result['f_name']?>" data-src="holder.js/100%x180"></a>
			    </div>
			    <div class="col-sm-9">
			       <div class="location_box1">
			    	 <h6><a href="<?=base_url().'jobs/'.$search_result['job_id']?>"><?=$search_result['title']?> </a>
			    	 	
			    	 	</h6>
			    	 <p><span class="m_2">Description : </span><?=$search_result["job_description"]?></p>
			    	 <p>	
			    	 	<span class="m_2">Posted : </span><?php echo humanize_date($search_result['published_date']);?> (<?echo calculate_age_with_unit($search_result['published_date'])?>)</br>
			    	 	<span class="m_2">Deadline : </span><?php echo humanize_date($search_result['deadline_date']);?> (<?echo calculate_age_with_unit($search_result['deadline_date'])?>)
			    	 </p>
			    	 <ul class="links_bottom">
		  		    	<!-- <li><a href="location_single.html"><i class="fa fa-envelope-o icon_1"> </i><span class="icon_text">Email this Job</span></a></li> -->
			  			<li><a href="<?=base_url().'jobs/'.$search_result['job_id']?>"><i class="fa fa-eye icon_1"> </i><span class="icon_text">View full Job Description</span></a></li>
			  			<li class="last"><a href="<?=base_url().'category/'.$search_result['url']?>"><i class="fa fa-sort-desc icon_1"> </i><span class="icon_text">View similar Jobs</span></a></li>
					 </ul>
				   </div>
			    </div>
			    <div class="clearfix"> </div>
			 </div>
			 <?php
			 	endforeach;
			 ?>
		  </div>
		  
	  </div>
     </div>
    </div>
   </div>