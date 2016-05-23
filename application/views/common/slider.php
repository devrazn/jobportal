<div class="grid_1">
	<h3>Featured Employers</h3>
	<ul id="flexiselDemo3">
		<?php
			foreach ($sliders as $slider):
		?>
		<li>
			<a href="<?=base_url().'employer/'.$slider['id']?>">
				<img src="<?=base_url();?>uploads/user/images/banner/<?=$slider['image']?>" class="img-responsive" alt="<?=$slider['f_name']?>" title="<?=$slider['f_name']?>"/>
			</a>
		</li>
		<?php
			endforeach;
			?>
		<li><img src="<?=base_url();?>assets/user/images/c2.gif"  class="img-responsive" /></li>
		<li><img src="<?=base_url();?>assets/user/images/c3.gif"  class="img-responsive" /></li>
		<li><img src="<?=base_url();?>assets/user/images/c4.gif"  class="img-responsive" /></li>
		<li><img src="<?=base_url();?>assets/user/images/c5.gif"  class="img-responsive" /></li>
		<li><img src="<?=base_url();?>assets/user/images/c6.gif"  class="img-responsive" /></li>	
	</ul>
</div>

<script type="text/javascript" src="<?=base_url();?>assets/user/js/jquery.flexisel.js"></script>
<script type="text/javascript">
	$(window).load(function() {
		$("#flexiselDemo3").flexisel({
			visibleItems: 6,
			animationSpeed: 1000,
			autoPlay:false,
			autoPlaySpeed: 3000,    		
			pauseOnHover: true,
			enableResponsiveBreakpoints: true,
			responsiveBreakpoints: { 
				portrait: { 
					changePoint:480,
					visibleItems: 1
				}, 
				landscape: { 
					changePoint:640,
					visibleItems: 2
				},
				tablet: { 
					changePoint:768,
					visibleItems: 3
				}
			}
		});
	});
</script>