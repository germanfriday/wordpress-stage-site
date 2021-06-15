<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main'     => array(
		'title'   => esc_html__( 'Main Options', 'vispa' ),
		'type'    => 'tab',
		'options' => array(
			'unique_id'   => array(
				'type' => 'unique'
			),
			'type'        => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'selected' => array(
						'label'   => esc_html__( 'Type', 'vispa' ),
						'desc'    => esc_html__( 'Choose button type', 'vispa' ),
						'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
						'type'    => 'radio',
						'value'   => 'btn-fill',
						'choices' => array(
							'btn-fill'        => esc_html__( 'Fill', 'vispa' ),
							'btn-transparent' => esc_html__( 'Transparent', 'vispa' )
						)
					),
				),
				'choices' => array(
					'btn-fill'        => array(
						'bg_color' => array(
							'label' => esc_html__( 'BG Color', 'vispa' ),
							'desc'  => esc_html__( 'Select the BG Color', 'vispa' ),
							'type'  => 'color-picker',
							'value' => '#00a98f'
						),
					),
					'btn-transparent' => array()
				)
			),
			'color_group' => array(
				'type'    => 'group',
				'options' => array(
					'label_color'       => array(
						'label' => esc_html__( 'Label Color', 'vispa' ),
						'desc'  => esc_html__( 'Select the label color', 'vispa' ),
						'type'  => 'color-picker',
						'value' => '#fff'
					),
					'label_hover_color' => array(
						'label' => esc_html__( 'Label Hover Color', 'vispa' ),
						'desc'  => esc_html__( 'Select the hover label color', 'vispa' ),
						'type'  => 'color-picker',
						'value' => ''
					),
					'bg_hover_color'    => array(
						'label' => esc_html__( 'BG Hover Color', 'vispa' ),
						'desc'  => esc_html__( 'Select the BG Hover Color', 'vispa' ),
						'type'  => 'color-picker',
						'value' => ''
					),
				)
			),
			'label'       => array(
				'label' => esc_html__( 'Label', 'vispa' ),
				'desc'  => esc_html__( 'This is the text that appears on your button', 'vispa' ),
				'type'  => 'text',
				'value' => 'Submit'
			),
			'link'        => array(
				'label' => esc_html__( 'Link', 'vispa' ),
				'desc'  => esc_html__( 'Where should your button link to?', 'vispa' ),
				'type'  => 'text',
				'value' => '#'
			),
			'size'        => array(
				'label'   => esc_html__( 'Size', 'vispa' ),
				'desc'    => esc_html__( 'Choose button size', 'vispa' ),
				'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
				'type'    => 'radio',
				'value'   => 'btn-md',
				'choices' => array(
					'btn-sm' => esc_html__( 'Small', 'vispa' ),
					'btn-md' => esc_html__( 'Medium', 'vispa' ),
					'btn-lg' => esc_html__( 'Large', 'vispa' ),
				)
			),
			'align'       => array(
				'label'   => esc_html__( 'Alignment', 'vispa' ),
				'desc'    => esc_html__( 'Choose button alignment', 'vispa' ),
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
			'round'       => array(
				'type'         => 'switch',
				'label'        => esc_html__( 'Round', 'vispa' ),
				'desc'         => esc_html__( 'Make button round?', 'vispa' ),
				'value'        => 'btn-no-round',
				'right-choice' => array(
					'value' => 'btn-round',
					'label' => esc_html__( 'Yes', 'vispa' ),
				),
				'left-choice'  => array(
					'value' => 'btn-no-round',
					'label' => esc_html__( 'No', 'vispa' ),
				),
			),
			'target'      => array(
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
		)
	),
	'advanced' => array(
		'title'   => esc_html__( 'Advanced Options', 'vispa' ),
		'type'    => 'tab',
		'options' => array(
			'label_styling' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'selected' => array(
						'type'         => 'switch',
						'value'        => 'no',
						'label'        => esc_html__( 'Label Styling', 'vispa' ),
						'desc'         => esc_html__( 'Enable custom styling', 'vispa' ),
						'left-choice'  => array(
							'value' => 'no',
							'label' => esc_html__( 'No', 'vispa' ),
						),
						'right-choice' => array(
							'value' => 'yes',
							'label' => esc_html__( 'Yes', 'vispa' ),
						),
					),
				),
				'choices' => array(
					'yes' => array(
						'font' => array(
							'type'       => 'typography-v2',
							'value'      => array(
								'family'         => 'Arial',
								'size'           => 16,
								'line-height'    => 26,
								'letter-spacing' => 1,
								'color'          => ''
							),
							'components' => array(
								'color' => false
							),
							'label'      => esc_html__( '', 'vispa' ),
							'desc'       => esc_html__( 'Choose the custom font', 'vispa' )
						),
					),
					'no'  => array(),
				),
			),
		)
	)
);