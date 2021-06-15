<?php
/****************************************************************/
/*
/* Air Functions
/*
/****************************************************************/

//Function more...
function airtheme_continue_reading_link() {
	return '';
}
function airtheme_auto_excerpt_more( $more ) {
	return ' &hellip;' . airtheme_continue_reading_link();
}
add_filter( 'excerpt_more', 'airtheme_auto_excerpt_more' );
function airtheme_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= airtheme_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'airtheme_custom_excerpt_more' );

//Function Web Title
function airtheme_interface_wp_title($title, $sep){
	global $paged, $page;

	if(is_feed() || is_search()){
		return $title;
	}

	$title .= get_bloginfo('name');

	$site_description = get_bloginfo('description', 'display');
	if($site_description &&(is_home() || is_front_page())){
		$title = "$title $sep $site_description";
	}

	if($paged >= 2 || $page >= 2){
		$title = "$title $sep " . sprintf(esc_html__('Page %s','air-theme'), max($paged, $page));
	}

	return esc_attr($title);
}

//Function Web Head Viewport
function airtheme_interface_webhead_viewport(){
	$enable_responsive = airtheme_get_option('theme_option_mobile_enable_responsive');
	
	if($enable_responsive){ ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
	<?php
	}
}

//function
function airtheme_interface_equiv_meta(){ ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<?php 
}


//Function Web Head Favicon
function airtheme_interface_webhead_favicon(){
	$favicon_icon = airtheme_get_option('theme_option_custom_favicon');
	$mobile_icon  = airtheme_get_option('theme_option_mobile_icon');
	
	$favicon_icon = $favicon_icon ? $favicon_icon : MUTI_LOCAL_URL . '/img/favicon.ico';
	$mobile_icon  = $mobile_icon ? $mobile_icon : MUTI_LOCAL_URL . '/img/favicon.ico';  
    if ( ! function_exists( 'wp_site_icon' ) || ! has_site_icon() ) { ?>
<link rel="shortcut icon" href="<?php echo esc_url($favicon_icon); ?>">
	<link rel="apple-touch-icon-precomposed" href="<?php echo esc_url($mobile_icon); ?>">
    <?php } ?>
<?php
}

//Function body class
function airtheme_interface_body_class(){
	$responsive = airtheme_get_option('theme_option_mobile_enable_responsive') ? 'responsive-ux' : false;
	$header_layout = airtheme_get_option('theme_option_header_layout') ? airtheme_get_option('theme_option_header_layout') : 'navi-hide';
	$enable_border = airtheme_get_option('theme_option_enable_border');
	$border_class = airtheme_get_option('theme_option_border_line_width');
	$border_class_y = airtheme_get_option('theme_option_border_line_y_width');
	$default_logo = airtheme_get_option('theme_option_custom_logo_choose') ? airtheme_get_option('theme_option_custom_logo_choose') : 'default-dark-logo';
	$lightbox_skin_class = airtheme_get_option('theme_option_color_skin_lightbox') ? airtheme_get_option('theme_option_color_skin_lightbox') : false;
	$social_media = airtheme_get_option('theme_option_show_social') ? airtheme_get_option('theme_option_show_social') : false;
	$social_share = airtheme_get_option('theme_option_show_share_button_project') ? airtheme_get_option('theme_option_show_share_button_project') : false;
	$border_class = $enable_border ? $border_class : false;
	$border_class_y = $enable_border ? $border_class_y : false;
	$enable_border_class = $enable_border ? 'ux-bordered' : false;
	$header_sticky = airtheme_get_option('theme_option_header_sticky');
	$lightbox_disable_zoom = airtheme_get_option('theme_option_lightbox_disable_zoom') ? airtheme_get_option('theme_option_lightbox_disable_zoom') : false;
	$lightbox_zoom_class = $lightbox_disable_zoom ? 'lightbox-disable-zoom' : false;
	$lightbox_disable_fullscreen = airtheme_get_option('theme_option_lightbox_disable_fullscreen') ? airtheme_get_option('theme_option_lightbox_disable_fullscreen') : false;
	$lightbox_fullscreen_class = $lightbox_disable_fullscreen ? 'lightbox-disable-fullscreen' : false;
	$lightbox_disable_share = airtheme_get_option('theme_option_lightbox_disable_share_download') ? airtheme_get_option('theme_option_lightbox_disable_share_download') : false;
	$lightbox_share_class = $lightbox_disable_share ? 'lightbox-disable-share' : false; 
	$lightbox_disable_download = airtheme_get_option('theme_option_lightbox_disable_download') ? airtheme_get_option('theme_option_lightbox_disable_download') : false;
	$lightbox_download_class = $lightbox_disable_download ? 'lightbox-disable-download' : false;


	$header_layout_class = false;
	switch($header_layout){
		case 'navi-show': $header_layout_class = 'navi-show'; 
		if($social_media) {
			$header_layout_class = 'navi-show navi-center';
		} 
		break; 
		case 'navi-hide': $header_layout_class = 'navi-hide';	
		break;
	}
	$body_social_share_class = false;
	
	$top_class = false;
	$bottom_class = false;
	$page_from_top_class = false;
	$non_bg_header_class = false;
	$dark_colour_class = 'dark-logo';
	$gallery_post_class  = false;
	$dark_colour = '';
	$page_template_class = false;
	$page_above_class = false;
	$page_header_sticky = '';
	$page_filter_sticky = '';
	

	switch ($header_sticky) {
		case 'sticky-always':
			$page_header_sticky = 'header-sticky-always';
			break;

		case 'sticky-disable':
			$page_header_sticky = 'header-sticky-disable';
			break;
		
		default:
			$page_header_sticky = 'header-sticky';
			break;
	}

	if($default_logo == 'default-light-logo') {
		$dark_colour = 'light';
	} else {
		$dark_colour = 'dark';
	}

	if(is_page()){
		$spacer_top = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_show_top_spacer');
		if($spacer_top){
			$top_class = 'show-top-space';
		}
		$page_template = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_template');
		$page_from_top = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_from_page_top');
		$page_from_top_class = $page_from_top ? 'page_from_top' : false;
		$dark_colour = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_colour_for_text');
		$page_show_featured = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_show_featured_image');
		$page_show_slider = airtheme_get_post_meta(get_the_ID(), 'theme_meta_enable_slider');

		if($page_template == 'none'){

			if($page_from_top && ($page_show_featured || $page_show_slider)) {
				$non_bg_header_class = 'non_bg_header'; 
			}
			
		}else{
			$page_template_class = 'page-template-masonry-body'; 
			
			if($page_template != 'blog-masonry'){
				switch($page_template){
					case 'intro-above': $page_above_class = 'page-template-intro-above-list-body'; break;
					case 'ntro-r-filter': $page_above_class = 'page-template-intro-left-list-right-body'; break;
					case 'intro-in-list': $page_above_class = 'page-template-intro-in-list-body'; break;
				}
	
				$page_show_filter = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_show_filter');
				if($page_template == 'intro-r-filter' || $page_template == 'intro-in-list'){
					$page_show_filter = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_show_2_filter');
				}

			}
		}
	} elseif(is_single()) {
		if(has_post_format('gallery')){
			$show_featured_image = false;
			$gallery_template = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_template');
			$gallery_wrap_fill = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_style');
			$gallery_start_from = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_start_from');
			if($social_share) {
				$body_social_share_class = 'gallery-show-social-share-body';
			}

			switch($gallery_template){
				case 'standard':
					$show_featured_image = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_show_feature_image');
					$dark_colour = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_colour_for_text');
					$gallery_post_class = 'single-portfolio-fullwidth';
				break;
				
				case 'on_left':
					$gallery_post_class = 'single-portfolio-2c-body single-portfolio-gallery-left';
				break;
				
				case 'on_right':
					$gallery_post_class = 'single-portfolio-2c-body single-portfolio-gallery-right';
				break;
				
				case 'slider':
					$gallery_post_class = 'single-portfolio-fullwidth-slider';
				break;
				
				case 'fullscreen':
					$dark_colour = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_colour_for_text');
					$gallery_post_class = 'single-portfolio-fullscreen-slider';
				break;
			}
			
			if(airtheme_enable_pb()){
				$show_featured_image = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_pb_show_feature_image');
				$dark_colour = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_pb_colour_for_text');
			}

			$is_gallery_side_filled = false;

			if($gallery_template == 'on_left' || $gallery_template == 'on_right'){
				if($gallery_wrap_fill == 'filled') {
					$is_gallery_side_filled = true;
				}
			}

			if($show_featured_image || $gallery_template == 'fullscreen' || ($gallery_template == 'standard' && $gallery_start_from =='gallery') || $is_gallery_side_filled){
				$page_from_top_class = 'page_from_top'; 
				$non_bg_header_class = 'non_bg_header'; 
			}
		}
		if(class_exists('Woocommerce')){
			if(is_product()) {
				$top_class = 'show-top-space';
			}
		}
	} elseif( is_archive() || is_home() || is_search() ) {
		$bottom_class = 'show-bottom-space';
		if(class_exists('Woocommerce')) {
			$bottom_class = false;
		}
	}  
	
	if($dark_colour == 'light'){
		$dark_colour_class = 'light-logo';
	} else {
		$dark_colour_class = 'dark-logo';
	}
	
	body_class(sanitize_html_class($default_logo). ' ' .sanitize_html_class($lightbox_skin_class). ' ' .sanitize_html_class($responsive). ' ' .sanitize_html_class($page_template_class). ' ' .sanitize_html_class($page_above_class). ' ' .esc_attr($header_layout_class). ' ' .esc_attr($enable_border_class). ' ' .esc_attr($border_class). ' ' .esc_attr($border_class_y). ' ' .sanitize_html_class($top_class). ' ' .sanitize_html_class($bottom_class).' ' . sanitize_html_class($page_from_top_class).' ' . sanitize_html_class($non_bg_header_class). ' ' . sanitize_html_class($dark_colour_class). ' ' . esc_attr($gallery_post_class). ' ' . sanitize_html_class($page_header_sticky). ' ' . sanitize_html_class($page_filter_sticky). ' '. sanitize_html_class($body_social_share_class).  ' '.sanitize_html_class($lightbox_zoom_class).' '.sanitize_html_class($lightbox_fullscreen_class).' '.sanitize_html_class($lightbox_share_class).' '.sanitize_html_class($lightbox_download_class). ' preload');
}

