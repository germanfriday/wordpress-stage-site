<?php
$page_template = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_template');
$category = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_category');
$per_page = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_number');
$orderby = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_orderby');
$order = airtheme_get_post_meta(get_the_ID(), 'theme_meta_order');
$hide_categroy = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_hide_cate_blog');
$hide_categroy_class = $hide_categroy ? 'blog-hide-categroy' : false;
$hide_date = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_hide_date_blog');
$hide_date_class = $hide_date ? 'blog-hide-date' : false;

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
	'terms' => array('post-format-gallery'),
	'operator' => 'NOT IN' 
));

$columns = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_columns_blog');
$columns_class = 'ux-portfolio-2col';
switch($columns){
	case '1': $columns_class = 'ux-portfolio-1col'; break;
	case '2': $columns_class = 'ux-portfolio-2col'; break;
	case '3': $columns_class = 'ux-portfolio-3col'; break;
	case '4': $columns_class = 'ux-portfolio-4col'; break;
}

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


<div class="container-masonry ux-portfolio-spacing-40 <?php echo sanitize_html_class($columns_class); ?> <?php echo sanitize_html_class($hide_categroy_class); ?> <?php echo sanitize_html_class($hide_date_class); ?> container" data-template="<?php echo esc_attr($page_template); ?>">
    <div class="masonry-list isotope <?php echo sanitize_html_class($page_pagination_class); ?>" <?php echo sanitize_text_field($page_pagination_tag); ?>>
    
		<?php if($the_query->have_posts()){
            airtheme_page_load_blog_masonry($post_id, $current);
        } ?>
    
    </div>
    
    <?php if($the_query->have_posts()){
		airtheme_page_view_pagination($post_id, $the_query); 
	} ?>
</div>