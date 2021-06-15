<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package mifo
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function mifo_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'mifo_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function mifo_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}

add_action( 'wp_head', 'mifo_pingback_header' );

/*
Register Fonts theme google font
*/
function mifo_studio_fonts_url() {
    $font_url = '';
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'mifo' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Poppins
:300,400,500,600,600,700' ), "//fonts.googleapis.com/css" );
    }
    return $font_url;
}
/*
Enqueue scripts and styles.
*/
function mifo_studio_scripts() {
    wp_enqueue_style( 'studio-fonts', mifo_studio_fonts_url(), array(), '1.0.0');
}
add_action( 'wp_enqueue_scripts', 'mifo_studio_scripts' );


//Favicon Icon
function mifo_site_icon() {
 if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ) {     
  	global $rs_option;
  	 
  	if(!empty($rs_option['rs_favicon']['url']))
  	{?>
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url(($rs_option['rs_favicon']['url'])); ?>">	

 	<?php 
 		}
	}
}
add_filter('wp_head', 'mifo_site_icon');



//demo content file include here

function mifo_import_files() {
  return array(
    array(
      'import_file_name'           => 'Mifo Demo Import',
      'categories'                 => array( 'Category 1' ),
      'import_file_url'            => trailingslashit( get_template_directory_uri() ) . 'ocdi/mifo.wordpress.xml',
      'import_widget_file_url'     => trailingslashit( get_template_directory_uri() ) . 'ocdi/mifo.wie',      
      'import_redux'               => array(
        array(
          'file_url'    => trailingslashit( get_template_directory_uri() ) . 'ocdi/redux_options_rs_option.json',
          'option_name' => 'rs_option',
        ),
      ),
      
      'import_notice'              => __( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'mifo' ),
      
    ),
    
  );
}

add_filter( 'pt-ocdi/import_files', 'mifo_import_files' );

function mifo_after_import_setup() {
  // Assign menus to their locations.
  $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
  

  set_theme_mod( 'nav_menu_locations', array(
      'menu-1' => $main_menu->term_id,      
    )
  );

  // Assign front page and posts page (blog page).
  $front_page_id = get_page_by_title( 'Home' );
  $blog_page_id  = get_page_by_title( 'Blog' );

  update_option( 'show_on_front', 'page' );
  update_option( 'page_on_front', $front_page_id->ID );
  update_option( 'page_for_posts', $blog_page_id->ID );  
}
add_action( 'pt-ocdi/after_import', 'mifo_after_import_setup' );

