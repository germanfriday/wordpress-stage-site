<?php
define('MUTI_LOCAL_URL', get_template_directory_uri());
define('MUTI_INTERFACE', get_template_directory_uri(). '/functions/interface' );

// Theme Text Domain 
if(!function_exists('airtheme_theme_lang_setup')){
	add_action('after_setup_theme', 'airtheme_theme_lang_setup');
	function airtheme_theme_lang_setup(){
		$lang = get_template_directory()  . '/languages';
		load_theme_textdomain('air-theme', $lang);
	}
}

// Theme Get Template
function airtheme_get_template_part($key, $name){
	get_template_part('template/' . $key, $name);
}


//theme interface get post meta
function airtheme_get_post_meta($post_id, $key){
	$get_post_meta = get_post_meta($post_id, 'ux_theme_meta', true);
	$return = false;
	
	if($get_post_meta){
		if(isset($get_post_meta[$key])){
			if($get_post_meta[$key] != ''){
				switch($get_post_meta[$key]){
					case 'true': $return = true; break;
					case 'false': $return = false; break;
					default: $return = $get_post_meta[$key]; break;
				}
			}
		}
	}else{
		$return = airtheme_theme_post_meta_default($key);
	}
	
	return $return;
}



//theme front scripts
function airtheme_front_enqueue_scripts(){
	global $wp_styles; 
	$airtheme_logo_font = airtheme_get_option('theme_option_font_family_logo');
	$enable_text_logo   = airtheme_get_option('theme_option_enable_text_logo');
	
	//RUN CSS
	if(!wp_style_is('ux-interface-bootstrap', 'enqueued')){
		wp_enqueue_style('bootstrap');
	}
	if(!wp_style_is('ux-interface-font-awesome', 'enqueued')){
		wp_enqueue_style('font-awesome'); 
	}
	wp_enqueue_style('owl-carousel'); 
	wp_enqueue_style('google-fonts-Poppins');
	wp_enqueue_style('google-fonts-Libre+Baskerville');
	if(!wp_style_is('ux-interface-photoswipe', 'enqueued')){
		wp_enqueue_style('photoswipe');
	}
	if(!wp_style_is('ux-interface-photoswipe-default-skin', 'enqueued')){
		wp_enqueue_style('photoswipe-default-skin');
	}
	wp_enqueue_style('airtheme-interface-style');

	wp_enqueue_style( 'airtheme-interface-ie', MUTI_LOCAL_URL . "/styles/ie.css", array( 'airtheme-interface-style' )  );
    $wp_styles->add_data( 'airtheme-interface-ie', 'conditional', 'lte IE 9' );

    wp_add_inline_style('airtheme-interface-style', airtheme_theme_custom_css());

	//RUN JS
	wp_enqueue_script('jquery-jplayer-min');
	if(is_single()){
		wp_enqueue_script('airtheme-interface-sticky');
		wp_enqueue_script('comment-reply');
	}
	 
	if(!wp_script_is('ux-interface-main', 'enqueued')){
		wp_enqueue_script('airtheme-interface-main');
	}
	
	wp_enqueue_script('airtheme-interface-theme'); 
	
}
add_action('wp_enqueue_scripts', 'airtheme_front_enqueue_scripts',101);

function airtheme_front_enqueue_style_footer(){
	wp_register_style( 'airtheme-empty-style', false );
	wp_enqueue_style( 'airtheme-empty-style' );
	wp_add_inline_style('airtheme-empty-style', airtheme_theme_custom_css());
}
//add_action('get_footer', 'airtheme_front_enqueue_style_footer', 102);

