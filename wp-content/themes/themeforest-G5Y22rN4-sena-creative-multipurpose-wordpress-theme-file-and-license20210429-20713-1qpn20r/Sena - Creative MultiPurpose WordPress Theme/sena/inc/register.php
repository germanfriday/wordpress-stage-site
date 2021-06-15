<?php
class Sena_Init {
	
	// Import demo content
	public static function sena_import_demo( ) {
		return array(
			array(
				'import_file_name'			=> 	'Sena Demo Content',
				'import_file_url' 			=> 	esc_url( get_template_directory_uri() . '/demo/sena.wordpress.xml' ),
                'import_widget_file_url'    =>  esc_url( get_template_directory_uri() . '/demo/sena.widgets.wie' )
            ),
		);
	}
	
	// After import demo
	public static function sena_after_import_demo( ) {
		// Import site sections
		if ( class_exists( 'Sena_Admin' ) ) {
			Sena_Admin::sena_one_click_import( esc_url( get_template_directory_uri() . '/demo/sena.sections.json' ) );
		}
		
		// Assign quick menu location
		$primary_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
		
		set_theme_mod( 'nav_menu_locations' , array(
            'header-menu' => $primary_menu->term_id
        ));
	}
	
	// JavaScript files
	public static function sena_scripts( ) {
		global $sena_config;
		
		if ( ! is_admin( ) ) {
			// Plugins
			wp_enqueue_script( 'bootstrap', 			get_template_directory_uri( ) . '/layout/plugins/bootstrap/js/bootstrap.min.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'retina', 				get_template_directory_uri( ) . '/layout/plugins/retina/retina.min.js', array( ), false, true );
			wp_enqueue_script( 'scrollto', 				get_template_directory_uri( ) . '/layout/plugins/scrollto/jquery.scrollto.min.js', array( ), false, true );
			wp_enqueue_script( 'parallax', 				get_template_directory_uri( ) . '/layout/plugins/parallax/jquery.parallax.min.js', array( ), false, true );
			wp_enqueue_script( 'owlcarousel', 			get_template_directory_uri( ) . '/layout/plugins/owlcarousel/owl.carousel.min.js', array( ), false, true );
			wp_enqueue_script( 'slick', 				get_template_directory_uri( ) . '/layout/plugins/slick/slick.js', array( ), false, true );
			wp_enqueue_script( 'isotope', 				get_template_directory_uri( ) . '/layout/plugins/isotope/isotope.pkgd.min.js', array( ), false, true );
			wp_enqueue_script( 'waitforimages', 		get_template_directory_uri( ) . '/layout/plugins/waitforimages/jquery.waitforimages.min.js', array( ), false, true );
			wp_enqueue_script( 'nav', 					get_template_directory_uri( ) . '/layout/plugins/nav/jquery.nav.min.js', array( ), false, true );
			wp_enqueue_script( 'knob', 					get_template_directory_uri( ) . '/layout/plugins/knob/jquery.knob.min.js', array( ), false, true );
			wp_enqueue_script( 'waypoints', 			get_template_directory_uri( ) . '/layout/plugins/waypoints/waypoints.min.js', array( ), false, true );
			wp_enqueue_script( 'counterup', 			get_template_directory_uri( ) . '/layout/plugins/counterup/jquery.counterup.min.js', array( ), false, true );
			wp_enqueue_script( 'wow', 					get_template_directory_uri( ) . '/layout/plugins/wow/wow.min.js', array( ), false, true );
			wp_enqueue_script( 'mbytplayer', 			get_template_directory_uri( ) . '/layout/plugins/ytplayer/jquery.mb.ytplayer.min.js', array( ), false, true );
			
			// Google Maps
			if ( $sena_config['google-map-api'] != '' ) {
				wp_enqueue_script( 'google-maps',		'//maps.googleapis.com/maps/api/js?key=' . esc_attr( $sena_config['google-map-api'] ), array( ), false, true );
			}
			
			// Main
			wp_enqueue_script( 'sena-main', 			get_template_directory_uri( ) . '/layout/js/main.js', array( ), false, true );
			
			// Add parameters for main
			wp_localize_script('sena-main', 'js_load_parameters',
				array(
					'theme_default_path' => get_template_directory_uri(),
					'theme_site_url' => get_home_url()
				)
			);

			if ( is_singular( ) && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( "comment-reply" );
			}
			
			if ( isset( $sena_config ) and $sena_config['settings'] ) {
				wp_enqueue_script( 'cookie', 			get_template_directory_uri( ) . '/layout/plugins/settings/jquery.cookies.min.js', array( ), false, true );
				wp_enqueue_script( 'sena-settings', 	get_template_directory_uri( ) . '/layout/plugins/settings/settings.js', array( ), false, true );
			}
		} else {
			$currentPage = ( isset( $_GET['page'] ) ) ? $_GET['page'] : '';

			if ( $currentPage == 'site-sections' or
				 $currentPage == 'portfolio-reorder' or
				 $currentPage == 'clients-reorder' or
				 isset( $_GET['post'] )
				) {
					wp_enqueue_media( );
					wp_enqueue_script( 'jquery-ui-core' );
					wp_enqueue_script( 'jquery-ui-dropable' );
					wp_enqueue_script( 'jquery-ui-dragable' );
					wp_enqueue_script( 'jquery-ui-sortable', 'jquery' );
			}
            
		    wp_enqueue_script( 'sena-admin', 			get_template_directory_uri( ) . '/admin/js/admin.js', array( ), false, true );
		}
	}

	// CSS files
	public static function sena_styles( ) {
		global $sena_config;

		if ( ! is_admin( ) ) {
			wp_enqueue_style( 'bootstrap', 					get_template_directory_uri( ) . '/layout/plugins/bootstrap/css/bootstrap.min.css' );
			wp_enqueue_style( 'font-awesome', 				get_template_directory_uri( ) . '/layout/plugins/fontawesome/css/all.min.css' );
			wp_enqueue_style( 'linea-arrows', 				get_template_directory_uri( ) . '/layout/plugins/linea/arrows/styles.css' );
			wp_enqueue_style( 'linea-basic', 				get_template_directory_uri( ) . '/layout/plugins/linea/basic/styles.css' );
			wp_enqueue_style( 'linea-basic-elaboration', 	get_template_directory_uri( ) . '/layout/plugins/linea/basic_elaboration/styles.css' );
			wp_enqueue_style( 'linea-ecommerce', 			get_template_directory_uri( ) . '/layout/plugins/linea/ecommerce/styles.css' );
			wp_enqueue_style( 'linea-music', 				get_template_directory_uri( ) . '/layout/plugins/linea/music/styles.css' );
			wp_enqueue_style( 'linea-software', 			get_template_directory_uri( ) . '/layout/plugins/linea/software/styles.css' );
			wp_enqueue_style( 'linea-weather', 				get_template_directory_uri( ) . '/layout/plugins/linea/weather/styles.css' );
			wp_enqueue_style( 'sena-style', 				get_template_directory_uri( ) . '/layout/style.css' );
			wp_enqueue_style( 'sena-wp-style', 				get_template_directory_uri( ) . '/style.css' );
			wp_enqueue_style( 'sena-media', 				get_template_directory_uri( ) . '/layout/media.css' );
			wp_enqueue_style( 'sena-color-schema', 			get_template_directory_uri( ) . '/layout/colors/' . $sena_config['styling-schema'] . '.css' );
			wp_enqueue_style( 'animate', 					get_template_directory_uri( ) . '/layout/plugins/animate/animate.css' );
			wp_enqueue_style( 'owlcarousel', 				get_template_directory_uri( ) . '/layout/plugins/owlcarousel/owl.carousel.min.css' );
			wp_enqueue_style( 'slick', 						get_template_directory_uri( ) . '/layout/plugins/slick/slick.css' );
			wp_enqueue_style( 'mbytplayer', 				get_template_directory_uri( ) . '/layout/plugins/ytplayer/css/jquery.mb.ytplayer.min.css' );
			
			// Settings
			if ( isset( $sena_config ) and $sena_config['settings'] ) {
				wp_enqueue_style( 'sena-settings', 			get_template_directory_uri( ) . '/layout/plugins/settings/settings.css' );
			}
			
			// Custom font style
			$isDynamic = false;
			if ( isset( $sena_config ) ) {
				if (   ! empty( $sena_config['header-bgcolor'] ) 		&& strtolower( $sena_config['header-bgcolor'] )		!= "#000000"
					or ! empty( $sena_config['header-nav-bgcolor'] ) 	&& strtolower( $sena_config['header-nav-bgcolor'] ) != "#333333"
					or ! empty( $sena_config['body-bgcolor'] ) 			&& strtolower( $sena_config['body-bgcolor'] ) 		!= "#ffffff"
					or ! empty( $sena_config['loader-bgcolor'] )		&& strtolower( $sena_config['loader-bgcolor'] ) 	!= "#ffffff"
					or $sena_config['typography-content']['font-family']    != 'Open Sans' || intval( $sena_config['typography-content']['font-size'] )    != 14
					or $sena_config['typography-headers-h1']['font-family'] != 'Poppins'   || intval( $sena_config['typography-headers-h1']['font-size'] ) != 70
					or $sena_config['typography-headers-h2']['font-family'] != 'Poppins'   || intval( $sena_config['typography-headers-h2']['font-size'] ) != 40
					or $sena_config['typography-headers-h3']['font-family'] != 'Poppins'   || intval( $sena_config['typography-headers-h3']['font-size'] ) != 32
					or $sena_config['typography-headers-h4']['font-family'] != 'Poppins'   || intval( $sena_config['typography-headers-h4']['font-size'] ) != 24
					or $sena_config['typography-headers-h5']['font-family'] != 'Poppins'   || intval( $sena_config['typography-headers-h5']['font-size'] ) != 20
					or $sena_config['typography-headers-h6']['font-family'] != 'Poppins'   || intval( $sena_config['typography-headers-h6']['font-size'] ) != 16
				) $isDynamic = true;
			}

			if ( $isDynamic ) {
				$custom_css = Sena_Theme::sena_custom_css( );
				wp_add_inline_style( 'sena-style', $custom_css );
			}
			
			// Custom logo height
			if ( isset( $sena_config ) and ( int ) $sena_config['logo-height'] != 25 ) {
				$height = $sena_config['logo-height'];
				
				$custom_css = '.navbar .navbar-header {
									height:' . $height . 'px;
								}';
								
				wp_add_inline_style( 'sena-style', $custom_css );
			}
		} else {
			wp_enqueue_style( 'font-awesome', 				get_template_directory_uri( ) . '/layout/plugins/fontawesome/css/all.min.css' );
            wp_enqueue_style( 'linea-arrows', 				get_template_directory_uri( ) . '/layout/plugins/linea/arrows/styles.css' );
			wp_enqueue_style( 'linea-basic', 				get_template_directory_uri( ) . '/layout/plugins/linea/basic/styles.css' );
			wp_enqueue_style( 'linea-basic-elaboration', 	get_template_directory_uri( ) . '/layout/plugins/linea/basic_elaboration/styles.css' );
			wp_enqueue_style( 'linea-ecommerce', 			get_template_directory_uri( ) . '/layout/plugins/linea/ecommerce/styles.css' );
			wp_enqueue_style( 'linea-music', 				get_template_directory_uri( ) . '/layout/plugins/linea/music/styles.css' );
			wp_enqueue_style( 'linea-software', 			get_template_directory_uri( ) . '/layout/plugins/linea/software/styles.css' );
			wp_enqueue_style( 'linea-weather', 				get_template_directory_uri( ) . '/layout/plugins/linea/weather/styles.css' );
			wp_enqueue_style( 'sena-admin-style', 			get_template_directory_uri( ) . '/admin/css/admin.css' );
			wp_enqueue_style( 'sena-admin-icons',           get_template_directory_uri( ) . '/admin/themify-icons/themify-icons.css' );
		}
	}
	
