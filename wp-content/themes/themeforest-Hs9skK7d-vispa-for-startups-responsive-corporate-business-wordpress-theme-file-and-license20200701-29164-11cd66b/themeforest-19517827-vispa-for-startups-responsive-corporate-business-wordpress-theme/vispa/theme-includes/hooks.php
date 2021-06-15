<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

/**
 * Filters and Actions
 */

if ( ! function_exists( '_vispa_action_theme_setup' ) ) :
	/**
	 * Theme setup.
	 *
	 * Set up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support post thumbnails.
	 * @internal
	 */
	function _vispa_action_theme_setup() {
		/*
		 * Make Theme available for translation.
		 */
		load_theme_textdomain( 'vispa', get_template_directory() . '/languages' );

		// This theme styles the visual editor to resemble the theme style.
		add_editor_style( array( 'css/editor-style.css', vispa_theme_font_url() ) );

		// Add RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );

		// Enable support for Post Thumbnails, and declare two sizes.

		set_post_thumbnail_size( 592, 372, true );
		//add_image_size( 'fw-theme-full-width', 1038, 576, true );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		) );

		// Add support for featured content.
		add_theme_support( 'featured-content', array(
			'featured_content_filter' => 'vispa_theme_get_featured_posts',
			'max_posts'               => 6,
		) );

		// This theme uses its own gallery styles.
		add_filter( 'use_default_gallery_style', '__return_false' );

		add_theme_support( 'post-thumbnails', array( 'post', 'fw-portfolio', 'product' ) );

		add_theme_support( "title-tag" );

		// declare some globals variables
		global $google_fonts_list;
		$google_fonts_list = array();
	}
endif;
add_action( 'after_setup_theme', '_vispa_action_theme_setup' );


if ( ! function_exists( '_vispa_action_theme_content_width' ) ) :
	/**
	 * Adjust content_width value for image attachment template.
	 * @internal
	 */
	function _vispa_action_theme_content_width() {
		if ( is_attachment() && wp_attachment_is_image() ) {
			$GLOBALS['content_width'] = 810;
		}
	}
endif;
add_action( 'template_redirect', '_vispa_action_theme_content_width' );


if ( ! function_exists( 'vispa_theme_action_functions' ) ) :
	function vispa_theme_action_functions(){
		the_post_thumbnail();
	}
endif;


if ( ! function_exists( '_vispa_filter_theme_post_classes' ) ) :
	/**
	 * Extend the default WordPress post classes.
	 *
	 * Adds a post class to denote:
	 * Non-password protected page with a post thumbnail.
	 *
	 * @param array $classes A list of existing post class values.
	 *
	 * @return array The filtered post class list.
	 * @internal
	 */
	function _vispa_filter_theme_post_classes( $classes ) {
		if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
			$classes[] = 'has-post-thumbnail';
		}

		return $classes;
	}
endif;
add_filter( 'post_class', '_vispa_filter_theme_post_classes' );


if ( ! function_exists( '_vispa_filter_theme_wp_title' ) ) :
	/**
	 * Create a nicely formatted and more specific title element text for output
	 * in head of document, based on current view.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 *
	 * @return string The filtered title.
	 * @internal
	 */
	function _vispa_filter_theme_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() ) {
			return $title;
		}

		// Add the site name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title = "$title $sep $site_description";
		}

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 ) {
			$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'vispa' ), max( $paged, $page ) );
		}

		return $title;
	}
endif;
add_filter( 'wp_title', '_vispa_filter_theme_wp_title', 10, 2 );


if ( ! function_exists( '_vispa_filter_remove_taxonomy_from_sidebars' ) ) :
	/**
	 * remove sidebars for portfolio taxonomy
	 */
	function _vispa_filter_remove_taxonomy_from_sidebars( $taxonomy_list ) {
		unset( $taxonomy_list['fw-portfolio-category'] );

		return $taxonomy_list;
	}
endif;
add_filter( 'fw_ext_sidebars_taxonomies', '_vispa_filter_remove_taxonomy_from_sidebars' );


if ( ! function_exists( '_vispa_filter_remove_post_type_from_sidebars' ) ) :
	function _vispa_filter_remove_post_type_from_sidebars( $post_types_list ) {
		//unset($post_types_list['fw-portfolio']);
		return $post_types_list;
	}
endif;
//add_filter( 'fw_ext_sidebars_post_types', '_vispa_filter_remove_post_type_from_sidebars' );


if ( ! function_exists( '_vispa_filter_add_span_cat_count' ) ) :
	function _vispa_filter_add_span_cat_count( $links ) {
		$links = str_replace( '</a> (', '<span>(', $links );
		$links = str_replace( ')', ')</span></a></li>', $links );

		return $links;
	}
endif;
add_filter( 'wp_list_categories', '_vispa_filter_add_span_cat_count' );


if ( ! function_exists( '_vispa_filter_archive_link' ) ) :
	function _vispa_filter_archive_link( $url ) {
		$url = str_replace( '</a>&nbsp;(', '<span>(', $url );
		$url = str_replace( ')</li>', ')</span></a></li>', $url );

		return $url;
	}
endif;
add_filter( 'get_archives_link', '_vispa_filter_archive_link', 99 );


if ( ! function_exists( '_vispa_action_theme_count_post_visits' ) ) :
	/**
	 * Count posts visits
	 */
	function _vispa_action_theme_count_post_visits() {
		if ( ! is_single() ) {
			return;
		}
		global $post;
		$views = get_post_meta( $post->ID, 'fw_post_views', true );
		$views = intval( $views );
		update_post_meta( $post->ID, 'fw_post_views', ++ $views );
	}
endif;
add_action( 'wp_head', '_vispa_action_theme_count_post_visits' );


if ( ! function_exists( '_vispa_action_theme_footer_widgets_init' ) ) :
	/**
	 * Register widget areas
	 * @internal
	 */
	function _vispa_action_theme_footer_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'General Widget', 'vispa' ),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );


		$beforeWidget = '<div id="%1$s" class="widget %2$s">';
		$afterWidget  = '</div>';
		$beforeTitle  = '<h4 class="widget-title">';
		$afterTitle   = '</h4>';

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Column 1', 'vispa' ),
			'id'            => 'footer-1',
			'before_widget' => $beforeWidget,
			'after_widget'  => $afterWidget,
			'before_title'  => $beforeTitle,
			'after_title'   => $afterTitle,
			'description'   => ''
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Column 2', 'vispa' ),
			'id'            => 'footer-2',
			'before_widget' => $beforeWidget,
			'after_widget'  => $afterWidget,
			'before_title'  => $beforeTitle,
			'after_title'   => $afterTitle,
			'description'   => ''
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Column 3', 'vispa' ),
			'id'            => 'footer-3',
			'before_widget' => $beforeWidget,
			'after_widget'  => $afterWidget,
			'before_title'  => $beforeTitle,
			'after_title'   => $afterTitle,
			'description'   => ''
		) );
	}
endif;
add_action( 'widgets_init', '_vispa_action_theme_footer_widgets_init' );


if ( ! function_exists( '_vispa_filter_active_slider' ) ) :
	/**
	 * Filter for disable framework sliders
	 *
	 * @param array $sliders
	 */
	function _vispa_filter_active_slider( $sliders ) {
		$sliders = array_diff( $sliders, array( 'nivo-slider', 'bx-slider', 'owl-carousel' ) );

		return $sliders;
	}
	add_filter( 'fw_ext_slider_activated', '_vispa_filter_active_slider' );
endif;


if ( ! function_exists( '_vispa_filter_theme_change_submenu_class' ) ) :
	function _vispa_filter_theme_change_submenu_class( $menu ) {
		$menu = preg_replace( '/ class="sub-menu"/', ' class="child" ', $menu );

		return $menu;
	}
endif;
add_filter( 'wp_nav_menu', '_vispa_filter_theme_change_submenu_class' );


