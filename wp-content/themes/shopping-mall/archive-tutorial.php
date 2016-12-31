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
				<ul class="breadcrumb" itemscope="itemscope" itemtype="https://schema.org/BreadcrumbList">
	               <li class="breadcrumb-item" itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
		                <a href="http://localhost/cgstore" itemprop="item" itemscope="itemscope" itemtype="http://schema.org/Thing" title="Home">
		                    <span itemprop="name">Home</span>
		                </a>
		                <meta content="1" itemprop="position">
	            	</li>
	                <li class="breadcrumb-item" itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
			            <span itemprop="item" itemscope="itemscope" itemtype="http://schema.org/Thing">
			              <span itemprop="name">Jobs</span>
			            </span>
			                <meta content="2" itemprop="position">
			        </li>
	            </ul>
			</div>
			<?php
				if ( have_posts() ) : ?>
			<div class="jobs-header">
			   <h1 class="jobs-header__title">3D Tutorial</h1>
			   <div class="jobs-header__content">
			      <p class="jobs-header__annotation">Quality 3D content and examples to learn from.</p>
			   </div>
			   <a class="button button--longer u-float-right" href="<?php echo HOME_URL; ?>/post-jobs/">Create tutorial</a>
			   <div class="clear"></div>
			</div>
			

			<div class="job-content">
				<?php get_sidebar('job');?>
				<?php
				/* Start the Loop */
					while ( have_posts() ) : the_post();
	              
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
				         <ul class="label-list">
				            <li>
				               <div class="jobs__software">
				                  <div class="label--hexagon"><span>3D Computer Graphics</span></div>
				               </div>
				            </li>
				            <li>
				               <div class="jobs__deadline"><span class="label--hexagon">28 days to finish</span></div>
				            </li>
				            <li>
				               <div class="jobs__aplicants">
				                  <div class="label--hexagon"><span>1 applicant</span></div>
				               </div>
				            </li>
				         </ul>
				         <div class="clear"></div>
				         <div class="tag-list">
				            <ul>
				               <li>Lightwave</li>
				               <li>Maya</li>
				               <li>3D Studio Max</li>
				            </ul>
				         </div>
				      </div>
				      <div class="jobs-price__content">
				         <h3 class="jobs__price u-text-right">$800</h3>
				         <a href="<?php the_permalink(); ?>">
				            <div class="button button--longer u-float-right">View</div>
				         </a>
				      </div>
				   </div>
				</div>
				<?php

					endwhile;
				?>
			</div>
			<?php
				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>
		</div>
	</div>

<?php
//get_sidebar();
get_footer();