	// Fix for to remove "type" attribute from JavaScript & CSS
	public static function sena_html5_support( ) {
		add_theme_support( 'html5', array('script', 'style' ) );
	}

	// Google fonts
	public static function sena_fonts( ) {
		global $sena_config;

		$fonts = array( 'typography-content', 'typography-headers-h1', 'typography-headers-h2', 'typography-headers-h3', 'typography-headers-h4', 'typography-headers-h5', 'typography-headers-h6' );
		foreach ( $fonts as $key ) {
			if ( $sena_config[$key]['font-family'] == 'Open Sans' ) {
				wp_deregister_style( 'open-sans' );
				wp_deregister_style( 'options-google-fonts' );
				break;
			}
		}

		$fonts = array( );
		for ( $i = 1; $i <= 6; $i ++ ) {
			$key = 'typography-headers-h' . $i;
			
			if ( (boolean) json_decode( $sena_config[$key]['google'] ) ) {
				$name = strtolower( str_replace( ' ', '-', $sena_config[$key]['font-family'] ) );
				if ( ! in_array( $name, $fonts ) ) {
					$fonts[] = $name;
					$google = str_replace( ' ', '+', $sena_config[$key]['font-family'] );					
					$font_url = add_query_arg( 'family', $google . urlencode( ':200,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic' ), "//fonts.googleapis.com/css" );

					wp_enqueue_style( $name, $font_url );
				}
			}
		}
		
		if ( (boolean) json_decode( $sena_config['typography-content']['google'] ) ) {
			$name = strtolower( str_replace( ' ', '-', $sena_config['typography-content']['font-family'] ) );
			
			if ( ! in_array( $name, $fonts ) ) {
				$fonts[] = $name;
				$google = str_replace( ' ', '+', $sena_config['typography-content']['font-family'] );
				$font_url = add_query_arg( 'family', $google . urlencode( ':200,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic' ), "//fonts.googleapis.com/css" );

				wp_enqueue_style( $name, $font_url );
			}
		}
	}

