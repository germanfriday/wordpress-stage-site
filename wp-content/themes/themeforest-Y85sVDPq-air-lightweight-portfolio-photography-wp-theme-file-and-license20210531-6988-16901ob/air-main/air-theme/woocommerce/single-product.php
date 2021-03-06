<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

	<?php //** Do Woocommerce before main content
	do_action('woocommerce_before_main_content'); ?>

		<div class="" id="content_wrap">
        
            <div class="product-wrap product-single">
            
				<?php while(have_posts()): the_post(); ?>
        
                    <?php wc_get_template_part('content', 'single-product'); ?>
        
                <?php endwhile; // end of the loop. ?>
            
            </div>
        
        </div>

	<?php //** Do Woocommerce after main content
	do_action('woocommerce_after_main_content'); ?>

<?php get_footer(); ?>