<?php
//template
$gallery_template = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_template');

//spacing
$gallery_image_spacing = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_image_spacing');
$gallery_spacing_class = '';
if($gallery_image_spacing){
	$gallery_spacing_class = 'gallery-spacing-' .$gallery_image_spacing;
}

//Start from
$gallery_start_from = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_start_from'); 
$gallery_start_from_class = $gallery_start_from == 'gallery' && $gallery_template == 'standard' ? 'start-from-gallery ' : false;

//style
$gallery_style = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_style');
$gallery_style_class = '';

//width
$gallery_width = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_width');
$gallery_col_width = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_col_width');

$gallery_col_class = '';
$gallery_width_class = '';
if($gallery_template == 'standard'){
	switch($gallery_width){
		case 'wide' : $gallery_width_class = 'container'; break;
		case 'narrow': $gallery_width_class = 'container-inn'; break;
	}
}elseif($gallery_template == 'on_left' || $gallery_template == 'on_right'){
	$gallery_col_class = 'single-col2-gallery-wrap';
	$gallery_width_class = 'col-sm-12 col-md-6';
	switch($gallery_col_width){
		case '1/2': $gallery_width_class = 'col-sm-12 col-md-6'; break;
		case '3/5': $gallery_width_class = 'col-sm-12 col-md-7'; break;
		case '2/3': $gallery_width_class = 'col-sm-12 col-md-8'; break;
		case '3/4': $gallery_width_class = 'col-sm-12 col-md-9'; break;
	}
	
	if($gallery_style == 'filled'){
		$gallery_style_class = $gallery_style;
	}
}
?>

<div class="<?php echo esc_attr($gallery_start_from_class); echo sanitize_html_class($gallery_col_class); ?> blog-unit-gallery-wrap <?php echo sanitize_html_class($gallery_spacing_class); ?> <?php echo esc_attr($gallery_width_class); ?>">

    <div class="single-gallery-wrap-inn" data-style="<?php echo esc_attr($gallery_style_class); ?>">

		<?php
		$gallery_video_position = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_video_position');
		
		if($gallery_video_position == 'top'){
			//Video
			airtheme_get_template_part('single/gallery/portfolio', 'video');
		}
		
        //** get portfolio image
        $portfolio = airtheme_get_post_meta(get_the_ID(), 'theme_meta_portfolio');
        
        //** get portfolio list layout builder
        $layout_builder = airtheme_get_post_meta(get_the_ID(), 'theme_meta_enable_portfolio_list_layout_builder');
		
		$index = -1;
        
        if($portfolio){
        	if(!is_array($portfolio)){ 
        		$portfolio = array($portfolio);
        	}
            $portfolio_count = count($portfolio);
			$layout_end = end($layout_builder);
			$layout_class = 'list-layout-col1'; ?>
            <div class="list-layout lightbox-photoswipe" data-gap="<?php echo esc_attr($gallery_image_spacing); ?>">
                <?php 
                if ( $layout_builder && is_array( $layout_builder ) ) {
                    foreach($layout_builder as $num => $layout){
                        if($index + 1 <= $portfolio_count){
                            switch($layout){
                                case 'list_layout_1': $i = 1; $layout_class = 'list-layout-col1'; break;
                                case 'list_layout_2': $i = 2; $layout_class = 'list-layout-col2'; break;
                                case 'list_layout_3': $i = 3; $layout_class = 'list-layout-col3'; break;
                                case 'list_layout_4': $i = 4; $layout_class = 'list-layout-col4'; break;
                            } ?>
                            
                            <div class="list-layout-col <?php echo sanitize_html_class($layout_class); ?> clearfix">
								<?php for($ii=0; $ii<$i; $ii++){ $index++;
                                    if(isset($portfolio[$index])){
                                        airtheme_interface_portfolio_template_layout($portfolio[$index], $layout);
                                    }
                                } ?>
                            </div>
                        <?php
                        }
                    }
                }
				
				if($index + 1 <= $portfolio_count){
					$remaining = $portfolio_count - ($index + 1);
					if($remaining > 0){
						switch($layout_end){
							case 'list_layout_1': $i = 1; $layout_class = 'list-layout-col1'; break;
							case 'list_layout_2': $i = 2; $layout_class = 'list-layout-col2'; break;
							case 'list_layout_3': $i = 3; $layout_class = 'list-layout-col3'; break;
							case 'list_layout_4': $i = 4; $layout_class = 'list-layout-col4'; break;
						}
						
						$row = ceil($remaining / $i);
						for($ii=0; $ii<$row; $ii++){ ?>
                            <div class="list-layout-col <?php echo sanitize_html_class($layout_class); ?> clearfix">
								<?php for($iii=0; $iii<$i; $iii++){ $index++;
                                    if(isset($portfolio[$index])){
                                        airtheme_interface_portfolio_template_layout($portfolio[$index], $layout_end);
                                    }
                                } ?>
                            </div>
                        <?php	
						}
					}
				} ?>
            </div>
        <?php
		}
		
		if($gallery_video_position == 'bottom'){
			//Video
			airtheme_get_template_part('single/gallery/portfolio', 'video');
		} ?>
    
    </div>
</div>