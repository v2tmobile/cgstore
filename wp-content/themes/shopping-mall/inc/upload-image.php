<?php
  function cgs_upload_image($post_id = 0,$file){
   $result = array('status'=>false,'success'=>false,'msg'=>'Error','data'=>'');
   $valid_formats = array("jpg", "png", "gif","jpeg"); 
   $max_file_size = 1024 * 500;
   $max_image_upload = 1;
   $wp_upload_dir = wp_upload_dir();
   $path = $wp_upload_dir['path'] . '/';
   if($file){
              $extension = pathinfo( $file['name'], PATHINFO_EXTENSION );
              $new_filename =  generate_random_filename().'_'.$file['name'];
                
              if ( $file['error'] != 0 ) {
                    $result['msg'] =' File error!';
                }else{
                     
                    if( $file['size'] > $max_file_size ) {
                        $result['msg'] = $file['name']." is too large!.";
                   
                    } elseif( ! in_array( strtolower( $extension ), $valid_formats ) ){
                       $result['msg'] = $file['name']." is not a valid format";
     
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
                            $attach_id = wp_insert_attachment( $attachment, $filename, $post_id);
                            require_once( ABSPATH . 'wp-admin/includes/image.php' );
                            // Generate meta data
                            $attach_data = wp_generate_attachment_metadata( $attach_id, $filename ); 
                            wp_update_attachment_metadata( $attach_id, $attach_data );
                            set_post_thumbnail( $post_id, $attach_id ); 
                           return $attach_id; 
                        }
                  }
            }
           return false;
     }

     return false;
  }


 ?>