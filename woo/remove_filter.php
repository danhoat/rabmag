<?php
/**
 * remove some thumbnail size which was added by woo
 * @param  [type] $sizes [description]
 * @return [type]        [description]
 */
function paulund_remove_default_image_sizes( $sizes) {
    unset( $sizes['shop_thumbnail']);
    unset( $sizes['shop_catalog']);
    unset( $sizes['shop_single']);
    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'paulund_remove_default_image_sizes', 13);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
?>