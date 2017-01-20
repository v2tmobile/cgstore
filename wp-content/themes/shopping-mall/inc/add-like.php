<?php
add_action( 'wp_ajax_nopriv_cgs-send-like', 'cgs_add_like' );
add_action( 'wp_ajax_cgs-send-like', 'cgs_add_like' );

function cgs_add_like(){
   //check_ajax_referer('cgs-security-like','security');
   $result = array('success'=>false);
   if(is_user_logged_in()){
   $data = ($_POST['data']) ? ($_POST['data']) :'';
   $current_user = wp_get_current_user();
   $my_like = array();
   if($data && $data['UID'] == $current_user->ID){
       //delete_user_meta($data['UID'],PREFIX_WEBSITE.'likes');
       $likes  = get_user_meta($data['UID'],PREFIX_WEBSITE.'likes',true);
       $total_like = get_post_meta($data['PID'],PREFIX_WEBSITE.'total_like',true);
       $pids = (empty($likes)) ? [] : $likes ;
       if(!in_array($data['PID'], $pids)){
          array_push($pids,$data['PID']);
          update_user_meta($data['UID'],PREFIX_WEBSITE.'likes',$pids);
          update_post_meta($data['PID'],PREFIX_WEBSITE.'total_like',($total_like) ? $total_like + 1 : 1 );
       }

       $total_like = get_post_meta($data['PID'],PREFIX_WEBSITE.'total_like',true);
       $key = wp_create_nonce('ats-security-unlike');
       $result = array('success'=>true,'total_like'=>$total_like,'onclick'=>'cgs_on_unlike(\''.$key.'\',\''.$data['PID'].'\',this)');
    }else{
       die('Error. Please try again!');
    }
 }else{
    die();
 }
 echo wp_send_json($result);
die(); 

}

add_action( 'wp_ajax_nopriv_cgs-send-unlike', 'cgs_unlike' );
add_action( 'wp_ajax_cgs-send-unlike', 'cgs_unlike' );

function cgs_unlike(){
   //check_ajax_referer('cgs-security-unlike','security');
   $result = array('success'=>false);
   if(is_user_logged_in()){
    $data = ($_POST['data']) ? ($_POST['data']) :'';
    $current_user = wp_get_current_user();
    if($data && $data['UID'] == $current_user->ID){
       $likes  = get_user_meta($data['UID'],PREFIX_WEBSITE.'likes',true);
       $total_like = get_post_meta($data['PID'],PREFIX_WEBSITE.'total_like',true);
       $pids = (empty($likes)) ? [] : $likes ;
       $key = array_search($data['PID'],$pids); 
       if($key){
               unset($pids[$key]);
               update_user_meta($data['UID'],PREFIX_WEBSITE.'likes',$pids);
               update_post_meta($data['PID'],PREFIX_WEBSITE.'total_like',($total_like) ? $total_like - 1 : 0 );
               $total_like = get_post_meta($data['PID'],PREFIX_WEBSITE.'total_like',true);
               $key = wp_create_nonce('ats-security-like');
               $result = array('success'=>true,'total_like'=>$total_like,'onclick'=>'cgs_on_like(\''.$key.'\',\''.$data['PID'].'\',this)');
       }
     }
  }else{
     die();
  }
 echo wp_send_json($result);
    die(); 
}