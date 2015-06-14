<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<div id="post-<?php the_ID(); ?>" class="post-item">
	<div class="col-sm-4">
	<?php rab_post_thumbnail('medium'); ?>
	</div>
	<div class="entry-header col-sm-8">

		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && rab_categorized_blog() ) : ?>
		<div class="entry-meta">
			<span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'twentyfourteen' ) ); ?></span>
		</div>
		<?php
			endif;
		?>

		<div class="entry-meta">
			<?php
			if ( is_single() ) :
				the_title( '<h3 class="entry-title">', '</h3>' );
			else :
				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			endif;
			?>
			<?php the_excerpt(); ?>
			<?php
				edit_post_link( __( 'Edit', RAB_DOMAIN ), '<span class="edit-link">', '</span>' );
			?>
		</div><!-- .entry-meta -->
		<?php if ( is_search() ) : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			?>
		</div><!-- .entry-content -->
		<?php endif; ?>
	</div>

</div><!-- #post-## -->
