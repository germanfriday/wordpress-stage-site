<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array(
	'page_builder' => array(
		'tab'        => esc_html__( 'Layout Elements', 'vispa' ),
		'title'      => esc_html__( 'Column', 'vispa' ),
		'popup_size' => 'small',
		'type'       => 'column'
	)
);