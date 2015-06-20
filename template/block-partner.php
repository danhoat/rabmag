<?php
	// The Query
	$args = 'post_type=partner';
	query_posts( $args );

	// The Loop
	if ( have_posts() ):
		echo '<div class ="row block-partner">';
		echo '<div class ="col-lg-12 col-sm-12 col-xs-12 test">';
		echo '<h3 class ="title main-title">'.__('Our Parner',RAB_DOMAIN).'</h2>';
		echo '</div>';
		echo '<div class="tabs">';
			while ( have_posts() ) : the_post();
			    echo ' <div class="col-md-3  col-xs-12 col-sm-3 portfolio-item">';
			    //the_title();
			    if(has_post_thumbnail())
			    	the_post_thumbnail('medium');
			    echo '</div>';
			endwhile;
		echo '</div>';
		echo '</div>';
	endif;

	// Reset Query
	wp_reset_query();
	add_action('wp_footer','add_flex_slider', 16);
	function add_flex_slider(){
		?>
		<script type = "text/javascript">
			(function($){

				$(document).ready(function(){
			 		$('.test').flexslider({
		              	animation: 'slide',
		              	animationSpeed:400,
		              	animationLoop: true,
		              	itemWidth: '100%',
		              	slideshowSpeed : 5000,
		              	itemMargin: 0,
		                controlNav: true,
		                slideshow: true,

		            });
				});
			})(jQuery);
		</script>
		<?php
	}
?>

