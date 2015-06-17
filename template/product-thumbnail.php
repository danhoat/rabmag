<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) {
	$loop 		= 0;
	$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
	$large_thumb = '<div id="slider" class="flexslider">';
	$small_thumb =  '<div id="carousel" class="flexslider">';
	$large_thumb .= '<ul class="thumbnails slides columns-' . $columns.'">';
	$small_thumb .= '<ul class="thumbnails slides columns-' . $columns.'">';
		foreach ( $attachment_ids as $attachment_id ) {
			$large_thumb .= '<li>';
			$small_thumb .= '<li>';
			$classes = array( 'zoom' );

			if ( $loop == 0 || $loop % $columns == 0 )
				$classes[] = 'first';

			if ( ( $loop + 1 ) % $columns == 0 )
				$classes[] = 'last';

			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link )
				continue;

			$thumbnail   = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
			$large       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'large' ) );

			$image_class = esc_attr( implode( ' ', $classes ) );
			$image_title = esc_attr( get_the_title( $attachment_id ) );

			$large_thumb .=  apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a>', $image_link, $image_class, $image_title, $large ), $attachment_id, $post->ID, $image_class );
			$small_thumb .=  apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a>', $image_link, $image_class, $image_title, $thumbnail ), $attachment_id, $post->ID, $image_class );

			$large_thumb .= '</li>';
			$small_thumb .= '</li>';
			$loop++;
		}
		$large_thumb.='</ul></div>';
		$small_thumb.='</ul></div>';
		echo $large_thumb;
		echo $small_thumb;

	?></ul>
	<?php
}