//Function post class
function airtheme_interface_post_class(){
	$article_class = '';
	
	if(is_single()){
		$sidebar = airtheme_get_post_meta(get_the_ID(), 'theme_meta_sidebar');
		if(has_post_format('gallery')){
			$sidebar = 'without-sidebar';
		}

		if(has_post_format('gallery')){
			$gallery_template = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_template');
			$article_class = 'container';
			if($gallery_template == 'fullscreen' || $gallery_template == 'slider' || $gallery_template == 'standard'){
				$article_class = false;
			}
		} else {
			if( $sidebar == 'without-sidebar' ) {
				$article_class = 'container';
			}
		}
	}
	
	post_class(sanitize_html_class($article_class));
}

//Function Logo
if( ! function_exists( 'airtheme_interface_logo' ) ) {
function airtheme_interface_logo($key = ''){
	$enable_text_logo   = airtheme_get_option('theme_option_enable_text_logo');
	$text_logo          = stripslashes(airtheme_get_option('theme_option_text_logo'));
	$text_logo          = $text_logo ? '<div class="logo-h1">' .sanitize_text_field($text_logo). '</div>' : '<div class="logo-h1">'. get_bloginfo('name'). '</div>';
	$custom_logo        = airtheme_get_option('theme_option_custom_logo');
	$custom_logo        = $custom_logo ? '<img class="logo-image logo-dark" src="' .esc_url($custom_logo). '" alt="' .get_bloginfo('name'). '" />' : '<div class="logo-h1">'. get_bloginfo('name'). '</div>';
	$foot_custom_logo   = airtheme_get_option('theme_option_custom_footer_logo');
	$foot_custom_logo   = $foot_custom_logo ? '<div id="logo-footer"><img class="logo-footer-img" src="' .esc_url($foot_custom_logo). '" alt="' .esc_attr(get_bloginfo('name')). '" /></div>' : false;
	$custom_logo_light  = airtheme_get_option('theme_option_custom_logo_light');
	$custom_logo_light  = $custom_logo_light ? '<span class="logo-light"><img class="logo-image" src="'.esc_url($custom_logo_light).'" alt="' .esc_attr(get_bloginfo('name')). '" /></span>' : false;
 	$custom_load_logo   = airtheme_get_option('theme_option_custom_logo_for_loading');
	$custom_load_logo   = $custom_load_logo ? '<img src="' .esc_url($custom_load_logo). '" alt="' .get_bloginfo('name'). '" />' : false;
 	$home_url           = esc_url(home_url('/'));
	$output             = '';
	
	switch($key){

		case 'loading': 
			$output .= '<div class="site-loading-logo">';
			$output .= $enable_text_logo ? $text_logo : $custom_load_logo;
			$output .= '</div>';
		break; 

		case 'footer': 
			$output .= '<div id="logo-footer"><a href="' . esc_url($home_url) . '" title="' . get_bloginfo('name') . '">';
			$output .= $enable_text_logo ? $text_logo : $foot_custom_logo;
			$output .= '</a></div>';
		break; 
		
		default:       
			$output .= '<div id="logo"><a class="logo-a" href="' . esc_url($home_url) . '" title="' . get_bloginfo('name') . '">';
			$output .= $enable_text_logo ? $text_logo : '<div class="logo-h1 logo-not-show-txt">' . get_bloginfo('name') . '</div>'. $custom_logo;
			$output .= ''.$custom_logo_light.'</a></div>';
		break;
		
	}
	
	echo balanceTags(wp_kses($output, airtheme_shapeSpace_allowed_html()),false);
}
}


//Function theme get option
function airtheme_get_option($key){
	$get_option = get_option('ux_theme_option');
	$return = false;
	
	if($get_option){
		if(isset($get_option[$key])){
			if($get_option[$key] != ''){
				switch($get_option[$key]){
					case 'true': $return = true; break;
					case 'false': $return = false; break;
					default: $return = $get_option[$key]; break;
				}
			}
		}else{
			switch($key){
				case 'theme_option_enable_share_buttons_for_posts': $return = true; break;
				case 'theme_option_enable_meta_post_page': $return = true; break;
				case 'theme_option_show_share_button_project': $return = true; break;
				case 'theme_option_show_share_button_other': $return = true; break;
				case 'theme_option_show_post_navigation': $return = true; break;
				case 'theme_option_mobile_enable_responsive': $return = true; break;
				case 'theme_option_enable_search_field': $return = true; break;
				case 'theme_option_posts_showmeta': $return = array(); break;
				case 'theme_option_share_buttons': $return = array('facebook', 'twitter', 'google-plus', 'pinterest'); break;
				case 'theme_option_hide_category_on_post_page': $return = array(); break;
				case 'theme_option_enable_image_lazyload': $return = true; break;
			}
		}
	}else{
		$return = airtheme_theme_option_default($key);
		
		switch($key){
			case 'theme_option_enable_share_buttons_for_posts': $return = true; break;
			case 'theme_option_enable_meta_post_page': $return = true; break;
			case 'theme_option_show_share_button_project': $return = true; break;
			case 'theme_option_show_share_button_other': $return = true; break;
			case 'theme_option_show_post_navigation': $return = true; break;
			case 'theme_option_mobile_enable_responsive': $return = true; break;
			case 'theme_option_enable_search_field': $return = true; break;
			case 'theme_option_posts_showmeta': $return = array(); break;
			case 'theme_option_share_buttons': $return = array('facebook', 'twitter', 'google-plus', 'pinterest'); break;
			case 'theme_option_hide_category_on_post_page': $return = array(); break;
			case 'theme_option_enable_image_lazyload': $return = true; break;
		}
	}
	
	return $return;
}