if ( ! function_exists( '_vispa_action_print_fonts' ) ) :
	/**
	 * print theme general fonts
	 */
	function _vispa_action_print_fonts() {
		if ( defined( 'FW' ) ) {
			$styling        = '';
			$primary_font   = fw_get_db_settings_option( 'font1' );
			$secondary_font = fw_get_db_settings_option( 'font2' );
			$h1_font        = fw_get_db_settings_option( 'h1_font' );
			$h2_font        = fw_get_db_settings_option( 'h2_font' );
			$h3_font        = fw_get_db_settings_option( 'h3_font' );
			$h4_font        = fw_get_db_settings_option( 'h4_font' );
			$h5_font        = fw_get_db_settings_option( 'h5_font' );
			$h6_font        = fw_get_db_settings_option( 'h6_font' );

			// get primary font
			if ( isset( $primary_font['font1'] ) && $primary_font['font1'] == 'yes' ) {
				$font1 = vispa_get_shortcode_advanced_styles( $primary_font['yes']['general_font_family'] );
				$styling .= 'body, p, label, .btn, .form-control, .title h5, .navbar, .brand, .btn-simple, a, .td-name, td, small, .media h5, .subtitle, .title-modern, .title-modern a, .card-blog .card-category, .card-blog .card-date, .client-logo h3, .section-numbers .number, .section-numbers-2 .number, .section-numbers-3 .number {' . $font1 . '}' . "\n";
			}

			// ger secondary font
			if ( isset( $secondary_font['font2'] ) && $secondary_font['font2'] == 'yes' ) {
				$font2 = vispa_get_shortcode_advanced_styles( $secondary_font['yes']['general_font_family'] );
				$styling .= 'h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6, .content-blog p, h1 a, .h1 a, h2 a, .h2 a, h3 a, .h3 a, h4 a, .h4 a, h5 a, .h5 a, h6 a, .h6 a, .content-blog p a, .section-numbers-2 .card h5, .section-numbers-3 .card h5, .portfolio-filter a, .project-info .item > strong, .form-group label, .form-login .checkbox, .form-login .submit, .form-login .forgot, .nav-menu li a.menu-link, .tab-header a, .panel-title, .post-meta > *, .comments .title, .comment-author, .pagination > li > a, .pagination > li > span, .widget-title, .widget_calendar table, .team-member .name, .widget-skills .skill .skill-info, #swipebox-top-bar, .comments .comment-reply-title, .widget_rss .widget-title .rsswidget, .screen-reader-text {' . $font2 . '}' . "\n";
			}

			// get h1 font
			if ( isset( $h1_font['h1_font'] ) && $h1_font['h1_font'] == 'yes' ) {
				$h1_style = vispa_get_shortcode_advanced_styles( $h1_font['yes']['h1_font'] );
				$styling .= 'h1, .h1 {' . $h1_style . '}' . "\n";
			}
			// get h2 font
			if ( isset( $h2_font['h2_font'] ) && $h2_font['h2_font'] == 'yes' ) {
				$h2_style = vispa_get_shortcode_advanced_styles( $h2_font['yes']['h2_font'] );
				$styling .= 'h2, .h2 {' . $h2_style . '}' . "\n";
			}
			// get h3 font
			if ( isset( $h3_font['h3_font'] ) && $h3_font['h3_font'] == 'yes' ) {
				$h3_style = vispa_get_shortcode_advanced_styles( $h3_font['yes']['h3_font'] );
				$styling .= 'h3, .h3 {' . $h3_style . '}' . "\n";
			}
			// get h4 font
			if ( isset( $h4_font['h4_font'] ) && $h4_font['h4_font'] == 'yes' ) {
				$h4_style = vispa_get_shortcode_advanced_styles( $h4_font['yes']['h4_font'] );
				$styling .= 'h4, .h4 {' . $h4_style . '}' . "\n";
			}
			// get h5 font
			if ( isset( $h5_font['h5_font'] ) && $h5_font['h5_font'] == 'yes' ) {
				$h5_style = vispa_get_shortcode_advanced_styles( $h5_font['yes']['h5_font'] );
				$styling .= 'h5, .h5 {' . $h5_style . '}' . "\n";
			}
			// get h6 font
			if ( isset( $h6_font['h6_font'] ) && $h6_font['h6_font'] == 'yes' ) {
				$h6_style = vispa_get_shortcode_advanced_styles( $h6_font['yes']['h6_font'] );
				$styling .= 'h6, .h6 {' . $h6_style . '}' . "\n";
			}

			// include after parent style if is child theme active
			$file_style = is_child_theme() ? 'parent-style' : 'style';
			if( !empty($styling) ) {
				wp_add_inline_style( $file_style, $styling );
			}
		}
	}
endif;
add_action('wp_enqueue_scripts', '_vispa_action_print_fonts', 998);


if ( ! function_exists( '_vispa_action_theme_print_google_fonts_link' ) ) :
	/**
	 * Print google fonts link
	 */
	function _vispa_action_theme_print_google_fonts_link() {
		global $google_fonts_list;

		$fw_theme_google_fonts_list = array(
			'Open Sans' => array(
				'variation' => array(
					'300' => '400',
					'300italic' => '400italic',
					'400' => '400',
					'400italic' => '400italic',
					'600' => '700',
					'600italic' => '700italic',
					'700' => '700',
					'700italic' => '700italic',
				),
				'subset' => array(
					'latin' => 'latin'
				),
			),
			'Poppins' => array(
				'variation' => array(
					'300' => '300',
					'400' => '400',
					'500' => '500',
					'600' => '600',
					'700' => '700',
				),
				'subset' => array(
					'latin' => 'latin'
				),
			),
		);

		// merge recursive with general google fonts
		$fw_theme_google_fonts_list = vispa_theme_array_merge_recursive($fw_theme_google_fonts_list, $google_fonts_list);

		wp_register_style( 'fw-googleFonts', vispa_theme_get_remote_fonts( $fw_theme_google_fonts_list ) );
		wp_enqueue_style( 'fw-googleFonts' );
	}
endif;
add_action( 'wp_enqueue_scripts', '_vispa_action_theme_print_google_fonts_link', 999 );


if ( ! function_exists( '_vispa_filter_mime_types' ) ) :
	function _vispa_filter_mime_types( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}
endif;
add_filter( 'upload_mimes', '_vispa_filter_mime_types' );


