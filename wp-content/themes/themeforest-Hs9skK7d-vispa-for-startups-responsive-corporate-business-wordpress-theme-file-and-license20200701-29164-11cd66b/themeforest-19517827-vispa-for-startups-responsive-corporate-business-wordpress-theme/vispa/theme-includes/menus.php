<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Register menus
 */

// This theme uses wp_nav_menu() in two locations.
register_nav_menus( array(
	'primary' => esc_html__( 'Top Menu', 'vispa' ),
) );


global $menus;
$menus = array(
	'primary' => array(
		'depth'           => 3,
		'container'       => '',
		'container_id'    => '',
		'container_class' => '',
		'menu_class'      => 'nav-menu clearfix invisible',
		'theme_location'  => 'primary',
		'fallback_cb'     => 'vispa_theme_select_menu_message',
		'link_before'     => '',
		'link_after'      => ''
	)
);


if ( ! function_exists( 'vispa_theme_nav_menu' ) ) :
	/**
	 * Print the nav menu
	 */
	function vispa_theme_nav_menu( $menu_type ) {
		global $menus;
		if ( isset( $menus[ $menu_type ] ) ) {
			wp_nav_menu( $menus[ $menu_type ] );
		}
	}
endif;


if ( ! function_exists( 'vispa_theme_select_menu_message' ) ) :
	/**
	 * Print the select menu message
	 */
	function vispa_theme_select_menu_message() {
		echo '<p class="fly-nav-menu-message">' . esc_html__( 'Please go to the', 'vispa' ) . ' <a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" target="_blank">' . esc_html__( 'Menu', 'vispa' ) . '</a> ' . esc_html__( 'section, create a  menu and then select the newly created menu from the Theme Locations box from the left.', 'vispa' ) . '</p>';
	}
endif;

