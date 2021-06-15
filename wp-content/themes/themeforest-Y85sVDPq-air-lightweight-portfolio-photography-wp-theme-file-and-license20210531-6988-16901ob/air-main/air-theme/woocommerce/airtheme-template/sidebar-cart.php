<?php 
$hideCartEmpty = airtheme_get_option('theme_option_hide_shopping_cart_empty');
$miniCart = airtheme_get_option('theme_option_show_shopping_mini_cart');
$hideCartEmptyClass =  $hideCartEmpty ? 'ux-woo-icon-hide' : '';
$emptyClass =  WC()->cart->get_cart_contents_count() > 0 ? '' : esc_attr( $hideCartEmptyClass );
$miniCartClass = $miniCart ? 'ux-woo-minicart' : '';
?>
<div id="woocomerce-cart-side" class="ux-woo-cart-wrap <?php echo esc_attr( $emptyClass); ?> <?php echo sanitize_html_class( $miniCartClass ); ?>" style="">
    <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="ux-woocomerce-cart-a">
    	<span class="ux-bag"> 
    		<svg version="1.1" id="Layer_1" x="0px" y="0px" width="20px" height="20px" viewBox="-31.5 96.5 20 20" enable-background="new -31.5 96.5 20 20" xml:space="preserve">
				<path d="M-24.5,104v-3.957c0-1.681,1.344-3.043,3-3.043s3,1.362,3,3.043V104" class="ux-bag-path"/>
				<path stroke-miterlimit="10" stroke-width="1" fill="currentColor" d="M-28.5,101.5v15h14v-15H-28.5z M-15.5,115.5h-12v-13h12V115.5z"/>
			</svg>
        	<span class="woocomerce-cart-number"><?php echo esc_html( sizeof(WC()->cart->get_cart() ) ); ?></span>
    	</span>
    </a>
    <?php if ( $miniCart ) { ?>
    <div id="woo-mini-cart" class="woo-mini-cart">
    	<span class="mini-car-arrow"></span>
    	<?php woocommerce_mini_cart(); ?>
    </div>
    <?php } ?>
</div>
