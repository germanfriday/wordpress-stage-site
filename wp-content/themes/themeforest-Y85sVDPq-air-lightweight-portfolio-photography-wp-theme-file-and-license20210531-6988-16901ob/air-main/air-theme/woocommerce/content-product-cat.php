<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
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
 * @version 4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<section class="main-list-item product-item" >
    <div class="inside">
    
        <?php //** Do Woocommerce before subcategory
		do_action('woocommerce_before_subcategory', $category); ?>
        
            <?php //** Do Woocommerce before subcategory title
			do_action('woocommerce_before_subcategory_title', $category); ?>
        
            <div class="product-caption">
                <h3>
					<?php echo wp_kses_post($category->name);
                    if($category->count > 0 )
                        echo wp_kses_post(apply_filters('woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category)); ?>
                </h3>
            </div><!--End product-caption-->
            
            <?php //** Do Woocommerce after subcategory title
			do_action('woocommerce_after_subcategory_title', $category); ?>
        
        <?php //** Do Woocommerce after subcategory
		do_action('woocommerce_after_subcategory', $category); ?>
        
    </div><!--End inside-->	
</section><!--End product-item-->