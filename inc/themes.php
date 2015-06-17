<?php
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
*/
function rab_post_thumbnail( $type ='thumbnail') {
	if ( post_password_required() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
	<?php
		if ( ( ! is_active_sidebar( 'sidebar-2' ) || is_page_template( 'page-templates/full-width.php' ) ) ) {
			the_post_thumbnail( 'twentyfourteen-full-width' );
		} else {
			the_post_thumbnail($type);
		}
	?>
	</div>

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>">
	<?php
		if ( ( ! is_active_sidebar( 'sidebar-2' ) || is_page_template( 'page-templates/full-width.php' ) ) ) {
			the_post_thumbnail( $type );
		} else {
			the_post_thumbnail($type);
		}
	?>
	</a>

	<?php endif; // End is_singular()
}

/**
 * Find out if blog has more than one category.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return boolean true if blog has more than 1 category
 */
function rab_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'twentyfourteen_category_count' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'twentyfourteen_category_count', $all_the_cool_cats );
	}

	if ( 1 !== (int) $all_the_cool_cats ) {
		// This blog has more than 1 category so twentyfourteen_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so twentyfourteen_categorized_blog should return false
		return false;
	}
}

if ( ! function_exists( 'rab_posted_on' ) ) :
/**
 * Print HTML with meta information for the current post-date/time and author.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function rab_posted_on() {
	if ( is_sticky() && is_home() && ! is_paged() ) {
		echo '<span class="featured-post">' . __( 'Sticky', 'twentyfourteen' ) . '</span>';
	}

	// Set up and print post meta information.
	printf( '<span class="entry-date"><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></span> <span class="byline"><span class="author vcard"><a class="url fn n" href="%4$s" rel="author">%5$s</a></span></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);
}
endif;

add_filter( 'body_class', 'add_post_class' );
function add_post_class($class){
	array_push($class,'row');
	return $class;

}
function rab_get_sidebar($layout){
	
	if($lyout == 'left_column'){
		get_sidebar();
	} else {
		
	}
}