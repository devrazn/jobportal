<div class="col-md-4">
	   	  <div class="col_3">
	   	  	<h3>Recent Jobs</h3>
	   	  	<ul class="list_1">
	   	  	<?php
	   	  		foreach($sidebar_jobs as $menu_item):
	   	  	?>
	   	  		<li><a href="#"><?php echo $menu_item["title"]; ?></a></li>
	   	  		<?php
	   	  			endforeach;
	   	  		?>
	   	  	</ul>
	   	  </div>
	   	  <div class="col_3">
	   	  	<h3>Jobs by Category</h3>
	   	  	<ul class="list_2">
	   	  	<?php
	   	  		foreach($sidebar_categories as $menu_item):
	   	  	?>
	   	  		<li>
	   	  			<a href="<?=base_url().'category/'.$menu_item['url']?>">
	   	  				<?php echo $menu_item["name"]; ?>
	   	  			</a>
	   	  		</li>
	   	  		<?php
	   	  			endforeach;
	   	  		?>
	   	  	</ul>
	   	  </div>
	 </div>