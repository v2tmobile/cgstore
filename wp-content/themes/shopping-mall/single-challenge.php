<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
		<?php
		while ( have_posts() ) : the_post();
		?>
		<div class="challenge-header">
			<?php echo get_the_post_thumbnail(get_the_ID());?>
		</div>
		<div class="challenge-content">
			<h1 class="challenge-content__title"><?php the_title();?></h1>
			<div class="challenge-content__description">
				<?php the_content();?>
			</div>
			<div class="challenge-content__subtitle">Participation</div>
			<div class="challenge-info">
			   <div class="challenge-info__action"><a class="button button--alt button--material js-publisher-trigger js-auth-control" id="" href="javascript:;">Upload 3D Model</a></div>
			   <div class="challenge-info__countdown">
			      <div class="countdown js-countdown" data-timestamp="2017-03-23 23:59:59 UTC">
			         <div class="countdown__block countdown__months">0M</div>
			         <div class="countdown__block countdown__days">23d</div>
			         <div class="countdown__block countdown__hours">16h</div>
			         <div class="countdown__block countdown__minutes">22m</div>
			         <div class="countdown__block countdown__seconds">57s</div>
			      </div>
			   </div>
			   <div class="challenge-info__deadline">Ends in: <b>24 days</b> (2017-01-23 23:59:59 UTC) </div>
			   <div class="clear"></div>
			</div>
			<div class="challenge__share">
			   <span>Share challenge:</span>
			   <?php get_template_part('home/socials')?>
			</div>
			<div class="yourcomment">
				<h3>Post a comment</h3>
			<?php
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>
			</div>
		</div>

		<?php
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
<script>
$(document).ready(function(){

	var finalDate = $('.js-countdown').attr('data-timestamp');
	finalDate = new Date(finalDate);
	$('.js-countdown').countdown(finalDate, function(event) {
		$week = event.strftime('%W');
		$day = event.strftime('%D');
		$hour = event.strftime('%H');
		$minute = event.strftime('%M');
		$second = event.strftime('%S');
		$('.countdown__months').html($week + 'W');
		$('.countdown__days').html($day + 'd');
		$('.countdown__hours').html($hour + 'h');
		$('.countdown__minutes').html($minute + 'm');
		$('.countdown__seconds').html($second + 's');
	});
});
</script>
<?php
//get_sidebar();
get_footer();

