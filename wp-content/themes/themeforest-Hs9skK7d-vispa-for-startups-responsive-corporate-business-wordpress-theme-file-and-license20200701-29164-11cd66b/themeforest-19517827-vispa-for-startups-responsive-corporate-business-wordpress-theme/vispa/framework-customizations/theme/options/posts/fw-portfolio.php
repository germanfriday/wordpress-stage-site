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
			'meta'     => array(
				'title'   => esc_html__( 'Meta Settings', 'vispa' ),
				'type'    => 'tab',
				'options' => array(
					'additional_info' => array(
						'type'    => 'multi-picker',
						'label'   => false,
						'desc'    => false,
						'picker'  => array(
							'selected' => array(
								'type'         => 'switch',
								'value'        => 'no',
								'label'        => esc_html__( 'Additional Info', 'vispa' ),
								'desc'         => esc_html__( 'Enable the additional info?', 'vispa' ),
								'left-choice'  => array(
									'value' => 'no',
									'label' => esc_html__( 'No', 'vispa' ),
								),
								'right-choice' => array(
									'value' => 'yes',
									'label' => esc_html__( 'Yes', 'vispa' ),
								),
							)
						),
						'choices' => array(
							'yes' => array(
								'client'          => array(
									'type'  => 'text',
									'value' => '',
									'label' => esc_html__( 'Client', 'vispa' ),
									'desc'  => esc_html__( 'Add the client.', 'vispa' ),
								),
								'production_date' => array(
									'type'  => 'text',
									'value' => '',
									'label' => esc_html__( 'Date', 'vispa' ),
									'desc'  => esc_html__( 'Add the production date.', 'vispa' ),
								),
								'skills'          => array(
									'type'  => 'text',
									'value' => '',
									'label' => esc_html__( 'Skills', 'vispa' ),
									'desc'  => esc_html__( 'Add used skills.', 'vispa' ),
								),
							)
						)
					)
				)
			),
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
								'value'   => 'general',
								'choices' => array(
									'general'  => esc_html__( 'General', 'vispa' ),
									'relative' => esc_html__( 'Relative', 'vispa' ),
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
			),
		)
	)
);