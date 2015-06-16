<?php
/**
 * remove some thumbnail size which was added by woo
 * @param  [type] $sizes [description]
 * @return [type]        [description]
 */

add_action( 'init', 'remove_woo_action_hook', 105);
function remove_woo_action_hook(){
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	remove_action( 'wp_enqueue_scripts', array( 'WC_Frontend_Scripts', 'load_scripts' ) );
}
?>