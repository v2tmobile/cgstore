<?php 
    query_posts(array('post_type'=>'challenge','posts_per_page'=>2));
    if(have_posts()){
          
 ?>
  <section class="content-section">
			<div class="container">
				<header class="content-heading">
					<h2 class="content-heading-title">Challenges</h2>
					<p class="content-heading-subtitle">Choose any ongoing challenge and take part to win</p>
				</header>
				<div class="challenges-list">
				  <?php  while( have_posts()) {
           	               the_post();
                   ?>
					<div class="challenge">
						<div class="challenge-content">
							<div class="challenge-image">
							<?php if ( has_post_thumbnail() ) : ?>
								    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								        <?php the_post_thumbnail('large'); ?>
								    </a>
								<?php endif; ?>
							</div>
							<div class="challenge-inner">
								<h3 class="challenge-title">
									<a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a>
								</h3>
								<div class="challenge-description">
								<?php
                                      the_content();
								 ?></div>
								<div class="challenge-info">
									<div class="challenge-deadline">
									 <?php 
                                       $date = get_field('challenge_date',get_the_ID());
									 ?>
										<span>Ends in: <b><?php echo $date; ?></b></span>
									</div>
									<div class="challenge-action">
										<a href="<?php the_permalink(); ?>"><button class="button">Join Challenge</button>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					
				</div>
				<p class="u-text-right"><a class="button button-forward" href="<?php echo HOME_URL; ?>/challenge/">View more challenges <i class="fa fa-chevron-right"></i> </a></p>
			</div>
</section>
<?php } ?>