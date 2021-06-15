<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'icon'   => array(
		'type'  => 'icon',
		'label' => __( 'Icon', 'vispa' )
	),
	'color'  => array(
		'type'  => 'color-picker',
		'label' => __( 'Color', 'vispa' ),
		'desc'  => __( 'Select the icon color', 'vispa' ),
	),
	'size'   => array(
		'type'  => 'short-text',
		'label' => __( 'Size', 'vispa' ),
		'desc'  => __( 'Enter the icon size', 'vispa' ),
	),
	'link'   => array(
		'type'  => 'text',
		'label' => __( 'Link', 'vispa' ),
		'desc'  => __( 'Enter the link', 'vispa' ),
	),
	'target' => array(
		'type'         => 'switch',
		'label'        => esc_html__( 'Target', 'vispa' ),
		'desc'         => esc_html__( 'Open link in new window?', 'vispa' ),
		'value'        => '_self',
		'right-choice' => array(
			'value' => '_blank',
			'label' => esc_html__( 'Yes', 'vispa' ),
		),
		'left-choice'  => array(
			'value' => '_self',
			'label' => esc_html__( 'No', 'vispa' ),
		),
	),
	'class'       => array(
		'label' => esc_html__( 'Custom Class', 'vispa' ),
		'desc'  => esc_html__( 'Enter custom CSS class', 'vispa' ),
		'help'  => esc_html__( 'You can use this class to further style this shortcode by adding your custom CSS.', 'vispa' ),
		'type'  => 'text',
		'value' => '',
	),
);