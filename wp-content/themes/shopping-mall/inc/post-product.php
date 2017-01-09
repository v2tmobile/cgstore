<?php
 add_action( 'wcv_save_product', 'custom_post_product', 10, 1 );
 
 function custom_post_product($product_id){

  echo $product_id;
   print_r($_POST);

 }


 ?>