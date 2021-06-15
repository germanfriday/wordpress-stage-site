<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$choices = ( fw()->extensions->get( 'slider' ) ) ? fw()->extensions->get( 'slider' )->get_populated_sliders_choices() : array();
$options = array(
	'label_color'      => array(
		'type'  => 'color-picker',
		'value' => '',
		'label' => esc_html__( 'Label Color', 'vispa' ),
		'desc'  => esc_html__( 'Select the label color', 'vispa' ),
	),
	'blog_header_type' => array(
		'type'    => 'multi-picker',
		'label'   => false,
		'desc'    => false,
		'picker'  => array(
			'header_type' => array(
				'label'   => esc_html__( 'Header Type', 'vispa' ),
				'desc'    => esc_html__( 'Choose header type', 'vispa' ),
				'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
				'type'    => 'radio',
				'value'   => 'relative',
				'choices' => array(
					'relative' => esc_html__( 'Relative', 'vispa' ),
					'image'    => esc_html__( 'Header Image', 'vispa' ),
					'slider'   => esc_html__( 'Header Slider', 'vispa' )
				)
			),
		),
		'choices' => array(
			'image'  => array(
				'img' => array(
					'type'  => 'upload',
					'value' => '',
					'label' => esc_html__( '', 'vispa' ),
					'desc'  => esc_html__( 'Upload header image.', 'vispa' ),
				),
			),
			'slider' => array(
				'slider_id' => array(
					'type'    => 'select',
					'label'   => '',
					'value'   => '',
					'desc'    => esc_html__( 'Select header slider', 'vispa' ),
					'choices' => $choices
				),
			)
		)
	)
);