<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
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
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<div class="single-product-price" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
  <?php if ( $product->get_price_html() ): ?>
    <h3 class="price"><?php echo wp_kses_post( $product->get_price_html() ); ?></h3>
    <meta itemprop="price" content="<?php echo esc_attr( $product->get_price() ); ?>" />
    <meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
    <link itemprop="availability" href="https://schema.org/<?php echo esc_attr( $product->is_in_stock() ? 'InStock' : 'OutOfStock' ); ?>" />
  <?php endif; ?>
</div>
