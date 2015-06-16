<?php

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
			//require_once ABSPATH.'/wp-admin/includes/file.php';
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
		return new WP_Error( 'upload_error', __( 'Where is the file?', RAB_DOMAIN ) );
	}

}
?>