<?php
/**
 * Navigation footer template
 *
 * @since 1.0
 * @package Aiteko
 */

if ( has_nav_menu( 'footer' ) ) :

	wp_nav_menu( array(
		'theme_location' 	=> 'footer',
		'menu_id'        	=> 'footer-nav',
		'depth'				=> 1,
		'container_class'	=> 'footer-menu-container',
	) );

endif;
