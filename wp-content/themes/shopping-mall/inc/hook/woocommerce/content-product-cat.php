<?php
/**
 * Created by v2tmobile.
 * Date: 12/12/16
 * Time: 3:28 PM
 * Copyright (c) Ahiho.,JSC. All right reserved.
 */

// Show empty category
add_filter( 'woocommerce_product_subcategories_hide_empty', 'show_empty_categories', 10, 1 );
function show_empty_categories ( $show_empty ) {
    $show_empty  =  true;
    return $show_empty;
}

remove_action('woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10);
add_action('woocommerce_before_subcategory', function ($category) {
    echo '<div class="category-content">';
}, 10);

remove_action('woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10);

add_action('woocommerce_before_subcategory_title', function ($category) {
    $thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
    $image = wp_get_attachment_url( $thumbnail_id );
    if (! $image) {
        $image = get_template_directory_uri() . '/images/cg-holder.png';
    }
    ?>
    <div class="category-image">
        <a href="<?php echo get_term_link( $category, 'product_cat' ) ?>">
            <img src="<?php echo $image ?>" title="<?php echo $category->name ?>" alt="<?php echo $category->name ?>"/>
        </a>
    </div>
    <?php
}, 10);

remove_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10);

add_action('woocommerce_shop_loop_subcategory_title', function ($category) {
    $root_category = explode('/',get_category_parents($category));
    $root_category = $root_category[0];

    ?>
    <div class="category-main-content">
        <h3 class="category-title">
            <a href="<?php echo get_term_link( $category, 'product_cat' ) ?>"><?php echo $category->name ?><span><?php echo $root_category ?></span></a>
        </h3>
        <div class="category-description">
            <?php echo $category->description ?>
        </div>
    </div>
    <?php
}, 10);

remove_action('woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10);
add_action('woocommerce_after_subcategory', function ($category) {
    ?>
    </div>
    <?php
    $taxonomy_name = 'product_cat';
    $termchildren = get_term_children( $category->term_id, $taxonomy_name );
    if ($termchildren) :
    ?>
    <div class="category-footer">
        <ul class="list list-inline">
        <?php
        foreach ( $termchildren as $child ) {
            $term = get_term_by( 'id', $child, $taxonomy_name );
            if ($term) {
                echo '<li class="list-item"><a href="' . get_term_link( $child, $taxonomy_name ) . '">' . $term->name . '</a></li>';
            }
        }
        ?>
        </ul>
    </div>
    <?php
    endif;
}, 10);

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

add_action('woocommerce_archive_description','add_subcat_for_product_cat',10);
function add_subcat_for_product_cat(){
 
       global $wp_query;

        if ( 1 === $wp_query->found_posts || ! woocommerce_products_will_display() ) {
         $tag_tax = 'product_tag';
         $tags = get_terms( $tag_tax, 'orderby=count&hide_empty=0&number=5' );
          $tag_html = '';
          if($tags){
             foreach ($tags as $tag) {
               $link  = get_term_link($tag);
               $tag_html .='<a href="'.$link.'" title="'.$tag->name.'">'.$tag->name.'</a>';
             }
          }

           $html = ($tag_html) ? '
           <div class="box-tags">
               <h4>POPULAR TAGS</h4>
             <div class="prodcut_tags">
                 '.$tag_html.'
             </div>
           </div>' : '';
          echo $html;
           
        }else{

         if ( ! $term && ( is_tax() || is_tag() || is_category() ) ) {
               $term = get_queried_object();
         if ( $term ) {
                $curent_term_id = $term->term_id;

                ?>

        <div class="list-cat clearfix">
          <ul class="cat-list-filter">
              <?php
                  wp_list_categories( array(
                  'orderby'    => 'name',
                  'show_count' => true,
                  'child_of'    =>$curent_term_id,
                  'taxonomy'=>'product_cat',
                  'hide_empty'=>false,
                  'title_li'=>'',
                  'show_option_none'=>''
               ) ); 
              ?> 
        </ul>
        </div>

        <?php
    /**
     * woocommerce_before_main_content hook.
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked woocommerce_breadcrumb - 20
     */
    do_action( 'woocommerce_before_main_content' );
  ?>
     <div class="filter-block">
      <?php
          $queried_object = get_queried_object(); 
          $current_link = get_term_link($queried_object); 
       ?>      
     <form class="woocommerce-ordering hasborder" action="<?php echo $current_link; ?>" method="get" id="woocommerce-filter">
            <div class="price-range aleft">
              <input type="hidden" name="min_price" class="pricemin" value="<?php echo ($_GET['min_price']) ? $_GET['mix_price'] : 0;  ?>"/>
              <input type="hidden" name="max_price" class="pricemax" value="<?php echo ($_GET['min_price']) ? $_GET['max_price'] : 5000;  ?>"/>
              <span>Price</span><div id="rangePrice" data-min="<?php echo ($_GET['min_price']) ? $_GET['min_price'] : 0;  ?>" data-max="<?php echo ($_GET['max_price']) ? $_GET['max_price'] : 5000;  ?>"></div>
            </div>
            <div class="freeCk aleft">
              <label>
                <input type="checkbox" <?php echo ($_GET['product_free']) ? 'checked' : ''; ?> value="1" name="product_free" class="iCheckBox"/>
                <span>Free</span>
              </label>
            </div>
            <div class="filterSelect aleft">
             <?php 
                 $tax_format = 'product_format';
                 $tax_formats = get_terms( $tax_format, 'orderby=title&hide_empty=0');
                 if($tax_formats){
                    echo '<select name="product_format"><option value="">Formats</option>';
                    $selected = '';
                    foreach ($tax_formats as $format) {
                        if($_GET['product_format']){
                           $selected = ($_GET['product_format'] == $format->slug) ? 'selected="selected"': '';  
                        }
                        echo '<option value="'.$format->slug.'"'.$selected.'>'.$format->name.'</option>';
                    }

                    echo '</select>';
                 }
             ?>
              
            </div>
            <div class="filterSelect aleft">
              <select name="product_poly" >
                <option value="">Poly Count</option>
                <option value="0-50000" <?php echo ($_GET['product_poly'] =='0-50000') ? 'selected="selected"' : ''; ?>>Up to 5k</option>
                <option value="50000-100000" <?php echo ($_GET['product_poly'] =='50000-100000') ? 'selected="selected"' : ''; ?>>5K to 10k</option>
                <option value="10000-50000" <?php echo ($_GET['product_poly'] =='10000-50000') ? 'selected="selected"' : ''; ?>>10k to 50k</option>
              </select>
            </div> 
            <div class="filterType aleft">
             <?php 
                 $type_product = 'type_product';
                 $type_products = get_terms( $type_product, 'orderby=title&hide_empty=0');
                 if($type_products){
                    $selected = '';
                    foreach ($type_products as $type_product) {
                        if($_GET['type_product']){
                           $selected = (in_array($type_product->slug,$_GET['type_product'])) ? 'checked="checked"': '';  
                        }
                        echo '<div class="labeltype aleft"><label><input class="iCheckBox" type="checkbox" name="type_product[]" value="'.$type_product->slug.'"'.$selected.'><span>'.$type_product->name.'</span></input></label></div>';
                    }

                   
                 }
             ?>
              
            </div>      
            <div class="filterSelect aright sort-by">
              <?php echo woocommerce_catalog_ordering(); ?>
            </div> 
           <div class="clear"></div>
           
          </form>
      </div> 

    <div class="filter-show-list">
    <a href="#" class="active-filters__item">
     <?php echo $term->name; ?> <span class="delete active-filters__item-remove js-reset"><i class="fa fa-times fa-not-spaced"></i></span>   
     </a>
     <?php if($_GET['product_free']){ ?> 
         <a href="#" class="active-filters__item">Free <span class="delete active-filters__item-remove js-reset"><i class="fa fa-times fa-not-spaced"></i></span></a>
     <?php } ?>
      <?php if($_GET['product_format']){ 
            $fm = get_term_by('slug',$_GET['product_format'],'product_format');
            if($fm){
        ?> 
         <a href="#" class="active-filters__item"><?php echo $fm->name; ?><span class="delete active-filters__item-remove js-reset"><i class="fa fa-times fa-not-spaced"></i></span></a>
     <?php 
         } 
       }
     ?>
      
    </div>
   
   <?php 
          

         }
       
     }

  }

}

remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);