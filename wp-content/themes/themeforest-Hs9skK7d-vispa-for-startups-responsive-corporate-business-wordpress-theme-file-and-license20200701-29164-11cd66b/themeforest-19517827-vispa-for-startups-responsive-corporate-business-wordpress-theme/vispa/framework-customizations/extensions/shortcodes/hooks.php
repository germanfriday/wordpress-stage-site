<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

function vispa_disable_default_shortcodes( $to_disabled ) {
	$to_disabled[] = 'calendar';
	$to_disabled[] = 'call_to_action';
	$to_disabled[] = 'table';
	$to_disabled[] = 'notification';

	return $to_disabled;
}
add_filter( 'fw_ext_shortcodes_disable_shortcodes', 'vispa_disable_default_shortcodes' );


