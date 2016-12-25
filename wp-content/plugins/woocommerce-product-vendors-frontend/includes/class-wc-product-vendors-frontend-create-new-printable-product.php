<?php
/**
 * Created by v2tmobile.
 * Date: 11/28/16
 * Time: 12:30 AM
 * Copyright (c) Ahiho.,JSC. All right reserved.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class WC_Product_Vendors_Frontend_Create_New_Product
 */

class WC_Product_Vendors_Frontend_Create_New_Product {

    private function get_categories()
    {
        $taxonomy     = 'product_cat';
        $orderby      = 'name';
        $show_count   = 0;      // 1 for yes, 0 for no
        $pad_counts   = 0;      // 1 for yes, 0 for no
        $hierarchical = 1;      // 1 for yes, 0 for no
        $title        = '';
        $empty        = 0;

        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
        );
        return get_categories( $args );
    }

    /**
     * WC_Product_Vendors_Frontend_Create_New_Product constructor.
     */
    public function __construct()
    {
        return true;
    }

    public function include_form()
    {
        $categories = $this->get_categories();
        // check if template has been override.
        if ( file_exists( get_template_directory() . '/templates/plugins/woocommerce-product-vendors-frontend/create-new-product-form.php' ) ) {

            include( get_template_directory() . '/templates/plugins/woocommerce-product-vendors-frontend/create-new-product-form.php' );

        } else  {
            include( plugin_dir_path( dirname( __FILE__ ) ) . 'templates/create-new-printable-product-form.php' );
        }

        return true;
    }
}