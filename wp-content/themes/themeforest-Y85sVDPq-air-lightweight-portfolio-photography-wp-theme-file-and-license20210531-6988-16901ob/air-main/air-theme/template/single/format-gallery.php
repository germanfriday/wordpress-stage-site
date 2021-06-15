<?php
$gallery_template = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_template');
$gallery_start_from = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_start_from');
$gallery_text_align = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_text_align');
$gallery_filled_or_not = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_style');
$gallery_filled_or_not_class = '';

//If set Password 
if(post_password_required()){
	echo '<div class="container ux-password-form">'.get_the_password_form().'</div>';
	return;
} else { 

if($gallery_start_from == 'gallery' && $gallery_template == 'standard'){
	//Images
	airtheme_get_template_part('single/gallery/portfolio', 'template');
}

if($gallery_template == 'slider'){
	//Slider
	airtheme_get_template_part('single/gallery/portfolio', 'slider');
}

if($gallery_template == 'fullscreen'){
	//Fullscreen
	airtheme_get_template_part('single/gallery/portfolio', 'fullscreen');
}

$text_align_class = '';
if($gallery_template == 'standard' && $gallery_text_align == 'center'){
	$text_align_class = 'gallery-des-center';
}
		
//on left right template
if($gallery_template == 'on_left' || $gallery_template == 'on_right'){
	$pull_class = 'pull-right';
	$gallery_col_class = ' gallery-right';
	if($gallery_template == 'on_right'){
		$pull_class = '';
		$gallery_col_class = ' gallery-left';
	}

	if($gallery_filled_or_not=='filled'){
		$gallery_filled_or_not_class = ' single-gallery-col2-filled';
	}
	
	//width
	$gallery_col_width = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_col_width');
	
	$gallery_width_class = 'col-md-6';
	switch($gallery_col_width){
		case '1/2': $gallery_width_class = 'col-md-6'; break;
		case '3/5': $gallery_width_class = 'col-md-5'; break;
		case '2/3': $gallery_width_class = 'col-md-4'; break;
		case '3/4': $gallery_width_class = 'col-md-3'; break;
	} ?>
    
	<div class="row single-gallery-col2<?php echo esc_attr($gallery_filled_or_not_class); ?><?php echo esc_attr($gallery_col_class); ?>">

        <div class="single-col2-text-wrap col-sm-12 <?php echo sanitize_html_class($gallery_width_class); ?> sticky_column <?php echo sanitize_html_class($pull_class); ?>">
    
            <?php
			//Title
			airtheme_get_template_part('single/gallery/portfolio', 'title'); ?>
    
            <div class="entry"><?php the_content(); wp_link_pages(); ?></div><!--End entry-->
    
            <?php
            //Property
			airtheme_get_template_part('single/gallery/portfolio', 'property');
            
            //Gallery Link
            airtheme_get_template_part('single/gallery/portfolio', 'link');
            
			//Social
			airtheme_get_template_part('single/gallery/portfolio', 'social'); ?>
    
        </div>
    
        <?php
        //Images
        airtheme_get_template_part('single/gallery/portfolio', 'template'); ?>
    
    </div>

<?php } elseif($gallery_template == 'standard' || $gallery_template == 'slider' || $gallery_template == 'fullscreen') {
	//Title
	airtheme_get_template_part('single/gallery/portfolio', 'title'); ?>
	
	<div class="container gallery-post-des <?php echo sanitize_html_class($text_align_class); ?>">
		<div class="entry"><?php the_content(); wp_link_pages(); ?></div><!--End entry-->
		
        <?php
		//Social
		airtheme_get_template_part('single/gallery/portfolio', 'social'); ?>
        
	</div>
	
	<?php
	$enable_template = true;
	if($gallery_start_from == 'gallery' && $gallery_template == 'standard'){
		$enable_template = false;
	}elseif($gallery_template == 'slider' || $gallery_template == 'fullscreen'){
		$enable_template = false;
	}
	
	if($enable_template){
		//Images
		airtheme_get_template_part('single/gallery/portfolio', 'template');
	}
	
	//Property
	airtheme_get_template_part('single/gallery/portfolio', 'property');
	
	//Gallery Link
	airtheme_get_template_part('single/gallery/portfolio', 'link');
} else {?>
    <div class="entry"><?php the_content(); wp_link_pages(); ?></div><!--End entry-->
<?php  
}

//Navi
$airtheme_enable_navi = airtheme_get_option('theme_option_show_post_navigation');
if($airtheme_enable_navi){
	airtheme_get_template_part('single/gallery/portfolio', 'navi');
}

}
?>