if ( ! function_exists( '_vispa_change_site_color' ) ) :
	function _vispa_change_site_color() {
		if ( ! defined( 'FW' ) ) {
			return;
		}

		$color = fw_get_db_settings_option( 'site_color', '' );
		$css   = '';

		// color from get parameter
		if( isset($_GET['color']) ) {
			$color = '#'.strip_tags( $_GET['color'] );
		}

		if ( ! empty( $color ) ) {
			// color
			$css .= '.title-modern a:hover,
	.title-modern a:active,
	.separator-danger,
	.btn-danger,
	.navbar .navbar-nav > li > a.btn-danger,
	.has-error .form-control,
	.has-error .form-control:focus,
	.has-error .form-control-feedback,
	.has-error .form-control:focus + .input-group-addon,
	.dropdown-menu.dropdown-danger > li > a:hover,
	.dropdown-menu.dropdown-danger > li > a:focus,
	.card-blog .card-title:hover,
	.card-blog .card-title:active,
	.list-logos-danger .active .client-logo,
	.color-red,
	.link-red,
	.link-yellow:hover,
	.link-orange:hover,
	.link-red:hover,
	.link-purple:hover,
	.link-blue:hover,
	.link-green:hover,
	.link-brown:hover,
	.link-yellow:active,
	.link-orange:active,
	.link-red:active,
	.link-purple:active,
	.link-blue:active,
	.link-green:active,
	.link-brown:active,
	.form-group.required label:after,
	.form-search .form-control:focus + .submit:hover,
	.widget_mc4wp_form_widget .form-control:focus + .submit:hover,
	.form-search .form-control:focus + .submit:active,
	.widget_mc4wp_form_widget .form-control:focus + .submit:active,
	.form-login .submit:hover,
	.form-login .submit:active,
	.form-login .forgot,
	.form-login .forgot:hover,
	.form-login .forgot:active,
	.navigation .logo:hover,
	.navigation .logo:active,
	.navigation .search > a:hover,
	.navigation .navigation-link > a:hover,
	.navigation .navigation-full-link > a:hover,
	.navigation .search > a:active,
	.navigation .navigation-link > a:active,
	.navigation .navigation-full-link > a:active,
	.navigation.sticky .search > a:hover,
	.navigation.static .search > a:hover,
	.navigation.sticky .navigation-full-link > a:hover,
	.navigation.static .navigation-full-link > a:hover,
	.navigation.sticky .search > a:active,
	.navigation.static .search > a:active,
	.navigation.sticky .navigation-full-link > a:active,
	.navigation.static .navigation-full-link > a:active,
	a.panel-toggle,
	a.panel-toggle:focus,
	a.panel-toggle.collapsed:hover,
	a.panel-toggle.collapsed:active,
	.main-slider .carousel-control:hover.left,
	.main-slider .carousel-control:active.left,
	.main-slider .carousel-control:hover.right,
	.main-slider .carousel-control:active.right,
	.thumbnail-slider .prev:hover,
	.thumbnail-slider .next:hover,
	.thumbnail-slider .prev:active,
	.thumbnail-slider .next:active,
	.thumbnail-slider .description-open:hover,
	.thumbnail-slider .description-open:active,
	.thumbnail-slider .description-close,
	.owl-carousel .owl-controls .owl-buttons .owl-prev:hover,
	.owl-carousel .owl-controls .owl-buttons .owl-next:hover,
	.owl-carousel .owl-controls .owl-buttons .owl-prev:active,
	.owl-carousel .owl-controls .owl-buttons .owl-next:active,
	.controls-bottom-left.owl-carousel .owl-controls .owl-buttons .owl-prev:hover,
	.controls-bottom-left.owl-carousel .owl-controls .owl-buttons .owl-next:hover,
	.controls-bottom-left.owl-carousel .owl-controls .owl-buttons .owl-prev:active,
	.controls-bottom-left.owl-carousel .owl-controls .owl-buttons .owl-next:active,
	.post-meta a:hover,
	.post-meta a:active,
	.post-meta .link-red,
	.post-share a:hover,
	.post-share a:active,
	.comment-author:hover,
	.comment-author:active,
	.comment-reply:hover,
	.comment-reply:active,
	.pager a:hover,
	.pager a:active,
	.widget_categories li.active a,
	.widget_categories a:hover,
	.widget_categories a:active,
	.widget_calendar table tbody a,
	.widget_calendar table tfoot tr td#prev a:hover,
	.widget_calendar table tfoot tr td#next a:hover,
	.widget_calendar table tfoot tr td#prev a:active,
	.widget_calendar table tfoot tr td#next a:active,
	.team-member .social li a:hover,
	.team-member .social li a:active,
	.widget-posts .post-title a:hover,
	.widget-posts .post-title a:active,
	.section-header .scroll-arrow:hover,
	.section-header .scroll-arrow:active,
	#swipebox-prev:hover,
	#swipebox-next:hover,
	#swipebox-close:hover,
	#swipebox-prev:active,
	#swipebox-next:active,
	#swipebox-close:active,
	.comment-reply-link:hover,
	.comment-reply-link:active,
	.widget_rss li.active a,
	.widget_recent_comments li.active a,
	.widget_pages li.active a,
	.widget_nav_menu li.active a,
	.widget_meta li.active a,
	.widget_archive li.active a,
	.widget_recent_entries li.active a,
	.widget_rss a:hover,
	.widget_rss a:active,
	.widget_recent_comments a:hover,
	.widget_recent_comments a:active,
	.widget_pages a:hover,
	.widget_pages a:active,
	.widget_nav_menu a:hover,
	.widget_nav_menu a:active,
	.widget_meta a:hover,
	.widget_meta a:active,
	.widget_archive a:hover,
	.widget_archive a:active,
	.widget_recent_entries a:hover,
	.widget_recent_entries a:active,
	.widget_rss cite,
	a.post-overlay-link:hover,
	a.post-overlay-link:active,
	.btn-danger:hover,
	.btn-danger:focus,
	.btn-danger:active,
	.btn-danger.active,
	.open > .btn-danger.dropdown-toggle,
	.fly-performance .number,
	.card-price .price .number,
	.navbar .navbar-nav > li > a.btn-danger:hover,
	.navbar .navbar-nav > li > a.btn-danger:focus,
	.navbar .navbar-nav > li > a.btn-danger:active,
	.navbar .navbar-nav > li > a.btn-danger.active,
	.open > .navbar .navbar-nav > li > a.btn-danger.dropdown-toggle
	{color: '.$color.';}';

			// border color
			$css .= '.separator-danger:before,
	.separator-danger:after,
	.avatar,
	.avatar-danger,
	*::selection,
	.btn-danger,
	.navbar .navbar-nav > li > a.btn-danger,
	.btn-danger:disabled,
	.btn-danger[disabled],
	.btn-danger.disabled,
	.navbar .navbar-nav > li > a.btn-danger:disabled,
	.navbar .navbar-nav > li > a.btn-danger[disabled],
	.navbar .navbar-nav > li > a.btn-danger.disabled,
	.has-error .form-control:focus + .input-group-addon,
	.card-blog .line-divider.line-danger,
	.form-comment #submit,
	.post-taglist a:hover,
	.post-taglist a:active,
	.widget_tag_cloud a:hover,
	.widget_tag_cloud a:active,
	.section-header .scroll-arrow:hover,
	.section-header .scroll-arrow:active,
	#swipebox-prev:hover,
	#swipebox-next:hover,
	#swipebox-close:hover,
	#swipebox-prev:active,
	#swipebox-next:active,
	#swipebox-close:active,
	.widget_search .search-submit,
	.btn-danger:hover,
	.btn-danger:focus,
	.btn-danger:active,
	.btn-danger.active,
	.open > .btn-danger.dropdown-toggle,
	.navbar .navbar-nav > li > a.btn-danger:hover,
	.navbar .navbar-nav > li > a.btn-danger:focus,
	.navbar .navbar-nav > li > a.btn-danger:active,
	.navbar .navbar-nav > li > a.btn-danger.active,
	.open > .navbar .navbar-nav > li > a.btn-danger.dropdown-toggle
	{ border-color: '.$color.'; }';

			// border top color
			$css .= '.btn-danger .caret,
	.navbar .navbar-nav > li > a.btn-danger .caret
	{ border-top-color: '.$color.'; }';

			// border bottom color
			$css .= '.portfolio-filter li.active a
	{ border-bottom-color: '.$color.';}';

			// background color
			$css .= '.btn.btn-fill,
	.navbar .navbar-nav > li > a.btn-danger.btn-fill,
	.label-danger,
	.form-comment #submit,
	.form-comment #submit:hover,
	.form-comment #submit:active,
	.nav-menu li ul li,
	.nav-menu > li:hover > a.menu-link,
	.nav-menu > li:active > a.menu-link,
	.nav-menu > li.active > a.menu-link,
	.nav-menu > li.current-menu-item > a.menu-link,
	.navigation-link a.active:before,
	.sticky .navigation-link a.active:before,
	.static .navigation-link a.active:before,
	.navigation-link a.active:after,
	.sticky .navigation-link a.active:after,
	.static .navigation-link a.active:after,
	.tab-header .active a,
	a.panel-toggle:before,
	a.panel-toggle:after,
	.post-taglist a:hover,
	.post-taglist a:active,
	.widget_tag_cloud a:hover,
	.widget_tag_cloud a:active,
	.widget_search .search-submit,
	.widget_search .search-submit:hover,
	.widget_search .search-submit:active,
	.btn-danger.btn-fill:hover,
	.btn-danger.btn-fill:focus,
	.btn-danger.btn-fill:active,
	.btn-danger.btn-fill.active,
	.open > .btn-danger.btn-fill.dropdown-toggle,
	.navbar .navbar-nav > li > a.btn-danger.btn-fill:hover,
	.navbar .navbar-nav > li > a.btn-danger.btn-fill:focus,
	.navbar .navbar-nav > li > a.btn-danger.btn-fill:active,
	.navbar .navbar-nav > li > a.btn-danger.btn-fill.active,
	.open > .navbar .navbar-nav > li > a.btn-danger.btn-fill.dropdown-toggle,
	.form-comment #submit:hover,
	.form-comment #submit:active
	{ background-color: '.$color.'; }';

			$css .= '::-moz-selection{ background-color: '.$color.'; }';
			$css .= '::selection{ background-color: '.$color.'; }';

			// fix button fill color
			$css .= '.btn-danger.btn-fill{ color: #fff; }';

			// shadow
			$css .= '.post-taglist a:hover,
	.post-taglist a:active
	{-webkit-box-shadow: inset 0 0 0 1px '.$color.';
		-moz-box-shadow: inset 0 0 0 1px '.$color.';
		box-shadow: inset 0 0 0 1px '.$color.'; }';

			$file_style = is_child_theme() ? 'parent-style' : 'style';
			wp_add_inline_style( $file_style, $css );
		}
	}
endif;
add_filter( 'wp_enqueue_scripts', '_vispa_change_site_color', 99 );


if ( ! function_exists( '_vispa_action_tracking_script' ) ) {
	/**
	 * Display theme tracking script
	 */
	function _vispa_action_tracking_script() {
		$tracking_script = function_exists( 'fw_get_db_settings_option' ) ? fw_get_db_settings_option( 'tracking_script', '' ) : '';
		if ( ! empty( $tracking_script ) ) {
			vispa_theme_print( $tracking_script );
		}
	}
}
add_action( 'wp_footer', '_vispa_action_tracking_script' );


if ( ! function_exists( '_vispa_add_custom_css' ) ) :
	function _vispa_add_custom_css() {
		if ( ! defined( 'FW' ) ) {
			return;
		}

		$css = fw_get_db_settings_option( 'quick_css' );

		if ( ! empty( $css ) ) {
			wp_add_inline_style( 'style', $css );
		}
	}
endif;
add_filter( 'wp_enqueue_scripts', '_vispa_add_custom_css', 99 );