//Function page blog masonry
function airtheme_page_load_blog_masonry($module_post, $paged, $cat_id=false, $perpage=false, $post__not_in=array()){
	$category = airtheme_get_post_meta($module_post, 'theme_meta_page_category');
	$orderby = airtheme_get_post_meta($module_post, 'theme_meta_page_orderby');
	$order = airtheme_get_post_meta($module_post, 'theme_meta_order');
	$per_page = airtheme_get_post_meta($module_post, 'theme_meta_page_number');
	
	$per_page = $per_page ? $per_page : -1;
	
	if($cat_id){
		$category = array($cat_id);
	}
	
	if($perpage){
		$per_page = -1;
	}
	
	if(!is_array($category)){
		$category = array($category);
	}
	
	$get_posts = get_posts(array(
		'posts_per_page' => $per_page,
		'paged' => $paged,
		'orderby' => $orderby,
		'order' => $order,
		'category__in' => $category,
		'post__not_in' => $post__not_in
	));
	
	if($get_posts){
		global $post;
		
		foreach($get_posts as $num => $post){ setup_postdata($post);
			airtheme_page_load_blog_masonry_item($module_post, $post, $category);
        }
		wp_reset_postdata();
	}
}

//Function page blog masonry item
function airtheme_page_load_blog_masonry_item($module_post, $post, $category){
	//** Post format
	$get_post_format = (!get_post_format()) || get_post_format() == 'aside' || get_post_format() == 'status' || get_post_format() == 'chat' || get_post_format() == 'image' || get_post_format() == 'gallery' ? 'standard' : get_post_format();
	
	airtheme_get_template_part('page/blog-masonry/blog-item', $get_post_format);
	
}

//Function page masonry list
function airtheme_page_load_masonry_list($module_post, $paged, $cat_id=false, $perpage=false, $post__not_in=array()){
	$category = airtheme_get_post_meta($module_post, 'theme_meta_page_category');
	$orderby = airtheme_get_post_meta($module_post, 'theme_meta_page_orderby');
	$order = airtheme_get_post_meta($module_post, 'theme_meta_order');
	$per_page = airtheme_get_post_meta($module_post, 'theme_meta_page_number');
	
	$per_page = $per_page ? $per_page : -1;
	
	if($cat_id){
		$category = array($cat_id);
	}
	
	if($perpage){
		$per_page = -1;
	}
	
	if(!is_array($category)){
		$category = array($category);
	}
	
	$get_posts = get_posts(array(
		'posts_per_page' => $per_page,
		'paged' => $paged,
		'orderby' => $orderby,
		'order' => $order,
		'category__in' => $category,
		'post__not_in' => $post__not_in,
		'suppress_filters' => 0,
		'tax_query' => array(
			array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array('post-format-gallery', 'post-format-link'),
			)
		)
	));
	
	if($get_posts){
		global $post;
		
		foreach($get_posts as $num => $post){ setup_postdata($post);
			airtheme_page_load_masonry_list_item($module_post, $post, $category);
        }
		wp_reset_postdata();
	}
}

