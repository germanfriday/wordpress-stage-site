<?php
$page_template = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_template');
$page_list_type = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_list_type');
$list_type_class = '';
switch($page_list_type){
	case 'masonry-grid': $list_type_class = 'masonry-grid'; break;
	case 'grid-thumb': $list_type_class = 'grid-list'; break;
	case 'grid-title': $list_type_class = 'grid-list'; break;
}

$list_grid_class = '';
if($page_list_type == 'grid-title'){
	$list_grid_class = 'grid-list-tit-shown';
}

$page_title_align = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_title_align');
$list_align_class = '';
if($page_list_type == 'grid-title' && $page_title_align == 'center'){
	$list_align_class = 'grid-list-tit-shown-center';
}

$page_mouseover_effect = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_mouseover_effect');
$mouseover_effect_class = '';
if($page_list_type != 'grid-title'){
	switch($page_mouseover_effect){
		case 'bordered-left': $mouseover_effect_class = 'grid-mask-boxed-left'; break;
		case 'bordered-centered': $mouseover_effect_class = 'grid-mask-boxed-center'; break;
		case 'filled-left': $mouseover_effect_class = 'grid-mask-filled-left'; break;
		case 'filled-centered': $mouseover_effect_class = 'grid-mask-filled-center'; break;
		case 'img-zoom-in': $mouseover_effect_class = 'img-zoom-in'; break;
		case 'none': $mouseover_effect_class = 'mouseover-none'; break;
	}
}

$page_what_thumb = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_what_thumb');
$page_what_thumb_class = '';
if($page_what_thumb == 'open-featured-img'){
	$page_what_thumb_class = 'lightbox-photoswipe';
}

$category = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_category');
$per_page = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_number');
$orderby = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_orderby');
$order = airtheme_get_post_meta(get_the_ID(), 'theme_meta_order');

$per_page = $per_page ? $per_page : -1;

$post_id = get_the_ID();

if(!is_array($category)){
	$category = array($category);
}

$the_query = new WP_Query(array(
	'posts_per_page' => $per_page,
	'category__in' => $category,
	'orderby' => $orderby,
	'order' => $order,
	'tax_query' => array(
		array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => array('post-format-gallery', 'post-format-link'),
		)
	)
)); 

$page_pagination = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_pagination');
$page_pagination_tag = '';
$page_pagination_class = '';
if($page_pagination == 'infiniti-scroll'){
	$max_num_pages = intval($the_query->max_num_pages);
	$page_pagination_tag = 'data-paged="2" data-pageid="' .esc_attr(get_the_ID()). '" data-max="' .esc_attr($max_num_pages). '"';
	$page_pagination_class = 'infiniti-scroll';
}

global $wp_query;
$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

?>

<div class="masonry-list <?php echo sanitize_html_class($list_type_class); ?> <?php echo sanitize_html_class($list_grid_class); ?>  <?php echo sanitize_html_class($list_align_class); ?> <?php echo sanitize_html_class($mouseover_effect_class); ?> <?php echo sanitize_html_class($page_what_thumb_class); ?> <?php echo sanitize_html_class($page_pagination_class); ?>" <?php echo sanitize_text_field($page_pagination_tag); ?>>
    
    <?php if($page_template == 'intro-in-list'){
		$columns = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_columns');
		$grid_item_class = 'grid-item-small';
		if($columns != '2'){
			$grid_item_class = 'grid-item--width2 grid-item-long';
		}
		
		$classes = array();
		foreach((array) $category as $cat){
			$get_category = get_category($cat);
			$classes[] = sanitize_html_class('filter_' . $get_category->slug);
			
			$get_categories = get_categories(array(
			  'parent' => $cat
			));
			
			if($get_categories){
				foreach($get_categories as $sub_cat){
					$classes[] = sanitize_html_class('filter_' . $sub_cat->slug);
				}
			}
		}
		
		$classes = array_unique($classes); ?>
    
		<section class="<?php echo esc_attr($grid_item_class); ?> grid-item filter-in-grid <?php echo esc_attr(join(' ', $classes)); ?>">
						
			<div class="grid-item-inside">
				
				<div class="grid-item-con">
	
					<div class="grid-inn">
	
						<section class="grid-inn-con ux-portfolio-template-intro">
							<?php airtheme_get_template_part('page/content', 'intro'); ?>
						</section>
	
						<?php airtheme_get_template_part('page/content', 'filter'); ?>
                        	
					</div>
	
				</div><!--End grid-item-con-->
	
				<div class="brick-content ux-lazyload-wrap" style="padding-top:37.5%;">
				</div>
				
			</div><!--End inside-->
	
		</section>
    
    <?php
	}
	
	if($the_query->have_posts()){
		airtheme_page_load_masonry_list($post_id, $current);
	} ?>
    
</div>

<?php if($the_query->have_posts()){
	airtheme_page_view_pagination($post_id, $the_query); 
	//$max_num_pages = intval($the_query->max_num_pages);

} ?>