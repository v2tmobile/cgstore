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
}


 ?>