<?php
$page_template = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_template');
$page_list_type = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_list_type');

$columns = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_columns');
$columns_class = 'ux-portfolio-2col';
switch($columns){
	case '1': $columns_class = 'ux-portfolio-1col'; break;
	case '2': $columns_class = 'ux-portfolio-2col'; break;
	case '3': $columns_class = 'ux-portfolio-3col'; break;
	case '4': $columns_class = 'ux-portfolio-4col'; break;
	case '5': $columns_class = 'ux-portfolio-5col'; break;
	case '6': $columns_class = 'ux-portfolio-6col'; break;
}

$columns_mobile = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_columns_mobile');
$columns_mobile_class = 'ux-portfolio-1col-mobile';
switch($columns_mobile){
	case '1': $columns_mobile_class = 'ux-portfolio-1col-mobile'; break;
	case '2': $columns_mobile_class = 'ux-portfolio-2col-mobile'; break;
	case '3': $columns_mobile_class = 'ux-portfolio-3col-mobile'; break; 
}

$page_spacing_class = '';
$page_spacing_class_mobile = '';
$page_list_width_class = '';
$page_list_width_class_mobile = 'normal-container-mobile';
$spacing = '0';
$spacing_mobile = '0';

$page_spacing = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_spacing');
switch($page_spacing){
	case 'narrow': $page_spacing_class = 'ux-portfolio-spacing-10'; $spacing = '10'; break;
	case 'normal': $page_spacing_class = 'ux-portfolio-spacing-40'; $spacing = '40'; break;
	case 'no-spacing': $page_spacing_class = 'ux-portfolio-spacing-none'; $spacing = '0'; break;
}

$page_list_width = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_list_width');
switch($page_list_width){
	case 'normal': $page_list_width_class = 'container'; break;
	case 'fullwidth': $page_list_width_class = 'ux-portfolio-full'; break;
}

$page_list_width_mobile = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_list_width_mobile');
switch($page_list_width_mobile){
	case 'normal': $page_list_width_class_mobile = 'normal-container-mobile'; break;
	case 'fullwidth': $page_list_width_class_mobile = 'ux-portfolio-full-mobile'; break;
	case 'fullwidth-filled' : $page_list_width_class_mobile = 'ux-portfolio-full-filled-mobile'; break;
} 

$page_spacing_mobile = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_spacing_mobile');
switch($page_spacing_mobile){
	case 'narrow': $page_spacing_class_mobile = 'ux-portfolio-spacing-10-mobile'; $spacing_mobile = '10'; break;
	case 'normal': $page_spacing_class_mobile = 'ux-portfolio-spacing-20-mobile'; $spacing_mobile = '20'; break;
	case 'no-spacing': $page_spacing_class_mobile = 'ux-portfolio-spacing-none-mobile'; $spacing_mobile = '0'; break;
}

$page_show_filter = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_show_filter');
if($page_template == 'intro-r-filter' || $page_template == 'intro-in-list'){
	$page_show_filter = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_show_2_filter');
}

$page_has_filter = '';
$pagination = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_pagination');
if($page_show_filter && $pagination != 'page-number'){
	$page_has_filter = 'ux-has-filter';
}

$page_filter_align = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_filter_align');
$page_filter_class= 'filter-left';
switch($page_filter_align){
	case 'center': $page_filter_class= 'filter-center'; break;
	case 'right': $page_filter_class= 'filter-right'; break;
}
$page_intr = get_post_meta(get_the_ID(), 'theme_meta_page_introduction', true);

//hide category
$hide_category = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_hide_cate');
$hide_category_class = $hide_category ? 'ux-portfolio-template-hide-cate' : false;

$current_lang = apply_filters( 'wpml_current_language', false );
if ( $current_lang ) {
	echo '<input name="wpml_current_language" type="hidden" value="' .$current_lang. '">';
}

