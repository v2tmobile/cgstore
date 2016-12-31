<?php 
    query_posts(array('post_type'=>'tutorial','posts_per_page'=>4));
    if(have_posts()){
          
 ?>
 <section class="content-section light">
			<div class="container">
				<header class="content-heading">
					<h2 class="content-heading-title">Tutorials</h2>
					<p class="content-heading-subtitle">Quality 3D content and examples to learn from.</p>
				</header>
				
				<div class="tutorials">
					<?php  while( have_posts()) {
           	               the_post();
                   ?>
					<div class="tutorial">
						<div class="tutorial-content">
							<div class="tutorials-item">
								<div class="tutorials-item-image">
									<?php if ( has_post_thumbnail() ) : ?>
									    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									        <?php the_post_thumbnail('medium'); ?>
									    </a>
									<?php endif; ?>
								</div>
								<div class="tutorials-item-content">
									<a href="<?php the_permalink(); ?>"><h3 class="tutorials-title"><?php the_title(); ?></h3></a>
									<h4 class="tutorials-author"><span>by</span> <a href="#"><?php the_author(); ?></a></h4>
									<div class="tutorials-item-info">
										<div class="tag-list software">
											<ul>
												<i class="fa fa-wrench fa-lg"></i><li>ZBrush</li>
											</ul>
										</div>
										<div class="tag-list">
											<ul>
												<i class="fa fa-check fa-lg"></i><li>3D Modeling</li>
											</ul>
										</div>
									</div>
									<div class="tutorials-item-info">
										<div class="community-list"><i class="fa fa-heart"></i>1</div>
										<div class="community-list"><i class="fa fa-commenting-o"></i><?php echo get_comments_number();?></div>
										<div class="community-list"><i class="fa fa-eye"></i>43</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
				
				<p class="u-text-right"><a class="button button-forward" href="<?php echo HOME_URL; ?>/tutorials/">View more tutorials <i class="fa fa-chevron-right"></i> </a></p>
			</div>
		</section>
<?php } ?>