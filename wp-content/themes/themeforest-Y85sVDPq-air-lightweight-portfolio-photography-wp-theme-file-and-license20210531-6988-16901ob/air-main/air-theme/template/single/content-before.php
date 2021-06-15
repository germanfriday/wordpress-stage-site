<?php
//** get sidebar meta
$sidebar = airtheme_get_post_meta(get_the_ID(), 'theme_meta_sidebar');

if(has_post_format('gallery')){
	$sidebar = 'without-sidebar';
}

$sidebar_class = $sidebar == 'without-sidebar' ? 'fullwrap-layout' : 'container two-cols-layout'; 
$layout_class = $sidebar == 'without-sidebar' ? 'fullwrap-layout-inn' : 'sidebar-layout row';

//gallery
$gallery_template = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_template');
$gallery_style = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_style');

$fullwidth_switch = true;
if(has_post_format('gallery') && !airtheme_enable_pb()){
	if($gallery_template == 'on_left' || $gallery_template == 'on_right'){
		if($gallery_style == 'filled'){
			$fullwidth_switch = false;
			$sidebar_class = false;
		}
	}
}

echo '<div class="content_wrap_outer ' .esc_attr($sidebar_class). '">';

if($fullwidth_switch){
	echo '<div class="' .esc_attr($layout_class). '">';
}