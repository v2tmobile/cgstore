<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;
?>
<div class="product-preview is-with-border">
	<div class="overlay-button overlay-button--zoom js-zoom-in"><i class="fa fa-arrows-alt fa-lg fa-not-spaced"></i></div>
	<div class="product-preview-image card has-padding shadow">
		<?php
		if ( has_post_thumbnail() ) {
			$attachment_ids = $product->get_gallery_attachment_ids();
			foreach( $attachment_ids as $attachment_id )
			{

				$image_link = wp_get_attachment_url( $attachment_id );

				echo '<div>';
				echo '<a href="'. $image_link . '" class="lightbox"><img src="'. $image_link . '" /></a>';
				echo '</div>';
			}
		} else {
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
		}
		?>
	</div>
</div>
<?php
do_action( 'woocommerce_product_thumbnails' );
?>