	// Initialization
	public static function sena_initialize( ) {
		// Removing demo mode (Redux Framework)
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_action( 'admin_notices', array( ReduxFrameworkPlugin::get_instance( ), 'admin_notices' ) );
		}

		// Register menus
		register_nav_menu( 'header-menu', esc_html__( 'Primary Menu', 'sena' ) );
	}

	// After setup theme
	public static function sena_setup( ) {
		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );
		
		// Let WordPress manage the document title
		add_theme_support( 'title-tag' );
        
        // Add WooCommerce support
        add_theme_support( 'woocommerce' );
		
		// Enable support for post thumbnails on posts and pages
		add_theme_support( 'post-thumbnails', array( 'post', 'our-clients', 'our-team', 'portfolio' ) );
		
		// Enable support for post formats
		add_theme_support( 'post-formats', array( 'gallery', 'aside', 'status', 'quote', 'link' ) );
		
		// Switch default core markups to output valid HTML5
		add_theme_support( 'html5', array( 'search-form' ) );
		
		// Set up the WordPress core custom header feature
		add_theme_support( 'custom-header' ); 
		
		// Set up the WordPress core custom background feature
		add_theme_support( 'custom-background' );
		
		// Add support for responsive embeds
		add_theme_support( 'responsive-embeds' );
		
		// Gutenberg wide and full images support
		add_theme_support( 'align-wide' );
		
		// Add custom colors to Gutenberg
		add_theme_support(
			'editor-color-palette', array(				
				array(
					'name'  => esc_html__( 'Green', 'sena' ),
					'slug' => 'green',
					'color' => '#24bca4',
				),
				array(
					'name'  => esc_html__( 'Blue', 'sena' ),
					'slug' => 'blue',
					'color' => '#4e9cb5',
				),
				array(
					'name'  => esc_html__( 'Red', 'sena' ),
					'slug' => 'red',
					'color' => '#ee8f67',
				),
				array(
					'name'  => esc_html__( 'Turquoise', 'sena' ),
					'slug' => 'turquoise',
					'color' => '#46cad7',
				),
				array(
					'name'  => esc_html__( 'Purple', 'sena' ),
					'slug' => 'purple',
					'color' => '#c86f98',
				),
				array(
					'name'  => esc_html__( 'Orange', 'sena' ),
					'slug' => 'orange',
					'color' => '#ee8f67',
				),
				array(
					'name'  => esc_html__( 'Yellow', 'sena' ),
					'slug' => 'yellow',
					'color' => '#e4d20c',
				),
				array(
					'name'  => esc_html__( 'Grey', 'sena' ),
					'slug' => 'grey',
					'color' => '#6b798f',
				),
				array(
					'name'  => esc_html__( 'Black', 'sena' ),
					'slug' => 'black',
					'color' => '#282828',
				),
				array(
					'name'  => esc_html__( 'White', 'sena' ),
					'slug' => 'white',
					'color' => '#ffffff',
				),
			)
		);
	}

	// Main menu attributes
	public static function sena_menu_atts( $atts, $item, $args = array( ) ) {
		if ( ! isset( $args->theme_location ) or $args->theme_location != 'header-menu' ) {
			return $atts;
		}

		if ( get_option( 'show_on_front', 'posts' ) == 'page' and get_option( 'page_on_front', 0 ) > 0 ) {
			$is_front_page = Sena_Theme::sena_is_front_page( get_the_ID( ) );

			if ( $is_front_page ) {
				$front_id = get_option( 'page_on_front' );
				if ( intval( $front_id ) == $item->object_id and $item->object_id == get_the_ID( ) ) {
					$atts['href'] = '#intro';
				}
			}

			if ( $item->object == 'page' ) {
				if ( $slug = self::sena_section_id( $item->object_id ) ) {
					if ( $is_front_page ) {
						$atts['href'] = '#' . $slug;
					} else {
						$atts['href'] = esc_url( home_url( '/' ) . '#' . $slug );
					}
				}
			}
		}

		return $atts;
	}

	// Main menu classes
	public static function sena_menu_classes( $classes, $item, $args ) {
		if ( ! isset( $args->theme_location ) or $args->theme_location != 'header-menu' ) {
			return $classes;
		}

		if ( in_array( 'menu-item-has-children', $classes ) ) {
			$classes[] = 'dropdown';
		}

		return $classes;
	}

	// Fallback menu
	public static function sena_menu_fallback( $menu, $args = array( ) ) {
		if ( isset( $args['sena_fallback'] ) and isset( $args['sena_class'] ) ) {
			$menu = preg_replace( '/ class="' . $args['menu_class'] . '"/', '', $menu );
			$menu = preg_replace( '/<ul>/', '<ul class="' . esc_attr( $args['sena_class'] ) . '">', $menu );
		}

		return $menu;
	}

	// Section ID on front page
	public static function sena_section_id( $post_id ) {
		$sections = ( array ) json_decode( get_option( 'sena_sections', true ), true );

		if ( count( $sections ) > 0 ) {
			$post = get_post( $post_id );
			if ( $post !== null ) {
				if ( in_array( $post->post_name, $sections['page'] ) ) {
					return $post->post_name;
				}
			}
		}

		return false;
	}

	// More link
	public static function sena_more_link( $link, $text ) {
		return str_replace( 'more-link', 'btn-read-more', $link );
	}

	// Widgets
	public static function sena_widgets( ) {
		// Blog aidebar
		register_sidebar( array(
			'name'          => esc_html__( 'Blog Sidebar', 'sena' ),
			'id'            => 'sidebar-primary',
			'description'   => esc_html__( 'Widgets in this area will be shown in the sidebar.', 'sena' ),
			'before_widget' => '<div id="%1$s" class="row sidebar widget %2$s"><div class="col-md-12 col-sm-12">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<header><h4>',
			'after_title'   => '</h4></header>'
		) );
        
        // Shop sidebar
        if ( class_exists( 'WooCommerce' ) ) {
            register_sidebar( array(
                'name'          => esc_html__( 'Shop Sidebar', 'sena' ),
                'id'            => 'sidebar-shop',
                'description'   => esc_html__( 'Widgets in this area will be shown in the sidebar.', 'sena' ),
                'before_widget' => '<div id="%1$s" class="row sidebar widget %2$s"><div class="col-md-12 col-sm-12">',
                'after_widget'  => '</div></div>',
                'before_title'  => '<header><h4>',
                'after_title'   => '</h4></header>'
            ) );
        }
		
        // Footer
		register_sidebar(array(
			'name' => esc_html__( 'Footer', 'sena' ),
			'id' => 'footer',
			'description' => esc_html__( 'Widgets in this area will be shown in the footer.', 'sena' ),
			'before_widget' => '<div id="%1$s" class="col-md-3 col-sm-6 res-margin %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		));
	}

	// Embed video
	public static function sena_embed( $source ) {
		$before = '<div class="embed-container">';
		$after = '</div>';
		
		return $before . $source . $after;
	}

	// Left link attributes (Navigation for posts & comments)
	public static function sena_nav_link_left( $atts = '' ) {
		$atts .= ( ! empty( $atts ) ? ' ' : '' ) . 'class="btn btn-default btn-prev"';
		return $atts;
	}

	// Right Link Attributes (Navigation for posts & comments)
	public static function sena_nav_link_right( $atts = '' ) {
		$atts .= ( ! empty( $atts ) ? ' ' : '' ) . 'class="btn btn-default btn-next"';
		return $atts;
	}

	// Password form (Protected posts)
	public static function sena_password_form( ) {
		global $post;
		
		return '<div class="password-form">
					<p>' . esc_html__( 'To view this protected post, enter the password below:', 'sena' ) . '</p>						
					<form class="search-form" action="' . esc_url( home_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
						<label><input name="post_password" type="password" class="search-field" size="20" maxlength="20" /></label> <input type="submit" name="Submit" class="search-submit" value="' . esc_attr__( 'Submit', 'sena' ) . '" />
					</form>
				</div>';
	}
	
	// Gutenberg editor styles
	public static function sena_editor_styles( ) {
		wp_enqueue_style( 'sena-editor-block-style', get_template_directory_uri( ) . '/layout/editor-blocks.css' );
		wp_enqueue_style( 'sena-fonts', Sena_Init::sena_fonts_url( ), array(), null );
	}
	
	// Register custom fonts
	public static function sena_fonts_url( ) {
		global $sena_config;
		
		$fonts_url = '';
	
		if ( isset( $sena_config['typography-content']['google'] ) ) {
			$font_families = array();
	
			$font_families[] = $sena_config['typography-content']['font-family'] . ':300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800';
			
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);
	
			$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		}
	
		return esc_url_raw( $fonts_url );
	}
    
    // Add a pingback url auto-discovery header for single posts, pages, or attachments
	public static function sena_pingback( ) {
		if ( is_singular( ) && pings_open( ) ) {
			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		}
	}
	
}

