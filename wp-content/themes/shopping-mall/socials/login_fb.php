<?php 

add_action('wp_footer', 'ats_social_login_head');

function ats_social_login_head(){
	
   ?>
    <div id="fb-root"></div>
    <script>
	<?php
	  $setting_data= get_option('ats_social_login');
	  extract($setting_data['facebook_details']);
	?>
	window.fbAsyncInit = function() {
		FB.init({
		  appId      : '<?php echo $facebook_id;?>',
		  status     : true,
		  cookie     : true,
		  xfbml      : true 
		});
		
		FB.getLoginStatus( function(response) {
			console.log(response);
			
		}, true);

	};

	function facebook_login(){

	   FB.login(function(response) {

			if (response.authResponse) 
			{

				  getUserInfo();

			} 
			else 
			{
				
				   console.log('User cancelled login or did not fully authorize.');

			 }
			 
		  },{auth_type: 'rerequest',scope: 'email,user_photos,user_videos'});

	}

	function getUserInfo() {

	  FB.api('/me?fields=email,first_name,last_name,name', function(response) {
		
		response.email=jQuery.trim(response.email);

			if(response.email!='')
			{
				
				var str=response.name;
				str +="*"+response.email;
				str += "*" + "face";
				var data = {
					'action': 'ats_fb_data_retrive',
					'data': str
				};
			}
			else
			{
				
				alert("NO Email is provided");
				
			}

			// We can also pass the url value separately from ajaxurl for front end AJAX implementations
			jQuery.post(CGSTORE_VARS.AJAX_URL, data, function(response,status) {

				if(response=='success')
				{

				    window.location.href= CGSTORE_VARS.SITE_URL;
				}

			});

		});

	}

	function getPhoto(){

		FB.api('/me/picture?type=normal', function(response) {

		  var str="<br/><b>Pic</b> : <img src='"+response.data.url+"'/>";

		  document.getElementById("status").innerHTML+=str;

		});

	}

	  // Load the SDK asynchronously

	(function(d){

	 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];

	 if (d.getElementById(id)) {return;}

	 js = d.createElement('script'); js.id = id; js.async = true;

	 js.src = "//connect.facebook.net/en_US/all.js";

	 ref.parentNode.insertBefore(js, ref);

	}(document));

	</script>
   <?php 

}

add_action( 'wp_ajax_ats_fb_data_retrive', 'ats_data_retrive' );

	add_action( 'wp_ajax_nopriv_ats_fb_data_retrive', 'ats_data_retrive' );
	
	function ats_data_retrive()
	{

       extract($_POST);
		
		$user_details=explode("*",$data);

		$profile_name =$user_details[0];
		
		$profile_email=$user_details[1];
		
		$social_type=$user_details[2];

		if( !email_exists( $profile_email )&& username_exists( $profile_name )){
			
			$profile_id=rand(1000, 9999);
			
			$profile_name=$profile_name.$profile_id;
			
		}

		$user_id = username_exists( $profile_name );
		
		if ( !$user_id and email_exists($profile_email) == false ) {
			
			$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
			
			$user_idd = wp_create_user( $profile_name, $random_password, $profile_email );
		   if($social_type=='gplus'){
			    update_user_meta($user_idd,'ats_login_social_type','facebook');
		   }
		  if($social_type=='face'){
		  	   update_user_meta($user_idd,'ats_login_social_type','google');
		   }
			
		}

		if(isset($user_idd)) 
		{

			$user1 = get_user_by('id',$user_idd);
			wp_set_current_user( $user1->ID, $user1->user_login );
			wp_set_auth_cookie( $user1->ID );
			do_action( 'wp_login', $user1->user_login );
			echo 'success';
			die();
		}else{
			 $user1 = get_user_by( 'email', $profile_email);
			 wp_set_current_user( $user1->ID, $user1->user_login );
			 wp_set_auth_cookie( $user1->ID );
			 do_action( 'wp_login', $user1->user_login );
			 echo 'success';
			 die();
		}

	}

?>