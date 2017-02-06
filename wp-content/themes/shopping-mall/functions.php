<?php
define('TEMPLATE_PATH',get_bloginfo('template_url'));
define('HOME_URL',get_home_url());
define('BlOG_NAME',get_bloginfo('blog_name'));
define('SLOGAN', get_bloginfo('description'));
define('PREFIX_WEBSITE','cgs_');
//add_image_size( 'thumb-service',225,230,true);


include_once 'inc/add-scripts.php';
include_once 'inc/filter-search.php';
include_once 'inc/my-custom.php';
//include_once 'socials/login_socials.php';
include_once 'inc/add-like.php';
include_once 'inc/helper.php';
include_once 'inc/post-product.php';
include_once 'inc/ajax.php';

add_filter('woocommerce_login_redirect', 'wc_login_redirect');
 
function wc_login_redirect( $redirect_to ) {
     $redirect_to = HOME_URL;
     return $redirect_to;
}

// add parent taxonomy product cat
add_filter( 'body_class', 'add_class_product_cat_parent' );

function add_class_product_cat_parent($classes){

   if(is_tax('product_cat')){
   	   $queried_object = get_queried_object();

   	   $parent  = get_ancestors( $queried_object->term_taxonomy_id, $queried_object->taxonomy);
       if($parent){
       	  $tax = get_term($parent[0],$queried_object->taxonomy);
   	      $classes[] ='parent-cat-'.$tax->slug;
   	  }
   }
  
  return $classes;

}


function current_user_has_avatar() {

global $bp;

if ( bp_core_fetch_avatar( array( 'item_id' => $bp->loggedin_user->id, 'no_grav' => true,'html'=> false ) ) != bp_core_avatar_default() )
    return true;

  return false;

}

add_filter( 'woocommerce_composited_product_quantity', 'wc_cp_show_zero_min_quantity', 10, 5 );
function wc_cp_show_zero_min_quantity( $value, $min, $max, $product, $component_id ) {
	if ( (int) $value === 1 && (int) $min === 0 ) {
		$value = 1;
	}
	return $value;
}

function generate_random_filename($length=10) {
 
   $string = '';
   $characters = "23456789ABCDEFHJKLMNPRTVWXYZabcdefghijklmnopqrstuvwxyz";
 
   for ($p = 0; $p < $length; $p++) {
       $string .= $characters[mt_rand(0, strlen($characters)-1)];
   }
 
   return $string;
 
}

function get_list_taxonomy($postId, $tax ='', $link = true ){
	$list = '';
  if($postId && $tax){
  	 $terms = get_the_terms($postId,$tax);
  	 if($terms):
      $list ='<ul>';
      foreach ($terms as $term) {
      	$list .='<li>';
      	if($link){
      		$link_term = get_term_link($term);
      		$list .='<a title="'.$term->name.'" href="'.$link_term.'">'.$term->name.'</a>';
      	}else{
      		$list .='<span>'. $term->name.'</span>';
      	}
      	$list .='</li>';
      }

      $list .= '</ul>';
      endif;
	}

	return $list;

}

