<?php	global $theme_layout; ?>

<div id="sidebar" class="col-lg-3 col-md-3 visible-tablet-mobile main-sidebar <?php echo $theme_layout;?>">
	<?php
		if(is_active_sidebar('main')){
			dynamic_sidebar('main');
		}
	?>
</div>
