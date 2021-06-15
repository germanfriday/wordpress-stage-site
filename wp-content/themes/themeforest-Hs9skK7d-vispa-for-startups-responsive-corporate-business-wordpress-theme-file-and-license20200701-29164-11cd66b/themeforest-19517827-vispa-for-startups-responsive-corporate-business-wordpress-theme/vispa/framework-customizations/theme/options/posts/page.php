<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$choices = ( fw()->extensions->get( 'slider' ) ) ? fw()->extensions->get( 'slider' )->get_populated_sliders_choices() : array();
$options = array(
	'main' => array(
		'title'    => false,
		'type'     => 'box',
		'priority' => 'high',
		'context'  => 'normal',
		'options'  => array(
			'settings' => array(
				'title'   => esc_html__( 'Header Settings', 'vispa' ),
				'type'    => 'tab',
				'options' => array(
					'post_header_type' => array(
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
									'general'  => esc_html__( 'General', 'vispa' ),
									'relative' => esc_html__( 'Relative', 'vispa' ),
									'absolute' => esc_html__( 'Absolute', 'vispa' ),
									'image'    => esc_html__( 'Header Image', 'vispa' ),
									'slider'   => esc_html__( 'Header Slider', 'vispa' )
								)
							),
						),
						'choices' => array(
							'image'  => array(
								'img'  => array(
									'type'  => 'upload',
									'value' => '',
									'label' => esc_html__( '', 'vispa' ),
									'desc'  => esc_html__( 'Upload header image.', 'vispa' ),
								),
								'desc' => array(
									'type'  => 'textarea',
									'value' => '',
									'label' => esc_html__( '', 'vispa' ),
									'desc'  => esc_html__( 'Add header short description.', 'vispa' ),
								),
							),
							'slider' => array(
								'slider_id' => array(
									'type'    => 'select',
									'value'   => '',
									'label'   => '',
									'desc'    => esc_html__( 'Select header slider', 'vispa' ),
									'choices' => $choices
								),
							)
						)
					)
				)
			)
		)
	)
);