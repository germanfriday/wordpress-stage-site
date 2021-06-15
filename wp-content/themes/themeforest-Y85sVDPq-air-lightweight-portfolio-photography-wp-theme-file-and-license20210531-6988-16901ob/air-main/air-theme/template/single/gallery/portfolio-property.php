<?php
//template
$gallery_template = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_template');
$show_property = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_show_property');
$property = airtheme_get_post_meta(get_the_ID(), 'theme_meta_enable_portfolio_property');

$container = 'container'; $row = 'row'; $col = 'col-md-3 col-sm-3';
if($gallery_template == 'on_left' || $gallery_template == 'on_right'){
	$container = ''; $row = ''; $col = '';
}

if($show_property && $property){
	
	if(isset($property['title'])){
		$property_title = $property['title'];
		$switch = true;
		
		if(count($property_title) == 1){
			if(empty($property['title'][0]) && empty($property['content'][0])){
				$switch = false;
			}
		} 

		if($switch){ ?>
		
			<div class="<?php echo sanitize_html_class($container); ?> gallery-property">
                <ul class="gallery-info-property <?php echo sanitize_html_class($row); ?>">
                    <?php foreach($property_title as $num => $title){
						$content = $property['content'][$num]; ?>
						<li class="gallery-info-property-li <?php echo esc_attr($col); ?>">
							<h3 class="gallery-info-property-item gallery-info-property-tit"><?php echo wp_kses($title, airtheme_shapeSpace_allowed_html()); ?></h3>
							<div class="gallery-info-property-item gallery-info-property-con"><?php echo wp_kses($content, airtheme_shapeSpace_allowed_html()); ?></div>
						</li>
					<?php } ?>
                </ul>    
            </div>
            
		<?php     
		}  
	}
}


?>