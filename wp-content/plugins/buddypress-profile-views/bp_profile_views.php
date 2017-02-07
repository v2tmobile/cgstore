<?php
/**
 * Plugin Name: Buddypress Profile Views
 * Author: Venu Gopal Chaladi
 * Author URI:http://dhrusya.com
 * Version:2.01
 * Plugin URI:http://dhrusya.com/products
 * Description:Show number of profile views count by all members only or all viewers (members and guests).
 * License: GPL
 * Tested with Buddypress 1.5+
 * Date: 18th July 2012
 * Updated : 22th May 2016
 */


$bp_profilevisits_db_version = "1.1";

//ini_set( 'display_errors', true );
//error_reporting( E_ALL );
 session_save_path("../") ;

if (!session_id()) {
    session_start();
}

//add_action('init', 'bp_profile_views_initSession');

function bp_profile_views_initSession() {
    if(!session_id()) {
        session_start();
    }
}


add_action( 'admin_menu', 'ds_bp_profile_views_menu' );
function ds_bp_profile_views_menu() {
  $slug='bp_profile_views'; 
  add_menu_page('BP Profile Views', 'BP Profile Views Settings', 'manage_options', "$slug", 'ds_bp_profile_views', 'dashicons-admin-page',300 );
}
add_action( 'admin_init', 'dsf_bp_profileviews_settings' );
function dsf_bp_profileviews_settings() { 
  $formarray=array('df_displaytext',
      'df_countviews'
      );
  foreach($formarray as $v){
      register_setting( 'df_bpviews_settings', $v );
  }
}


function ds_bp_profile_views(){
?>
<div class="uk-content">
    <form action="options.php" method="post" class="uk-form">
    <?php settings_fields('df_bpviews_settings' ); ?>
    <?php do_settings_sections( 'df_bpviews_settings' ); 
        $df_displaytext=get_option("df_displaytext");
        $df_displaytext=!empty($df_displaytext)?$df_displaytext:"Total Profile Visits: ";
        $df_countviews=get_option("df_countviews");
        $df_countviews=!empty($df_countviews)?$df_countviews:0;
    ?>
    <h3>Buddypress Profile Views</h3>
    <dl>
        <dt>Display Text:</dt>
        <dd><input type="text" name="df_displaytext" value="<?php echo $df_displaytext;?>" /></dd>
        <dt>Count Views:</dt>
        <dd><select name="df_countviews">
                <option value="0" <?php echo ($df_countviews==0)?'selected="selected"':'';?>>All Member views and Guest Views</option>
                <option value="1" <?php echo ($df_countviews==1)?'selected="selected"':'';?>>Only Member Views</option>
                <!-- <option value="2" <?php //echo ($df_countviews==2)?'selected="selected"':'';?>>Only Guest Views</option> -->
            </select>
        </dd>
        <dd><input type="submit" value="Save Settings" /></dd>
    </dl>
    </form>
    
    <!-- <div class="uk-help">
        * Use "echo get_bp_userviews(userid);" function to print views count at any member loop.<br />
        * Use "[bp_profile_viewcount user_id='userid-here']" short code to get user views.
    </div> -->
    
    <div class="uk-footer">
        <p>Buddypress Profile Views plugin by <a href="http://dhrusya.com" target="_blank">Dhrusya Solutions</a>.</p>
    </div>
</div>
<style type="text/css">
  .uk-content{
    margin-right:20px;  
  }
  .uk-form{
    padding:20px;
    background:#fff;  
  }
  
  .uk-form input, .uk-form select{
    border:1px solid #efefef;
    padding:10px;
    min-height:40px;
    min-width:250px;
    font-size:12px;
  }
  
  .uk-form input[type=submit]{
    background:#09C;
    color:#fff; 
  }
  
  .uk-help{
    padding:20px;
    background:#FFC;
    border:1px dotted #333; 
  }
  
  .uk-footer{
    background:#333;
    padding:10px;
    color:#ddd; 
    text-align:right;
  }
  
  .uk-footer a{
    color:#fff;
    font-weight:bold; 
  }
</style>
<?php 
}


function bp_profile_views_init() {
  require( dirname( __FILE__ ) . '/includes/bp_views_core.php' );
}
add_action( 'bp_init', 'bp_profile_views_init' );

  
  
function bp_profile_views_install() {
   global $wpdb;
   global $bp_profilevisits_db_version;

   $table_name = $wpdb->prefix . "bp_profilevisits";
      

  $sql="CREATE TABLE IF NOT EXISTS $table_name (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `userid` int(10) NOT NULL,
    `views` float NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)
  ) ;";

   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
   dbDelta($sql);
 
   add_option("bp_profilevisits_db_version", $bp_profilevisits_db_version);
}


register_activation_hook(__FILE__,'bp_profile_views_install');


if ( function_exists('register_uninstall_hook') )
  register_uninstall_hook(__FILE__, 'bp_profile_views_uninstall');

function bp_profile_views_uninstall() {
   global $wpdb;
   global $bp_profilevisits_db_version;
  $table_name = $wpdb->prefix . "bp_profilevisits";

  $sql="DROP TABLE $table_name;";
    $wpdb->query($sql);
}
















