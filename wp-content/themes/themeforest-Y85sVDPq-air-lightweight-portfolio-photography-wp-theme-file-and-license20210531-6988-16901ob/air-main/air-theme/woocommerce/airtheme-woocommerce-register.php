<?php
//woocommerce register sidebar
function airtheme_woocommerce_register_sidebar(){
	register_sidebar(array(
		'name' => __('Shop Sidebar', 'air-theme'),
		'id' => 'ux-shop-sidebar',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'class' => ''
	));
}
add_action('widgets_init', 'airtheme_woocommerce_register_sidebar');

//woocommerce enqueue script
function airtheme_woocommerce_enqueue_scripts(){
	wp_register_script('airtheme-woocommerce', UX_WOOCOMMERCE. '/js/woocommerce.js', array('jquery'), '1.9.7.5', true);
	wp_register_style('airtheme-woocommerce', UX_WOOCOMMERCE. '/css/woocommerce.css', array(), '1.9.7.5', 'screen');
		wp_dequeue_style('woocommerce_frontend_styles');
		wp_enqueue_script('airtheme-woocommerce');
		wp_enqueue_style('airtheme-woocommerce');
}
add_action('wp_enqueue_scripts', 'airtheme_woocommerce_enqueue_scripts', 100);

?>