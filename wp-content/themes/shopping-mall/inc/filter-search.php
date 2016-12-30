<?php 

add_filter( 'pre_get_posts','add_filter_search',999);

function add_filter_search($query){
 if( $query->is_main_query() and
            ( is_shop() or is_product_category() or is_product_taxonomy() or is_product_tag() )
        ) {

 	  echo 'dfdfd';
 	
    }

    return $query;
}
