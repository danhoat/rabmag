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

	/**
	 * define all global method of rabtheme.
	 */

	/**
	 * register post_type in rab theme
	 */

	if( !function_exists( 'rab_register_post_type' ) ) :

		function rab_register_post_type() {

			$labels = array(
				'name'               => __( 'Partners',  RAB_DOMAIN ),
				'singular_name'      => __( 'Partner',  RAB_DOMAIN ),
				'menu_name'          => __( 'Partners', RAB_DOMAIN ),
				'name_admin_bar'     => __( 'Partners',  RAB_DOMAIN ),
				'add_new'            => __( 'Add New', RAB_DOMAIN ),
				'add_new_item'       => __( 'Add New Partner', RAB_DOMAIN ),
				'new_item'           => __( 'New Partner', RAB_DOMAIN ),
				'edit_item'          => __( 'Edit Partner', RAB_DOMAIN ),
				'view_item'          => __( 'View Partner', RAB_DOMAIN ),
				'all_items'          => __( 'All Partners', RAB_DOMAIN ),
				'search_items'       => __( 'Search Partners', RAB_DOMAIN ),
				'parent_item_colon'  => __( 'Parent Partners:',RAB_DOMAIN ),
				'not_found'          => __( 'No partners found.', RAB_DOMAIN ),
				'not_found_in_trash' => __( 'No partners found in Trash.', RAB_DOMAIN )
			);

			$args = array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'partner' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
			);

			register_post_type( 'partner', $args );
		}

	endif;

	/**
	 * paging  functional.
	 * @since 1.0
	 */

	function rab_pagination(){
	    global $wp_query;

	    $big = 999999999; // need an unlikely integer
	    echo '<nav class="woocommerce-pagination">';

	        echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
	            'base'         => esc_url( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
	            'format'       => '',
	            'current'      => max( 1, get_query_var( 'paged' ) ),
	            'total'        => $wp_query->max_num_pages,
	            'prev_text'    => '&larr;',
	            'next_text'    => '&rarr;',
	            'type'         => 'list',
	            'end_size'     => 3,
	            'mid_size'     => 3
	        ) ) );
	    echo '</nav>';
	}

	/**
	 * upload file via ajax.
	 *  @version 1.0
	 *  @author danng
	 */

	function rab_access_upload_file($file, $author = 0, $parent=0, $mimes=array() ){

	global $user_ID;
	$author = ( 0 == $author || !is_numeric($author) ) ? $user_ID : $author;

	if( isset($file['name']) && $file['size'] > 0){

		// setup the overrides
		$overrides['test_form']	= false;
		if( !empty($mimes) && is_array($mimes) ){
			$overrides['mimes']	= $mimes;
		}

		if(!function_exists( 'wp_handle_upload' )) {
			require_once(ABSPATH . "wp-admin" . '/includes/file.php');

		}
		// this function also check the filetype & return errors if having any
		$uploaded_file	=	wp_handle_upload( $file, $overrides );

		//if there was an error quit early
		if ( isset( $uploaded_file['error'] )) {
			return new WP_Error( 'upload_error', $uploaded_file['error'] );
		}
		elseif(isset($uploaded_file['file'])) {

			// The wp_insert_attachment function needs the literal system path, which was passed back from wp_handle_upload
			$file_name_and_location = $uploaded_file['file'];

			// Generate a title for the image that'll be used in the media library
			$file_title_for_media_library = preg_replace('/\.[^.]+$/', '', basename($file['name']));

			$wp_upload_dir = wp_upload_dir();

			// Set up options array to add this file as an attachment
			$attachment = array(
				'guid'				=> $uploaded_file['url'],
				'post_mime_type'	=> $uploaded_file['type'],
				'post_title'		=> $file_title_for_media_library,
				'post_content'		=> '',
				'post_status'		=> 'inherit',
				'post_author'		=> $author
			);

			// Run the wp_insert_attachment function. This adds the file to the media library and generates the thumbnails. If you wanted to attch this image to a post, you could pass the post id as a third param and it'd magically happen.
			$attach_id = wp_insert_attachment( $attachment, $file_name_and_location, $parent );
			require_once(ABSPATH . "wp-admin" . '/includes/image.php');
			$attach_data = wp_generate_attachment_metadata( $attach_id, $file_name_and_location );
			wp_update_attachment_metadata($attach_id,  $attach_data);
			return $attach_id;

		} else { // wp_handle_upload returned some kind of error. the return does contain error details, so you can use it here if you want.
			return new WP_Error( 'upload_error', __( 'There was a problem with your upload.', RAB_DOMAIN ) );
		}
	}
	else { // No file was passed
		return new WP_Error( 'upload_error', __( 'Template file update isssue?', RAB_DOMAIN ) );
	}

}

if( !function_exists( 'rab_sidebar') ) :

	function ra_sidebar(){

		global $theme_layout;

		if($theme_layout != 'one-column'){
			get_sidebar();
		}

	}

endif;
if( !function_exists( 'ra_list_google_fonts' )):

	function ra_list_google_fonts( $index = -1 ) {

		$google_fonts =  apply_filters( 'ra_list_google_fonts', array(

			'pt_sans' => array (

				'url' 	=> 'http://fonts.googleapis.com/css?family=PT+Sans',
				'title' => 'PT Sans'
			),
			'open_sans' => array (
				'url' 	=> 'http://fonts.googleapis.com/css?family=Open+Sans',
				'title' => 'Open Sans'
			),
			'droid_sans' => array (
				'url' 	=> 'http://fonts.googleapis.com/css?family=Droid+Sans',
				'title' => 'Droid Sans'
			),
			'droid_sans' => array (
				'url' 	=> 'http://fonts.googleapis.com/css?family=Droid+Sans',
				'title' => 'Droid Sans'
			),
			'slabo_27px' => array (
				'url' => 'http://fonts.googleapis.com/css?family=Slabo+27px',
				'title' =>'Slabo 27px',
			),
			'ubuntu' => array (
				'url'   => 'http://fonts.googleapis.com/css?family=Ubuntu',
				'title' =>'Ubuntu',
			),
			'lato' => array (
				'url'   => 'http://fonts.googleapis.com/css?family=Lato',
				'title' =>'Lato',
			)

		));

		if( isset($google_fonts[$index]) )
			return $google_fonts[$index];

		return $google_fonts;
	}

endif;

if ( !function_exists( 'ra_google_font') ):
	function ra_google_font(){

	}
endif;