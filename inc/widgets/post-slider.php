<?php
/**
 * display list post_type service.
 */

	/**
 * Adds Foo_Widget widget.
 */
class RAB_Slider_Widget extends WP_Widget {
	static $args_default = array( 'speed' => 400, 'title' => '', 'nav' =>0 , 'effect' => 'slide', 'slide' => '0','size' => 'full', 'cat'=> 0);

	function __construct() {

		$widget_ops = array( 'classname' => 'rab_slider', 'description' => __( 'A list of your site&#8217;s Pages.',RAB_DOMAIN) );
		parent::__construct( 'slider', __('Rap slider 1',RAB_DOMAIN), $widget_ops);
		add_action( 'wp_print_footer_scripts', array($this, 'extract_value_to_js'), 15 );

	}

	/**
	 * extract value in widget setting to js.
	 * @return [type] [description]
	 */
	function extract_value_to_js(){
		//get setting in widgets;
		$settings = $this->get_settings();

		$settings = wp_parse_args( $settings, self::$args_default );
		extract($settings);

		//get all widget setting  of this Widget.

		$options = get_option('widget_slider',array());

		unset($options['_multiwidget']); // because this is a key in array value all widget.

		if($options){
			// if exist a rab slider widget.
			?>
			<script type = "text/javascript">
				(function($){

					$(document).ready(function(){
							<?php
							foreach ($options as $key => $widget) {
								if(empty($widget))
									continue;

								$nav = (isset($nav) && $nav==1) ? 'true' : 'false';
								$class = '.slider-'.$key;
								?>
						 		$('<?php echo $class;?>').flexslider({
					              	animation: '<?php echo $effect;?>',
					              	animationSpeed:<?php echo $widget['speed'];?>,
					              	animationLoop: true,
					              	itemWidth: '100%',
					              	slideshowSpeed : 5000,
					              	itemMargin: 0,
					                controlNav: <?php echo $nav;?>,
					                slideshow: true,

					            });
				            <?php
							}
						?>
					});
				})(jQuery);
			</script>
			<?php
		}

	}
	function widget( $args, $instance ) {

		wp_enqueue_script('jquery.flexslider');
		wp_enqueue_style('flex.slider');

		extract( $args );

		echo $before_widget;

		extract($instance);

		?>

		<div class="flexslider carousel <?php echo $widget_id;?>">
			<?php
			if($title)
				echo $before_title .' &nbsp;'.$title. $after_title;
				$query = 'post_type=post';
				if(is_numeric($cat))
					$query.='&cat='.$cat;

				query_posts($query);
				if(have_posts()){
					echo '<ul class="slides">';
					while(have_posts()){
						the_post();
						echo '<li>';
						echo '<h5 class="widget-title">'.get_the_title().'</h5>';
						rab_post_thumbnail('medium');
						echo get_the_excerpt();
						echo'</li>';
					}
					echo '</ul>';
				}
				wp_reset_query();
				?>

		</div>

		<?php
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		// var_dump($old_instance);
		// var_dump($instance);
		// var_dump($new_instance);
		//die();
		return $new_instance;
	}

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance ,  self::$args_default);
		$title = esc_attr( $instance['title'] );
		extract($instance);
		// echo '<pre>';
		// var_dump($instance);
		// echo '</pre>';
		$cat = $instance['cat'];
	?>
		<p>
			<label for="<?php echo $this->get_field_id('effect'); ?>"><?php _e('Select type effect',RAB_DOMAIN);?> : </label>
			<?php
				$args = array('name' =>  $this->get_field_name('cat'),'selected' => $cat);
				wp_dropdown_categories( $args );
			?>

		</p>

		<p>
			<label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Select thumbnail size',RAB_DOMAIN);?> : </label>
			<select name="<?php echo $this->get_field_name("size");?>"> 

				<option value="full" <?php selected('full',$size);?> > <?php _e('Full',RAB_DOMAIN);?></option>
				<option value="thumbnail" <?php selected('thumbnail',$size);?> > <?php _e('Thumbnail',RAB_DOMAIN);?></option>

			</select>

		</p>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title',RAB_DOMAIN); ?> : </label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Speed:',RAB_DOMAIN); ?> : </label> 
			<input id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>" type="text" value="<?php echo $speed; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('nav'); ?>"><?php _e('Show Nav',RAB_DOMAIN); ?>: </label> 
			<input <?php if($nav ==1) echo 'checked ="checked"';?> id="<?php echo $this->get_field_id('nav'); ?>" name="<?php echo $this->get_field_name('nav'); ?>" type="checkbox" value="1"  />
		</p>

<?php
	}

}
?>