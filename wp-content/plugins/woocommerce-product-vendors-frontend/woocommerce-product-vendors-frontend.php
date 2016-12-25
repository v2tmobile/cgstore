<?php
/**
 * Plugin Name: WooCommerce Product Vendors Frontend
 * Version: 1.0
 * Plugin URI: https://ahiho.com
 * Description: WooCommerce Product Vendors Frontend that front-end of Woocommerce Product Vendors plugin.
 * Author: Ahiho.,JSC
 * Author URI: https://ahiho.com
 * Requires at least: 4.4.0
 * Tested up to: 4.6.0
 *
 * Text Domain: woocommerce-product-vendors-frontend
 * Domain Path: /languages
 *
 * @package WordPress
 * @author Ahiho
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists('WC_Product_Vendors_Frontend')) {

    class WC_Product_Vendors_Frontend {
        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        public function __clone() {
            _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'woocommerce-product-vendors' ), '2.0.22' );
        }

        public function __wakeup() {
            _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'woocommerce-product-vendors' ), '2.0.22' );
        }

        private function __construct() {
            add_action( 'plugins_loaded', array( $this, 'init' ), 0 );

            return true;
        }

        public function dependencies()
        {
            include_once ('includes/class-wc-product-vendors-frontend-create-new-printable-product.php');
            include_once ('includes/class-wc-product-vendors-frontend-shortcodes.php');
        }

        public function init() {
            $this->dependencies();
            return true;
        }
    }

    WC_Product_Vendors_Frontend::instance();
}