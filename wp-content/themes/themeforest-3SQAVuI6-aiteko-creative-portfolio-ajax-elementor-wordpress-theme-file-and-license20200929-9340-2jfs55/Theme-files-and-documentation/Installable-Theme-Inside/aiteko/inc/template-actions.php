<?php
/**
 * Action hooks doing by the theme
 *
 * @package WordPress
 * @subpackage Aiteko
 * @since 1.0
 */

/**
 * Register the required plugins for this theme.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function aiteko_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'               => 'WIP-Themes Core',
			'slug'               => 'wip-themes-core',
			'source'             => get_parent_theme_file_path( '/inc/tgmpa/plugins/wip-themes-core.zip' ),
			'required'           => true,
			'version'            => '1.0.4',
			'force_activation'   => true,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),
		array(
			'name'     => 'Elementor Page Builder',
			'slug'     => 'elementor',
			'required' => true,
		),
		array(
			'name'     => 'One Click Demo Import',
			'slug'     => 'one-click-demo-import',
			'required' => false,
		),
		array(
			'name'     => 'Google Analytics Dashboard for WP (GADWP)',
			'slug'     => 'google-analytics-dashboard-for-wp',
			'required' => false,
		),
	);

	$config = array(
		'id'           => 'aiteko',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'aiteko_register_required_plugins' );

/**
 * Enqueue styles and scripts
 */
