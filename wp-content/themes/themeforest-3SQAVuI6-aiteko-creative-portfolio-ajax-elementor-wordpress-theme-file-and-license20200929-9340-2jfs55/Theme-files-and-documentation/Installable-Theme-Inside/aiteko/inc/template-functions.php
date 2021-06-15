<?php
/**
 * Adds helper functions
 *
 * @package Aiteko
 * @since 1.0
 */

/**
 * Register custom fonts
 * credit to twentyseventeen theme code
 *
 * @since 1.0
 */
function aiteko_font_families() {
	$heading_font = get_theme_mod( 'aiteko_heading_font', WIP_THEMES_DEFAULT_HEADING_FONT );
	$body_font    = get_theme_mod( 'aiteko_body_font', WIP_THEMES_DEFAULT_BODY_FONT );

	$font_families = array( $heading_font, $body_font );
	$font_families = array_unique( $font_families );
	$query_args    = array(
		'family' => implode( '|', $font_families ),
		'subset' => 'latin,latin-ext',
	);
	$fonts_url     = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	return esc_url_raw( $fonts_url );
}

/**
 * Get social icons
 *
 * @since 1.0.0
 */
function aiteko_get_site_social_icons() {
	if ( ( get_theme_mod( 'enable_site_social' ) && '' !== get_theme_mod( 'enable_site_social' ) ) ||  is_customize_preview() ) {
		$links = aiteko_get_active_social_links();

		if ( '' === $links ) {
			return false;
		}

		$kses_defaults = wp_kses_allowed_html( 'post' );
		$svg_args      = array(
			'svg'   => array(
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true, // <= Must be lower case!
			),
			'g'     => array( 'fill' => true ),
			'title' => array( 'title' => true ),
			'path'  => array(
				'd'    => true,
				'fill' => true,
			),
			'ellipse' => array(
				'transform' => true,
				'cx'        => true,
				'cy'        => true,
				'rx'        => true,
				'ry'        => true,
			),
			'li' => array(
				'id' => true,
				'class' => true,
				'style' => array('display' => true ),
			),
		);
		$allowed_tags  = array_merge( $kses_defaults, $svg_args );

		$custStyle = '';
		if ( is_customize_preview() ) {
			$custStyle = ' style="display:none;"';
			if ( get_theme_mod( 'enable_site_social' ) && '' !== get_theme_mod( 'enable_site_social' ) ) {
				$custStyle = ' style=""';
			}
		}

		?>
			<button class="aiteko-social__button" type="button"<?php print wp_kses( $custStyle, array( "\'", '\"' ) ); ?>>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M201.1 361.2l-67.8 48.9c-3.7 3.6-5.2 9.1-5.3 13.9-.1 4.8 1.2 8.8 4.7 12.5 3.6 3.9 8.8 6.2 13.6 6.2 4.5 0 12.5-4.9 16-8.4l69.7-51.6c3.6-3.5 5.7-8.4 5.7-13.5l9.1-52.5-45.7-46.7v91.2z"/><ellipse transform="rotate(-80.781 274.673 69.329)" cx="274.7" cy="69.3" rx="37.3" ry="37.3"/><path d="M350.7 459.2l-15.2-117.4c-.5-3.5-1.9-6.8-4.2-9.5l-57-68.8V143.9c0-11.3-6.3-15.9-18.3-15.9h-37c-2.8 0-5.2 1-7.7 2.3l-68 31.7c-10 5.3-15.3 15.4-15.3 28.7V256c0 10.3 8.2 18.7 18.3 18.7 10.1 0 18.3-8.4 18.3-18.7v-58.2c0-3 1.7-5.8 4.4-7.1l32.2-16.4v75.3c0 4.2 1.6 8.2 4.6 11.2l92.4 94.4c1.2 1.2 2 2.8 2.2 4.5l14.2 104.7c1.3 9.3 9.1 15.7 18.1 15.7h2c9.9-1.5 17.4-10.7 16-20.9z"/><path d="M378.4 232.4l-95-96.2v52.6l69.2 70.1c7.2 7.3 18.7 7.2 25.9-.1 3.5-3.6 5.5-7.5 5.5-12.2 0-4.8-2-10.5-5.6-14.2z"/></svg>
			</button>
			<div class="aiteko-social--list-wrap"<?php print wp_kses( $custStyle, array( "\'", '\"' ) ); ?>>
				<ul class="aiteko-social--list">
					<?php print wp_kses( $links, $allowed_tags ); ?>
				</ul>
			</div>
		<?php
	}
}

