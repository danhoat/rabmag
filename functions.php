<?php

define('TEMPLATEURL', get_bloginfo('template_url') );
define('TEMPLATE_PATH',get_template_directory());
if(!defined('RAB_DOMAIN'))
define('RAB_DOMAIN','rabtheme');

require get_template_directory() . '/class/class_post.php';
require get_template_directory() . '/inc/index.php';
require get_template_directory() . '/woo/index.php';
require get_template_directory() . '/admin/options.php';


if(is_admin()){
	// Code for backend control.
	require get_template_directory() . '/admin/admin.php';
}


Class RAB_Site{
	protected $options = null;
	/**
	 * auto run init theme.
	 */
	public function add_action( $hook, $function_to_add, $priority = 10, $accepted_args = 1 ){
		add_action($hook, array($this, $function_to_add), $priority, $accepted_args);
	}
	public function add_filter( $tag, $function_to_add, $priority = 10, $accepted_args =1 ){
		add_filter( $tag, array($this, $function_to_add), $priority, $accepted_args );
	}
	public function __construct(){
		$this->options = RAB_Option::get_option();

		$this->add_action( 'after_setup_theme', 'after_setup_rabtheme');
		$this->add_action( 'init','rab_init');
		$this->add_action( 'wp_head', 'rab_wp_head');
		$this->add_action( 'wp_footer', 'rab_wp_footer');
		$this->add_action( 'wp_enqueue_scripts', 'rab_enqueue_scripts');

		$this->add_action( 'widgets_init', 'rab_widgets_init');
		$this->add_filter( 'post_thumbnail_html', 'rab_thumbnail_html', 10, 3 );

	}
	function after_setup_rabtheme(){
		add_theme_support( 'less', array(
		    'enable'  => true,
		    'develop' => true,
		    'watch'  => true
		) );
		// add_theme_support( 'less', array(
		//     'minify' => true
		// ) );
		add_theme_support('post-thumbnails' );
		add_image_size( 'thumbnail-show', '207','207', true );
		add_theme_support('custom-header');
		add_theme_support('post-formats');
		$locations 	= array('header'=>__('Header Menu',RAB_DOMAIN));
		register_nav_menus( $locations );
	}
	function rab_enqueue_scripts(){
		wp_enqueue_style('rab-style', get_stylesheet_uri() );
		//wp_register_script('jquery.ajax','http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js',array(),false,false);
		//wp_enqueue_script('jquery.ajax');
	}
	function rab_init(){

		//wp_register_script('rab',TEMPLATEURL.'/js/rab.js');
		wp_dequeue_script('jquery');
		wp_register_script('jquery.ajax','http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js',array(),false,false);
		//
		//wp_register_script('jquery.easing',TEMPLATEURL.'/js/jquery.easing.js', array('jquery'));
		wp_register_script('jquery.flexslider',TEMPLATEURL.'/js/jquery.flexslider.js',array('jquery'));
		wp_register_script('demo',TEMPLATEURL.'/js/demo.js',array('jquery','jquery.flexslider'));
		wp_register_style('flex.slider',TEMPLATEURL.'/css/flexslider.css');
		//wp_register_style('flex.demo',TEMPLATEURL.'/css/demo.css');

		load_textdomain('RAB_DOMAIN', get_template_directory().'/lang/vi_VI.mo');
		ob_start();
		if(is_singular('post') || is_singular('product')){
			$this->rab_process_single();
		}
	}
	public function rab_wp_head(){

		wp_enqueue_style('google-font',$this->options['site_google_font']['url']);
		echo stripslashes($this->options['site_google_script']);
		?>

		<style type="text/css">
		body p,body,body .post-content{
				font-family: <?php echo $this->options['site_google_font']['title']?>,Arial,Verdana,sans-serif;
				color: #333;
				font-size: 14px;
				outline-color: #333;
			}
		</style>
		<?php
			wp_enqueue_style('bootraps-css', get_stylesheet_directory_uri().'/css/bootstrap.css');
			wp_enqueue_style('bootraps-grid', get_stylesheet_directory_uri().'/css/grid.css');
			wp_enqueue_style('front-rab', get_stylesheet_directory_uri().'/fonts.css');
			wp_enqueue_style('rab-style-custom', get_stylesheet_directory_uri().'/custom.css');
	}
	public function rab_wp_footer(){
		wp_enqueue_script('jquery.ajax');
		//wp_enqueue_script('backbone');
		//wp_enqueue_script('underscore');
		//wp_enqueue_script('plupload');
		//wp_enqueue_script('rab',get_stylesheet_directory_uri().'/js/rab.js',array('backbone','underscore','plupload'));
		$http  = is_ssl() ? 'https'  : 'http';
		wp_enqueue_script('bootstrap-js',get_stylesheet_directory_uri().'/js/bootstrap.min.js');
		wp_enqueue_style('google-fonts',$http.'://fonts.googleapis.com/css?family=PT+Sans+Narrow');
		wp_enqueue_style('google-font-content',$http.'://fonts.googleapis.com/css?family=Open+Sans&subset=latin,vietnamese');
	}

	function rab_process_single(){
		global $post;
		$id 	= $post->ID;
		$string = $id.'_is_visitor';

		if( !isset( $_COOKIE[$string] ) ){
			setcookie($string, 1 , time() + 3600);
			$meta = new Rab_Post($id);
			$meta->set_post_views();
		}
	}
	/**
	 * Init list widget for rab themes.
	 */

	function rab_widgets_init(){
		register_widget( 'RAB_Slider_Widget' );
		register_widget( 'RAB_Facebook_Fan_Page');
		register_widget( 'RAB_Twitter_Time_line');

	}
	/**
	 * get html for case that the post no thumbnail.
	 */

	function rab_thumbnail_html($html, $post_id, $post_image_id){

		if(!has_post_thumbnail($post_id) || empty($html)){
			$html = '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/no-images.png" title ="'.get_the_title($post_id).'"  alt ="'.get_the_title($post_id).'"  />';
		}
		return $html;

	}
	/**
	 * [__destruct description]
	 */
	public function __destruct(){

	}
}

new RAB_Site();

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
?>