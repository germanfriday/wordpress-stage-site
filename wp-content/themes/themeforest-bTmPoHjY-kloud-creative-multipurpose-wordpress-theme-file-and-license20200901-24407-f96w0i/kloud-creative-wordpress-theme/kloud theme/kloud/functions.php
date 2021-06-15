<?php
	/* Define THEME */
	if (!defined('URI_PATH')) define('URI_PATH', get_template_directory_uri());
	if (!defined('ABS_PATH')) define('ABS_PATH', get_template_directory());
	if (!defined('URI_PATH_FR')) define('URI_PATH_FR', URI_PATH.'/framework');
	if (!defined('ABS_PATH_FR')) define('ABS_PATH_FR', ABS_PATH.'/framework');
	if (!defined('URI_PATH_ADMIN')) define('URI_PATH_ADMIN', URI_PATH_FR.'/admin');
	if (!defined('ABS_PATH_ADMIN')) define('ABS_PATH_ADMIN', ABS_PATH_FR.'/admin');
	/* Frameword functions */

	/* Theme Options */
    if (!function_exists('jws_theme_filtercontent')) {
	function jws_theme_filtercontent($variable){
		return $variable;
	}
    }
    require_once ABS_PATH . '/framework_option/cs-framework.php';
    require_once (ABS_PATH_ADMIN.'/index.php');
    /* Function for Framework */
	require_once ABS_PATH_FR . '/includes.php';
	/* Widgets */
    if(function_exists('insert_widgets')) {
       require_once ABS_PATH_FR.'/widgets/abstract-widget.php';
	require_once ABS_PATH_FR.'/widgets/widgets.php'; 
    }
    /* Woo commerce function */
    if (class_exists('Woocommerce')) {
    require_once ABS_PATH . '/woocommerce/wc-template-function.php';
    require_once ABS_PATH . '/woocommerce/wc-template-hooks.php';
    }
    /* Function for OCDI */
    function _kloud_filter_fw_ext_backups_demos($demos)
	{
		$demos_array = array(
			'kloud' => array(
				'title' => esc_html__('Kloud Demo', 'kloud'),
				'screenshot' => 'http://gavencreative.com/import_demo/kloud/screenshot.jpg',
				'preview_link' => 'http://kloud.jwsuperthemes.com',
			),
		);
        $download_url = 'http://gavencreative.com/import_demo/kloud/download-script/';
		foreach ($demos_array as $id => $data) {
			$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
				'url' => $download_url,
				'file_id' => $id,
			));
			$demo->set_title($data['title']);
			$demo->set_screenshot($data['screenshot']);
			$demo->set_preview_link($data['preview_link']);
			$demos[$demo->get_id()] = $demo;
			unset($demo);
		}
		return $demos;
	}
    add_filter('fw:ext:backups-demo:demos', '_kloud_filter_fw_ext_backups_demos');
	/* Register Sidebar */
	if (!function_exists('jwstheme_RegisterSidebar')) {
		function jwstheme_RegisterSidebar(){
			global $jwstheme_options;
            register_sidebar(array(
			'name' => __('Sidebar Filter Shop Top', 'kloud'),
			'id' => 'jws-filter-shhop-color',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
			));
            register_sidebar(array(
			'name' => __('Sidebar Filter Shop Left And Right', 'kloud'),
			'id' => 'jws-filter-shhop-left-right',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
			));
            register_sidebar(array(
			'name' => __('Sidebar Blog', 'kloud'),
			'id' => 'jws-sidebar-blog',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
			));
            register_sidebar(array(
			'name' => __('Sidebar Remove Filter', 'kloud'),
			'id' => 'jws-sidebar-remove',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
			));
            register_sidebar(array(
			'name' => __('Sidebar Shop Detail', 'kloud'),
			'id' => 'jws-sidebar-shop-detail',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
			));
		}
	}
	add_action( 'widgets_init', 'jwstheme_RegisterSidebar' );
    /**
     * Get all registered sidebars.
     *
     * @return  array
     */
        function jws_get_sidebars() {
        	global $wp_registered_sidebars;
        
        	// Get custom sidebars.
        	$custom_sidebars = get_option( 'kloud_custom_sidebars' );
        
        	// Prepare output.
        	$output = array();
        
        	$output[] = esc_html__( 'Select a sidebar', 'kloud' );
        
        	if ( ! empty( $wp_registered_sidebars ) ) {
        		foreach ( $wp_registered_sidebars as $sidebar ) {
        			$output[ $sidebar['id'] ] = $sidebar['name'];
        		}
        	}
        
        	if ( ! empty( $custom_sidebars ) ) {
        		foreach ( $custom_sidebars as $sidebar ) {
        			$output[ $sidebar['id'] ] = $sidebar['name'];
        		}
        	}
        
        
        	return $output;
       }
	/* Enqueue Script */
	function jwstheme_enqueue_scripts() {
        // Google font
    	wp_enqueue_style( 'jws-font-google', jws_kloud_google_font_url() );
		/* Start Css jws */   
         wp_enqueue_style( 'boostrap', URI_PATH.'/assets/css/bootstrap.min.css', false );
        wp_enqueue_style( 'jwss_preset', URI_PATH.'/assets/css/presets/default.css', false );
        wp_enqueue_style( 'icon', URI_PATH.'/assets/css/ionicons.min.css', false );
        wp_enqueue_style( 'pe', URI_PATH.'/assets/css/font-pe.css', false );
        wp_enqueue_style( 'hover', URI_PATH.'/assets/css/hover.css', false );
        wp_enqueue_style( 'animate', URI_PATH.'/assets/css/css_jws/animate.css', false );
        wp_enqueue_style( 'jws_slick_css', URI_PATH.'/assets/css/slick.css', false );
        wp_enqueue_script( 'modernizr', URI_PATH.'/assets/js/dev/modernizr-2.8.3.min.js', array('jquery'), '', true  );
        wp_enqueue_script( 'slick', URI_PATH.'/assets/js/dev/slick.min.js', array('jquery'), '', true  );
        wp_enqueue_script( 'waypoints', URI_PATH.'/assets/js/dev/waypoints.min.js', array('jquery'), '', true  );
        wp_enqueue_script('imagesloaded');
        wp_enqueue_script( 'lazyload', URI_PATH.'/assets/js/dev/lazyload.js', array('jquery'), '', true  );
        wp_enqueue_script( 'menu-sticky', URI_PATH.'/assets/js/dev/menu-sticky.js', array('jquery'), '', true  );
        wp_enqueue_script( 'instagram', URI_PATH.'/assets/js/dev/instafeed.js', array('jquery'), '', true  );     
        wp_enqueue_script( 'jquery.countdown.min', URI_PATH.'/assets/js/dev/jquery.countdown.min.js', array('jquery'), '', true  );    
        wp_enqueue_script( 'tope-js', URI_PATH.'/assets/js/dev/isotope.js', array('jquery'), '', true  );
        wp_enqueue_script( 'packery', URI_PATH.'/assets/js/dev/packery.js', array('jquery'), '', true  );
        wp_enqueue_script( 'shortcode-js', URI_PATH.'/assets/js/dev/shortcode_theme.js', array('jquery'), '', true  );
        wp_enqueue_script( 'scroll', URI_PATH.'/assets/js/dev/scoll.js', array('jquery'), '', true  );
        /*Css Inline*/
		wp_enqueue_style( 'jws-kloud-style', get_stylesheet_uri() );
		wp_add_inline_style( 'jws-kloud-style', jws_theme_custom_css() );
        $script_name = 'wc-add-to-cart-variation';
    	if ( wp_script_is( $script_name, 'registered' ) && ! wp_script_is( $script_name, 'enqueued' ) ) {
    		wp_enqueue_script( $script_name );
    	}
        /* End Css jws */
        /*Woocomerce*/
        wp_enqueue_script( 'cartparent', URI_PATH.'/assets/js/dev/woocomerce/ajax_mn_parent.js', array('jquery'), '', true  );
        wp_enqueue_script( 'addtocart', URI_PATH.'/assets/js/dev/woocomerce/ajax_mn_addtocart.min.js', array('jquery'), '', true  );
        wp_enqueue_script( 'cart', URI_PATH.'/assets/js/dev/woocomerce/ajax_mn_cart.js', array('jquery'), '', true  );
        wp_enqueue_script( 'laodmore', URI_PATH.'/assets/js/dev/woocomerce/ajax_mn_load-more.js', array('jquery'), '', true  );
        wp_enqueue_script( 'cartsingle', URI_PATH.'/assets/js/dev/woocomerce/ajax_mn_single.js', array('jquery'), '', true  );
        wp_enqueue_script( 'action', URI_PATH.'/assets/js/dev/woocomerce/star_cart.js', array('jquery'), '', true  );
        wp_enqueue_script( 'main-js', URI_PATH.'/assets/js/dev/main.js', array('jquery'), '', true  );
        wp_enqueue_script( 'boostrapjs', URI_PATH.'/assets/js/bootstrap.min.js', array('jquery'), '', true  );
        wp_localize_script( 'main-js', 'MS_Ajax', array(
            'ajaxurl'       => admin_url( 'admin-ajax.php' ),
            'nextNonce'     => wp_create_nonce( 'myajax-next-nonce' ))
        );
        if( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1) ) {
        wp_enqueue_script( 'comment-reply', 'wp-includes/js/comment-reply', array(), false, true );
        }
	}
	add_action( 'wp_enqueue_scripts', 'jwstheme_enqueue_scripts' );
        function deregister_styles() {
            wp_deregister_style( 'animate-css');
        }
    add_action( 'wp_print_styles', 'deregister_styles', 100 );
	/* Init Functions */
    $less = cs_get_option('golobal-enable-less'); if($less == "1") {
      	function jwstheme_init() {
    		require_once ABS_PATH_FR.'/presets.php';
    	}
    	add_action( 'init', 'jwstheme_init' );  
    }
    if (!function_exists('_kloud_deactivate_plugins')){
        function _kloud_deactivate_plugins() {
            deactivate_plugins(array(
                'brizy/brizy.php'
            ));        
        }
    }
    add_action( 'admin_init', '_kloud_deactivate_plugins' );
    if ( ! isset( $content_width ) ) $content_width = 900;