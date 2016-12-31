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
<?php $cart_total = WC()->cart->get_cart_contents_count(); ?>
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
					<?php if( is_user_logged_in() ) {
                          
						?>
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
									<span class="cart-indicator indicator is-sticky ">
									<?php echo $cart_total; ?>
									</a></span>
								</a>
								<?php echo get_template_part('list-cart/list-cart'); ?>
							</li>
						</ul>
					<?php } else { ?>
						<ul class="sign-box">
						   <li class="notification-item js-cart-trigger"><a class="has-indicator" href="#"><i class="fa fa-shopping-cart fa-24"></i><span class="cart-indicator indicator is-sticky"><?php echo $cart_total; ?></span></a>
                             <?php echo get_template_part('list-cart/list-cart'); ?>
						   </li>
						   <li class="notification-item is-flexible"><a class="site-notification-nav__link" href="<?php HOME_URL;?>/login/" ><i class="fa fa-user fa-24"></i> Sign in</a></li>
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
