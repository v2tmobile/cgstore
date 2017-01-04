<?php
/**
 * Created by v2tmobile.
 * Date: 12/12/16
 * Time: 3:28 PM
 * Copyright (c) Ahiho.,JSC. All right reserved.
 */

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);

add_action('woocommerce_before_shop_loop_item', function () {
   echo '<div class="content-box content-box-interactive tooltipstered tooltip" data-toggle="tooltip">';
});

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

add_action('woocommerce_before_shop_loop_item_title', function (){
    $product = new WC_Product( get_the_ID() );
    if ( !has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
        $image = get_template_directory_uri() . '/images/cg-holder.png';
    }
    $attachment_ids = $product->get_gallery_attachment_ids();
    $listImgs = [];
    foreach( $attachment_ids as $attachment_id )
            {
                $image_link = wp_get_attachment_image_src( $attachment_id,'medium');
                $listImgs[] = $image_link[0];
            }
     
    ?>
    <input type="hidden" class="tooltip-data" value= '<?php echo json_encode($listImgs); ?>'>
      <div class="content-box-content">
        <a class="content-box-link" href="<?php echo get_permalink(get_the_ID())?>" title="<?php echo get_the_title(get_the_ID())?>">
            <figure class="content-box-image">
                <img alt="<?php echo get_the_title(get_the_ID())?>" src="<?php isset($image) ? $image : the_post_thumbnail_url('medium')?>">
                <figcaption class="content-box-title"><?php echo get_the_title(get_the_ID())?></figcaption>
            </figure>
        </a>
        <div class="content-box-price"><?php echo $product->get_price_html() ?></div>
        <div class="content-box-controls">
                                <div class="content-box-control">
                                    <button class="action prev">
                                        <i class="fa fa-chevron-left fa-lg"></i>
                                    </button>
                                </div>
                                <div class="content-box-control">
                                    <button class="action next">
                                        <i class="fa fa-chevron-right fa-lg"></i>
                                    </button>
                                </div>
                            </div>
    <?php
        $downloads= $product->get_files();
        $ext = [];
        if($downloads){
             foreach ($downloads as $download) {
                  $info  = pathinfo($download["file"]);
                  $ext[]  = $info['extension'];
             }
        }

     ?>
     <div class="content-box-file-extensions"><?php echo implode(', ',$ext);?></div>
     </div>
    <?php
}, 10);

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
// Remove Sold by text
remove_action( 'woocommerce_after_shop_loop_item', array('WCV_Vendor_Shop', 'template_loop_sold_by'), 9, 2);

// //add_action('woocommerce_after_shop_loop_item', function () {
//    // echo '<div class="content-box-controls">
//                             <div class="content-box-control">
//                                 <button class="action">
//                                     <i class="fa fa-chevron-left fa-lg"></i>
//                                 </button>
//                             </div>
//                             <div class="content-box-control">
//                                 <button class="action">
//                                     <i class="fa fa-chevron-right fa-lg"></i>
//                                 </button>
//                             </div>
//                         </div>
//             <div class="content-box-file-extensions">max, obj, fbx, 3ds</div>
//         </div>';
// }, 5);