//Function page masonry list item
if ( ! function_exists('airtheme_page_load_masonry_list_item') ) {
function airtheme_page_load_masonry_list_item($module_post, $post, $category){
	$gallery_image_size = 'airtheme-thumb-43-';
	$origin_image = airtheme_get_option('theme_option_portfolio_thumb_origin');

	//gallery shape
	$gallery_shape = airtheme_get_post_meta($post->ID, 'theme_meta_gallery_shape');
	$classes = array();
	$taxonomies = get_taxonomies(array('public' => true));
	foreach((array) $taxonomies as $taxonomy){
		$list_type = airtheme_get_post_meta($module_post, 'theme_meta_page_list_type');
		$columns = airtheme_get_post_meta($module_post, 'theme_meta_page_columns');
		$page_what_thumb = airtheme_get_post_meta($module_post, 'theme_meta_page_what_thumb');
		
		if(is_object_in_taxonomy($post->post_type, $taxonomy)){
			foreach((array) get_the_terms($post->ID, $taxonomy) as $term){
				if(empty($term->slug)){
					continue;
				}
				
				$term_class = sanitize_html_class($term->slug);
				if(is_numeric($term_class) || !trim($term_class, '-')){
					$term_class = $term->term_id;
				}
				
				// 'post_tag' uses the 'tag' prefix for backward compatibility.
				$classes[] = sanitize_html_class('filter_' . $term_class);
				
				switch($columns){
					case '2': 
						if($gallery_shape == 'gallery_shape_1'){
							$gallery_image_size .= 'medium';
						}else{
							$gallery_image_size .= 'big';
						}
					break;
					case '3':
						if($gallery_shape == 'gallery_shape_1'){
							$gallery_image_size .= 'small';
						}else{
							$gallery_image_size .= 'medium';
						}
					break;
					case '4': $gallery_image_size .= 'small'; break;
					case '5': $gallery_image_size .= 'small'; break;
					case '6': $gallery_image_size .= 'small'; break;
					default: $gallery_image_size .= 'medium'; break;
				}
			}
		}
	}
	
	$classes = array_unique($classes);
	
	$gallery_shape_class = '';
	if($list_type == 'masonry-grid'){
		
		$gallery_shape_class = 'grid-item-small';
		
		switch($gallery_shape){
			case 'gallery_shape_1': $gallery_shape_class = 'grid-item-small'; $gallery_image_size = 'airtheme-thumb-43-'; break;
			case 'gallery_shape_2': $gallery_shape_class = 'grid-item-big grid-item—width2'; $gallery_image_size = 'airtheme-thumb-43-'; break;
			case 'gallery_shape_3': $gallery_shape_class = 'grid-item-tall'; $gallery_image_size = 'airtheme-thumb-23-'; break;
			case 'gallery_shape_4': $gallery_shape_class = 'grid-item-long grid-item—width2'; $gallery_image_size = 'airtheme-thumb-83-'; break;
		}
		
		switch($columns){
			case '2': 
				if($gallery_shape == 'gallery_shape_1'){
					$gallery_image_size .= 'medium';
				}else{
					$gallery_image_size .= 'big';
				}
			break;
			case '3':
				if($gallery_shape == 'gallery_shape_1'){
					$gallery_image_size .= 'small';
				}else{
					$gallery_image_size .= 'medium';
				}
			break;
			case '4': $gallery_image_size .= 'small'; break;
			case '5': $gallery_image_size .= 'small'; break;
			case '6': $gallery_image_size .= 'small'; break;
			default: $gallery_image_size .= 'medium'; break;
		}
	}
	
	if($list_type == 'masonry'){
		switch($columns){
			case '1': $gallery_image_size = 'full'; break;
			case '2': $gallery_image_size = 'airtheme-standard-thumb-medium'; break;
			case '3': $gallery_image_size = 'airtheme-standard-thumb'; break;
			default: $gallery_image_size = 'airtheme-standard-thumb'; break;
		}
	}elseif($list_type != 'masonry-grid'){
		switch($columns){
			case '2': $gallery_image_size = 'airtheme-thumb-43-medium'; break;
			default: $gallery_image_size = 'airtheme-thumb-43-small'; break;
		}
	}
	if ( $origin_image ) {
		$gallery_image_size = 'full';
	}
	$thumb_width = 650;
	$thumb_height = 490;
	$thumb_url = esc_url(get_template_directory_uri(). '/img/blank.gif');
	$thumb_caption = '';
	if(has_post_thumbnail()){
		$image_id = get_post_thumbnail_id();
		$thumb = wp_get_attachment_image_src($image_id, $gallery_image_size);
		$thumb_width = esc_attr($thumb[1]);
		$thumb_height = esc_attr($thumb[2]);
		$thumb_url = esc_url($thumb[0]);
		$thumb_caption = get_post(get_post_thumbnail_id())->post_excerpt;
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
	}
	
	$thumb_padding_top = false;
	if($thumb_height > 0 && $thumb_width > 0){
		$thumb_padding_top = 'padding-top: ' . (intval($thumb_height) / intval($thumb_width)) * 100 . '%;';
	}
	
	$page_what_thumb_data = 'class="grid-item-inside"';
	if($page_what_thumb == 'open-featured-img' && has_post_thumbnail()){
		$page_what_thumb_data = 'class="grid-item-inside" data-lightbox="true"';
	}elseif($page_what_thumb == 'open-all-img'){
		$page_what_thumb_data = 'class="grid-item-inside lightbox-photoswipe"';
	}

	//link
	$get_permalink = get_permalink();
	if ( isset( $_POST['currentLang'] ) ) {
		$currentLang = $_POST['currentLang'];
		if($currentLang != ''){
			$get_permalink = apply_filters( 'wpml_permalink', $get_permalink, $currentLang, true );							 
		}
	}
	$airtheme_link_item_newtab_target = false;
	if(has_post_format('link')){
		$airtheme_link_item = airtheme_get_post_meta(get_the_ID(), 'theme_meta_link_item');
		$airtheme_link_item_newtab = airtheme_get_post_meta(get_the_ID(), 'theme_meta_link_item_new_tab');
        $airtheme_link_item_newtab_target = $airtheme_link_item_newtab ? ' target="_blank"' : false; 
		if($airtheme_link_item){
			$get_permalink = $airtheme_link_item['url'][0];
		}
	} 

	$title_link_before = $page_what_thumb != 'open-featured-img' ? '<a href="'.esc_url($get_permalink).'" title="'.get_the_title().'" class="grid-item-tit-a" '. wp_kses_post($airtheme_link_item_newtab_target) .'>' : false;
	$title_link_after = $page_what_thumb != 'open-featured-img' ? '</a>' : false;
	
	//video
	$show_gallery_video = airtheme_get_post_meta(get_the_ID(), 'theme_meta_show_gallery_video');
	$video_embeded_code = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_video_embeded_code');
	$data_type = '';
	if($show_gallery_video && $video_embeded_code){
		$data_type = 'video';
	}
				
	$image_lazyload = airtheme_get_option('theme_option_enable_image_lazyload');
	$image_lazyload_style = 'data-bg="' .esc_url($thumb_url). '"';
	$image_lazyload_class = 'ux-lazyload-bgimg';
	$image_lazyload_img_style = 'src="' .get_template_directory_uri(). '/img/blank.gif" data-src="' .esc_url($thumb_url). '"';
	$image_lazyload_img_class = 'lazy';
	if(!$image_lazyload){
		$image_lazyload_style = 'style="background-image:url(' .esc_url($thumb_url). ');"';
		//$image_lazyload_class = '';
		$image_lazyload_img_style = 'src="' .esc_url($thumb_url). '"';
		$image_lazyload_img_class = '';
	} ?>
	
	<section class="grid-item <?php echo esc_attr($gallery_shape_class); ?> <?php echo esc_attr(join(' ', $classes)); ?>" data-postid="<?php echo esc_attr($post->ID); ?>">
		<div <?php echo sanitize_text_field($page_what_thumb_data); ?>>
			<?php if($list_type != 'grid-title'){ ?>
				<div class="grid-item-con">

					<?php if($page_what_thumb == 'open-featured-img'){
						$thumb_full = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
						$data_size = $thumb_full[1]. 'x' .$thumb_full[2]; ?>
						<a data-title="<?php echo esc_attr($thumb_caption); ?>" title="<?php echo esc_attr($thumb_caption); ?>" class="lightbox-item grid-item-mask-link" href="<?php echo esc_url($thumb_full[0]); ?>" data-type="<?php echo esc_attr($data_type); ?>" data-size="<?php echo esc_attr($data_size); ?>"><img class="lightbox-img-hide" width="<?php echo esc_attr($thumb_width); ?>" height="<?php echo esc_attr($thumb_height); ?>" src="<?php echo get_template_directory_uri(); ?>/img/blank.gif" alt="<?php echo get_the_title($post->ID); ?>" title="<?php echo get_the_title($post->ID); ?>" />
						
							<?php if($show_gallery_video && $video_embeded_code){
								echo '<div class="hidden">';
								airtheme_get_template_part('single/gallery/portfolio', 'video');
								echo '</div>';
							} ?>
						</a>
					<?php }elseif($page_what_thumb == 'open-all-img'){
						airtheme_page_load_masonry_list_open_all_img($post);
					}else{ ?>
						<a href="<?php echo esc_url($get_permalink); ?>" title="<?php the_title(); ?>" class="grid-item-mask-link grid-item-open-url" <?php echo wp_kses_post($airtheme_link_item_newtab_target); ?>></a>
					<?php } ?>
					
					<div class="grid-item-con-text">
						<span class="grid-item-cate"><?php airtheme_theme_hide_category(' ', 'grid-item-cate-a', array('data-filter' => true), $category); ?></span>
						<h2 class="grid-item-tit"><?php echo wp_kses_post($title_link_before); the_title(); echo wp_kses_post($title_link_after); ?></h2>
					</div>
				</div>
			<?php
			}else{
				if($page_what_thumb == 'open-featured-img'){
					$thumb_full = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
					$data_size = $thumb_full[1]. 'x' .$thumb_full[2]; ?>
					<a data-title="<?php echo esc_attr($thumb_caption); ?>" title="<?php echo esc_attr($thumb_caption); ?>" class="lightbox-item grid-item-mask-link" href="<?php echo esc_url($thumb_full[0]); ?>" data-type="<?php echo esc_attr($data_type); ?>" data-size="<?php echo esc_attr($data_size); ?>"><img class="lightbox-img-hide" width="<?php echo esc_attr($thumb_width); ?>" height="<?php echo esc_attr($thumb_height); ?>" src="<?php echo get_template_directory_uri(); ?>/img/blank.gif" alt="<?php echo get_the_title($post->ID); ?>" title="<?php echo get_the_title($post->ID); ?>" />
					
						<?php if($show_gallery_video && $video_embeded_code){
							echo '<div class="hidden">';
							airtheme_get_template_part('single/gallery/portfolio', 'video');
							echo '</div>';
						} ?>
					</a>
				<?php }elseif($page_what_thumb == 'open-all-img'){
					airtheme_page_load_masonry_list_open_all_img($post);
				}else{ ?>
					<a href="<?php echo esc_url($get_permalink); ?>" title="<?php the_title(); ?>" class="grid-item-mask-link"></a>
				<?php
				}
			}
			
			if($list_type != 'masonry'){ ?>

				<div class="brick-content ux-lazyload-wrap" style=" <?php echo esc_attr($thumb_padding_top); ?>">
                    <div class="<?php echo sanitize_html_class($image_lazyload_class); ?> ux-background-img" <?php echo wp_kses($image_lazyload_style, airtheme_shapeSpace_allowed_html()); ?>></div>
				</div>
			<?php
			} else { 
				if ( $image_alt == '' ) {
					$image_alt = get_the_title($post->ID);
				} ?>
				<div class="brick-content ux-lazyload-wrap" style=" <?php echo esc_attr($thumb_padding_top); ?>"> 
					<img class="ux-lazyload-img <?php echo sanitize_html_class($image_lazyload_img_class); ?>" width="<?php echo esc_attr($thumb_width); ?>" height="<?php echo esc_attr($thumb_height); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php echo esc_attr( get_the_title($post->ID) ); ?>" <?php echo wp_kses($image_lazyload_img_style, airtheme_shapeSpace_allowed_html()); ?>/>
				</div>
			<?php
			}
			
			//grid title
			if($list_type == 'grid-title'){ ?>
				<div class="grid-item-con-text-tit-shown">
					<h2 class="grid-item-tit"><?php the_title(); ?></h2>
				</div>
			<?php } ?>
			
		</div><!--End inside-->

	</section> 
<?php
}
}
//Function page load 
function airtheme_page_load_masonry_list_open_all_img($post){
	//** get portfolio image
	$portfolio = airtheme_get_post_meta($post->ID, 'theme_meta_portfolio');
	$page_what_thumb_allurl = array();
	$page_what_thumb_allsize = array();
	$index = -1;
	if($portfolio){
		foreach($portfolio as $num => $imgethumb){ $index++;
			$thumb_full = wp_get_attachment_image_src($imgethumb, 'full');
			$data_size = $thumb_full[1]. 'x' .$thumb_full[2];
			$thumb_width = $thumb_full[1];
			$thumb_height = $thumb_full[2];
			$thumb_url = esc_url($thumb_full[0]);
			$hidden = $num == 0 ? '' : 'hidden'; 
			$image_post = get_post($portfolio[$index]);
			$thumbnail_caption = $image_post ? $image_post->post_excerpt : '';
	?>
            <div class="<?php echo sanitize_html_class($hidden); ?>" data-lightbox="true">
                <a title="<?php echo esc_attr($thumbnail_caption); ?>" data-title="<?php echo esc_attr($thumbnail_caption); ?>" class="lightbox-item grid-item-mask-link" href="<?php echo esc_url($thumb_full[0]); ?>" data-size="<?php echo esc_attr($data_size); ?>"><img class="hidden" width="<?php echo esc_attr($thumb_width); ?>" height="<?php echo esc_attr($thumb_height); ?>" data-src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo get_the_title($imgethumb); ?>" title="<?php echo get_the_title($imgethumb); ?>" /></a>
            </div>
		<?php
        }
	}else{ ?>
        <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php the_title(); ?>" class="grid-item-mask-link"></a>
	<?php 
	}
}

