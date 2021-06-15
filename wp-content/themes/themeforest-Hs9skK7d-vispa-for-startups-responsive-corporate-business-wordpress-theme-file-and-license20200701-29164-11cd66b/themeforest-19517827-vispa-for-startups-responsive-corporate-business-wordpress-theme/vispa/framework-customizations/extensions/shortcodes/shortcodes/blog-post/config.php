<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array(
	'page_builder' => array(
		'title'       => esc_html__( 'Blog Posts', 'vispa' ),
		'description' => esc_html__( 'Blog posts shortcode', 'vispa' ),
		'tab'         => esc_html__( 'Content Elements', 'vispa' ),
		'popup_size'  => 'medium'
	)
);