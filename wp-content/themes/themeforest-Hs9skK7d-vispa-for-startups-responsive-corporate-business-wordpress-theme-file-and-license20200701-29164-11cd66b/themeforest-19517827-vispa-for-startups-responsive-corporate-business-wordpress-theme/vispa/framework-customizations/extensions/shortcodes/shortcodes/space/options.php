<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$template_directory = get_template_directory_uri();
$options            = array(
	'unique_id' => array(
		'type' => 'unique'
	),
	'height' => array(
		'label'   => __( 'Height', 'vispa' ),
		'desc'    => __( 'Select the space height in px', 'vispa' ),
		'type'    => 'radio-text',
		'choices' => array(
			'space-sm' => __( 'Small', 'vispa' ),
			'space-md' => __( 'Medium', 'vispa' ),
			'space-lg' => __( 'Large', 'vispa' ),
		),
		'value'   => 'space-md',
		'custom'  => 'custom_height',
	),
	'class'  => array(
		'type'  => 'text',
		'label' => esc_html__( 'Custom Class', 'vispa' ),
		'desc'  => esc_html__( 'Enter a custom CSS class', 'vispa' ),
		'help'  => esc_html__( 'You can use this class to further style this shortcode by adding your custom CSS', 'vispa' ),
	),
);