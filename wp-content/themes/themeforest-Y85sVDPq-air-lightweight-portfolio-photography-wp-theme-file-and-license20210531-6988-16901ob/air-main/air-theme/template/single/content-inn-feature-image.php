<?php
if(is_single() && !has_post_format('gallery')){
	 
	if(has_post_thumbnail()){
			$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
			$thumb_url = esc_url($thumbnail[0]);
		
		echo '<div class="content-inn-feature-img"><img data-src="'.esc_url($thumb_url). '" alt="'.get_the_title().'"></div>';

	}
 }
?>