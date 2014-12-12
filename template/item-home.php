<div class="item-home col-md-3">                       
	<?php
	global $post;
	$meta 	= new Rab_Post(get_the_ID());	
	$views 	= (int)$meta->get_post_views();	
	$votes 	= (float)$meta->get_post_votes();
	echo '<h5 class="post-title title"><a href="'.get_permalink().'">' .get_the_title().'</a></h5>';
	echo '<div class="item-post-des">';
		the_post_thumbnail('thumbnail-show');
	echo '</div>';
	?>
	<div class="show-hover-bg"></div>
	<div class="show-hover">
		<span class="icon-eye left">&nbsp;</span> <span class="post-views"> <?php echo $views;?></span>
		<span class="right"> 
		<?php 
		$class  = '';
		for($i=0; $i < 5; $i++){

		
			if($votes > $i && $votes > $i + 1){
				//echo '1a.';
				$class = 'icon-star';

			}else if($votes > $i && $votes < $i + 1){
				//echo '2a.';
				$class = 'icon-star2';

			} else if($votes < $i){
				//echo '3a';
				$class = 'icon-star3';
			}
			echo '<span class="'.$class.'"></span>';
		}
		?>
		</span>
		

	</div>


</div>