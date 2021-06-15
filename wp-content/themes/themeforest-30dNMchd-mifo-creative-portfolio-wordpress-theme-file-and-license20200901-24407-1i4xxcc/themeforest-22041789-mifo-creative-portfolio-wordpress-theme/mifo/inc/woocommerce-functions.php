<?php
/**
 * @author  rs-theme
 * @version 1.0
 */
/* All Functions for woocommerce
-----------------------------------------*/
/*-------------------------------------
#. Theme supports for WooCommerce
---------------------------------------*/

function mifo_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
  }
add_action( 'after_setup_theme', 'mifo_add_woocommerce_support' );



/* Shop hide default page title */
function mifo_hide_page_title(){
	return false;
}

function mifo_wc_loop_product_title(){
	echo '<h2 class="woocommerce-loop-product__title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>';
}


function mifo_wc_loop_shop_per_page(){
	global $rs_option;
	return $rs_option['wc_num_product'];
}

// Change number or products per row 
if (!function_exists('loop_columns')) {
	function loop_columns() {
		global $rs_option;
		return $rs_option['wc_num_product_per_row']; 
	}
}

/*All hoocks for woocommerce*
-------------------------------------------*/

add_filter( 'woocommerce_show_page_title' , 'mifo_hide_page_title' );

/* Shop products per page */
add_action( 'loop_shop_per_page', 'mifo_wc_loop_shop_per_page' );
/* Shop products per row */
add_filter('loop_shop_columns', 'loop_columns');
?>