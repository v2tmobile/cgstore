<?php 

add_filter( 'pre_get_posts','add_filter_search',999);

function add_filter_search($query){
 if( $query->is_main_query() and
            ( is_shop() or is_product_category() or is_product_taxonomy() or is_product_tag() )
        ) {
 	    $min_price = ($_GET['min_price']) ? $_GET['min_price'] : 0;
      $max_price = ($_GET['max_price']) ? $_GET['max_price'] : 0;
      $product_free = ($_GET['product_free']) ? $_GET['product_free']: '';
      $product_poly = ($_GET['product_poly']) ? $_GET['product_poly'] : '';

 	  if($min_price && $max_price){
         $query->set( 'meta_key', '_regular_price' );
         $query->set( 'orderby', 'meta_value_num' );
         $query->set("meta_query",
               		 array(
			            'key' => '_regular_price',
			            'value' => array($min_price,$max_price),
			            'compare' => 'BETWEEN',
			            'type' => 'NUMERIC'
       				 )
			   ); 
 	   }

    $meta_query = [];

 	  if($product_free){
         //$query->set( 'meta_key', '_regular_price' );
         $query->set( 'orderby', 'meta_value_num' );
         $meta_query[] =  array(
                  'key' => '_regular_price',
                  'value' => 0,
                  'compare' => '=',
                  'type' => 'NUMERIC'
               );
 	   }

     if($product_poly){
        //$query->set( 'meta_key', '_shopping_mall_polygons' );
        $query->set( 'orderby', 'meta_value_num' );
        $poly = explode('-',$product_poly);
        $poly_min = (is_array($poly) && $poly[0]) ?  $poly[0] : 0;
        $poly_max = (is_array($poly)  && $poly[1]) ? $poly[1] : 0;
        $meta_query[] = array(
                  'key' => '_shopping_mall_polygons',
                  'value' => array($poly_min,$poly_max),
                  'compare' => 'BETWEEN',
                  'type' => 'NUMERIC'
               );
        }

    if($meta_query){
          
          $query->set("meta_query",$meta_query);  
         //echo '<pre>';
         //print_r($query);
      }
   }
  
    return $query;
}
