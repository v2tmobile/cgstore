<?php
   
   function cgstore_upload($postID = 0,$files){

	    $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg"); 
	    $max_file_size = 1024 * 500; // in kb
	    $max_image_upload = 5;
	    $wp_upload_dir = wp_upload_dir();
	    $path = $wp_upload_dir['path'] . '/';
	    $count = 0;   
       $attachments = get_posts( array(
        'post_type'         => 'attachment',
        'posts_per_page'    => -1,
        'post_parent'       => $postID,
        'exclude'           => get_post_thumbnail_id()
    
      ) );

     if( ( count( $attachments ) + count( $files['name'] ) ) > $max_image_upload ) {
            $upload_message[] = "Sorry you can only upload " . $max_image_upload . " images for each Ad";
        } else {
           
            foreach ( $files['name'] as $f => $name ) {
                $extension = pathinfo( $name, PATHINFO_EXTENSION );
                // Generate a randon code for each file name
                $new_filename = cvf_td_generate_random_code( 20 ) . '.' . $extension;
                
                if ( $files['error'][$f] == 4 ) {
                    continue; 
                }
                
                if ( $files['error'][$f] == 0 ) {
                    // Check if image size is larger than the allowed file size
                    if ( $files['size'][$f] > $max_file_size ) {
                        $upload_message[] = "$name is too large!.";
                        continue;
                    
                    // Check if the file being uploaded is in the allowed file types
                    } elseif( ! in_array( strtolower( $extension ), $valid_formats ) ){
                        $upload_message[] = "$name is not a valid format";
                        continue; 
                    
                    } else{ 
                        // If no errors, upload the file...
                        if( move_uploaded_file( $files["tmp_name"][$f], $path.$new_filename ) ) {
                            
                            $count++; 
                            die();
                            $filename = $path.$new_filename;
                            $filetype = wp_check_filetype( basename( $filename ), null );
                            $wp_upload_dir = wp_upload_dir();
                            $attachment = array(
                                'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
                                'post_mime_type' => $filetype['type'],
                                'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
                                'post_content'   => '',
                                'post_status'    => 'inherit'
                            );
                            // Insert attachment to the database
                            $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );

                            require_once( ABSPATH . 'wp-admin/includes/image.php' );
                            
                            // Generate meta data
                            $attach_data = wp_generate_attachment_metadata( $attach_id, $filename ); 
                            wp_update_attachment_metadata( $attach_id, $attach_data );
                            
                        }
                    }
                }
            }
      }
       
    print_r($upload_message);
     if( isset( $upload_message ) ) :
              return $upload_message;
      endif;
    // If no error, show success message
	    if( $count != 0 ){
	       return false;  
	    }

  

}

function cvf_td_generate_random_code($length=10) {
 
   $string = '';
   $characters = "23456789ABCDEFHJKLMNPRTVWXYZabcdefghijklmnopqrstuvwxyz";
 
   for ($p = 0; $p < $length; $p++) {
       $string .= $characters[mt_rand(0, strlen($characters)-1)];
   }
 
   return $string;
 
}

 ?>