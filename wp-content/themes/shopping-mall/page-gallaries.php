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
		   <p class="content-heading__subtitle">Showcase your creative work or discover other designers and their work - it's a perfect opportunity to get exposure and respect that you deserve! And it's absolutely free! <a class="js-auth-control" data-referer="gallery upload" id="817744576d30c9f66f0b33b88995f24f" href="/profile/gallery/new">Upload project today</a>! </p>
		</div>

		<h4>Categories</h4>

		<div class="category-cluster category-cluster--packed">
		   <ul>
		   	<li class="category-cluster__item"><a id="6b6b23804425c991ed4ebe280b3cf57a" href="/gallery/category/scene">Scene</a></li>
			   <li class="category-cluster__item"><a id="808ec97709498faf75a9792b73750b5b" href="/gallery/category/abstract">Abstract</a></li>
			   <li class="category-cluster__item"><a id="e244045b06c6d5b1127c800ae83bf11d" href="/gallery/category/architecture">Architecture</a></li>
			   <li class="category-cluster__item"><a id="397b55c5acf4bedee98baef6537e40d7" href="/gallery/category/car">Car</a></li>
			   <li class="category-cluster__item"><a id="dc6e297a85f4b82bc2680b8be0d0aa7c" href="/gallery/category/character">Character</a></li>
			   <li class="category-cluster__item"><a id="3030be97a616c08fc7f3fee8eb5e4131" href="/gallery/category/creature">Creature</a></li>
			   <li class="category-cluster__item"><a id="500b5652e4bd8656b33fdf336ee80243" href="/gallery/category/fantasy">Fantasy</a></li>
			   <li class="category-cluster__item"><a id="9d44d6f581fff5b34b41e3d04a059076" href="/gallery/category/interior">Interior</a></li>
			   <li class="category-cluster__item"><a id="9f901f33e746522fc2689fb037f35378" href="/gallery/category/industrial-design">Industrial Design</a></li>
			   <li class="category-cluster__item"><a id="00f2357ba843484bd9ad55991605d401" href="/gallery/category/landscape">Landscape</a></li>
			   <li class="category-cluster__item"><a id="c7851622ddfe149804335d941953f86b" href="/gallery/category/realism">Realism</a></li>
			   <li class="category-cluster__item"><a id="eda972aed0df7219383475326d01557e" href="/gallery/category/sci-fi">Sci-Fi</a></li>
			   <li class="category-cluster__item"><a id="22af4262230e44c084f892d191ec1c50" href="/gallery/category/surrealism">Surrealism</a></li>
			   <li class="category-cluster__item"><a id="7c428f047ef28fda229595f37228a6e9" href="/gallery/category/vehicle">Vehicle</a></li>
			   <li class="category-cluster__item"><a id="968c3b1494fea8fd332e5b4b629a7987" href="/gallery/category/electronics">Electronics</a></li>
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
				    query_posts(array('post_type'=>'gallery','posts_per_page'=>10));
				    if(have_posts()){
				        while( have_posts()) {
           	               the_post();
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
				         <div class="gallery-item__author">by <a id="" href="<?php echo get_the_author_link(the_ID());?>"><?php echo get_author_name(the_ID());?></a></div>
				         <div class="gallery-item__info">
				            <div class="gallery-item__like">
				               <div class="like-button js-auth-control js-like" data-item-id="5683" data-item-type="Gallery">
				                  <div class="like-button__text">Like this</div>
				                  <div class="like-button__counter">147</div>
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