if ( ! function_exists( '_vispa_action_save_fw_portfolio_post' ) ) :
	/**
	 * Set post terms to portfolio on save
	 */
	function _vispa_action_save_fw_portfolio_post() {
		$post_id = @$_POST['post_ID'];
		if ( ! vispa_is_real_post_save( $post_id ) ) {
			return;
			die();
		}
		$taxonomy = 'fw-portfolio-category';
		$terms    = wp_get_post_terms( $post_id, $taxonomy );

		$parrents_ids = array();
		foreach ( $terms as $term ) {
			if ( $term->parent != 0 ) {
				if ( ! in_array( $term->parent, $parrents_ids ) ) {
					$parrents_ids[] = $term->parent;
				}
			}
		}

		foreach ( $parrents_ids as $term_id ) {
			wp_set_post_terms( $post_id, $term_id, $taxonomy, true );
		}
	}
endif;
add_action( 'save_post_fw-portfolio', '_vispa_action_save_fw_portfolio_post' );


/**
 * @param FW_Ext_Backups_Demo[] $demos
 *
 * @return FW_Ext_Backups_Demo[]
 */
function _vispa_filter_fw_ext_backups_demos( $demos ) {
	$demos_array = array(
		'vispa' => array(
			'title'        => esc_html__( 'Vispa', 'vispa' ),
			'screenshot'   => '//flytemplates.com/demo-themes/images/vispa.png',
			'preview_link' => '//demo.flytemplates.com/vispa/',
		),
	);

	foreach ( $demos_array as $id => $data ) {
		$demo = new FW_Ext_Backups_Demo( $id, 'piecemeal', array(
			'url'     => 'http://flytemplates.com/demo-themes/',
			'file_id' => $id,
		) );
		$demo->set_title( $data['title'] );
		$demo->set_screenshot( $data['screenshot'] );
		$demo->set_preview_link( $data['preview_link'] );

		$demos[ $demo->get_id() ] = $demo;

		unset( $demo );
	}

	return $demos;
}
add_filter( 'fw:ext:backups-demo:demos', '_vispa_filter_fw_ext_backups_demos' );


if ( ! function_exists( '_vispa_filter_excerpt_length' ) ) :
	/**
	 * Set the theme excerpt length
	 */
	function _vispa_filter_excerpt_length( $length ) {
		return 30;
	}
endif;
add_filter( 'excerpt_length', '_vispa_filter_excerpt_length', 999 );


if (!function_exists('_vispa_action_shortcode_button_enqueue_dynamic_css')) :
	/**
	 * @internal
	 *
	 * @param array $data
	 */
	function _vispa_action_shortcode_button_enqueue_dynamic_css($data) {
		$shortcode = 'button';
		$atts = shortcode_parse_atts($data['atts_string']);
		$atts = fw_ext_shortcodes_decode_attr($atts, $shortcode, $data['post']->ID);

		$final_styles = '';
		if( $atts['type']['selected'] == 'btn-fill' ){
			// bg color for fill button
			if ( ! empty( $atts['type']['btn-fill']['bg_color'] ) ) {
				$final_styles .= '.btn.' . $atts['type']['selected'] . '.sh-' . $atts['unique_id'] . ', .btn.' . $atts['type']['selected'] . '.sh-' . $atts['unique_id'] . ':hover, .btn.' . $atts['type']['selected'] . '.sh-' . $atts['unique_id'] . ':focus{ background-color: ' . $atts['type']['btn-fill']['bg_color'] . ';}';
			}
		}
		elseif( $atts['type']['selected'] == 'btn-transparent' ){
			// border color
			if ( ! empty( $atts['label_color'] ) ) {
				$final_styles .= '.btn.'.$atts['type']['selected'].'.sh-'.$atts['unique_id'].' { border-color: '.$atts['label_color'].';}';
			}
			// border hover color
			if ( ! empty( $atts['bg_hover_color'] ) ) {
				$final_styles .= '.btn.'.$atts['type']['selected'].'.sh-'.$atts['unique_id'].':hover { border-color: '.$atts['bg_hover_color'].';}';
			}
		}

		// label color
		if ( ! empty( $atts['label_color'] ) ) {
			$final_styles .= '.btn.'.$atts['type']['selected'].'.sh-'.$atts['unique_id'].', .btn.'.$atts['type']['selected'].'.sh-'.$atts['unique_id'].':hover, .btn.'.$atts['type']['selected'].'.sh-'.$atts['unique_id'].':focus { color: '.$atts['label_color'].';}';
		}

		// label hover color
		if ( ! empty( $atts['label_hover_color'] ) ) {
			$final_styles .= '.btn.'.$atts['type']['selected'].'.sh-'.$atts['unique_id'].':hover { color: '.$atts['label_hover_color'].';}';
		}

		// bg hover color
		if ( ! empty( $atts['bg_hover_color'] ) ) {
			$final_styles .= '.btn.'.$atts['type']['selected'].'.sh-'.$atts['unique_id'].':hover { background-color: '.$atts['bg_hover_color'].';}';
		}

		// label styling
		if( $atts['label_styling']['selected'] == 'yes' ) {
			// label styling
			$label_styling = vispa_get_shortcode_advanced_styles( $atts['label_styling']['yes']['font'] );
			if( !empty($label_styling) ) {
				$final_styles .= '.btn.'.$atts['type']['selected'].'.'.$atts['size'].'.sh-'.$atts['unique_id'].'{'.$label_styling.'}';
			}

			// responsive label styling
			$responsive_label_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['label_styling']['yes']['font'], 'selector' => '.btn.'.$atts['type']['selected'].'.'.$atts['size'].'.sh-'.$atts['unique_id'] ) );
			if ( !empty($responsive_label_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_label_styling . '}';
			}
		}

		if ( empty($final_styles) ) {
			return;
		}

		wp_add_inline_style( 'style', $final_styles );
	}
	add_action( 'fw_ext_shortcodes_enqueue_static:button', '_vispa_action_shortcode_button_enqueue_dynamic_css' );
endif;


function vispa_brizy_upgrade() {
	return 'https://brizy.io/account/aff/go/flytemplates?i=1';
}
add_filter( 'brizy_upgrade_to_pro_url', 'vispa_brizy_upgrade' );


if (!function_exists('_vispa_action_shortcode_divider_enqueue_dynamic_css')) :
	/**
	 * @internal
	 *
	 * @param array $data
	 */
	function _vispa_action_shortcode_divider_enqueue_dynamic_css($data) {
		$shortcode = 'divider';
		$atts = shortcode_parse_atts($data['atts_string']);
		$atts = fw_ext_shortcodes_decode_attr($atts, $shortcode, $data['post']->ID);

		$final_styles = '';
		// color
		if ( ! empty( $atts['color'] ) ) {
			$final_styles .= '.separator.sh-'.$atts['unique_id'].' { color: '.$atts['color'].';}';
			$final_styles .= '.separator.sh-'.$atts['unique_id'].':before, .separator.sh-'.$atts['unique_id'].':after { border-color: '.$atts['color'].';}';
		}

		if ( empty($final_styles) ) {
			return;
		}

		wp_add_inline_style( 'style', $final_styles );
	}
	add_action( 'fw_ext_shortcodes_enqueue_static:divider', '_vispa_action_shortcode_divider_enqueue_dynamic_css' );
endif;


if (!function_exists('_vispa_action_shortcode_special_heading_enqueue_dynamic_css')) :
	/**
	 * @internal
	 *
	 * @param array $data
	 */
	function _vispa_action_shortcode_special_heading_enqueue_dynamic_css($data) {
		$shortcode = 'special_heading';
		$atts = shortcode_parse_atts($data['atts_string']);
		$atts = fw_ext_shortcodes_decode_attr($atts, $shortcode, $data['post']->ID);

		$final_styles = '';
		if( $atts['title_styling']['selected'] == 'yes' ) {
			// title styling
			$title_styling = vispa_get_shortcode_advanced_styles( $atts['title_styling']['yes']['font'] );
			if( !empty($title_styling) ) {
				$final_styles .= '.fw-heading.sh-' . $atts['unique_id'] . ' .fw-special-title {'.$title_styling.'}';
			}

			// responsive title styling
			$responsive_title_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['title_styling']['yes']['font'], 'selector' => '.fw-heading.sh-' . $atts['unique_id'] . ' .fw-special-title' ) );
			if ( !empty($responsive_title_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_title_styling . '}';
			}
		}

		if( $atts['subtitle_styling']['selected'] == 'yes' ) {
			// subtitle styling
			$subtitle_styling = vispa_get_shortcode_advanced_styles( $atts['subtitle_styling']['yes']['font'] );
			if( !empty($subtitle_styling) ) {
				$final_styles .= '.fw-heading.sh-' . $atts['unique_id'] . ' .description {'.$subtitle_styling.'}';
			}

			// responsive subtitle styling
			$responsive_subtitle_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['subtitle_styling']['yes']['font'], 'selector' => '.fw-heading.sh-' . $atts['unique_id'] . ' .description' ) );
			if ( !empty($responsive_subtitle_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_subtitle_styling . '}';
			}
		}

		// separator color
		if ( $atts['separator']['selected'] == 'yes' &&  !empty($atts['separator_color']) ) {
			$final_styles .= '.fw-heading.sh-'.$atts['unique_id'].' .separator{ color: '.$atts['separator_color'].';}';
			$final_styles .= '.fw-heading.sh-'.$atts['unique_id'].' .separator:before, .fw-heading.sh-'.$atts['unique_id'].' .separator:after { border-color: '.$atts['separator_color'].';}';
		}

		if ( empty($final_styles) ) {
			return;
		}

		wp_add_inline_style( 'style', $final_styles );
	}
	add_action( 'fw_ext_shortcodes_enqueue_static:special_heading', '_vispa_action_shortcode_special_heading_enqueue_dynamic_css' );
