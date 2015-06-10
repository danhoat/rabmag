<?php
	// The Query
	$args = 'post_type=partner';
	query_posts( $args );

	// The Loop
	if ( have_posts() ):
		echo '<div class="row">';
		while ( have_posts() ) : the_post();
		    echo ' <div class="col-md-3 portfolio-item">';
		    //the_title();
		    if(has_post_thumbnail())
		    	the_post_thumbnail();
		    echo '</div>';
		endwhile;
		echo '</div>';
	endif;

	// Reset Query
	wp_reset_query();
?>

