<?php
//define
define('MUTI_THEME', get_template_directory_uri(). '/functions/theme' );
define('MUTI_THEME_OPTIONS', get_template_directory_uri(). '/functions/theme/options' );
define('MUTI_THEME_WIDGET', get_template_directory_uri(). '/functions/theme/widget' );
// define('MUTI_THEME_SHORTCODES', get_template_directory_uri(). '/functions/theme/shortcodes' );
define('MUTI_THEME_IMPORTER', get_template_directory_uri(). '/functions/theme/wordpress-importer' );
define('MUTI_THEME_CUSTOMIZE', get_template_directory_uri(). '/functions/theme/customize' );

//theme scripts
function airtheme_theme_options_enqueue_scripts(){	
	// New Media Library
	if(function_exists('wp_enqueue_media')){ wp_enqueue_media(); }

	// Load default WP resources
	wp_enqueue_script('jquery-migrate');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('wp-pointer');
	wp_enqueue_style('wp-pointer');
	wp_enqueue_script('json2');
	
	
	wp_enqueue_script('jquery-ui-droppable');
	wp_enqueue_script('jquery-ui-draggable');
	
	if(!wp_script_is('ux-admin-bootstrap', 'enqueued')){
		wp_enqueue_script('airtheme-admin-bootstrap');
	}
	
	if(!wp_script_is('ux-admin-bootstrap-switch', 'enqueued')){
		wp_enqueue_script('airtheme-admin-bootstrap-switch');
	}
	
	if(!wp_script_is('ux-admin-bootstrap-datetimepicker', 'enqueued')){
		wp_enqueue_script('airtheme-admin-bootstrap-datetimepicker');
	}
	
	if(!wp_script_is('ux-admin-isotope', 'enqueued')){
		wp_enqueue_script('airtheme-admin-isotope');
	}
	
	if(!wp_script_is('ux-admin-icheck', 'enqueued')){
		wp_enqueue_script('airtheme-admin-icheck');
	}
	
	wp_enqueue_script('airtheme-admin-minicolors');
	wp_enqueue_script('airtheme-admin-theme-script');
	
	wp_enqueue_style('font-awesome-min');
	
	if(!wp_style_is('ux-admin-bootstrap', 'enqueued')){
		wp_enqueue_style('airtheme-admin-bootstrap');
	}
	
	if(!wp_style_is('ux-admin-bootstrap-theme', 'enqueued')){
		wp_enqueue_style('airtheme-admin-bootstrap-theme');
	}
	
	if(!wp_style_is('ux-admin-bootstrap-switch', 'enqueued')){
		wp_enqueue_style('airtheme-admin-bootstrap-switch');
	}
	
	if(!wp_style_is('ux-admin-bootstrap-datetimepicker', 'enqueued')){
		wp_enqueue_style('airtheme-admin-bootstrap-datetimepicker');
	}
	
	if(!wp_style_is('ux-admin-icheck', 'enqueued')){
		wp_enqueue_style('airtheme-admin-icheck');
	}
	
	wp_enqueue_style('airtheme-admin-minicolors');
	wp_enqueue_style('airtheme-admin-theme-icons');
	wp_enqueue_style('airtheme-admin-theme-style');
}
add_action('admin_enqueue_scripts','airtheme_theme_options_enqueue_scripts', 10);



//theme post type support
function airtheme_theme_support(){
	add_theme_support('title-tag');
	
	add_post_type_support('post', array('excerpt', 'comments'));
	add_post_type_support('page', 'excerpt');
	
	add_theme_support('post-formats', array('gallery', 'link', 'image', 'quote', 'audio', 'video'));
	add_theme_support('automatic-feed-links');
	add_theme_support('custom-header');
	add_theme_support('custom-background');
	add_theme_support('post-thumbnails');
	
	add_image_size('airtheme-imagebox-thumb', 400, 400, true);
	add_image_size('airtheme-standard-thumb', 650, 9999);
	add_image_size('airtheme-standard-thumb-medium', 1000, 9999);
	add_image_size('airtheme-standard-thumb-big', 2000, 9999);
	add_image_size('airtheme-image-thumb', 800, 450, true);
	add_image_size('airtheme-image-thumb-1', 650, 650, true);
	add_image_size('airtheme-thumb-43-big', 2000, 1500, true);
	add_image_size('airtheme-thumb-43-medium', 1000, 750, true);
	add_image_size('airtheme-thumb-43-small', 650, 490, true);
	add_image_size('airtheme-thumb-83-big', 2000, 750, true);
	add_image_size('airtheme-thumb-83-medium', 1000, 375, true);
	add_image_size('airtheme-thumb-83-small', 656, 246, true);
	add_image_size('airtheme-thumb-23-big', 1000, 1500, true);
	add_image_size('airtheme-thumb-23-medium', 656, 984, true);
	add_image_size('airtheme-thumb-23-small', 330, 495, true);
	
	if(!isset($content_width)) $content_width = 1220;
	$GLOBALS['ux_theme_fn_prefix'] = 'airtheme';
}
add_action('init','airtheme_theme_support');

//theme activated redirect
function airtheme_theme_init($old_theme){
  global $pagenow;

  if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
    wp_redirect( admin_url( 'themes.php?page=theme-option' ) );
    exit;
  }
}
add_action('after_switch_theme', 'airtheme_theme_init');

//require theme register
require_once get_template_directory() . '/functions/theme/theme-register.php';

//require theme options
require_once get_template_directory() . '/functions/theme/theme-options.php';

//require theme post
require_once get_template_directory() . '/functions/theme/theme-post.php';

//require theme widget
require_once get_template_directory() . '/functions/theme/theme-widget.php';

//require theme ajax
require_once get_template_directory() . '/functions/theme/theme-ajax.php';

//require theme import
require_once get_template_directory() . '/functions/theme/theme-import.php';

//require theme export
require_once get_template_directory() . '/functions/theme/theme-export.php';

//require theme customize
require_once get_template_directory() . '/functions/theme/customize/customize-options.php';

//Load wordpress importer
if(!function_exists('wordpress_importer_init')){
	require_once get_template_directory() . '/functions/theme/wordpress-importer/wordpress-importer.php';
}

//require theme nav menu
require_once get_template_directory() . '/functions/theme/theme-nav-menu.php';
?>