endif;


if (!function_exists('_vispa_action_shortcode_services_enqueue_dynamic_css')) :
	/**
	 * @internal
	 *
	 * @param array $data
	 */
	function _vispa_action_shortcode_services_enqueue_dynamic_css($data) {
		$shortcode = 'services';
		$atts = shortcode_parse_atts($data['atts_string']);
		$atts = fw_ext_shortcodes_decode_attr($atts, $shortcode, $data['post']->ID);

		$final_styles = '';
		if( $atts['title_styling']['selected'] == 'yes' ) {
			// title styling
			$title_styling = vispa_get_shortcode_advanced_styles( $atts['title_styling']['yes']['font'] );
			if( !empty($title_styling) ) {
				$final_styles .= '.fw-service.sh-' . $atts['unique_id'] . ' .fw-service-title {'.$title_styling.'}';
			}

			// responsive title styling
			$responsive_title_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['title_styling']['yes']['font'], 'selector' => '.fw-service.sh-' . $atts['unique_id'] . ' .fw-service-title' ) );
			if ( !empty($responsive_title_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_title_styling . '}';
			}
		}

		if( $atts['description_styling']['selected'] == 'yes' ) {
			// description styling
			$description_styling = vispa_get_shortcode_advanced_styles( $atts['description_styling']['yes']['font'] );
			if( !empty($description_styling) ) {
				$final_styles .= '.fw-service.sh-' . $atts['unique_id'] . ' .description, .fw-service.sh-' . $atts['unique_id'] . ' .description p {'.$description_styling.'}';
			}

			// responsive description styling
			$responsive_description_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['description_styling']['yes']['font'], 'selector' => '.fw-service.sh-' . $atts['unique_id'] . ' .description, .fw-service.sh-' . $atts['unique_id'] . ' .description p' ) );
			if ( !empty($responsive_description_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_description_styling . '}';
			}
		}

		if ( empty($final_styles) ) {
			return;
		}

		wp_add_inline_style( 'style', $final_styles );
	}
	add_action( 'fw_ext_shortcodes_enqueue_static:services', '_vispa_action_shortcode_services_enqueue_dynamic_css' );
endif;


if (!function_exists('_vispa_action_shortcode_skills_enqueue_dynamic_css')) :
	/**
	 * @internal
	 *
	 * @param array $data
	 */
	function _vispa_action_shortcode_skills_enqueue_dynamic_css($data) {
		$shortcode = 'skills';
		$atts = shortcode_parse_atts($data['atts_string']);
		$atts = fw_ext_shortcodes_decode_attr($atts, $shortcode, $data['post']->ID);

		$final_styles = '';
		if( $atts['title_styling']['selected'] == 'yes' ) {
			// title styling
			$title_styling = vispa_get_shortcode_advanced_styles( $atts['title_styling']['yes']['font'] );
			if( !empty($title_styling) ) {
				$final_styles .= '.fly-skills.sh-' . $atts['unique_id'] . ' .widget-title {'.$title_styling.'}';
			}

			// responsive title styling
			$responsive_title_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['title_styling']['yes']['font'], 'selector' => '.fly-skills.sh-' . $atts['unique_id'] . ' .widget-title' ) );
			if ( !empty($responsive_title_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_title_styling . '}';
			}
		}

		if( $atts['skill_title_styling']['selected'] == 'yes' ) {
			// skill title styling
			$skill_title_styling = vispa_get_shortcode_advanced_styles( $atts['skill_title_styling']['yes']['font'] );
			if( !empty($skill_title_styling) ) {
				$final_styles .= '.fly-skills.sh-' . $atts['unique_id'] . ' .skill-title, .fly-skills.sh-' . $atts['unique_id'] . ' .skill-percentage {'.$skill_title_styling.'}';
			}

			// responsive skill title styling
			$responsive_skill_title_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['skill_title_styling']['yes']['font'], 'selector' => '.fly-skills.sh-' . $atts['unique_id'] . ' .skill-title, .fly-skills.sh-' . $atts['unique_id'] . ' .skill-percentage' ) );
			if ( !empty($responsive_skill_title_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_skill_title_styling . '}';
			}
		}

		if( !empty($atts['progress_color']) ) {
			$final_styles .= '.fly-skills.sh-' . $atts['unique_id'] . ' .skill .progress-bar{ background-color: '.$atts['progress_color'].'}';
		}

		if ( empty($final_styles) ) {
			return;
		}

		wp_add_inline_style( 'style', $final_styles );
	}
	add_action( 'fw_ext_shortcodes_enqueue_static:skills', '_vispa_action_shortcode_skills_enqueue_dynamic_css' );
endif;


if (!function_exists('_vispa_action_shortcode_tabs_enqueue_dynamic_css')) :
	/**
	 * @internal
	 *
	 * @param array $data
	 */
	function _vispa_action_shortcode_tabs_enqueue_dynamic_css($data) {
		$shortcode = 'tabs';
		$atts = shortcode_parse_atts($data['atts_string']);
		$atts = fw_ext_shortcodes_decode_attr($atts, $shortcode, $data['post']->ID);

		$final_styles = '';
		if( $atts['title_styling']['selected'] == 'yes' ) {
			// title styling
			$title_styling = vispa_get_shortcode_advanced_styles( $atts['title_styling']['yes']['font'] );
			if( !empty($title_styling) ) {
				$final_styles .= '.fly-tabs-container.sh-' . $atts['unique_id'] . ' .fly-tab-title {'.$title_styling.'}';
			}

			// responsive title styling
			$responsive_title_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['title_styling']['yes']['font'], 'selector' => '.fly-tabs-container.sh-' . $atts['unique_id'] . ' .fly-tab-title' ) );
			if ( !empty($responsive_title_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_title_styling . '}';
			}
		}

		if( $atts['content_styling']['selected'] == 'yes' ) {
			// content styling
			$content_styling = vispa_get_shortcode_advanced_styles( $atts['content_styling']['yes']['font'] );
			if( !empty($content_styling) ) {
				$final_styles .= '.fly-tabs-container.sh-' . $atts['unique_id'] . ' .description, .fly-tabs-container.sh-' . $atts['unique_id'] . ' .description p {'.$content_styling.'}';
			}

			// responsive content styling
			$responsive_content_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['content_styling']['yes']['font'], 'selector' => '.fly-tabs-container.sh-' . $atts['unique_id'] . ' .description, .fly-tabs-container.sh-' . $atts['unique_id'] . ' .description p' ) );
			if ( !empty($responsive_content_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_content_styling . '}';
			}
		}

		if ( empty($final_styles) ) {
			return;
		}

		wp_add_inline_style( 'style', $final_styles );
	}
	add_action( 'fw_ext_shortcodes_enqueue_static:tabs', '_vispa_action_shortcode_tabs_enqueue_dynamic_css' );
endif;


