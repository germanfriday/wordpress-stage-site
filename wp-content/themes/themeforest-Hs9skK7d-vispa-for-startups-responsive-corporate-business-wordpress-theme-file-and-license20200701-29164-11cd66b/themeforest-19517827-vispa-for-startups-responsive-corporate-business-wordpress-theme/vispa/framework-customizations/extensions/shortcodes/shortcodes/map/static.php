<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$shortcodes_extension = fw_ext( 'shortcodes' );

$shortcodes_extension_theme = fw()->extensions->get( 'shortcodes' )->get_shortcode( 'map' );

wp_enqueue_script(
	'google-maps-api-v3',
	'https://maps.googleapis.com/maps/api/js?' . http_build_query(array(
		'v' => '3.25',
		'libraries' => 'places',
		'language' => substr( get_locale(), 0, 2 ),
		'key' => method_exists('FW_Option_Type_Map', 'api_key')
			? FW_Option_Type_Map::api_key()
			: '' // You can set here some default key
	)),
	array(),
	'3.23',
	true
);

wp_enqueue_script(
	'fw-shortcode-map-script',
	$shortcodes_extension_theme->locate_URI( '/static/js/scripts.js' ),
	array( 'jquery', 'underscore', 'google-maps-api-v3' ),
	fw()->manifest->get_version(),
	true
);
