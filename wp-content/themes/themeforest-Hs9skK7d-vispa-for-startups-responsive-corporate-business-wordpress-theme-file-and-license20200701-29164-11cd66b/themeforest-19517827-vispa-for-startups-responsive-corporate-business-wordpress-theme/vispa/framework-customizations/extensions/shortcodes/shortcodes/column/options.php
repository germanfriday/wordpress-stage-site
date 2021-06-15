<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}


$options = array(
	'unique_id' => array(
		'type' => 'unique'
	),
	'tablet'    => array(
		'label'   => __( 'Tablet Display', 'vispa' ),
		'desc'    => __( 'Choose the responsive tablet display for this column', 'vispa' ),
		'help'    => __( 'Use this option in order to control how this column behaves on devices with the resolution between 768px - 991px (tablet portrait). Note that on phones all the columns are 1/1 by default.', 'vispa' ),
		'type'    => 'select',
		'value'   => '',
		'choices' => array(
			'same'       => __( 'Automatically inherit default layout', 'vispa' ),
			'col-sm-2'   => __( 'Make it a 1/6 column', 'vispa' ),
			'col-sm-1-5' => __( 'Make it a 1/5 column', 'vispa' ),
			'col-sm-3'   => __( 'Make it a 1/4 column', 'vispa' ),
			'col-sm-4'   => __( 'Make it a 1/3 column', 'vispa' ),
			'col-sm-6'   => __( 'Make it a 1/2 column', 'vispa' ),
			'col-sm-8'   => __( 'Make it a 2/3 column', 'vispa' ),
			'col-sm-9'   => __( 'Make it a 3/4 column', 'vispa' ),
			'col-sm-12'  => __( 'Make it a 1/1 column', 'vispa' ),
		)
	),
	'bg_color'  => array(
		'type'  => 'rgba-color-picker',
		'value' => '',
		'label' => esc_html__( 'Bg Color', 'vispa' ),
		'desc'  => esc_html__( 'Choose column background color', 'vispa' ),
	),
	'bg_image'  => array(
		'label' => esc_html__( 'Bg Image', 'vispa' ),
		'desc'  => esc_html__( 'Upload column background image', 'vispa' ),
		'type'  => 'upload',
		'value' => ''
	),
	'align'     => array(
		'label'   => esc_html__( 'Alignment', 'vispa' ),
		'desc'    => esc_html__( 'Choose the text alignment', 'vispa' ),
		'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
		'type'    => 'radio',
		'value'   => 'none',
		'choices' => array(
			'none'        => esc_html__( 'None', 'vispa' ),
			'text-left'   => esc_html__( 'Left', 'vispa' ),
			'text-center' => esc_html__( 'Center', 'vispa' ),
			'text-right'  => esc_html__( 'Right', 'vispa' ),
		)
	),
	'margin'    => array(
		'type'  => 'text',
		'label' => esc_html__( 'Margin', 'vispa' ),
		'desc'  => esc_html__( 'Enter a custom margin. Ex: 15px or 10px 15px 10px 20px', 'vispa' ),
	),
	'class'     => array(
		'type'  => 'text',
		'label' => esc_html__( 'Custom Class', 'vispa' ),
		'desc'  => esc_html__( 'Enter a custom CSS class', 'vispa' ),
		'help'  => esc_html__( 'You can use this class to further style this shortcode by adding your custom CSS', 'vispa' ),
	),
);