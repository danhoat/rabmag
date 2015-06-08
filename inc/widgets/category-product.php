<?php
/**
 * display list category product.
 * @author : danng
 * @version : 1.0
  */
class RAB_Widget_Product_Categories extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'rab_product_categories', // Base ID
			__( 'Product Categories', RAB_DOMAIN ), // Name
			array( 'description' => __( 'List Product categories', RAB_DOMAIN ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$list_args = $instance;
		$list_args = array( 'show_count' => $c, 'hierarchical' => $h, 'taxonomy' => 'product_cat', 'hide_empty' => false );
		//echo $args['before_widget'];
		echo '<div class="block-menu-category">';
		echo '<ul id="menu-danh-muc-san-pham" class="mcategory">';

			wp_list_categories(  $list_args );

		echo '</ul>';
		echo '</div>';
		//echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

}

?>
