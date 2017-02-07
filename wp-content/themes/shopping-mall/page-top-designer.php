<?php
/* Template Name: Top Designer Page */
/**
 * @package Shopping_Mall
 */

get_header(); ?>

<div class="forum-page">
	<div class="content-area">
		<div class="breadcrumb-wrapper" id="breadcrumb">
			<ul class="breadcrumb" itemscope="itemscope" itemtype="https://schema.org/BreadcrumbList">
               <li class="breadcrumb-item" itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
	                <a href="http://localhost/cgstore" itemprop="item" itemscope="itemscope" itemtype="http://schema.org/Thing" title="Home">
	                    <span itemprop="name">Home</span>
	                </a>
	                <meta content="1" itemprop="position">
            	</li>
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
		            <span itemprop="item" itemscope="itemscope" itemtype="http://schema.org/Thing">
		              <span itemprop="name">Forum</span>
		            </span>
		                <meta content="2" itemprop="position">
		        </li>
            </ul>
		</div>

		<div class="content-heading">
		   <h2 class="content-heading__title">Top Designers</h2>
		   <div class="content-heading__subtitle">Below is the list of top 3D designers on CGTrader. Their reputation score represents their activity on CGTrader - including the number of 3D models uploaded, sales, downloads, comments and rating of their work. CGTrader is a designer-friendly 3D model marketplace which aims to democratize 3D model market and provide the best conditions for 3D designers to buy, sell and share 3D models.</div>
		</div>
		
		<div class="users-search">
		   <form action="<?php echo HOME_URL;?>/designers/" method="get">
		      <div class="users-search__field">
		      <input type="text" name="keywords" id="keywords" class="field field--full" placeholder="Search by username or full name"></div>
		      <div class="users-search__sort filterSelect">
		         <select name="sort_by" id="sort_by" class="select">
		            <option value="relevance">Relevance</option>
		            <option value="reputation">Reputation</option>
		        </select>
		      </div>
		      <div class="users-search__action"><button name="" type="submit" class="button button--full">Search</button></div>
		      <div class="clear"></div>
		   </form>
		</div>
      
		<div class="users-list">
			<?php 
              $vendor_args = array(
              	 'role' 		    => 'vendor',
	  			 'orderby' 		    => 'post_count',
	  			 'order'			=> 'DESC',
				 'number'         => 12,
				 'show_products'	=> 'yes',
				 'search' => isset($_GET['keywords']) ? $_GET['keywords'] : '',
				 'search_columns'=>array('user_nicename')
			   );
             $vendor_query = New WP_User_Query( $vendor_args ); 
	  		 $all_vendors = $vendor_query->get_results(); 
	  		 if($all_vendors){
	  		 	foreach ($all_vendors as $vendor) {
	  		 	 $count_product = count_user_posts($vendor->ID,'product');
	  		 	 ?>
              <div class="box user tooltip product-grid-item">
				<div class="l-inner">
					<div class="user__header">
					   <div class="user__rank"><span class="js-tooltip tooltipstered"># <?php echo $vendor->ID; ?></span></div>
					   <div class="user__avatar">
					      <div class="avatar">
					      <a href="<?php echo get_author_posts_url($vendor->ID); ?>" title="<?php the_author_meta( 'user_nicename', $vendor->ID );?>">
					      	<?php 
                              echo bp_core_fetch_avatar('item_id='.$vendor->ID);
                            ?>
                      </a>
					      </div>
					   </div>
					   <div class="user__name">
					      <h4><a id="" href="<?php echo get_author_posts_url($vendor->ID); ?>"><?php the_author_meta( 'user_nicename', $vendor->ID );?></a></h4>
					   </div>
					   <div class="user__tags">
					      <div class="tag-list">
					         <ul>
					            <li><a id="" href="#">car</a></li>
					            <li><a id="" href="#">fbx</a></li>
					            <li><a id="" href="#">2015</a></li>
					            <li><a id="" href="#">2016</a></li>
					            <li><a id="" href="#">sport</a></li>
					         </ul>
					      </div>
					   </div>
					   <div class="clear"></div>
					</div>
					<div class="user__info">
					   <ul class="list list--inline">
					      <li>Models: <b><?php echo $count_product; ?></b></li>
					      <li>Profile Views: <b><?php echo get_bp_userviews($vendor->ID); ?></b></li>
					      <li>Reputation: <b>0</b></li>
					   </ul>
					</div>
					<div class="user__items">
						<div class="items-list">
							<div class="content-box-wrapper grid grid--dense">
							 <?php 
                               query_posts(array('author'=>$vendor->ID,'post_type'=>'product'));
                                 if(have_posts()):
                                  while(have_posts()) : the_post();
                                    global $product;
                                  	$product = new WC_Product( get_the_ID() );
								    if ( !has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
								        $image = get_template_directory_uri() . '/images/cg-holder.png';
								    }
								    $attachment_ids = $product->get_gallery_attachment_ids();
								    $listImgs = [];
								    foreach( $attachment_ids as $attachment_id )
								            {
								                $image_link = wp_get_attachment_image_src( $attachment_id,'medium');
								                $listImgs[] = $image_link[0];
								            }
                                
							 ?>
								<div class="grid__col">
								   <div class="content-box content-box--compact content-box--interactive tooltipstered" data-toggle="tooltip" >
								   	<input type="hidden" class="tooltip-data" value= '<?php echo json_encode($listImgs); ?>'>
								      <div class="content-box__content">
								         <a class="content-box-link" href="<?php echo get_permalink(get_the_ID())?>" title="<?php echo get_the_title(get_the_ID())?>">
									            <figure class="content-box-image">
									                <img alt="<?php echo get_the_title(get_the_ID())?>" src="<?php echo isset($image) ? $image : the_post_thumbnail_url('medium')?>">
									               
									            </figure>
									        </a>
								      </div>
								      <div class="content-box__price"><?php echo $product->get_price_html() ?></div>
								      <div class="content-box__controls">
								         <div class="content-box__control js-carousel-trigger" data-direction="prev">
								         	<button class="action prev slick-arrow" style="display: inline-block;">
		                                        <i class="fa fa-chevron-left fa-lg"></i>
		                                    </button>
	                                	  </div>
								         <div class="content-box__control js-carousel-trigger" data-direction="next">
								         	<button class="action next slick-arrow" style="display: inline-block;">
		                                        <i class="fa fa-chevron-right fa-lg"></i>
		                                    </button>
								         </div>
								      </div>
								   </div>
								</div>
                           <?php endwhile; ?>
							<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
		  	  </div>

	  		 	 <?php 

	  		 	}
	  		 }
			 

			 ?>

			<div class="clear"></div>
			
		</div>

		
	</div>
</div>

<?php get_footer(); ?>