//Function page load blog list pagination
function airtheme_page_view_pagination($post_id, $the_query, $pagination=false){
	$max_num_pages = intval($the_query->max_num_pages);
	
	if($pagination){
		$page_pagination = $pagination;
	}else{
		$page_pagination = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_pagination');
	}
	
	if($max_num_pages > 1){
		switch($page_pagination){
			case 'load-more':
				$pagination_text = airtheme_get_option('theme_option_descriptions_pagination');
				$pagination_text = $pagination_text ? $pagination_text : esc_attr__('LOAD MORE ARTICLES','air-theme');
				$loading_text = airtheme_get_option('theme_option_descriptions_pagination_loading');
				$loading_text = $loading_text ? $loading_text : esc_attr__('LOADING...','air-theme') ?>
				<div class="clearfix pagenums tw_style page_twitter" data-pagetext="<?php echo esc_attr($pagination_text); ?>" data-loadingtext="<?php echo esc_attr($loading_text); ?>">
					<a class="tw-style-a ux-btn ux-page-load-more" data-pageid="<?php echo esc_attr($post_id); ?>" data-max="<?php echo esc_attr($max_num_pages); ?>" data-paged="2" href="#"><?php echo esc_html($pagination_text); ?></a>
				</div>
			<?php
			break;

			case 'page-number': 
				$args = array(
					'base'      => @add_query_arg('paged','%#%'),
					'format'             => '',
					'total'              => $max_num_pages,
					'current'            => max( 1, get_query_var('paged') ),
					'show_all'           => false,
					'end_size'           => 1,
					'mid_size'           => 2, 
					'prev_text' => esc_attr__('Previous','air-theme'),
					'next_text' => esc_attr__('Next','air-theme'),
					'type'               => 'plain',
					'add_args'           => false,
					'add_fragment'       => '',
					'before_page_number' => '',
					'after_page_number'  => ''
				);
				echo '<div class="clearfix pagenums pagenums-default container-fluid">';
				echo wp_kses_post(paginate_links($args));  
				echo '</div>';
				break;
		}
	}
}

//Function pagination
function airtheme_interface_pagination($pages = '', $range = 3, $type = 'pagenums'){
	global $wp_query, $wp_rewrite;
	
	$posts_per_page = intval(get_option('posts_per_page'));
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	
	if($type == 'twitter'){
		$archive_query = 'is_home_____';
		
		if(is_date()){
			$archive_query  = 'is_date_____';
		}elseif(is_tag()){
			$archive_query  = 'is_tag_____';
		}elseif(is_author()){
			$archive_query  = 'is_author_____';
		}elseif(is_category()){
			$archive_query  = 'is_category_____';
		}elseif(is_archive()){
			$archive_query  = 'is_archive_____';
		}
		
		foreach($wp_query->query as $name => $query){
			$archive_query .= '@__@' .$name. '@_@' .$query;
		}
		
		$archive_query = $archive_query;
		if(function_exists('airtheme_view_module_pagenums')){
			airtheme_view_module_pagenums($archive_query, 'archive-main-list', $posts_per_page, $wp_query->found_posts, 'twitter');
		}
	}else{
		
		echo '<div class="clearfix pagenums pagenums-default container-fluid">';
		echo wp_kses_post(paginate_links( array(
			'base'      => @add_query_arg('paged','%#%'),
			'format'    => '',
			'current'   => $current,
			'prev_text' => esc_attr__('Previous','air-theme'),
			'next_text' => esc_attr__('Next','air-theme'),
			'total'     => $wp_query->max_num_pages,
			'mid_size'  => $range
		)));  
		echo '</div>';
		
	}
}

//Function Copyright
function airtheme_interface_copyright(){
	$footer_copyright = airtheme_get_option('theme_option_copyright');
	$footer_copyright = $footer_copyright ? $footer_copyright : 'Copyright uiueux.com';
	
	echo wp_kses_stripslashes($footer_copyright);
}

//Function Language Flags
function airtheme_interface_language_flags(){
	if (function_exists('icl_get_languages')) {
		$languages = icl_get_languages('skip_missing=0&orderby=code');
		if(!empty($languages)){
			
				echo '<div class="wpml-translation">';
				echo '<ul class="wpml-language-flags clearfix">';
				foreach($languages as $l){
					echo '<li>';
					if($l['country_flag_url']){
						if(!$l['active']) {
							echo '<a href="'.esc_url($l['url']).'"><img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'.esc_attr($l['language_code']).'" width="18" /><span class="languages-shortname">'.esc_attr($l['language_code']).'</span><span class="languages-name">'.esc_attr($l['native_name']).'</span></a>';
						} else {
							echo '<div class="current-language"><img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'.esc_attr($l['language_code']).'" width="18" /><span class="languages-shortname">'.esc_attr($l['language_code']).'</span><span class="languages-name">'.esc_attr($l['native_name']).'</span></div>';
						}
					}
					echo '</li>';
				}
				echo '</ul>';
				echo '</div>';
			
		}
	} else {
		echo "<p class='wpml-tip'>". esc_attr__('WPML not installed and activated.','air-theme') ."</p>";
	}
}

//Function Content wrap class
function airtheme_interface_content_class(){
	$airtheme_sidebar_class = 'col-md-9 col-sm-9';

	$output = $airtheme_sidebar_class;
	
	if(is_singular('post') || is_page() || is_singular('team_item')){
		$pb_switch = get_post_meta(get_the_ID(), 'ux-pb-switch', true);
		$sidebar = airtheme_get_post_meta(get_the_ID(), 'theme_meta_sidebar');
		
		if(is_singular('post')){
			if(has_post_format('gallery')){
				$sidebar = 'without-sidebar';
			}
		}elseif(is_page()){
			$page_template = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_template');
			if($page_template != 'none' && $page_template != 'blog-masonry'){
				$sidebar = 'without-sidebar';
			}
		}
		
		switch($sidebar){
			case 'right-sidebar':   $output = $airtheme_sidebar_class; break;
			case 'left-sidebar':    $output = $airtheme_sidebar_class. ' pull-right'; break;
			case 'without-sidebar': $output = '';
		}
	}
	
	if(airtheme_enable_team_template()){
		$output = false;
	}
	
	echo 'class="' .esc_attr($output). '"';
	
}

