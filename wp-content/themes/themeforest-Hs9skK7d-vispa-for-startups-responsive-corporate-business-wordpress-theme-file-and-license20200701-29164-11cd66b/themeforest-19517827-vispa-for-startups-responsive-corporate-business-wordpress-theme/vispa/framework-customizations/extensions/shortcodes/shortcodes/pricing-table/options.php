<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$shortcodes = fw_ext( 'shortcodes' );
$button     = $shortcodes->get_shortcode( 'button' );

$options = array(
	'main'     => array(
		'title'   => esc_html__( 'Main Options', 'vispa' ),
		'type'    => 'tab',
		'options' => array(
			'unique_id' => array(
				'type' => 'unique'
			),
			'plan'      => array(
				'type'  => 'text',
				'label' => esc_html__( 'Plan Title', 'vispa' ),
				'desc'  => esc_html__( 'Add pricing plan', 'vispa' )
			),
			'time'      => array(
				'type'  => 'text',
				'label' => esc_html__( 'Plan Time', 'vispa' ),
				'desc'  => esc_html__( 'Add plan time', 'vispa' ),
				'value' => esc_html__( 'month', 'vispa' )
			),
			'price'     => array(
				'type'  => 'short-text',
				'label' => esc_html__( 'Price', 'vispa' ),
				'desc'  => esc_html__( 'Add the price', 'vispa' )
			),
			'currency'  => array(
				'type'  => 'short-text',
				'value' => '$',
				'label' => esc_html__( 'Currency', 'vispa' ),
				'desc'  => esc_html__( 'Add pricing currency', 'vispa' )
			),
			'rows'      => array(
				'type'          => 'addable-popup',
				'label'         => esc_html__( 'Rows', 'vispa' ),
				'desc'          => esc_html__( 'Add Rows', 'vispa' ),
				'template'      => '{{=row}}',
				'popup-options' => array(
					'row' => array(
						'type'  => 'text',
						'label' => esc_html__( 'Row', 'vispa' ),
						'desc'  => esc_html__( 'Add Row', 'vispa' )
					),
				),
			),
			'button'    => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'selected' => array(
						'type'         => 'switch',
						'value'        => 'no',
						'label'        => esc_html__( 'Enable Button', 'vispa' ),
						'desc'         => esc_html__( 'Enable the button', 'vispa' ),
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
						'button_options' => array(
							'type'          => 'popup',
							'label'         => __( 'Button', 'vispa' ),
							'button'        => __( 'Button Styling', 'vispa' ),
							'size'          => 'medium',
							'popup-options' => $button->get_options(),
						),
					),
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
			'time_styling'     => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'selected' => array(
						'type'         => 'switch',
						'value'        => 'no',
						'label'        => esc_html__( 'Time Styling', 'vispa' ),
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
			'price_styling'    => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'selected' => array(
						'type'         => 'switch',
						'value'        => 'no',
						'label'        => esc_html__( 'Price Styling', 'vispa' ),
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
			'currency_styling' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'selected' => array(
						'type'         => 'switch',
						'value'        => 'no',
						'label'        => esc_html__( 'Currency Styling', 'vispa' ),
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
			'rows_styling'     => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'selected' => array(
						'type'         => 'switch',
						'value'        => 'no',
						'label'        => esc_html__( 'Rows Styling', 'vispa' ),
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
			'bg_color'         => array(
				'label' => esc_html__( 'BG Color', 'vispa' ),
				'desc'  => esc_html__( 'Select the BG Color', 'vispa' ),
				'type'  => 'color-picker',
				'value' => '#f2f2f2'
			),
		)
	)
);