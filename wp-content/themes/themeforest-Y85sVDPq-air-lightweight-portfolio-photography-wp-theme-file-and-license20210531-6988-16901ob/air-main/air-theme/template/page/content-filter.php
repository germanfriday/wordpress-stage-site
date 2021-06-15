<?php
$page_template = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_template');
$category = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_category');

if(is_array($category)){
	$category = $category[0];
}

$get_category = get_category($category);
$get_categories = get_categories(array(
	'parent' => $category
));

$page_show_filter = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_show_filter');
if($page_template == 'intro-r-filter' || $page_template == 'intro-in-list'){
	$page_show_filter = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_show_2_filter');
}
$pagination = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_pagination');
$page_filter_hidden = 'hidden';
if($page_show_filter && $pagination !='page-number'){
	$page_filter_hidden = '';
}

$category_count = 0;
if($get_category){
	$get_posts = get_posts(array(
		'posts_per_page' => -1,
		'category__in' => $category,
		'suppress_filters' => 0,
		'tax_query' => array(
			array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array('post-format-gallery', 'post-format-link'),
			)
		)
	));
	$category_count = count($get_posts);
}

switch($page_template){
	case 'intro-above': ?>
        <div class="clearfix filters <?php echo sanitize_html_class($page_filter_hidden); ?>">
            <ul class="filters-ul container">
                <li class="filters-li active"><a id="all" class="filters-a" href="#/" data-filter="*"><?php esc_html_e('All','air-theme'); ?><span class="filter-num"><?php echo esc_html($category_count); ?></span></a></li>	
				<?php if($get_categories){
					foreach($get_categories as $num => $category){
						printf('<li class="filters-li"><a class="filters-a" data-filter=".filter_%1$s" href="#%1$s/" data-catid="%5$s" data-pageid="%6$s">%3$s<span class="filter-num">%4$s</span></a></li>',
							esc_attr($category->slug),
							esc_url(get_category_link($category->term_id)),
							esc_html($category->name),
							esc_html($category->count),
							esc_attr($category->term_id),
							esc_attr(get_the_ID())
						);
					}
				} ?>
            </ul>
                                    
        </div><!--End filter-->
    <?php
    break;
	
	case 'intro-r-filter': ?>
        <div class="filters-wrap">
            <div class="clearfix filters <?php echo sanitize_html_class($page_filter_hidden); ?>">
                <ul class="filters-ul">
                    <li class="filters-li active"><a id="all" class="filters-a" href="#" data-filter="*"><?php esc_html_e('All','air-theme'); ?><span class="filter-num"><?php echo esc_html($category_count); ?></span></a></li>	
                    <?php if($get_categories){
						foreach($get_categories as $num => $category){
							printf('<li class="filters-li"><a class="filters-a" data-filter=".filter_%1$s" href="#%1$s/" data-catid="%5$s" data-pageid="%6$s">%3$s<span class="filter-num">%4$s</span></a></li>',
								esc_attr($category->slug),
								esc_url(get_category_link($category->term_id)),
								esc_html($category->name),
								esc_html($category->count),
								esc_attr($category->term_id),
								esc_attr(get_the_ID())
							);
						}
					} ?>
                </ul>
                                        
            </div><!--End filter-->
        </div>
    <?php
	break;
	
	case 'intro-in-list': ?>
        <div class="clearfix filters <?php echo sanitize_html_class($page_filter_hidden); ?>">
            <ul>
                <li class="filters-li active"><a id="all" class="filters-a" href="#" data-filter="*"><?php esc_html_e('All','air-theme'); ?><span class="filter-num"><?php echo esc_html($category_count); ?></span></a></li>	
                <?php if($get_categories){
					foreach($get_categories as $num => $category){
						printf('<li class="filters-li"><a class="filters-a" data-filter=".filter_%1$s" href="#%1$s/" data-catid="%5$s" data-pageid="%6$s">%3$s<span class="filter-num">%4$s</span></a></li>',
							esc_attr($category->slug),
							esc_url(get_category_link($category->term_id)),
							esc_html($category->name),
							esc_html($category->count),
							esc_attr($category->term_id),
							esc_attr(get_the_ID())
						);
					}
				} ?>
            </ul>
            
        </div><!--End filters-->
	<?php
    break;
} ?>