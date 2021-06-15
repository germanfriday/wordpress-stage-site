<?php
/**
 * Aiteko WordPress Theme by WIP-Themes
 *
 * @package WordPress
 * @since 1.0
 * @author Wip Themes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'WIP_THEMES_DEFAULT_HEADING_FONT' ) ) {
	define( 'WIP_THEMES_DEFAULT_HEADING_FONT', 'Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' );
}

if ( ! defined( 'WIP_THEMES_DEFAULT_BODY_FONT' ) ) {
	define( 'WIP_THEMES_DEFAULT_BODY_FONT', 'Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Run before init hook
 *
 * @since 1.0
 * @return void
 */
function aiteko_theme_setup() {
	// theme translation.
	load_theme_textdomain( 'aiteko', get_template_directory() . '/langs/' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails', array( 'post', 'portfolio', 'page' ) );

	// the 4:3 ratio based image size.
	add_image_size( 'aiteko-post-cover', 1200, 900, true );

	// the 1:1 ratio based image size.
	add_image_size( 'aiteko-post-square', 1000, 1000, true );
	add_image_size( 'aiteko-post-square-small', 500, 500, true );

	// potrait image size.
	add_image_size( 'aiteko-post-potrait', 900, 1200, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 710;

	// This theme uses wp_nav_menu() in 2 locations
	register_nav_menus(
		array(
			'main'   => esc_html__( 'Main Menu', 'aiteko' ),
			'footer' => esc_html__( 'Footer Nav (optional)', 'aiteko' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'search-form',
			'gallery',
			'caption',
		)
	);
	// Add theme support for Custom Logo.
	add_theme_support(
		'custom-logo',
		array(
			'width'      => 250,
			'height'     => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support( 'editor-styles' );
	add_editor_style( array( 'assets/css/editor-style.css', aiteko_font_families() ) );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// We need our core plugin.
	add_theme_support( 'wipthemes-themes' );
	update_option( 'wip_themes_core_no_featured_posts', 'yes' );
	update_option( 'wip_themes_core_no_custom_tax_fields', 'yes' );

	aiteko_set_elementor_globals();
}
add_action( 'after_setup_theme', 'aiteko_theme_setup' );

// Tgm plugin activation.
require get_parent_theme_file_path( '/inc/tgmpa/class-tgm-plugin-activation.php' );

// SVG icon class.
require get_parent_theme_file_path( '/inc/class-aiteko-svg-icons.php' );

// Custom skin loader class.
require get_parent_theme_file_path( '/inc/class-aiteko-skin-loader.php' );

// Template functions.
require get_parent_theme_file_path( '/inc/template-functions.php' );

// Template tags.
require get_parent_theme_file_path( '/inc/template-tags.php' );

// Template actions.
require get_parent_theme_file_path( '/inc/template-actions.php' );

// Customizer api.
require get_parent_theme_file_path( '/inc/customizer.php' );

if ( class_exists('OCDI_Plugin') ) {
	require get_parent_theme_file_path( '/inc/import-helper.php' );
}
