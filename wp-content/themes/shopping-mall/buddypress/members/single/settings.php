<?php
/**
 * BuddyPress - Users Settings
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>
<div class="profile-header">
    <div class="profile-header__content">
        <div class="content-heading">
            <h2 class="content-heading__title">Account settings</h2>
            <p class="content-heading__subtitle">Update your profile info, change password or change email notification settings.</p>
        </div>
    </div>
    <div class="profile-header__side">
        <a target="_blank" id="b54eb375129cdeabb66d21d4e5bf00f7" href="https://www.cgtrader.com/challenges/pbr-challenge"><img alt="PBR Challenge" src="https://img-new.cgtrader.com/slider/picture_259ae1ea-7f3f-4df9-a043-7d2793643e72.png">
        </a>
    </div>
</div>
<div class="item-list-tabs no-ajax setting-tabs" id="subnav" style="overflow: inherit;" aria-label="<?php esc_attr_e( 'Member secondary navigation', 'buddypress' ); ?>" role="navigation">
	<ul>
		<?php if ( bp_core_can_edit_settings() ) : ?>

			<?php bp_get_options_nav(); ?>

		<?php endif; ?>
	</ul>
</div>
<div class="clear"></div>
<?php

switch ( bp_current_action() ) :
	case 'notifications'  :
		bp_get_template_part( 'members/single/settings/notifications'  );
		break;
	case 'capabilities'   :
		bp_get_template_part( 'members/single/settings/capabilities'   );
		break;
	case 'delete-account' :
		bp_get_template_part( 'members/single/settings/delete-account' );
		break;
	case 'general'        :
		bp_get_template_part( 'members/single/settings/general'        );
		break;
	case 'profile'        :
		bp_get_template_part( 'members/single/settings/profile'        );
		break;
	default:
		bp_get_template_part( 'members/single/plugins'                 );
		break;
endswitch;
