<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, user-scalable=1, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="icon" type="image/ico" href="favicon.ico">
	<link rel="icon" type="image/png" href="favicon.png">
	<!-- CSS, you gotta have style -->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="wrapper">
	<div class="container">
		<header class="header">
			<div class="top-nav">

			</div>
			<div class="main-nav">
				<div class="left">
					<div class="logo">
						<span><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></span>
					</div>
				</div>
				<div class="middle">
					<nav class="primary-navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'nav', 'container' => '' ) ); ?>
					</nav>
				</div>
				<div class="right">
					<div class="notification-nav">
					<?php if( is_user_logged_in() ) {?>
						<ul>
							<li class="notification-item">
								<a href="javascript:;" class="menu">
									<i class="fa fa-bars fa-24"></i>
								</a>
							</li>
							<li class="notification-item">
								<a href="#"><img alt="v2tmobile_it" class="avatar avatar-small" src="https://assets.cgtrader.com/assets/avatar/small_avatar-04ef157a5b11c33ad48fe0d8dee962db9a781ddb0c5eed3c4023767c3bfa7827.png"></a>
							</li>
							<li class="notification-item">
								<a class="has-indicator" href="#">
									<i class="fa fa-envelope fa-24"></i>
								</a>
							</li>
							<li class="notification-item">
								<a class="has-indicator" href="#">
									<i class="fa fa-bell fa-24"></i>
									<span class="cart-indicator indicator is-sticky ">1</span>
								</a>
							</li>
							<li class="notification-item">
								<a class="has-indicator" id="linkCartPopup" href="#">
									<i class="fa fa-shopping-cart fa-24"></i>
									<span class="cart-indicator indicator is-sticky "><?php echo WC()->cart->get_cart_contents_count(); ?></a></span>
								</a>
								<div id="cart-box-content" class="popover-box">
									<div class="popover-box__inner">
									   <h4 class="popover-box__title">Shopping cart</h4>
									   <!-- react-text: 106 -->You have <!-- /react-text --><span class="indicator cart-indicator">2</span><!-- react-text: 108 --> items in your shopping cart.<!-- /react-text -->
									</div>
									<div class="popover-box__inner">
									   <div class="product-list product-list--on-contrast">
									      <article class="product-list__item">
									         <div class="product-list__item-preview">
									         	<a href="#" title="SimplePoly Urban - Low Poly Assets">
										         	<img alt="SimplePoly Urban - Low Poly Assets" src="https://img2.cgtrader.com/items/658464/7a412b2f43/thumb/simplepoly-urban-low-poly-assets-3d-model-low-poly-fbx.jpg">
										        </a>
									         </div>
									         <div class="product-list__item-info">
									            <h1 class="product-list__item-title"><a href="/3d-models/architectural-exterior/cityscape/simplepoly-urban-low-poly-assets">SimplePoly Urban - Low Poly As...</a></h1>
									            <div class="product-list__item-summary">3D model</div>
									         </div>
									         <div class="product-list__item-price">
									            <!-- react-text: 120 -->$<!-- /react-text --><!-- react-text: 121 -->28<!-- /react-text -->
									         </div>
									         <div class="product-list__item-remove has-tooltip tooltipstered"><i class="fa fa-times-circle-o fa-lg"></i></div>
									      </article>
									      <article class="product-list__item" >
									         <div class="product-list__item-preview"><a href="/3d-models/art/coins-badges/kiddie-ride-pack" title="Kiddie Ride Pack"><img alt="Kiddie Ride Pack" src="https://img1.cgtrader.com/items/66966/fa6f093b94/thumb/kiddie-ride-pack-3d-model-low-poly-obj-stl-blend-dae.jpg"></a></div>
									         <div class="product-list__item-info">
									            <h1 class="product-list__item-title"><a href="/3d-models/art/coins-badges/kiddie-ride-pack">Kiddie Ride Pack</a></h1>
									            <div class="product-list__item-summary">3D model</div>
									         </div>
									         <div class="product-list__item-price">
									            <!-- react-text: 133 -->$<!-- /react-text --><!-- react-text: 134 -->104.99<!-- /react-text -->
									         </div>
									         <div class="product-list__item-remove has-tooltip tooltipstered"><i class="fa fa-times-circle-o fa-lg"></i></div>
									      </article>
									   </div>
									   <div class="popover-box__actions">
									      <a href="<?php echo wc_get_cart_url(); ?>">
									         <i class="fa fa-shopping-cart fa-lg"></i><!-- react-text: 140 --> View cart<!-- /react-text -->
									      </a>
									      <a class="button button--compact button--alt u-float-right" href="/cg/checkout/payment">
									         <i class="fa fa-shopping-bag"></i><!-- react-text: 143 --> Proceed to checkout<!-- /react-text -->
									      </a>
									   </div>
									</div>
								</div>
							</li>
						</ul>
					<?php } else { ?>
						<ul class="sign-box">
						   <li class="notification-item js-cart-trigger"><a class="has-indicator" href="/cart"><i class="fa fa-shopping-cart fa-24"></i><span class="cart-indicator indicator is-sticky is-hidden">0</span></a></li>
						   <li class="notification-item is-flexible"><a class="site-notification-nav__link" href="/login" ><i class="fa fa-user fa-24"></i> Sign in</a></li>
						</ul>
					<?php }?>
				</div>
				</div>
			</div>
			
		</header>
	</div>
	<div class="header-search <?php if( is_user_logged_in() ) echo 'header-login';?>">
			<div class="header-content ">
				<?php if( !is_user_logged_in() ) {?>
				<h1 class="header__title">3D models for VR / AR, 3D printing and computer graphics</h1>
				<?php } ?>
				<div class="search-form">
					<form action="<?php echo home_url( '/' ); ?>" id="search-form" method="get">
						<input autocomplete="off" class="site-search-field" name="s" placeholder="Search 530 000 3D models" type="text" value="<?php echo get_search_query() ?>">
						<button class="site-search-button" type="submit"><i class="fa fa-search"></i> </button>
					</form>
					<div class="site-search-suggestions">
						<div class="js-search-results-container" style="display: none;">
							<div class="site-search-suggestions-heading">
								<div class="site-search-suggestions-col-suggestion">Suggestions</div>
								<div class="site-search-suggestions-col-cg">3D Models</div>
								<div class="site-search-suggestions-col-lowpoly">VR/ AR/ Low poly</div>
							</div>
							<ul class="site-search-suggestions-results js-search-results"></ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	<div class="main">
