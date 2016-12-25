<?php
/**
 * Created by v2tmobile.
 * Date: 11/28/16
 * Time: 1:03 AM
 * Copyright (c) Ahiho.,JSC. All right reserved.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class WC_Product_Vendors_Frontend_Shortcodes {
    public $create_new_product;

    public function __construct()
    {
        $this->create_new_product = new WC_Product_Vendors_Frontend_Create_New_Product();

        add_shortcode('wc_create_new_product', array($this, 'render_create_new_product_form_shortcode'));

        return true;
    }

    public function render_create_new_product_form_shortcode( $atts )
    {
        ob_start();

        $this->create_new_product->include_form();

        $form = ob_get_clean();

        return $form;
    }
}

new WC_Product_Vendors_Frontend_Shortcodes();