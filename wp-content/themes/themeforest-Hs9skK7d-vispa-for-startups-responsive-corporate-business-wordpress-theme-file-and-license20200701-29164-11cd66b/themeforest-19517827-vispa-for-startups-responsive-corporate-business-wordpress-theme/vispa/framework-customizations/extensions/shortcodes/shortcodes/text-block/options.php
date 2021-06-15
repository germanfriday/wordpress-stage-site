<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'unique_id'       => array(
		'type' => 'unique'
	),
	'text'            => array(
		'type'   => 'wp-editor',
		'teeny'  => true,
		'label'  => esc_html__( 'Content', 'vispa' ),
		'desc'   => esc_html__( 'Enter some content for this texblock', 'vispa' )
	),
	'content_styling' => array(
		'type'    => 'multi-picker',
		'label'   => false,
		'desc'    => false,
		'picker'  => array(
			'selected' => array(
				'type'         => 'switch',
				'value'        => 'no',
				'label'        => esc_html__( 'Content Styling', 'vispa' ),
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
	'class'           => array(
		'type'  => 'text',
		'label' => esc_html__( 'Custom Class', 'vispa' ),
		'desc'  => esc_html__( 'Enter a custom CSS class', 'vispa' ),
		'help'  => esc_html__( 'You can use this class to further style this shortcode by adding your custom CSS', 'vispa' ),
	),
);
