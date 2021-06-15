<section class="grid-item grid-item-audio">
    <div class="grid-item-inside">
        <div class="grid-text-wrap">
            <?php $airtheme_link_item = airtheme_get_post_meta(get_the_ID(), 'theme_meta_link_item');
            $airtheme_link_item_newtab = airtheme_get_post_meta(get_the_ID(), 'theme_meta_link_item_new_tab');
        	$airtheme_link_item_newtab_target = $airtheme_link_item_newtab ? ' target="_blank"' : false; 
			if($airtheme_link_item){ ?>
				<ul class="blog-unit-link">
					<?php foreach($airtheme_link_item['name'] as $i => $name){
						$url = esc_url($airtheme_link_item['url'][$i]); ?>
						<li class="blog-unit-link-li"><a href="<?php echo esc_url($url); ?>" title="<?php echo esc_attr($name); ?>" class="blog-unit-link-li-a" rel="nofollow" <?php echo wp_kses_post($airtheme_link_item_newtab_target); ?>><?php echo esc_html($name); ?></a></li>
					<?php } ?>
				</ul>
			<?php } ?>
        </div>
    </div>
</section>