//ux plugins
function ux_interface_pagebuilder(){
	airtheme_interface_pagebuilder();
}

//Function Pagebuilder
function airtheme_interface_pagebuilder(){
	$switch = false;
	
	if(airtheme_enable_pb()){
		if(post_password_required()){
		 	if(is_page()){
		 		echo get_the_password_form();
		 		return;
		 	}
		}else{
		$switch = true;
		}
	}

	if($switch){
		echo '<div class="pagebuilder-wrap">';
		do_action('ux-theme-single-pagebuilder');
		echo '</div>';
	}else{
		if(airtheme_enable_pb()){
			the_excerpt();
		}
	}
}

//Function search list ajax
function airtheme_interface_search_list_load($keyword, $paged){
	$the_search = new WP_Query('s=' .$keyword. '&paged=' .$paged);
	
	if($the_search->have_posts()){
		while($the_search->have_posts()){ $the_search->the_post(); ?>
            <section class="search-result-unit">
                <h1 class="search-result-unit-tit"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                <?php if(has_excerpt()){ ?>
                    <div class="blog-unit-excerpt"><?php the_excerpt(); ?></div>
                <?php } ?>
                <div class="blog-unit-meta">
                    <?php airtheme_interface_blog_show_meta('date'); ?><?php airtheme_interface_blog_show_meta('category'); ?>
                </div>
            </section>
		<?php
        }
		wp_reset_postdata();
		
		$next_paged = (int) $paged + 1;
		
		if((int) $paged < $the_search->max_num_pages){
			echo '<div class="clearfix pagenums tw_style page_twitter">';
			echo '<a class="tw-style-a ux-btn container-inn" data-paged="' .esc_attr($next_paged). '" href="#">' . esc_attr__('Load More','air-theme'). '</a>';
			echo '</div>';
		}
	}else{
		echo '<section class="search-result-unit">';
		esc_attr_e('Sorry, no result.','air-theme');
		echo '</section>';
	}
}

//Function blog show meta
function airtheme_interface_blog_min_read($post_id = false){
	$time = 2;
	$content = get_the_content();
	
	if($post_id){
		global $post;
		$post = get_post($post_id);
		setup_postdata($post);
		$content = get_the_content();
		wp_reset_postdata(); 
	}
	
	if($content){
		$length = mb_strlen($content);
		$time = $length / 200;
	}
	
	return ceil($time);
}

//Function blog show meta
function airtheme_interface_blog_show_meta($meta, $container = false, $this_postid = false, $module_post = false){
	$showmeta = $showmeta = array('date', 'category', 'tag', 'author', 'continue-reading');
	$hideOnDate = airtheme_get_option('theme_option_hdie_on_date');
	$hideOnDateClass = $hideOnDate ? 'hidden' : false;
	$hideByAuthor = airtheme_get_option('theme_option_hdie_by_author');
	$hideByAuthorClass = $hideByAuthor ? 'hidden' : false;
	$hideInCate = airtheme_get_option('theme_option_hdie_in_category');
	$hideInCateClass = $hideInCate ? 'hidden' : false;

	$post = get_post(get_the_ID());
	
	if(is_single()){
		$showmeta = airtheme_get_option('theme_option_posts_showmeta');
	}
	
	if($module_post){ 
		$get_this_meta = get_post_meta($module_post, 'module_blog_posts_showmeta', true);
		$get_blog_type = get_post_meta($module_post, 'module_blog_type', true);
		
		if($get_blog_type == 'big_image_list'){
			$get_this_meta = get_post_meta($module_post, 'module_blog_show_meta_below_title_feature', true);
		}
		
		if(is_array($get_this_meta)){
			$showmeta = $get_this_meta;
		}else{
			$showmeta = array($get_this_meta);
		}
	}
	
	if(count($showmeta)){
		//date
		if($meta == 'date' && in_array($meta, $showmeta)){
			if($container == 'single'){
				echo '<span class="article-meta-unit article-meta-date"><span class="article-meta-date-on '.sanitize_html_class($hideOnDateClass).'">' .esc_attr__('ON ','air-theme').'</span>'; echo get_the_date(). '</span>';
			}elseif($container == 'title'){
				echo '<span class="title-wrap-meta-b-item article-meta-date"><span class="article-meta-date-on '.sanitize_html_class($hideOnDateClass).'">' .esc_attr__('ON ','air-theme').'</span>'; echo get_the_date(). '</span>';
			}else{
				echo '<span class="article-meta-date">'. get_the_date(). '</span>';
			}
		}
		
		//category
		if($meta == 'category' && in_array($meta, $showmeta) && has_category()){
			if($container == 'single'){ ?>
				<span class="article-meta-unit article-meta-unit-cate">
			<?php
				echo airtheme_theme_hide_category('  '); ?>
				</span>
			<?php }elseif($container == 'title'){
				airtheme_theme_hide_category(' ');
			}elseif($container == 'article'){
				echo '<span class="'.sanitize_html_class($hideInCateClass).'">'.esc_attr__('IN: ','air-theme').'</span>';
				airtheme_theme_hide_category(', ', 'archive-meta-a');
			}else{
				?>
			<div class="gird-blog-meta gird-blog-cate">
			<?php
				echo '<span class="'.sanitize_html_class($hideInCateClass).'">'.esc_attr__('IN ','air-theme').'</span>';
				airtheme_theme_hide_category('  ', 'grid-meta-a');
			?>
			</div>
			<?php
			}
		}
		
		//tag
		if($meta == 'tag' && in_array($meta, $showmeta) && has_tag()){
			if($container == 'single'){
				echo '<div class="article-tag clearfix"><span class="article-tag-label">'; the_tags('<span class="article-tag-label-tit"></span>', ' '); echo '</span></div>';
			}elseif($container == 'title'){
				echo '<span class="title-wrap-meta-b-item">'; the_tags('/ '); echo '</span>';
			}elseif($container == 'article'){
				$posttags = get_the_tags();
				$separator = '/ ';
				$output = '';
				if($posttags){
					foreach($posttags as $tag) {
						$output .= '<a href="'.get_tag_link( $tag->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'air-theme' ), $tag->name ) ) . '" class="archive-meta-a">'.$tag->name.'</a>'.$separator;
					}
				echo trim($output, $separator);
				}
			}
		}
		
		//author
		if($meta == 'author' && in_array($meta, $showmeta)){
			if($container == 'single'){
				echo '<span class="article-meta-unit"><span class="'.sanitize_html_class($hideByAuthorClass).'">' .esc_attr__('BY: ','air-theme').'</span>'; the_author_meta('display_name', $post->post_author); echo '</span>';
			}elseif($container == 'title'){
				echo '<span class="title-wrap-meta-b-item"><span class="'.sanitize_html_class($hideByAuthorClass).'">' .esc_attr__('BY: ','air-theme').'</span>'; the_author_meta('display_name', $post->post_author); echo '</span>';
			}elseif($container == 'article'){
				echo '<span class="'.sanitize_html_class($hideByAuthorClass).'">'. esc_attr__('BY: ','air-theme').'</span>'; the_author_meta('display_name', $post->post_author);
			}
		}
		
		//comments
		if($meta == 'comments' && in_array($meta, $showmeta)){
			$comments_count = wp_count_comments(get_the_ID());
			if($container == 'single'){ ?>
                <span class="article-meta-unit"><?php comments_number(esc_attr__('0 COMMENT', 'air-theme'), esc_attr__('1 COMMENT', 'air-theme'), esc_attr__('% COMMENTS', 'air-theme') ); ?></span>
			<?php
            }elseif($container == 'title'){ ?>
                <span class="title-wrap-meta-b-item"><?php comments_number(esc_attr__('0 COMMENT', 'air-theme'), esc_attr__('1 COMMENT', 'air-theme'), esc_attr__('% COMMENTS', 'air-theme') ); ?></span>
			<?php
			}elseif($container == 'article'){
				comments_number(esc_attr__('0 COMMENT', 'air-theme'), esc_attr__('1 COMMENT', 'air-theme'), esc_attr__('% COMMENTS', 'air-theme') );
			}
		}
		
		//Continue Reading
		if($meta == 'continue-reading' && in_array($meta, $showmeta)){
			if($container == 'single'){
				echo '<div class="blog-unit-more"><a href="' .get_permalink(). '" class="blog-unit-more-a"><span class="blog-unit-more-txt">' .esc_html__('Continue Reading','air-theme'). '</span> <span class="fa fa-long-arrow-right"></span></a></div>';
			}
		}		
	}
}

