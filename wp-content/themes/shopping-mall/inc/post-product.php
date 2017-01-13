<?php
 add_action( 'wcv_save_product', 'custom_post_product', 10, 1 );
 
 function custom_post_product($product_id){

   $product_post = isset($_POST) ? $_POST : '';
   if($product_post){
     $units = isset($product_post['units']) ? $product_post['units'] :'';
     if($units){
     	update_field('_shopping_mall_units',$units,$product_id);
     } 
    
    $license = isset($product_post['license']) ? $product_post['license']: 'general';
     update_field('_shopping_mall_license',$license,$product_id);
    $adult_content = isset($product_post['adult_content']) ? $product_post['adult_content'] : 0;
   
     if($adult_content){
     	 update_field('_shopping_mall_adult_content',$adult_content,$product_id);
     }
      


   }

 }


 ?>