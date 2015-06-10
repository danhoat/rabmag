<?php
	// The Query
	$args = 'post_type=partner';
	query_posts( $args );

	// The Loop
	if ( have_posts() ):
		echo '<ul>';
		while ( have_posts() ) : the_post();
		    echo '<li>';
		    //the_title();
		    if(has_post_thumbnail())
		    	the_post_thumbnail();
		    echo '</li>';
		endwhile;
		echo '</ul>';
	endif;

	// Reset Query
	wp_reset_query();
?>

