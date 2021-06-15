<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$choices = ( fw()->extensions->get( 'slider' ) ) ? fw()->extensions->get( 'slider' )->get_populated_sliders_choices() : array();

$options = array(
	'general'             => array(
		'title'   => esc_html__( 'General', 'vispa' ),
		'type'    => 'tab',
		'options' => array(
			'general-options' => array(
				'title'   => esc_html__( 'General Tab Settings', 'vispa' ),
				'type'    => 'tab',
				'options' => array(
					'general-box' => array(
						'title'   => esc_html__( 'General Settings', 'vispa' ),
						'type'    => 'box',
						'options' => array(
							'logo_type'            => array(
								'type'    => 'multi-picker',
								'label'   => false,
								'desc'    => false,
								'picker'  => array(
									'selected' => array(
										'label'   => esc_html__( 'Logo Type', 'vispa' ),
										'desc'    => esc_html__( 'Choose the logo type', 'vispa' ),
										'type'    => 'short-select',
										'value'   => 'text',
										'choices' => array(
											'text'  => esc_html__( 'Text', 'vispa' ),
											'image' => esc_html__( 'Image', 'vispa' )
										)
									),
								),
								'choices' => array(
									'text'  => array(
										'logo_text' => array(
											'label' => esc_html__( 'Logo Text', 'vispa' ),
											'desc'  => esc_html__( 'Enter logo text', 'vispa' ),
											'value' => 'Vispa',
											'type'  => 'text'
										),
									),
									'image' => array(
										'logo' => array(
											'label' => esc_html__( 'Logo', 'vispa' ),
											'desc'  => esc_html__( 'Upload logo image', 'vispa' ),
											'type'  => 'upload'
										),
									),
								)
							),
							'site_color'           => array(
								'type'  => 'color-picker',
								'value' => '',
								'label' => esc_html__( 'Color Scheme', 'vispa' ),
								'desc'  => esc_html__( 'Choose the website color scheme', 'vispa' ),
							),
							'enable_header_search' => array(
								'type'         => 'switch',
								'value'        => 'yes',
								'label'        => esc_html__( 'Enable Search', 'vispa' ),
								'desc'         => esc_html__( 'Enable header search', 'vispa' ),
								'left-choice'  => array(
									'value' => 'no',
									'label' => esc_html__( 'No', 'vispa' ),
								),
								'right-choice' => array(
									'value' => 'yes',
									'label' => esc_html__( 'Yes', 'vispa' ),
								),
							),
						)
					),
				)
			),
			'social-options'  => array(
				'title'   => esc_html__( 'Social Profiles', 'vispa' ),
				'type'    => 'tab',
				'options' => array(
					'social-box' => array(
						'title'   => esc_html__( 'Social', 'vispa' ),
						'type'    => 'box',
						'options' => array(
							'socials' => array(
								'type'          => 'addable-popup',
								'label'         => esc_html__( 'Social Links', 'vispa' ),
								'desc'          => esc_html__( 'Add your social profiles', 'vispa' ),
								'template'      => '{{=social_name}}',
								'popup-options' => array(
									'social_name' => array(
										'label' => esc_html__( 'Name', 'vispa' ),
										'desc'  => esc_html__( 'Enter social name', 'vispa' ),
										'type'  => 'text',
									),
									'social_icon' => array(
										'label' => esc_html__( 'Icon', 'vispa' ),
										'desc'  => esc_html__( 'Select social icon', 'vispa' ),
										'type'  => 'icon',
										'value' => 'fa fa-adn',
									),
									'social-link' => array(
										'label' => esc_html__( 'Link', 'vispa' ),
										'desc'  => esc_html__( 'Enter your social URL link', 'vispa' ),
										'type'  => 'text',
										'value' => '#',
									)
								),
							),
						)
					),
				)
			),

		)
	),
	'fonts'               => array(
		'title'   => esc_html__( 'Fonts', 'vispa' ),
		'type'    => 'tab',
		'options' => array(
			'font1'   => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'font1' => array(
						'type'         => 'switch',
						'value'        => 'no',
						'attr'         => array(),
						'label'        => esc_html__( 'Primary Font', 'vispa' ),
						'desc'         => esc_html__( 'Enable custom primary font', 'vispa' ),
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
						'general_font_family' => array(
							'type'       => 'typography-v2',
							'value'      => array(
								'value' => array(
									'family' => 'Open Sans'
								),
							),
							'components' => array(
								'size'           => false,
								'line-height'    => false,
								'letter-spacing' => false,
								'color'          => false
							),
							'label'      => esc_html__( '', 'vispa' ),
							'desc'       => esc_html__( 'Choose theme primary font', 'vispa' )
						),
					),
					'no'  => array(),
				),
			),
			'font2'   => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'font2' => array(
						'type'         => 'switch',
						'value'        => 'no',
						'attr'         => array(),
						'label'        => esc_html__( 'Secondary Font', 'vispa' ),
						'desc'         => esc_html__( 'Enable custom secondary font', 'vispa' ),
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
						'general_font_family' => array(
							'type'       => 'typography-v2',
							'value'      => array(
								'family' => 'Poppins'
							),
							'components' => array(
								'size'           => false,
								'line-height'    => false,
								'letter-spacing' => false,
								'color'          => false
							),
							'label'      => esc_html__( '', 'vispa' ),
							'desc'       => esc_html__( 'Choose theme secondary font', 'vispa' )
						),
					),
					'no'  => array(),
				),
			),
			'h1_font' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'h1_font' => array(
						'type'         => 'switch',
						'value'        => 'no',
						'attr'         => array(),
						'label'        => esc_html__( 'H1 Styles', 'vispa' ),
						'desc'         => esc_html__( 'Enable h1 heading advanced styling', 'vispa' ),
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
						'h1_font' => array(
							'type'       => 'typography-v2',
							'value'      => array(
								'family'         => 'Montserrat',
								'style'          => 'normal',
								//'weight' => 700,
								'subset'         => 'latin',
								'variation'      => 'normal',
								'size'           => 24,
								'line-height'    => 1,
								'letter-spacing' => 0
							),
							'components' => array(
								'color' => false
							),
							'label'      => esc_html__( '', 'vispa' ),
							'desc'       => esc_html__( 'Choose h1 heading styles', 'vispa' )
						),
					),
					'no'  => array(),
				),
			),
			'h2_font' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'h2_font' => array(
						'type'         => 'switch',
						'value'        => 'no',
						'attr'         => array(),
						'label'        => esc_html__( 'H2 Styles', 'vispa' ),
						'desc'         => esc_html__( 'Enable h2 heading advanced styling', 'vispa' ),
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
						'h2_font' => array(
							'type'       => 'typography-v2',
							'value'      => array(
								'family'         => 'Montserrat',
								'style'          => 'normal',
								//'weight' => 700,
								'subset'         => 'latin',
								'variation'      => 'normal',
								'size'           => 21,
								'line-height'    => 1,
								'letter-spacing' => 0
							),
							'components' => array(
								'color' => false
							),
							'label'      => esc_html__( '', 'vispa' ),
							'desc'       => esc_html__( 'Choose h2 heading styles', 'vispa' )
						),
					),
					'no'  => array(),
				),
			),
			'h3_font' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'h3_font' => array(
						'type'         => 'switch',
						'value'        => 'no',
						'attr'         => array(),
						'label'        => esc_html__( 'H3 Styles', 'vispa' ),
						'desc'         => esc_html__( 'Enable h3 heading advanced styling', 'vispa' ),
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
						'h3_font' => array(
							'type'       => 'typography-v2',
							'value'      => array(
								'family'         => 'Montserrat',
								'style'          => 'normal',
								//'weight' => 700,
								'subset'         => 'latin',
								'variation'      => 'normal',
								'size'           => 20,
								'line-height'    => 1,
								'letter-spacing' => 0
							),
							'components' => array(
								'color' => false
							),
							'label'      => esc_html__( '', 'vispa' ),
							'desc'       => esc_html__( 'Choose h3 heading styles', 'vispa' )
						),
					),
					'no'  => array(),
				),
			),
			'h4_font' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'h4_font' => array(
						'type'         => 'switch',
						'value'        => 'no',
						'attr'         => array(),
						'label'        => esc_html__( 'H4 Styles', 'vispa' ),
						'desc'         => esc_html__( 'Enable h4 heading advanced styling', 'vispa' ),
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
						'h4_font' => array(
							'type'       => 'typography-v2',
							'value'      => array(
								'family'         => 'Montserrat',
								'style'          => 'normal',
								//'weight' => 700,
								'subset'         => 'latin',
								'variation'      => 'normal',
								'size'           => 16,
								'line-height'    => 1,
								'letter-spacing' => 0
							),
							'components' => array(
								'color' => false
							),
							'label'      => esc_html__( '', 'vispa' ),
							'desc'       => esc_html__( 'Choose h4 heading styles', 'vispa' )
						),
					),
					'no'  => array(),
				),
			),
			'h5_font' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'h5_font' => array(
						'type'         => 'switch',
						'value'        => 'no',
						'attr'         => array(),
						'label'        => esc_html__( 'H5 Styles', 'vispa' ),
						'desc'         => esc_html__( 'Enable h5 heading advanced styling', 'vispa' ),
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
						'h5_font' => array(
							'type'       => 'typography-v2',
							'value'      => array(
								'family'         => 'Montserrat',
								'style'          => 'normal',
								//'weight' => 700,
								'subset'         => 'latin',
								'variation'      => 'normal',
								'size'           => 14,
								'line-height'    => 1,
								'letter-spacing' => 0
							),
							'components' => array(
								'color' => false
							),
							'label'      => esc_html__( '', 'vispa' ),
							'desc'       => esc_html__( 'Choose h5 heading styles', 'vispa' )
						),
					),
					'no'  => array(),
				),
			),
			'h6_font' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'h6_font' => array(
						'type'         => 'switch',
						'value'        => 'no',
						'attr'         => array(),
						'label'        => esc_html__( 'H6 Styles', 'vispa' ),
						'desc'         => esc_html__( 'Enable h6 heading advanced styling', 'vispa' ),
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
						'h6_font' => array(
							'type'       => 'typography-v2',
							'value'      => array(
								'family'         => 'Montserrat',
								'style'          => 'normal',
								'subset'         => 'latin',
								'variation'      => 'normal',
								'size'           => 13,
								'line-height'    => 1,
								'letter-spacing' => 0
							),
							'components' => array(
								'color' => false
							),
							'label'      => esc_html__( '', 'vispa' ),
							'desc'       => esc_html__( 'Choose h6 heading styles', 'vispa' )
						),
					),
					'no'  => array(),
				),
			)
		)
	),
	'pages-settings'      => array(
		'title'   => esc_html__( 'Pages', 'vispa' ),
		'type'    => 'tab',
		'options' => array(
			'page_header' => array(
				'title'   => esc_html__( 'Page Settings', 'vispa' ),
				'type'    => 'box',
				'options' => array(
					'page_header_type' => array(
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
	),
	'posts'               => array(
		'title'   => esc_html__( 'Blog Posts', 'vispa' ),
		'type'    => 'tab',
		'options' => array(
			'posts_header'  => array(
				'title'   => esc_html__( 'Posts Header Settings', 'vispa' ),
				'type'    => 'box',
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
									'label'   => '',
									'desc'    => esc_html__( 'Select header slider', 'vispa' ),
									'choices' => $choices
								),
							)
						)
					)
				)
			),
			'post_settings' => array(
				'title'   => esc_html__( 'Blog Posts Settings', 'vispa' ),
				'type'    => 'box',
				'options' => array(
					'posts_view_type'        => array(
						'type'    => 'short-select',
						'value'   => 'yes',
						'label'   => esc_html__( 'Posts View Type', 'vispa' ),
						'desc'    => esc_html__( 'Select the posts view type', 'vispa' ),
						'choices' => array(
							'list'   => esc_html__( 'List', 'vispa' ),
							'grid-1' => esc_html__( 'Grid 1', 'vispa' ),
							'grid-2' => esc_html__( 'Grid 2', 'vispa' ),
						),
					),
					'enable-post-date'       => array(
						'type'         => 'switch',
						'value'        => 'yes',
						'label'        => esc_html__( 'Enable Date', 'vispa' ),
						'desc'         => esc_html__( 'Enable posts date.', 'vispa' ),
						'left-choice'  => array(
							'value' => 'no',
							'label' => esc_html__( 'No', 'vispa' ),
						),
						'right-choice' => array(
							'value' => 'yes',
							'label' => esc_html__( 'Yes', 'vispa' ),
						),
					),
					'enable-post-categories' => array(
						'type'         => 'switch',
						'value'        => 'yes',
						'label'        => esc_html__( 'Enable Categories', 'vispa' ),
						'desc'         => esc_html__( 'Enable posts categories.', 'vispa' ),
						'left-choice'  => array(
							'value' => 'no',
							'label' => esc_html__( 'No', 'vispa' ),
						),
						'right-choice' => array(
							'value' => 'yes',
							'label' => esc_html__( 'Yes', 'vispa' ),
						),
					),
					'enable-post-author'     => array(
						'type'         => 'switch',
						'value'        => 'yes',
						'label'        => esc_html__( 'Enable Author', 'vispa' ),
						'desc'         => esc_html__( 'Enable posts author.', 'vispa' ),
						'left-choice'  => array(
							'value' => 'no',
							'label' => esc_html__( 'No', 'vispa' ),
						),
						'right-choice' => array(
							'value' => 'yes',
							'label' => esc_html__( 'Yes', 'vispa' ),
						),
					),
					'enable-post-comments'     => array(
						'type'         => 'switch',
						'value'        => 'yes',
						'label'        => esc_html__( 'Enable Comments', 'vispa' ),
						'desc'         => esc_html__( 'Enable posts comments number.', 'vispa' ),
						'left-choice'  => array(
							'value' => 'no',
							'label' => esc_html__( 'No', 'vispa' ),
						),
						'right-choice' => array(
							'value' => 'yes',
							'label' => esc_html__( 'Yes', 'vispa' ),
						),
					),
					'enable-post-tags'       => array(
						'type'         => 'switch',
						'value'        => 'yes',
						'label'        => esc_html__( 'Enable Tags', 'vispa' ),
						'desc'         => esc_html__( 'Enable posts tags.', 'vispa' ),
						'left-choice'  => array(
							'value' => 'no',
							'label' => esc_html__( 'No', 'vispa' ),
						),
						'right-choice' => array(
							'value' => 'yes',
							'label' => esc_html__( 'Yes', 'vispa' ),
						),
					),
					'enable-post-share'      => array(
						'type'         => 'switch',
						'value'        => 'yes',
						'label'        => esc_html__( 'Enable Share Buttons', 'vispa' ),
						'desc'         => esc_html__( 'Enable posts share buttons.', 'vispa' ),
						'left-choice'  => array(
							'value' => 'no',
							'label' => esc_html__( 'No', 'vispa' ),
						),
						'right-choice' => array(
							'value' => 'yes',
							'label' => esc_html__( 'Yes', 'vispa' ),
						),
					),
					'enable-post-author-box' => array(
						'type'         => 'switch',
						'value'        => 'yes',
						'label'        => esc_html__( 'Enable Author Box', 'vispa' ),
						'desc'         => esc_html__( 'Enable posts author box.', 'vispa' ),
						'left-choice'  => array(
							'value' => 'no',
							'label' => esc_html__( 'No', 'vispa' ),
						),
						'right-choice' => array(
							'value' => 'yes',
							'label' => esc_html__( 'Yes', 'vispa' ),
						),
					),
					'enable-post-pagination' => array(
						'type'         => 'switch',
						'value'        => 'yes',
						'label'        => esc_html__( 'Enable Pagination', 'vispa' ),
						'desc'         => esc_html__( 'Enable posts pagination.', 'vispa' ),
						'left-choice'  => array(
							'value' => 'no',
							'label' => esc_html__( 'No', 'vispa' ),
						),
						'right-choice' => array(
							'value' => 'yes',
							'label' => esc_html__( 'Yes', 'vispa' ),
						),
					),
					'enable_related_posts'   => array(
						'label'        => esc_html__( 'Related Posts', 'vispa' ),
						'desc'         => esc_html__( 'Choose header type', 'vispa' ),
						'type'         => 'switch',
						'value'        => 'yes',
						'left-choice'  => array(
							'value' => 'no',
							'label' => esc_html__( 'No', 'vispa' ),
						),
						'right-choice' => array(
							'value' => 'yes',
							'label' => esc_html__( 'Yes', 'vispa' ),
						),
					),
				)
			),
		)
	),
	'portfolio'           => array(
		'title'   => esc_html__( 'Portfolio Categories', 'vispa' ),
		'type'    => 'tab',
		'options' => array(
			'portfolio_settings' => array(
				'title'   => esc_html__( 'Portfolio Categories Settings', 'vispa' ),
				'type'    => 'box',
				'options' => array(
					'filter'  => array(
						'type'         => 'switch',
						'label'        => __( 'Top Filter', 'vispa' ),
						'desc'         => __( 'Enable top filter?', 'vispa' ),
						'value'        => 'yes',
						'right-choice' => array(
							'value' => 'yes',
							'label' => __( 'Yes', 'vispa' ),
						),
						'left-choice'  => array(
							'value' => 'no',
							'label' => __( 'No', 'vispa' ),
						),
					),
					'spaces'  => array(
						'type'         => 'switch',
						'label'        => __( 'Spaces', 'vispa' ),
						'desc'         => __( 'Enable spaces between items?', 'vispa' ),
						'value'        => 'yes',
						'right-choice' => array(
							'value' => 'yes',
							'label' => __( 'Yes', 'vispa' ),
						),
						'left-choice'  => array(
							'value' => 'no',
							'label' => __( 'No', 'vispa' ),
						),
					),
					'columns' => array(
						'label'   => esc_html__( 'Columns', 'vispa' ),
						'desc'    => esc_html__( 'Choose the number of columns', 'vispa' ),
						'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
						'type'    => 'radio',
						'value'   => '2',
						'choices' => array(
							'2' => esc_html__( '2 Columns', 'vispa' ),
							'3' => esc_html__( '3 Columns', 'vispa' )
						)
					),
				)
			),
		)
	),
	'portfolio_post'      => array(
		'title'   => esc_html__( 'Portfolio Posts', 'vispa' ),
		'type'    => 'tab',
		'options' => array(
			'posts_header'       => array(
				'title'   => esc_html__( 'Portfolio Header Settings', 'vispa' ),
				'type'    => 'box',
				'options' => array(
					'portfolio_header_type' => array(
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
									'label'   => '',
									'desc'    => esc_html__( 'Select header slider', 'vispa' ),
									'choices' => $choices
								),
							)
						)
					)
				)
			),
			'portfolio_settings' => array(
				'title'   => esc_html__( 'Portfolio Posts Settings', 'vispa' ),
				'type'    => 'box',
				'options' => array(
					'enable-portfolio-categories' => array(
						'type'         => 'switch',
						'value'        => 'yes',
						'label'        => esc_html__( 'Enable Categories', 'vispa' ),
						'desc'         => esc_html__( 'Enable portfolio posts categories.', 'vispa' ),
						'left-choice'  => array(
							'value' => 'no',
							'label' => esc_html__( 'No', 'vispa' ),
						),
						'right-choice' => array(
							'value' => 'yes',
							'label' => esc_html__( 'Yes', 'vispa' ),
						),
					),
					'enable-portfolio-author-box' => array(
						'type'         => 'switch',
						'value'        => 'yes',
						'label'        => esc_html__( 'Enable Author Box', 'vispa' ),
						'desc'         => esc_html__( 'Enable portfolio posts author box.', 'vispa' ),
						'left-choice'  => array(
							'value' => 'no',
							'label' => esc_html__( 'No', 'vispa' ),
						),
						'right-choice' => array(
							'value' => 'yes',
							'label' => esc_html__( 'Yes', 'vispa' ),
						),
					),
					'enable-portfolio-share'      => array(
						'type'         => 'switch',
						'value'        => 'yes',
						'label'        => esc_html__( 'Enable Share Buttons', 'vispa' ),
						'desc'         => esc_html__( 'Enable portfolio posts share buttons.', 'vispa' ),
						'left-choice'  => array(
							'value' => 'no',
							'label' => esc_html__( 'No', 'vispa' ),
						),
						'right-choice' => array(
							'value' => 'yes',
							'label' => esc_html__( 'Yes', 'vispa' ),
						),
					),
					'enable-portfolio-pagination' => array(
						'type'         => 'switch',
						'value'        => 'yes',
						'label'        => esc_html__( 'Enable Pagination', 'vispa' ),
						'desc'         => esc_html__( 'Enable portfolio posts pagination.', 'vispa' ),
						'left-choice'  => array(
							'value' => 'no',
							'label' => esc_html__( 'No', 'vispa' ),
						),
						'right-choice' => array(
							'value' => 'yes',
							'label' => esc_html__( 'Yes', 'vispa' ),
						),
					),
				)
			),
		)
	),
	'homepage'            => array(
		'title'   => esc_html__( 'Home Page', 'vispa' ),
		'type'    => 'tab',
		'options' => array(
			'homepage_header' => array(
				'title'   => esc_html__( 'Homepage Settings (Front page displays : Your latest posts)', 'vispa' ),
				'type'    => 'box',
				'options' => array(
					'homepage_header_type' => array(
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
									'relative' => esc_html__( 'Relative', 'vispa' ),
									'image'    => esc_html__( 'Header Image', 'vispa' ),
									'slider'   => esc_html__( 'Header Slider', 'vispa' )
								)
							),
						),
						'choices' => array(
							'image'  => array(
								'img'   => array(
									'type'  => 'upload',
									'value' => '',
									'label' => esc_html__( '', 'vispa' ),
									'desc'  => esc_html__( 'Upload header image.', 'vispa' ),
								),
								'title' => array(
									'type'  => 'text',
									'value' => esc_html__( 'Homepage', 'vispa' ),
									'label' => esc_html__( 'Title', 'vispa' ),
									'desc'  => esc_html__( 'Add header title.', 'vispa' ),
								),
								'desc'  => array(
									'type'  => 'textarea',
									'value' => '',
									'label' => esc_html__( '', 'vispa' ),
									'desc'  => esc_html__( 'Add header short description.', 'vispa' ),
								),
							),
							'slider' => array(
								'slider_id' => array(
									'type'    => 'select',
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
	),
	'blogpage'            => array(
		'title'   => esc_html__( 'Blog Page', 'vispa' ),
		'type'    => 'tab',
		'options' => array(
			'homepage_header' => array(
				'title'   => esc_html__( 'Blog Page (When is selected a page as Blog Page)', 'vispa' ),
				'type'    => 'box',
				'options' => array(
					'blogpage_header_type' => array(
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
									'relative' => esc_html__( 'Relative', 'vispa' ),
									'image'    => esc_html__( 'Header Image', 'vispa' ),
									'slider'   => esc_html__( 'Header Slider', 'vispa' )
								)
							),
						),
						'choices' => array(
							'image'  => array(
								'img'   => array(
									'type'  => 'upload',
									'value' => '',
									'label' => esc_html__( '', 'vispa' ),
									'desc'  => esc_html__( 'Upload header image.', 'vispa' ),
								),
								'title' => array(
									'type'  => 'text',
									'label' => esc_html__( 'Title', 'vispa' ),
									'desc'  => esc_html__( 'Add header title.', 'vispa' ),
								),
								'desc'  => array(
									'type'  => 'textarea',
									'value' => '',
									'label' => esc_html__( '', 'vispa' ),
									'desc'  => esc_html__( 'Add header short description.', 'vispa' ),
								),
							),
							'slider' => array(
								'slider_id' => array(
									'type'    => 'select',
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
	),
	'searchpage-settings' => array(
		'title'   => esc_html__( 'Search Page', 'vispa' ),
		'type'    => 'tab',
		'options' => array(
			'search_header' => array(
				'title'   => esc_html__( 'Search Header Settings', 'vispa' ),
				'type'    => 'box',
				'options' => array(
					'search_header_type' => array(
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
									'relative' => esc_html__( 'Relative', 'vispa' ),
									'image'    => esc_html__( 'Header Image', 'vispa' ),
									'slider'   => esc_html__( 'Header Slider', 'vispa' )
								)
							),
						),
						'choices' => array(
							'image'  => array(
								'img'   => array(
									'type'  => 'upload',
									'value' => '',
									'label' => esc_html__( '', 'vispa' ),
									'desc'  => esc_html__( 'Upload header image.', 'vispa' ),
								),
								'title' => array(
									'type'  => 'text',
									'value' => '',
									'label' => esc_html__( '', 'vispa' ),
									'desc'  => esc_html__( 'Add header title.', 'vispa' ),
								),
								'desc'  => array(
									'type'  => 'textarea',
									'value' => '',
									'label' => esc_html__( '', 'vispa' ),
									'desc'  => esc_html__( 'Add header short description.', 'vispa' ),
								),
							),
							'slider' => array(
								'slider_id' => array(
									'type'    => 'select',
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
	),
	'404-settings'        => array(
		'title'   => esc_html__( '404 Page', 'vispa' ),
		'type'    => 'tab',
		'options' => array(
			'404_header' => array(
				'title'   => esc_html__( 'Search Header Settings', 'vispa' ),
				'type'    => 'box',
				'options' => array(
					'404_header_type' => array(
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
									'relative' => esc_html__( 'Relative', 'vispa' ),
									'image'    => esc_html__( 'Header Image', 'vispa' ),
									'slider'   => esc_html__( 'Header Slider', 'vispa' )
								)
							),
						),
						'choices' => array(
							'image'  => array(
								'img'   => array(
									'type'  => 'upload',
									'value' => '',
									'label' => esc_html__( '', 'vispa' ),
									'desc'  => esc_html__( 'Upload header image.', 'vispa' ),
								),
								'title' => array(
									'type'  => 'text',
									'value' => '',
									'label' => esc_html__( '', 'vispa' ),
									'desc'  => esc_html__( 'Add header title.', 'vispa' ),
								),
								'desc'  => array(
									'type'  => 'textarea',
									'value' => '',
									'label' => esc_html__( '', 'vispa' ),
									'desc'  => esc_html__( 'Add header short description.', 'vispa' ),
								),

							),
							'slider' => array(
								'slider_id' => array(
									'type'    => 'select',
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
	),
	'footer'              => array(
		'title'   => esc_html__( 'Footer', 'vispa' ),
		'type'    => 'tab',
		'options' => array(
			'footer-info' => array(
				'title'   => esc_html__( 'Footer Info', 'vispa' ),
				'type'    => 'box',
				'options' => array(
					'enable_footer_widgets' => array(
						'type'    => 'multi-picker',
						'label'   => false,
						'desc'    => false,
						'picker'  => array(
							'selected' => array(
								'type'         => 'switch',
								'value'        => 'yes',
								'label'        => esc_html__( 'Enable Widgets', 'vispa' ),
								'desc'         => esc_html__( 'Enable footer widgets', 'vispa' ),
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
								'enable_footer_socials' => array(
									'type'         => 'switch',
									'value'        => 'yes',
									'label'        => esc_html__( 'Enable Socials', 'vispa' ),
									'desc'         => esc_html__( 'Enable footer socials', 'vispa' ),
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
						)
					),
					'copyright'             => array(
						'label' => esc_html__( 'Copyright', 'vispa' ),
						'desc'  => esc_html__( 'Footer Copyright', 'vispa' ),
						'type'  => 'text',
						'value' => ''
					)
				)
			),
		)
	),
	'tracking_script_tab' => array(
		'title'   => esc_html__( 'Tracking Script', 'vispa' ),
		'type'    => 'tab',
		'options' => array(
			'script' => array(
				'title'   => esc_html__( 'Tracking', 'vispa' ),
				'type'    => 'box',
				'options' => array(
					'tracking_script' => array(
						'label' => esc_html__( 'Tracking Script', 'vispa' ),
						'desc'  => esc_html__( 'Enter your tracking script code (google analytics, or other script)', 'vispa' ),
						'type'  => 'textarea',
						'value' => ''
					),
				)
			)
		)
	),
	'custom_css_tab'      => array(
		'title'   => esc_html__( 'Custom CSS', 'vispa' ),
		'type'    => 'tab',
		'options' => array(
			'styling' => array(
				'title'   => esc_html__( 'CSS', 'vispa' ),
				'type'    => 'box',
				'options' => array(
					'quick_css' => array(
						'label' => esc_html__( 'Custom CSS', 'vispa' ),
						'desc'  => esc_html__( 'Enter your custom CSS styles', 'vispa' ),
						'type'  => 'textarea',
						'value' => '',
					),
				)
			)
		)
	),
	'api-keys'            => array(
		'title'   => __( 'API Keys', 'vispa' ),
		'type'    => 'tab',
		'options' => array(
			'api-keys-box' => array(
				'title'   => __( 'Google Maps', 'vispa' ),
				'type'    => 'box',
				'options' => array(
					'gmap-key' => array(
						'label' => __( 'Google Maps', 'vispa' ),
						'type'  => 'gmap-key',
						'desc'  => sprintf( __( 'Create an application in %sGoogle Console%s and add the API Key here.', 'vispa' ), '<a target="_blank" href="https://console.developers.google.com/flows/enableapi?apiid=places_backend,maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend&keyType=CLIENT_SIDE&reusekey=true">', '</a>' )
					),
				)
			),
		)
	),

);