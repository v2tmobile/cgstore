<?php

function shopping_mall_wrapper_start() {
    echo '<div id="primary" class="content-area">';
}
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
add_action( 'woocommerce_before_main_content', 'shopping_mall_wrapper_start', 10 );

function shopping_mall_wrapper_end() {
    echo '</div>';
}
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );  
add_action( 'woocommerce_after_main_content', 'shopping_mall_wrapper_end', 10 );

// Remove sidebar
remove_action('woocommerce_sidebar','woocommerce_get_sidebar',10);

// Remove default woocommerce style
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


add_action('wc_cpdf_init', 'prefix_custom_product_data_tab_init', 10, 0);

if(!function_exists('prefix_custom_product_data_tab_init')) :

    function prefix_custom_product_data_tab_init(){


        $custom_product_data_fields = array();


        /** First product data tab starts **/
        /** ===================================== */

        $custom_product_data_fields['shopping_mall_custom_data'] = array(

            array(
                'tab_name'    => __('Custom Data', 'shopping-mall'),
            ),

            // Animated
            array(
                'id'          => '_shopping_mall_animated',
                'type'        => 'checkbox',
                'label'       => __('Animated', 'shopping-mall'),
                'description' => __('Animated', 'shopping-mall'),
                'desc_tip'    => false,
            ),

            // Low-poly (game-ready)
            array(
                'id'          => '_shopping_mall_low_poly',
                'type'        => 'checkbox',
                'label'       => __('Low-poly (game-ready)', 'shopping-mall'),
                'description' => __('Low-poly (game-ready)', 'shopping-mall'),
                'desc_tip'    => false,
            ),

            // Textures
            array(
                'id'          => '_shopping_mall_textures',
                'type'        => 'checkbox',
                'label'       => __('Textures', 'shopping-mall'),
                'description' => __('Textures', 'shopping-mall'),
                'desc_tip'    => false,
            ),

            // Materials
            array(
                'id'          => '_shopping_mall_materials',
                'type'        => 'checkbox',
                'label'       => __('Materials', 'shopping-mall'),
                'description' => __('Materials', 'shopping-mall'),
                'desc_tip'    => false,
            ),

            // Rigged
            array(
                'id'          => '_shopping_mall_rigged',
                'type'        => 'checkbox',
                'label'       => __('Rigged', 'shopping-mall'),
                'description' => __('Rigged', 'shopping-mall'),
                'desc_tip'    => false,
            ),

            // Plugins used
            array(
                'id'          => '_shopping_mall_plugins_used',
                'type'        => 'checkbox',
                'label'       => __('Plugins used', 'shopping-mall'),
                'description' => __('Plugins used', 'shopping-mall'),
                'desc_tip'    => false,
            ),

            // Collection
            array(
                'id'          => '_shopping_mall_collection',
                'type'        => 'checkbox',
                'label'       => __('Collection', 'shopping-mall'),
                'description' => __('Collection', 'shopping-mall'),
                'desc_tip'    => false,
            ),

            // UVW mapping
            array(
                'id'          => '_shopping_mall_uvw_mapping',
                'type'        => 'checkbox',
                'label'       => __('UVW Mapping', 'shopping-mall'),
                'description' => __('UVW Mapping', 'shopping-mall'),
                'desc_tip'    => false,
            ),

            // Geometry
            array(
                'id'          => '_shopping_mall_geometry',
                'type'        => 'select',
                'label'       => __('Geometry', 'shopping-mall'),
                'options'     => array(
                    'Polygon mesh'  => __('Polygon mesh', 'shopping-mall'),
                    'Subdivision-ready'  => __('Subdivision-ready', 'shopping-mall'),
                    'Nurbs'  => __('Nurbs', 'shopping-mall'),
                    'Other'  => __('Other', 'shopping-mall')
                ),
                'description' => __('Geometry.', 'shopping-mall'),
                'desc_tip'    => false,
            ),

            // Polygons
            array(
                'id'          => '_shopping_mall_polygons',
                'type'        => 'number',
                'label'       => __('Polygons', 'shopping-mall'),
                'placeholder' => __('polygons', 'shopping-mall'),
                'class'       => 'short',
                'description' => __('Polygons.', 'shopping-mall'),
                'desc_tip'    => false,
            ),

            // Vertices
            array(
                'id'          => '_shopping_mall_vertices',
                'type'        => 'number',
                'label'       => __('Vertices', 'shopping-mall'),
                'placeholder' => __('vertices', 'shopping-mall'),
                'class'       => 'short',
                'description' => __('Vertices.', 'shopping-mall'),
                'desc_tip'    => false,
            ),

            // Publish date
            array(
                'id'          => '_shopping_mall_publish_date',
                'type'        => 'datepicker',
                'label'       => __('Publish date ', 'shopping-mall'),
                'class'       => 'large',
                'description' => __('Publish date.', 'shopping-mall'),
                'desc_tip'    => false,
            ),

            // Model ID
            array(
                'id'          => '_shopping_mall_model_id',
                'type'        => 'number',
                'label'       => __('Model ID', 'shopping-mall'),
                'placeholder' => __('0000000', 'shopping-mall'),
                'class'       => 'short',
                'description' => __('Model ID.', 'shopping-mall'),
                'desc_tip'    => false,
            ),

        );

        /** First product data tab ends **/
        /** ===================================== */
        return $custom_product_data_fields;

    }

endif;