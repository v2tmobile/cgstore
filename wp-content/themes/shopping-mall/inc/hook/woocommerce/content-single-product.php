<?php
/**
 * Created by v2tmobile.
 * Date: 12/13/16
 * Time: 12:24 AM
 * Copyright (c) Ahiho.,JSC. All right reserved.
 */

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

add_filter( 'woocommerce_product_tabs', function ($tabs) {
    unset( $tabs['additional_information'] );   // Remove the additional information tab
    return $tabs;
}, 98 );

add_action('woocommerce_before_single_product', function () {
    $product = new WC_Product(get_the_ID());
    ?>
    <div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class('product-container'); ?>>
        <div class="product-content">
        <div class="product-header">
            <?php woocommerce_template_single_title() ?>
            <div class="product-interaction">
                <div class="like-button js-auth-control js-like" data-item-id="162179" data-item-type="Item">
                    <div class="like-button-text">Like this</div>
                    <div class="like-button-counter">225</div>
                </div>
            </div>
            <div class="product-header-author"><span>by</span>
                <div class="author author-small">
                    <a href="#" title="fisherman3d">
                        <img alt="fisherman3d" class="avatar avatar-with-name author-avatar" src="https://assets.cgtrader.com/assets/avatar/small_avatar-04ef157a5b11c33ad48fe0d8dee962db9a781ddb0c5eed3c4023767c3bfa7827.png">
                    </a>
                    <div class="author-name">
                        <a class="js-author-link" href="#" itemprop="creator" title="fisherman3d">fisherman3d</a>
                    </div>
                </div>
            </div>
        </div>
        <?php woocommerce_show_product_images() ?>
        <div class="product-main">
            <ul class="product-stats">
                <li class="has-tooltip tooltipstered" content="3.96k Views" itemprop="interactionCount">
                    <i class="fa fa-eye fa-lg"></i>3.96k
                </li>
                <li class="has-tooltip tooltipstered" content="225 Likes" itemprop="interactionCount">
                    <i class="fa fa-heart"></i>225
                </li>
            </ul>
    <?php
}, 15);

add_action('woocommerce_before_single_product', 'woocommerce_output_product_data_tabs', 20);

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

add_action( 'woocommerce_before_add_to_cart_form', 'woocommerce_template_single_price', 10);

add_action('woocommerce_after_add_to_cart_button', function () {
    ?>
    <a class="js-auth-control js-modal product-pricing-make-offer has-tooltip js-offer-price tooltipstered" href="#modal-price-offer">
        <span class="icon"></span>Offer your price
    </a>
    <?php
});

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

add_action('woocommerce_share', function () {
    global $post;
    $permalink = get_permalink($post->ID);
    $featured_image =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail');
    $featured_image_2 = $featured_image['0'];
    $post_title = rawurlencode(get_the_title($post->ID));
   ?>
    <div class="details-box card has-padding">
        <div class="details-box-title">Share it!</div>
        <div class="product-share-old">
            <ul class="list list-inline u-text-center social-networks">
                <li class="list-item">
                    <a class="social-icon facebook" href="https://www.facebook.com/sharer.php?u=<?php echo $permalink; ?>" target="_blank">
                        <span class="fa-stack fa-social-share fa-facebook-icon"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-inverse fa-stack-1x"></i></span>
                    </a>
                </li>
                <li class="list-item">
                    <a class="social-icon linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $permalink ?>&title=<?php echo $post_title ?>&summary=<?php echo $post->post_excerpt ?>" target="_blank">
                        <span class="fa-stack fa-social-share fa-linkedin-icon"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-linkedin fa-inverse fa-stack-1x"></i></span>
                    </a>
                </li>
                <li class="list-item">
                    <a class="social-icon twitter" href="https://twitter.com/share?url=<?php echo $permalink; ?>" target="_blank">
                        <span class="fa-stack fa-social-share fa-twitter-icon"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-inverse fa-stack-1x"></i></span>
                    </a>
                </li>
                <li class="list-item">
                    <a class="social-icon google-plus" href="https://plus.google.com/share?url=<?php echo $permalink; ?>" target="_blank">
                        <span class="fa-stack fa-social-share fa-google-plus-icon"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-google-plus fa-inverse fa-stack-1x"></i></span>
                    </a>
                </li>
                <li class="list-item is-last">
                    <a class="social-icon pinterest" href="https://pinterest.com/pin/create/button/?url=<?php echo $permalink; ?>&amp;media=<?php echo $featured_image_2; ?>&amp;description=<?php echo $post_title; ?>" target="_blank">
                        <span class="fa-stack fa-social-share fa-pinterest-icon"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-pinterest fa-inverse fa-stack-1x"></i></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <?php
});

