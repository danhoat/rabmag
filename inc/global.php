<?php
	/**
	 * define all global method of rabtheme.
	 */

	/**
	 * register post_type in rab theme
	 */

	if( !function_exists( 'rab_register_post_type' ) ) :

		function rab_register_post_type(){

			$labels = array(
				'name'               => _x( 'Partners', 'post type general name', RAB_DOMAIN ),
				'singular_name'      => _x( 'Partner', 'post type singular name', RAB_DOMAIN ),
				'menu_name'          => _x( 'Partners', 'admin menu', RAB_DOMAIN ),
				'name_admin_bar'     => _x( 'Partners', 'add new on admin bar', RAB_DOMAIN ),
				'add_new'            => _x( 'Add New', 'partner', RAB_DOMAIN ),
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
?>