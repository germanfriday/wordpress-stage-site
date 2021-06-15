<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

/**
 * Include static files: javascript and css
 */

$vispa_version = defined('FW') ? fw()->theme->manifest->get_version() : '1.0';

/**
 * Enqueue scripts and styles for the front end.
 */

/* deregister unyson styles */
wp_deregister_style( 'fw-ext-forms-default-styles' );
wp_deregister_style( 'fw-ext-builder-frontend-grid' );

wp_enqueue_style(
	'font-awesome',
	vispa_include_file_from_child( '/assets/css/font-awesome.css' ),
	array(),
	$vispa_version
);

wp_enqueue_style(
	'pe-icon-7-stroke',
	vispa_include_file_from_child( '/assets/css/fonts/pe-icon-7-stroke.css' ),
	array(),
	$vispa_version
);

wp_enqueue_style(
	'bootstrap',
	vispa_include_file_from_child( '/assets/css/bootstrap.css' ),
	array(),
	$vispa_version
);

wp_enqueue_style(
	'style',
	esc_url( get_stylesheet_uri() ),
	array(),
	$vispa_version
);

wp_enqueue_style(
	'animate',
	vispa_include_file_from_child( '/assets/css/animate.css' ),
	array(),
	$vispa_version
);

/* include theme js files */
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}

wp_enqueue_script(
	'modernizr',
	vispa_include_file_from_child( '/assets/js/modernizr-3.3.1.min.js' ),
	array( 'jquery' ),
	$vispa_version,
	false
);

wp_enqueue_script(
	'bootstrap',
	vispa_include_file_from_child( '/assets/js/bootstrap.js' ),
	array( 'jquery' ),
	$vispa_version,
	true
);

wp_enqueue_script(
	'powerful-placeholder',
	vispa_include_file_from_child( '/assets/js/jquery.powerful-placeholder.min.js' ),
	array( 'jquery' ),
	$vispa_version,
	true
);

wp_enqueue_script(
	'touchSwipe',
	vispa_include_file_from_child( '/assets/js/jquery.touchSwipe.min.js' ),
	array( 'jquery' ),
	$vispa_version,
	true
);

wp_enqueue_script(
	'swipebox',
	vispa_include_file_from_child( '/assets/js/jquery.swipebox.min.js' ),
	array( 'jquery' ),
	$vispa_version,
	true
);

wp_enqueue_script(
	'owl.carousel',
	vispa_include_file_from_child( '/assets/js/owl.carousel.js' ),
	array( 'jquery' ),
	$vispa_version,
	true
);

wp_enqueue_script(
	'sticky-kit',
	vispa_include_file_from_child( '/assets/js/jquery.sticky-kit.min.js' ),
	array( 'jquery' ),
	$vispa_version,
	true
);

wp_enqueue_script(
	'isotope',
	vispa_include_file_from_child( '/assets/js/isotope.pkgd.min.js' ),
	array( 'jquery' ),
	$vispa_version,
	true
);

wp_enqueue_script(
	'packery-mode',
	vispa_include_file_from_child( '/assets/js/packery-mode.pkgd.min.js' ),
	array( 'jquery' ),
	$vispa_version,
	true
);

wp_enqueue_script(
	'imagesloaded',
	vispa_include_file_from_child( '/assets/js/imagesloaded.pkgd.min.js' ),
	array( 'jquery' ),
	$vispa_version,
	true
);

wp_enqueue_script(
	'waves',
	vispa_include_file_from_child( '/assets/js/waves.min.js' ),
	array( 'jquery' ),
	$vispa_version,
	true
);

wp_enqueue_script(
	'vispa-general',
	vispa_include_file_from_child( '/assets/js/general.js' ),
	array( 'jquery' ),
	$vispa_version,
	true
);

wp_localize_script('vispa-general', 'FwPhpVars', array(
	'ajax_url' => admin_url('admin-ajax.php'),
	'template_directory' => get_template_directory(),
));