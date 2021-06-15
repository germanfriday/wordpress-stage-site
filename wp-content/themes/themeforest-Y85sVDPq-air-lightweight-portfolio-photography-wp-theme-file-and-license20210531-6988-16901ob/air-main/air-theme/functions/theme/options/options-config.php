<?php
//theme icons
function airtheme_theme_icons_fields(){

// Fontawesome icons list
$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
$fontawesome_path =  get_template_directory() . '/functions/theme/css/font-awesome.css';
if( file_exists( $fontawesome_path ) ) {
	$method = '';
	$url = wp_nonce_url('themes.php?page=theme-option');
	if (false === ($creds = request_filesystem_credentials($url, $method, false, false, false) ) ) {
		return true;
	}
	
	if ( ! WP_Filesystem($creds) ) {
		request_filesystem_credentials($url, $method, true, false, false);
		return true;
	}
	
	global $wp_filesystem;
	@$subject = $wp_filesystem->get_contents($fontawesome_path);
}

preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

$icons = array();

foreach($matches as $match){
	//$icons[$match[1]] = $match[2];
	array_push($icons, 'fa ' . $match[1]);
}
//$icons = apply_filters('airtheme_theme_icons_fields', $icons);

return $icons;


}

function airtheme_theme_get_categories_fields($type=false, $number=50){
	$output = array();
	
	$categories = get_categories(array(
		'hide_empty' => 0,
		'orderby' => 'id',
		'number' => $number
	));
	if($categories){
		foreach($categories as $category){
			array_push($output, array(
				'title' => $category->name,
				'value' => $category->term_id
			));
		}
	}else{
		$output = false;
	}
	
	return $output;
}

function airtheme_wp_get_nav_menus(){
	$output = array();
	$menus = wp_get_nav_menus();
	
	array_push($output, array(
		'title' => esc_html__('Select menu', 'air-theme'),
		'value' => 0
	));
	
	if($menus){
		foreach($menus as $menu){
			array_push($output, array(
				'title' => $menu->name,
				'value' => $menu->term_id
			));
		}
	}
	return $output;
}

//theme color
function airtheme_theme_color(){
	$theme_color = array(
		array('id' => 'color1', 'value' => 'theme-color-1', 'rgb' => '#F9885C'),
		array('id' => 'color2', 'value' => 'theme-color-2', 'rgb' => '#BD9DD1'),
		array('id' => 'color3', 'value' => 'theme-color-3', 'rgb' => '#F1A1C3'),
		array('id' => 'color4', 'value' => 'theme-color-4', 'rgb' => '#92C3E3'),
		array('id' => 'color5', 'value' => 'theme-color-5', 'rgb' => '#5B6A81'),
		array('id' => 'color6', 'value' => 'theme-color-6', 'rgb' => '#B8B69A'),
		array('id' => 'color7', 'value' => 'theme-color-7', 'rgb' => '#69CE9B'),
		array('id' => 'color8', 'value' => 'theme-color-8', 'rgb' => '#FFD02E'),
		array('id' => 'color9', 'value' => 'theme-color-9', 'rgb' => '#C6A584'),
		array('id' => 'color10', 'value' => 'theme-color-10', 'rgb' => '#313139')
	);	

	//color 1-10
	for($color_num=1;$color_num<=10;$color_num++){
		$featured_color = airtheme_get_option('theme_option_featured_color_' .$color_num);
		if($featured_color){
			$i = $color_num - 1;
			$theme_color[$i]['rgb'] = $featured_color;
		}
	}
	
	return $theme_color;
}

//theme config social networks
function airtheme_theme_social_networks(){
	$theme_config_social_networks = array(
		array(
			'name' => esc_html__('Facebook','air-theme'),
			'icon' => 'fa fa-facebook-square',
			'icon2' => 'fa fa-facebook-square',
			'slug' => 'facebook',
			'dec'  => esc_html__('Visit Facebook page','air-theme')
		),
		array(
			'name' => esc_html__('Twitter','air-theme'),
			'icon' => 'fa fa-twitter-square',
			'icon2' => 'fa fa-twitter-square',
			'slug' => 'twitter',
			'dec'  => esc_html__('Visit Twitter page','air-theme')
		),
		array(
			'name' => esc_html__('Google+','air-theme'),
			'icon' => 'fa fa-google-plus-square',
			'icon2' => 'fa fa-google-plus-square',
			'slug' => 'googleplus',
			'dec'  => esc_html__('Visit Google Plus page','air-theme')
		),
		array(
			'name' => esc_html__('Youtube','air-theme'),
			'icon' => 'fa fa-youtube-square',
			'icon2' => 'fa fa-youtube-square',
			'slug' => 'youtube',
			'dec'  => esc_html__('Visit Youtube page','air-theme')
		),
		array(
			'name' => esc_html__('Vimeo','air-theme'),
			'icon' => 'fa fa-vimeo-square',
			'icon2' => 'fa fa-vimeo-square',
			'slug' => 'vimeo',
			'dec'  => esc_html__('Visit Vimeo page','air-theme')
		),
		array(
			'name' => esc_html__('Tumblr','air-theme'),
			'icon' => 'fa fa-tumblr-square',
			'icon2' => 'fa fa-tumblr-square',
			'slug' => 'tumblr',
			'dec'  => esc_html__('Visit Tumblr page','air-theme')
		),
		array(
			'name' => esc_html__('RSS','air-theme'),
			'icon' => 'fa fa-rss-square',
			'icon2' => 'fa fa-rss-square',
			'slug' => 'rss',
			'dec'  => esc_html__('Visit Rss','air-theme')
		),
		array(
			'name' => esc_html__('Pinterest','air-theme'),
			'icon' => 'fa fa-pinterest-square',
			'icon2' => 'fa fa-pinterest-square',
			'slug' => 'pinterest',
			'dec'  => esc_html__('Visit Pinterest page','air-theme')
		),
		array(
			'name' => esc_html__('Linkedin','air-theme'),
			'icon' => 'fa fa-linkedin-square',
			'icon2' => 'fa fa-linkedin-square',
			'slug' => 'linkedin',
			'dec'  => esc_html__('Visit Linkedin page','air-theme')
		),
		array(
			'name' => esc_html__('Instagram','air-theme'),
			'icon' => 'fa fa-instagram',
			'icon2' => 'fa fa-instagram',
			'slug' => 'instagram',
			'dec'  => esc_html__('Visit Instagram page','air-theme')
		),
		array(
			'name' => esc_html__('Github','air-theme'),
			'icon' => 'fa fa-github-square',
			'icon2' => 'fa fa-github-square',
			'slug' => 'github',
			'dec'  => esc_html__('Visit Github page','air-theme')
		),
		array(
			'name' => esc_html__('Xing','air-theme'),
			'icon' => 'fa fa-xing-square',
			'icon2' => 'fa fa-xing-square',
			'slug' => 'xing',
			'dec'  => esc_html__('Visit Xing page','air-theme')
		),
		array(
			'name' => esc_html__('Flickr','air-theme'),
			'icon' => 'fa fa-flickr',
			'icon2' => 'fa fa-flickr',
			'slug' => 'flickr',
			'dec'  => esc_html__('Visit Flickr page','air-theme')
		),
		array(
			'name' => esc_html__('VK','air-theme'),
			'icon' => 'fa fa-vk square-radiu',
			'icon2' => 'fa fa-vk square-radiu',
			'slug' => 'vk',
			'dec'  => esc_html__('Visit VK page','air-theme')
		),
		array(
			'name' => esc_html__('Weibo','air-theme'),
			'icon' => 'fa fa-weibo square-radiu',
			'icon2' => 'fa fa-weibo square-radiu',
			'slug' => 'weibo',
			'dec'  => esc_html__('Visit Weibo page','air-theme')
		),
		array(
			'name' => esc_html__('Renren','air-theme'),
			'icon' => 'fa fa-renren square-radiu',
			'icon2' => 'fa fa-renren square-radiu',
			'slug' => 'renren',
			'dec'  => esc_html__('Visit Renren page','air-theme')
		),
		array(
			'name' => esc_html__('Bitbucket','air-theme'),
			'icon' => 'fa fa-bitbucket-square',
			'icon2' => 'fa fa-bitbucket-square',
			'slug' => 'bitbucket',
			'dec'  => esc_html__('Visit Bitbucket page','air-theme')
		),
		array(
			'name' => esc_html__('Foursquare','air-theme'),
			'icon' => 'fa fa-foursquare square-radiu',
			'icon2' => 'fa fa-foursquare square-radiu',
			'slug' => 'foursquare',
			'dec'  => esc_html__('Visit Foursquare page','air-theme')
		),
		array(
			'name' => esc_html__('Skype','air-theme'),
			'icon' => 'fa fa-skype square-radiu',
			'icon2' => 'fa fa-skype square-radiu',
			'slug' => 'skype',
			'dec'  => esc_html__('Skype','air-theme')
		),
		array(
			'name' => esc_html__('Dribbble','air-theme'),
			'icon' => 'fa fa-dribbble square-radiu',
			'icon2' => 'fa fa-dribbble square-radiu',
			'slug' => 'dribbble',
			'dec'  => esc_html__('Visit Dribbble page','air-theme')
		)
	);	
	
	return $theme_config_social_networks;
	
}

