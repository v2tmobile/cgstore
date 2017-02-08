<div class="content-area">
<section class="content-section top-models">
		<div class="container">
			
				<header class="content-heading">
					<h2 class="content-heading-title">Top 3D Models</h2>
					<p class="content-heading-subtitle">Check the best 3D models available on CGStore.com. Can you do better? <a href="#" style="display: none;">Learn how to get on top of the list</a>! </p>
				</header>
				<div class="content-box-wrapper grid">
				 <?php
	                echo do_shortcode('[recent_products per_page="8" columns="4"]');
				  ?>
				</div>
				<div class="link-promo">
					<a href="#">CGStore community rating system</a>
				</div>
			</div>
		</section>
		<section class="content-section light top-designer">
			<div class="container">
				<header class="content-heading">
					<h2 class="content-heading-title">Top Designers This Week</h2>
					<p class="content-heading-subtitle">Want to get featured here? Upload your 3D models, sell and engage with your peers to become the top member of CGTrader community</p>
				</header>
				<div class="designers">
				  <?php 
				  add_action( 'pre_user_query', 'cgs_filter_vendor_product');
				  function cgs_filter_vendor_product($user_query){
				  	    global $wpdb;
					     $user_query->query_from = str_replace("post_type = 'post'","post_type = 'product'",$user_query->query_from); 
					     //$user_query->query_where  = $user_query->query_where . " AND {$wpdb->posts}.post_date > '" . date('Y-m-d', strtotime('-7 days')) . "'"; 
					    
					  }

                      $vendor_arg = array ( 
					  		'role' 				=> 'vendor', 
							'orderby' 			=> 'post_count',
							'per_page'=>3,
				  			'order'				=> 'DESC',
				  			'show_products'	=> 'no',
				  			'has_published_posts' => array('product')
					  	);
                    $vendor_paged_query = New WP_User_Query( $vendor_arg ); 
	  				$vendors = $vendor_paged_query->get_results(); 
	  				if($vendors) :
                       foreach($vendors as $vendor):
                       	 $count_product = 0;
                       	 $count_product = count_user_posts($vendor->ID,'product');
                       	 ?>
                     <div class="designer">
						<div class="designer-photo">
							<a href="<?php echo get_author_posts_url($vendor->ID); ?>" title="<?php the_author_meta( 'user_nicename', $vendor->ID );?>">
                      <?php 
                         echo bp_core_fetch_avatar('item_id='.$vendor->ID);
                      ?>
                    </a>
						</div>
						<div class="designer-content">
							<div class="designer-name"><?php the_author_meta( 'user_nicename', $vendor->ID );?></div>
							<ul class="designer-stats">
								<li>Weekly reputation: <b>0</b></li>
								<li>Models: <b><?php echo $count_product; ?></b></li>
							</ul>
							<div class="designer-link"><a href="<?php echo get_author_posts_url($vendor->ID); ?>" title="<?php the_author_meta( 'user_nicename', $vendor->ID );?>">View designer profile</a></div>
						</div>
					</div>

                       	<?php 
                       endforeach;
	  				endif;
				  ?>
					
				</div>
				<p class="u-text-right"><a class="button button-forward" href="<?php echo HOME_URL;?>/designers/">Find more designs <i class="fa fa-chevron-right"></i> </a></p>
				<div class="link-promo"><a href="<?php echo HOME_URL;?>/designers/">Learn more about royalty system and levels</a></div>
			</div>
		</section>
		<?php echo get_template_part('challenge/index'); ?>
		
		<?php echo get_template_part('tutorial/index'); ?>
		
		<?php echo get_template_part('job/index'); ?>

		<?php echo get_template_part('blog/index'); ?>
		
		<?php echo get_template_part('gallery/index'); ?>
		
		<section class="content-section">
			<div class="container">
				<header class="content-heading">
					<h2 class="content-heading-title">Forum</h2>
					<p class="content-heading-subtitle">Ask questions, showcase your work, give feedback and have fun chatting!</p>
				</header>
				<div class="forum-post-list">
				 <?php if ( bbp_has_topics( array( 'author' => 0, 'show_stickies' => false, 'order' => 'DESC', 'post_parent' => 'any', 'posts_per_page' => 5 ) ) ) : ?>
                        <?php while ( bbp_topics() ) : bbp_the_topic(); ?>
                        	<div class="forum-post"><h3 class="forum-post-title"><a href="<?php bbp_topic_permalink(); ?>"><?php bbp_topic_title(); ?></a></h3><div class="forum-post-last-activity">Last activity: <b><?php bbp_topic_freshness_link(); ?></b></div></div>
                       <?php endwhile; ?>
           <?php endif; ?>
					

				
				<p class="u-text-right"><a class="button button-forward" href="<?php echo HOME_URL; ?>/forums/">Visit forum <i class="fa fa-chevron-right"></i> </a></p>
			</div>
		</section>
	</div>