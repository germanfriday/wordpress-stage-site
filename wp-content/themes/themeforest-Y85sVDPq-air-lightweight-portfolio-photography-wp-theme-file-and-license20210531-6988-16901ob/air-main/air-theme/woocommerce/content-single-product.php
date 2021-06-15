<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

//** Do Woocommerce before single product
do_action('woocommerce_before_single_product');

if(post_password_required()){
	echo get_the_password_form();
	return;
}

?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'row', $product ); ?>>
   
    <?php //** Do Woocommerce before single product summary
	do_action('woocommerce_before_single_product_summary'); ?>
    
    <div class="summary entry-summary single-product-summary col-md-6 col-sm-6">
        <?php //** Do Woocommerce single product summary
		do_action('woocommerce_single_product_summary');
        airtheme_interface_social_bar_and_navi(); ?>
    </div><!-- .summary -->
        
</div>

<div class="row">

    <?php //** Do Woocommerce after single product summary
	do_action('woocommerce_after_single_product_summary'); ?>

</div>

<?php //** Do Woocommerce after single product
do_action('woocommerce_after_single_product'); ?>
