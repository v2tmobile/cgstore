<?php

add_action( 'init', 'custom_taxonomy_Item' );
function custom_taxonomy_Item()  {
$labels = array(
    'name'                       => 'Type Product',
    'singular_name'              => 'Type Product',
    'menu_name'                  => 'Type Product',
    'all_items'                  => 'All Type Product',
    'parent_item'                => 'Parent Type Product',
    'parent_item_colon'          => 'Parent Type Product:',
    'new_item_name'              => 'New Type Product Name',
    'add_new_item'               => 'Add New Type Product',
    'edit_item'                  => 'Edit Type Product',
    'update_item'                => 'Update Type Product',
    'separate_items_with_commas' => 'Separate Type Product with commas',
    'search_items'               => 'Search Items',
    'add_or_remove_items'        => 'Add or remove Items',
    'choose_from_most_used'      => 'Choose from the most used Items',
);
$args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
);
 register_taxonomy( 'type_product', 'product', $args );
 register_taxonomy_for_object_type( 'type_product', 'product' );


$labels_format = array(
    'name'                       => 'Format',
    'singular_name'              => 'Format',
    'menu_name'                  => 'Format',
    'all_items'                  => 'All Format',
    'parent_item'                => 'Parent Format',
    'parent_item_colon'          => 'Parent Format:',
    'new_item_name'              => 'New Format',
    'add_new_item'               => 'Add New Format',
    'edit_item'                  => 'Edit Format',
    'update_item'                => 'Update Format',
    'separate_items_with_commas' => 'Separate Format with commas',
    'search_items'               => 'Search Format',
    'add_or_remove_items'        => 'Add or remove Format',
    'choose_from_most_used'      => 'Choose from the most used Format',
);
$args_format = array(
    'labels'                     => $labels_format,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
);

 register_taxonomy( 'product_format', 'product', $args_format );
 register_taxonomy_for_object_type( 'product_format', 'product' );




}


 ?>