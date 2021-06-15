<?php
/**
 * Demo import helper
 *
 * @package Aiteko
 * @since 1.0
 */

/**
 * Import file
 *
 * @since 1.0
 */
function aiteko_ocdi_import_predefined() {
	return array(
		array(
			'import_file_name'  => 'Aiteko Demo',
			'categories'        => array( 'Portfolio' ),
			'local_import_file' => get_parent_theme_file_path( '/inc/demo-content/demo-content.xml' ),
			'local_import_widget_file' => get_parent_theme_file_path( '/inc/demo-content/demo-widgets.wie' ),
			'local_import_customizer_file' => '',
			'import_redux'      => array(),
			'import_preview_image_url' => get_theme_file_uri('/screenshot.jpg'),
			'import_notice'     => esc_html__( 'This demo use "Elementor" plugin. Make sure to install all "required" plugins before importing the demo.', 'aiteko' ),
		),
	);
}
add_filter( 'pt-ocdi/import_files', 'aiteko_ocdi_import_predefined' );

/**
 * Fix some settings after import
 *
 * @since 1.0
 */
function aiteko_ocdi_after_import() {
	$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
	$footer_menu = get_term_by( 'name', 'Footer Nav', 'nav_menu' );

	$menus = array();
	if ( $main_menu ) {
		$menus['main'] = $main_menu->term_id;
	}

	if ( $footer_menu ) {
		$menus['footer'] = $footer_menu->term_id;
	}

	if ( ! empty( $menus ) ) {
		set_theme_mod( 'nav_menu_locations', $menus );
	}

	$front_page_id = get_page_by_title( 'Front Page' );
	$blog_page_id  = get_page_by_title( 'Blog' );

    if ( NULL !== $front_page_id ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
    }

    if ( NULL !== $blog_page_id ) {
		update_option( 'page_for_posts', $blog_page_id->ID );
    }
}
add_action( 'pt-ocdi/after_import', 'aiteko_ocdi_after_import' );