// Import demo
add_action( 'pt-ocdi/after_import', array( 'Sena_Init', 'sena_after_import_demo' ) );
add_filter( 'pt-ocdi/import_files', array( 'Sena_Init', 'sena_import_demo' ), 10, 3 );

// Enqueue scripts
add_action( 'wp_enqueue_scripts', array( 'Sena_Init', 'sena_fonts' ) );
add_action( 'wp_enqueue_scripts', array( 'Sena_Init', 'sena_styles' ) );
add_action( 'wp_enqueue_scripts', array( 'Sena_Init', 'sena_scripts' ) );
add_action( 'admin_enqueue_scripts', array( 'Sena_Init', 'sena_styles' ) );
add_action( 'admin_enqueue_scripts', array( 'Sena_Init', 'sena_scripts' ) );
add_action( 'after_setup_theme', array( 'Sena_Init', 'sena_html5_support' ) );

// Init
add_action( 'init', array( 'Sena_Init', 'sena_initialize' ) );
add_action( 'after_setup_theme', array( 'Sena_Init', 'sena_setup' ) );
add_action( 'widgets_init', array( 'Sena_Init', 'sena_widgets' ) );
add_action( 'the_content_more_link', array( 'Sena_Init', 'sena_more_link' ), 10, 2 );
add_filter( 'the_password_form', array( 'Sena_Init', 'sena_password_form' ) );

