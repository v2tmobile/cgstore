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

add_action( 'wp_ajax_nopriv_cgs-upload-file', 'uploadAjaxFile' );
add_action( 'wp_ajax_cgs-upload-file', 'uploadAjaxFile' );

function uploadAjaxFile(){
   $result = array('status'=>false,'msg'=>'Error');
   $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg","doc","xls","docx", "txt"); 
   $max_file_size = 1024 * 500;
   $max_image_upload = 5;
   $wp_upload_dir = wp_upload_dir();
   $path = $wp_upload_dir['path'] . '/';
   $file = $_FILES['file'];
   if($file){

              $extension = pathinfo( $file['name'], PATHINFO_EXTENSION );
              $new_filename =  $file['name'];
                
              if ( $file['error'] != 0 ) {
                    $result['msg'] =' File error!';
                }else{
                     
                    if( $file['size'] > $max_file_size ) {
                        $result['msg'] = "$name is too large!.";
                   
                    } elseif( ! in_array( strtolower( $extension ), $valid_formats ) ){
                       $result['msg'] = "$name is not a valid format";
     
                    } else{ 
                        // If no errors, upload the file...
                        if( move_uploaded_file( $file["tmp_name"], $path.$new_filename ) ) {
                            $filename = $path.$new_filename;
                            $filetype = wp_check_filetype( basename( $filename ), null );
                            $wp_upload_dir = wp_upload_dir();
                            $post_title = preg_replace( '/\.[^.]+$/', '', basename( $filename ));
                            $attachment = array(
                                'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
                                'post_mime_type' => $filetype['type'],
                                'post_title'     =>$post_title,
                                'post_content'   => '',
                                'post_status'    => 'inherit'
                            );
                            // Insert attachment to the database
                            $attach_id = wp_insert_attachment( $attachment, $filename, 0);

                            require_once( ABSPATH . 'wp-admin/includes/image.php' );
                            
                            // Generate meta data
                            $attach_data = wp_generate_attachment_metadata( $attach_id, $filename ); 
                            wp_update_attachment_metadata( $attach_id, $attach_data );
                            $img_ext = array('jpg','jpeg','gif');
                            $type = 'image';
                            if(!in_array($extension, $img_ext)){
                               $type ='file';
                            }
                            $result['status'] ='ok';
                            $result['msg'] ='uploaded successful';
                            $result['data'] = array(
                               'attachmentID'=> $attach_id,
                               'ext'=>$extension,
                               'size'=>$file['size'],
                               'type'=>$type,
                               'name'=>$post_title,
                               'url'=>wp_get_attachment_url($attach_id)
                             );
                            
                        }
                  }
            }
     }

  echo wp_send_json($result);
   die();
}