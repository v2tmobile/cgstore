<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shopping_Mall
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					//the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<div class="content-heading">
			   <h2 class="content-heading__title">Challenges</h2>
			   <div class="content-heading__subtitle">Are you ready for a challenge? Upload models and win prizes!</div>
			</div>
			
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
	              
	              // list challenge;
				?>

				<div class="heading"><?php the_title();?></div>
				<div class="challenges-list is-list">
					<div class="challenge">
					   <div class="challenge__image"><a href="<?php the_permalink();?>"><?php echo get_the_post_thumbnail(get_the_ID());?></a></div>
					   <div class="challenge__inner">
					      <h3 class="challenge__title"><a  href="<?php the_permalink();?>"><span><?php the_title();?></span></a></h3>
					      <div class="challenge__description">
					         <?php the_content();?>
					      </div>
					      <div class="challenge__info">
					      	<?php 
                               $date = get_field('challenge_date',get_the_ID());
							 ?>
					         <div class="challenge__deadline"><span>Ends in <b><?php echo $date; ?></b></span></div>
					         <div class="challenge__action"><a href="<?php the_permalink();?>"><button class="button js-acts-as-link" data-url="">Join Challenge</button></a></div>
					      </div>
					   </div>
					</div>
				</div>
				<?php

				endwhile;
			?>
		
		<?php
			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
