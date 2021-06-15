<?php 
$social_medias = airtheme_get_option('theme_option_show_social_medias');
$social_medias_tab = airtheme_get_option('theme_option_show_social_medias_new_tab') ? ' target=_blank' : false;
	
if($social_medias && isset($social_medias['icontype'])){
	$icon_type = $social_medias['icontype'];  ?>
	<div class="footer-social">
		<ul class="socialmeida clearfix">						
		<?php foreach($icon_type as $num => $type){
			$icon = $social_medias['icon'][$num];
			$url = esc_url($social_medias['url'][$num]);
			$tip = $social_medias['tip'][$num];
			$tip_wrap =  $tip ? '<span class="socialmeida-text">'.esc_attr($tip).'</span>' : false;
		?>	
			<li class="socialmeida-li">
                <a title="<?php echo esc_attr($tip); ?>" href="<?php echo esc_url($url); ?>" class="socialmeida-a"<?php echo wp_kses_post($social_medias_tab); ?>>
                    <?php      
                    if($type == 'user'){
                        echo '<img src="' .esc_url($icon). '" alt="' .esc_attr($tip). '" /> '.wp_kses($tip_wrap, airtheme_shapeSpace_allowed_html());
                    } else { 
                    	echo '<span class="' .esc_attr($icon). '"></span> '.wp_kses($tip_wrap, airtheme_shapeSpace_allowed_html()); 
                    } ?>

                </a>
            </li>
		<?php } ?>
		</ul>
	</div>
<?php } ?>