//theme google font family
function airtheme_theme_options_enqueue_googlefonts(){
	$get_option = get_option('ux_theme_option'); 
	$fonts_data = array();

	$logo_font = false;
	if(isset($get_option['theme_option_font_family_logo'])){
		$logo_font = $get_option['theme_option_font_family_logo'];
		array_push($fonts_data, $logo_font);
	}

	$menu_font = false;
	if(isset($get_option['theme_option_font_family_menu_header'])){
		$menu_font = $get_option['theme_option_font_family_menu_header'];
		array_push($fonts_data, $menu_font);
	}

	$menu_hidden_font = false;
	if(isset($get_option['theme_option_font_family_menu_expanded'])){
		$menu_hidden_font = $get_option['theme_option_font_family_menu_expanded'];
		array_push($fonts_data, $menu_hidden_font);
	}

	$post_page_title_font = false;
	if(isset($get_option['theme_option_font_post_page_title'])){
		$post_page_title_font = $get_option['theme_option_font_post_page_title'];
		array_push($fonts_data, $post_page_title_font);
	}

	$post_page_content_font = false;
	if(isset($get_option['theme_option_font_post_page_content'])){
		$post_page_content_font = $get_option['theme_option_font_post_page_content'];
		array_push($fonts_data, $post_page_content_font);
	}

	$post_page_meta_font = false;
	if(isset($get_option['theme_option_font_post_page_meta'])){
		$post_page_meta_font = $get_option['theme_option_font_post_page_meta'];
		array_push($fonts_data, $post_page_meta_font);
	}

	$post_page_property_title_font = false;
	if(isset($get_option['theme_option_font_post_page_property_title'])){
		$post_page_property_title_font = $get_option['theme_option_font_post_page_property_title'];
		array_push($fonts_data, $post_page_property_title_font);
	}
	
	$post_page_property_content_font = false;
	if(isset($get_option['theme_option_font_post_page_property_content'])){
		$post_page_property_content_font = $get_option['theme_option_font_post_page_property_content'];
		array_push($fonts_data, $post_page_property_content_font);
	}

	$post_page_link_font = false;
	if(isset($get_option['theme_option_font_post_page_link'])){
		$post_page_link_font = $get_option['theme_option_font_post_page_link'];
		array_push($fonts_data, $post_page_link_font);
	}

	$post_page_navi_font = false;
	if(isset($get_option['theme_option_font_post_page_navi'])){
		$post_page_navi_font = $get_option['theme_option_font_post_page_navi'];
		array_push($fonts_data, $post_page_navi_font);
	}

	$post_page_comments_tit_font = false;
	if(isset($get_option['theme_option_font_post_page_comments_tit'])){
		$post_page_comments_tit_font = $get_option['theme_option_font_post_page_comments_tit'];
		array_push($fonts_data, $post_page_comments_tit_font);
	}

	$post_page_comments_con_font = false;
	if(isset($get_option['theme_option_font_post_page_comments_con'])){
		$post_page_comments_con_font = $get_option['theme_option_font_post_page_comments_con'];
		array_push($fonts_data, $post_page_comments_con_font);
	}

	$post_page_filter_font = false;
	if(isset($get_option['theme_option_font_post_page_filter'])){
		$post_page_filter_font = $get_option['theme_option_font_post_page_filter'];
		array_push($fonts_data, $post_page_filter_font);
	}

	$post_page_loadmore_font = false;
	if(isset($get_option['theme_option_font_post_page_loadmore'])){
		$post_page_loadmore_font = $get_option['theme_option_font_post_page_loadmore'];
		array_push($fonts_data, $post_page_loadmore_font);
	}

	$post_page_list_item_tit_font = false;
	if(isset($get_option['theme_option_font_post_page_list_item_tit'])){
		$post_page_list_item_tit_font = $get_option['theme_option_font_post_page_list_item_tit'];
		array_push($fonts_data, $post_page_list_item_tit_font);
	}

	$post_page_list_item_con_font = false;
	if(isset($get_option['theme_option_font_post_page_list_item_con'])){
		$post_page_list_item_con_font = $get_option['theme_option_font_post_page_list_item_con'];
		array_push($fonts_data, $post_page_list_item_con_font);
	}

	$post_page_list_item_button_font = false;
	if(isset($get_option['theme_option_font_post_page_list_item_button'])){
		$post_page_list_item_button_font = $get_option['theme_option_font_post_page_list_item_button'];
		array_push($fonts_data, $post_page_list_item_button_font);
	}

	$post_page_form_font = false;
	if(isset($get_option['theme_option_font_post_page_form'])){
		$post_page_form_font = $get_option['theme_option_font_post_page_form'];
		array_push($fonts_data, $post_page_form_font);
	}

	$post_page_widget_tit_font = false;
	if(isset($get_option['theme_option_font_post_page_widget_tit'])){
		$post_page_widget_tit_font = $get_option['theme_option_font_post_page_widget_tit'];
		array_push($fonts_data, $post_page_widget_tit_font);
	}

	$post_page_widget_con_font = false;
	if(isset($get_option['theme_option_font_post_page_widget_con'])){
		$post_page_widget_con_font = $get_option['theme_option_font_post_page_widget_con'];
		array_push($fonts_data, $post_page_widget_con_font);
	}

	$post_page_footer_font = false;
	if(isset($get_option['theme_option_font_post_page_footer'])){
		$post_page_footer_font = $get_option['theme_option_font_post_page_footer'];
		array_push($fonts_data, $post_page_footer_font);
	}
	
	$fonts_data = array_unique($fonts_data);
	if(count($fonts_data)){
		foreach($fonts_data as $font){
			if($font != -1){
				wp_enqueue_style('google-fonts-' . $font);
			}
		}
	}
}
add_action('wp_enqueue_scripts','airtheme_theme_options_enqueue_googlefonts');

//theme front scripts for ie
function airtheme_theme_head(){ ?>
	<script type="text/javascript">
	var ajaxurl = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>';
	var JS_PATH = "<?php echo esc_url(MUTI_LOCAL_URL. '/js');?>";
    </script>
	<?php 
	
    
}
add_action('wp_head', 'airtheme_theme_head');


//require theme interface register
require_once get_template_directory() . '/functions/interface/interface-register.php';

//require theme interface style
require_once get_template_directory() . '/functions/interface/interface-style.php';

//require theme interface functions
require_once get_template_directory() . '/functions/interface/interface-functions.php';

//require theme interface hook
require_once get_template_directory() . '/functions/interface/interface-hook.php';

//require theme interface template
require_once get_template_directory() . '/functions/interface/interface-template.php';

//require theme interface condition
require_once get_template_directory() . '/functions/interface/interface-condition.php';

//require theme interface ajax
require_once get_template_directory() . '/functions/interface/interface-ajax.php';


?>