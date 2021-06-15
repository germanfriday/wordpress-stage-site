<?php
/****************************************************************/
/*
/* Remove Woo action
/*
/****************************************************************/

//Remove woocommerce before main content
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

//Remove woocommerce before shop loop
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
//remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

//Remove woocommerce after shop loop
remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);

//Remove woocommerce before shop loop item title
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

//Remove woocommerce before subcategory title
remove_action('woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10);

//Remove woocommerce before single product summary
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

//Remove woocommerce after single product summary
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

//Remove woocommerce cart collaterals
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );

/****************************************************************/
/*
/* Add Woo action
/*
/****************************************************************/

//Add woocommerce before subcategory title
add_action('woocommerce_before_subcategory_title', 'airtheme_woocommerce_subcategory_thumbnail', 10);

//Add woocommerce before shop loop item title
add_action('woocommerce_before_shop_loop_item_title', 'airtheme_woocommerce_template_loop_product_thumbnail', 15);

//Add woocommerce after shop loop
add_action('woocommerce_after_shop_loop', 'airtheme_interface_pagination', 10);

//Add woocommerce after single product
add_action('woocommerce_after_single_product', 'woocommerce_upsell_display', 15);
add_action('woocommerce_after_single_product', 'woocommerce_output_related_products', 20);

//interface wc cart
add_action('airtheme_interface_wc_cart', 'airtheme_woocommerce_sidebar_cart');


/****************************************************************/
/*
/* Add Woo filter
/*
/****************************************************************/

//Add woocommerce product tabs
add_filter('woocommerce_product_tabs', 'airtheme_woocommerce_default_product_tabs', 10);

?>