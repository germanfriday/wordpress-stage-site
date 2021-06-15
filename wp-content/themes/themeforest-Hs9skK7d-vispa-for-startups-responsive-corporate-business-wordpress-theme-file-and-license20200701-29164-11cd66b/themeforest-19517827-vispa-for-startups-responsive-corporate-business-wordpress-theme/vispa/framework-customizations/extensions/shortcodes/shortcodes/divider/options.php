<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'unique_id' => array(
		'type' => 'unique'
	),
	'style'     => array(
		'type'    => 'multi-picker',
		'label'   => false,
		'desc'    => false,
		'picker'  => array(
			'type' => array(
				'type'    => 'short-select',
				'label'   => __( 'Type', 'vispa' ),
				'desc'    => __( 'Select the divider type', 'vispa' ),
				'value'   => 'diamond',
				'choices' => array(
					'diamond' => __( 'Diamond', 'vispa' ),
					'star'    => __( 'Star', 'vispa' ),
					'square'  => __( 'Square', 'vispa' ),
				)
			)
		),
		'choices' => array()
	),
	'height'    => array(
		'label'   => __( 'Height', 'vispa' ),
		'desc'    => __( 'Select the space height in px', 'vispa' ),
		'type'    => 'radio-text',
		'choices' => array(
			'fw-space-sm' => __( 'Small', 'vispa' ),
			'fw-space-md' => __( 'Medium', 'vispa' ),
			'fw-space-lg' => __( 'Large', 'vispa' ),
		),
		'value'   => 'fw-space-sm',
		'custom'  => 'custom_height',
	),
	'color'     => array(
		'type'  => 'color-picker',
		'label' => esc_html__( 'Color', 'vispa' ),
		'desc'  => esc_html__( 'Select the color', 'vispa' ),
	),
	'class'     => array(
		'type'  => 'text',
		'label' => esc_html__( 'Custom Class', 'vispa' ),
		'desc'  => esc_html__( 'Enter a custom CSS class', 'vispa' ),
		'help'  => esc_html__( 'You can use this class to further style this shortcode by adding your custom CSS', 'vispa' ),
	),
);