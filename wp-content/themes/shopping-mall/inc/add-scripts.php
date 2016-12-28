<?php
// add script 
function cgstore_add_scripts(){
   wp_deregister_script('jquery');
   wp_enqueue_script('modernizr','https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js');
   wp_enqueue_script('jquery','https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js');
   wp_enqueue_script('cgstore-lib-js',TEMPLATE_PATH.'/js/libs.js',array('jquery'));
   wp_enqueue_script('cgstore-app-js',TEMPLATE_PATH.'/js/app.js',array('jquery'));
   wp_enqueue_script('cgstore-tooltip-js',TEMPLATE_PATH.'/js/tooltipster.bundle.js',array('jquery'));
   wp_enqueue_script('cgstore-slick-js',TEMPLATE_PATH.'/js/slick.min.js',array('jquery'));
   wp_enqueue_script('cgstore-icheck-js',TEMPLATE_PATH.'/js/icheck.js',array('jquery'));
   wp_enqueue_script('cgstore-select2-js',TEMPLATE_PATH.'/js/select2.js',array('jquery'));
   wp_enqueue_script('cgstore-nouislider-js',TEMPLATE_PATH.'/js/nouislider.min.js',array('jquery'));
   wp_enqueue_script('cgstore-wNumb-js',TEMPLATE_PATH.'/js/wNumb.js',array('jquery'));
   wp_enqueue_script('cgstore-jquery-ui-js',TEMPLATE_PATH.'/js/jquery-ui.js',array('jquery'));
   wp_enqueue_script('cgstore-sitemain-js',TEMPLATE_PATH.'/js/class.SiteMain.js',array('jquery'));
   $vars = array(
         'SITE_URL'=> HOME_URL,
         'TEMPLATE_PATH'=> TEMPLATE_PATH,
         'CURRENCY_SYMBOL'=> get_woocommerce_currency_symbol(),
         'AJAX_URL'=> admin_url( 'admin-ajax.php' ),
         'SECURITY' => wp_create_nonce('ats-security-load')
      );
    wp_localize_script('cgstore-sitemain-js','CGSTORE_VARS',$vars);
}

add_action('wp_enqueue_scripts', 'cgstore_add_scripts');

// add css

function cgstore_add_styles(){

   wp_enqueue_style('cgstore-main-css',TEMPLATE_PATH . '/css/themes/cgstore.css', array(), false, 'all');
   wp_enqueue_style('cgstore-all-css',TEMPLATE_PATH . '/css/all.css', array(), false, 'all');
}
add_action('wp_enqueue_scripts', 'cgstore_add_styles');