function cgs_disable_comment_url($fields) { 
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields','cgs_disable_comment_url');

if ( ! function_exists( 'shopping_mall_setup' ) ) :
function shopping_mall_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Shopping Mall, use a find and replace
	 * to change 'shopping-mall' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'shopping-mall', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'shopping-mall' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'shopping_mall_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/**
	* Setup WooCommerce compatibility.
	*/
	add_theme_support( 'woocommerce' );
}
endif;
add_action( 'after_setup_theme', 'shopping_mall_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function shopping_mall_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'shopping_mall_content_width', 640 );
}
add_action( 'after_setup_theme', 'shopping_mall_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function shopping_mall_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'shopping-mall' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'shopping-mall' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'shopping_mall_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function shopping_mall_scripts() {
	wp_enqueue_style( 'shopping-mall-style', get_stylesheet_uri() );

	//wp_enqueue_script( 'shopping-mall-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	//wp_enqueue_script( 'shopping-mall-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'shopping_mall_scripts' );

/**
* Hide Redux Ads in admin
*/
add_action('admin_head', 'shopping_mall_remove_redux_ads');

function shopping_mall_remove_redux_ads() {
  echo '<style>
	.redux-dev-mode-notice-container.redux-dev-qtip, .rAds { display: none; }
  </style>';
}

/**
 * Libs
 */
require get_template_directory() . '/inc/utils/custom-thumb-size.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
* Woocommerce
*/
require get_template_directory() . '/inc/woocommerce.php';

/**
 * Register theme menu
 */
require get_template_directory() . '/inc/register-menu.php';

/**
 * Shortcode
 */

/**
 * Hook
 */
foreach (scandir(get_template_directory() . '/inc/hook/woocommerce') as $filename) {
    $path = get_template_directory() . '/inc/hook/woocommerce' . '/' . $filename;
    if (is_file($path)) {
        require $path;
    }
}

/**
* Redux config panel
*/
//require_once (dirname(__FILE__) . '/inc/shopping-mall-config.php');

if( function_exists('acf_add_options_page') ) {
 
   acf_add_options_page(array(
    'page_title'  => 'Theme Options',
    'menu_title' => 'Theme Options',
    'menu_slug'  => 'theme-general-settings'
   ));
 
     acf_add_options_sub_page(array(
      'page_title'  => 'Header',
      'menu_title' => 'Header',
      'parent_slug' => 'theme-general-settings',
     ));
   acf_add_options_sub_page(array(
    'page_title'  => 'Footer',
    'menu_title' => 'Footer',
    'parent_slug' => 'theme-general-settings',
     ));
  	acf_add_options_sub_page(array(
    'page_title'  => 'Color Picker',
    'menu_title' => 'Color Picker',
    'parent_slug' => 'theme-general-settings',
     ));
   
}

// Theme color
function theme_customize_css() { ?>

	<style type="text/css">
		/*Header color*/
		<?php $header_color = get_field('header_hover_color', 'option');?>
		.primary-navigation > ul.nav > li.is-active > a, .primary-navigation > ul.nav > li.current-menu-item > a, .primary-navigation>ul.nav>li:hover>a {
			background: <?php echo $header_color; ?>;
		}
		.product-container .product-sidebar .details-box .product-pricing .product-pricing-actions a.buy-now, .indicator{
			background: <?php echo $header_color; ?>;
		}
		.vertical-menu li a:hover, .primary-navigation>ul.nav>li>ul>li:hover{
			border-left-color: <?php echo $header_color; ?>;
		}
		.select2-container .select2-results ul li:hover, .tabs__item a, .product-container .product-content .product-main .product-stats li i, .list-files h3, .breadcrumb-wrapper ul li a:hover, section.content-section .jobs-list .job .job-deadline b, section.content-section .jobs-list .job .forum-post-last-activity b, section.content-section .jobs-list .forum-post .job-deadline b, section.content-section .jobs-list .forum-post .forum-post-last-activity b, section.content-section .forum-post-list .job .job-deadline b, section.content-section .forum-post-list .job .forum-post-last-activity b, section.content-section .forum-post-list .forum-post .job-deadline b, section.content-section .forum-post-list .forum-post .forum-post-last-activity b, section.content-section .designers .designer:hover .designer-link, section.content-section .designers .designer .designer-stats li b, footer.footer .site-footer-links .site-footer-copyright .site-footer-copyright-links a:hover, .categories-list .category .category-content .category-main-content .category-title a:hover{
			color: <?php echo $header_color; ?>;
		}
		.select2-container .select2-results ul li:hover{
			color: #fff;
		}
		/*Body color*/
		<?php $body_color = get_field('body_color', 'option');?>
		.filter-show-list a{
			color: #fff;
		}
		.box-tags a, .category-footer ul li a{
			color: <?php echo $body_color; ?> !important;
		}
		.jobs-item__content .jobs__title a, .logo a b, section.content-section .challenges-list .challenge:hover .challenge-content .challenge-title a, section.content-section .designers .designer .designer-link, .content-box-wrapper .product-grid-item .content-box .content-box-content .content-box-price, a{
			color: <?php echo $body_color; ?>;
		}
		.ui-tooltip-content .product-price, .product-container .product-sidebar .details-box .product-pricing .product-pricing-actions .product-pricing-make-offer, .product-container .product-content .product-main .tabs .tabs-item a, .active-filters__item, section.content-section .tutorials .tutorial .tutorial-content .tutorials-title, section.content-section .jobs-list .job .job-title a, section.content-section .jobs-list .job .forum-post-title a, section.content-section .jobs-list .forum-post .job-title a, section.content-section .jobs-list .forum-post .forum-post-title a, section.content-section .forum-post-list .job .job-title a, section.content-section .forum-post-list .job .forum-post-title a, section.content-section .forum-post-list .forum-post .job-title a, section.content-section .forum-post-list .forum-post .forum-post-title a, .search-form button, button{
			color: <?php echo $body_color; ?>;
		}
		.jobs-application__earnings .button, .form-submit input[type="submit"], .product-container .product-content .product-thumbs-slider .slick-arrow, .product-container .product-content .product-header .product-interaction .like-button .like-button-counter, .active-filters__item, .noUi-connect, section.content-section .showcase-items .showcase-item .showcase-item-content .showcase-item-header, .button{
			background: <?php echo $body_color; ?>;
		}
		.select2-container--default .select2-results__option--highlighted[aria-selected], .product-container .product-content .product-header .product-interaction .like-button:hover .like-button-counter, .jobs-application__content--footer{
			background: <?php echo $header_color; ?>;
		}
		.jobs-application__earnings .button{
			opacity: 0.7;
		}
		.site-publishing-overlay, .product-container .product-content .product-thumbs-slider .slick-slide.slick-current img, .noUi-horizontal .noUi-handle{
			border-color: <?php echo $body_color; ?>;
		}
		.product-container .product-content .product-header .product-interaction .like-button .like-button-counter:before{
			border-right-color: <?php echo $body_color; ?>!important;
		}

		/*Icons*/
		<?php $spliticon = get_field('split_icon', 'option');?>
		<?php $hexagon = get_field('hexagon', 'option');?>
		<?php $hexagon_small = get_field('hexagon_small', 'option');?>
		<?php $radio_checkbox = get_field('radio_checkbox', 'option');?>
		.split {
			background: url(<?php echo $spliticon; ?>) no-repeat center;
		}
		.jobs-form__label:before, .label--with-hexagon:before, .bullet--hexagon li:before, .label--hexagon:before, .jobs-header__annotation:before{
			background: url(<?php echo $hexagon; ?>) no-repeat;
		}
		.heading {
			background: url(<?php echo $hexagon_small; ?>) no-repeat 0 3px;
		}
		.icheckbox{
			background: url(<?php echo $radio_checkbox; ?>) no-repeat;no-repeat 0 3px
		}
	</style>

<?php }

add_action('wp_head', 'theme_customize_css');