if (!function_exists('_vispa_action_shortcode_team_member_enqueue_dynamic_css')) :
	/**
	 * @internal
	 *
	 * @param array $data
	 */
	function _vispa_action_shortcode_team_member_enqueue_dynamic_css($data) {
		$shortcode = 'team_member';
		$atts = shortcode_parse_atts($data['atts_string']);
		$atts = fw_ext_shortcodes_decode_attr($atts, $shortcode, $data['post']->ID);

		$final_styles = '';
		if( $atts['name_styling']['selected'] == 'yes' ) {
			// name styling
			$name_styling = vispa_get_shortcode_advanced_styles( $atts['name_styling']['yes']['font'] );
			if( !empty($name_styling) ) {
				$final_styles .= '.fly-team-member.sh-' . $atts['unique_id'] . ' .big-text {'.$name_styling.'}';
			}

			// responsive name styling
			$responsive_name_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['name_styling']['yes']['font'], 'selector' => '.fly-team-member.sh-' . $atts['unique_id'] . ' .big-text' ) );
			if ( !empty($responsive_name_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_name_styling . '}';
			}
		}

		if( $atts['position_styling']['selected'] == 'yes' ) {
			// position styling
			$position_styling = vispa_get_shortcode_advanced_styles( $atts['position_styling']['yes']['font'] );
			if( !empty($position_styling) ) {
				$final_styles .= '.fly-team-member.sh-' . $atts['unique_id'] . ' .small-text {'.$position_styling.'}';
			}

			// responsive position styling
			$responsive_position_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['position_styling']['yes']['font'], 'selector' => '.fly-team-member.sh-' . $atts['unique_id'] . ' .small-text' ) );
			if ( !empty($responsive_position_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_position_styling . '}';
			}
		}

		if( $atts['content_styling']['selected'] == 'yes' ) {
			// content styling
			$content_styling = vispa_get_shortcode_advanced_styles( $atts['content_styling']['yes']['font'] );
			if( !empty($content_styling) ) {
				$final_styles .= '.fly-team-member.sh-' . $atts['unique_id'] . ' .description, .fly-team-member.sh-' . $atts['unique_id'] . ' .description p {'.$content_styling.'}';
			}

			// responsive content styling
			$responsive_content_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['content_styling']['yes']['font'], 'selector' => '.fly-team-member.sh-' . $atts['unique_id'] . ' .description, .fly-team-member.sh-' . $atts['unique_id'] . ' .description p' ) );
			if ( !empty($responsive_content_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_content_styling . '}';
			}
		}

		if( $atts['border']['selected'] == 'yes' ) {
			if( !empty($atts['border']['yes']['border_width']) ) {
				$final_styles .= '.fly-team-member.sh-' . $atts['unique_id'] . ' .avatar {border-width: '.(int)$atts['border']['yes']['border_width'].'px;}';
			}
			if( !empty($atts['border']['yes']['border_color']) ) {
				$final_styles .= '.fly-team-member.sh-' . $atts['unique_id'] . ' .avatar {border-color: '.$atts['border']['yes']['border_color'].';}';
			}
		}
		else {
			$final_styles .= '.fly-team-member.sh-' . $atts['unique_id'] . ' .avatar {border: none;}';
		}

		if ( empty($final_styles) ) {
			return;
		}

		wp_add_inline_style( 'style', $final_styles );
	}
	add_action( 'fw_ext_shortcodes_enqueue_static:team_member', '_vispa_action_shortcode_team_member_enqueue_dynamic_css' );
endif;


if (!function_exists('_vispa_action_shortcode_testimonials_enqueue_dynamic_css')) :
	/**
	 * @internal
	 *
	 * @param array $data
	 */
	function _vispa_action_shortcode_testimonials_enqueue_dynamic_css($data) {
		$shortcode = 'testimonials';
		$atts = shortcode_parse_atts($data['atts_string']);
		$atts = fw_ext_shortcodes_decode_attr($atts, $shortcode, $data['post']->ID);

		$final_styles = '';
		if( $atts['title_styling']['selected'] == 'yes' ) {
			// title styling
			$title_styling = vispa_get_shortcode_advanced_styles( $atts['title_styling']['yes']['font'] );
			if( !empty($title_styling) ) {
				$final_styles .= '.fw-testimonials.sh-' . $atts['unique_id'] . ' .fly-testimonials-title {'.$title_styling.'}';
			}

			// responsive title styling
			$responsive_title_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['title_styling']['yes']['font'], 'selector' => '.fw-testimonials.sh-' . $atts['unique_id'] . ' .fly-testimonials-title' ) );
			if ( !empty($responsive_title_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_title_styling . '}';
			}
		}

		if( $atts['content_styling']['selected'] == 'yes' ) {
			// content styling
			$content_styling = vispa_get_shortcode_advanced_styles( $atts['content_styling']['yes']['font'] );
			if( !empty($content_styling) ) {
				$final_styles .= '.fw-testimonials.sh-' . $atts['unique_id'] . ' .description, .fw-testimonials.sh-' . $atts['unique_id'] . ' .description p {'.$content_styling.'}';
			}

			// responsive content styling
			$responsive_content_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['content_styling']['yes']['font'], 'selector' => '.fw-testimonials.sh-' . $atts['unique_id'] . ' .description, .fw-testimonials.sh-' . $atts['unique_id'] . ' .description p' ) );
			if ( !empty($responsive_content_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_content_styling . '}';
			}
		}

		if ( empty($final_styles) ) {
			return;
		}

		wp_add_inline_style( 'style', $final_styles );
	}
	add_action( 'fw_ext_shortcodes_enqueue_static:testimonials', '_vispa_action_shortcode_testimonials_enqueue_dynamic_css' );
endif;


if (!function_exists('_vispa_action_shortcode_text_block_enqueue_dynamic_css')) :
	/**
	 * @internal
	 *
	 * @param array $data
	 */
	function _vispa_action_shortcode_text_block_enqueue_dynamic_css($data) {
		$shortcode = 'text_block';
		$atts = shortcode_parse_atts($data['atts_string']);
		$atts = fw_ext_shortcodes_decode_attr($atts, $shortcode, $data['post']->ID);

		$final_styles = '';
		if( $atts['content_styling']['selected'] == 'yes' ) {
			// content styling
			$content_styling = vispa_get_shortcode_advanced_styles( $atts['content_styling']['yes']['font'] );
			if( !empty($content_styling) ) {
				$final_styles .= '.text-block.sh-' . $atts['unique_id'] . ', .text-block.sh-' . $atts['unique_id'] . ' p {'.$content_styling.'}';
			}

			// responsive content styling
			$responsive_content_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['content_styling']['yes']['font'], 'selector' => '.text-block.sh-' . $atts['unique_id'] . ', .text-block.sh-' . $atts['unique_id'] . ' p' ) );
			if ( !empty($responsive_content_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_content_styling . '}';
			}
		}

		if ( empty($final_styles) ) {
			return;
		}

		wp_add_inline_style( 'style', $final_styles );
	}
	add_action( 'fw_ext_shortcodes_enqueue_static:text_block', '_vispa_action_shortcode_text_block_enqueue_dynamic_css' );
endif;


if (!function_exists('_vispa_action_shortcode_icon_box_enqueue_dynamic_css')) :
	/**
	 * @internal
	 *
	 * @param array $data
	 */
	function _vispa_action_shortcode_icon_box_enqueue_dynamic_css($data) {
		$shortcode = 'icon_box';
		$atts = shortcode_parse_atts($data['atts_string']);
		$atts = fw_ext_shortcodes_decode_attr($atts, $shortcode, $data['post']->ID);

		$final_styles = '';
		if( $atts['title_styling']['selected'] == 'yes' ) {
			// title styling
			$title_styling = vispa_get_shortcode_advanced_styles( $atts['title_styling']['yes']['font'] );
			if( !empty($title_styling) ) {
				$final_styles .= '.fw-iconbox.sh-' . $atts['unique_id'] . ' .title-info {'.$title_styling.'}';
			}

			// responsive title styling
			$responsive_title_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['title_styling']['yes']['font'], 'selector' => '.fw-iconbox.sh-' . $atts['unique_id'] . ' .title-info' ) );
			if ( !empty($responsive_title_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_title_styling . '}';
			}
		}

		if( $atts['content_styling']['selected'] == 'yes' ) {
			// content styling
			$content_styling = vispa_get_shortcode_advanced_styles( $atts['content_styling']['yes']['font'] );
			if( !empty($content_styling) ) {
				$final_styles .= '.fw-iconbox.sh-' . $atts['unique_id'] . ' .text-description, .fw-iconbox.sh-' . $atts['unique_id'] . ' .info-pricing .text-description p {'.$content_styling.'}';
			}

			// responsive content styling
			$responsive_content_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['content_styling']['yes']['font'], 'selector' => '.fw-iconbox.sh-' . $atts['unique_id'] . ' .text-description, .fw-iconbox.sh-' . $atts['unique_id'] . ' .info-pricing .text-description p' ) );
			if ( !empty($responsive_content_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_content_styling . '}';
			}
		}

		if ( empty($final_styles) ) {
			return;
		}

		wp_add_inline_style( 'style', $final_styles );
	}
	add_action( 'fw_ext_shortcodes_enqueue_static:icon_box', '_vispa_action_shortcode_icon_box_enqueue_dynamic_css' );
endif;


