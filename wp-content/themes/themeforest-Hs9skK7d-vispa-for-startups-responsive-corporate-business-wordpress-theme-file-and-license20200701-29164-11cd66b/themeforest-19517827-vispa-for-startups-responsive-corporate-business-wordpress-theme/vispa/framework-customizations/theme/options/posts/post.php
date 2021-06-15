<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$choices  = ( fw()->extensions->get( 'slider' ) ) ? fw()->extensions->get( 'slider' )->get_populated_sliders_choices() : array();
$options  = array(
	'main' => array(
		'title'    => false,
		'type'     => 'box',
		'priority' => 'high',
		'context'  => 'normal',
		'options'  => array(
			'types'    => array(
				'title'   => esc_html__( 'Post View Type', 'vispa' ),
				'type'    => 'tab',
				'options' => array(
					'post_type' => array(
						'type'    => 'multi-picker',
						'label'   => false,
						'desc'    => false,
						'picker'  => array(
							'post_type' => array(
								'label'   => esc_html__( 'Post Type', 'vispa' ),
								'desc'    => esc_html__( 'Choose post view type', 'vispa' ),
								'type'    => 'select',
								'value'   => '',
								'choices' => array(
									'default' => esc_html__( 'Default', 'vispa' ),
									'slider'  => esc_html__( 'Slider', 'vispa' ),
									'video'   => esc_html__( 'Video', 'vispa' ),
									'audio'   => esc_html__( 'Soundcloud Audio', 'vispa' ),
									'link'    => esc_html__( 'Link', 'vispa' ),
									'quote'   => esc_html__( 'Quote', 'vispa' ),
								)
							),
						),
						'choices' => array(
							'slider' => array(
								'images' => array(
									'type'        => 'multi-upload',
									'value'       => '',
									'images_only' => true,
									'label'       => esc_html__( '', 'vispa' ),
									'desc'        => esc_html__( 'Upload slider images.', 'vispa' ),
								),
							),
							'video'  => array(
								'video' => array(
									'type'  => 'textarea',
									'value' => '',
									'label' => esc_html__( '', 'vispa' ),
									'desc'  => esc_html__( 'Add here the youtube, vimeo video link or a video iframe.', 'vispa' ),
								),
							),
							'audio'  => array(
								'audio' => array(
									'type'  => 'textarea',
									'value' => '',
									'label' => esc_html__( '', 'vispa' ),
									'desc'  => esc_html__( 'Add here soundcloud iframe.', 'vispa' ),
								),
							),
							'link'   => array(
								'link' => array(
									'type'  => 'text',
									'value' => '',
									'label' => esc_html__( '', 'vispa' ),
									'desc'  => esc_html__( 'Add post external link.', 'vispa' ),
								),
								'text' => array(
									'type'  => 'text',
									'value' => '',
									'label' => esc_html__( '', 'vispa' ),
									'desc'  => esc_html__( 'Add post link text.', 'vispa' ),
								),
							),
							'quote'  => array(
								'quote' => array(
									'type'  => 'textarea',
									'value' => '',
									'label' => esc_html__( '', 'vispa' ),
									'desc'  => esc_html__( 'Add post quote text.', 'vispa' ),
								),
							),
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