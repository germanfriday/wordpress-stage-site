<?php
/**
 * Aiteko: Customizer
 *
 * @since 1.0
 * @package Aiteko
 */

/**
 * Customizer theme's elements section.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @since 1.0
 */
function aiteko_theme_customize_global_ele( $wp_customize ) {
	// add new section.
	$wp_customize->add_section(
		'wip_elements',
		array(
			'title'      => esc_html__( 'Elements', 'aiteko' ),
			'capability' => 'edit_theme_options',
			'priority'   => 25,
		)
	);

	// Settings.
	$wp_customize->add_setting(
		'enabled_ajax',
		array(
			'default'           => true,
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_setting(
		'enable_preloader',
		array(
			'default'           => true,
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_setting(
		'archive_portfolio_style',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_setting(
		'footer_widgets',
		array(
			'default'           => true,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_setting(
		'show_tag_lists',
		array(
			'default'           => true,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_setting(
		'show_social_shares',
		array(
			'default'           => true,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_setting(
		'show_author_box',
		array(
			'default'           => true,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_setting(
		'post_prev_next',
		array(
			'default'           => true,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_html',
		)
	);

	// Controls.
	// Version 1.1.0 add Ajax enabled/disabled option
	$wp_customize->add_control(
		new Aiteko_Customizer_Ui_Toggle(
			$wp_customize,
			'enabled_ajax',
			array(
				'label'       => esc_html__( 'Enable/Disabled Ajax', 'aiteko' ),
				'description' => esc_html__( 'Ajax is awesome, but only limited plugins and elementor modules that compatible with AJAX. In case you need some heavy plugins and modules, disabled this ajax might reduce the compatibility issue', 'aiteko' ),
				'section'     => 'wip_elements',
				'priority'    => 8,
			)
		)
	);

	$wp_customize->add_control(
		new Aiteko_Customizer_Ui_Toggle(
			$wp_customize,
			'enable_preloader',
			array(
				'label'       => esc_html__( 'Enable/Disable the preloader', 'aiteko' ),
				'description' => '',
				'section'     => 'wip_elements',
				'priority'    => 9,
			)
		)
	);

	$wp_customize->add_control(
		'archive_portfolio_style',
		array(
			'type'     => 'radio',
			'label'    => esc_html__( 'Portfolio archive style', 'aiteko' ),
			'choices'  => array(
				''       => esc_html__( 'Default', 'aiteko' ),
				'grid' => esc_html__( 'Grid (masonry)', 'aiteko' ),
			),
			'section'  => 'wip_elements',
			'priority' => 10,
		)
	);

	$wp_customize->add_control(
		new Aiteko_Customizer_Ui_Toggle(
			$wp_customize,
			'footer_widgets',
			array(
				'label'       => esc_html__( 'Footer widgets', 'aiteko' ),
				'description' => '',
				'section'     => 'wip_elements',
				'priority'    => 15,
			)
		)
	);

	$wp_customize->add_control(
		new Aiteko_Customizer_Ui_Toggle(
			$wp_customize,
			'show_tag_lists',
			array(
				'label'       => esc_html__( 'Tag lists', 'aiteko' ),
				'description' => esc_html__( 'Turn off/on the tag lists in single post page.', 'aiteko' ),
				'section'     => 'wip_elements',
				'priority'    => 16,
			)
		)
	);

	$wp_customize->add_control(
		new Aiteko_Customizer_Ui_Toggle(
			$wp_customize,
			'show_social_shares',
			array(
				'label'       => esc_html__( 'Social share buttons', 'aiteko' ),
				'description' => esc_html__( 'Turn off/on the social share buttons in single post page.', 'aiteko' ),
				'section'     => 'wip_elements',
				'priority'    => 17,
			)
		)
	);

	$wp_customize->add_control(
		new Aiteko_Customizer_Ui_Toggle(
			$wp_customize,
			'show_author_box',
			array(
				'label'       => esc_html__( 'Author info', 'aiteko' ),
				'description' => esc_html__( 'Turn off/on the author info in single post page.', 'aiteko' ),
				'section'     => 'wip_elements',
				'priority'    => 18,
			)
		)
	);

	$wp_customize->add_control(
		new Aiteko_Customizer_Ui_Toggle(
			$wp_customize,
			'post_prev_next',
			array(
				'label'       => esc_html__( 'Next/Previous post link.', 'aiteko' ),
				'description' => esc_html__( 'Turn off/on the Next/Previous post link in single post page.', 'aiteko' ),
				'section'     => 'wip_elements',
				'priority'    => 19,
			)
		)
	);
}
add_action( 'customize_register', 'aiteko_theme_customize_global_ele' );

/**
 * Customizer social icons.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @since 1.0
 */
function aiteko_customizer_theme_customize_social_icons( $wp_customize ) {
	// add new section.
	$wp_customize->add_section(
		'theme_social_icons',
		array(
			'title'      => esc_html__( 'Social Icons', 'aiteko' ),
			'capability' => 'edit_theme_options',
			'priority'   => 35,
		)
	);

	// Settings.
	$settings = array(
		'social_dribbble',
		'social_facebook',
		'social_github',
		'social_google-plus',
		'social_medium',
		'social_instagram',
		'social_linkedin',
		'social_pinterest',
		'social_twitter',
		'social_youtube',
	);

	$priority = 20;
	foreach ( $settings as $setting ) {
		// Settings.
		$wp_customize->add_setting(
			$setting,
			array(
				'default'           => '',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		// Controls.
		$wp_customize->add_control(
			$setting,
			array(
				'type'        => 'text',
				'label'       => str_replace( 'social_', '', $setting ),
				'description' => sprintf(
					/* translators: %s: social media name */
					esc_html__( 'Enter your %s public profile url.', 'aiteko' ),
					str_replace( 'social_', '', $setting )
				),
				'section'     => 'theme_social_icons',
				'priority'    => $priority,
			)
		);

		$priority++;
	}
	unset( $setting );
	unset( $priority );

	$wp_customize->add_setting(
		'enable_site_social',
		array(
			'default'           => false,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_control(
		new Aiteko_Customizer_Ui_Toggle(
			$wp_customize,
			'enable_site_social',
			array(
				'label'       => esc_html__( 'Enable/Disable Social Icon', 'aiteko' ),
				'description' => "",
				'section'     => 'theme_social_icons',
				'priority'    => 10,
			)
		)
	);
}
add_action( 'customize_register', 'aiteko_customizer_theme_customize_social_icons' );

/**
 * Customizer custom skin
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @since 1.0
 */
function aiteko_customizer_theme_customize_skin( $wp_customize ) {
	$description = '';
	if ( ! class_exists( 'Wip_Themes_Core' ) ) {
		$description = esc_html__( 'The "WIP-Themes Core" Plugin is not active! This feature has been disabled!', 'aiteko' );
	}

	// Add new panel.
	$wp_customize->add_panel(
		'theme_skin',
		array(
			'priority'       => 32,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Custom Skin', 'aiteko' ),
			'description'    => $description,
		)
	);

	// New section.
	$wp_customize->add_section(
		'theme_skin_base',
		array(
			'title'       => esc_html__( 'Base styling', 'aiteko' ),
			'panel'       => 'theme_skin',
			'priority'    => 10,
			'description' => '',
		)
	);

	$wp_customize->add_section(
		'theme_skin_side',
		array(
			'title'       => esc_html__( 'Side menu', 'aiteko' ),
			'panel'       => 'theme_skin',
			'priority'    => 15,
			'description' => '',
		)
	);

	$wp_customize->add_section(
		'theme_skin_sm_side',
		array(
			'title'       => esc_html__( 'Side control bar', 'aiteko' ),
			'panel'       => 'theme_skin',
			'priority'    => 20,
			'description' => '',
		)
	);

	$wp_customize->add_section(
		'theme_skin_footer',
		array(
			'title'       => esc_html__( 'Footer', 'aiteko' ),
			'panel'       => 'theme_skin',
			'priority'    => 25,
			'description' => '',
		)
	);

	$wp_customize->add_section(
		'theme_skin_preloader',
		array(
			'title'       => esc_html__( 'Preloader', 'aiteko' ),
			'panel'       => 'theme_skin',
			'priority'    => 30,
			'description' => '',
		)
	);

	$wp_customize->add_setting(
		'enable_custom_skin',
		array(
			'default'           => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_control(
		new Aiteko_Customizer_Ui_Toggle(
			$wp_customize,
			'enable_custom_skin',
			array(
				'label'       => esc_html__( 'Enable Custom Skin', 'aiteko' ),
				'description' => esc_html__( 'You need to enable this option to apply the custom skin on the front-end.', 'aiteko' ),
				'section'     => 'theme_skin_base',
				'priority'    => 9,
			)
		)
	);

	$settings              = aiteko_customizer_skin_settings();
	$selective_refresh_ids = array();
	foreach ( $settings as $setting_id => $setting ) {
		// Settings.
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $setting['default'],
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// Controls.
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$setting_id,
				array(
					'label'       => $setting['label'],
					'description' => $setting['description'],
					'section'     => $setting['section'],
					'priority'    => $setting['priority'],
				)
			)
		);

		$selective_refresh_ids[] = $setting_id;
	}
	unset( $setting );

	if ( ! class_exists( 'Wip_Themes_Core' ) ) {
		return false;
	}

	$wp_customize->selective_refresh->add_partial(
		'aiteko_primary_color',
		array(
			'settings'            => $selective_refresh_ids,
			'selector'            => '#aiteko-customizer-custom-css',
			'render_callback'     => 'aiteko_process_customizer_api_color',
			'container_inclusive' => false,
			'fallback_refresh'    => false,
		)
	);
}
add_action( 'customize_register', 'aiteko_customizer_theme_customize_skin' );

/**
 * Skin setting in array
 *
 * @return array
 */
function aiteko_customizer_skin_settings() {
	$settings_options = array(
		'aiteko_primary_color'           => array(
			'label'       => esc_html__( 'Primary Color/Accent Color', 'aiteko' ),
			'description' => '',
			'priority'    => 10,
			'section'     => 'theme_skin_base',
			'default'     => '#ea3c53',
		),
		'body_bg'                        => array(
			'label'       => esc_html__( 'Body background', 'aiteko' ),
			'description' => '',
			'priority'    => 11,
			'section'     => 'theme_skin_base',
			'default'     => '#ffffff',
		),
		'color_text_main'                => array(
			'label'       => esc_html__( 'Main text color', 'aiteko' ),
			'description' => '',
			'priority'    => 13,
			'section'     => 'theme_skin_base',
			'default'     => '#565656',
		),
		'color_text_heading'             => array(
			'label'       => esc_html__( 'Heading text color', 'aiteko' ),
			'description' => '',
			'priority'    => 14,
			'section'     => 'theme_skin_base',
			'default'     => '#1a1a1a',
		),
		'color_text_light'               => array(
			'label'       => esc_html__( 'Light text color', 'aiteko' ),
			'description' => esc_html__( 'The light version of text color, used for several blocks', 'aiteko' ),
			'priority'    => 15,
			'section'     => 'theme_skin_base',
			'default'     => '#969696',
		),
		'color_link'                     => array(
			'label'       => esc_html__( 'Link color', 'aiteko' ),
			'description' => '',
			'priority'    => 16,
			'section'     => 'theme_skin_base',
			'default'     => '#ea3c53',
		),
		'color_link_hover'               => array(
			'label'       => esc_html__( 'Link color (mouseover)', 'aiteko' ),
			'description' => '',
			'priority'    => 17,
			'section'     => 'theme_skin_base',
			'default'     => '#ad1327',
		),
		'input_bg'                       => array(
			'label'       => esc_html__( 'Input field background', 'aiteko' ),
			'description' => '',
			'priority'    => 18,
			'section'     => 'theme_skin_base',
			'default'     => '#ffffff',
		),
		'input_bg_focus'                 => array(
			'label'       => esc_html__( 'Input field (focus) background', 'aiteko' ),
			'description' => esc_html__( 'Input field background on focus/active state', 'aiteko' ),
			'priority'    => 19,
			'section'     => 'theme_skin_base',
			'default'     => '#ffffff',
		),
		'color_text_input'               => array(
			'label'       => esc_html__( 'Input field text color', 'aiteko' ),
			'description' => '',
			'priority'    => 20,
			'section'     => 'theme_skin_base',
			'default'     => '#989898',
		),
		'color_text_input_focus'         => array(
			'label'       => esc_html__( 'Input field (focus) text color', 'aiteko' ),
			'description' => '',
			'priority'    => 21,
			'section'     => 'theme_skin_base',
			'default'     => '#565656',
		),
		'color_text_input_placeholder'   => array(
			'label'       => esc_html__( 'Input field placeholder text color', 'aiteko' ),
			'description' => '',
			'priority'    => 22,
			'section'     => 'theme_skin_base',
			'default'     => '#989898',
		),
		'searchbar_bg'                   => array(
			'label'       => esc_html__( 'Search form background', 'aiteko' ),
			'description' => '',
			'priority'    => 23,
			'section'     => 'theme_skin_base',
			'default'     => '#141414',
		),
		'sidebar_bg'                      => array(
			'label'       => esc_html__( 'Side menu background', 'aiteko' ),
			'description' => '',
			'priority'    => 10,
			'section'     => 'theme_skin_side',
			'default'     => '#141414',
		),
		'color_text_sidebar'              => array(
			'label'       => esc_html__( 'Text color', 'aiteko' ),
			'description' => '',
			'priority'    => 11,
			'section'     => 'theme_skin_side',
			'default'     => '#787878',
		),
		'color_link_menu'                => array(
			'label'       => esc_html__( 'Menu link color', 'aiteko' ),
			'description' => '',
			'priority'    => 12,
			'section'     => 'theme_skin_side',
			'default'     => '#878787',
		),
		'color_link_menu_hover'          => array(
			'label'       => esc_html__( 'Menu link color (mouseover)', 'aiteko' ),
			'description' => '',
			'priority'    => 13,
			'section'     => 'theme_skin_side',
			'default'     => '#dadada',
		),
		'color_link_menu_active'          => array(
			'label'       => esc_html__( 'Menu link color (active)', 'aiteko' ),
			'description' => '',
			'priority'    => 14,
			'section'     => 'theme_skin_side',
			'default'     => '#f4f4f4',
		),
		'small_side_bg'                   => array(
			'label'       => esc_html__( 'Background', 'aiteko' ),
			'description' => '',
			'priority'    => 10,
			'section'     => 'theme_skin_sm_side',
			'default'     => '#ffffff',
		),
		'color_text_small_side'           => array(
			'label'       => esc_html__( 'Text/Icons color', 'aiteko' ),
			'description' => '',
			'priority'    => 11,
			'section'     => 'theme_skin_sm_side',
			'default'     => '#565656',
		),
		'footer_bg'               => array(
			'label'       => esc_html__( 'Footer background', 'aiteko' ),
			'description' => '',
			'priority'    => 10,
			'section'     => 'theme_skin_footer',
			'default'     => '#141414',
		),
		'color_text_footer'       => array(
			'label'       => esc_html__( 'Footer text color', 'aiteko' ),
			'description' => '',
			'priority'    => 11,
			'section'     => 'theme_skin_footer',
			'default'     => '#dadada',
		),
		'color_text_footer_heading'      => array(
			'label'       => esc_html__( 'Footer heading color', 'aiteko' ),
			'description' => '',
			'priority'    => 12,
			'section'     => 'theme_skin_footer',
			'default'     => '#787878',
		),
		'color_link_footer'       => array(
			'label'       => esc_html__( 'Footer link color', 'aiteko' ),
			'description' => '',
			'priority'    => 13,
			'section'     => 'theme_skin_footer',
			'default'     => '#dadada',
		),
		'color_link_footer_hover' => array(
			'label'       => esc_html__( 'Footer link color (mouseover)', 'aiteko' ),
			'description' => '',
			'priority'    => 14,
			'section'     => 'theme_skin_footer',
			'default'     => '#ffffff',
		),
		'preloader_bg'                   => array(
			'label'       => esc_html__( 'Background', 'aiteko' ),
			'description' => '',
			'priority'    => 10,
			'section'     => 'theme_skin_preloader',
			'default'     => '#1a1a1a',
		),
		'preloader_line_bg'           => array(
			'label'       => esc_html__( 'Progress line color', 'aiteko' ),
			'description' => '',
			'priority'    => 11,
			'section'     => 'theme_skin_preloader',
			'default'     => '#454545',
		),
		'color_text_preloader'           => array(
			'label'       => esc_html__( 'Progress percentage text', 'aiteko' ),
			'description' => '',
			'priority'    => 12,
			'section'     => 'theme_skin_preloader',
			'default'     => '#ea3c53',
		),
	);

	return $settings_options;
}

/**
 * Customizer for typography option.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @since 1.0
 */
function aiteko_customizer_theme_customize_typography( $wp_customize ) {
	// Register custom typography settings.
	$wp_customize->add_section(
		'theme_typography',
		array(
			'title'    => esc_html__( 'Typography', 'aiteko' ),
			'priority' => 32,
		)
	);

	// Settings.
	$wp_customize->add_setting(
		'aiteko_heading_font',
		array(
			'default'           => WIP_THEMES_DEFAULT_HEADING_FONT,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_attr',
		)
	);

	$wp_customize->add_setting(
		'aiteko_body_font',
		array(
			'default'           => WIP_THEMES_DEFAULT_BODY_FONT,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_attr',
		)
	);

	// Controls.
	$wp_customize->add_control(
		new Aiteko_Google_Font_Dropdown_Control(
			$wp_customize,
			'aiteko_heading_font',
			array(
				'label'    => esc_html__( 'Select a Font for Heading', 'aiteko' ),
				'section'  => 'theme_typography',
				'priority' => 13,
			)
		)
	);

	$wp_customize->add_control(
		new Aiteko_Google_Font_Dropdown_Control(
			$wp_customize,
			'aiteko_body_font',
			array(
				'label'    => esc_html__( 'Select a Font for Body Text', 'aiteko' ),
				'section'  => 'theme_typography',
				'priority' => 15,
			)
		)
	);

	// Settings.
	$wp_customize->add_setting(
		'body_font_size',
		array(
			'default'           => 17,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_setting(
		'body_line_height',
		array(
			'default'           => 1.65,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_setting(
		'heading_h1',
		array(
			'default'           => 2.75,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_setting(
		'heading_h2',
		array(
			'default'           => 2,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_setting(
		'heading_h3',
		array(
			'default'           => 1.75,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_setting(
		'heading_h4',
		array(
			'default'           => 1.5,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_setting(
		'heading_h5',
		array(
			'default'           => 1.25,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_setting(
		'heading_h6',
		array(
			'default'           => 1,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_html',
		)
	);

	// Controls.
	$wp_customize->add_control(
		new Aiteko_Customizer_Ui_Range(
			$wp_customize,
			'body_font_size',
			array(
				'label'       => esc_html__( 'Base font size', 'aiteko' ),
				'description' => '',
				'input_attrs' => array(
					'min'  => 12,
					'max'  => 24,
					'step' => 1,
				),
				'unit'        => 'px',
				'section'     => 'theme_typography',
				'priority'    => 16,
			)
		)
	);

	$wp_customize->add_control(
		new Aiteko_Customizer_Ui_Range(
			$wp_customize,
			'body_line_height',
			array(
				'label'       => esc_html__( 'Line height (vertical spacing)', 'aiteko' ),
				'description' => '',
				'input_attrs' => array(
					'min'  => 1,
					'max'  => 3,
					'step' => 0.05,
				),
				'unit'        => 'em',
				'section'     => 'theme_typography',
				'priority'    => 17,
			)
		)
	);

	$wp_customize->add_control(
		new Aiteko_Customizer_Ui_Range(
			$wp_customize,
			'heading_h1',
			array(
				'label'       => esc_html__( 'Heading (H1)', 'aiteko' ),
				'description' => '',
				'input_attrs' => array(
					'min'  => 1,
					'max'  => 5,
					'step' => 0.05,
				),
				'unit'        => 'rem',
				'section'     => 'theme_typography',
				'priority'    => 18,
			)
		)
	);

	$wp_customize->add_control(
		new Aiteko_Customizer_Ui_Range(
			$wp_customize,
			'heading_h2',
			array(
				'label'       => esc_html__( 'Heading (H2)', 'aiteko' ),
				'description' => '',
				'input_attrs' => array(
					'min'  => 1,
					'max'  => 5,
					'step' => 0.05,
				),
				'unit'        => 'rem',
				'section'     => 'theme_typography',
				'priority'    => 19,
			)
		)
	);

	$wp_customize->add_control(
		new Aiteko_Customizer_Ui_Range(
			$wp_customize,
			'heading_h3',
			array(
				'label'       => esc_html__( 'Heading (H3)', 'aiteko' ),
				'description' => '',
				'input_attrs' => array(
					'min'  => 1,
					'max'  => 5,
					'step' => 0.05,
				),
				'unit'        => 'rem',
				'section'     => 'theme_typography',
				'priority'    => 20,
			)
		)
	);

	$wp_customize->add_control(
		new Aiteko_Customizer_Ui_Range(
			$wp_customize,
			'heading_h4',
			array(
				'label'       => esc_html__( 'Heading (H4)', 'aiteko' ),
				'description' => '',
				'input_attrs' => array(
					'min'  => 1,
					'max'  => 5,
					'step' => 0.05,
				),
				'unit'        => 'rem',
				'section'     => 'theme_typography',
				'priority'    => 21,
			)
		)
	);

	$wp_customize->add_control(
		new Aiteko_Customizer_Ui_Range(
			$wp_customize,
			'heading_h5',
			array(
				'label'       => esc_html__( 'Heading (H5)', 'aiteko' ),
				'description' => '',
				'input_attrs' => array(
					'min'  => 1,
					'max'  => 5,
					'step' => 0.05,
				),
				'unit'        => 'rem',
				'section'     => 'theme_typography',
				'priority'    => 22,
			)
		)
	);

	$wp_customize->add_control(
		new Aiteko_Customizer_Ui_Range(
			$wp_customize,
			'heading_h6',
			array(
				'label'       => esc_html__( 'Heading (H6)', 'aiteko' ),
				'description' => '',
				'input_attrs' => array(
					'min'  => 0.5,
					'max'  => 5,
					'step' => 0.05,
				),
				'unit'        => 'rem',
				'section'     => 'theme_typography',
				'priority'    => 23,
			)
		)
	);

	if ( ! class_exists( 'Wip_Themes_Core' ) ) {
		return false;
	}

	$wp_customize->selective_refresh->add_partial(
		'aiteko_heading_font',
		array(
			'settings'            => array( 'aiteko_heading_font', 'aiteko_body_font', 'body_font_size', 'body_line_height', 'heading_h1', 'heading_h2', 'heading_h3', 'heading_h4', 'heading_h5', 'heading_h6' ),
			'selector'            => '#aiteko-customizer-custom-css',
			'render_callback'     => 'aiteko_process_customizer_api_color',
			'container_inclusive' => false,
			'fallback_refresh'    => false,
		)
	);
}
add_action( 'customize_register', 'aiteko_customizer_theme_customize_typography' );

/**
 * Add copyright text to site identity section
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function aiteko_customizer_part_customize_copyright( $wp_customize ) {
	$cp_default = '&copy;2019. Aiteko by WIP Themes.';
	$wp_customize->add_setting(
		'copyright_text',
		array(
			'default'           => $cp_default,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'aiteko_theme_customizer_sanitize_textarea',
		)
	);

	$wp_customize->add_control(
		'copyright_text',
		array(
			'type'        => 'textarea',
			'label'       => esc_html__( 'Copyright Text', 'aiteko' ),
			'description' => esc_html__( 'Enter the copyright text.', 'aiteko' ),
			'section'     => 'title_tagline',
			'priority'    => 20,
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'copyright_text',
		array(
			'settings'            => array( 'copyright_text' ),
			'selector'            => '.aiteko--copyright-text',
			'render_callback'     => 'aiteko_customizer_cp_text',
			'container_inclusive' => false,
			'fallback_refresh'    => false,
		)
	);
}
add_action( 'customize_register', 'aiteko_customizer_part_customize_copyright' );

/**
 * Copyright text render callback.
 */
function aiteko_customizer_cp_text() {
	return aiteko_print_copyright_text();
}

/**
 * Render callback function for skin
 *
 * @since 1.0
 */
function aiteko_process_customizer_api_color() {
	if ( class_exists( 'Wip_Themes_Core' ) ) {
		$module = new Aiteko_Skin_Loader();
		print wp_kses( $module->get_compiled_css(), array( "\'", '\"' ) );
	}
}

/**
 * Sanitize callback
 *
 * @param string $value from customizer.
 * @return string
 */
function aiteko_theme_customizer_partial_no_sanitize( $value ) {
	return esc_html( $value );
}

/**
 * Get the first post link
 *
 * @return int post id || bool when failure
 */
function aiteko_customizer_get_first_post_link() {
	$lastposts = get_posts(
		array(
			'posts_per_page' => 1,
		)
	);

	if ( ! empty( $lastposts ) ) {
		$the_id = $lastposts[0]->ID;
		return get_permalink( $the_id );
	}

	return false;
}

if ( class_exists( 'WP_Customize_Control' ) ) :
	/**
	 * Custom UI toggle
	 *
	 * @since 1.0
	 */
	class Aiteko_Customizer_Ui_Toggle extends WP_Customize_Control {
		/**
		 * Ui type
		 *
		 * @var string
		 * @since 1.0
		 */
		public $type = 'wip_themes_ui_toggle';

		/**
		 * Class constructor
		 *
		 * @param object $manager WP_Customize_Control.
		 * @param mixed  $id      WP_Customize_Control.
		 * @param array  $args    WP_Customize_Control.
		 * @param array  $options WP_Customize_Control.
		 * @return void
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
		}

		/**
		 * Render the control's content.
		 */
		public function render_content() {
			?>
			<label class="wipThemes_ui_toggle_parent">
				<input type="checkbox" value="on" <?php $this->link(); ?> <?php checked( $this->value() ); ?> />
				<span class="wipThemes_ui_toggle">
					<strong><?php echo esc_html( $this->label ); ?></strong>
				</span>
				<?php if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>
			</label>

			<?php
		}
	}

	/**
	 * Custom UI Range
	 *
	 * @since 1.0
	 */
	class Aiteko_Customizer_Ui_Range extends WP_Customize_Control {
		/**
		 * Ui type
		 *
		 * @var string
		 * @since 1.0
		 */
		public $type = 'wip_themes_ui_range';

		/**
		 * Ui unit
		 *
		 * @var string
		 * @since 1.0
		 */
		public $unit = '';

		/**
		 * Class constructor
		 *
		 * @param object $manager WP_Customize_Control.
		 * @param mixed  $id      WP_Customize_Control.
		 * @param array  $args    WP_Customize_Control.
		 * @param array  $options WP_Customize_Control.
		 * @return void
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
		}

		/**
		 * Render the control's content.
		 */
		public function render_content() {
			?>
			<label class="wipThemes_ui_range_parent" data-unit="<?php echo esc_attr( $this->unit ); ?>">
				<?php echo esc_html( $this->label ); ?>
				<br/>
				<input type="range" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> <?php $this->input_attrs(); ?> />
				<input type="text" value="<?php echo esc_attr( $this->value() ); ?> <?php echo esc_attr( $this->unit ); ?>" readonly />
				<?php if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>
			</label>

			<?php
		}
	}

	/**
	 * Custom UI Radio image
	 *
	 * @since 1.0
	 */
	class Aiteko_Customizer_Ui_Radio_Image extends WP_Customize_Control {
		/**
		 * Ui type
		 *
		 * @var string
		 * @since 1.0
		 */
		public $type = 'wip_themes_ui_radio_image';

		/**
		 * Class constructor
		 *
		 * @param object $manager WP_Customize_Control.
		 * @param mixed  $id      WP_Customize_Control.
		 * @param array  $args    WP_Customize_Control.
		 * @param array  $options WP_Customize_Control.
		 * @return void
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
		}

		/**
		 * Render the control's content.
		 */
		public function render_content() {
			if ( empty( $this->choices ) ) {
				return;
			}

			$name = '_customize-radio-' . $this->id;

			if ( ! empty( $this->label ) ) :
				?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php
			endif;
			if ( ! empty( $this->description ) ) :
				?>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>
				<span class="wipThemes_ui_toggle_radio_parent">
			<?php
			foreach ( $this->choices as $value => $label ) :
				?>
				<label class="wipThemes_ui_toggle_radio">
					<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); ?> <?php checked( $this->value(), $value ); ?> />
					<?php echo '<img src="' . esc_url( $label ) . '" />'; ?>
				</label>
				<?php
			endforeach;
			?>
				</span>
			<?php
		}
	}

	/**
	 * Custom UI Refresher
	 *
	 * @since 1.0
	 */
	class Aiteko_Customizer_Ui_Refresher extends WP_Customize_Control {
		/**
		 * Ui type
		 *
		 * @var string
		 * @since 1.0
		 */
		public $type = 'wip_themes_ui_refresher';

		/**
		 * Class constructor
		 *
		 * @param object $manager WP_Customize_Control.
		 * @param mixed  $id      WP_Customize_Control.
		 * @param array  $args    WP_Customize_Control.
		 * @param array  $options WP_Customize_Control.
		 * @return void
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
		}

		/**
		 * Render the control's content.
		 */
		public function render_content() {
			?>
			<label class="wipThemes_ui_refresher_parent">
				<input type="checkbox" value="on" <?php $this->link(); ?> <?php checked( $this->value() ); ?> />
				<span class="wipThemes_ui_refresher">
					<?php echo esc_html( $this->label ); ?>
				</span>
				<?php if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>
			</label>

			<?php
		}
	}

	/**
	 * Google fonts select dropdowns
	 *
	 * @since 1.0
	 */
	class Aiteko_Google_Font_Dropdown_Control extends WP_Customize_Control {
		/**
		 * Ui type
		 *
		 * @var string
		 * @since 1.0
		 */
		public $type = 'google_fonts_dropdown';

		/**
		 * Fonts data
		 *
		 * @var bool
		 * @since 1.0
		 */
		private $fonts = false;

		/**
		 * Class constructor
		 *
		 * @param object $manager WP_Customize_Control.
		 * @param mixed  $id      WP_Customize_Control.
		 * @param array  $args    WP_Customize_Control.
		 * @param array  $options WP_Customize_Control.
		 * @return void
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			$this->fonts = aiteko_get_google_fonts_data();
			parent::__construct( $manager, $id, $args );
		}

		/**
		 * Render the content.
		 */
		public function render_content() {
			if ( $this->fonts && ! empty( $this->fonts ) ) {
				?>
			<label>
				<span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
			</label>
			<div class="wipThemes-font-ui">
				<select data-live-search="true" <?php $this->link(); ?>>
				<?php
				foreach ( $this->fonts as $k => $v ) {
					$variants = $v->variants;
					$variant  = array();
					foreach ( $variants as $vrs ) {
						$vrs = str_replace( 'italic', 'i', $vrs );
						if ( 'regular' === $vrs ) {
							$vrs = '400';
						} elseif ( 'i' === $vrs ) {
							$vrs = '400i';
						}
						$variant[] = $vrs;
					}
					unset( $vrs );
					$variant = implode( ',', $variant );
					$vll     = str_replace( ' ', '+', $v->family ) . ':' . $variant;
					printf( '<option value="%s" %s>%s</option>', esc_attr( $vll ), selected( $this->value(), $vll, false ), esc_html( $v->family ) );
				}
				?>
				</select>
			</div>
				<?php
			} else {
				// we need our core plugin to activate the google font feature.
				print esc_html__( 'Please activate the "WIP-Themes Core" plugin.', 'aiteko' );
			}
		}
	}
endif;

/**
 * Load dynamic logic for the customizer controls area.
 */
function aiteko_customizer_panels_js() {
	wp_enqueue_script( 'bootstrap-js', get_theme_file_uri( '/assets/js/bootstrap.min.js' ), array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'bootstrap-select-js', get_theme_file_uri( '/assets/js/bootstrap-select.min.js' ), array( 'jquery', 'bootstrap-js' ), '1.12.2', true );
	wp_enqueue_script( 'aiteko-customize-controls', get_theme_file_uri( '/assets/js/customize-controls.js' ), array( 'bootstrap-select-js' ), filemtime( get_parent_theme_file_path( '/assets/js/customize-controls.js' ) ), true );
	wp_enqueue_style( 'aiteko-customize-controls', get_theme_file_uri( '/assets/css/customize-controls.css' ), array(), filemtime( get_parent_theme_file_path( '/assets/css/customize-controls.css' ) ), 'all' );
}
add_action( 'customize_controls_enqueue_scripts', 'aiteko_customizer_panels_js' );

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function aiteko_customizer_customize_preview_js() {
	wp_enqueue_script( 'aiteko-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), filemtime( get_parent_theme_file_path( '/assets/js/customize-preview.js' ) ), true );
	wp_localize_script(
		'aiteko-customize-preview',
		'cecuz',
		array(
			'postlink' => esc_js( aiteko_customizer_get_first_post_link() ),
			'homeurl'  => esc_js( home_url( '/' ) ),
		)
	);
}
add_action( 'customize_preview_init', 'aiteko_customizer_customize_preview_js' );

/**
 * Sanitize callback
 *
 * @param string $value from customizer.
 * @return string
 */
function aiteko_theme_customizer_sanitize_textarea( $value ) {
	$allowed = array(
		'a' => array(
			'href'   => array(),
			'target' => array(),
			'title'  => array()
		),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
	);
	return wp_kses( $value, $allowed );
}