// Menu
add_filter( 'nav_menu_link_attributes', array( 'Sena_Init', 'sena_menu_atts' ), 10, 3 );
add_filter( 'nav_menu_css_class', array( 'Sena_Init', 'sena_menu_classes' ), 10, 3 );
add_filter( 'wp_page_menu', array( 'Sena_Init', 'sena_menu_fallback' ), 10, 2 );

// Previus / Next buttons
add_filter( 'next_posts_link_attributes', array( 'Sena_Init', 'sena_nav_link_left' ) );
add_filter( 'previous_posts_link_attributes', array( 'Sena_Init', 'sena_nav_link_right' ) );
add_filter( 'previous_comments_link_attributes', array( 'Sena_Init', 'sena_nav_link_left' ) );
add_filter( 'next_comments_link_attributes', array( 'Sena_Init', 'sena_nav_link_right' ) );

// Embed video
add_filter( 'embed_oembed_html', array( 'Sena_Init', 'sena_embed' ), 10, 3 );
add_filter( 'video_embed_html', array( 'Sena_Init', 'sena_embed' ) );

// Enqueue editor styles
add_editor_style( array( 'layout/editor-style.css', Sena_Init::sena_fonts_url( ) ) );
add_action( 'enqueue_block_editor_assets', array( 'Sena_Init', 'sena_editor_styles' ) );

// Pingback
add_action( 'wp_head', array( 'Sena_Init', 'sena_pingback' ) );




