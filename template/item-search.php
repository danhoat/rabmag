<div class="item-result row">                       
	<?php
	global $post;
	$meta 	= new Rab_Post(get_the_ID());	
	$views 	= (int)$meta->get_post_views();	
	$votes 	= (float)$meta->get_post_votes();
	echo '<h5 class="post-title title"><a href="'.get_permalink().'">' .get_the_title().$views.'</a></h5>';
	echo '<div class="item-post-thumbnail col-sm-3">';
		the_post_thumbnail('thumbnail');
	echo '</div>';
	echo'<div class ="item-post-des col-sm-8">';
	the_excerpt();
	echo '</div>';
	?>

</div>