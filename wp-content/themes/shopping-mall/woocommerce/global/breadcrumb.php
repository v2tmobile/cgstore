<?php
/**
 * Shop breadcrumb
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/breadcrumb.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $breadcrumb ) ) {

	?>
    <div class="breadcrumb-wrapper" id="breadcrumb">
        <div class="container">
            <ul class="breadcrumb" itemscope="itemscope" itemtype="https://schema.org/BreadcrumbList">
                <?php
                foreach ( $breadcrumb as $key => $crumb ) :
                    if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) :
                        ?>
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
                            <a href="<?php echo esc_url( $crumb[1] ) ?>" itemprop="item" itemscope="itemscope" itemtype="http://schema.org/Thing" title="<?php echo esc_html( $crumb[0] ) ?>">
                                <span itemprop="name"><?php echo esc_html( $crumb[0] ) ?></span>
                            </a>
                            <meta content="<?php echo $key + 1 ?>" itemprop="position">
                        </li>
                        <?php
                    else :
                        ?>
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
                        <span itemprop="item" itemscope="itemscope" itemtype="http://schema.org/Thing">
                          <span itemprop="name"><?php echo esc_html( $crumb[0] ) ?></span>
                        </span>
                            <meta content="<?php echo $key + 1 ?>" itemprop="position">
                        </li>
                        <?php
                    endif;
                endforeach;
                ?>
            </ul>
        </div>
    </div>
    <?php

}

?>
