<?php
// add script 
function cgstore_add_scripts(){
  wp_deregister_script('jquery');
   wp_enqueue_script('modernizr',TEMPLATE_PATH.'/js/modernizr.min.js');
   wp_enqueue_script('jquery',TEMPLATE_PATH.'/js/jquery.min.js');
    wp_enqueue_script('cgstore-bootstrap-3.3.2-js',TEMPLATE_PATH.'/js/bootstrap-3.3.2.min.js',array('jquery'));
   wp_enqueue_script('cgstore-bootstrap-multiselect-js',TEMPLATE_PATH.'/js/bootstrap-multiselect.js',array('jquery'));
   wp_enqueue_script('cgstore-tooltip-js',TEMPLATE_PATH.'/js/tooltipster.bundle.js',array('jquery'));
   wp_enqueue_script('cgstore-imagelightbox-js',TEMPLATE_PATH.'/js/imagelightbox.js',array('jquery'));
   wp_enqueue_script('cgstore-icheck-js',TEMPLATE_PATH.'/js/icheck.js',array('jquery'));
   wp_enqueue_script('cgstore-slick-js',TEMPLATE_PATH.'/js/slick.min.js',array('jquery'));
   wp_enqueue_script('cgstore-select2-js',TEMPLATE_PATH.'/js/select2.js',array('jquery'));
   wp_enqueue_script('cgstore-nouislider-js',TEMPLATE_PATH.'/js/nouislider.min.js',array('jquery'));
   wp_enqueue_script('cgstore-wNumb-js',TEMPLATE_PATH.'/js/wNumb.js',array('jquery'));
   wp_enqueue_script('cgstore-jquery-ui-js',TEMPLATE_PATH.'/js/jquery-ui.js',array('jquery'));
   wp_enqueue_script('cgstore-masonry-js',TEMPLATE_PATH.'/js/masonry.pkgd.js',array('jquery'));
   wp_enqueue_script('cgstore-imagesloaded-js',TEMPLATE_PATH.'/js/imagesloaded.pkgd.js',array('jquery'));
   wp_enqueue_script('cgstore-MultiFile-js',TEMPLATE_PATH.'/js/jQuery.MultiFile.min.js',array('jquery'));
   
   wp_enqueue_script('cgstore-froala_editor-js',TEMPLATE_PATH.'/js/froala_editor.min.js',array('jquery'));  
   wp_enqueue_script('cgstore-tagsinput-js',TEMPLATE_PATH.'/js/jquery.tagsinput.min.js',array('jquery'));  
   wp_enqueue_script('cgstore-validate-js',TEMPLATE_PATH.'/js/jquery.validate.js',array('jquery'));  
   wp_enqueue_script('cgstore-countdown-js',TEMPLATE_PATH.'/js/countdown.js',array('jquery'));
   wp_enqueue_script('cgstore-jobs-js',TEMPLATE_PATH.'/js/class.jobs.js',array('jquery'));
   wp_enqueue_script('cgstore-sitemain-js',TEMPLATE_PATH.'/js/class.SiteMain.js',array('jquery'));
   $vars = array(
         'SITE_URL'=> HOME_URL,
         'TEMPLATE_PATH'=> TEMPLATE_PATH,
         'CURRENCY_SYMBOL'=> get_woocommerce_currency_symbol(),
         'AJAX_URL'=> admin_url( 'admin-ajax.php' ),
         'SECURITY' => wp_create_nonce('ats-security-load')
      );
   
   if(is_user_logged_in()){
        $current_user = wp_get_current_user();
        $vars['UID'] = $current_user->ID;
     }

    wp_localize_script('cgstore-sitemain-js','CGSTORE_VARS',$vars);

    wp_enqueue_script('cgstore-ajax-js',TEMPLATE_PATH.'/js/ajax-js.js',array('jquery','cgstore-sitemain-js'));

    if(is_page_template('page-post-job.php')){
       wp_enqueue_script('cgstore-post-job',TEMPLATE_PATH.'/js/post-job.js',array('jquery','cgstore-sitemain-js'));
    }
}

add_action('wp_enqueue_scripts', 'cgstore_add_scripts');

// add css

function cgstore_add_styles(){

   wp_enqueue_style('cgstore-main-css',TEMPLATE_PATH . '/css/themes/cgstore.css', array(), false, 'all');
   wp_enqueue_style('cgstore-all-css',TEMPLATE_PATH . '/css/all.css', array(), false, 'all');
}
add_action('wp_enqueue_scripts', 'cgstore_add_styles');