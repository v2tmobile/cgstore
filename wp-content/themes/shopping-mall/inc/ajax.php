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

// load sub cat

add_action( 'wp_ajax_nopriv_cgs-load-sub-cat', 'cgs_load_sub_cat' );
add_action( 'wp_ajax_cgs-load-sub-cat', 'cgs_load_sub_cat' );

function cgs_load_sub_cat(){
   $result = array('success'=>false,'msg'=>'Error');
   $catID = isset($_REQUEST['catID']) ? $_REQUEST['catID']: 0;
   $tax = 'product_cat';
   $hmtl = '';
   if($catID){
       $cats = get_terms($tax,array(
           'hide_empty'=>0,
           'parent'=>$catID
        ));
     
      if($cats){
        foreach ($cats as $cat) {
          $hmtl .='<option value="'.$cat->term_id.'">'.$cat->name.'</option>';
        }
      } 
     $result['success'] = true;
     $result['data'] = $hmtl;  
   }

   echo wp_send_json($result);
    die(); 

}