<?php
add_action("bp_after_member_header","bp_profile_views_count");
function bp_profile_views_count(){
	global $bp, $wpdb;
		$user_id = bp_displayed_user_id();
		$df_displaytext = get_option('df_displaytext');

		$table_name = $wpdb->prefix . "bp_profilevisits";
	$sql="select views from $table_name where userid=$user_id";
	$view_count = $wpdb->get_var( $sql);
	$view_count=$view_count?$view_count:0;

	$membersonly=get_option('df_countviews');

	if($membersonly==1){
		if($user_id!=0 and bp_loggedin_user_id()!=0 and $user_id!= bp_loggedin_user_id()){
			//print_r($_SESSION['profile_visit']);
			$view_count=updateCount($user_id, $view_count);	
		}
	}else{
		if( $user_id!=0 ){
			if(bp_loggedin_user_id()!=0 and bp_loggedin_user_id()!=$user_id){
				$view_count=updateCount($user_id, $view_count);	
			}elseif(bp_loggedin_user_id()==0){
				$view_count=updateCount($user_id, $view_count);
			}		
		}
	}

	echo"<div style=\"clear:both\" class=\"bp_profile_views\"><strong>$df_displaytext</strong> 
			<span><strong>$view_count</strong> </span></div>";	
	//echo  "<div>".bp_displayed_user_id()." - ". bp_loggedin_user_id()."</div>";

}

function updateCount($user_id, $view_count){
	$makecount=false;
	global $bp, $wpdb;
	$table_name = $wpdb->prefix . "bp_profilevisits";
		if(isset($_SESSION['profile_visit'])){
							if(!in_array($user_id, $_SESSION['profile_visit'])){
									$makecount=true;
									$_SESSION['profile_visit'][]=$user_id;
							}
		}else{
							$makecount=true;		
							$_SESSION['profile_visit']=array();
							$_SESSION['profile_visit'][]=$user_id;
		}
					
		if($makecount){
							if($view_count<1){								
									$sqli="insert into $table_name values(NULL, $user_id, 1)";
									$wpdb->query( $sqli);
									$view_count=1;
							}else{
									$view_count++;
									$sql="update $table_name set  views=$view_count where userid=$user_id";
									$wpdb->query($sql);
							}
		}
		return $view_count;
}

add_shortcode("bp_profile_viewcount","bp_profile_viewcount");
function bp_profile_viewcount($args){
	global $bp, $wpdb;
	extract( shortcode_atts( array(
        'user_id' => bp_displayed_user_id()
    ), $atts ) );
	if($user_id){
		return get_bp_userviews($user_id);
	}else{
		return "User ID not found";
	}
}

function get_bp_userviews($user_id){
	global $bp, $wpdb;
	$table_name = $wpdb->prefix . "bp_profilevisits";

	$sql="select views from $table_name where userid=$user_id";
	$view_count = $wpdb->get_var( $sql);
	return $view_count=$view_count?$view_count:0;
}

?>