//Function video popup
function airtheme_interface_video_popup(){ ?>
    <div class="video-overlay modal">
        <span class="video-close"></span>
    </div><!--end video-overlay-->
<?php
}

//dynamic sidebar
function airtheme_dynamic_sidebar($index = 1, $count = 1){
	global $wp_registered_sidebars, $wp_registered_widgets;

	if(is_int($index)){
		$index = "sidebar-$index";
	}else{
		$index = sanitize_title($index);
		foreach((array) $wp_registered_sidebars as $key => $value){
			if(sanitize_title($value['name']) == $index){
				$index = $key;
				break;
			}
		}
	}

	$sidebars_widgets = wp_get_sidebars_widgets();
	if(empty($wp_registered_sidebars[ $index ]) || empty($sidebars_widgets[ $index ]) || ! is_array($sidebars_widgets[ $index ])){
		do_action('dynamic_sidebar_before', $index, false);
		do_action('dynamic_sidebar_after',  $index, false);
		return apply_filters('dynamic_sidebar_has_widgets', false, $index);
	}
	

	do_action('dynamic_sidebar_before', $index, true);
	$sidebar = $wp_registered_sidebars[$index];
	
	$widget_count = count((array) $sidebars_widgets[$index]);
	
	$col_class = 'col-md-4 col-sm-4';
	if($widget_count == 1){
		$col_class = 'col-md-12 col-sm-12';
	}elseif($widget_count == 2){
		$col_class = 'col-md-6 col-sm-6';
	}
	
	$did_one = false;
	foreach((array) $sidebars_widgets[$index] as $num => $id){
		
		if($num < $count){

			if(!isset($wp_registered_widgets[$id])) continue;
	
			$params = array_merge(
				array(array_merge($sidebar, array('widget_id' => $id, 'widget_name' => $wp_registered_widgets[$id]['name']))),
				(array) $wp_registered_widgets[$id]['params']
			);
	
			$classname_ = '';
			foreach((array) $wp_registered_widgets[$id]['classname'] as $cn){
				if(is_string($cn))
					$classname_ .= '_' . $cn;
				elseif(is_object($cn))
					$classname_ .= '_' . get_class($cn);
			}
			$classname_ = ltrim($classname_, '_');
			$params[0]['before_widget'] = sprintf($params[0]['before_widget'], $id, $classname_);
			
			$params = apply_filters('dynamic_sidebar_params', $params);
			
			$params[0]['before_widget'] = str_replace('col-md-4 col-sm-4', $col_class, $params[0]['before_widget']);
	
			$callback = $wp_registered_widgets[$id]['callback'];
	
			do_action('dynamic_sidebar', $wp_registered_widgets[ $id ]);
	
			if(is_callable($callback)){
				call_user_func_array($callback, $params);
				$did_one = true;
			}
		}
	}

	do_action('dynamic_sidebar_after', $index, true);

	$did_one = apply_filters('dynamic_sidebar_has_widgets', $did_one, $index);

	return $did_one;
}

//theme exclude category
function airtheme_theme_exclude_category($category){
	$hide_category = airtheme_get_option('theme_option_hide_category_on_post_page');
	if($category){
		$return = array();
		foreach($category as $cat){
			if(!in_array($cat, $hide_category)){
				array_push($return, $cat);
			}
		}
	}else{
		$return = false;
	}
	//return $return;
	return $category;
}

//theme hide category
function airtheme_theme_hide_category($separator= '', $class='article-cate-a', $data=array(), $has_cat=false){
	$hide_category = airtheme_get_option('theme_option_hide_category_on_post_page');
	if(!$hide_category){
		$hide_category = array();
	}
	
	$has_cat_ids = array();
	if($has_cat){
		foreach((array) $has_cat as $cat){
			$get_category = get_category($cat);
			$has_cat_ids[] = $get_category->term_id;
			
			$get_categories = get_categories(array(
			  'parent' => $cat
			));
			
			if($get_categories){
				foreach($get_categories as $sub_cat){
					$has_cat_ids[] = $sub_cat->term_id;
				}
			}
		}
	}
	$has_cat_ids = array_unique($has_cat_ids);
	
	$categories = get_the_category();
	$output = '';
	if($categories){
		foreach($categories as $category){
			if(!in_array($category->term_id, $hide_category)){
				$data_array = array();
				if(count($data) != 0){
					foreach($data as $data_name => $data_val){
						if($data_name == 'data-filter'){
							$data_val = '.filter_' .$category->slug;
						}
						$data_array[] = $data_name. '=' .$data_val;
					}
				}
				
				if($has_cat){
					if(in_array($category->term_id, $has_cat_ids)){
						$output .= '<a href="#'.esc_attr( $category->slug ).'/" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s", 'air-theme' ), $category->name ) ) . '" class="' .sanitize_html_class($class). '"' .join(' ', $data_array). '>'.esc_html( $category->cat_name ).'</a>'.$separator;
					}
				}else{
					$output .= '<a href="'.esc_url( get_category_link( $category->term_id ) ).'" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s", 'air-theme' ), $category->name ) ) . '" class="' .sanitize_html_class($class). '"' .join(' ', $data_array). '>'.esc_html( $category->cat_name ).'</a>'.$separator;
				}
			}
		}
		echo trim($output, $separator);
	} 
}
add_action('airtheme_interface_loop_the_category', 'airtheme_theme_hide_category', 10);

//interface footer info elements
function airtheme_interface_footer_info_element($type, $menu=false){
	switch($type){
		case 'menu':
			if($menu){
				wp_nav_menu(array(
					'menu' => $menu,
					'container' => 'div',
					'container_class' => 'footer-menu',
					'items_wrap' => '<ul>%3$s</ul>',
					'fallback_cb' => false
				));
			}
		break;
		
		case 'copyright': ?>
			<div class="copyright">
				<?php airtheme_interface_copyright(); ?>
			</div>
		<?php
		break;
		
		case 'socialicons':
			airtheme_interface_footer_social();
		break;

		case 'logo':
			airtheme_interface_logo('footer');
		break;

		case 'language':
			airtheme_interface_language_flags(); 
		break;
	}
}

//ux plugins
function ux_theme_exclude_category($category){
	return airtheme_theme_exclude_category($category);
} 

