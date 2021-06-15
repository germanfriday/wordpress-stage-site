<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main'     => array(
		'title'   => esc_html__( 'Main Options', 'vispa' ),
		'type'    => 'tab',
		'options' => array(
			'unique_id'    => array(
				'type' => 'unique'
			),
			'testimonials' => array(
				'label'         => __( 'Testimonials', 'vispa' ),
				'popup-title'   => __( 'Add/Edit Testimonial', 'vispa' ),
				'desc'          => __( 'Here you can add, remove and edit your Testimonials.', 'vispa' ),
				'type'          => 'addable-popup',
				'template'      => '{{=title}}',
				'popup-options' => array(
					'title'         => array(
						'label' => __( 'Title', 'vispa' ),
						'desc'  => __( 'Enter the title', 'vispa' ),
						'type'  => 'text'
					),
					'author_avatar' => array(
						'label' => __( 'Image', 'vispa' ),
						'desc'  => __( 'Either upload a new, or choose an existing image from your media library', 'vispa' ),
						'type'  => 'upload',
					),
					'content'       => array(
						'label'  => __( 'Content', 'vispa' ),
						'desc'   => __( 'Enter the content', 'vispa' ),
						'type'   => 'wp-editor',
						'teeny'  => true,
						'reinit' => true,
					),
				)
			),
			'class'        => array(
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
			'title_styling'   => array(
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
		)
	)
);