function aiteko_enqueue_assets() {
	// fonts.
	wp_enqueue_style( 'aiteko-fonts', aiteko_font_families(), array(), '1.0' );
	// css files.
	wp_enqueue_style( 'aiteko-global', esc_url( get_theme_file_uri( '/assets/css/site.css' ) ), array(), filemtime( get_parent_theme_file_path( '/assets/css/site.css' ) ) );
	
	aiteko_get_custom_skin_css();

	if ( is_single() ) {
		wp_enqueue_style( 'wp-mediaelement' );
		wp_enqueue_script( 'wp-mediaelement', false, array( 'jquery' ), false, true );
	}

	// scripts.
	wp_enqueue_script( 'smooth-scrollbar-js', esc_url( get_theme_file_uri( '/assets/js/smooth-scrollbar.js' ) ), array( 'jquery' ), '1.0.1', true );
	if ( wp_script_is( 'jquery-slick', 'registered' )) { wp_enqueue_script( 'jquery-slick' ); }
	wp_enqueue_script( 'jquery-masonry' );
	wp_enqueue_script( 'pixi-js', esc_url( get_theme_file_uri( '/assets/js/pixi.min.js' ) ), array( 'jquery' ), '4.8.5', true );
	wp_enqueue_script( 'jarallax-js', esc_url( get_theme_file_uri( '/assets/js/jarallax.min.js' ) ), array( 'jquery' ), '1.10.6', true );
	wp_enqueue_script( 'anime-js', esc_url( get_theme_file_uri( '/assets/js/anime.min.js' ) ), array( 'jquery' ), '2.2.0', true );
	wp_enqueue_script( 'magnific-popup-js', esc_url( get_theme_file_uri( '/assets/js/magnific-popup.min.js' ) ), array( 'jquery' ), '1.1.0', true );
	wp_enqueue_script( 'aiteko-js-global', esc_url( get_theme_file_uri( '/assets/js/global.js' ) ), array( 'jquery', 'jquery-masonry', 'pixi-js', 'anime-js', 'magnific-popup-js' ), filemtime( get_parent_theme_file_path( '/assets/js/global.js' ) ), true );
	// threaded comment script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'aiteko_enqueue_assets' );

if ( function_exists( 'wip_themes_core_add_custom_post_type' ) ) :
	/**
	 * Add portfolio custom post type
	 *
	 * @since 1.0
	 */
	wip_themes_core_add_custom_post_type(
		'portfolio',
		array(
			'labels'              => array(
				'name'               => esc_html__( 'Portfolios', 'aiteko' ),
				'singular_name'      => esc_html__( 'Portfolio', 'aiteko' ),
				'menu_name'          => _x( 'Portfolios', 'Admin menu name', 'aiteko' ),
				'all_items'          => esc_html__( 'All Portfolios', 'aiteko' ),
				'add_new'            => esc_html__( 'Add New', 'aiteko' ),
				'add_new_item'       => esc_html__( 'Add New Portfolio', 'aiteko' ),
				'edit'               => esc_html__( 'Edit', 'aiteko' ),
				'edit_item'          => esc_html__( 'Edit Portfolio', 'aiteko' ),
				'new_item'           => esc_html__( 'New Portfolio', 'aiteko' ),
				'view'               => esc_html__( 'View Portfolio', 'aiteko' ),
				'view_item'          => esc_html__( 'View Portfolio', 'aiteko' ),
				'search_items'       => esc_html__( 'Search Portfolios', 'aiteko' ),
				'not_found'          => esc_html__( 'No portfolios found', 'aiteko' ),
				'not_found_in_trash' => esc_html__( 'No portfolios found in trash', 'aiteko' ),
				'parent'             => esc_html__( 'Parent portfolio', 'aiteko' )
				),
			'public'              => true,
			'show_ui'             => true,
			'capability_type'     => 'post',
			'map_meta_cap'        => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'menu_position'       => 5,
			'hierarchical'        => false,
			'rewrite'             => array( 'slug' => _x( 'portfolio', 'slug', 'aiteko' ), 'with_front' => false, 'feeds' => true ),
			'query_var'           => true,
			'supports'            => array( 'title', 'editor', 'revisions', 'thumbnail' ),
			'has_archive'         => 'portfolios',
			'show_in_rest'        => true,
			'show_in_nav_menus'   => true,
			'menu_icon'           => 'dashicons-media-interactive'
		)
	);

	// register custom taxonomy
	wip_themes_core_add_custom_taxonomies(
		'portfolio-cat',
		array(
			'post_type_for' => 'portfolio',
			'ui' => array(
				array( 'portfolio' ),
				array(
					'hierarchical' => true,
					'label' => esc_html__( 'Portfolio Categories', 'aiteko' ),
					'labels' => array(
						'name'              => esc_html__( 'Portfolio Categories', 'aiteko' ),
						'singular_name'     => esc_html__( 'Portfolio Category', 'aiteko' ),
						'menu_name'         => _x( 'Categories', 'Admin menu name', 'aiteko' ),
						'search_items'      => esc_html__( 'Search Portfolio Categories', 'aiteko'),
						'all_items'         => esc_html__( 'All Portfolio Categories', 'aiteko' ),
						'parent_item'       => esc_html__( 'Parent Portfolio Category', 'aiteko' ),
						'parent_item_colon' => esc_html__( 'Parent Portfolio Category:', 'aiteko' ),
						'edit_item'         => esc_html__( 'Edit Portfolio Category', 'aiteko' ),
						'update_item'       => esc_html__( 'Update Portfolio Category', 'aiteko' ),
						'add_new_item'      => esc_html__( 'Add New Portfolio Category', 'aiteko' ),
						'new_item_name'     => esc_html__( 'New Portfolio Category Name', 'aiteko' ),
	            	),
	            	'show_ui' => true,
	            	'query_var' => true,
	            	'show_admin_column' => true,
	            	'show_in_rest' => true,
	            	'rewrite' => array(
	            		'slug' => _x( 'portfolio-category', 'slug', 'aiteko' ),
	            		'with_front' => false,
	            		'hierarchical' => true,
	            	),
	            ),
			),
		)
	);
endif;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @return void
 */
function aiteko_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 1', 'aiteko' ),
			'id'            => 'footer-col-one',
			'description'   => esc_html__( 'Add widgets here to appear in footer column 1.', 'aiteko' ),
			'before_widget' => '<div id="%1$s" class="sidebarbox %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 2', 'aiteko' ),
			'id'            => 'footer-col-two',
			'description'   => esc_html__( 'Add widgets here to appear in footer column 2.', 'aiteko' ),
			'before_widget' => '<div id="%1$s" class="sidebarbox %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 3', 'aiteko' ),
			'id'            => 'footer-col-three',
			'description'   => esc_html__( 'Add widgets here to appear in footer column 3.', 'aiteko' ),
			'before_widget' => '<div id="%1$s" class="sidebarbox %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

}
add_action( 'widgets_init', 'aiteko_theme_widgets_init' );

/**
 * Register custom widgets
 *
 * @since 1.0.0
 */
