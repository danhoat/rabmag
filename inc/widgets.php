<?php

	register_sidebar( array(
		'name'          => __( 'Main  Sidebar', 'rabsite' ),
		'id'            => 'main',
		'description'   => __( 'Main sidebar that appears on the left.', 'rabsite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => __( 'Top header  sidebar', 'rabsite' ),
		'id'            => 'header',
		'description'   => __( 'Header page.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => __( 'Top Content', 'rabsite' ),
		'id'            => 'top_content',
		'description'   => __( 'Top content.', 'rabsite' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
		)
	);

	register_sidebar( array(
		'name'          => __( 'Footer Sidebar', 'rabsite' ),
		'id'            => 'footer',
		'description'   => __( 'Main sidebar that appears on the bottom content.', 'rabsite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s col-sm-4">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Sidebar', 'rabsite' ),
		'id'            => 'footer',
		'description'   => __( 'Footer sidebar that appears on footer.', 'rabsite' ),
		'before_widget' => '<div id="%1$s" class="col-md-2 col-sm-4 col-xs-12 col-sm-6 widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="title-widget">',
		'after_title'   => '</h5>',
	) );




/**
 * facebook fan page widget
 */
class RAB_Facebook_Fan_Page extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'fb_fanpage', 'description' => __( 'A list of your site&#8217;s Pages.',RAB_DOMAIN) );
		parent::__construct('fb_fan', __('Facebook Fan Page',RAB_DOMAIN), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract($instance);
		echo $before_widget;
		if ( !empty($title) )
			echo $before_title . $title . $after_title;
		$show_post = isset($show_post) ? true :false;
		?>
		<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
		<div class="fb-like-box" data-href="<?php echo $fb_url;?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="<?php echo $show_post;?>" data-show-border="false"></div>

		<?php
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance 			= $old_instance;
		$instance['title'] 	= strip_tags($new_instance['title']);

		$instance['show_post'] 	=  $new_instance['show_post'] ;
		$instance['fb_url'] 	=  $new_instance['fb_url'] ;

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$instance 	= wp_parse_args( (array) $instance, array( 'fb_url' => 'https://www.facebook.com/FacebookDevelopers', 'title' => '', 'show_post' => 0) );
		extract($instance);
		$title 		= esc_attr( $instance['title'] );
		$show_post 	= isset( $instance['show_post'] ) ? 1 : 0;
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title',RAB_DOMAIN); ?> :</label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p>
			<label for="<?php echo $this->get_field_id('sortby'); ?>"><?php _e( 'Facebook Page Url',RAB_DOMAIN ); ?> :</label>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name('fb_url');?>" value="<?php echo esc_attr($fb_url);?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('exclude'); ?>"><?php _e( 'Show Posts',RAB_DOMAIN ); ?> :</label> 
			<input value="1" <?php if($show_post) echo 'checked ="checked"';?> type="checkbox" class="widefat" name="<?php echo $this->get_field_name("show_post");?>" />

		</p>
<?php
	}

}

class RAB_Twitter_Time_line extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'tw_time_line', 'description' => __( 'A list of your site&#8217;s Pages.',RAB_DOMAIN) );
		parent::__construct('tw_time_line', __('Twitter Time Line',RAB_DOMAIN), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract($instance);

		echo $before_widget;
		if ( !empty($title) )
			echo $before_title . $title . $after_title;
		?>
		<a class="twitter-timeline"  href="https://twitter.com/<?php echo $tw_url;?>"  data-widget-id="444870769135218688">Tweet to <?php echo $tw_url;?></a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>


		<?php
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance 			= $old_instance;
		$instance['title'] 	= strip_tags($new_instance['title']);
		$instance['tw_url'] 	=  $new_instance['tw_url'] ;

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$instance 	= wp_parse_args( (array) $instance, array( 'tw_url' => 'dangianguyen', 'title' => '', 'show_post' => 0) );
		extract($instance);

		$title 		= esc_attr( $instance['title'] );

	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title',RAB_DOMAIN); ?> : </label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p>
			<label for="<?php echo $this->get_field_id('sortby'); ?>"><?php _e( 'Twiter name',RAB_DOMAIN ); ?> : </label>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name('tw_url');?>" value="<?php echo esc_attr($tw_url);?>" />
		</p>
<?php
	}

}

?>
