<?php
/**
 * Created by v2tmobile.
 * Date: 12/12/16
 * Time: 1:57 AM
 * Copyright (c) Ahiho.,JSC. All right reserved.
 */

function register_shopping_mall_menus() {
    register_nav_menus(
        array(
            'footer-menu' => __( 'Footer Menu' ),
            'footer-terms-menu' => __( 'Footer Terms Menu' )
        )
    );
}
add_action( 'init', 'register_shopping_mall_menus' );