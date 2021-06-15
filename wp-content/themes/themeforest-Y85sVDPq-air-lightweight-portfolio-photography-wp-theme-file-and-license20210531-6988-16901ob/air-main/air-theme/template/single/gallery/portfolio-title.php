<?php
if(has_post_thumbnail()){
	$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
	$thumb_bg = $thumbnail[0];
}
$gallery_template = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_template'); 
$gallery_text_align = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_text_align');
$enable_title_masking = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_title_masking');
$enable_title_masking_class = $enable_title_masking && has_post_thumbnail() ? ' title-masking' : false;
$enable_title_masking_bgimg = $enable_title_masking && has_post_thumbnail() ? 'data-bg="'.esc_url($thumb_bg). '"' : false;

$container = 'container';
if($gallery_template == 'on_left' || $gallery_template == 'on_right'){
	$container = '';
}

$text_align_class = '';
if($gallery_template == 'standard' && $gallery_text_align == 'center'){
	$text_align_class = 'gallery-des-center';
}

?>

<div class="title-wrap <?php echo sanitize_html_class($container); ?> <?php echo sanitize_html_class($text_align_class); ?>">
  <div class="title-wrap-con">
		<h1 class="title-wrap-tit<?php echo esc_attr($enable_title_masking_class); ?>" <?php echo wp_kses($enable_title_masking_bgimg, airtheme_shapeSpace_allowed_html()); ?>><?php the_title(); ?></h1>
	</div>
</div>