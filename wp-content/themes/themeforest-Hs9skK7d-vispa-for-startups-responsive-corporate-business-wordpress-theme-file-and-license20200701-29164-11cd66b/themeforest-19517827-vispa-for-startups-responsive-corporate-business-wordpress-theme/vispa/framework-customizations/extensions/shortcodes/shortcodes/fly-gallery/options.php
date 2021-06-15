<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main'     => array(
		'title'   => esc_html__( 'Main Options', 'vispa' ),
		'type'    => 'tab',
		'options' => array(
			'unique_id'       => array(
				'type' => 'unique'
			),
			'gallery_columns' => array(
				'type'    => 'short-select',
				'value'   => 'columns3',
				'label'   => esc_html__( 'Gallery Columns', 'vispa' ),
				'desc'    => esc_html__( 'Select gallery columns number', 'vispa' ),
				'choices' => array(
					'columns2' => esc_html__( '2', 'vispa' ),
					'columns3' => esc_html__( '3', 'vispa' ),
					'columns4' => esc_html__( '4', 'vispa' ),
				),
			),
			'images'          => array(
				'type'          => 'addable-popup',
				'label'         => __( 'Images', 'vispa' ),
				'popup-title'   => __( 'Add/Edit Image', 'vispa' ),
				'desc'          => __( 'Create your gallery', 'vispa' ),
				'template'      => '{{=title}}',
				'popup-options' => array(
					'title'      => array(
						'type'  => 'text',
						'label' => __( 'Title', 'vispa' )
					),
					'img'        => array(
						'label' => 'Image',
						'type'  => 'upload',
					),
					'image_type' => array(
						'type'    => 'select',
						'value'   => 'yes',
						'label'   => esc_html__( 'Image Type', 'vispa' ),
						'desc'    => esc_html__( 'Select the image type', 'vispa' ),
						'choices' => array(
							'mini_square'  => esc_html__( 'Mini Square', 'vispa' ),
							'portrait'     => esc_html__( 'Portrait', 'vispa' ),
							'landscape'    => esc_html__( 'Landscape', 'vispa' ),
							'big_square'   => esc_html__( 'Big Square', 'vispa' ),
							'big_portrait' => esc_html__( 'Big Portrait', 'vispa' ),
						),
					),
				),
			),
			'class'           => array(
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
			'title_styling' => array(
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
		)
	)
);