//theme config fonts size
function airtheme_theme_options_fonts_size(){
	$theme_config_fonts_size = array('Select','8px','10px', '11px', '12px', '13px', '14px', '15px', '16px', '17px', '18px', '19px', '20px', '22px', '24px', '26px', '28px', '30px', '32px','34px', '36px', '38px', '40px', '42px','44px','46px', '50px', '52px','56px', '60px', '62px','66px', '70px','72px','76px', '80px', '82px','86px', '90px','92px', '98px');
	return $theme_config_fonts_size;
}

//theme config fonts size mobile
function airtheme_theme_options_fonts_size_m(){
	$theme_config_fonts_size_m = array('Mobile','8px','10px', '11px', '12px', '13px', '14px', '15px', '16px', '17px', '18px', '19px', '20px', '22px', '24px', '26px', '28px', '30px', '32px','34px', '36px', '38px', '40px', '42px','44px','46px', '50px', '52px','56px', '60px', '62px','66px', '70px','72px','76px', '80px', '82px','86px', '90px','92px', '98px');
	return $theme_config_fonts_size_m;
}

//theme config fonts style
function airtheme_theme_options_fonts_style(){
	$theme_config_fonts_style = array(
		array('title' => 'Select', 'value' => ''),
		array('title' => 'Light', 'value' => 'light'),
		array('title' => 'Normal', 'value' => 'regular'),
		array('title' => 'Bold', 'value' => 'bold'),
		array('title' => 'Italic', 'value' => 'italic')
	);
	return $theme_config_fonts_style;
}

//theme config color scheme
function airtheme_theme_options_color_scheme(){
	
	$color_scheme = array(
		'scheme-1' => array(
			array('name' => 'theme_main_color',                 'value' => '#CFBCA6'),
			array('name' => 'second_auxiliary_color',           'value' => '#F8F8F8'),
			array('name' => 'page_post_bg_color',               'value' => '#FFFFFF'),
			array('name' => 'header_bg_color',               	'value' => '#FFFFFF'),
			array('name' => 'page_loader_bg_color',             'value' => '#FFFFFF'),
			array('name' => 'selected_text_bg_color',           'value' => '#F0E8DF'),
			array('name' => 'theme_border_color',               'value' => '#C8C8CC'),
			array('name' => 'logo_text_color',                  'value' => '#313139'),
			array('name' => 'logo_text_color_light',            'value' => '#FFFFFF'),
			array('name' => 'menu_icon_dark',  					'value' => '#313139'),
			array('name' => 'menu_icon_light', 					'value' => '#FFFFFF'),
			array('name' => 'menu_item_color_on_panel',         'value' => '#313139'),
			array('name' => 'heading_color',                    'value' => '#313139'),
			array('name' => 'content_text_color',               'value' => '#414145'),
			array('name' => 'auxiliary_content_color',          'value' => '#ADADAD'),
			array('name' => 'property_tit_color',      			'value' => '#313139'),
			array('name' => 'property_con_color',           	'value' => '#313139'),
			array('name' => 'gallery_link_color',  				'value' => '#313139'),
			array('name' => 'post_navi_color',         			'value' => '#313139'),
			array('name' => 'comment_tit_color',           		'value' => '#313139'),
			array('name' => 'comment_con_color', 				'value' => '#313139'),
			array('name' => 'comment_author_color',    			'value' => '#313139'),
			array('name' => 'filter_color',    					'value' => '#313139'),
			array('name' => 'filter_focused_color',    			'value' => '#313139'),
			array('name' => 'loadmore_color',    				'value' => '#313139'),
			array('name' => 'list_item_tit_color',    			'value' => '#313139'),
			array('name' => 'list_item_tag_color',    			'value' => '#313139'),
			array('name' => 'list_item_mask_color',    			'value' => '#313139'),
			array('name' => 'button_color',   					'value' => '#313139'),
			array('name' => 'button_mouseover_color',    		'value' => '#313139'),
			array('name' => 'button_bg_mouseover_color',    	'value' => '#313139'),
			array('name' => 'form_color',    					'value' => '#ADADAD'),
			array('name' => 'form_focused_color',    			'value' => '#313139'),
			array('name' => 'widget_title_color',    			'value' => '#313139'),
			array('name' => 'widget_content_color',    			'value' => '#313139'),
			array('name' => 'widget_title_sidebar_color',    	'value' => '#F0F0F0'),
			array('name' => 'widget_title_bg_color',    		'value' => '#313139'),
			array('name' => 'footer_text_color',                'value' => '#313139'),
			array('name' => 'footer_bg_color',                  'value' => '#FFFFFF')
		),
		'scheme-2' => array(
			array('name' => 'theme_main_color',                 'value' => '#CFBCA6'),
			array('name' => 'second_auxiliary_color',           'value' => '#F8F8F8'),
			array('name' => 'page_post_bg_color',               'value' => '#313139'),
			array('name' => 'header_bg_color',               	'value' => '#313139'),
			array('name' => 'page_loader_bg_color',             'value' => '#313139'),
			array('name' => 'selected_text_bg_color',           'value' => '#F0E8DF'),
			array('name' => 'theme_border_color',               'value' => '#C8C8CC'),
			array('name' => 'logo_text_color',                  'value' => '#313139'),
			array('name' => 'logo_text_color_light',            'value' => '#FFFFFF'),
			array('name' => 'menu_icon_dark',  					'value' => '#313139'),
			array('name' => 'menu_icon_light', 					'value' => '#FFFFFF'),
			array('name' => 'menu_item_color_on_panel',         'value' => '#313139'),
			array('name' => 'heading_color',                    'value' => '#FFFFFF'),
			array('name' => 'content_text_color',               'value' => '#FFFFFF'),
			array('name' => 'auxiliary_content_color',          'value' => '#E0E0E0'),
			array('name' => 'property_tit_color',      			'value' => '#FFFFFF'),
			array('name' => 'property_con_color',           	'value' => '#FFFFFF'),
			array('name' => 'gallery_link_color',  				'value' => '#FFFFFF'),
			array('name' => 'post_navi_color',         			'value' => '#FFFFFF'),
			array('name' => 'comment_tit_color',           		'value' => '#FFFFFF'),
			array('name' => 'comment_con_color', 				'value' => '#FFFFFF'),
			array('name' => 'comment_author_color',    			'value' => '#FFFFFF'),
			array('name' => 'filter_color',    					'value' => '#FFFFFF'),
			array('name' => 'filter_focused_color',    			'value' => '#FFFFFF'),
			array('name' => 'loadmore_color',    				'value' => '#FFFFFF'),
			array('name' => 'list_item_tit_color',    			'value' => '#FFFFFF'),
			array('name' => 'list_item_tag_color',    			'value' => '#FFFFFF'),
			array('name' => 'list_item_mask_color',    			'value' => '#313139'),
			array('name' => 'button_color',   					'value' => '#FFFFFF'),
			array('name' => 'button_mouseover_color',    		'value' => '#313139'),
			array('name' => 'button_bg_mouseover_color',    	'value' => '#FFFFFF'),
			array('name' => 'form_color',    					'value' => '#ADADAD'),
			array('name' => 'form_focused_color',    			'value' => '#FFFFFF'),
			array('name' => 'widget_title_color',    			'value' => '#FFFFFF'),
			array('name' => 'widget_content_color',    			'value' => '#FFFFFF'),
			array('name' => 'widget_title_sidebar_color',    	'value' => '#F0F0F0'),
			array('name' => 'widget_title_bg_color',    		'value' => '#53535C'),
			array('name' => 'footer_text_color',                'value' => '#FFFFFF'),
			array('name' => 'footer_bg_color',                  'value' => '#313139')
		)

	);
	return $color_scheme;
	
}

