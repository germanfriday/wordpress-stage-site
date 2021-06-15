<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'unique_id'    => array(
		'type' => 'unique'
	),
	'section_name' => array(
		'label' => __( 'Section Name', 'vispa' ),
		'desc'  => __( 'Enter a name (it is for internal use and will not appear on the front end)', 'vispa' ),
		'type'  => 'text',
	),
	'is_fullwidth' => array(
		'type'    => 'multi-picker',
		'label'   => false,
		'desc'    => false,
		'picker'  => array(
			'selected' => array(
				'label'        => __( 'Full Width', 'vispa' ),
				'type'         => 'switch',
				'desc'         => __( 'Make the content inside this section full width?', 'vispa' ),
				'left-choice'  => array(
					'value' => 'no',
					'label' => __( 'No', 'vispa' ),
				),
				'right-choice' => array(
					'value' => 'yes',
					'label' => __( 'Yes', 'vispa' ),
				),
				'value'        => 'no',
			),
		),
		'choices' => array(),
	),
	'bg_color'     => array(
		'type'  => 'rgba-color-picker',
		'value' => '',
		'label' => esc_html__( 'Bg Color', 'vispa' ),
		'desc'  => esc_html__( 'Choose section background color', 'vispa' ),
	),
	'bg_image'     => array(
		'label' => esc_html__( 'Bg Image', 'vispa' ),
		'desc'  => esc_html__( 'Upload section background image', 'vispa' ),
		'type'  => 'upload',
		'value' => ''
	),
	'overlay' => array(
		'type'    => 'multi-picker',
		'label'   => false,
		'desc'    => false,
		'picker'  => array(
			'selected' => array(
				'label'        => __( 'Overlay', 'vispa' ),
				'type'         => 'switch',
				'desc'         => __( 'Enable the overlay for this section?', 'vispa' ),
				'left-choice'  => array(
					'value' => 'no',
					'label' => __( 'No', 'vispa' ),
				),
				'right-choice' => array(
					'value' => 'yes',
					'label' => __( 'Yes', 'vispa' ),
				),
				'value'        => 'no',
			),
		),
		'choices' => array(
			'yes' => array(
				'color'     => array(
					'type'  => 'rgba-color-picker',
					'label' => esc_html__( '', 'vispa' ),
					'desc'  => esc_html__( 'Choose the section overlay color', 'vispa' ),
				),
			)
		),
	),
	'video_bg'         => array(
		'type'    => 'multi-picker',
		'label'   => false,
		'desc'    => false,
		'attr'    => array( 'class' => 'fw-video-background-image' ),
		'picker'  => array(
			'selected' => array(
				'label'        => __( 'Video Background', 'vispa' ),
				'type'         => 'switch',
				'right-choice' => array(
					'value' => 'yes',
					'label' => esc_html__( 'Yes', 'vispa' ),
				),
				'left-choice'  => array(
					'value' => 'no',
					'label' => esc_html__( 'No', 'vispa' ),
				),
				'value'        => 'no'
			),
		),
		'choices' => array(
			'yes' => array(
				'video_type' => array(
					'type'         => 'multi-picker',
					'label'        => false,
					'desc'         => false,
					'attr'         => array( 'class' => 'fw-video-background-image' ),
					'picker'       => array(
						'selected' => array(
							'label'   => __( '', 'vispa' ),
							'desc'    => __( 'Select the video type', 'vispa' ),
							'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
							'type'    => 'radio',
							'choices' => array(
								'youtube'  => __( 'Youtube', 'vispa' ),
								'vimeo'    => __( 'Vimeo', 'vispa' ),
								'uploaded' => __( 'Upload', 'vispa' ),
							),
							'value'   => 'youtube'
						),
					),
					'choices'      => array(
						'youtube'  => array(
							'video' => array(
								'label' => __( '', 'vispa' ),
								'desc'  => __( 'Insert a YouTube video URL', 'vispa' ),
								'type'  => 'text',
							),
						),
						'vimeo'    => array(
							'video' => array(
								'label' => __( '', 'vispa' ),
								'desc'  => __( 'Insert a Vimeo video URL', 'vispa' ),
								'type'  => 'text',
							),
						),
						'uploaded' => array(
							'video' => array(
								'label'       => __( '', 'vispa' ),
								'desc'        => __( 'Upload a video', 'vispa' ),
								'images_only' => false,
								'type'        => 'upload',
							),
						),
					),
					'show_borders' => false,
				),
			)
		)
	),
	'height'       => array(
		'label'   => __( 'Height', 'vispa' ),
		'desc'    => __( "Select the section's height in px (Ex: 400)", "vispa" ),
		'type'    => 'radio-text',
		'value'   => 'auto',
		'choices' => array(
			'auto'              => __( 'auto', 'vispa' ),
			'section-height-sm' => __( 'small', 'vispa' ),
			'section-height-md' => __( 'medium', 'vispa' ),
			'section-height-lg' => __( 'large', 'vispa' ),
		),
		'custom'  => 'custom_height',
	),
	'parallax'     => array(
		'type'    => 'multi-picker',
		'label'   => false,
		'desc'    => false,
		'picker'  => array(
			'selected' => array(
				'label'        => __( 'Parallax', 'vispa' ),
				'type'         => 'switch',
				'desc'         => __( 'Enable the parallax effect?', 'vispa' ),
				'left-choice'  => array(
					'value' => 'no',
					'label' => __( 'No', 'vispa' ),
				),
				'right-choice' => array(
					'value' => 'yes',
					'label' => __( 'Yes', 'vispa' ),
				),
				'value'        => 'no',
			),
		),
		'choices' => array(),
	),
	'link_id'      => array(
		'type'  => 'text',
		'label' => __( 'Link ID', 'vispa' ),
		'desc'  => __( 'Enter a custom CSS ID for this section (Ex: example-id)', 'vispa' ),
		'help'  => sprintf( "%s", __( 'Use this ID in any URL link in the page in order to anchor link to this section: (Ex: http://www.your-domain.com/#example-id)', 'vispa' ) ),
		'value' => '',
	),
	'class'        => array(
		'label' => esc_html__( 'Custom Class', 'vispa' ),
		'desc'  => esc_html__( 'Enter custom CSS class', 'vispa' ),
		'help'  => esc_html__( 'You can use this class to further style this shortcode by adding your custom CSS.', 'vispa' ),
		'type'  => 'text',
		'value' => '',
	),
);