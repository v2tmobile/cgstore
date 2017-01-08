<?php get_header(); ?>
	
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
			<?php
				if ( have_posts() ) : ?>
			<div class="jobs-header">
			   <h1 class="jobs-header__title">3D Jobs</h1>
			   <div class="jobs-header__content">
			      <p class="jobs-header__annotation">Looking for a custom 3D model? Post your job offer below and get automatically connected with thousands of designers on CGTrader.</p>
			   </div>
			   <a class="button button--longer u-float-right" href="<?php echo HOME_URL; ?>/post-job/">Post a job!</a>
			   <div class="clear"></div>
			</div>
			

			<div class="job-content">
				<?php get_sidebar('job');?>
				<?php
				/* Start the Loop */
					while ( have_posts() ) : the_post();
	                 $id = get_the_ID();
	                 $price_job = get_field(PREFIX_WEBSITE.'price_job',$id);
	                 $applicant = get_field(PREFIX_WEBSITE.'applicant_job',$id);
	                 $job_date = get_field(PREFIX_WEBSITE.'deadline_job',$id);
	                 $number_day = getNumberDay($job_date); 
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
				                  <div class="label--hexagon"><span>
				                  	<?php 
                                      $type_job = get_the_terms($id,'type_job');
                                      echo $type_job[0]->name;
				                  	?>
				                  </span></div>
				               </div>
				            </li>
				            <li>
				               <div class="jobs__deadline"><span class="label--hexagon"><?php echo $number_day; ?> day(s) to finish</span></div>
				            </li>
				            <li>
				               <div class="jobs__aplicants">
				                  <div class="label--hexagon"><span><?php echo ($applicant) ? cout($applicant) : 0; ?> applicant</span></div>
				               </div>
				            </li>
				         </ul>
				         <div class="clear"></div>
				        <?php 
                            $job_formats = get_the_terms($id,'job_format');
                            if($job_formats):
				         ?>
				         <div class="tag-list">
				            <ul>
				               <?php foreach ($job_formats as $fomat):?>
				               <li><?php echo $fomat->name; ?></li>
				               <?php endforeach; ?>
				              
				            </ul>
				         </div>
				       <?php endif; ?>
				      </div>
				      <div class="jobs-price__content">
				         <h3 class="jobs__price u-text-right">$<?php echo ($price_job)?  $price_job : 0; ?></h3>
				       <?php if(!current_user_can( 'administrator') || !is_user_logged_in() || get_the_author_ID() != get_current_user_id() ):  ?>
				         <a href="<?php the_permalink(); ?>">
				            <div class="button button--longer u-float-right">View</div>
				         </a>
				       <?php else: ?>
				       	<a href="<?php echo HOME_URL.'/post-job/?id='.$id; ?>">
				            <div class="button button--longer u-float-right">Edit</div>
				         </a>
				       <?php endif; ?>
				      </div>
				   </div>
				</div>
				<?php
					endwhile;
				?>
			</div>
			<?php
				the_posts_navigation();
			   else:
				get_template_part( 'template-parts/content', 'none' );
			endif; ?>
		</div>
	</div>

<?php
get_footer();