//theme config select fields
function airtheme_theme_options_config_select_fields(){
	$theme_config_select_fields = array(
		'theme_option_posts_showmeta' => array(
		array('title' => esc_html__('Date','air-theme'),                                   'value' => 'date'),
		array('title' => esc_html__('Length','air-theme'),                                 'value' => 'length'),
		array('title' => esc_html__('Category','air-theme'),                               'value' => 'category'), 
		array('title' => esc_html__('Author','air-theme'),                                 'value' => 'author'),
		array('title' => esc_html__('Comments','air-theme'),                               'value' => 'comments')
		),
		
		'theme_meta_demo_site' => array(  
		array('title' => esc_html__('Default Demo','air-theme'),                           'value' => '../wp-content/themes/'.get_stylesheet().'/functions/theme/default-demo.xml')
		),
		
		'theme_option_footer_widget_for_posts'                                        => airtheme_theme_register_sidebar('footer_widget'),
		'theme_option_footer_widget_for_pages'                                        => airtheme_theme_register_sidebar('footer_widget'),
		'theme_option_hide_category_on_post_page'                                     => airtheme_theme_get_categories_fields(),
		
		'theme_option_footer_elements' => array(
		array('title' => esc_html__('1 Set of Information','air-theme'),                   'value' => '1-set'),
		array('title' => esc_html__('2 Sets of Information','air-theme'),                  'value' => '2-set')
		),
		
		'theme_option_footer_elements_infor_1' => array(
		array('title' => esc_html__('Menu','air-theme'),                                   'value' => 'menu'),
		array('title' => esc_html__('Copyright Info','air-theme'),                         'value' => 'copyright'),
		array('title' => esc_html__('Social Icons','air-theme'),                           'value' => 'socialicons'),
		array('title' => esc_html__('Logo','air-theme'),                           			'value' => 'logo'),
		array('title' => esc_html__('Multi-Language','air-theme'),                         'value' => 'language')
		),
		
		'theme_option_footer_elements_infor_2' => array(
		array('title' => esc_html__('Menu','air-theme'),                                   'value' => 'menu'),
		array('title' => esc_html__('Copyright Info','air-theme'),                         'value' => 'copyright'),
		array('title' => esc_html__('Social Icons','air-theme'),                           'value' => 'socialicons'),
		array('title' => esc_html__('Logo','air-theme'),                           			'value' => 'logo'),
		array('title' => esc_html__('Multi-Language','air-theme'),                         'value' => 'language')
		),
		
		'theme_option_footer_elements_infor_1_menu'                                   => airtheme_wp_get_nav_menus(),
		'theme_option_footer_elements_infor_2_menu'                                   => airtheme_wp_get_nav_menus(),
		
		'theme_option_header_layout' => array(
		//array('title' => esc_html__('Left Logo + Right Menu','air-theme'),                 'value' => 'left_logo__right_menu'),
		array('title' => esc_html__('Show Menu Icon','air-theme'),  					'value' => 'navi-hide'),
		array('title' => esc_html__('Show Menu','air-theme'),  						'value' => 'navi-show') 
		),

		'theme_option_header_width' => array( 
		array('title' => esc_html__('Fluid','air-theme'),  							'value' => 'fluid'),
		array('title' => esc_html__('Same As Main Container','air-theme'),  		'value' => 'fixed') 
		),

		'theme_option_color_skin_lightbox' => array(
		array('title' => __('Dark','air-theme'),                'value' => 'pswp-dark-skin'),
		array('title' => __('Light','air-theme'),               'value' => 'pswp-light-skin')
		),

		'theme_option_custom_logo_choose' => array(
		array('title' => __('Dark','air-theme'),                'value' => 'default-dark-logo'),
		array('title' => __('Light','air-theme'),               'value' => 'default-light-logo')
		),

		'theme_option_main_width' => array(
		array('title' => __('1170','air-theme'),                'value' => '1170'),
		array('title' => __('1070','air-theme'),                'value' => '1070'),
		array('title' => __('970','air-theme'),                 'value' => '970')
		),

		'theme_option_share_buttons' => array(
		array('title' => esc_html__('Facebook','air-theme'),                     'value' => 'facebook'),
		array('title' => esc_html__('Twitter','air-theme'),                      'value' => 'twitter'),
		array('title' => esc_html__('Google Plus','air-theme'),                  'value' => 'google-plus'),
		array('title' => esc_html__('Pinterest','air-theme'),                    'value' => 'pinterest'),
		array('title' => esc_html__('Digg','air-theme'),                    	 'value' => 'digg'),
		array('title' => esc_html__('Reddit','air-theme'),                    	 'value' => 'reddit'),
		array('title' => esc_html__('Linkedin','air-theme'),                     'value' => 'linkedin'),
		array('title' => esc_html__('Stumbleupon','air-theme'),                   'value' => 'stumbleupon'),
		array('title' => esc_html__('Tumblr','air-theme'),                    	 'value' => 'tumblr'),
		array('title' => esc_html__('Mail','air-theme'),                    	 'value' => 'mail')
		),
		
		'theme_option_border_line_width' => array(
		array('title' => esc_html__('0','air-theme'),                                      'value' => 'bordery0px'),
		array('title' => esc_html__('10','air-theme'),                                     'value' => 'border10px'),
		array('title' => esc_html__('20','air-theme'),                                     'value' => 'border20px'),
		array('title' => esc_html__('30','air-theme'),                                     'value' => 'border30px'),
		array('title' => esc_html__('40','air-theme'),                                     'value' => 'border40px')
		),

		'theme_option_border_line_y_width' => array(
		array('title' => esc_html__('0','air-theme'),                                      'value' => 'bordery0px'),
		array('title' => esc_html__('10','air-theme'),                                     'value' => 'bordery10px'),
		array('title' => esc_html__('20','air-theme'),                                     'value' => 'bordery20px'),
		array('title' => esc_html__('30','air-theme'),                                     'value' => 'bordery30px'),
		array('title' => esc_html__('40','air-theme'),                                     'value' => 'bordery40px')
		),

		'theme_option_header_sticky' => array(
		array('title' => __('Sticky when Scroll Top','air-theme'),      'value' => 'scroll-back-top'),
		array('title' => __('Sticky Always','air-theme'),                'value' => 'sticky-always'),
		array('title' => __('Sticky Disable','air-theme'),               'value' => 'sticky-disable')
		)
	);
	
	$theme_config_select_fields = apply_filters('theme_config_select_fields', $theme_config_select_fields);
	return $theme_config_select_fields;
}

