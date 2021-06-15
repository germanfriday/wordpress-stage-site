<?php

/*
============================================================================
	*
	* require functions theme 
	*
============================================================================	
*/
require_once get_template_directory() . '/functions/theme/theme-admin.php';

/*
============================================================================
	*
	* require class 
	*
============================================================================	
*/
require_once get_template_directory() . '/functions/class/class-admin.php';

/*
============================================================================
	*
	* require interface 
	*
============================================================================	
*/
require_once get_template_directory() . '/functions/interface/interface-admin.php';

/*
============================================================================
	*
	* require woocommerce 
	*
============================================================================	
*/

if ( class_exists( 'Woocommerce')  ) {
 	add_theme_support( 'woocommerce' );
 	require_once get_template_directory() . '/woocommerce/airtheme-woocommerce.php';
}

/*
============================================================================
	*
	* Disable Block Editor
	*
============================================================================	
*/

if ( ! class_exists( 'Classic_Editor' ) ) {
	add_filter( 'use_block_editor_for_post_type', 'airtheme_completly_disable_block_editor' );
	function airtheme_completly_disable_block_editor( $use_block_editor ) {
		return false;
	}
}
?>