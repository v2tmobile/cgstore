<?php
/**
 * BuddyPress - Members Single Profile
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/settings/profile.php */
do_action( 'bp_before_member_settings_template' ); ?>

<h2 class="bp-screen-reader-text first-title"><?php
	/* translators: accessibility text */
	_e( 'Account settings', 'buddypress' );
?></h2>

<form action="<?php echo bp_displayed_user_domain() . bp_get_settings_slug() . '/general'; ?>" method="post" class="standard-form" id="settings-form">

	<?php if ( !is_super_admin() ) : ?>

		<label for="pwd"><?php _e( 'Current Password <span>(required to update email or change current password)</span>', 'buddypress' ); ?></label>
		<input type="password" name="pwd" id="pwd" size="16" value="" class="settings-input small" <?php bp_form_field_attributes( 'password' ); ?>/> &nbsp;<a href="<?php echo wp_lostpassword_url(); ?>" title="<?php esc_attr_e( 'Password Lost and Found', 'buddypress' ); ?>"><?php _e( 'Lost your password?', 'buddypress' ); ?></a>

	<?php endif; ?>
	<div class="input-container">
		<label for="email"><?php _e( 'Email', 'buddypress' ); ?></label>
		<input type="email" name="email" id="email" value="<?php echo bp_get_displayed_user_email(); ?>" class="settings-input field" <?php bp_form_field_attributes( 'email' ); ?>/>
	</div>
	
	<h4>Birthday</h4>
	<div class="birthday-container">
		<div class="birthday-container__year">
			<input placeholder="Year" class="field" type="text" name="birthday[year]" id="birthday_year">
		</div>
		<div class="birthday-container__month">
			<select id="birthday_month" name="birthday[month]" class="select">
				<option value="1">January</option>
				<option value="2">February</option>
				<option value="3">March</option>
				<option value="4">April</option>
				<option value="5">May</option>
				<option value="6">June</option>
				<option value="7">July</option>
				<option value="8">August</option>
				<option value="9">September</option>
				<option value="10">October</option>
				<option value="11">November</option>
				<option value="12">December</option>
			</select>
		</div>
		<div class="birthday-container__day"><input placeholder="Day" class="field" type="text" name="birthday[day]" id="birthday_day"></div>
		<div class="clear"></div>
	</div>

	<h4>Your Avatar</h4>
	<div class="avatar-container">
	    <div class="avatar-container__avatar">
	        <div class="avatar avatar--large"><?php bp_loggedin_user_avatar( 'type=thumb&width=60&height=60' );?>
	        </div>
	    </div>
	    <div class="avatar-container__info"><small><b>Note:</b> the avatar should not exceed  <span class="label label--warning">100x100</span> dimensions (in pixels) and it should be smaller than  <span class="label label--warning">1 MB</span> in file size. </small>
	        <div class="upload-action" id="upload-action"><span class="button button--full">Upload avatar<input class="js-avatar-upload" name="user[avatar]" type="file"></span>
	        </div>
	    </div>
	    <div class="clear"></div>
	</div>

	<h3>Professional Information</h3>
	<div class="input-container">
	    <label for="info_description">A few sentences about yourself</label>
	    <textarea class="field field--full field--text" maxlength="300" cols="0" rows="0" name="info[description]" id="info_description"></textarea>
	</div>
	<div class="skills-container">
		<div class="skills-container__tools">
			<div class="input-container">
				<label for="preferred_tools">Preferred tools</label>
			    <select name="preferred_tools[]" id="preferred_tools" multiple="multiple" class="select" data-placeholder="Preferred tools">
			        <option value="16">3Delight</option>
			        <option value="17">3DVIA Shape</option>
			        <option value="18">AC3D</option>
			        <option value="19">Anim8or</option>
			        <option value="20">Animation:Master</option>
			        <option value="21">Aqsis</option>
			        <option value="22">Arion</option>
			        <option value="23">Arnold</option>
			        <option value="24">Art of Illusion</option>
			        <option value="25">AutoCAD</option>
			        <option value="15">Autodesk 123D</option>
			        <option value="1">Autodesk 3ds Max</option>
			        <option value="109">Autodesk Inventor</option>
			        <option value="2">Autodesk Maya</option>
			        <option value="26">Autodesk Revit</option>
			        <option value="3">Autodesk Softimage</option>
			        <option value="27">AutoQ3D</option>
			        <option value="28">AutoQ3D Community</option>
			        <option value="12">Blender</option>
			        <option value="13">Blokify</option>
			        <option value="29">Brazil R/S</option>
			        <option value="30">BRL-CAD</option>
			        <option value="31">Bryce</option>
			        <option value="32">Carrara</option>
			        <option value="33">CATIA</option>
			        <option value="34">Caustic Visualizer</option>
			        <option value="35">CEBAS</option>
			        <option value="36">Cheetah3D</option>
			        <option value="5">Cinema 4D</option>
			        <option value="37">CityEngine</option>
			        <option value="38">Clara.io</option>
			        <option value="39">Clarisse IFX</option>
			        <option value="40">DAZ Studio</option>
			        <option value="41">Electric Image Animation System</option>
			        <option value="42">FELIX Render</option>
			        <option value="43">Flux</option>
			        <option value="44">Form-Z</option>
			        <option value="45">FPrime</option>
			        <option value="46">fragMOTION</option>
			        <option value="47">FreeCAD</option>
			        <option value="48">FurryBall (GPU)</option>
			        <option value="50">Gelato</option>
			        <option value="49">Geomagic/Alibre</option>
			        <option value="51">GPAC</option>
			        <option value="52">Guerilla Render</option>
			        <option value="53">Hexagon</option>
			        <option value="54">Houdini</option>
			        <option value="55">iClone</option>
			        <option value="56">Indigo Renderer</option>
			        <option value="57">iRay</option>
			        <option value="58">Kerkythea</option>
			        <option value="59">Keyshot</option>
			        <option value="4">Lightwave</option>
			        <option value="60">LightWorks</option>
			        <option value="61">LuxRender</option>
			        <option value="62">mantra</option>
			        <option value="63">MASSIVE</option>
			        <option value="64">Maxwell Render</option>
			        <option value="65">mental ray</option>
			        <option value="66">Metasequoia</option>
			        <option value="67">MikuMikuDance</option>
			        <option value="68">MilkShape 3D</option>
			        <option value="69">Mitsuba Render</option>
			        <option value="9">MODO</option>
			        <option value="8">Mudbox</option>
			        <option value="70">NOX</option>
			        <option value="71">Octane Render</option>
			        <option value="72">Open CASCADE</option>
			        <option value="73">OpenSCAD</option>
			        <option value="74">PhotoRealistic RenderMan</option>
			        <option value="75">Pixie</option>
			        <option value="76">Poser</option>
			        <option value="77">POV-Ray</option>
			        <option value="78">Pro/ENGINEER</option>
			        <option value="79">Quake Army Knife</option>
			        <option value="80">Raylectrone</option>
			        <option value="81">RaySupreme</option>
			        <option value="82">Realsoft 3D</option>
			        <option value="83">Redshift</option>
			        <option value="84">Remo 3D</option>
			        <option value="7">Rhinoceros 3D</option>
			        <option value="85">Sculptris</option>
			        <option value="86">Seamless3d</option>
			        <option value="87">Shade 3D</option>
			        <option value="88">Silo</option>
			        <option value="10">Sketchup</option>
			        <option value="89">SOCET SET</option>
			        <option value="90">Solid Edge</option>
			        <option value="91">SolidWorks</option>
			        <option value="92">SpaceClaim</option>
			        <option value="93">Strata 3D</option>
			        <option value="94">Sunflow</option>
			        <option value="95">Swift 3D</option>
			        <option value="96">TheaRender</option>
			        <option value="14">Tinkercad</option>
			        <option value="97">TopMod</option>
			        <option value="98">TrueSpace</option>
			        <option value="99">Turtle</option>
			        <option value="100">Unigraphics</option>
			        <option value="101">Vectorworks</option>
			        <option value="102">ViewPoint 3D</option>
			        <option value="103">VRay</option>
			        <option value="6">Vue</option>
			        <option value="104">Wings 3D</option>
			        <option value="105">YafaRay</option>
			        <option value="106">YafRay</option>
			        <option value="107">ZBrush</option>
			        <option value="108">Zmodeler</option>
			        <option value="11">Other</option>
			    </select>
			</div>
		</div>
		<div class="skills-container__expertise">
			<div class="input-container">
			    <label for="areas_of_expertise">Areas of expertise</label>
			    <select name="areas_of_expertise[]" id="areas_of_expertise" multiple="multiple" class="select" data-placeholder="Areas of Expertise" style="display: none;">
			        <option value="1">3D Modeling</option>
			        <option value="2">3D Print Modeling</option>
			        <option value="3">Low-poly Modeling</option>
			        <option value="4">Lighting</option>
			        <option value="5">Rendering</option>
			        <option value="6">Rigging</option>
			        <option value="7">Skinning</option>
			        <option value="8">UV mapping</option>
			        <option value="9">Texturing</option>
			        <option value="10">Shaders</option>
			        <option value="11">Particles</option>
			    </select>
			</div>
		</div>
		<div class="clear"></div>
	</div> 

	<div class="skills-container">
		<div class="input-container">
			<label for="accepting_price_offers" class="is-hovered">
			    <div class="checkbox">
			        <input class="iCheckBox" type="checkbox" name="accepting_price_offers" id="accepting_price_offers" value="true" checked="checked"/>
			    </div>Allow buyers to send me Price Offers <a rel="popover" class="js-popover tooltipstered" data-content="Buyers can send price offers for your models if they want to buy them at a lower price" data-html="true" id="a34b01792f1a4bb0ac50e0d4b41791ad" href="javascript:;"><i class="fa fa-question-circle-o fa-lg"></i></a>
			</label>
			<label for="display_loyalty_widget" class="">
			    <div class="checkbox">
			        <input  class="iCheckBox" type="checkbox" name="display_loyalty_widget" id="display_loyalty_widget" value="true">
			    </div>Show CGTrader Loyalty Discounts icon in top menu</label>
		</div>
	</div>

	<h3>Personal Information</h3>
	<div class="input-container">
	    <label for="info_full_name">Full name</label>
	    <input class="field field--full" type="text" name="info[full_name]" id="info_full_name">
	</div>
	<div class="input-container">
	    <label for="info_country">Location</label>
	    <input class="field field--full" placeholder="Which country and city do you live in?" type="text" name="info[country]" id="info_country">
	</div>
	<div class="input-container">
	    <label for="info_languages">Languages</label>
	    <input class="field field--full" placeholder="Languages you are fluent in" type="text" name="info[languages]" id="info_languages">
	</div>
	<div class="input-container">
	    <label for="info_website">Website</label>
	    <input type="url" class="field field--full" placeholder="http://" disabled="disabled" name="info[website]" id="info_website">
	    <p><small><b>Note:</b> You need to upload at least five models to be able to add website URL </small>
	    </p>
	</div>

	<div class="clear"></div>


	<label for="pass1"><?php _e( 'Change Password <span>(leave blank for no change)</span>', 'buddypress' ); ?></label>
	<div class="input-container">
		<label><?php _e( 'New Password', 'buddypress' ); ?></label>
		<input type="password" name="pass1" id="pass1" size="16" value="" class="settings-input small password-entry" <?php bp_form_field_attributes( 'password' ); ?>/> &nbsp;<br />	
		<label><?php _e( 'Repeat New Password', 'buddypress' ); ?></label>
		<input type="password" name="pass2" id="pass2" size="16" value="" class="settings-input small password-entry-confirm" <?php bp_form_field_attributes( 'password' ); ?>/> &nbsp;
	</div>
	
	<div id="pass-strength-result"></div>
	<label for="pass2" class="bp-screen-reader-text"><?php
		/* translators: accessibility text */
		_e( 'Repeat New Password', 'buddypress' );
	?></label>
	

	<?php

	/**
	 * Fires before the display of the submit button for user general settings saving.
	 *
	 * @since 1.5.0
	 */
	do_action( 'bp_core_general_settings_before_submit' ); ?>

	<div class="submit">
		<input style="float: right;" type="submit" name="submit" value="<?php esc_attr_e( 'Update information', 'buddypress' ); ?>" id="submit" class="button button--big" />
	</div>

	<?php

	/**
	 * Fires after the display of the submit button for user general settings saving.
	 *
	 * @since 1.5.0
	 */
	do_action( 'bp_core_general_settings_after_submit' ); ?>

	<?php wp_nonce_field( 'bp_settings_general' ); ?>

</form>

<?php

/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/settings/profile.php */
do_action( 'bp_after_member_settings_template' ); ?>