//theme config fields
if ( ! function_exists('airtheme_theme_options_config_fields') ) {
	function airtheme_theme_options_config_fields(){
		$theme_config_fields = array(
			array(
				'id'      => 'options-theme',
				'name'    => esc_html__('Theme Options','air-theme'),
				'section' => array(
					
					array(/* Import Demo Data */
						'id'    => 'import-export',
						'title' => esc_html__('Import Demo Data','air-theme'),
						'item'  => array(
							array('description' => esc_html__('if you are new to WordPress or have problems creating posts or pages that look like the theme demo, you could import dummy posts and pages here that will definitely help to understand how those tasks are done','air-theme'),
								  'button'      => array('title'   => esc_html__('Import Demo Data','air-theme'),
														 'loading' => esc_html__('Loading data, don&acute;t close the page please.','air-theme'),
														 'type'    => 'import-demo-data',
														 'class'   => 'btn-info',
														 'url'     => admin_url('admin.php?import=wordpress&step=2', 'http')),
								  'notice'      => esc_html__('The demo content will be import including post/pages and sliders, the images in sliders could only be use as placeholder and could not be use in your finally website due to copyright reasons.','air-theme'),
								  'type'        => 'button',
								  'name'        => 'theme_option_import_demo'),
									  
							array('type'        => 'select',
								  'description' => '',
								  'name'        => 'theme_meta_demo_site',
								  'col_size'    => 'width: 300px;'),
							
							array('description' => esc_html__('export your current data to a file and save it on your computer','air-theme'),
								  'button'      => array('title' => esc_html__('Export Current Data','air-theme'),
														 'type'  => 'export-current-data',
														 'class' => 'btn-default',
														 'url'   => admin_url('export.php?download=true')),
								  'type'        => 'button',
								  'name'        => 'theme_option_export_current_data'),
									  
							array('description' => esc_html__('import a data file you have saved','air-theme'),
								  'button'      => array('title' => esc_html__('Import My Saved Data','air-theme'),
														 'type'  => 'import-mysaved-data',
														 'class' => 'btn-default',
														 'url'   => admin_url('admin.php?import=wordpress')),
								  'type'        => 'button',
								  'name'        => 'theme_option_import_mysaved_data'))),
							  
					array(/* Generate New Thumbs for This Theme */
						'id'   => 'generate-thumbs',
						'item' => array(
							array('title'       => esc_html__('Generate New Thumbs for This Theme','air-theme'),
								  'description' => esc_html__('if you have many posts and had assigned some Featured Image for them before using this theme, this button could help you adapt these feature images to appropriate size for this theme','air-theme'),
								  'button'      => array('title'   => esc_html__('Generate New Thumbnails','air-theme'),
														 'loading' => esc_html__('Processing, don&acute;t close the page please.','air-theme'),
														 'type'    => 'generate-thumbs',
														 'class'   => 'btn-default'),
								  'type'        => 'button',
								  'name'        => 'theme_option_generate_thumbs')))
				)
			),
			
			array(
				'id'      => 'options-general',
				'name'    => esc_html__('General Settings','air-theme'),
				'section' => array(    

					array(/* Logo */
						'id'    => 'logo',
						'title' => esc_html__('Logo','air-theme'),
						'item'  => array(        
							
							// Enable Plain Text Logo
							array('title'       => esc_html__('Enable Plain Text Logo','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_enable_text_logo',
								  'default'     => 'false'),

							// Logo Text
							array('title'       => esc_html__('Logo Text','air-theme'),
								  'type'        => 'text',
								  'name'        => 'theme_option_text_logo',
								  'description' => '',
								  'default'     => '',
								  'control'     => array('name'  => 'theme_option_enable_text_logo',
														 'value' => 'true')),

							// Costom Logo
							array('title'       => esc_html__('Dark Custom Logo','air-theme'),
								  'description' => esc_html__('the container for custom logo is 120px(width) * 120px(hight) for "Menu Bar on Side" layout,  240px(width) * 100px(hight) for "Menu Bar on Head" layout, you could upload a double size logo image to meet the needs of retina screens','air-theme'),
								  'type'        => 'upload',
								  'name'        => 'theme_option_custom_logo',
								  'control'     => array('name'  => 'theme_option_enable_text_logo',
														 'value' => 'false')),

							// Costom Logo for Dark Background
							array('title'       => esc_html__('Light Custom Logo','air-theme'),
								  'description' => '',
								  'type'        => 'upload',
								  'name'        => 'theme_option_custom_logo_light',
								  'control'     => array('name'  => 'theme_option_enable_text_logo',
														 'value' => 'false')),

							// Logo size
							array('title'       => esc_html__('Custom Logo Height','air-theme'),
								  'type'        => 'text',
								  'name'        => 'theme_option_custom_logo_height',
								  'col_size'    => 'width:102px;',
								  'description' =>  esc_html__('It is optional.','air-theme'),
								  'default'     => '',
								  'control'     => array('name'  => 'theme_option_enable_text_logo',
														 'value' => 'false')),

							// Logo size mobile
							array('title'       => esc_html__('Custom Logo Height for Mobile','air-theme'),
								  'type'        => 'text',
								  'name'        => 'theme_option_custom_logo_height_mobile',
								  'col_size'    => 'width:102px;',
								  'description' =>  '',
								  'default'     => '',
								  'control'     => array('name'  => 'theme_option_enable_text_logo',
														 'value' => 'false')),

							// Custom Logo For Loading Page
							array('title'       => esc_html__('Custom Logo For Loading Page','air-theme'),
								  'description' => '',
								  'type'        => 'upload',
								  'name'        => 'theme_option_custom_logo_for_loading',
								  'control'     => array('name'  => 'theme_option_enable_text_logo',
														 'value' => 'false')),

							// Costom Footer Logo
							array('title'       => esc_html__('Custom Footer Logo','air-theme'),
								  'description' => '',
								  'type'        => 'upload',
								  'name'        => 'theme_option_custom_footer_logo',
								  'control'     => array('name'  => 'theme_option_enable_text_logo',
														 'value' => 'false')),

							// Costom Footer Logo size
							array('title'       => esc_html__('Custom Footer Logo Height','air-theme'),
								  'type'        => 'text',
								  'name'        => 'theme_option_custom_foot_logo_height',
								  'col_size'    => 'width:102px;',
								  'description' =>  esc_html__('It is optional.','air-theme'),
								  'default'     => '',
								  'control'     => array('name'  => 'theme_option_enable_text_logo',
														 'value' => 'false')),
							)),
					
					array(/* Descriptions */
						'id'    => 'descriptions',
						'title' => esc_html__('Descriptions','air-theme'),
						'item'  => array(

							// Menu
	                        array('title'       => esc_html__('Menu Icon','air-theme'),
	                               'description' => '',
	                               'type'        => 'text',
	                               'default'     => '',
	                               'name'        => 'theme_option_descriptions_menu'),

	                        // Menu
	                        array('title'       => esc_html__('Close Menu Icon','air-theme'),
	                               'description' => '',
	                               'type'        => 'text',
	                               'default'     => '',
	                               'name'        => 'theme_option_descriptions_menu_close'),

							// Pagination
	                        array('title'       => esc_html__('Load More','air-theme'),
	                               'description' => '',
	                               'type'        => 'text',
	                               'default'     => '',
	                               'name'        => 'theme_option_descriptions_pagination'),

	                        // Pagination
	                        array('title'       => esc_html__('Loading','air-theme'),
	                               'description' => '',
	                               'type'        => 'text',
	                               'default'     => '',
	                               'name'        => 'theme_option_descriptions_pagination_loading'),

							// Leave a Comment
	                        array('title'       => esc_html__('Comment Title','air-theme'),
	                               'description' => esc_html__('Comments in posts','air-theme'),
	                               'type'        => 'text',
	                               'default'     => '',
	                               'name'        => 'theme_option_descriptions_comment_title'),

							// Your message
	                        array('title'       => esc_html__('Comment Box Placeholder','air-theme'),
	                               'description' => '',
	                               'type'        => 'text',
	                               'default'     => '',
	                               'name'        => 'theme_option_descriptions_your_message'),

	                        // Send
	                        array('title'       => esc_html__('Comment Submit Button Name','air-theme'),
	                               'description' => '',
	                               'type'        => 'text',
	                               'default'     => '',
	                               'name'        => 'theme_option_descriptions_comment_submit'),

	                        // Search
	                        array('title'       => esc_html__('Search','air-theme'),
	                               'description' => '',
	                               'type'        => 'text',
	                               'default'     => '',
	                               'name'        => 'theme_option_descriptions_search'),

	                        // News
	                        array('title'       => esc_html__('Blog Page Title','air-theme'),
	                               'description' => '',
	                               'type'        => 'text',
	                               'default'     => '',
	                               'name'        => 'theme_option_descriptions_news'),

	                        // Post (Previous/Next) Navigation
	                        array('title'       => esc_html__('Previous(Post Navigation)','air-theme'),
	                               'description' => '',
	                               'type'        => 'text',
	                               'default'     => '',
	                               'name'        => 'theme_option_descriptions_prev'),

	                        // Post (Previous/Next) Navigation
	                        array('title'       => esc_html__('Next(Post Navigation)','air-theme'),
	                               'description' => '',
	                               'type'        => 'text',
	                               'default'     => '',
	                               
	                               'name'        => 'theme_option_descriptions_next'),
	                        // Sold out on WooCommerce
	                        array('title'       => esc_html__('Sold Out on WooCommerce Shop Page','air-theme'),
	                               'description' => '',
	                               'type'        => 'text',
	                               'default'     => '',
	                               'name'        => 'theme_option_descriptions_woo_sold_out'),
							)),
					
					array(/* Copyright */
						'id'    => 'copyright',
						'title' => esc_html__('Copyright','air-theme'),
						'item'  => array(
							
							// Copyright Information
							array('title'       => esc_html__('Copyright Information','air-theme'),
								  'description' => esc_html__('enter the copyright information, it would be placed on the bottom of the pages','air-theme'),
								  'type'        => 'text',
								  'name'        => 'theme_option_copyright',
								  'default'     => 'Copyright Information.'))),
								 
								  
					array(/* Icon */
						'id'    => 'icon',
						'title' => esc_html__('Icon','air-theme'),
						'item'  => array(
							
							// Custom Favicon
							array('title'       => esc_html__('Custom Favicon','air-theme'),
								  'description' => esc_html__('upload the favicon for your website, it would be shown on the tab of the browser','air-theme'),
								  'type'        => 'upload',
								  'name'        => 'theme_option_custom_favicon',
								  'default'     => MUTI_LOCAL_URL . '/img/favicon.ico'),
								  
							// Custom Mobile Icon
							array('title'       => esc_html__('Custom Mobile Icon','air-theme'),
								  'description' => esc_html__('upload the icon for the shortcuts on mobile devices','air-theme'),
								  'type'        => 'upload',
								  'name'        => 'theme_option_mobile_icon',
								  'default'     => MUTI_LOCAL_URL . '/img/apple-touch-icon-114x114.png'))),
								
					array(/* Custom CSS */
						'title' => esc_html__('Custom CSS','air-theme'),
						'id'    => 'custom-css', 
						'item'  => array(
							
							// Please enter your Custom CSS (Optional)
							array('title'       => esc_html__('Please enter your Custom CSS (Optional)','air-theme'),
								  'description' => '',
								  'type'        => 'textarea',
								  'name'        => 'theme_option_custom_css'))),

				)
			),
			
			array(
				'id'      => 'options-social-networks',
				'name'    => esc_html__('Social Networks','air-theme'),
				'section' => array(
					
					array(/* Your Social Media Links */
						'id'    => 'social-media-links',
						'title' => esc_html__('Your Social Media Links','air-theme'),
						'item'  => array(
	 
																
							// Social Medias
							array('title'       => esc_html__('Social Medias','air-theme'),
								  'description' => '',
								  'type'        => 'new-social-medias',
								  'name'        => 'theme_option_show_social_medias'
								  ),
							array('title'       => esc_html__('Opened in New Tab or Window','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_show_social_medias_new_tab'
								  ),
							)
						),


					array(/* Share Buttons For Post */
						'id'    => 'social-media-buttons',
						'title' => esc_html__('Share Buttons For Post','air-theme'),
						'item'  => array(
												 
						    // Enable Share Buttons for Posts
							array('title'       => esc_html__('Enable Share Buttons for Posts','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_enable_share_buttons_for_posts',
								  'default'     => 'true',
								  'bind'        => array(
									  array('type'     => 'checkbox-group',
											'name'     => 'theme_option_share_buttons',
											'position' => 'after',
											'default'  => array('facebook', 'twitter', 'google-plus', 'pinterest'),
											'control'  => array('name'  => 'theme_option_enable_share_buttons_for_posts',
																'value' => 'true'))))
						)
					)
							


				)
			),
			
			array(
				'id'      => 'options-schemes',
				'name'    => esc_html__('Schemes','air-theme'),
				'section' => array(
					
					array(/* Color Setting */
						'id'    => 'color-scheme',
						'title' => esc_html__('Color Setting','air-theme'),
						'item'  => array(
							
							// Select Color Scheme
							array('title'       => esc_html__('Select a predefined color scheme ','air-theme'),
								  'description' => '',
								  'type'        => 'color-scheme',
								  'name'        => 'theme_option_color_scheme'))),
								  
					array(/* Global */
						'id'    => 'color-main',
						'title' => esc_html__('Global','air-theme'),
						'item'  => array(
							
							// Highlight Color
							array('title'       => esc_html__('Highlight Color','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_theme_main',
								  'scheme-name' => 'theme_main_color',
								  'default'     => '#CFBCA6'),
								  
							//** Auxiliary Color
							array('title'       => esc_html__('Auxiliary Color','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_second_auxiliary',
								  'scheme-name' => 'second_auxiliary_color',
								  'default'     => '#F8F8F8'),
								  
							// Page Post Bg Color
							array('title'       => esc_html__('Page/Post Bg Color','air-theme'),
								  'description' => esc_html__('background color for the page area','air-theme'),
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_bg_page_post',
								  'scheme-name' => 'page_post_bg_color',
								  'default'     => '#ffffff'),

							// Page Post Bg Color
							array('title'       => esc_html__('Header Bg Color','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_bg_header',
								  'scheme-name' => 'header_bg_color',
								  'default'     => '#ffffff'),

							// Page Post Bg Color
							array('title'       => esc_html__('Page Loader Bg Color','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_bg_page_loader',
								  'scheme-name' => 'page_loader_bg_color',
								  'default'     => '#ffffff'),

							// Selected Text Bg Color
							array('title'       => esc_html__('Selected Text Bg Color','air-theme'),
								  'description' => esc_html__('the color for selected text background','air-theme'),
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_selected_text_bg',
								  'scheme-name' => 'selected_text_bg_color',
								  'default'     => '#F0E8DF'),

							// Border color
							array('title'       => esc_html__('Border Color','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_border_color',
								  'scheme-name' => 'theme_border_color',
								  'default'     => '#C8C8CC'))),
	                                
					array(/* Logo */
						'id'    => 'color-logo',
						'title' => esc_html__('Plain Text Logo','air-theme'),
						'item'  => array(
							
							// Logo Text Color
							array('title'       => esc_html__('Logo Dark','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_logo',
								  'scheme-name' => 'logo_text_color',
								  'default'     => '#313139'),

							//  Logo Text Color Light
							array('title'       => esc_html__('Logo Light','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_logo_text_color_light',
								  'scheme-name' => 'logo_text_color_light',
								  'default'     => '#ffffff'),

							
						)
					),

					array(/* Logo */
						'id'    => 'color-menu',
						'title' => esc_html__('Menu','air-theme'),
						'item'  => array(

							// Menu on Header Dark
							array('title'       => esc_html__('Menu on Header Dark','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_menu_icon_dark',
								  'scheme-name' => 'menu_icon_dark',
								  'default'     => '#313139'),

							// Menu on Header Light
							array('title'       => esc_html__('Menu on Header Light','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_menu_icon_light',
								  'scheme-name' => 'menu_icon_light',
								  'default'     => '#ffffff'),

							// Menu Icon on panel Color
							array('title'       => esc_html__('Menu Item on Expanded Menu Panel','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_menu_item_color_on_panel',
								  'scheme-name' => 'menu_item_color_on_panel',
								  'default'     => '#313139')

						)
					),
								  
					array(/* Posts & Pages */
						'id'    => 'color-post-page',
						'title' => esc_html__('Posts & Pages','air-theme'),
						'item'  => array(

							// Title
							array('title'       => esc_html__('Title','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_heading',
								  'scheme-name' => 'heading_color',
								  'default'     => '#313139'),
								  
							// Content 
							array('title'       => esc_html__('Content','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_content_text',
								  'scheme-name' => 'content_text_color',
								  'default'     => '#414145'),
								  
							// Meta
							array('title'       => esc_html__('Meta Info.','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_auxiliary_content',
								  'scheme-name' => 'auxiliary_content_color',
								  'default'     => '#adadad'),

							// Property
							array('title'       => esc_html__('Gallery Post Property Title','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_property_tit',
								  'scheme-name' => 'property_tit_color',
								  'default'     => '#313139'),

							// Property
							array('title'       => esc_html__('Gallery Post Property Content','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_property_con',
								  'scheme-name' => 'property_con_color',
								  'default'     => '#313139'),

							// Galley LINK button
							array('title'       => esc_html__('Gallery Post Link Button','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_gallery_link',
								  'scheme-name' => 'gallery_link_color',
								  'default'     => '#313139'),

							// Galley Caption 
							array('title'       => esc_html__('Gallery Caption','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_gallery_caption',
								  'scheme-name' => 'gallery_caption_color',
								  'default'     => '#666666'),
								  
							// Prev & Next
							array('title'       => esc_html__('Previous & Next','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_post_navi',
								  'scheme-name' => 'post_navi_color',
								  'default'     => '#313139'),

							// Comment Title
							array('title'       => esc_html__('Comment Title','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_comment_tit',
								  'scheme-name' => 'comment_tit_color',
								  'default'     => '#313139'),

							// Comment Content
							array('title'       => esc_html__('Comment Content','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_comment_con',
								  'scheme-name' => 'comment_con_color',
								  'default'     => '#313139'),

							// Comment Author
							array('title'       => esc_html__('Comment Author Name','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_comment_author',
								  'scheme-name' => 'comment_author_color',
								  'default'     => '#313139'),
					)),

					array(/* Portfolio List */
						'id'    => 'color-portfolio-list',
						'title' => esc_html__('Portfolio List','air-theme'),
						'item'  => array(
	                                                
							// Filter Text by Default
							array('title'       => esc_html__('Filter Text by Default','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_filter',
								  'scheme-name' => 'filter_color',
								  'default'     => '#313139'),

							// Filter Text Focused
							array('title'       => esc_html__('Filter Text Focused','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_filter_focused',
								  'scheme-name' => 'filter_focused_color',
								  'default'     => '#313139'), 

							// LoadMore
							array('title'       => esc_html__('Load More Button','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_loadmore',
								  'scheme-name' => 'loadmore_color',
								  'default'     => '#313139'), 

							// Title for Item
							array('title'       => esc_html__('Title for Item','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_list_item_tit',
								  'scheme-name' => 'list_item_tit_color',
								  'default'     => '#313139'), 

							// Tag for Item
							array('title'       => esc_html__('Tag for Item','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_list_item_tag',
								  'scheme-name' => 'list_item_tag_color',
								  'default'     => '#313139'), 

							// Mask for Item
							array('title'       => esc_html__('Mask for Item','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_list_item_mask',
								  'scheme-name' => 'list_item_mask_color',
								  'default'     => '#ffffff'), 
					)),

					array(/* Button */
						'id'    => 'color-button',
						'title' => esc_html__('Button','air-theme'),
						'item'  => array(
	                                                
							 
							array('title'       => esc_html__('Text & Border','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_button',
								  'scheme-name' => 'button_color',
								  'default'     => '#313139'),

							array('title'       => esc_html__('Text Mouseover','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_button_mouseover',
								  'scheme-name' => 'button_mouseover_color',
								  'default'     => '#ffffff'),

							array('title'       => esc_html__('Bg Mouseover','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_button_bg_mouseover',
								  'scheme-name' => 'button_bg_mouseover_color',
								  'default'     => '#313139')
					)),

					array(/* Button */
						'id'    => 'color-form',
						'title' => esc_html__('Form','air-theme'),
						'item'  => array(

							array('title'       => esc_html__('Text Input Box by Default','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_form',
								  'scheme-name' => 'form_color',
								  'default'     => '#adadad'),

							array('title'       => esc_html__('Text Input Box Focused','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_form_focused',
								  'scheme-name' => 'form_focused_color',
								  'default'     => '#313139')
					)),
					
					array(/* Sidebar */
						'id'    => 'color-widget',
						'title' => esc_html__('Widget','air-theme'),
						'item'  => array(
	                                                
							// Widget Title Color
							array('title'       => esc_html__('Title Text','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_widget_title',
								  'scheme-name' => 'widget_title_color',
								  'default'     => '#313139'),
								  
							// Widget Content Color
							array('title'       => esc_html__('Content Text','air-theme'),
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_widget_content_color',
								  'scheme-name' => 'widget_content_color',
								  'default'     => '#313139'),

							// Sidebar Widget Title Text Color
							array('title'       => esc_html__('Widget on Sidebar Title','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_widget_title_sidebar',
								  'scheme-name' => 'widget_title_sidebar_color',
								  'default'     => '#f0f0f0'),

							// Sidebar Widget Title Bg Color
							array('title'       => esc_html__('Widget on Sidebar Title Bg','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_color_widget_title_bg',
								  'scheme-name' => 'widget_title_bg_color',
								  'default'     => '#313139')
					)),
								  
					array( /* Footer */
						'id'    => 'color-footer',
						'title' => esc_html__('Footer','air-theme'),
						'item'  => array( 
								  
							// Footer Text Color
							array('title'       => esc_html__('Footer Text Color','air-theme'),
	                              'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_footer_text_color',
								  'scheme-name' => 'footer_text_color',
								  'default'     => '#313139'),
								  
							// Footer Bg Color
							array('title'       => esc_html__('Footer Bg Color','air-theme'),
	                              'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_footer_bg_color',
								  'scheme-name' => 'footer_bg_color',
								  'default'     => '#ffffff'))),
					 
					array(/* Lightbox */
						'id'    => 'color-lightbox',
						'title' => esc_html__('Others','air-theme'),
						'item'  => array(

							//Woo Product
							array('title'       => esc_html__('Navigation Dot Color on the WooCommerce Product Page','air-theme'),
	                              'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'woocommerce_product_slider_dot_color',
								  'scheme-name' => 'woo_product_slider_dot_color',
								  'default'     => '#cccccc'),

							// Logo & Menu Skin on Header
							array('title'       => esc_html__('Logo & Menu Skin on Header','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_option_custom_logo_choose',
								  'scheme-name' => 'color_skin_logo_header',
								  'col_size'    => 'width:140px;',
								  'default'     => 'dark'),

							// Lightbox Color Skin
							array('title'       => esc_html__('Lightbox Color Skin','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_option_color_skin_lightbox',
								  'scheme-name' => 'color_skin_lightbox',
								  'col_size' => 'width:140px;',
								  'default'     => 'dark'))),
				)
			),
			
			array(
				'id'      => 'options-font',
				'name'    => esc_html__('Font Settings','air-theme'),
				'section' => array(
					
					array(/* Synchronous */
						'id'    => 'font-synchronous',
						'title' => esc_html__('Synchronous','air-theme'),
						'item'  => array(
							
							// Update to new Google Font Data
							array('description' => '',
								  'button'      => array('title'   => esc_html__('Update to new Google Font Data','air-theme'),
														 'loading' => esc_html__('Updating ...','air-theme'),
														 'type'    => 'font-synchronous',
														 'class'   => 'btn-primary'),
								  'type'        => 'button',
								  'name'        => 'theme_option_font_synchronous'),

							array('title'       => esc_html__('Please enter the Google Api Key','air-theme'),
								'name'        => 'theme_option_google_apikey',
								'description'   => esc_html__( 'Get your Google Fonts Api Key here: https://console.developers.google.com/apis', 'air-theme' ),
								'type'          => 'text')
						)
					),

					array(/* Logo Font */
						'id'   => 'font-logo',
						'title' => esc_html__('Logo','air-theme'),
						'item' => array(
							
							// Logo Font
							array('title'       => esc_html__('Plain Text Logo','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_family_logo',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_logo',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_logo',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_logo_m',
											'default'  => '',
											'position' => 'after')
									)
							)
						)
					),
											
					
											
	                array(/* Menu Font */
						'id'   => 'menu-font',
						'title' => esc_html__('Menu','air-theme'),
						'item' => array(

							// Menu on Header
							array('title'       => esc_html__('Menu on Header','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_family_menu_header',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_menu_header',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_menu_header',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_menu_header_m',
											'default'  => '',
											'position' => 'after')
									)
							),

							// Menu on Expanded
							array('title'       => esc_html__('Menu Item on Expanded Panel','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_family_menu_expanded',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_menu_expanded',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_menu_expanded',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_menu_expanded_m',
											'default'  => '',
											'position' => 'after')
									)
							),
							 

					)),


	                
								  
					array(/* Page Post Font */
						'id'   => 'font-post-page',
						'title' => esc_html__('Posts & Pages','air-theme'),
						'item' => array(
							
							// Post Page Title Font
							array('title'       => esc_html__('Title','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_title',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_title',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_post_page_title',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_title_m',
											'default'  => '',
											'position' => 'after')
									)
							),

							// Post Page Content Font
							array('title'       => esc_html__('Content','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_content',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_content',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_post_page_content',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_content-m',
											'default'  => '',
											'position' => 'after')
									)
							),

							// Post Page Content Heading 1-6 Font
							array('title'       => esc_html__('Content Heading 1-6','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_content_heading',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_content_heading',
											'default'  => '',
											'position' => 'after')
									)
							),

							array('title'       => esc_html__('Content Heading 1 Size','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-size',
								  'default'     => '',
								  'name'        => 'theme_option_font_size_post_page_content_heading_1',
								  'bind'        => array(
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_content_heading_1_m',
											'default'  => '',
											'position' => 'after')
									)
							),

							array('title'       => esc_html__('Content Heading 2 Size','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-size',
								  'default'     => '',
								  'name'        => 'theme_option_font_size_post_page_content_heading_2',
								  'bind'        => array(
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_content_heading_2_m',
											'default'  => '',
											'position' => 'after')
									)
							),

							array('title'       => esc_html__('Content Heading 3 Size','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-size',
								  'default'     => '',
								  'name'        => 'theme_option_font_size_post_page_content_heading_3',
								  'bind'        => array(
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_content_heading_3_m',
											'default'  => '',
											'position' => 'after')
									)
							),

							array('title'       => esc_html__('Content Heading 4 Size','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-size',
								  'default'     => '',
								  'name'        => 'theme_option_font_size_post_page_content_heading_4',
								  'bind'        => array(
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_content_heading_4_m',
											'default'  => '',
											'position' => 'after')
									)
							),

							array('title'       => esc_html__('Content Heading 5 Size','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-size',
								  'default'     => '',
								  'name'        => 'theme_option_font_size_post_page_content_heading_5',
								  'bind'        => array(
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_content_heading_5_m',
											'default'  => '',
											'position' => 'after')
									)
							),

							array('title'       => esc_html__('Content Heading 6 Size','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-size',
								  'default'     => '',
								  'name'        => 'theme_option_font_size_post_page_content_heading_6',
								  'bind'        => array(
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_content_heading_6_m',
											'default'  => '',
											'position' => 'after')
									)
							),

							// Post Page meta Font
							array('title'       => esc_html__('Meta','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_meta',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_meta',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_post_page_meta',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_meta_m',
											'default'  => '',
											'position' => 'after')
									)
							),

							// Gallery Post Property Title (Small Heading: Comment Author included)
							array('title'       => esc_html__('Gallery Post Property Title','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_property_title',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_property_title',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_post_page_property_title',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_property_title_m',
											'default'  => '',
											'position' => 'after'),
									)
							),

							// Gallery Post Property content
							array('title'       => esc_html__('Gallery Post Property Content','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_property_content',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_property_content',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_post_page_property_content',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_property_content_m',
											'default'  => '',
											'position' => 'after')
									)
							),

							// Gallery Post Link
							array('title'       => esc_html__('Gallery Post Link Button','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_link',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_link',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_post_page_link',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_link_m',
											'default'  => '',
											'position' => 'after')
									)
							),

							// Gallery Post Caption
							array('title'       => esc_html__('Gallery Post Caption','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_caption',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_caption',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_post_page_caption',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_caption_m',
											'default'  => '',
											'position' => 'after')
									)
							),

							// Post Previous $ Next
							array('title'       => esc_html__('Post Previous & Next','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_navi',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_navi',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_post_page_navi',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_navi_m',
											'default'  => '',
											'position' => 'after')
									)
							),

							// Comment Title (Medium Heading: PageBuilder Mod Title included)
							array('title'       => esc_html__('Comments Title','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_comments_tit',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_comments_tit',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_post_page_comments_tit',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_comments_tit_m',
											'default'  => '',
											'position' => 'after')
									)
							),

							// Comment Content
							array('title'       => esc_html__('Comments Content','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_comments_con',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_comments_con',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_post_page_comments_con',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_comments_con_m',
											'default'  => '',
											'position' => 'after')
									)
							),

							//Comment Author Name
							array('title'       => esc_html__('Comments Author Name','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-size',
								  'name'        => 'theme_option_font_size_post_page_comments_author',
								  'default'     => '',
								  'bind'        => array(
								  		array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_comments_author_m',
											'default'  => '',
											'position' => 'after')

								  )
							),
								  
							
						)),

						array( /* list Font */
						'id'   => 'list',
						'title' => esc_html__('Portfolio List','air-theme'),
						'item' => array(
							
							//  Filter
							array('title'       => esc_html__('Filter','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_filter',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_filter',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_post_page_filter',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_filter_m',
											'default'  => '',
											'position' => 'after')
									)
							),
							//  Load More Button
							array('title'       => esc_html__('Load More Button','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_loadmore',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_loadmore',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_post_page_loadmore',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_loadmore_m',
											'default'  => '',
											'position' => 'after')
									)
							),
							//  Title
							array('title'       => esc_html__('Title for Item','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_list_item_tit',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_list_item_tit',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_post_page_list_item_tit',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_list_item_tit_m',
											'default'  => '',
											'position' => 'after')
									)
							), 

							//  Tag
							array('title'       => esc_html__('Tag for Item','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_list_item_tag',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_list_item_tag',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_post_page_list_item_tag',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_list_item_tag_m',
											'default'  => '',
											'position' => 'after')
									)
							),
						)),

						array( /* Blog Font */
						'id'   => 'blog',
						'title' => esc_html__('Masonry Blog','air-theme'),
						'item' => array(
							
							 //  Title
							array('title'       => esc_html__('Title for Item','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_blog_item_tit',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_blog_item_tit',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_post_page_blog_item_tit',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_blog_item_tit_m',
											'default'  => '',
											'position' => 'after')
									)
							),
							//  Meta
							array('title'       => esc_html__('Meta for Item','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_blog_item_meta',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_blog_item_meta',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_post_page_blog_item_meta',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_blog_item_meta_m',
											'default'  => '',
											'position' => 'after')
									)
							),
							// Excerpt size
							array('title' => esc_html__('Excerpt for Item','air-theme'),
								  'description' => '',
								  'type' => 'fonts-size',
								  'name' => 'theme_option_font_post_page_blog_excerpt',
								  'default' => '',
								  'bind'        => array(
								  	array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_post_page_blog_excerpt_m',
											'default'  => '',
											'position' => 'after')
								  )
							),
							
						)),

						array( /* Buttons Font */
						'id'   => 'button',
						'title' => esc_html__('Button','air-theme'),
						'item' => array(
							
							//  Buttons
							array('title'       => esc_html__('Button','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_button',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_button',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_post_page_button',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_button_m',
											'default'  => '',
											'position' => 'after')
									)
							),
						)),

						array( /* Form Font */
						'id'   => 'form',
						'title' => esc_html__('Form','air-theme'),
						'item' => array(
							
							// Text Input Box
							array('title'       => esc_html__('Text Input Box','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_form',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_form',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_post_page_form',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_form_m',
											'default'  => '',
											'position' => 'after')
									)
							),
						)),

						array( /* Archive Font */
						'id'   => 'Archive',
						'title' => esc_html__('Archive','air-theme'),
						'item' => array(
							
							// Archive Title
							array('title'       => esc_html__('Title','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_archive_tit',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_archive_tit',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_archive_tit',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_archive_tit_m',
											'default'  => '',
											'position' => 'after')
									)
							),
							// Archive Posts Title
							array('title'       => esc_html__('Posts Title','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_archive_posts_tit',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_archive_posts_tit',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_archive_posts_tit',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_archive_posts_tit_m',
											'default'  => '',
											'position' => 'after')
									)
							),	  
							 
						)),

						array( /* Widgets Font */
						'id'   => 'widgets',
						'title' => esc_html__('Widgets','air-theme'),
						'item' => array(
							
							// Widget Title
							array('title'       => esc_html__('Widget Title','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_widget_tit',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_widget_tit',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_post_page_widget_tit',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_widget_tit_m',
											'default'  => '',
											'position' => 'after')
									)
							),
							// Widget Content
							array('title'       => esc_html__('Widget Content','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_widget_con',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_widget_con',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_post_page_widget_con',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_widget_con_m',
											'default'  => '',
											'position' => 'after')
									)
							),	  
							 
						)),

						array(/* Footer Font */
						'id'   => 'footer',
						'title'=> 'Footer',
						'item' => array(


							array('title'       => esc_html__('Footer','air-theme'),
								  'description' => '',
								  'type'        => 'fonts-family',
								  'default'     => '',
								  'name'        => 'theme_option_font_post_page_footer',
								  'bind'        => array(
									  array('type'     => 'fonts-style',
											'name'     => 'theme_option_font_style_post_page_footer',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size',
											'name'     => 'theme_option_font_size_post_page_footer',
											'default'  => '',
											'position' => 'after'),
									  array('type'     => 'fonts-size-m',
											'name'     => 'theme_option_font_size_post_page_footer_m',
											'default'  => '',
											'position' => 'after')
									)
							),	
							
							
						))
				)
			),
			
			array(
				'id'      => 'options-icons',
				'name'    => esc_html__('Icons','air-theme'),
				'section' => array(
					
					array(/* Upload Icons */
						'id'    => 'icons-upload',
						'title' => esc_html__('Upload Icons','air-theme'),
						'item'  => array(
							
							// Upload Icons
							array('description' => esc_html__('select images for your icons from Media Library, it is recommended to upload 48*48 images','air-theme'),
								  'type'        => 'select-images',
								  'name'        => 'theme_option_icons_custom')))
				)
			),	
				
			array(
				'id'      => 'options-layout',
				'name'    => esc_html__('Layout','air-theme'),
				'section' => array(
					array(/*  General */
						'title' => esc_html__('General','air-theme'),
						'item'  => array(

							// Enable  page loader
							array('title'       => esc_html__('Main Container Width (px)','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_option_main_width',
								  'default'     => '1170'),

							// Border
							array('title'       => esc_html__('Border','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_enable_border',
								  'default'     => 'false'),

							array('title'       => esc_html__('Border on Top & Bottom','air-theme'),
								  'type'        => 'select',
								  'default'     => '10',
								  'name'        => 'theme_option_border_line_width',
								  'control'     => array('name'  => 'theme_option_enable_border',
														 'value' => 'true')),

							array('title'       => esc_html__('Border on Left & Right','air-theme'),
								  'type'        => 'select',
								  'default'     => '10',
								  'name'        => 'theme_option_border_line_y_width',
								  'control'     => array('name'  => 'theme_option_enable_border',
														 'value' => 'true')),

							// Enable  page loader
							array('title'       => esc_html__('Page Loader','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_enable_fadein_effect',
								  'default'     => 'false'),

							// Enable image lazyload
							array('title'       => esc_html__('Image LazyLoad','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_enable_image_lazyload',
								  'default'     => 'true'),

							// Disable All Animation
							array('title'       => esc_html__('Disable Scrolled Animation of Portfolio','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_disable_all_animation',
								  'default'     => 'false'),

							//Enable Original Images for Portfolio thumb and Single Gallery
							array('title'       => esc_html__('Enable Original Images for Portfolio','air-theme'),
							  'description' => esc_html__('the uploaded Images would be scaled automatically in order to optimize the web page loading speed. The original images will be shown if this option is activated','air-theme'),
							  'type'        => 'switch',
							  'name'        => 'theme_option_portfolio_thumb_origin',
							  'default'     => 'false'),
							
							)),
					
					array(/* Header */
						'title' => esc_html__('Header','air-theme'),
						'item'  => array(

							// Menu Style
							array('title'       => esc_html__('Header Width','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_option_header_width',
								  'default'     => 'fluid'),
						
							// Menu Style
							array('title'       => esc_html__('Menu Style','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_option_header_layout',
								  'default'     => 'navi-hide'),
								  
							// Show Social Links On Expanded Menu Panel
							array('title'       => esc_html__('Show Social Links','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_show_social',
								  'default'     => 'false'),
								  
							// Show Search Button On Expanded Menu Panel
							array('title'       => esc_html__('Show Search Button On Expanded Menu Panel','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_show_search_on_expanded_menu_panel',
								  'default'     => 'false'),

							// Show Search Button On Expanded Menu Panel
							array('title'       => esc_html__('Show Search Button On Header','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_show_search_on_header',
								  'default'     => 'false',
								  'control'  => array('name'  => 'theme_option_header_layout',
																'value' => 'navi-show')),
								  
							// Enable WPML & Show Multi Language Links On Expanded Menu Panel
							array('title'       => esc_html__('Enable WPML & Show Multi Language Links On Expanded Menu Panel','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_show_wpml_on_expanded_menu_panel',
								  'default'     => 'false'),

							// Enable Woocomerce
							array('title'       => esc_html__('Show WooComerce Cart Icon','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_show_shopping_cart',
								  'default'     => 'false'),

							// Enable Woocomerce mini cart
							array('title'       => esc_html__('Enable WooComerce Mini Cart','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_show_shopping_mini_cart',
								  'default'     => 'false',
								  'control'  => array('name'  => 'theme_option_show_shopping_cart',
																'value' => 'true')),

							//Hide Cart icon when empty
							array('title'       => esc_html__('Hide WooComerce Cart When Empty','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_hide_shopping_cart_empty',
								  'default'     => 'false'),

							 // Header Sticky
							array('title'       => esc_html__('Header Sticky','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_option_header_sticky',
								  'default'     => 'scroll-back-top',)
						)
					),
								  
					array(/* Footer */
						'title' => esc_html__('Footer','air-theme'),
						'item'  => array(

							// Footer Elements
							array('title'       => __('Footer Elements','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_option_footer_elements',
								  'default'     => '1-set'),

	                        // Information 1
							array('title'       => esc_html__('Information 1','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_option_footer_elements_infor_1',
								  'default'     => 'menu',
								  'bind'        => array(
									  array(
										  'name'    => 'theme_option_footer_elements_infor_1_menu',
										  'default' => 0,
										  'type' => 'select',
										  'position' => 'after',
										  'col_size' => 'margin-top:10px;',
										  'control' => array('name'  => 'theme_option_footer_elements_infor_1',
														     'value' => 'menu')
									  )
								  )),

	                        // Information 2
							array('title'       => esc_html__('Information 2','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_option_footer_elements_infor_2',
								  'default'     => 'copyright',
								  'bind'        => array(
									  array(
										  'name'    => 'theme_option_footer_elements_infor_2_menu',
										  'default' => 0,
										  'type' => 'select',
										  'position' => 'after',
										  'col_size' => 'margin-top:10px;',
										  'control' => array('name'  => 'theme_option_footer_elements_infor_2',
														     'value' => 'menu')
									  )
								  ),
								  'control' => array('name'  => 'theme_option_footer_elements',
													 'value' => '2-set')),

							// Enable Footer Widget for Posts
							array('title'       => __('Enable Footer Widget for Posts','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_enable_footer_widget_for_posts',
								  'default'     => 'false'),

							// Select Footer Widget for Posts
							array('title'       => __('Select Footer Widget for Posts','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_option_footer_widget_for_posts',
								  'default'     => 'true',
								  'control'     => array('name'  => 'theme_option_enable_footer_widget_for_posts',
														 'value' => 'true')),

							// Enable Footer Widget for Pages
							array('title'       => __('Enable Footer Widget for Pages','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_enable_footer_widget_for_pages',
								  'default'     => 'false'),

							// Select Footer Widget for Pages
							array('title'       => __('Select Footer Widget for Pages','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_option_footer_widget_for_pages',
								  'default'     => 'true',
								  'control'     => array('name'  => 'theme_option_enable_footer_widget_for_pages',
														 'value' => 'true')),
							
							// Hide back-to-top
							array('title'       => __('Hide Back-to-top Button','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_hide_backtotop',
								  'default'     => 'false'),
	                        
							)),
								  
					array(/* Page Post */
						'title' => esc_html__('Page/Post','air-theme'),
						'item' => array(						
														 
						    // Show Meta On Post Page
							array('title'       => esc_html__('Show Meta On Post Content Page','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_enable_meta_post_page',
								  'default'     => 'true',
								  'bind'        => array(
									  array('type'     => 'checkbox-group',
											'name'     => 'theme_option_posts_showmeta',
											'position' => 'after',
											'default'  => array('date', 'length', 'category', 'author', 'comments'),
											'control'  => array('name'  => 'theme_option_enable_meta_post_page',
																'value' => 'true')))),

							// Category to Hide on Page Post
							array('title'       => esc_html__('Category to Hide on Page/Post','air-theme'),
								  'description' => '',
								  'type'        => 'checkbox-group',
								  'name'        => 'theme_option_hide_category_on_post_page',
								  'default'     => array(),
								  'moreText'    => esc_html__('More categories','air-theme'),
								  'control'  => array('name'  => 'theme_option_enable_meta_post_page',
													  'value' => 'true')),

							array('title'       => esc_html__('Hide "ON" Before Date','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_hdie_on_date',
								  'default'     => 'false'),

							array('title'       => esc_html__('Hide "BY:" Before Author','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_hdie_by_author',
								  'default'     => 'false'),

							array('title'       => esc_html__('Hide "IN:" Before Category','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_hdie_in_category',
								  'default'     => 'false'),

							// Enable Share Buttons for Project(Gallery Post)
							array('title'       => esc_html__('Enable Share Buttons for Project(Gallery Post)','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_show_share_button_project',
								  'default'     => 'true'),

							// Enable Share Buttons for Other Post Format'
							array('title'       => esc_html__('Enable Share Buttons for Other Post Format','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_show_share_button_other',
								  'default'     => 'true'),

							// Show Post (Previous/Next) Navigation On Project Item Page（Gallery Post）
							array('title'       => esc_html__('Show Post (Previous/Next) Navigation On Project Item Page（Gallery Post）','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_show_post_navigation',
								  'default'     => 'true'),

							// Hide +  On Project Item Page（Gallery Post）
							array('title'       => esc_html__('Hide More Button(+) On Project Item Page（Gallery Post）','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_show_post_more_button',
								  'default'     => 'false',
								  'control'  => array('name'  => 'theme_option_show_post_navigation',
													  'value' => 'true')),

							// Category for More Project Button On The Bottom of Gallery Post
							array('title'       => esc_html__('Category for More Project Button On The Bottom of Gallery Post','air-theme'),
								  'description' => '',
								  'type'        => 'category',
								  'name'        => 'theme_option_category_for_more_project',
								  'default'     => 0),

							// Items Number for More Project Button On The Bottom of Gallery Post (3 Columns)
							array('title'       => esc_html__('Items Number for More Project Button On The Bottom of Gallery Post (3 Columns)','air-theme'),
								  'description' => '',
								  'type'        => 'text',
								  'name'        => 'theme_option_category_for_more_project_num',
								  'default'     => '12')
							)
					),

					array(/* WooCommerce Product */
						'title' => esc_html__('WooCommerce Product Page','air-theme'),
						'item' => array(
							array('title'       => esc_html__('Enable Lightbox for Product Image/Slider','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_woo_product_slider_lightbox',
								  'default'     => 'false'),
						 
							array('title'       => esc_html__('Enable Zoom for Product Image/Slider','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_woo_product_slider_zoom',
								  'default'     => 'false')
					)),

					array(/* Lightbox */
						'title' => esc_html__('Lightbox','air-theme'),
						'item' => array(
							array('title'       => esc_html__('Disable Zoom button','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_lightbox_disable_zoom',
								  'default'     => 'false'),
						 
							array('title'       => esc_html__('Disable FullScreen button','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_lightbox_disable_fullscreen',
								  'default'     => 'false'),

							array('title'       => esc_html__('Disable Share and Download','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_lightbox_disable_share_download',
								  'default'     => 'false'),

						 	array('title'       => esc_html__('Disable Download Only','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_option_lightbox_disable_download',
								  'default'     => 'false'), 
					))
				),

			),
			
			array(
				'id' => 'options-mobile',
				'name' => esc_html__('Mobile','air-theme'),
				'section' => array(
					
					array(/* Mobile Responsive */
						'id' => 'mobile-responsive',
						'title' => esc_html__('Responsive','air-theme'),
						'item' => array(
							
							// Enable Mobile Layout
							array('title'       => esc_html__('Enable Mobile Layout','air-theme'),
								  'description' => esc_html__('disable this option if you want to display the same with PC end','air-theme'),
								  'type'        => 'switch',
								  'name'        => 'theme_option_mobile_enable_responsive',
								  'default'     => 'true'),
							// Header Height on mobile
							array('title'       => esc_html__('Header Height on Mobile','air-theme'),
								  'description' => '',
								  'type'        => 'text',
								  'name'        => 'theme_option_header_height_mobile',
								  'col_size'    => 'width:102px;',
								  'default'     => '',
								  'control'     => array('name'  => 'theme_option_mobile_enable_responsive',
													     'value' => 'true'))
							)))
			),
			
			array(
				'id'      => 'options-featured-colors',
				'name'    => esc_html__('Featured Colors','air-theme'),
				'section' => array(
								  
					array(/* Global */
						'id'    => 'featured-colors',
						'title' => esc_html__('Featured Colors','air-theme'),
						'item'  => array(
							
							// Color by Default
							array('description' => esc_html__('Setup the featured colors for posts and modules','air-theme'),
								  'type'        => 'description',
								  'name'        => 'theme_option_featured_color_description'),
							
							// Color by Default
							array('title'       => esc_html__('Color by Default','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_featured_color_default',
								  'default'     => ''),
							
							// Color 1
							array('title'       => esc_html__('Color 1','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_featured_color_1',
								  'default'     => '#F5C9C9'),
							
							// Color 2
							array('title'       => esc_html__('Color 2','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_featured_color_2',
								  'default'     => '#F17567'),
							
							// Color 3
							array('title'       => esc_html__('Color 3','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_featured_color_3',
								  'default'     => '#5ED672'),
							
							// Color 4
							array('title'       => esc_html__('Color 4','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_featured_color_4',
								  'default'     => '#0E4792'),
							
							// Color 5
							array('title'       => esc_html__('Color 5','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_featured_color_5',
								  'default'     => '#FAE800'),
							
							// Color 6
							array('title'       => esc_html__('Color 6','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_featured_color_6',
								  'default'     => '#9FDEDF'),
							
							// Color 7
							array('title'       => esc_html__('Color 7','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_featured_color_7',
								  'default'     => '#9895A5'),
							
							// Color 8
							array('title'       => esc_html__('Color 8','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_featured_color_8',
								  'default'     => '#D63F37'),
							
							// Color 9
							array('title'       => esc_html__('Color 9','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_featured_color_9',
								  'default'     => '#AF9065'),
							
							// Color 10
							array('title'       => esc_html__('Color 10','air-theme'),
								  'description' => '',
								  'type'        => 'switch-color',
								  'name'        => 'theme_option_featured_color_10',
								  'default'     => '#313139')
								  
						)
					)
				)
			)
		);
		
		return $theme_config_fields;
	}
}


?>