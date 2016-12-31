<?php
define('TEMPLATE_PATH',get_bloginfo('template_url'));
define('HOME_URL',get_home_url());
define('BlOG_NAME',get_bloginfo('blog_name'));
define('SLOGAN', get_bloginfo('description'));

//add_image_size( 'thumb-service',225,230,true);

include_once 'inc/add-scripts.php';
include_once 'inc/filter-search.php';
include_once 'inc/my-custom.php';

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

	wp_enqueue_script( 'shopping-mall-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'shopping-mall-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

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
require_once (dirname(__FILE__) . '/inc/shopping-mall-config.php');
