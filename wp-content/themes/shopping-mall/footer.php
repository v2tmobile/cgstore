</div>
<footer class="footer">
	<div class="container">
		<div class="site-logo dark">
			<span><a href="#">cgstore</a></span>
		</div>
		<div class="site-footer-links">
			<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container' => '', 'menu_class' => 'site-footer-links-list' ) ); ?>
			<div class="site-footer-copyright">
				<div class="site-footer-copyright-info">
					<p>Copyright © CGStore 2016. All rights reserved.</p>
				</div>
				<div class="site-footer-copyright-links">
					<?php wp_nav_menu( array( 'theme_location' => 'footer-terms-menu', 'container' => '') ); ?>
				</div>
			</div>
		</div>
		<div class="site-footer-social social-networks">
			<ul class="list list-inline">
				<?php 

					$facebook = get_field("facebook", "option");
					$linkedin = get_field("linkedin", "option");
					$twitter = get_field("twitter", "option");
					$instagram = get_field("instagram", "option");
					$pinterest = get_field("pinterest", "option");
					$google_plus = get_field("google_plus", "option");
				?>
				<?php if(!empty($facebook)) {?>
				<li class="list-item">
					<a href="<?php echo $facebook;?>" target="_blank" class="social-icon facebook">
						<span class="fa-stack fa-lg fa-facebook-icon"><i class="fa fa-circle fa-stack-2x"></i><i
								class="fa fa-facebook fa-inverse fa-stack-1x"></i></span>
					</a>
				</li>
				<?php } ?>
				<?php if(!empty($linkedin)) {?>
				<li class="list-item">
					<a href="<?php echo $linkedin;?>" target="_blank" class="social-icon linkedin">
						<span class="fa-stack fa-lg fa-linkedin-icon"><i class="fa fa-circle fa-stack-2x"></i><i
								class="fa fa-linkedin fa-inverse fa-stack-1x"></i></span>
					</a>
				</li>
				<?php } ?>
				<?php if(!empty($twitter)) {?>
				<li class="list-item">
					<a href="<?php echo $twitter;?>" target="_blank" class="social-icon twitter">
						<span class="fa-stack fa-lg fa-twitter-icon"><i class="fa fa-circle fa-stack-2x"></i><i
								class="fa fa-twitter fa-inverse fa-stack-1x"></i></span>
					</a>
				</li>
				<?php } ?>
				<?php if(!empty($instagram)) {?>
				<li class="list-item">
					<a href="<?php echo $instagram;?>" target="_blank" class="social-icon instagram">
						<span class="fa-stack fa-lg fa-instagram-icon"><i class="fa fa-circle fa-stack-2x"></i><i
								class="fa fa-instagram fa-inverse fa-stack-1x"></i></span>
					</a>
				</li>
				<?php } ?>
				<?php if(!empty($pinterest)) {?>
				<li class="list-item">
					<a href="<?php echo $pinterest;?>" target="_blank" class="social-icon pinterest">
						<span class="fa-stack fa-lg fa-pinterest-icon"><i class="fa fa-circle fa-stack-2x"></i><i
								class="fa fa-pinterest fa-inverse fa-stack-1x"></i></span>
					</a>
				</li>
				<?php } ?>
				<?php if(!empty($google_plus)) {?>
				<li class="list-item is-last">
					<a href="<?php echo $google_plus;?>" target="_blank" class="social-icon google-plus">
						<span class="fa-stack fa-lg fa-google-plus-icon"><i class="fa fa-circle fa-stack-2x"></i><i
								class="fa fa-google-plus fa-inverse fa-stack-1x"></i></span>
					</a>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</footer>
<div class="user-menu" id="user-menu">
	<div class="user-menu-section is-closed-off">
		<div class="user-menu-content">
			<button class="button big full" id="uploadProduct">Upload product</button>
		</div>
	</div>
	<div class="user-menu-section">
		<div class="user-menu-content">
			<h3 class="heading heading-small heading-on-contrast">Account</h3>
		</div>
		<ul class="vertical-menu">
			<li><a href="<?php echo bp_loggedin_user_domain(); ?>">Dashboard</a></li>
			<li><a href="<?php echo bp_loggedin_user_domain(); ?>/profile/">Public profile</a></li>
			<li><a href="<?php echo bp_loggedin_user_domain(); ?>/settings">Settings and preferences</a></li>
			<li style="display: none;"><a href="#">Payment agreement</a></li>
		</ul>
	</div>
	<div class="user-menu-section">
		<div class="user-menu-content">
			<h3 class="heading heading-small heading-on-contrast">Marketplace</h3>
		</div>
		<ul class="vertical-menu">
			<li><a href="#">My products</a></li>
			<li><a href="#">My jobs</a></li>
			<li><a href="#">My favorite models</a></li>
			<li><a href="#">Sales</a></li>
			<li><a href="#">Purchases</a></li>
		</ul>
	</div>
	<div class="user-menu-section">
		<div class="user-menu-content">
			<h3 class="heading heading-small heading-on-contrast">Community</h3>
		</div>
		<ul class="vertical-menu">
			<li><a href="<?php echo HOME_URL?>/gallery"">Gallery</a></li>
			<li><a href="<?php echo HOME_URL?>/referrals/">Referrals</a></li>
			<li><a href="<?php echo HOME_URL?>/tutorial">Tutorials</a></li>
		</ul>
	</div>
	<hr>
	<ul class="vertical-menu">
		<li><a href="<?php echo wp_logout_url(HOME_URL); ?>" rel="nofollow">Sign Out</a></li>
	</ul>
</div>
</div>
<div class="tooltip-html">
	
</div>
<?php wp_footer(); ?>
<?php include('choose-model.php');?>
</body>
</html>
<!-- SCRIPTS -->
<script type="text/javascript" src="<?php echo TEMPLATE_PATH; ?>/js/libs.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_PATH; ?>/js/app.js"></script>
<!-- Google Analytics -->
<?php echo get_template_part('contact-user/index'); ?>
<div class="tooltip-content">
<div id="hire-me-button-tooltip"><ol><li>Provide job details and price</li><li>Designer negotiates or accepts </li><li>Pay the accepted price</li><li>Confirm job is done</li><li>Designer receives payment</li></ol></div>
</div>