/**
 * Get active social links and icons
 * based on user settings
 *
 * @since 1.0
 */
function aiteko_get_active_social_links() {
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

	$output = '';
	foreach ( $settings as $social ) {
		$link = get_theme_mod( $social, '' );

		if ( is_customize_preview() ) {
			$hideit = ( '' === trim( $link ) ? ' hide-me' : '' );
			
			$output .= '<li class="' . esc_attr( $social ) . esc_attr( $hideit ) . '"><a href="' . esc_url( $link ) . '">' . aiteko_get_social_icon_svg( str_replace( 'social_', '', $social ), 20 ) . '</a></li>';
		} else {
			if ( trim( $link ) !== '' ) {
				$output .= '<li class="' . esc_attr( $social ) . '"><a href="' . esc_url( $link ) . '">' . aiteko_get_social_icon_svg( str_replace( 'social_', '', $social ), 20 ) . '</a></li>';
			}
		}
	}

	if ( $output ) {
		$before = '<li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M201.1 361.2l-67.8 48.9c-3.7 3.6-5.2 9.1-5.3 13.9-.1 4.8 1.2 8.8 4.7 12.5 3.6 3.9 8.8 6.2 13.6 6.2 4.5 0 12.5-4.9 16-8.4l69.7-51.6c3.6-3.5 5.7-8.4 5.7-13.5l9.1-52.5-45.7-46.7v91.2z"/><ellipse transform="rotate(-80.781 274.673 69.329)" cx="274.7" cy="69.3" rx="37.3" ry="37.3"/><path d="M350.7 459.2l-15.2-117.4c-.5-3.5-1.9-6.8-4.2-9.5l-57-68.8V143.9c0-11.3-6.3-15.9-18.3-15.9h-37c-2.8 0-5.2 1-7.7 2.3l-68 31.7c-10 5.3-15.3 15.4-15.3 28.7V256c0 10.3 8.2 18.7 18.3 18.7 10.1 0 18.3-8.4 18.3-18.7v-58.2c0-3 1.7-5.8 4.4-7.1l32.2-16.4v75.3c0 4.2 1.6 8.2 4.6 11.2l92.4 94.4c1.2 1.2 2 2.8 2.2 4.5l14.2 104.7c1.3 9.3 9.1 15.7 18.1 15.7h2c9.9-1.5 17.4-10.7 16-20.9z"/><path d="M378.4 232.4l-95-96.2v52.6l69.2 70.1c7.2 7.3 18.7 7.2 25.9-.1 3.5-3.6 5.5-7.5 5.5-12.2 0-4.8-2-10.5-5.6-14.2z"/></svg></li>';
		$before .= '<li><span></span></li>';
		$output = $before . $output;
	}

	return $output;
}

/**
 * Set the elementor global settings
 *
 * @return void
 */
function aiteko_set_elementor_globals() {
	if ( did_action( 'elementor/loaded' ) ) {
		// 1. stretched section.
		update_option( 'elementor_stretched_section_container', '.aiteko-main' );
		// 2. page title selector.
		update_option( 'elementor_page_title_selector', 'header.entry-page-header' );
		// 3. Tablet break point.
		update_option( 'elementor_viewport_lg', '992' );
		// 4. Space between widgets.
		update_option( 'elementor_space_between_widgets', '30' );
	}
}

/**
 * Gets the SVG code for a given icon.
 *
 * @param string $icon The icon name.
 * @param int    $size The desired size.
 * @return string
 */
function aiteko_get_icon_svg( $icon, $size = 24 ) {
	return Aiteko_SVG_Icons::get_svg( 'ui', $icon, $size );
}

/**
 * Gets the SVG code for a given social icon.
 *
 * @param string $icon The icon name.
 * @param int    $size The desired size.
 * @return string
 */
function aiteko_get_social_icon_svg( $icon, $size = 24 ) {
	return Aiteko_SVG_Icons::get_svg( 'social', $icon, $size );
}

/**
 * Detects the social network from a URL and returns the SVG code for its icon.
 *
 * @param string $uri  URL.
 * @param int    $size The desired size.
 * @return string
 */
function aiteko_get_social_link_svg( $uri, $size = 24 ) {
	return Aiteko_SVG_Icons::get_social_link_svg( $uri, $size );
}

/**
 * Get google font lists
 *
 * @since 1.0
 */
