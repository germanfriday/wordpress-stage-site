<?php
if(is_page()){
	$switch = false;
	
	$page_template = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_template');
	$show_title = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_show_title');
	$hide_des = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_hide_des');
	$hide_des_class = $hide_des ? ' hidden' : false;
	
	if($page_template == 'none'){
		$switch = true;
	}
	
	if($switch && $show_title){ ?>
        <div class="title-wrap container">
            <div class="title-wrap-con">
                <h1 class="title-wrap-h1"><?php the_title(); ?></h1>
                <div class="title-wrap-des <?php echo sanitize_html_class($hide_des_class); ?>"><?php the_excerpt(); ?></div>
            </div>
        </div>
	<?php
    }
}
?>