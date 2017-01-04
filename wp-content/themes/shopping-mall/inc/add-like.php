<?php
add_action( 'wp_ajax_nopriv_ats-send-like', 'ats_add_like' );
add_action( 'wp_ajax_ats-send-like', 'ats_add_like' );

function ats_add_like(){
   check_ajax_referer('ats-security-like','security');
   $result = array('success'=>false);
   if(is_user_logged_in()){
   $data = ($_POST['data']) ? ($_POST['data']) :'';
   $current_user = wp_get_current_user();
   $my_like = array();
   if($data && $data['UID'] == $current_user->ID){
       //delete_user_meta($data['UID'],PREFIX_WEBSITE.'likes');
       $likes  = get_user_meta($data['UID'],PREFIX_WEBSITE.'likes',true);
       if(!is_array($likes)) $likes = (array) $likes;
       if(!empty($likes) && !in_array($data['TID'], $likes)){
          array_push($likes,$data['TID']);
          update_user_meta($data['UID'],PREFIX_WEBSITE.'likes',$likes);
          $my_like = $likes;
         
       }elseif(!empty($likes) && in_array($data['TID'], $likes)){
                die();
       }elseif(empty($likes)){
          $my_like[] = $data['TID'];
          add_user_meta($data['UID'],PREFIX_WEBSITE.'likes',$my_like);
       }else{
          die();
       }
       $key = wp_create_nonce('ats-security-unlike');
       $result = array('success'=>true,'total_like'=>count($my_like),'onclick'=>'ats_on_unlike(\''.$key.'\',\''.$data['TID'].'\',this)');
    }else{
       die('Xin lỗi không thực hiện được yêu cầu của bạn');
    }
 }else{
    die();
 }

 echo wp_send_json($result);
die(); 

}

add_action( 'wp_ajax_nopriv_ats-send-unlike', 'ats_unlike' );
add_action( 'wp_ajax_ats-send-unlike', 'ats_unlike' );

function ats_unlike(){
   check_ajax_referer('ats-security-unlike','security');
   $result = array('success'=>false);
   if(is_user_logged_in()){
    $data = ($_POST['data']) ? ($_POST['data']) :'';
    $current_user = wp_get_current_user();
    if($data && $data['UID'] == $current_user->ID){
       $likes  = get_user_meta($data['UID'],PREFIX_WEBSITE.'likes',true);
       if(!is_array($likes)) $likes = (array) $likes;
       if(!empty($likes) && in_array($data['TID'], $likes)){
          foreach ($likes as $key => $like) {
             if($like == $data['TID']) {
               unset($likes[$key]);
               if(empty($likes)){
                  delete_user_meta($data['UID'],PREFIX_WEBSITE.'likes');
               }
               else{
                 update_user_meta($data['UID'],PREFIX_WEBSITE.'likes',$likes);
               }
               $key = wp_create_nonce('ats-security-like');
               $result = array('success'=>true,'total_like'=>count($likes),'onclick'=>'ats_on_like(\''.$key.'\',\''.$data['TID'].'\',this)');
               break;
            }
          }
     }else{
       die();
     }
  }else{
     die();
  }
}
    echo wp_send_json($result);
    die(); 
}