switch($page_template){
	case 'intro-above': 

		if ($page_intr) { ?>
        <section class="ux-portfolio-template-intro container ux-template-intro-left">
			<?php airtheme_get_template_part('page/content', 'intro'); ?>
        </section>
        <?php } ?>
    
        <div class="container-masonry <?php echo sanitize_html_class($hide_category_class); ?> <?php echo sanitize_html_class($page_spacing_class); ?> <?php echo sanitize_html_class($page_spacing_class_mobile); ?> <?php echo sanitize_html_class($columns_class); ?> <?php echo sanitize_html_class($columns_mobile_class); ?> <?php echo sanitize_html_class($page_list_width_class); ?> <?php echo sanitize_html_class($page_list_width_class_mobile); ?> <?php echo sanitize_html_class($page_has_filter); ?> <?php echo sanitize_html_class($page_filter_class); ?>" data-col="<?php echo esc_attr($columns); ?>" data-col-mobile="<?php echo esc_attr($columns_mobile); ?>" data-spacer="<?php echo esc_attr($spacing); ?>" data-spacer-mobile="<?php echo esc_attr($spacing_mobile); ?>"  data-template="<?php echo esc_attr($page_template); ?>">
                    
            <?php
			airtheme_get_template_part('page/content', 'filter');
			airtheme_get_template_part('page/content', 'masonry-list'); ?>
    
        </div>
    <?php
	break;
	
	case 'intro-r-filter': ?>
        <div class="container-masonry <?php echo sanitize_html_class($hide_category_class); ?> <?php echo sanitize_html_class($page_spacing_class); ?> <?php echo sanitize_html_class($page_spacing_class_mobile); ?> <?php echo sanitize_html_class($columns_class); ?> <?php echo sanitize_html_class($columns_mobile_class); ?> <?php echo sanitize_html_class($page_list_width_class); ?> <?php echo sanitize_html_class($page_list_width_class_mobile); ?> <?php echo sanitize_html_class($page_has_filter); ?>" data-col="<?php echo esc_attr($columns); ?>" data-col-mobile="<?php echo esc_attr($columns_mobile); ?>" data-spacer="<?php echo esc_attr($spacing); ?>" data-spacer-mobile="<?php echo esc_attr($spacing_mobile); ?>"  data-template="<?php echo esc_attr($page_template); ?>">
    
            <div class="container page-template-intro-left-list-right">
    
                <section class="ux-portfolio-template-intro">
                    <?php airtheme_get_template_part('page/content', 'intro'); ?>
                </section>
                
                <?php airtheme_get_template_part('page/content', 'filter');  ?>
    
            </div>
    
            <?php airtheme_get_template_part('page/content', 'masonry-list'); ?>
        </div>
    
    <?php
	break;
	
	case 'intro-in-list': ?>
        <div class="container-masonry <?php echo sanitize_html_class($hide_category_class); ?> <?php echo sanitize_html_class($page_spacing_class); ?> <?php echo sanitize_html_class($page_spacing_class_mobile); ?> <?php echo sanitize_html_class($columns_class); ?> <?php echo sanitize_html_class($columns_mobile_class); ?> <?php echo sanitize_html_class($page_list_width_class); ?> <?php echo sanitize_html_class($page_list_width_class_mobile); ?> <?php echo sanitize_html_class($page_has_filter); ?>" data-col="<?php echo esc_attr($columns); ?>" data-col-mobile="<?php echo esc_attr($columns_mobile); ?>" data-spacer="<?php echo esc_attr($spacing); ?>" data-spacer-mobile="<?php echo esc_attr($spacing_mobile); ?>"  data-template="<?php echo esc_attr($page_template); ?>">
    
            <?php airtheme_get_template_part('page/content', 'masonry-list'); ?>
        
        </div>
    <?php
	break;
	
	case 'blog-masonry':
		airtheme_get_template_part('page/blog-masonry/blog', false);
	break;
}
?>