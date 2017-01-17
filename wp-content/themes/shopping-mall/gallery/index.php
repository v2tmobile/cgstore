<?php 
    query_posts(array('post_type'=>'gallery','posts_per_page'=>10));
    if(have_posts()){
          
 ?>
<section class="content-section light">
	<hr class="split">
	<div class="container">
		<header class="content-heading">
			<h2 class="content-heading-title">Galleries</h2>
			<p class="content-heading-subtitle">Showcase your creative work or discover other designers and their work - it's a perfect opportunity to get exposure and respect that you deserve!</p>
		</header>
		<div class="showcase-items">
			 <?php  while( have_posts()) {
   	               the_post();
           ?>
			<article class="showcase-item">
				<div class="showcase-item-content">
					<header class="showcase-item-header">
						<h1 class="showcase-item-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h1>
						<div class="showcase-item-info">
							<?php
								$liked = ''; 
				                  $onclick = 'ats_load_form();'; 
				                  $id = get_the_ID();
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
							<div class="showcase-item-stats"><i class="fa fa-heart-o"></i><?php echo ($total_like) ? $total_like : 0 ; ?></div>
							<div class="showcase-item-author">
								<a href="<?php echo bp_loggedin_user_domain(); ?>"> <?php bp_loggedin_user_avatar( 'type=thumb&width=26&height=26' );?></a>
								<a href="<?php echo get_the_author_link(the_ID());?>"><?php echo get_the_author_meta('display_name') ;?></a>
							</div>
						</div>
					</header>
					<div class="showcase-item-image">
						<?php if ( has_post_thumbnail() ) : ?>
						    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						        <?php the_post_thumbnail('large'); ?>
						    </a>
						<?php endif; ?>
					</div>
				</div>
			</article>
			<?php } ?>
		</div>
	</div>
	<p class="u-text-right"><a class="button button-forward" href="<?php echo HOME_URL; ?>/gallery/">See more galleries <i class="fa fa-chevron-right"></i> </a></p>
</section>
<?php } ?>