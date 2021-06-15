<?php
if(is_single() && has_post_format('gallery')){
	$switch = false;
	$show_featured_image = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_show_feature_image');
	$gallery_template = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_template');
	
	if($gallery_template == 'standard'){
		$switch = true;
	}
	
	if(airtheme_enable_pb()){
		$show_featured_image = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_pb_show_feature_image');
		$switch = true;
	}
	
	if($switch && $show_featured_image){
		$thumb_bg = '';
		if(has_post_thumbnail()){
			$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
			$thumb_bg = esc_url($thumbnail[0]);
		}
				
		$image_lazyload = airtheme_get_option('theme_option_enable_image_lazyload');
		$image_lazyload_style = 'data-bg="' .esc_url($thumb_bg). '"';
		$image_lazyload_class = 'ux-lazyload-bgimg';
		if(!$image_lazyload){
			$image_lazyload_style = 'style="background-image:url(' .esc_url($thumb_bg). ');"';
			//$image_lazyload_class = '';
		}
		echo '<div class="post-cover ux-lazyload-wrap fullscreen-wrap"><div class="' .sanitize_html_class($image_lazyload_class). ' ux-background-img" ' .wp_kses($image_lazyload_style, airtheme_shapeSpace_allowed_html()). '></div></div>';
	}
}
?>