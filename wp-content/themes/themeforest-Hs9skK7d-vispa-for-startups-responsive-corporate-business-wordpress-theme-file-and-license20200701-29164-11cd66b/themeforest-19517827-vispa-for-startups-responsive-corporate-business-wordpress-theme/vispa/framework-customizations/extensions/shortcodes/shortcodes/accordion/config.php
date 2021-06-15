<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array(
	'page_builder' => array(
		'title'       => esc_html__( 'Accordion', 'vispa' ),
		'description' => esc_html__( 'Accordion shortcode', 'vispa' ),
		'tab'         => esc_html__( 'Content Elements', 'vispa' ),
		'popup_size'  => 'medium'
	)
);