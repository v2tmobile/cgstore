<?php
/* Template Name: Home Page */
/**
 * @package Shopping_Mall
 */

get_header(); ?>

	<?php 
		if( is_user_logged_in() )
			get_template_part('home/home-logged');
		else
			get_template_part('home/home-unlogin');
	?>

<?php get_footer(); ?>
