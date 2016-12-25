<?php
/* Template Name: Home Page */
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shopping_Mall
 */

get_header(); ?>

	<?php 
		if( is_user_logged_in() )
			get_template_part('home/home-logged');
		else
			get_template_part('home/home-unlogin');
	?>

<?php
//get_sidebar();
get_footer();