add_action('woocommerce_single_product_summary', function (){
    global $product;
    global $wc_cpdf;
    ?>
    <div class="details-box card has-padding">
        <div class="details-box-title">More Details</div>
        <ul class="details-box-list">
            <li>Animated <span class="val-negative"><?php echo $wc_cpdf->get_value($product->get_id(), '_shopping_mall_animated'); ?></span></li>
            <li>Rigged <span class="val-positive"><?php echo $wc_cpdf->get_value($product->get_id(), '_shopping_mall_rigged'); ?></span></li>
            <li>VR / AR / Low-poly <span class="val-negative"><?php echo $wc_cpdf->get_value($product->get_id(), '_shopping_mall_low_poly'); ?></span></li>
            <li>Geometry <span class=""><?php echo $wc_cpdf->get_value($product->get_id(), '_shopping_mall_geometry'); ?></span></li>
            <li>Polygons <span class=""><?php echo $wc_cpdf->get_value($product->get_id(), '_shopping_mall_polygons'); ?></span></li>
            <li>Vertices <span class=""><?php echo $wc_cpdf->get_value($product->get_id(), '_shopping_mall_vertices'); ?></span></li>
            <li>Textures <span class="val-positive"><?php echo $wc_cpdf->get_value($product->get_id(), '_shopping_mall_textures'); ?></span></li>
            <li>Materials <span class="val-positive"><?php echo $wc_cpdf->get_value($product->get_id(), '_shopping_mall_materials'); ?></span></li>
            <li>UV Mapping <span class="val-positive"><?php echo $wc_cpdf->get_value($product->get_id(), '_shopping_mall_uvw_mapping'); ?></span></li>
            <li>Collection <span><?php echo $wc_cpdf->get_value($product->get_id(), '_shopping_mall_collection'); ?></span></li>
            <li>Plugins used <span class="val-negative"><?php echo $wc_cpdf->get_value($product->get_id(), '_shopping_mall_plugins_used'); ?></span></li>
        </ul>
    </div>
<?php
}, 55);

remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

add_action('woocommerce_after_single_product', function () {
    ?>
            </div>
        </div>
        <div class="product-sidebar">
        <?php
        /**
         * woocommerce_before_single_product_summary hook.
         *
         * @hooked woocommerce_show_product_sale_flash - 10
         * @hooked woocommerce_show_product_images - 20
         */
        do_action( 'woocommerce_before_single_product_summary' );
        /**
         * woocommerce_single_product_summary hook.
         *
         * @hooked woocommerce_template_single_title - 5
         * @hooked woocommerce_template_single_rating - 10
         * @hooked woocommerce_template_single_price - 10
         * @hooked woocommerce_template_single_excerpt - 20
         * @hooked woocommerce_template_single_add_to_cart - 30
         * @hooked woocommerce_template_single_meta - 40
         * @hooked woocommerce_template_single_sharing - 50
         */
        do_action( 'woocommerce_single_product_summary' );
        /**
         * woocommerce_after_single_product_summary hook.
         *
         * @hooked woocommerce_output_product_data_tabs - 10
         * @hooked woocommerce_upsell_display - 15
         * @hooked woocommerce_output_related_products - 20
         */
        do_action( 'woocommerce_after_single_product_summary' );
        ?>
        </div>
    </div>
    <?php
}, 15);

add_action('woocommerce_after_single_product', 'woocommerce_upsell_display', 15);
add_action('woocommerce_after_single_product', 'woocommerce_output_related_products', 20);