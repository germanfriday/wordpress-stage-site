<?php
$switch = true;

$excerpt = false;
$title = get_the_title();
$section_class = 'archive-title';
$search_text = airtheme_get_option('theme_option_descriptions_search') ? airtheme_get_option('theme_option_descriptions_search') : esc_attr__('Type and Hit Enter','air-theme');
$news_text = airtheme_get_option('theme_option_descriptions_news') ? airtheme_get_option('theme_option_descriptions_news') : esc_attr__('News','air-theme');

if(is_single()) {
	$section_class = false;
	if(has_post_format('gallery')){
		$gallery_template = airtheme_get_post_meta(get_the_ID(), 'theme_meta_gallery_template');
		$switch = false;
		if(!$gallery_template || $gallery_template == 'none' ) {
			$switch = true;
		}
	}
	
	$excerpt = get_the_excerpt();
	$title = get_the_title();
}

if(is_day()){
	$excerpt = esc_html__('Daily Archives','air-theme');
	$title = get_the_date();
}

if(is_month()){
	$excerpt = esc_html__('Monthly Archives','air-theme');
	$title = get_the_date(_x('F Y', 'monthly archives date format', 'air-theme'));
}

if(is_year()){
	$excerpt = esc_html__('Yearly Archives','air-theme');
	$title = get_the_date(_x('Y', 'yearly archives date format', 'air-theme'));
}

if ( is_front_page() && is_home() ) {
	// Default homepage
	$title = esc_html__('Latest Posts','air-theme'); 
} elseif ( is_home() ) {
	// blog page
	$title = $news_text;
}

if(is_404()){
	$excerpt = false;
	$title = false;
}

if(is_archive()){
	$excerpt = false;
	$title = esc_html__('Archives','air-theme');
	if(class_exists('Woocommerce')){
		if(is_shop()){
			$title = esc_html__('Shop','air-theme');
		}
	}
}

if(is_tag()){
	$excerpt = esc_html__('Tag','air-theme');
	$title = esc_html__('Posts for','air-theme') . ' <strong>' . single_tag_title('', false) . '</strong> ' . $excerpt;
}

if(is_author()){
	$excerpt = esc_html__('Author','air-theme');
	$title = get_the_author();
}

if(is_category()){
	$excerpt = esc_html__('Category','air-theme');
	$title = esc_html__('Posts for','air-theme') . ' <strong>' . single_cat_title('', false) . '</strong> ' . $excerpt;
}

if(class_exists('Woocommerce')){
	if(is_product_category()) {
		$title = single_cat_title('', false);
	}
}

if(is_search()){
	$title = esc_html__( 'Search Results', 'air-theme');
	$excerpt = esc_html__( 'Search for: ', 'air-theme') . get_search_query();
}

if($switch){ ?>

    <div class="<?php echo sanitize_html_class($section_class); ?> title-wrap">
        <div class="title-wrap-con">
            <h1 class="title-wrap-tit"><?php echo wp_kses($title, airtheme_shapeSpace_allowed_html()); ?></h1>
            <?php if(is_archive() || is_home()){
				if(is_home()){

					query_posts(array(
						'tax_query' => array(
							array(
								'taxonomy' => 'post_format',
								'field' => 'slug',
								'terms' => array('post-format-gallery'),
								'operator' => 'NOT IN' 
							)
						))
					);	
				} ?>
				<div class="archive-des"><?php echo esc_html($wp_query->found_posts); esc_html_e(' items found','air-theme'); ?></div>
			<?php }
			
			if(is_single()){ ?>
                <div class="article-meta clearfix"><?php airtheme_get_template_part('single/content', 'meta'); ?></div>
            <?php } 

            if(is_search()){ ?>
            	<div class="archive-des"><?php echo wp_kses_post($excerpt); ?></div>
            	<form method="get" name="search" action="<?php echo esc_url(home_url('/')); ?>" class="archive-search-form">
                    <input type="search" name="s" class="archive-search-input" placeholder="<?php echo esc_attr($search_text); ?>">
                </form>
            <?php } ?>
        </div>
    </div>    
<?php } ?>