if (!function_exists('_vispa_action_shortcode_performance_enqueue_dynamic_css')) :
	/**
	 * @internal
	 *
	 * @param array $data
	 */
	function _vispa_action_shortcode_performance_enqueue_dynamic_css($data) {
		$shortcode = 'performance';
		$atts = shortcode_parse_atts($data['atts_string']);
		$atts = fw_ext_shortcodes_decode_attr($atts, $shortcode, $data['post']->ID);

		$final_styles = '';
		if( $atts['title_styling']['selected'] == 'yes' ) {
			// title styling
			$title_styling = vispa_get_shortcode_advanced_styles( $atts['title_styling']['yes']['font'] );
			if( !empty($title_styling) ) {
				$final_styles .= '.fly-performance.sh-' . $atts['unique_id'] . ' .performance-title {'.$title_styling.'}';
			}

			// responsive title styling
			$responsive_title_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['title_styling']['yes']['font'], 'selector' => '.fly-performance.sh-' . $atts['unique_id'] . ' .performance-title' ) );
			if ( !empty($responsive_title_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_title_styling . '}';
			}
		}

		if( $atts['subtitle_styling']['selected'] == 'yes' ) {
			// subtitle styling
			$subtitle_styling = vispa_get_shortcode_advanced_styles( $atts['subtitle_styling']['yes']['font'] );
			if( !empty($subtitle_styling) ) {
				$final_styles .= '.fly-performance.sh-' . $atts['unique_id'] . ' .text-gray {'.$subtitle_styling.'}';
			}

			// responsive subtitle styling
			$responsive_subtitle_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['subtitle_styling']['yes']['font'], 'selector' => '.fly-performance.sh-' . $atts['unique_id'] . ' .text-gray' ) );
			if ( !empty($responsive_subtitle_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_subtitle_styling . '}';
			}
		}

		if( $atts['number_styling']['selected'] == 'yes' ) {
			// number styling
			$number_styling = vispa_get_shortcode_advanced_styles( $atts['number_styling']['yes']['font'] );
			if( !empty($number_styling) ) {
				$final_styles .= '.fly-performance.sh-' . $atts['unique_id'] . ' .number {'.$number_styling.'}';
			}

			// responsive subtitle styling
			$responsive_number_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['number_styling']['yes']['font'], 'selector' => '.fly-performance.sh-' . $atts['unique_id'] . ' .number' ) );
			if ( !empty($responsive_number_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_number_styling . '}';
			}
		}

		// icon color
		if( !empty( $atts['icon_color'] ) ) {
			$final_styles .= '.fly-performance.sh-' . $atts['unique_id'] . ' .icon i { color : '. $atts['icon_color'] . '}';
		}

		if ( empty($final_styles) ) {
			return;
		}

		wp_add_inline_style( 'style', $final_styles );
	}
	add_action( 'fw_ext_shortcodes_enqueue_static:performance', '_vispa_action_shortcode_performance_enqueue_dynamic_css' );
endif;


if (!function_exists('_vispa_action_shortcode_fly_gallery_enqueue_dynamic_css')) :
	/**
	 * @internal
	 *
	 * @param array $data
	 */
	function _vispa_action_shortcode_fly_gallery_enqueue_dynamic_css($data) {
		$shortcode = 'fly_gallery';
		$atts = shortcode_parse_atts($data['atts_string']);
		$atts = fw_ext_shortcodes_decode_attr($atts, $shortcode, $data['post']->ID);

		$final_styles = '';
		if( $atts['title_styling']['selected'] == 'yes' ) {
			// title styling
			$title_styling = vispa_get_shortcode_advanced_styles( $atts['title_styling']['yes']['font'] );
			if( !empty($title_styling) ) {
				$final_styles .= '.fly-gallery.sh-' . $atts['unique_id'] . ' .item-link .item-title {'.$title_styling.'}';
			}

			// responsive title styling
			$responsive_title_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['title_styling']['yes']['font'], 'selector' => '.fly-gallery.sh-' . $atts['unique_id'] . ' .item-link .item-title' ) );
			if ( !empty($responsive_title_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_title_styling . '}';
			}
		}

		if ( empty($final_styles) ) {
			return;
		}

		wp_add_inline_style( 'style', $final_styles );
	}
	add_action( 'fw_ext_shortcodes_enqueue_static:fly_gallery', '_vispa_action_shortcode_fly_gallery_enqueue_dynamic_css' );
endif;


if (!function_exists('_vispa_action_shortcode_accordion_enqueue_dynamic_css')) :
	/**
	 * @internal
	 *
	 * @param array $data
	 */
	function _vispa_action_shortcode_accordion_enqueue_dynamic_css($data) {
		$shortcode = 'accordion';
		$atts = shortcode_parse_atts($data['atts_string']);
		$atts = fw_ext_shortcodes_decode_attr($atts, $shortcode, $data['post']->ID);

		$final_styles = '';
		// general title styling
		if( $atts['title_styling']['selected'] == 'yes' ) {
			// title styling
			$title_styling = vispa_get_shortcode_advanced_styles( $atts['title_styling']['yes']['font'] );
			if( !empty($title_styling) ) {
				$final_styles .= '.fly-accordion.sh-' . $atts['unique_id'] . ' .widget-title {'.$title_styling.'}';
			}

			// responsive title styling
			$responsive_title_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['title_styling']['yes']['font'], 'selector' => '.fly-accordion.sh-' . $atts['unique_id'] . ' .widget-title' ) );
			if ( !empty($responsive_title_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_title_styling . '}';
			}
		}

		// tab title styling
		if( $atts['tab_title_styling']['selected'] == 'yes' ) {
			// title styling
			$tab_title_styling = vispa_get_shortcode_advanced_styles( $atts['tab_title_styling']['yes']['font'] );
			if( !empty($tab_title_styling) ) {
				$final_styles .= '.fly-accordion.sh-' . $atts['unique_id'] . ' a.panel-toggle, .fly-accordion.sh-' . $atts['unique_id'] . ' a.panel-toggle.collapsed {'.$tab_title_styling.'}';
			}

			// responsive title styling
			$responsive_tab_title_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['tab_title_styling']['yes']['font'], 'selector' => '.fly-accordion.sh-' . $atts['unique_id'] . ' a.panel-toggle' ) );
			if ( !empty($responsive_tab_title_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_tab_title_styling . '}';
			}

			// hover color
			if( !empty( $atts['tab_title_styling']['yes']['hover_color'] ) ) {
				$final_styles .= '.fly-accordion.sh-' . $atts['unique_id'] . ' a.panel-toggle, .fly-accordion.sh-' . $atts['unique_id'] . ' a.panel-toggle.collapsed:hover, .fly-accordion.sh-' . $atts['unique_id'] . ' a.panel-toggle.collapsed:active, .fly-accordion.sh-' . $atts['unique_id'] . ' a.panel-toggle[aria-expanded="true"] {color: '.$atts['tab_title_styling']['yes']['hover_color'].';}';
				$final_styles .= '.fly-accordion.sh-' . $atts['unique_id'] . ' a.panel-toggle:before, .fly-accordion.sh-' . $atts['unique_id'] . ' a.panel-toggle:after {background-color: '.$atts['tab_title_styling']['yes']['hover_color'].';}';
			}
		}

		// tab content styling
		if( $atts['tab_content_styling']['selected'] == 'yes' ) {
			// title styling
			$tab_content_styling = vispa_get_shortcode_advanced_styles( $atts['tab_content_styling']['yes']['font'] );
			if( !empty($tab_content_styling) ) {
				$final_styles .= '.fly-accordion.sh-' . $atts['unique_id'] . ' .panel-body, .fly-accordion.sh-' . $atts['unique_id'] . ' .panel-body p {'.$tab_content_styling.'}';
			}

			// responsive title styling
			$responsive_tab_content_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['tab_content_styling']['yes']['font'], 'selector' => '.fly-accordion.sh-' . $atts['unique_id'] . ' .panel-body, .fly-accordion.sh-' . $atts['unique_id'] . ' .panel-body p' ) );
			if ( !empty($responsive_tab_content_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_tab_content_styling . '}';
			}
		}

		if ( empty($final_styles) ) {
			return;
		}

		wp_add_inline_style( 'style', $final_styles );
	}
	add_action( 'fw_ext_shortcodes_enqueue_static:accordion', '_vispa_action_shortcode_accordion_enqueue_dynamic_css' );
endif;


