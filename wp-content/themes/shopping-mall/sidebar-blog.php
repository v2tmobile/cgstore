<div class="blog-content__sidebar">
	<?php
		if(is_single()){
	?>
		<div class="content-heading content-heading--small"><h4 class="content-heading__title">Share this blog post</h4></div>
		<div class="details-box card has-padding">
	        <div class="product-share-old">
	            <ul class="list list-inline u-text-center social-networks">
	                <li class="list-item">
	                    <a class="social-icon facebook" href="https://www.facebook.com/sharer.php?u=<?php echo $permalink; ?>" target="_blank">
	                        <span class="fa-stack fa-social-share fa-facebook-icon"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-inverse fa-stack-1x"></i></span>
	                    </a>
	                </li>
	                <li class="list-item">
	                    <a class="social-icon linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $permalink ?>&title=<?php echo $post_title ?>&summary=<?php echo $post->post_excerpt ?>" target="_blank">
	                        <span class="fa-stack fa-social-share fa-linkedin-icon"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-linkedin fa-inverse fa-stack-1x"></i></span>
	                    </a>
	                </li>
	                <li class="list-item">
	                    <a class="social-icon twitter" href="https://twitter.com/share?url=<?php echo $permalink; ?>" target="_blank">
	                        <span class="fa-stack fa-social-share fa-twitter-icon"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-inverse fa-stack-1x"></i></span>
	                    </a>
	                </li>
	                <li class="list-item">
	                    <a class="social-icon google-plus" href="https://plus.google.com/share?url=<?php echo $permalink; ?>" target="_blank">
	                        <span class="fa-stack fa-social-share fa-google-plus-icon"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-google-plus fa-inverse fa-stack-1x"></i></span>
	                    </a>
	                </li>
	                <li class="list-item is-last">
	                    <a class="social-icon pinterest" href="https://pinterest.com/pin/create/button/?url=<?php echo $permalink; ?>&amp;media=<?php echo $featured_image_2; ?>&amp;description=<?php echo $post_title; ?>" target="_blank">
	                        <span class="fa-stack fa-social-share fa-pinterest-icon"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-pinterest fa-inverse fa-stack-1x"></i></span>
	                    </a>
	                </li>
	            </ul>
	        </div>
	    </div>
	<?php }?>
	<div class="content-heading content-heading--small"><h4 class="content-heading__title">What do we write about?</h4></div>
	<div class="box">
	   <div class="l-inner">
	      <ul class="list list--stats">
	      	<?php
	      		$categories = get_categories(); //can add parameters here to swtich the order, etc;
			    if(!empty(categories)):
			        foreach($categories as $i => $category):
	      	?>
	         	<li class="list__item"><a href="<?php echo get_category_link($category->term_id);?>"><?php echo $category->name;?></a></li>

	         <?php endforeach; endif; ?>
	     </ul>
	 	</div>
	</div>
	<div class="content-heading content-heading--small"><h4 class="content-heading__title">Recent posts</h4></div>
	<div class="box">
	   <div class="l-inner">
	      <ul class="list list--stats">
	      	<?php $args = array(
				'posts_per_page'   => 5,
				'post_type'        => 'post'
			);
			$posts_array = get_posts( $args ); 
			foreach ( $posts_array as $post ) : setup_postdata( $post ); ?>
				<li class="list__item">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</li>
			<?php endforeach; ?>
	     </ul>
	 	</div>
	</div>
	<div class="content-heading content-heading--small"><h4 class="content-heading__title">Buy 3D Models</h4></div>
	<div class="box">
	   <div class="l-inner">
	      <ul class="list list--stats">
	      	<?php
	      	$args = array( 'taxonomy' => 'product_cat' );
			$terms = get_terms('product_cat', $args);

			if (count($terms) > 0) {
			    foreach ($terms as $term) {

			?>
			<li class="list__item">
				<a href="<?php echo get_term_link($term->slug, 'product_cat');?>" title="<?php echo $term->name;?>"><?php echo $term->name ?> </a> 
			</li>
			           
			<?php
			    }
			}
	      	?>
	     </ul>
	 	</div>
	</div>
</div>