function aiteko_register_custom_widgets_core( $widgets ) {
	$widgets = array( 'Wip_Themes_Instagram_Widget', 'Wip_Themes_FB_Likebox_Widget' );

	return $widgets;
}
add_filter( 'wip_themes_core_custom_widgets', 'aiteko_register_custom_widgets_core', 10, 1 );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Aiteko 1.0
 */
function aiteko_javascript_detection() {
	echo "<script>(function(html){'use strict';html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'aiteko_javascript_detection', 0 );

/**
 * Register custom metabox.
 * Need the core plugin to be active
 *
 * @return void
 */
function aiteko_register_portfolio_metabox() {
	if ( class_exists( 'Wip_Themes_Core_Metabox' ) ) {
		$option = array(
			'id'        => 'aiteko_metabox',
			'post_type' => 'portfolio',
			'title'     => esc_html__( 'Aiteko Options', 'aiteko' ),
			'options'   => array(
				'aiteko_portfolio_year' => array(
					'type' => 'text',
					'args' => array(
						'id'          => 'aiteko_portfolio_year',
						'label'       => esc_html__( 'Year info', 'aiteko' ),
						'description' => '',
						'default'     => '',
					),
				),
			),
		);

		new Wip_Themes_Core_Metabox( $option );
	}
}
add_action( 'init', 'aiteko_register_portfolio_metabox' );

/**
 * Register custom metabox.
 * Need the core plugin to be active
 *
 * @return void
 */
function aiteko_register_page_metabox() {
	if ( class_exists( 'Wip_Themes_Core_Metabox' ) ) {
		$option = array(
			'id'        => 'aiteko_metabox',
			'post_type' => 'page',
			'title'     => esc_html__( 'Aiteko Options', 'aiteko' ),
			'options'   => array(
				'aiteko_hide_title' => array(
					'type' => 'select',
					'args' => array(
						'id'          => 'aiteko_hide_title',
						'label'       => esc_html__( 'Hide Page Title?', 'aiteko' ),
						'description' => esc_html__( 'Elementor have an option to hide the title, but it uses javascript. Use this option to prevent any issue with the page title.', 'aiteko' ),
						'default'     => 'no',
						'options'     => array(
							'no' => esc_html__( 'No', 'aiteko' ),
							'yes' => esc_html__( 'Yes', 'aiteko' ),
						),
					),
				),
			),
		);

		new Wip_Themes_Core_Metabox( $option );
	}
}
add_action( 'init', 'aiteko_register_page_metabox' );

/**
 * Adds post loop open wrap
 *
 * @since 1.0
 */
function aiteko_before_post_loop() {
	print '<div class="post-grids">' . "\n";
	print '<div class="post-grid-sizer"></div>' . "\n";
}
add_action( 'aiteko_before_post_loop', 'aiteko_before_post_loop' );

/**
 * Adds post loop close wrap
 *
 * @since 1.0
 */
function aiteko_after_post_loop() {
	print '</div><!-- .post-grids -->' . "\n";
}
add_action( 'aiteko_after_post_loop', 'aiteko_after_post_loop' );

/**
 * Adds portfolio loop open wrap
 *
 * @since 1.0
 */
function aiteko_before_portfolio_loop() {
	if ( 'grid' === aiteko_get_portfolio_loop_style() ) {
		print '<div class="portfolio-grids">' . "\n";
		print '<div class="portfolio-grid-sizer"></div>' . "\n";
	}
}
add_action( 'aiteko_before_portfolio_loop', 'aiteko_before_portfolio_loop' );

/**
 * Adds portfolio loop close wrap
 *
 * @since 1.0
 */
function aiteko_after_portfolio_loop() {
	if ( 'grid' === aiteko_get_portfolio_loop_style() ) {
		print '</div><!-- .portfolio-grids -->' . "\n";
	}
}
add_action( 'aiteko_after_portfolio_loop', 'aiteko_after_portfolio_loop' );

if ( ! function_exists( 'aiteko_place_loader' ) ) :
	/**
	 * Adds a placeholder for first time loading the page
	 * Javascript will only call this on first page / refresh
	 *
	 * @since version 1.0
	 */
	function aiteko_place_loader() {
		if ( aiteko_preloader_is_active() ) {
			print '<div id="aiteko-site-loader" class="aiteko-site-loader"><span class="asl-before"></span><span class="asl-after"></span><span class="aiteko-load-line"></span><span class="aiteko-load-text">0%</span></div>';
		}
	}
endif;
add_action( 'aiteko_before_header', 'aiteko_place_loader' );

if ( ! function_exists( 'aiteko_before_search_loop' ) ) :
	/**
	 * Adds wrapper for search results loop
	 *
	 *	@since 1.0.0
	 */
	function aiteko_before_search_loop() {
		print '<div class="search-loop-contain">' . "\n";
	}
endif;
add_action( 'aiteko_before_search_loop', 'aiteko_before_search_loop' );

if ( ! function_exists( 'aiteko_after_search_loop' ) ) :
	/**
	 * Adds close div wrapper for search results loop
	 *
	 *	@since 1.0.0
	 */
	function aiteko_after_search_loop() {
		print '</div>' . "\n";
	}
endif;
add_action( 'aiteko_after_search_loop', 'aiteko_after_search_loop' );

if ( ! function_exists( 'aiteko_place_page_transition_divs' ) ) :
	/**
	 * Adds divs for page transition purpose
	 *
	 * @since version 1.0
	 */
	function aiteko_place_page_transition_divs() {
		print '<div id="aiteko--ptpre"></div><div id="aiteko--pt0"></div><div id="aiteko--pt1"></div>';
	}
endif;
add_action( 'wp_footer', 'aiteko_place_page_transition_divs' );

if ( ! function_exists( 'aiteko_place_searchform' ) ) {
	/**
	 * Adds a searchform to the footer
	 * Javascript will call this elements on search button click
	 *
	 * @since version 1.0
	 */
	function aiteko_place_searchform() {
		print '<div id="aiteko-search-form"><div class="aiteko--search">' . get_search_form( false ) . '<a class="aiteko--close-search-form" href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M278.6 256l68.2-68.2c6.2-6.2 6.2-16.4 0-22.6-6.2-6.2-16.4-6.2-22.6 0L256 233.4l-68.2-68.2c-6.2-6.2-16.4-6.2-22.6 0-3.1 3.1-4.7 7.2-4.7 11.3 0 4.1 1.6 8.2 4.7 11.3l68.2 68.2-68.2 68.2c-3.1 3.1-4.7 7.2-4.7 11.3 0 4.1 1.6 8.2 4.7 11.3 6.2 6.2 16.4 6.2 22.6 0l68.2-68.2 68.2 68.2c6.2 6.2 16.4 6.2 22.6 0 6.2-6.2 6.2-16.4 0-22.6L278.6 256z"/></svg></a></div></div>';
	}
}
add_action( 'wp_footer', 'aiteko_place_searchform' );

/**
 * Adds social share buttons in single post
 *
 * @since 1.0.0
 */
function aiteko_append_social_shares_post() {
	aiteko_the_social_sharing_buttons();
}
add_action( 'aiteko_after_single_entry', 'aiteko_append_social_shares_post', 10 );

/**
 * Adds author box info in single post
 *
 * @since 1.0.0
 */
function aiteko_append_author_box() {
	if ( aiteko_post_author_box() ) {
		if ( '' !== get_theme_mod( 'show_author_box', true ) || is_customize_preview() ) {
			// customizer placeholder, not really shown in actual site.
			if ( is_customize_preview() ) {
				$relhiden = ( '' === get_theme_mod( 'show_author_box', true ) ? 'display:none;' : '' );
				print '<div id="author_box_customization" style="' . esc_attr( $relhiden ) . '">';
			}
			print aiteko_post_author_box();
			if ( is_customize_preview() ) {
				print '</div>';
			}
		}
	}
}
add_action( 'aiteko_after_single_entry', 'aiteko_append_author_box', 15 );

/**
 * Filters the comment field.
 *
 * @param array $fields The comment form fields.
 * @return array
 */
function aiteko_comment_form_field( $fields ) {
	$replace_comment = esc_html__( 'Write a response', 'aiteko' );

	$fields['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" placeholder="' . esc_attr( $replace_comment ) . '" aria-required="true"></textarea></p>';

	return $fields;
}
add_filter( 'comment_form_defaults', 'aiteko_comment_form_field' );

/**
 * Some dynamic div handlers
 *
 * @since 1.0.0
 */
function aiteko_stretched_container_fixes() {
	?>
<script>
	jQuery( function( $ ) {
		"use strict";
		var reszz = function() {
			var mW = $('.aiteko-main').width(),
				aIt = $('.aiteko-the-content').width(),
				lft = (mW - aIt)/2 ;

			$('.alignfull').each(function(){
				var x=this, dstyle=$(x).data('dstyle');
				if ( typeof dstyle !== 'undefined' ) {
					$(x).attr('style', dstyle);
				}
				$(x).css({ width : mW+'px', marginLeft: -1*lft+'px' });
			});

			$('.elementor-section-stretched').each(function(){
				var x=this, dstyle=$(x).data('dstyle');
				if ( typeof dstyle !== 'undefined' ) {
					$(x).attr('style', dstyle);
				}
				$(x).css({ width : mW+'px', left: -1*lft+'px' });
			});

			$('.alignwide').each(function(){
				var x=this, dstyle=$(x).data('dstyle');
				$(x).removeAttr('style');
				if ( typeof dstyle !== 'undefined' ) {
					$(x).attr('style', dstyle);
				}
				if ( lft > 50 ) {
					$(x).css({ width : (aIt+lft)+'px', marginLeft: -1*(lft/2)+'px' });
				}
			});
		}, resxx = function() {
			$('.alignfull, .elementor-section-stretched').each(function() {
				var dstyle = $(this).attr('style');
				$(this).data('dstyle', dstyle);
			});
			$('.alignwide').each(function() {
				var dstyle = $(this).attr('style');
				$(this).data('dstyle', dstyle);
			});
			reszz();
		};

		$(window).on( 'load', function() {
			var hgh = $(window).height();
			resxx();
		}).on('resize', function() {
			reszz();
		});
	});
</script>
	<?php
}
add_action( 'wp_footer', 'aiteko_stretched_container_fixes' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since 1.0
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function aiteko_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'aiteko_widget_tag_cloud_args' );

/**
 * Filters the default archive titles.
 *
 * @param string $title Default archive title.
 * @return string new description
 */
function aiteko_archive_title( $title ) {
	if ( is_category() ) {
		$title = '<span class="shadowed">' . esc_html__( 'Category', 'aiteko' ) . '</span>' . single_term_title( '', false );
	} elseif ( is_tag() ) {
		$title = '<span class="shadowed">' . esc_html__( 'Tag archives', 'aiteko' ) . '</span>' . single_term_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="shadowed">' . esc_html__( 'Posts by', 'aiteko' ) . '</span>' . get_the_author_meta( 'display_name' );
	} elseif ( is_year() ) {
		$title = '<span class="shadowed">' . esc_html__( 'Yearly Archives', 'aiteko' ) . '</span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'aiteko' ) );
	} elseif ( is_month() ) {
		$title = '<span class="shadowed">' . esc_html__( 'Monthly Archives', 'aiteko' ) . '</span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'aiteko' ) );
	} elseif ( is_day() ) {
		$title = '<span class="shadowed">' . esc_html__( 'Daily Archives', 'aiteko' ) . '</span>' . get_the_date();
	} elseif ( is_post_type_archive() ) {
		$title = '<span class="shadowed">' . esc_html__( 'Post Type Archives', 'aiteko' ) . '</span>' . post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: %s: Taxonomy singular name */
		$title = sprintf( esc_html__( '%s Archives:', 'aiteko' ), $tax->labels->singular_name );
	} else {
		$title = esc_html__( 'Archives:', 'aiteko' );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'aiteko_archive_title' );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function aiteko_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'aiteko_excerpt_more' );

/**
 * Filter the excerpt length.
 *
 * @param int $length default excerpt length.
 * @return int new excerpt length.
 */
function aiteko_excerpt_length( $length ) {
	return 45;
}
add_filter( 'excerpt_length', 'aiteko_excerpt_length', 999 );

/**
 * Javascript preloader helper
 *
 * @since 1.0.0
 */
function aiteko_call_site_preloader() {
	if ( class_exists( 'Wip_Themes_Core' ) ) {
		if ( aiteko_preloader_is_active() ) :
	print '
<script>
"use strict";
if( typeof Pace === "object" ) {
	var aitekoRender = false;
	Pace.once("start", function(e){
	    var prog = document.querySelector(".aiteko-load-line"),stat = document.querySelector(".aiteko-load-text"),tot = 100,cprog = 0,progper = 0;
		aitekoRender = window.setInterval(function(){
			progper = parseInt(Pace.bar.progress);
			if ( progper > cprog ) {
				prog.style.height = progper+"%";
				stat.innerHTML = progper+"%";
				cprog = progper;
			}
		},10);
	});
	Pace.once("done", function(e){
		if ( aitekoRender ) {
			document.querySelector(".aiteko-load-text").innerHTML = "100%";
			clearInterval(aitekoRender);			
		}
	});
	jQuery(window).one("load",function(){
		if ( aitekoRender ) {
			document.querySelector(".aiteko-load-text").innerHTML = "100%";
			clearInterval(aitekoRender);
			aitekoRender = false;
		}
		jQuery(window).trigger("aitekoDoneLoad");
	});
}
</script>
<script>
/* <![CDATA[ */
window.paceOptions = {restartOnRequestAfter: false,restartOnPushState: false,startOnPageLoad: false};
/* ]]> */
</script>
	';
		else :

			print '<script>
	( function($) {
		"use strict";
		jQuery(window).one("load",function(){
			$(window).trigger("aitekoDoneLoad");
		});
	})(window.jQuery);
	</script>';	
		
		endif;
	
	} else {
		print '<script>
( function($) {
	"use strict";
	jQuery(window).one("load",function(){
		$(window).trigger("aitekoDoneLoad");
	})
})(window.jQuery);
</script>';
	}
}
add_action( 'wp_head', 'aiteko_call_site_preloader', 99 );

/**
 * Compile the custom css skin,
 * running right after all customization is saved
 *
 * @param object $wp_customize WordPress Customize object.
 * @since 1.0
 * @return void
 */
function aiteko_customizer_finish_compile( $wp_customize ) {
	// Refresh content editor css version.
	remove_theme_mod( 'aiteko_editor_cache_action' );

	// Only run if core plugin is active.
	if ( class_exists( 'Wip_Themes_Core' ) ) {
		$module = new Aiteko_Skin_Loader();
		$module->take_action();
	}
}
add_action( 'customize_save_after', 'aiteko_customizer_finish_compile' );

/**
 * Add a placeholder for customizer preview
 *
 * @since 1.0
 */
function aiteko_print_css_placeholder() {
	if ( is_customize_preview() ) {
		print '<style id="aiteko-customizer-custom-css" type="text/css"></style>';
	}
}
add_action( 'wp_head', 'aiteko_print_css_placeholder', 999 );

/**
 * Filtering the custom logo output.
 *
 * @since version 1.0
 */
function aiteko_get_custom_logo( $html, $blog_id ) {
	if ( '' === $html ) {
		$html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
			esc_url( home_url( '/' ) ),
			'<img src="' . get_theme_file_uri( '/assets/images/logo.png' ) . '" srcset="' . get_theme_file_uri( '/assets/images/logo-2x.png' ) . ' 2x" class="custom-logo" itemprop="logo" alt="' . esc_attr( get_bloginfo( 'description' ) ) . '" />'
		);
	} elseif ( is_customize_preview() ) {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		if ( ! $custom_logo_id ) {
			$html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
				esc_url( home_url( '/' ) ),
				'<img src="' . get_theme_file_uri( '/assets/images/logo.png' ) . '" srcset="' . get_theme_file_uri( '/assets/images/logo-2x.png' ) . ' 2x" class="custom-logo" itemprop="logo" alt="' . esc_attr( get_bloginfo( 'description' ) ) . '" />'
			);
		} else {
			$image = wp_get_attachment_url( $custom_logo_id );
			$html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
				esc_url( home_url( '/' ) ),
				'<img src="' . esc_url( $image ) . '" class="custom-logo" itemprop="logo" alt="' . esc_attr( get_bloginfo( 'description' ) ) . '" />'
			);
		}
	} else {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$image = wp_get_attachment_url( $custom_logo_id );
		$html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
			esc_url( home_url( '/' ) ),
			'<img src="' . esc_url( $image ) . '" class="custom-logo" itemprop="logo" alt="' . esc_attr( get_bloginfo( 'description' ) ) . '" />'
		);	
	}

	return $html;
}
add_filter( 'get_custom_logo', 'aiteko_get_custom_logo', 10, 2 );
