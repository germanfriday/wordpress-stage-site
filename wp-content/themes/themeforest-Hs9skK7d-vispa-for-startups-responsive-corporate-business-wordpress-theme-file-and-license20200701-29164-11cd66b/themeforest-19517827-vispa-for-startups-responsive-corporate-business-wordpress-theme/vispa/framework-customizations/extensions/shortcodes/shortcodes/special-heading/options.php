<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main'     => array(
		'title'   => esc_html__( 'Main Options', 'vispa' ),
		'type'    => 'tab',
		'options' => array(
			'unique_id' => array(
				'type' => 'unique'
			),
			'title'     => array(
				'type'  => 'text',
				'label' => __( 'Title', 'vispa' ),
				'desc'  => __( 'Write the heading title content', 'vispa' ),
			),
			'separator' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'selected' => array(
						'label'        => __( 'Separator', 'vispa' ),
						'type'         => 'switch',
						'desc'         => __( 'Enable the separator?', 'vispa' ),
						'left-choice'  => array(
							'value' => 'no',
							'label' => __( 'No', 'vispa' ),
						),
						'right-choice' => array(
							'value' => 'yes',
							'label' => __( 'Yes', 'vispa' ),
						),
						'value'        => 'yes',
					),
				),
				'choices' => array(
					'yes' => array(
						'type' => array(
							'type'    => 'short-select',
							'label'   => __( '', 'vispa' ),
							'desc'    => __( 'Select the separator type', 'vispa' ),
							'value'   => 'diamond',
							'choices' => array(
								'diamond' => __( 'Diamond', 'vispa' ),
								'star'    => __( 'Star', 'vispa' ),
								'square'  => __( 'Square', 'vispa' ),
							)
						),
					)
				),
			),
			'subtitle'  => array(
				'type'  => 'textarea',
				'label' => __( 'Text', 'vispa' ),
				'desc'  => __( 'Enter the heading text', 'vispa' ),
			),
			'heading'   => array(
				'type'    => 'short-select',
				'label'   => __( 'Size', 'vispa' ),
				'value'   => 'h2',
				'choices' => array(
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				)
			),
			'centered'  => array(
				'type'         => 'switch',
				'label'        => __( 'Centered', 'vispa' ),
				'value'        => 'yes',
				'left-choice'  => array(
					'value' => 'no',
					'label' => __( 'No', 'vispa' ),
				),
				'right-choice' => array(
					'value' => 'yes',
					'label' => __( 'Yes', 'vispa' ),
				),
			),
			'class'     => array(
				'type'  => 'text',
				'label' => esc_html__( 'Custom Class', 'vispa' ),
				'desc'  => esc_html__( 'Enter a custom CSS class', 'vispa' ),
				'help'  => esc_html__( 'You can use this class to further style this shortcode by adding your custom CSS', 'vispa' ),
			),
		)
	),
	'advanced' => array(
		'title'   => esc_html__( 'Advanced Options', 'vispa' ),
		'type'    => 'tab',
		'options' => array(
			'title_styling'    => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'selected' => array(
						'type'         => 'switch',
						'value'        => 'no',
						'label'        => esc_html__( 'Title Styling', 'vispa' ),
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
							'type'  => 'typography-v2',
							'value' => array(
								'family'         => 'Arial',
								'size'           => 16,
								'line-height'    => 26,
								'letter-spacing' => 1,
								'color'          => ''
							),
							'label' => esc_html__( '', 'vispa' ),
							'desc'  => esc_html__( 'Choose the custom font', 'vispa' )
						),
					),
					'no'  => array(),
				),
			),
			'subtitle_styling' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'selected' => array(
						'type'         => 'switch',
						'value'        => 'no',
						'label'        => esc_html__( 'Text Styling', 'vispa' ),
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
							'type'  => 'typography-v2',
							'value' => array(
								'family'         => 'Arial',
								'size'           => 16,
								'line-height'    => 26,
								'letter-spacing' => 1,
								'color'          => ''
							),
							'label' => esc_html__( '', 'vispa' ),
							'desc'  => esc_html__( 'Choose the custom font', 'vispa' )
						),
					),
					'no'  => array(),
				),
			),
			'separator_color'  => array(
				'type'  => 'color-picker',
				'label' => __( 'Separator Color', 'vispa' ),
				'desc'  => __( 'Select the separator color', 'vispa' ),
			),
		)
	)
);
