<?php
/**
 * BuddyPress - Users Cover Image Header
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php

/**
 * Fires before the display of a member's header.
 *
 * @since 1.2.0
 */
do_action( 'bp_before_member_header' ); ?>

<div id="cover-image-container">
	

	<div id="item-header-cover-image">
		<div id="item-header-avatar">
			<a href="<?php bp_displayed_user_link(); ?>">

				<?php bp_displayed_user_avatar( 'type=full' ); ?>

			</a>
		</div><!-- #item-header-avatar -->

		<div id="item-header-content">

			<?php if ( bp_is_active( 'activity' ) && bp_activity_do_mentions() ) : ?>
				<h2 class="user-nicename">@<?php bp_displayed_user_mentionname(); ?></h2>
			<?php endif; ?>
			<div class="user-header__status is-offline">Offline </div>
			<div id="item-buttons"><?php

				/**
				 * Fires in the member header actions section.
				 *
				 * @since 1.2.6
				 */
				//echo do_action( 'bp_member_header_actions' ); ?>
		<?php
          $profile_ID = bp_displayed_user_id();
          $userID   = get_current_user_id();
          if($profile_ID != $userID):
		 ?>
				<div class="user-header__actions">
					<a href="#" class="button button--pill button--tiny-pill js-auth-control js-modal js-contact"><i class="fa fa-commenting-o"></i> <span>Contact</span></a>
					<a href="" class="button button--pill button--tiny-pill js-follow js-auth-control js-modal"><i class="fa fa-check-circle"></i><span>Follow</span></a>
					<span class="hire-designer-button">
						<a class="button button--pill button--tiny-pill button--alt js-hire-me" href="https://www.cgtrader.com/jobs/new?designer_id=39498"><i class="fa fa-dollar"></i> 
							<span>Hire me</span>
						</a>
						<span class="has-question has-tooltip js-tooltip-with-list tooltipstered" data-tooltip-content="#hire-me-button-tooltip"><i class="fa fa-question-circle-o fa-green"></i></span>
					</span>
					<div class="clear"></div>
				</div>
          <?php endif; ?>
			</div><!-- #item-buttons -->

			<!-- <span class="activity" data-livestamp="<?php bp_core_iso8601_date( bp_get_user_last_activity( bp_displayed_user_id() ) ); ?>"><?php bp_last_activity( bp_displayed_user_id() ); ?></span> -->

			<?php

			/**
			 * Fires before the display of the member's header meta.
			 *
			 * @since 1.2.0
			 */
			do_action( 'bp_before_member_header_meta' ); ?>

			<div id="item-meta">

				<?php if ( bp_is_active( 'activity' ) ) : ?>

					<div id="latest-update">

						<?php bp_activity_latest_update( bp_displayed_user_id() ); ?>

					</div>

				<?php endif; ?>

				<?php

				 /**
				  * Fires after the group header actions section.
				  *
				  * If you'd like to show specific profile fields here use:
				  * bp_member_profile_data( 'field=About Me' ); -- Pass the name of the field
				  *
				  * @since 1.2.0
				  */
				 do_action( 'bp_profile_header_meta' );

				 ?>

			</div><!-- #item-meta -->

		</div><!-- #item-header-content -->

	</div><!-- #item-header-cover-image -->
	<?php
       $ud = get_userdata($profile_ID);
       if($ud->user_description):
     ?>
	<div class="card">
	   <div class="card__content">
	      <h2 class="card__heading">About</h2>
	      <p><?php echo $ud->user_description; ?></p>
	   </div>
	</div>
<?php endif; ?>
	<div class="card">
	   <div class="card__content">
	      <h2 class="card__heading">Share designer</h2>
	      <div class="user__share">
	         <ul class="list list-inline u-text-center social-networks">
	            <li class="list-item">
	                <a class="social-icon facebook" href="https://www.facebook.com/sharer.php?u=<?php echo bp_loggedin_user_domain(); ?>" target="_blank">
	                    <span class="fa-stack fa-social-share fa-facebook-icon"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-inverse fa-stack-1x"></i></span>
	                </a>
	            </li>
	            <li class="list-item">
	                <a class="social-icon linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo bp_loggedin_user_domain(); ?>" target="_blank">
	                    <span class="fa-stack fa-social-share fa-linkedin-icon"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-linkedin fa-inverse fa-stack-1x"></i></span>
	                </a>
	            </li>
	            <li class="list-item">
	                <a class="social-icon twitter" href="https://twitter.com/share?url=<?php echo bp_loggedin_user_domain(); ?>" target="_blank">
	                    <span class="fa-stack fa-social-share fa-twitter-icon"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-inverse fa-stack-1x"></i></span>
	                </a>
	            </li>
	            <li class="list-item">
	                <a class="social-icon google-plus" href="https://plus.google.com/share?url=<?php echo bp_loggedin_user_domain(); ?>" target="_blank">
	                    <span class="fa-stack fa-social-share fa-google-plus-icon"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-google-plus fa-inverse fa-stack-1x"></i></span>
	                </a>
	            </li>
	            <li class="list-item is-last">
	                <a class="social-icon pinterest" href="https://pinterest.com/pin/create/button/?url=<?php echo bp_loggedin_user_domain(); ?>" target="_blank">
	                    <span class="fa-stack fa-social-share fa-pinterest-icon"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-pinterest fa-inverse fa-stack-1x"></i></span>
	                </a>
	            </li>
	        </ul>
	      </div>
	   </div>
	</div>
	<div class="card">
	   <div class="card__content stat_content">
	      <h2 class="card__heading">Stats</h2>
	      <ul class="list list--stats">
	         <li>Reputation Score <b>0</b></li>
	      <?php if($profile_ID != $userID): ?>
	         <li>Models <b>0</b></li>
	         <li>Views <b><?php echo get_bp_userviews($profile_ID); ?></b></li>
	         <li>Likes <b>0</b></li>
	         <li>Followers <b>0</b></li>
	         <li>Response Rate <b>0%</b></li>
	         <li>Average Response Time <b>0</b></li>
	       <?php endif; ?>
	      </ul>
	   </div>
	</div>
</div><!-- #cover-image-container -->

<?php

/**
 * Fires after the display of a member's header.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_member_header' ); ?>

<div id="template-notices" role="alert" aria-atomic="true">
	<?php

	/** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */
	do_action( 'template_notices' ); ?>

</div>
