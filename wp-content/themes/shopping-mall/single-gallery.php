<?php get_header(); ?>
	<?php
		while ( have_posts() ) : the_post();
		?>
	<div class="content-area site-page--gallery">
	  	<section class="content-section blog-post">
			<div class="container">
				
				<div class="gallery">
					<div class="gallery__main">
						<h3 class="gallery__title"><?php echo get_the_title(get_the_ID()); ?></h3>
						<div class="gallery__header">
							<div class="gallery__info">Posted in <a href="/gallery/category/car">Car</a> 5 days ago<div class="gallery__author">by 
								<div class="avatar avatar--small">
									<a href="<?php echo bp_loggedin_user_domain(); ?>"> <?php bp_loggedin_user_avatar( 'type=thumb&width=30&height=30' );?></a>
									</div>
									<a href="<?php echo bp_loggedin_user_domain(); ?>"><?php bp_get_displayed_user_fullname() ?></a>
								</div>
							</div>
						</div>
						<div class="box gallery__images">
							<div class="l-inner-compact">
								<?php
	                                  the_content()
								 ?>
							</div>
						</div>
						<div class="gallery__description"><?php echo get_the_excerpt();?></div>
						<div class="tag-list">
							<span>Tags:</span>
							<?php
								if(get_the_tag_list()) {
								    echo get_the_tag_list('<ul><li>','</li><li>','</li></ul>');
								}
							?>
						</div>
						<div class="yourcomment">
							<h3 class="content-heading__title">Comments</h3>
							<?php
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
							?>
						</div>
					</div>
					<div class="gallery__sidebar">
						<div class="gallery__like">
							<?php 
				                  $liked = ''; 
				                  $onclick = 'ats_load_form();'; 
				                  $total_like = get_post_meta($id,PREFIX_WEBSITE.'total_like',true);
				                 if(is_user_logged_in()): 
				                  $key = wp_create_nonce('cgs-security-like');  
				                  $current_user = wp_get_current_user();
				                  $likes  = get_user_meta($current_user->ID,PREFIX_WEBSITE.'likes',true);
				                  if(!is_array($likes)) $likes = (array) $likes;
				                  if(in_array($id,(array)$likes)) :
				                      $liked = 'liked'; 
				                      $key = wp_create_nonce('cgs-security-unlike'); 
				                      $onclick ='cgs_on_unlike(\''.$key.'\',\''.$id.'\',this)';
				                   else: 
				                     $onclick ='cgs_on_like(\''.$key.'\',\''.$id.'\',this)';
				                    endif;

				                 endif;
					        ?>
							<div class="like-button js-auth-control js-like" data-item-id="8436" data-item-type="Gallery">
								<div class="like-button__text" onclick="<?php echo $onclick; ?>">Like this</div>
								<div class="like-button__counter"><?php echo ($total_like) ? $total_like : 0 ; ?></div>
							</div>
						</div>
						<div class="card">
						   <div class="card__content">
						      <ul class="list list--inline gallery__stats">
						         <li><img alt="Views" class="js-tooltip tooltipstered" width="30" height="30" src="<?php echo TEMPLATE_PATH ?>/images/eye.png"> <span>45</span></li>
						         <li><img alt="Likes" class="js-tooltip tooltipstered" width="30" height="30" src="<?php echo TEMPLATE_PATH ?>/images/heart.png"> <span><?php echo ($total_like) ? $total_like : 0 ; ?></span></li>
						         <li><img alt="Comments" class="js-tooltip tooltipstered" width="30" height="30" src="<?php echo TEMPLATE_PATH ?>/images/conversation.png"> <span><?php echo get_comments_number();?></span></li>
						      </ul>
						   </div>
						</div>
						<div class="card">
						   <div class="card__content">
						      <h4 class="card__heading">More by PLC</h4>
						      <div class="card__wrapper">
						         <ul class="galleries">
						            <li><a class="js-tooltip tooltipstered" id="a038a0e80d88ce23f5cbb149c2ec12bc" href="https://www.cgtrader.com/gallery/project/car-rims-3-pieces"><img alt="Car Rims - 3 pieces" src="https://img-new.cgtrader.com/galleries/2625/thumb_29c66ca1-e79f-477e-9a3f-ed2057db2bbb.jpg"></a></li>
						         </ul>
						         <div class="u-text-right"><a id="393b54da54dc6725df030b07e8677e10" href="/gallery/author/PLC">More user projects <i class="fa fa-chevron-right"></i> </a></div>
						      </div>
						   </div>
						</div>
					</div>
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