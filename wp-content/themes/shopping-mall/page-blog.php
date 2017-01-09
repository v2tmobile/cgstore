<?php
/* Template Name: Jobs Page */
/**
 * @package Shopping_Mall
 */

get_header(); ?>

<?php 
    query_posts(array('post_type'=>'post','posts_per_page'=>1));
    if(have_posts()){
          
 ?>
  <div class="content-area">
  	<section class="content-section blog-post">
		<div class="container">
			<header class="content-heading">
				<h2 class="content-heading-title">3D Model Platform Blog</h2>
				<p class="content-heading-subtitle">News, insights and inspiration of 3D modeling.</p>
			</header>

			<div class="challenges-list">
				<div class="blog-content__main">
			  <?php  while( have_posts()) {
       	               the_post();
               ?>
				<div class="challenge ">
					<div class="challenge-content">
						<div class="challenge-image">
						<?php if ( has_post_thumbnail() ) : ?>
							    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							        <?php the_post_thumbnail('large'); ?>
							    </a>
							<?php endif; ?>
						</div>
						<div class="challenge-inner">
							<p class="muted text-flat"><?php the_time('F jS, Y'); ?></p>
							<h3 class="challenge-title">
								<a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a>
							</h3>

							<div class="challenge-description">
							<?php
                                  wp_trim_words(the_content(), 300);
							 ?></div>
							<div class="challenge-info">
								<i class="icon-comments"></i>
								<i class="fa fa-commenting-o fa-lg"></i>
								<?php echo get_comments_number();?>
								<a class="u-float-right" href="<?php the_permalink(); ?>" style="text-decoration: underline;">Read article</a>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				</div>
				<?php get_sidebar('blog');?>
				
			</div>
		</div>
	</section>

  </div>
<?php } ?>

<?php get_footer(); ?>