<?php

define('TEMPLATEURL', get_template_directory_uri() );
define('TEMPLATE_PATH',get_template_directory());

if(!defined('RAB_DOMAIN'))
define('RAB_DOMAIN','rab_domain');

define('RAB_VERSION','1.0');

require get_template_directory() . '/class/class_post.php';
require get_template_directory() . '/inc/index.php';
require get_template_directory() . '/woo/index.php';
require get_template_directory() . '/admin/options.php';
require get_template_directory() . '/inc/rab_ajax_action.php';



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
		add_filter( $tag, array( $this, $function_to_add), $priority, $accepted_args );
	}

	public function __construct(){

		$this->options = RAB_Option::get_option();

		$this->add_action( 'after_setup_theme', 'after_setup_rabtheme' );
		$this->add_action( 'init', 'rab_init_first', 1 );
		$this->add_action( 'init', 'rab_init_second', 5 );
		$this->add_action( 'init', 'rab_init_thirst', 10 );
		$this->add_action( 'wp_head', 'rab_wp_head' );

		//$this->add_action( 'wp_footer', 'rab_wp_footer');
		/*
		 * Scrip hook and access
		 */

		$this->add_action( 'wp_enqueue_scripts', 'rab_enqueue_scripts' );
		$this->add_action( 'wp_print_scripts', 'rab_deenqueue_scripts' );
		$this->add_action( 'wp_print_footer_scripts', 'rab_print_footer_scripts', 13);
		/** END SCRIPT  */

		$this->add_action( 'widgets_init', 'rab_widgets_init' );
		$this->add_filter( 'post_thumbnail_html', 'rab_thumbnail_html', 10, 3 );

		/**
		 * Filter content
		 */
		//$this->add_action( 'excerpt_more', 'new_excerpt_more');
		$this->add_action( 'get_the_excerpt', 'new_excerpt_more');

		//$this->add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
		/**
		 * Thumbnail filter
		 */
		$this->add_filter( 'intermediate_image_sizes_advanced', 'rab_remove_default_image_sizes', 103 );
		$this->add_filter('wp_title', 'ra_wp_title', 10 , 2 );

	}
	/**
	 * catch hook after_setup_theme and process.
	 * @return [type] [description]
	 */
	function after_setup_rabtheme(){

		add_theme_support( 'less', array(
		    'enable'  => true,
		    'develop' => true,
		    'watch'  => true
		) );

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-header' );
		add_theme_support( 'post-formats' );
		add_theme_support( 'automatic-feed-links' );

		$locations 	= array(
			'main_menu' =>__('Main Menu',RAB_DOMAIN),
			'left_menu' =>__('Left Menu',RAB_DOMAIN) );

		register_nav_menus( $locations );
	}

	/**
	 * deenque some js  default file of WordPress.
	 * @author danng
	 * @version 1.0
	 * @return remove js from enqueue array
	 */
	function rab_deenqueue_scripts(){
		//wp_dequeue_script('jquery');
	}
	/**
	 * print js into footer theme. Need use varial PHP to generator it.
	 * @return javasript in footer
	 * @version 1.0
	 * @author danng
	 */
	function rab_print_footer_scripts(){
		?>
		<script type="text/javascript">

			(function($){
				$(document).ready(function(){

					jQuery.extend(jQuery.validator.messages	, {
					    required: "<?php _e("This field is required", RAB_DOMAIN); ?>",
					    remote: "<?php _e("Please fix this field.",RAB_DOMAIN); ?>",
					    email: "<?php _e("Please enter a valid email address.",RAB_DOMAIN); ?>",
					    url: "<?php _e("Please enter a valid URL.",RAB_DOMAIN);?>",
					    date: "<?php _e("Please enter a valid date.",RAB_DOMAIN); ?>",
					    dateISO: "<?php _e("Please enter a valid date (ISO).",RAB_DOMAIN);?>",
					    number: "<?php _e("Please enter a valid number.",RAB_DOMAIN);?>",
					    digits: "<?php _e("Please enter only digits.", RAB_DOMAIN) ?>",
					    creditcard:"<?php _e("Please enter a valid credit card number.", RAB_DOMAIN); ?>",
					    equalTo: "<?php _e("Please enter the same value again.", RAB_DOMAIN); ?>",
					    accept: "<?php _e("Please enter a value with a valid extension.", RAB_DOMAIN);?>",
					    maxlength: jQuery.validator.format("<?php _e("Please enter no more than {0} characters.", RAB_DOMAIN);?>" ),
					    minlength: jQuery.validator.format("<?php _e("Please enter at least {0} characters.", RAB_DOMAIN); ?>" ),
					    rangelength: jQuery.validator.format("<?php _e("Please enter a value between {0} and {1} characters long.", RAB_DOMAIN); ?>"),
					    range: jQuery.validator.format("<?php _e("Please enter a value between {0} and {1}.", RAB_DOMAIN); ?>"),
					    max: jQuery.validator.format("<?php _e("Please enter a value less than or equal to {0}." ,RAB_DOMAIN); ?>"),
					    min: jQuery.validator.format("<?php _e("Please enter a value greater than or equal to {0}.", RAB_DOMAIN); ?>")
					});

					$(window).load(function() {
					  // The slider being synced must be initialized first
					  $('#carousel').flexslider({
					    animation: "slide",
					    controlNav: false,
					    animationLoop: false,
					    slideshow: false,
					    itemWidth: 195,
					    itemMargin: 0,
					    asNavFor: '#slider'
					  });
					  $('#slider').flexslider({
					    animation: "slide",
					    controlNav: false,
					    animationLoop: false,
					    slideshow: false,
					    sync: "#carousel"
					  });
					});

				})

			})(jQuery);
		</script>

		<?php

	}
	/**
	 * register new script, style and enquee js to theme
	 * @author danng
	 * @version 1.0
	 * @return  add js to enquery array.
	 */
	function rab_enqueue_scripts(){

		wp_register_script( 'jquery.ajax','http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js',array(),false,false);
		wp_register_script( 'jquery.validation',TEMPLATEURL.'/js/jquery.validate.min.js', array('jquery'));
		wp_register_script( 'jquery.flexslider',TEMPLATEURL.'/js/jquery.flexslider.js',array('jquery'));
		wp_register_script( 'front',TEMPLATEURL.'/js/front.js', array('jquery','jquery.validation'), RAB_VERSION, true);
		wp_register_script( 'demo',TEMPLATEURL.'/js/demo.js',array('jquery','jquery.flexslider'));
		wp_register_style( 'flex.slider',TEMPLATEURL.'/css/flexslider.css');

		/**
		 * BOOTSTRAP JAVASCRIPT
		 */
		wp_register_script( 'bootstrap-js',get_stylesheet_directory_uri().'/bootstrap/js/bootstrap.min.js');
		wp_register_script( 'bootstrap-button-js',get_stylesheet_directory_uri().'/bootstrap/js/bootstrap.min.js', array('bootstrap-js'));

		//END BOOTSTRAP
		wp_enqueue_style( 'rab-style', get_stylesheet_uri() );
		wp_enqueue_script( 'jquery.validatio');
		wp_enqueue_script( 'front');
		wp_localize_script( 'front','rab_global',
			array(
				'ajaxUrl' 	=> admin_url( 'admin-ajax.php' ),
				'validate' 	=> array(
					'required_user_name'  	=> __('The user name field is required',RAB_DOMAIN),
					'required_user_email' 	=> __('The email field is required',RAB_DOMAIN),
					'required_content' 	  	=> __('The content field is required',RAB_DOMAIN),
					'required_phone' 	  	=> __('The number phone field is required',RAB_DOMAIN),
				)
			)

		);

		wp_enqueue_script( 'bootstrap-button-js' );

	}

	function rab_init_first(){

		//load_textdomain(RAB_DOMAIN, get_template_directory().'/lang/vi_VI.mo');

		rab_register_post_type();
	}

	function rab_init_second(){
		rab_register_post_type();
	}

	function rab_init_thirst(){

	}
	/**
	 * add style into header theme
	 * render like html
	 */

	public function rab_wp_head(){
		global $number_column, $col_bootrap, $content_class, $theme_layout;
        $theme_layout = get_theme_mod('theme_layout', '');

        $number_column  = 3;
        $content_class  = 'col-lg-9 col-md-9';
        $col_bootrap    = "col-md-4 col-sm-4 col-xs-12 ";

        if($theme_layout == 'one-column'){
            $number_column = 4;
            $col_bootrap ="col-md-3 col-sm-4 col-xs-4";
            $content_class = '';
        }

		$font 		  	= ra_get_google_font();
		$google_script 	= ra_get_google_script();

		if( is_array( $font )  ){
			wp_enqueue_style('google-font',$font['url']);
			echo ra_get_google_script();
		}

		if ( !empty( $google_script ) )
			echo $google_script;
		?>

			<style type="text/css">
			body p,body,body .post-content{
					font-family: <?php echo $font['title']?>,Arial,Verdana,sans-serif;
					color: #333;
					font-size: 14px;
					outline-color: #333;
				}
			</style>
		<?php

			wp_enqueue_style('bootraps-css', get_stylesheet_directory_uri().'/bootstrap/css/bootstrap.css');
			wp_enqueue_style('bootraps-grid', get_stylesheet_directory_uri().'/bootstrap/css/grid.css');
			wp_enqueue_style('front-rab', get_stylesheet_directory_uri().'/font/css/font-awesome.min.css');
			wp_enqueue_style('rab-style-custom', get_stylesheet_directory_uri().'/custom.css');
			wp_enqueue_style('rab-style-clone', get_stylesheet_directory_uri().'/css/clone.css');
	}
	public function rab_wp_footer(){
		wp_enqueue_script('jquery.ajax');
		$http  = is_ssl() ? 'https'  : 'http';
		wp_enqueue_script('bootstrap-js',get_stylesheet_directory_uri().'/bootstrap/js/bootstrap.min.js');
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

		register_widget( 'RAB_Widget_Product_Categories' );
		register_widget( 'RAB_Facebook_Fan_Page' );
		register_widget( 'RAB_Twitter_Time_line' );
		register_widget( 'RAB_Slider_Widget' );

	}
	/**
	 * get html for case that the post no thumbnail.
	 */

	function rab_thumbnail_html($html, $post_id, $post_image_id){

		if(!has_post_thumbnail($post_id) || empty($html)){
			$html = '<img src="' . get_stylesheet_directory_uri() . '/images/no-images.png" title ="'.get_the_title($post_id).'"  alt ="'.get_the_title($post_id).'"  />';
		}
		return $html;

	}
	/**
	 * add the button readmore when use code the_excerpt.
	 * @param  the button reamore html.
	 * @return  html of buton readmore
	 */
	function new_excerpt_more($more) {
       	global $post;
		return $more.'<p><a class="moretag" href="'. get_permalink($post->ID) . '">'.__('Read more',RAB_DOMAIN).'&nbsp; &#155; <span>&#155;</span> </a></p>';
	}

	function custom_excerpt_length( $length ) {
			return 20;
	}
	/**
	 * filter  wp_title default of WordPress
	 * @param   string $title default title
	 * @param  character $sep   |
	 * @return  title text
	 */
	function ra_wp_title( $title, $sep ) {
	
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );

	return $title;
}


	/**
	 * remove size of post thumbnail.
	 * @param  [type] $sizes [description]
	 * @return [type]        [description]
	 */
	function rab_remove_default_image_sizes( $sizes) {
	    unset( $sizes['shop_thumbnail']);
	    unset( $sizes['shop_catalog']);
	    unset( $sizes['shop_single']);
	    unset( $sizes['thumbnail']);

	    return $sizes;
	}
	/**
	 * [__destruct description]
	 */
	public function __destruct(){

	}
}

new RAB_Site();



?>