//portfolio template
if( ! function_exists( 'airtheme_interface_portfolio_template_layout' ) ) {
function airtheme_interface_portfolio_template_layout($post_id, $col){
	$post_id = (int)$post_id;
	$origin_image = airtheme_get_option('theme_option_portfolio_thumb_origin');
	$col_class = 'list-layout-col1-item';
	$image_size = 'airtheme-standard-thumb-big';
	
	switch($col){
		case 'list_layout_1': $col_class = 'list-layout-col1-item'; $image_size = 'airtheme-standard-thumb-big'; break;
		case 'list_layout_2': $col_class = 'list-layout-col2-item'; $image_size = 'airtheme-standard-thumb-medium'; break;
		case 'list_layout_3': $col_class = 'list-layout-col3-item'; $image_size = 'airtheme-standard-thumb'; break;
		case 'list_layout_4': $col_class = 'list-layout-col4-item'; $image_size = 'airtheme-standard-thumb'; break;
	}
	if ( $origin_image ) {
		$image_size = 'full';
	}
	$image_post = get_post($post_id);
	$thumbnail_caption = $image_post ? $image_post->post_excerpt : '';
	$image_alt = get_post_meta($post_id, '_wp_attachment_image_alt', TRUE) ? get_post_meta($post_id, '_wp_attachment_image_alt', TRUE) : get_the_title($post_id);
	$thumb = wp_get_attachment_image_src($post_id, $image_size);
	if(!$thumb){
		$thumb = wp_get_attachment_image_src($post_id, 'medium');
	}
	
	$thumb_full = wp_get_attachment_image_src($post_id, 'full');
	
	$thumb_padding_top = false;
	if($thumb[1] > 0 && $thumb[2] > 0) {
		$thumb_padding_top = 'padding-top: ' . (intval($thumb[2]) / intval($thumb[1])) * 100 . '%;';
	}
	
	$data_size = $thumb_full[1]. 'x' .$thumb_full[2];
	
	$image_lazyload = airtheme_get_option('theme_option_enable_image_lazyload');
	$image_lazyload_img_style = 'src="' .get_template_directory_uri(). '/img/blank.gif" data-src="' .esc_url($thumb[0]). '"';
	$image_lazyload_img_class = 'lazy';
	if(!$image_lazyload){
		$image_lazyload_img_style = 'src="' .esc_url($thumb[0]). '"';
		$image_lazyload_img_class = '';
	} 
	$show_caption = false;
	$show_caption = airtheme_get_post_meta(get_the_ID(), 'theme_meta_show_gallery_caption');
	$show_caption_align = false;
	$show_caption_align = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_gallery_caption_align');
	?>
    
	<div class="<?php echo sanitize_html_class($col_class); ?> list-layout-item" style="">
		<div class="list-layout-inside">
			<div class="single-image mouse-over" data-lightbox="true">
				<a title="<?php echo esc_attr($thumbnail_caption); ?>" class="lightbox-item" href="<?php echo esc_url($thumb_full[0]); ?>" data-size="<?php echo esc_attr($data_size); ?>">
					<span class="ux-lazyload-wrap" style=" <?php echo esc_attr($thumb_padding_top); ?>">
						<img alt="<?php echo esc_attr( $image_alt ); ?>" <?php echo wp_kses($image_lazyload_img_style, airtheme_shapeSpace_allowed_html()); ?> width="<?php echo esc_attr($thumb[1]); ?>" height="<?php echo esc_attr($thumb[2]); ?>" class="list-layout-img gallery-images-img ux-lazyload-img <?php echo sanitize_html_class($image_lazyload_img_class); ?>">
					</span>
				</a>
			</div>
			<?php if($show_caption === true && $thumbnail_caption) { ?>
			<div class="list-layout-inside-caption <?php echo sanitize_html_class($show_caption_align); ?>"><?php echo wp_kses_post($thumbnail_caption); ?></div>
			<?php } ?>
		</div><!--End list-layout-inside-->	
	</div><!--End list-layout-item-->
<?php
}
}
//wp get attachment image src
function airtheme_wp_get_attachment_image_src($image, $attachment_id, $size){
	if($size != 'full'){
		$image_pathinfo = pathinfo($image[0]);
		
		if(isset($image_pathinfo['extension'])){
			if($image_pathinfo['extension'] == 'gif'){
				$thumb = wp_get_attachment_image_src($attachment_id, 'full');
				
				$src = $thumb[0];
				$width = $thumb[1];
				$height = $thumb[2];
				$image = array( $src, $width, $height );
			}
		}
	}
	
	return $image;
}
add_filter('wp_get_attachment_image_src', 'airtheme_wp_get_attachment_image_src', 10, 3);


//Allowed html
function airtheme_shapeSpace_allowed_html() {

	$air_allowed_tags = array(
		'a' => array(
			'class' => array(),
			'href'  => array(),
			'rel'   => array(),
			'title' => array(),
			'target'=> array(),
		),
		'abbr' => array(
			'title' => array(),
			'class' => array(),
		),
		'b' => array('class' => array(),),
		'blockquote' => array(
			'cite'  => array(),
			'class' => array(),
		),
		'br' => array(),
		'cite' => array(
			'title' => array(),
			'class' => array(),
		),
		'code' => array('class' => array(),),
		'del' => array(
			'datetime' => array(),
			'title' => array(),
		),
		'dd' => array(),
		'div' => array(
			'id'    => array(),
			'class' => array(),
			'title' => array(),
			'style' => array(),
			'data-bg' => array(),
		),
		'iframe' => array(
			'width' => array(),
			'height' => array(),
			'src' => array(),
			'frameborder' => array(),
			'allowfullscreen' =>array(),
			'webkitallowfullscreen' =>array(),
			'mozallowfullscreen' =>array(),
		),
		'dl' => array(),
		'dt' => array(),
		'em' => array(),
		'hr' => array(
			'class' => array(),
			'style' => array(),
		),
		'h1' => array(
			'class' => array(),
			'style' => array(),
		),
		'h2' => array(
			'class' => array(),
			'style' => array(),
		),
		'h3' => array(
			'class' => array(),
			'style' => array(),
		),
		'h4' => array(
			'class' => array(),
			'style' => array(),
		),
		'h5' => array(
			'class' => array(),
			'style' => array(),
		),
		'h6' => array(
			'class' => array(),
			'style' => array(),
		),
		'i' => array('class' => array(),),
		'img' => array(
			'alt'    => array(),
			'class'  => array(),
			'height' => array(),
			'src'    => array(),
			'data-src' => array(),
			'width'  => array(),
		),
		'li' => array(
			'class' => array(),
		),
		'ol' => array(
			'class' => array(),
		),
		'p' => array(
			'class' => array(),
			'style' => array(),
		),
		'q' => array(
			'cite' => array(),
			'title' => array(),
		),
		'section' => array(
			'class' => array(),
		),
		'span' => array(
			'class' => array(),
			'title' => array(),
			'style' => array(),
		),
		'strike' => array(),
		'strong' => array(),
		'style' => array(),
		'ul' => array(
			'class' => array(),
		),
		'svg' => array(
			'width' => array(),
			'height' => array(),
			'viewbox' => array(),
			'version' => array(),
			'xmlns' => array(),
			'xmlns:xlink' => array(),
		),
		'g' => array(
			'stroke' => array(),
			'stroke-width' => array(),
			// 'fill' => array(),
			'fill-rule' => array(),
		),
		'path' => array(
			'd' => array(),
			'id' => array(),
			'stroke' => array(),
			'stroke-width' => array(),
			'fill' => array()
		),
		'polyline' => array(
			'stroke' => array(),
			'stroke-width' => array(),
			'stroke-linejoin' => array(),
			'stroke-miterlimit' => array(),
			'points' => array(),
			'fill' => array()
		),
		'rect' => array(
			'x' => array(),
			'y' => array(),
			'stroke' => array(),
			'stroke-width' => array(),
			'width' => array(),
			'height' => array()
		),
		'video' => array(
			'class' => array(),
			'style' => array(),
			'controls' => array(),
			'loop' => array(),
			'muted' => array(),
			'autoplay' => array(),
			'playsinline' => array(),
			'width' => array(),
			'height' => array(),
			'src' => array(),
			'data-src' => array(),
		),
		'source' => array(
			'src' => array(),
			'data-src' => array(),
			'type' => array()
		)
	);
	
	return $air_allowed_tags;
}

?>