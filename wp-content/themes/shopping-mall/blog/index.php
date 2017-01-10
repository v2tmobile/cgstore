<?php 
    query_posts(array('post_type'=>'challenge','posts_per_page'=>2));
    if(have_posts()){
          
 ?>
<section class="content-section light">
	<div class="container">
		<header class="content-heading">
			<h2 class="content-heading-title">Looking for inspiration?</h2>
			<p class="content-heading-subtitle">Hand-picked stories, news and inspiration of 3D modelling world</p>
		</header>
		<div class="blog-posts">
		<?php  while( have_posts()) {
   	               the_post();
           ?>
			<div class="blog-post">
				<div class="blog-post-content">
					<div class="blog-post-image">
					<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail('large'); ?>
						<?php endif; ?>
					</div>
				</div>
				<h3 class="blog-post-title">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<span><?php the_title(); ?></span>
					</a>
				</h3>
			</div>
			<?php } ?>
		</div>
			
		</div>
	</div>
	<p class="u-text-right"><a class="button button-forward" href="<?php echo HOME_URL; ?>/blog/">Read more blog posts <i class="fa fa-chevron-right"></i> </a></p>
</section>
<?php } ?>