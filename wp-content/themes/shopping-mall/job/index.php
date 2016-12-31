<?php 
    query_posts(array('post_type'=>'jobs','posts_per_page'=>5));
    if(have_posts()){
          
 ?>
<section class="content-section">
	<div class="container">
		<header class="content-heading">
			<h2 class="content-heading-title">3D Modelling Jobs</h2>
			<p class="content-heading-subtitle">Browse job offers below and make a 3D model for someone else!.</p>
		</header>
		<div class="jobs-list">
			<?php  while( have_posts()) {
           	               the_post();
                   ?>
			<div class="job">
				<h3 class="job-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<div class="job-deadline">Valid until: <b>2017-01-07</b></div>
			</div>
			<?php } ?>
			<div class="job" style="border-bottom: none;"></div>
		<p class="u-text-right"><a class="button button-forward" href="<?php echo HOME_URL; ?>/jobs/">Find jobs <i class="fa fa-chevron-right"></i> </a></p>
	</div>
</section>

  
<?php } ?>