function aiteko_get_google_fonts_data() {
	if ( ! class_exists( 'Wip_Themes_Core' ) ) {
		return false;
	}

	$fonts = wip_themes_core_get_google_fonts( 'all' );
	return $fonts;
}

/**
 * Load the skin css file
 *
 * @return void
 */
function aiteko_get_custom_skin_css() {
	$def = esc_url( get_theme_file_uri( '/assets/css/default-skin.css' ) );
	$ver = filemtime( get_parent_theme_file_path( '/assets/css/default-skin.css' ) );
	if ( ! class_exists( 'Wip_Themes_Core' ) ) {
		wp_enqueue_style( 'aiteko-skin', $def, array(), $ver );
		return false;
	}

	$module = new Aiteko_Skin_Loader();
	// System failed to write css, recorded.
	if ( get_theme_mod( 'aiteko-failed-write-css' ) === 'yes' ) {	

		if ( $module->set_status() ) {
			
			$custom_inline_skin = get_theme_mod( 'aiteko_custom_skin_code' );

			if ( $custom_inline_skin && '' !== $custom_inline_skin ) {
				wp_add_inline_style( 'aiteko-global', $custom_inline_skin );
			} else {
				wp_enqueue_style( 'aiteko-skin', $def, array(), $ver );
			}

		} else {
			// Custom skin not active, get typography skin.
			wp_enqueue_style( 'aiteko-skin', $def, array(), $ver );

			$typograph = get_theme_mod( 'aiteko_typography_skin_code' );
			if ( $typograph && '' !== $typograph ) {
				wp_add_inline_style( 'aiteko-skin', $typograph );
			}			
		}
	} else {

		if ( $module->set_status() ) {
			$css_version = get_theme_mod( 'aiteko-custom-css-version' );
			$css_url     = $module->get_css_url();

			if ( $css_version &&  '' !== $css_version ) {
				wp_enqueue_style( 'aiteko-skin', esc_url( $css_url . '/aiteko-custom-skin.css' ), array( 'aiteko-global' ), $css_version );
			} else {
				wp_enqueue_style( 'aiteko-skin', $def, array(), $ver );
			}
		} else {
			wp_enqueue_style( 'aiteko-skin', $def, array(), $ver );
		}
	}
}

/**
 * The tricky theme requirements, font and style need 100% same (or close) with front-end
 * we will update the editor-style.css everytime user change the font and skin in customizer
 * need the core plugin to activate
 *
 * @since 1.0
 */
function aiteko_write_editor_style_css() {
	$cache_time_db = get_theme_mod( 'aiteko_editor_cache_action', false );

	// plugin is not active?
	// well, sorry - we leave the current editor style.
	if ( ! class_exists( 'Wip_Themes_Core' ) ) {
		return false;
	}

	// no updates? stop here.
	if ( $cache_time_db ) {
		return false;
	}

	$module = new Aiteko_Skin_Loader();
	$css    = $module->get_compiled_editor_style_css();
	wip_themes_core_write_to_file( get_parent_theme_file_path( '/assets/css/editor-style.css' ), $css );

	// lock it, prevent any looping action.
	set_theme_mod( 'aiteko_editor_cache_action', intval( time() ) );
}
add_action( 'admin_init', 'aiteko_write_editor_style_css' );

function aiteko_use_awesome_ajax_checker() {
	$ajax_enable = get_theme_mod( 'enabled_ajax', true );
	if ( empty( $ajax_enable ) ) {
		return false;
	}

	return true;
}

/**
 * Detect ajax setting
 *
 * @since 1.1.0
 */
function aiteko_use_awesome_ajax() {
	if ( aiteko_use_awesome_ajax_checker() ) {
		print 'aiteko-ajax-enabled';
	}
}

function aiteko_preloader_is_active() {
	if ( empty( get_theme_mod( 'enable_preloader', 'yes' ) ) ) {
		return false;
	}

	return true;
}

function get_single_page_featured_image( $id ) {
	global $post;

	if ( has_post_thumbnail( $id ) ) {
		$featured_img_url = get_the_post_thumbnail_url( $id, 'full' );
		if ( $featured_img_url ) {
			print '<div class="header-featured-background" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -99;background-image: url('. esc_url($featured_img_url) .'); background-position: center center; background-repeat: no-repeat: background-attachment: scroll; background-size: cover;"><div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0, .46);"></div></div>';
		}
	}
}

function aiteko_print_copyright_text() {
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
	return wp_kses( get_theme_mod( 'copyright_text', '&copy;2019. Aiteko by WIP Themes.' ), $allowed );
}