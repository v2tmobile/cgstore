<?php
/* Template Name: Galleries Page */
/**
 * @package Shopping_Mall
 */

get_header(); ?>

<div class="galleries-page">
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
		              <span itemprop="name">Galleries</span>
		            </span>
		                <meta content="2" itemprop="position">
		        </li>
            </ul>
		</div>

		<div class="content-heading">
		   <h2 class="content-heading__title">Community Showcase</h2>
		   <p class="content-heading__subtitle">Showcase your creative work or discover other designers and their work - it's a perfect opportunity to get exposure and respect that you deserve! And it's absolutely free! 
		   	<a class="js-auth-control" data-referer="gallery upload" href="<?php echo HOME_URL?>/gallery-new/">Upload project today</a>! </p>
		</div>

		<h4>Categories</h4>

		<div class="category-cluster category-cluster--packed">
		   <ul>
		   	<?php
	      		 $type_gallery_tax = 'category_gallery';
			  $type_galleries = get_terms( $type_gallery_tax, 'orderby=count&hide_empty=0' );
			  if($type_galleries):
			  	foreach ($type_galleries as $type_gallery):
            ?>
	         	<li class="category-cluster__item"><a href="<?php echo get_category_link($type_gallery->term_id);?>"><?php echo $type_gallery->name;?></a></li>

	         <?php endforeach; endif; ?>
		   	
			   
		   </ul>
		   <div class="clear"></div>
		</div>

		<div class="tabs-container">
			<ul class="tabs">
			   <li class="tabs__item is-active"><a href="/gallery">Popular</a></li>
			   <li class="tabs__item"><a href="/gallery/newest">Newest</a></li>
			   <li class="tabs__item"><a href="/gallery/lifetime">All time</a></li>
			</ul>
			<div class="clear"></div>
		</div>

		<div class="tabs-container">
			<div class="gallery-items">
				<?php 
					$authorid = $_GET['userid'];
					if(!empty($authorid)){
					    query_posts(array('post_type'=>'gallery','author' =>  $authorid,'posts_per_page'=>10));
					}else{
						query_posts(array('post_type'=>'gallery','posts_per_page'=>10));
					}
				    if(have_posts()){
				        while( have_posts()) {
           	               the_post();
           	               $liked = ''; 
		                  $onclick = 'ats_load_form();'; 
		                  $total_like = get_post_meta(get_the_ID(),PREFIX_WEBSITE.'total_like',true);
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
				 ?>
				<article class="gallery-item js-gallery-item" data-item-id="<?php the_ID()?>" >
				   <div class="box">
				      <div class="l-inner-compact">
				         <h3 class="gallery-item__title"><a id="" href="<?php the_permalink();?>"><?php the_title();?></a></h3>
				         <div class="gallery-item__image">
			         	<?php if ( has_post_thumbnail() ) : ?>
							    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							        <?php the_post_thumbnail('large'); ?>
							    </a>
							<?php endif; ?>
				         </div>
				         <div class="gallery-item__author">by <a href="<?php echo get_the_author_link(the_ID());?>"><?php echo get_the_author_meta('display_name') ;?></a></div>
				         <div class="gallery-item__info">
				            <div class="gallery-item__like">
				               <div class="like-button js-auth-control js-like" data-item-id="5683" data-item-type="Gallery">
				                  <div class="like-button__text">Like this</div>
				                  <div class="like-button__counter"><?php echo ($total_like) ? $total_like : 0 ; ?></div>
				               </div>
				            </div>
				            <div class="gallery-item__stats">
				               <ul class="list list--inline">
				                  <li><i class="fa fa-eye fa-lg fa-red"></i> <b>
				                  	0
				                  </b></li>
				                  <li><i class="fa fa-commenting-o fa-lg fa-red"></i> <b><?php echo get_comments_number();?></b></li>
				               </ul>
				            </div>
				         </div>
				      </div>
				   </div>
				</article>
					<?php } ?>
				<?php } ?>
				
			</div>

		</div>
	</div>
</div>

<?php get_footer(); ?>
