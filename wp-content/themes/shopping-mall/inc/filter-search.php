<?php 

add_filter( 'pre_get_posts','add_filter_search',999);

function add_filter_search($query){
 if( $query->is_main_query() and
            ( is_shop() or is_product_category() or is_product_taxonomy() or is_product_tag() )
        ) {
 	  $min_price = ($_GET['min_price']) ? $_GET['min_price'] : 0;
      $max_price = ($_GET['max_price']) ? $_GET['max_price'] : 0;
      $product_format = ($_GET['product_format']) ? $_GET['product_format']: '';

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

 	  if($product_format){
 	  	   $terms = get_terms( 'product_format', array( 'exclude' => 49, 'fields' => 'ids' ) );
 	  	   $pf_query = array(
 	  	   	    //'relation' => 'AND',
		        array(
		            'taxonomy' => 'product_format',
		            'field' => 'term_id',
		            'terms' => array(49)
		        	)
    		);

 	  	   $query->tax_query->queries[] = $pf_query; 
   		   $query->query_vars['tax_query'] = $query->tax_query->queries;

 	  	  //$query->set('tax_query',$pf_query);

 	   }
 	
    }
  
    return $query;
}
