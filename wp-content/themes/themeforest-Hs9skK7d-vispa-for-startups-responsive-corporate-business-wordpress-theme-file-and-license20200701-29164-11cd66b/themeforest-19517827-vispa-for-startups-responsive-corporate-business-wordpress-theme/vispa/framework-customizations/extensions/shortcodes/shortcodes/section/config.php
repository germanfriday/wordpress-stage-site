<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array(
	'page_builder' => array(
		'tab'         => esc_html__( 'Layout Elements', 'vispa' ),
		'title'       => esc_html__( 'Section', 'vispa' ),
		'description' => esc_html__( 'Add a Section', 'vispa' ),
		'popup_size'  => 'medium',
		'type'        => 'section', // WARNING: Do not edit this
		'title_template' => '{{ if (!o.section_name) { }} {{- title}} {{ } }} {{ if (o.section_name) { }} {{- o.section_name}} {{ } }}',
	)
);