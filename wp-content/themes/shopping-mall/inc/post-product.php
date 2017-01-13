<?php
 add_action( 'wcv_save_product', 'custom_post_product', 10, 1 );
 
 function custom_post_product($product_id){

   $product_post = isset($_POST) ? $_POST : '';
   $prefix = '_shopping_mall_';
   if($product_post){
     $units = isset($product_post['units']) ? $product_post['units'] :'';
     if($units){
     	update_field($prefix.'units',$units,$product_id);
     } 
    
    $license = isset($product_post['license']) ? $product_post['license']: 'general';
     update_field($prefix.'license',$license,$product_id);
    $adult_content = isset($product_post['adult_content']) ? $product_post['adult_content'] : 0;
   
     if($adult_content){
     	 update_field($prefix.'adult_content',$adult_content,$product_id);
     }

    $animated = isset($product_post['animated']) ? $product_post['animated'] : '';
    if($animated){
    	 update_field($prefix.'animated',$animated,$product_id);
     } 

     $low_poly = isset($product_post['low_poly']) ? $product_post['low_poly'] : '';
    if($low_poly){
    	 update_field($prefix.'low_poly',$low_poly,$product_id);
     }

     $textures = isset($product_post['textures']) ? $product_post['textures'] : '';
    if($textures){
    	 update_field($prefix.'textures',$textures,$product_id);
     } 
    $materials = isset($product_post['materials']) ? $product_post['materials'] : '';
    if($materials){
    	 update_field($prefix.'materials',$materials,$product_id);
     } 
     $rigged = isset($product_post['rigged']) ? $product_post['rigged'] : '';
    if($rigged){
    	 update_field($prefix.'rigged',$rigged,$product_id);
     } 
     $plugins_used = isset($product_post['plugins_used']) ? $product_post['plugins_used'] : '';
    if($plugins_used){
    	 update_field($prefix.'plugins_used',$plugins_used,$product_id);
     }
     $collection = isset($product_post['collection']) ? $product_post['collection'] : '';
    if($collection){
    	 update_field($prefix.'collection',$collection,$product_id);
     }
     $uvw_mapping = isset($product_post['uvw_mapping']) ? $product_post['uvw_mapping'] : '';
    if($uvw_mapping){
    	 update_field($prefix.'uvw_mapping',$uvw_mapping,$product_id);
     }

     $unwrapped_uvs = isset($product_post['unwrapped_uvs']) ? $product_post['unwrapped_uvs'] : '';
    if($uvw_mapping){
    	 update_field($prefix.'unwrapped_uvs',$unwrapped_uvs,$product_id);
     } 

    $unwrapped_uvs = isset($product_post['unwrapped_uvs']) ? $product_post['unwrapped_uvs'] : '';
    if($uvw_mapping){
    	 update_field($prefix.'unwrapped_uvs',$unwrapped_uvs,$product_id);
     } 
   $geometry = isset($product_post['geometry']) ? $product_post['geometry'] : '';
    if($geometry){
    	 update_field($prefix.'geometry',$geometry,$product_id);
     }  

    $polygons = isset($product_post['polygons']) ? $product_post['polygons'] : 0;
    if($polygons){
    	 update_field($prefix.'polygons',$polygons,$product_id);
     }
    $vertices = isset($product_post['vertices']) ? $product_post['vertices'] : '';
    if($vertices){
    	 update_field($prefix.'vertices',$vertices,$product_id);
     }  
      
    $challenge = isset($product_post['challenge']) ? $product_post['challenge'] : '';
    if($challenge){
    	 update_field($prefix.'challenge',$challenge,$product_id);
     }

   }

 }


 ?>