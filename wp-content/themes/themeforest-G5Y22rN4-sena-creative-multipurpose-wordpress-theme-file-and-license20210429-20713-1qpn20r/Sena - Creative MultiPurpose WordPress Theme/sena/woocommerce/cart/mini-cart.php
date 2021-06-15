<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>
    <!-- Product list -->
	<ul class="nav product-list <?php echo esc_attr( $args['list_class'] ); ?>">
		<?php
			do_action( 'woocommerce_before_mini_cart_contents' );

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
					$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					?>
					<li>
                        
						<div class="product-thumbnail">
							<?php if ( ! $_product->is_visible() ) : ?>
								<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
							<?php else : ?>
								<a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>">
									<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
								</a>
							<?php endif; ?>
						</div>
                        
						<div class="product-summary">
							<a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>">
                                <?php echo esc_html( $product_name ); ?>
                            </a>
							
                            <span><?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?></span>
							
                            <?php
                                echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                    '<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><i class="fas fa-times"></i></a>',
                                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                    esc_html__( 'Remove this item', 'sena' ),
                                    esc_attr( $product_id ),
                                    esc_attr( $cart_item_key ),
                                    esc_attr( $_product->get_sku() )
                                ), $cart_item_key );
							?>
						</div>
                        
						<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
                        
					</li>
					<?php
				}
			}

			do_action( 'woocommerce_mini_cart_contents' );
        ?>
	</ul>

	<div class="mini-cart-info">
		<h5>
            <?php esc_html_e('Cart Subtotal', 'sena'); ?>: 
            <span><?php echo WC()->cart->get_cart_total(); ?></span>
        </h5>
	</div>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<div class="cart-buttons">
		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn btn-default"><?php esc_html_e( 'Checkout', 'sena' ); ?></a>
	</div>
<?php else : ?>
	<p class="woocommerce-mini-cart__empty-message">
        <span class="icon icon-ecommerce-bag-remove"></span>
        <?php esc_html_e( 'No products in the cart.', 'sena' ); ?>
    </p>
<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
