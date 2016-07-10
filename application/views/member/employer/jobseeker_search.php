<div class="col-md-9 single_right">
	      <div class="but_list">
	       <div data-example-id="togglable-tabs" role="tabpanel" class="bs-example bs-example-tabs">
			<ul role="tablist" class="nav nav-tabs" id="myTab">
			  <li class="active" role="presentation"><a aria-expanded="true" aria-controls="home" data-toggle="tab" role="tab" id="home-tab" href="#home">Search results for "<?=$title?>"</a></li>
			</ul>
		<div class="tab-content" id="myTabContent">
		  <div aria-labelledby="home-tab" id="home" class="tab-pane fade active in" role="tabpanel">

		  <?php
		  if(count($search_results)  > 0) {
		  	foreach($search_results as $search_result) {
		  ?>
		    <div class="tab_grid">
			    <div class="col-sm-3 loc_1">
			    	<a href="<?=base_url().'employer_profile/jobseeker/'.$search_result['id']?>"><img class="img-responsive img-rounded" style="height: 140px; width: 100%; display: block;" data-holder-rendered="true" src="<?=base_url().'uploads/user/images/'.$search_result['image']?>" alt="<?=$search_result['f_name'].' '.$search_result['l_name']?>" title="<?=$search_result['f_name'].' '.$search_result['l_name']?>" data-src="holder.js/100%x180"></a>
			    </div>
			    <div class="col-sm-9">
			       <div class="location_box1">
			    	 <h6><a href="<?=base_url().'employer_profile/jobseeker/'.$search_result['id']?>"><?=$search_result['f_name'].' '.$search_result['l_name']?> </a>
			    	 	</h6>
			    	 <p><span class="m_2">Gender : </span><?php echo $search_result['gender'] ? "Male": "Female"; ?></p>
			    	 <p>	
			    	 	<?=substr($search_result['profile'], 0, 155)?> <?php if(strlen($search_result['profile']) > 155) {echo "...";} ?>
			    	 </p>
			    	 <ul class="links_bottom">
		  		    	<!-- <li><a href="location_single.html"><i class="fa fa-envelope-o icon_1"> </i><span class="icon_text">Email this Job</span></a></li> -->
			  			<li><a href="<?=base_url().'employer_profile/jobseeker/'.$search_result['id']?>"><i class="fa fa-eye icon_1"> </i><span class="icon_text">View full Profile</span></a></li>
			  			<li class="last"><a href="<?=base_url().'uploads/user/resume/'.$search_result['id'].'/'.$search_result['resume']?>"> <i class="fa fa-download" aria-hidden="true"> </i> <span class="icon_text"> Download Resume</span></a></li>
					 </ul>
				   </div>
			    </div>
			    <div class="clearfix"> </div>
			 </div>
			 <?php
			 	}
			 	echo $pagination_links;
			 } else { ?>
			 	<p align="center" style='color:red'><b>No jobseeker found matching your query.</b></p>
			 	<?php } ?>
		  </div>
		  
	  </div>
     </div>
    </div>
   </div>