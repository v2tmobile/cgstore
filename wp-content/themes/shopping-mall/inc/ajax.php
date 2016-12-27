<?php

add_action( 'wp_ajax_nopriv_ats-send-unlike-all', 'ats_unlike_all' );
add_action( 'wp_ajax_ats-send-unlike-all', 'ats_unlike_all' );

function ats_unlike_all(){
   check_ajax_referer('ats-security-unlike-all','security');
   $result = array('success'=>false,'msg'=>'Có lỗi xãy ra không thể xử lý!');
   if(is_user_logged_in()){
     $data = ($_POST['data']) ? ($_POST['data']) :'';
     $current_user = wp_get_current_user();
    if($data && $data['UID'] == $current_user->ID && $data['TID'] =='all'){
          delete_user_meta($data['UID'],PREFIX_WEBSITE.'likes'); 
          $result['success'] = true;
          $result['msg'] = 'Đã xóa thành công!';  
     }else{
       die();
     }
  }else{
     die();
  }
    echo wp_send_json($result);
    die(); 
}