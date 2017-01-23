<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shopping_Mall
 */

get_header(); ?>
	
	<div class="jobs-page">
		<div class="content-area">
			<div class="breadcrumb-wrapper" id="breadcrumb">
				<?php 
                    $args = array(
							'delimiter' => '/',
								'before' => '<span class="breadcrumb-title">' . __( '', 'woothemes' ) . '</span>'
					);
					echo woocommerce_breadcrumb($args);
				?>
			</div>
			
			<div class="jobs-header">
			   <h1 class="jobs-header__title">3D Tutorial</h1>
			   <div class="jobs-header__content">
			      <p class="jobs-header__annotation">Quality 3D content and examples to learn from.</p>
			   </div>
			   <a class="button button--longer u-float-right" href="<?php echo HOME_URL; ?>/post-tutorial/">Create tutorial</a>
			   <div class="clear"></div>
			</div>
			

			<div class="job-content">
				<?php get_sidebar('tutorial');?>
				<div class="tutorials-search__section">
				   <div class="tutorials-search">
				      <form>
				      	<button class="tutorials-search__button" type="submit"><i class="fa fa-search fa-lg"></i></button>
				      	<input type="search" name="keywords" autocomplete="off" class="tutorials-search__field" placeholder="search tutorials">
				      </form>
				   </div>
				   <ul class="tutorials-sorting__section">
				      <li>
				         <a rel="nofollow" value="latest">latest</a><!-- react-text: 20 --> /<!-- /react-text -->
				      </li>
				      <li><a rel="nofollow" value="best">best</a></li>
				   </ul>
				</div>
				<?php
				if ( have_posts() ) : 
				/* Start the Loop */
					while ( have_posts() ) : the_post();
	                $id= get_the_ID();
	              // list challenge;
				?>

				<div class="jobs__content">

				   <div class="jobs__item">
				      <div class="jobs-item__image"><a href="<?php the_permalink(); ?>">
				      	<?php if ( has_post_thumbnail() ) : ?>
				      		<?php the_post_thumbnail('medium'); ?>
				      	<?php else: ?>
				      		<img src="<?php echo TEMPLATE_PATH ?>/images/no_image_thumb.png"/>
				      <?php endif; ?>
				      </a></div>
				      <div class="jobs-item__content">
				         <h3 class="jobs__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                         <div class="gallery-item__author">by <a href="<?php echo get_the_author_link($id);?>"><?php echo get_the_author_meta('display_name') ;?></a></div>
				         
				         <div class="clear"></div>
				         <div class="tag-list">
				            <ul>
                              <?php
								echo get_the_term_list($id,'tutorial_cat','<li>','','</li>');
								echo get_the_term_list($id,'tutorial_software','<li>','','</li>');
							  ?>
				            </ul>
				         </div>
				      </div>
				      <div class="gallery-item__info">
				            
				            <div class="gallery-item__stats">
				               <ul class="list list--inline">
				                  <li><i class="fa fa-eye fa-lg fa-red"></i> <b>
				                  	<?php echo (get_post_meta($id,'views',true)) ? get_post_meta($id,'views',true) :0 ; ?>
				                  </b></li>
				                  <li><i class="fa fa-commenting-o fa-lg fa-red"></i> <b><?php echo get_comments_number();?></b></li>
				               </ul>
				            </div>
				         </div>
				      <div class="jobs-price__content">
				         
				         <a href="<?php the_permalink(); ?>">
				            <div class="button button--longer u-float-right">View</div>
				         </a>
				      </div>
				   </div>
				</div>
				<?php

					endwhile;
				?>
				<?php
				the_posts_navigation();

			else :

				get_template_part( 'template-parts/no', 'post' );

			endif; ?>
			</div>
			
		</div>
	</div>

<?php
//get_sidebar();
get_footer();
