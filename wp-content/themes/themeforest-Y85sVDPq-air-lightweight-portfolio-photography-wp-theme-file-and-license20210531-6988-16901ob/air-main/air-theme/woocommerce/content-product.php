<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
} ?>

<section <?php wc_product_class( 'main-list-item product-item', $product ); ?>>
    <div class="inside">
        <?php //** Do Woocommerce before shop loop item
		//do_action('woocommerce_before_shop_loop_item'); ?>
        
            <?php //** Do Woocommerce before shop loop item title
			do_action('woocommerce_before_shop_loop_item_title'); ?>

            <div class="product-caption">
                
                <div class="product-caption-inn middle-ux">
                <a class="prouduct-item-a" href="<?php the_permalink(); ?>"><h3 class="product-caption-title"><?php the_title(); ?></h3></a>

                <?php //** Do Woocommerce after shop loop item title
				do_action('woocommerce_after_shop_loop_item_title'); ?>

                <?php //** Do Woocommerce after shop loop item
                do_action('woocommerce_after_shop_loop_item'); ?>
                </div>

            </div><!--End product-caption-->
    </div><!--End inside-->	
</section>