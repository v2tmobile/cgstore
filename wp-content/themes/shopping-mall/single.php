<?php get_header(); ?>
	<?php
		while ( have_posts() ) : the_post();
		?>
	<div class="content-area">
	  	<section class="content-section blog-post">
			<div class="container">
				<header class="content-heading">
					<h2 class="content-heading-title">3D Model Platform Blog</h2>
					<p class="content-heading-subtitle">News, insights and inspiration of 3D modeling.</p>
				</header>
				<div class="back-to-posts"><a href="<?php echo esc_url( home_url( '/' ) ); ?>blog">Back to posts</a></div>
				<div class="challenges-list">
					<div class="blog-content__main">
						<div class="challenge ">
							<div class="challenge-content">
								<div class="challenge-image">
								<?php echo get_the_post_thumbnail(get_the_ID());?>
								</div>
								<div class="challenge-inner">
									<p class="muted text-flat"><?php echo get_the_time('F jS, Y'); ?></p>
									<h3 class="challenge-title">
										<a href="<?php the_permalink(); ?>"><span><?php echo get_the_title(get_the_ID()); ?></span></a>
									</h3>

									<div class="challenge-description">
									<?php
		                                  the_content()
									 ?></div>
									<div class="tag-list">
										<span>Tags:</span>
										<?php
											if(get_the_tag_list()) {
											    echo get_the_tag_list('<ul><li>','</li><li>','</li></ul>');
											}
										?>
									</div>
								</div>
								<div class="posts-navigation">
									<?php echo previous_post_link('&laquo; &laquo; %', 'Previous Post', 'yes'); ?> 
									<?php echo next_post_link('% &raquo; &raquo; ', 'Next Post', 'yes'); ?>
								</div>
							</div>
						</div>
						<div class="yourcomment">
							<h3 class="content-heading__title">Comments</h3>
							<p class="content-heading__subtitle">Tell us what you think!</p>
						<?php
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						?>
						</div>
					</div>
					<?php get_sidebar('blog');?>
					
				</div>
			</div>
		</section>

	  </div>
	<?php
		endwhile; // End of the loop.
		?>


<?php
//get_sidebar();
get_footer();