if (!function_exists('_vispa_action_shortcode_pricing_table_enqueue_dynamic_css')) :
	/**
	 * @internal
	 *
	 * @param array $data
	 */
	function _vispa_action_shortcode_pricing_table_enqueue_dynamic_css($data) {
		$shortcode = 'pricing_table';
		$atts = shortcode_parse_atts($data['atts_string']);
		$atts = fw_ext_shortcodes_decode_attr($atts, $shortcode, $data['post']->ID);

		$final_styles = '';
		if( $atts['button']['yes']['button_options']['type']['selected'] == 'btn-fill' ){
			// bg color for fill button
			if ( ! empty( $atts['button']['yes']['button_options']['type']['btn-fill']['bg_color'] ) ) {
				$final_styles .= '.sh-'.$atts['unique_id'].' .btn.' . $atts['button']['yes']['button_options']['type']['selected'].', .sh-'.$atts['unique_id'].' .btn.' . $atts['button']['yes']['button_options']['type']['selected']. ':hover, .sh-'.$atts['unique_id'].' .btn.' . $atts['button']['yes']['button_options']['type']['selected'].':focus{ background-color: ' . $atts['button']['yes']['button_options']['type']['btn-fill']['bg_color'] . ';}';
			}
		}
		elseif( $atts['button']['yes']['button_options']['type']['selected'] == 'btn-transparent' ){
			// border color
			if ( ! empty( $atts['button']['yes']['button_options']['label_color'] ) ) {
				$final_styles .= '.sh-'.$atts['unique_id'].' .btn.'.$atts['button']['yes']['button_options']['type']['selected'].'{ border-color: '.$atts['button']['yes']['button_options']['label_color'].';}';
			}
			// border hover color
			if ( ! empty( $atts['button']['yes']['button_options']['bg_hover_color'] ) ) {
				$final_styles .= '.sh-'.$atts['unique_id'].' .btn.'.$atts['button']['yes']['button_options']['type']['selected'].':hover { border-color: '.$atts['button']['yes']['button_options']['bg_hover_color'].';}';
			}
		}

		// label color
		if ( ! empty( $atts['button']['yes']['button_options']['label_color'] ) ) {
			$final_styles .= '.sh-'.$atts['unique_id'].' .btn.'.$atts['button']['yes']['button_options']['type']['selected'].', .sh-'.$atts['unique_id'].' .btn.'.$atts['button']['yes']['button_options']['type']['selected'].':hover, .sh-'.$atts['unique_id'].' .btn.'.$atts['button']['yes']['button_options']['type']['selected'].':focus { color: '.$atts['button']['yes']['button_options']['label_color'].';}';
		}

		// label hover color
		if ( ! empty( $atts['button']['yes']['button_options']['label_hover_color'] ) ) {
			$final_styles .= '.sh-'.$atts['unique_id'].' .btn.'.$atts['button']['yes']['button_options']['type']['selected'].':hover { color: '.$atts['button']['yes']['button_options']['label_hover_color'].';}';
		}

		// bg hover color
		if ( ! empty( $atts['button']['yes']['button_options']['bg_hover_color'] ) ) {
			$final_styles .= '.sh-'.$atts['unique_id'].' .btn.'.$atts['button']['yes']['button_options']['type']['selected'].':hover { background-color: '.$atts['button']['yes']['button_options']['bg_hover_color'].';}';
		}

		// btn label styling
		if( isset($atts['button']['yes']['button_options']['label_styling']['selected']) && $atts['button']['yes']['button_options']['label_styling']['selected'] == 'yes' ) {
			// label styling
			$label_styling = vispa_get_shortcode_advanced_styles( $atts['button']['yes']['button_options']['label_styling']['yes']['font'] );
			if( !empty($label_styling) ) {
				$final_styles .= '.sh-'.$atts['unique_id'].' .btn.'.$atts['button']['yes']['button_options']['type']['selected'].'.'.$atts['button']['yes']['button_options']['size'].'{'.$label_styling.'}';
			}

			// responsive label styling
			$responsive_label_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['button']['yes']['button_options']['label_styling']['yes']['font'], 'selector' => '.sh-'.$atts['unique_id'].' .btn.'.$atts['button']['yes']['button_options']['type']['selected'].'.'.$atts['button']['yes']['button_options']['size'] ) );
			if ( !empty($responsive_label_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_label_styling . '}';
			}
		}

		if( $atts['title_styling']['selected'] == 'yes' ) {
			// title styling
			$title_styling = vispa_get_shortcode_advanced_styles( $atts['title_styling']['yes']['font'] );
			if( !empty($title_styling) ) {
				$final_styles .= '.fw-pricing.sh-' . $atts['unique_id'] . ' .title-header {'.$title_styling.'}';
			}

			// responsive title styling
			$responsive_title_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['title_styling']['yes']['font'], 'selector' => '.fw-pricing.sh-' . $atts['unique_id'] . ' .title-header' ) );
			if ( !empty($responsive_title_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_title_styling . '}';
			}
		}

		if( $atts['time_styling']['selected'] == 'yes' ) {
			// time styling
			$time_styling = vispa_get_shortcode_advanced_styles( $atts['time_styling']['yes']['font'] );
			if( !empty($time_styling) ) {
				$final_styles .= '.fw-pricing.sh-' . $atts['unique_id'] . ' .subtitle-header {'.$time_styling.'}';
			}

			// responsive time styling
			$responsive_time_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['time_styling']['yes']['font'], 'selector' => '.fw-pricing.sh-' . $atts['unique_id'] . ' .subtitle-header' ) );
			if ( !empty($responsive_time_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_time_styling . '}';
			}
		}

		if( $atts['price_styling']['selected'] == 'yes' ) {
			// price styling
			$price_styling = vispa_get_shortcode_advanced_styles( $atts['price_styling']['yes']['font'] );
			if( !empty($price_styling) ) {
				$final_styles .= '.fw-pricing.sh-' . $atts['unique_id'] . ' .price .number {'.$price_styling.'}';
			}

			// responsive price styling
			$responsive_price_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['price_styling']['yes']['font'], 'selector' => '.fw-pricing.sh-' . $atts['unique_id'] . ' .price .number' ) );
			if ( !empty($responsive_price_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_price_styling . '}';
			}
		}

		if( $atts['currency_styling']['selected'] == 'yes' ) {
			// currency styling
			$currency_styling = vispa_get_shortcode_advanced_styles( $atts['currency_styling']['yes']['font'] );
			if( !empty($currency_styling) ) {
				$final_styles .= '.fw-pricing.sh-' . $atts['unique_id'] . ' .price .price-currency {'.$currency_styling.'}';
			}

			// responsive currency styling
			$responsive_currency_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['currency_styling']['yes']['font'], 'selector' => '.fw-pricing.sh-' . $atts['unique_id'] . ' .price .price-currency' ) );
			if ( !empty($responsive_currency_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_currency_styling . '}';
			}
		}

		if( $atts['rows_styling']['selected'] == 'yes' ) {
			// rows styling
			$rows_styling = vispa_get_shortcode_advanced_styles( $atts['rows_styling']['yes']['font'] );
			if( !empty($rows_styling) ) {
				$final_styles .= '.fw-pricing.sh-' . $atts['unique_id'] . '.card-price .text-description {'.$rows_styling.'}';
			}

			// responsive rows styling
			$responsive_rows_styling = vispa_responsive_heading_styles( array( 'styles' => $atts['rows_styling']['yes']['font'], 'selector' => '.fw-pricing.sh-' . $atts['unique_id'] . '.card-price .text-description' ) );
			if ( !empty($responsive_rows_styling) ) {
				$final_styles .= '@media(max-width:767px){' . $responsive_rows_styling . '}';
			}
		}

		if ( empty($final_styles) ) {
			return;
		}

		wp_add_inline_style( 'style', $final_styles );
	}
	add_action( 'fw_ext_shortcodes_enqueue_static:pricing_table', '_vispa_action_shortcode_pricing_table_enqueue_dynamic_css' );
endif;


if (!function_exists('_vispa_action_shortcode_column_enqueue_dynamic_css')) :
	/**
	 * @internal
	 *
	 * @param array $data
	 */
	function _vispa_action_shortcode_column_enqueue_dynamic_css($data) {
		$shortcode = 'column';
		$atts = shortcode_parse_atts($data['atts_string']);
		$atts = fw_ext_shortcodes_decode_attr($atts, $shortcode, $data['post']->ID);

		$final_styles = '';
		if( !empty($atts['margin']) ) {
			$final_styles .= '.sh-'.$atts['unique_id'].' .fly-col-inner { margin: ' . $atts['margin'].';}';
		}

		if ( empty($final_styles) ) {
			return;
		}

		wp_add_inline_style( 'style', $final_styles );
	}
	add_action( 'fw_ext_shortcodes_enqueue_static:column', '_vispa_action_shortcode_column_enqueue_dynamic_css' );
endif;


if (!function_exists('_vispa_filter_special_navigation_class')):
	/**
	 * @$classes array of classes for special menu elements
	 *
	 * @param array $classes
	 * @param object $item
	 */
	function _vispa_filter_special_navigation_class($classes, $item) {
		if ($item->type == 'custom' && strpos($item->url, "#") !== false && strlen($item->url) > 1) {
			$classes[] = 'anchor';
		}
		return $classes;
	}
	add_filter('nav_menu_css_class', '_vispa_filter_special_navigation_class', 10, 2);
endif;


