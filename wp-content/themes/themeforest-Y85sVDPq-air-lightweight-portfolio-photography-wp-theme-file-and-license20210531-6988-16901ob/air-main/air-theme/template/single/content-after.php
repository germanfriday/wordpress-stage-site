<?php
//gallery
$gallery_template = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_template');
$gallery_style = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_style');

$fullwidth_switch = true;
if(has_post_format('gallery') && !airtheme_enable_pb()){
	if($gallery_template == 'on_left' || $gallery_template == 'on_right'){
		if($gallery_style == 'filled'){
			$fullwidth_switch = false;
		}
	}
}

if($fullwidth_switch){
	echo '</div>';
} ?>


</div><!--End content_wrap_outer-->