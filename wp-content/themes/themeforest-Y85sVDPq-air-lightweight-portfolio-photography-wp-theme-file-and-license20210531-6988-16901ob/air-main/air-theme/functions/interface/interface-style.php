<?php
 
//Function theme custom css
function airtheme_theme_custom_css(){
	$custom_css = '';
	
	///////////////////////// Global Color 
	//Heighlight Color
	$airtheme_color_theme_main = airtheme_get_option('theme_option_color_theme_main') ? esc_attr(airtheme_get_option('theme_option_color_theme_main')) : '#CFBCA6';
	if($airtheme_color_theme_main){
		$custom_css .= '
a, a:hover, a:focus, #header .search-top-btn-class:hover,#header .wpml-translation li a:hover,#header .wpml-translation li .current-language, .current-language .languages-shortname,.comment-form .logged a:hover,.article-cate-a,.pagenums .tw-style-a:hover,
.count-box,.social-like .wpulike .counter a.image:before,.post-meta-social .count, .height-light-ux,.post-categories a,.widget_archive li,.widget_categories li,.widget_nav_menu li,.widget_pages li,
.entry p a,.sidebar_widget a:hover, .archive-tit a:hover,.text_block a,.post_meta > li a:hover, #sidebar a:hover, #comments .comment-author a:hover,#comments .reply a:hover,.fourofour-wrap a,.archive-meta-unit a:hover,.post-meta-unit a:hover, .heighlight,.archive-meta-item a,.author-name,
.carousel-wrap a:hover, .related-post-wrap h3:hover a, .iconbox-a .iconbox-h3:hover,.iconbox-a:hover,.iocnbox:hover .icon_wrap i.fa,.blog-masony-item .item-link:hover:before,.clients_wrap .carousel-btn .carousel-btn-a:hover:before,
.blog_meta a:hover,.breadcrumbs a:hover,.link-wrap a:hover,.archive-wrap h3 a:hover,.more-link:hover,.post-color-default,.latest-posts-tags a:hover,.pagenums .current,.page-numbers.current,.fullwidth-text-white .fullwrap-with-tab-nav-a:hover,.fullwrap-with-tab-nav-a:hover,.fullwrap-with-tab-nav-a.full-nav-actived,.fullwidth-text-white .fullwrap-with-tab-nav-a.full-nav-actived,a.liquid-more-icon.ux-btn:hover,.moudle .iterblock-more.ux-btn:hover,
.gallery-info-property-con a, .grid-meta-a
{ 
	color: '.esc_attr($airtheme_color_theme_main).'; 
}
.tagcloud a:hover,.related-post-wrap h3:before,.single-image-mask,input.idi_send:hover, .iconbox-content-hide .icon_text,.process-bar, .portfolio-caroufredsel-hover
{ 
	background-color: '.esc_attr($airtheme_color_theme_main).';
}
		';
		if(class_exists('Woocommerce')){
			$custom_css .= '
body.single-product .woocommerce-Price-amount,.woocommerce-MyAccount-navigation-link.is-active a,.woocommerce-MyAccount-navigation-link:hover a { 
	color: '.esc_attr($airtheme_color_theme_main).'; 
}
.woocommerce span.onsale, .woocommerce-page span.onsale,.woocomerce-cart-number {
	background-color: '.esc_attr($airtheme_color_theme_main).';
}
			';
		}
	}

	// Auxiliary Color
	$ux_color_second_auxiliary = airtheme_get_option('theme_option_color_second_auxiliary') ? esc_attr(airtheme_get_option('theme_option_color_second_auxiliary')) : '#f8f8f8';
	if($ux_color_second_auxiliary){   
		$custom_css .= '
.tagcloud a,.gallery-list-contiune, .author-unit-inn, .archive-bar,.audio-unit,.blog-unit-link-li,.blog-unit-quote,.slider-panel,#main_title_wrap, .promote-wrap,.process-bar-wrap,.post_meta,.pagenumber a,.standard-blog-link-wrap,.blog-item.quote,.portfolio-standatd-tit-wrap:before,.quote-wrap,.entry pre,.text_block pre,.isotope-item.quote .blog-masony-item,.blog-masony-item .item-link-wrap,.pagenumber span,.testimenials,.testimenials .arrow-bg,.accordion-heading,.testimonial-thum-bg,.single-feild,.fullwidth-text-white .iconbox-content-hide .icon_wrap
{ 
	background-color: '.esc_attr($ux_color_second_auxiliary).'; 
}
.progress_bars_with_image_content .bar .bar_noactive.grey
{
  color: '.esc_attr($ux_color_second_auxiliary).'; 
}
body.archive #wrap,.widget_archive li,.widget_categories li,.widget_nav_menu li,.widget_pages li,.widget_recent_entries li,.widget_recent_comments li,.widget_meta li,.widget_rss li,
.nav-tabs,.border-style2,.border-style3,.nav-tabs > li > a,.tab-content,.nav-tabs > .active > a, .nav-tabs > .active > a:hover, .nav-tabs > .active > a:focus,.tabs-v,.single-feild,.archive-unit
{ 
	border-color: '.esc_attr($ux_color_second_auxiliary).'; 
} 
.tab-content.tab-content-v,blockquote
{
	border-left-color: '.esc_attr($ux_color_second_auxiliary).'; 
} 
.tabs-v .nav-tabs > .active > a,.line_grey
{
	border-top-color: '.esc_attr($ux_color_second_auxiliary).'; 
}
		';
	}

	// Page Body BG Color
	$airtheme_bg_page_post = airtheme_get_option('theme_option_bg_page_post') ? esc_attr(airtheme_get_option('theme_option_bg_page_post')) : '#fff';
	if($airtheme_bg_page_post){
		$custom_css .= '
body,#wrap-outer,#wrap,#search-overlay,#top-wrap,#main,.separator h4, .carousel-control,#login-form.modal .modal-dialog,.nav-tabs > .active > a, .nav-tabs > .active > a:hover, .nav-tabs > .active > a:focus,.tab-content,.filters.filter-floating li a:before,.standard-list-item:hover .portfolio-standatd-tit-wrap:before,.ux-mobile #main-navi-inn 
{ 
	background-color: '.esc_attr($airtheme_bg_page_post).';
}
.testimenials span.arrow,.nav-tabs > .active > a, .nav-tabs > .active > a:hover, .nav-tabs > .active > a:focus { 
	border-bottom-color: '.esc_attr($airtheme_bg_page_post).'; 
}
	.tabs-v .nav-tabs > .active > a
{ 
	border-right-color: '.esc_attr($airtheme_bg_page_post).'; 
}
.quote-wrap, .mouse-icon,.social-icon-triggle,.carousel-control, .countdown_amount,.countdown_section,.blog-unit-link-li:hover,.blog-unit-link-li:hover a 
{
	color: '.esc_attr($airtheme_bg_page_post).'; 
}
		';
	}

	//Header BGcolor
	$airtheme_header_bg = airtheme_get_option('theme_option_bg_header') ? esc_attr(airtheme_get_option('theme_option_bg_header')) : '#fff';
	if($airtheme_header_bg){
		$custom_css .= '
#header,#menu-panel,.page_from_top.header-scrolled #header,.page_from_top.header-scrolling.header-sticky-always #header,#navi-header .sub-menu 
{ 
	background-color: '.esc_attr($airtheme_header_bg).';
}
		';
	}

	//Page loader BGcolor
	$airtheme_bg_page_loader = airtheme_get_option('theme_option_bg_page_loader') ? esc_attr(airtheme_get_option('theme_option_bg_page_loader')) : '#fff';
	if($airtheme_bg_page_loader){
		$custom_css .= '
.page-loading
{ 
	background-color: '.esc_attr($airtheme_bg_page_loader).';
}
		';
	}

	//Selected Text Bg Color
	$airtheme_color_selected_text_bg = airtheme_get_option('theme_option_color_selected_text_bg') ? esc_attr(airtheme_get_option('theme_option_color_selected_text_bg')) : false;
	if($airtheme_color_selected_text_bg){
		$custom_css .= '
::selection { background: '.esc_attr($airtheme_color_selected_text_bg).'; }
::-moz-selection { background: '.esc_attr($airtheme_color_selected_text_bg).'; }
::-webkit-selection { background: '.esc_attr($airtheme_color_selected_text_bg).'; }
		';
	}

	//Bordered
	$airtheme_color_enable_border = esc_attr(airtheme_get_option('theme_option_enable_border'));
	if($airtheme_color_enable_border){

		//Border Color
		$ux_color_bordered = airtheme_get_option('theme_option_border_color') ? esc_attr(airtheme_get_option('theme_option_border_color')) : '#C8C8CC';
		if($ux_color_bordered){   
			$custom_css .= '
body.ux-bordered,.bordered-top, .bordered-bottom 
{
	background-color: '.esc_attr($ux_color_bordered).'; 
}
			';
		}
	}
 

	///////////////////////// Text Logo 

	//Text Logo Color Dark (default)
	$airtheme_color_text_logo = airtheme_get_option('theme_option_color_logo') ? esc_attr(airtheme_get_option('theme_option_color_logo')) : '#313139';
	if($airtheme_color_text_logo){
		$custom_css .= '
.logo-h1 
{
	color: '.esc_attr($airtheme_color_text_logo).'; 
}
		';
	}

	//Logo Text Color Light
	$airtheme_color_text_logo_light = airtheme_get_option('theme_option_logo_text_color_light') ? esc_attr(airtheme_get_option('theme_option_logo_text_color_light')) : '#ffffff';
	if($airtheme_color_text_logo_light){
		$custom_css .= '
.light-logo .logo-h1,.default-light-logo .logo-h1,.light-logo .ux-woocomerce-cart-a
{
	color: '.esc_attr($airtheme_color_text_logo_light).'; 
}
		';
	}

	///////////////////////// Menu Color

	//Menu on Header Dark
	$airtheme_color_text_menu_icon = airtheme_get_option('theme_option_menu_icon_dark') ? esc_attr(airtheme_get_option('theme_option_menu_icon_dark')) : '#313139';
	if($airtheme_color_text_menu_icon ){
		$custom_css .= '
#navi-trigger,#header .socialmeida-a, #navi_wrap > ul > li a, #navi_wrap > ul > li a,
.light-logo.default-dark-logo.header-scrolled #navi-trigger, 
.light-logo.default-dark-logo.header-scrolled #header .socialmeida-a, 
.light-logo.default-dark-logo.header-scrolled #navi_wrap > ul > li a,
.light-logo.default-dark-logo.header-scrolled .ux-woocomerce-cart-a,
.default-light-logo.dark-logo.single-portfolio-fullscreen-slider .blog-unit-gallery-wrap .arrow-item, 
.default-light-logo.dark-logo #ux-slider-down,
.default-light-logo.dark-logo.single-portfolio-fullscreen-slider .owl-dots,
.dark-logo .top-slider .carousel-des-wrap-tit-a,
.dark-logo .top-slider .article-cate-a,
.dark-logo .top-slider .owl-dot
{
	color: '.esc_attr($airtheme_color_text_menu_icon ).'; 
}	
		';
	}

	//Menu on Header Light
	$airtheme_color_text_logo_menu_icon_light = airtheme_get_option('theme_option_menu_icon_light') ? esc_attr(airtheme_get_option('theme_option_menu_icon_light')) : '#ffffff';
	if($airtheme_color_text_logo_menu_icon_light ){
		$custom_css .= '
.light-logo #navi-trigger,.default-light-logo.dark-logo.header-scrolled #navi-trigger,
.light-logo #header .socialmeida-a,.default-light-logo.dark-logo.header-scrolled #header .socialmeida-a,
.light-logo #navi_wrap > ul > li a,.default-light-logo.dark-logo.header-scrolled #navi_wrap > ul > li a,
.light-logo .ux-woocomerce-cart-a, .default-light-logo.dark-logo.header-scrolled .ux-woocomerce-cart-a,
.light-logo.single-portfolio-fullscreen-slider .blog-unit-gallery-wrap .arrow-item, .default-light-logo.single-portfolio-fullscreen-slider .blog-unit-gallery-wrap .arrow-item, 
.light-logo #ux-slider-down, .default-light-logo #ux-slider-down,
.light-logo.single-portfolio-fullscreen-slider .owl-dots, .default-light-logo.single-portfolio-fullscreen-slider .owl-dots, .light-logo.single-portfolio-fullscreen-slider .owl-dot.active:before,.default-light-logo.single-portfolio-fullscreen-slider .owl-dot.active:before,
.light-logo .top-slider .carousel-des-wrap-tit-a,
.light-logo .top-slider .article-cate-a,
.light-logo .top-slider .owl-dot
{
	color: '.esc_attr($airtheme_color_text_logo_menu_icon_light).'; 
}	
		';
	}

	//Menu Item on Expanded Panel
	$airtheme_color_expanded_panel = airtheme_get_option('theme_option_menu_item_color_on_panel') ? esc_attr(airtheme_get_option('theme_option_menu_item_color_on_panel')) : '#313139';
	if($airtheme_color_expanded_panel ){
		$custom_css .= '
#navi a,.menu-panel-inn .socialmeida-a,.menu-panel-inn .socialmeida-a:hover,.search-top-btn-class,#menu-panel .languages-shortname
{
	color: '.esc_attr($airtheme_color_expanded_panel ).'; 
}
		';
	}
	
	
	///////////////////////// Posts & Pages Color
	
	// Title color 
	$theme_option_color_heading = airtheme_get_option('theme_option_color_heading') ? esc_attr(airtheme_get_option('theme_option_color_heading')) : '#313139';
	if($theme_option_color_heading){
		$custom_css .= '
.title-wrap-tit,.title-wrap-h1,h1,h2,h3,h4,h5,h6,.archive-tit a, .item-title-a,#sidebar .social_active i:hover,.article-cate-a:hover:after,
.portfolio-standatd-tags a[rel="tag"]:hover:after,.nav-tabs > .active > a, .nav-tabs > li > a:hover, .nav-tabs > .active > a:focus, .post-navi-a,.moudle .ux-btn,.mainlist-meta, .mainlist-meta a,carousel-des-wrap-tit-a,
.jqbar.vertical span,.team-item-con-back a,.team-item-con-back i,.team-item-con-h p,.slider-panel-item h2.slider-title a,.bignumber-item.post-color-default,.blog-item .date-block,
.clients_wrap .carousel-btn .carousel-btn-a, .image3-1-unit-tit
{ 
	color:'.esc_attr($theme_option_color_heading).'; 
}
.post_social:before, .post_social:after,.title-ux.line_under_over,.gallery-wrap-sidebar .entry, .social-share 
{ 
	border-color: '.esc_attr($theme_option_color_heading).'; 
} 
.team-item-con,.ux-btn:before,.title-ux.line_both_sides:before,.title-ux.line_both_sides:after,.galleria-info,#float-bar-triggler,.float-bar-inn,.short_line:after, 
.separator_inn.bg- ,.countdown_section 
{
	background-color: '.esc_attr($theme_option_color_heading).';
}
		';
	}
	
	// Content text Color 
	$airtheme_color_content = airtheme_get_option('theme_option_color_content_text') ? esc_attr(airtheme_get_option('theme_option_color_content_text')) : '#414145';
	if($airtheme_color_content){
		$custom_css .= '
			
body,a,.entry p a:hover,.text_block, .article-tag-label a[rel="tag"]:after,.article-meta-unit-cate > a.article-cate-a:after,.article-cate-a:hover,.text_block a:hover,#content_wrap,#comments,.blog-item-excerpt,.archive-unit-excerpt,.archive-meta-item a:hover,.entry code,.text_block code,
h3#reply-title small, #comments .nav-tabs li.active h3#reply-title .logged,#comments .nav-tabs li a:hover h3 .logged,.testimonial-thum-bg i.fa,.post-navi-go-back-a:focus ,
.header-info-mobile,.carousel-wrap a.disabled:hover,.stars a:hover,.moudle .iterblock-more.ux-btn,.moudle .liquid-more-icon.ux-btn,.fullwrap-block-inn a
{ 
	color: '.esc_attr($airtheme_color_content).'; 
}
.blog-unit-link-li:hover {
	background-color: '.esc_attr($airtheme_color_content).'; 
}
			
		';
	}
	
	//Meta text Color 
	$airtheme_color_auxiliary_content = airtheme_get_option('theme_option_color_auxiliary_content') ? esc_attr(airtheme_get_option('theme_option_color_auxiliary_content')) : '#adadad';
	if($airtheme_color_auxiliary_content){
		$custom_css .= '
.article-meta-unit,.article-meta-unit:not(.article-meta-unit-cate) > a,.article-tag-label-tit, .comment-meta,.comment-meta a,.title-wrap-des,.blog_meta_cate,.blog_meta_cate a,.gird-blog-meta,.grid-meta-a:after,.comment-form-cookies-consent
{ 
	color:'.esc_attr($airtheme_color_auxiliary_content).'; 
}
.comment-author:after {
	background-color: '.esc_attr($airtheme_color_auxiliary_content).'; 
}
.blog-item-more-a:hover 
{
	border-color: '.esc_attr($airtheme_color_auxiliary_content).'; 
}
		';
		if(class_exists('Woocommerce')){
$custom_css .= '.woocommerce .price del, .woocommerce .price del .woocommerce-Price-amount,.woocommerce-account .addresses .title .edit {
	color:'.esc_attr($airtheme_color_auxiliary_content).'; 
}';
		}

	} 

	// Gallery Post Property Title
	$airtheme_color_property_tit = airtheme_get_option('theme_option_color_property_tit') ? esc_attr(airtheme_get_option('theme_option_color_property_tit')) : '#313139';
	if($airtheme_color_property_tit){
		$custom_css .= '
.gallery-info-property-tit 
{ 
	color: '.esc_attr($airtheme_color_property_tit).';
}
		';
	}

	// Gallery Post Property Content
	$airtheme_color_property_con = airtheme_get_option('theme_option_color_property_con') ? esc_attr(airtheme_get_option('theme_option_color_property_con')) : '#313139';
	if($airtheme_color_property_con){
		$custom_css .= '
.gallery-info-property-con,.gallery-info-property-con a:hover 
{ 
	color: '.esc_attr($airtheme_color_property_con).';
}
		';
	}

	// Gallery Post Link Button
	$airtheme_color_gallery_link = airtheme_get_option('theme_option_color_gallery_link') ? esc_attr(airtheme_get_option('theme_option_color_gallery_link')) : '#313139';
	if($airtheme_color_gallery_link){
		$custom_css .= '
.gallery-link-a,.gallery-link-a:hover 
{ 
	color: '.esc_attr($airtheme_color_gallery_link).';
}
		';
	}

	// Gallery Post caption
	$airtheme_color_gallery_caption = airtheme_get_option('theme_option_color_gallery_caption') ? esc_attr(airtheme_get_option('theme_option_color_gallery_caption')) : '#666666';
	if($airtheme_color_gallery_caption){
		$custom_css .= '
.list-layout-inside-caption
{ 
	color: '.esc_attr($airtheme_color_gallery_caption).';
}
		';
	}

	// Prev & Next
	$airtheme_color_post_navi = airtheme_get_option('theme_option_color_post_navi') ? esc_attr(airtheme_get_option('theme_option_color_post_navi')) : '#313139';
	if($airtheme_color_post_navi){
		$custom_css .= '
.post-navi-single, .arrow-item 
{ 
	color: '.esc_attr($airtheme_color_post_navi).';
}
		';
	}

	// Comment Title
	$airtheme_color_comment_tit = airtheme_get_option('theme_option_color_comment_tit') ? esc_attr(airtheme_get_option('theme_option_color_comment_tit')) : false;
	if($airtheme_color_comment_tit){
		$custom_css .= '
.comment-box-tit,.comm-reply-title 
{ 
	color: '.esc_attr($airtheme_color_comment_tit).';
}
		';
	}

	// Comment Content
	$airtheme_color_comment_con = airtheme_get_option('theme_option_color_comment_con') ? esc_attr(airtheme_get_option('theme_option_color_comment_con')) : false;
	if($airtheme_color_comment_con){
		$custom_css .= '
.comm-u-wrap 
{ 
	color: '.esc_attr($airtheme_color_comment_con).';
}
		';
	}

	// Comment Author
	$airtheme_color_comment_author = airtheme_get_option('theme_option_color_comment_author') ? esc_attr(airtheme_get_option('theme_option_color_comment_author')) : false;
	if($airtheme_color_comment_author){
		$custom_css .= '
.comment-meta .comment-author,.comment-meta .comment-author-a 
{ 
	color: '.esc_attr($airtheme_color_comment_author).';
}
		';
	}

	///////////////////////// Portfolio List Color
	// Filter Text by Default Color
	$airtheme_color_filter = airtheme_get_option('theme_option_color_filter') ? esc_attr(airtheme_get_option('theme_option_color_filter')) : false;
	if($airtheme_color_filter){
		$custom_css .= '
.filters-a 
{ 
	color: '.esc_attr($airtheme_color_filter).';
}
		';
	}

	// Filter Text Activate
	$airtheme_color_filter_focused = airtheme_get_option('theme_option_color_filter_focused') ? esc_attr(airtheme_get_option('theme_option_color_filter_focused')) : false;
	if($airtheme_color_filter_focused){
		$custom_css .= '
.filters-a:hover,.active > .filters-a,.filters-a:focus
{ 
	color: '.esc_attr($airtheme_color_filter_focused).';
}
		';
	}

	// Load More Color
	$airtheme_color_loadmore = airtheme_get_option('theme_option_color_loadmore') ? esc_attr(airtheme_get_option('theme_option_color_loadmore')) : false;
	if($airtheme_color_loadmore){
		$custom_css .= '
.tw-style-a.ux-btn,.tw-style-a.ux-btn:hover
{ 
	color: '.esc_attr($airtheme_color_loadmore).';
}
		';
	}

	// Title for Item
	$airtheme_color_list_item_tit = airtheme_get_option('theme_option_color_list_item_tit') ? esc_attr(airtheme_get_option('theme_option_color_list_item_tit')) : false;
	if($airtheme_color_list_item_tit){
		$custom_css .= '
.grid-item-tit,.grid-item-tit-a,.grid-item-tit-a:hover
{ 
	color: '.esc_attr($airtheme_color_list_item_tit).';
}
		';
	}

	// Tag for Item
	$airtheme_color_list_item_tag = airtheme_get_option('theme_option_color_list_item_tag') ? esc_attr(airtheme_get_option('theme_option_color_list_item_tag')) : false;
	if($airtheme_color_list_item_tag){
		$custom_css .= '
.grid-item-cate-a
{ 
 	color: '.esc_attr($airtheme_color_list_item_tag).';
}
		';
	}

	// Mask for Item
	$airtheme_color_list_item_mask = airtheme_get_option('theme_option_color_list_item_mask') ? esc_attr(airtheme_get_option('theme_option_color_list_item_mask')) : false;
	if($airtheme_color_list_item_mask){
		$custom_css .= '
.grid-item-con:after,.product-caption 
{ 
	background-color: '.esc_attr($airtheme_color_list_item_mask).';
}
		';
	}


	///////////////////////// Button Color
	// Button Text & Border Color
	$airtheme_color_button = airtheme_get_option('theme_option_color_button') ? esc_attr(airtheme_get_option('theme_option_color_button')) : false;
	if($airtheme_color_button){
		$custom_css .= '
.ux-btn, button, input[type="submit"] 
{ 
	color: '.esc_attr($airtheme_color_button).';
}
		';
	}

	// Button Text Mouseover Color
	$airtheme_color_button_mouseover = airtheme_get_option('theme_option_color_button_mouseover') ? esc_attr(airtheme_get_option('theme_option_color_button_mouseover')) : '#ffffff';
	if($airtheme_color_button_mouseover){
		$custom_css .= '
.ux-btn:hover,button:hover, input[type="submit"]:hover,.moudle .ux-btn.tw-style-a:hover,.moudle .ux-btn:before,.woocommerce button.button:not(.disabled).alt:hover,.woocommerce-page #content input:not(.disabled).button:hover,.woocommerce a.button:not(.disabled).alt:hover
{ 
	color: '.esc_attr($airtheme_color_button_mouseover).';
}
		';
	}

	// Button BG Mouseover Color
	$airtheme_color_button_bg_mouseover = airtheme_get_option('theme_option_color_button_bg_mouseover') ? esc_attr(airtheme_get_option('theme_option_color_button_bg_mouseover')) : '#313139';
	if($airtheme_color_button_bg_mouseover){
		$custom_css .= '
.ux-btn:hover,button:hover, input[type="submit"]:hover,.woocommerce button.button:not(.disabled).alt:hover,.woocommerce-page #content input.button:not(.disabled):hover,.woocommerce a.button:not(.disabled).alt:hover
{ 
	background-color: '.esc_attr($airtheme_color_button_bg_mouseover).'; border-color: '.esc_attr($airtheme_color_button_bg_mouseover).';
}
		';
	}


	///////////////////////// Form Color
	// Text Input Box by Default
	$airtheme_color_form = airtheme_get_option('theme_option_color_form') ? esc_attr(airtheme_get_option('theme_option_color_form')) : '#adadad';
	if($airtheme_color_form){
		$custom_css .= '
textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input 
{ 
	color: '.esc_attr($airtheme_color_form).';
}
		';
	}

	// Text Input Box Focused
	$airtheme_color_form_focused = airtheme_get_option('theme_option_color_form_focused') ? esc_attr(airtheme_get_option('theme_option_color_form_focused')) : '#313139';
	if($airtheme_color_form_focused){
		$custom_css .= '
.moudle input[type="text"]:focus, .moudle textarea:focus, input:focus:invalid:focus, textarea:focus:invalid:focus, select:focus:invalid:focus, textarea:focus, input[type="text"]:focus, input[type="password"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="date"]:focus, input[type="month"]:focus, input[type="time"]:focus, input[type="week"]:focus, input[type="number"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="color"]:focus, .uneditable-input:focus,
.comment-reply-title:hover
{ 
	color: '.esc_attr($airtheme_color_form_focused).';
}
		';
	}


	///////////////////////// Widget
	// Widget Title Text Color
	$airtheme_color_widget_title = airtheme_get_option('theme_option_color_widget_title') ? esc_attr(airtheme_get_option('theme_option_color_widget_title')) : '#313139';
	if($airtheme_color_widget_title){
		$custom_css .= '
.widget-container .widget-title, .widget-container .widget-title a 
{ 
	color: '.esc_attr($airtheme_color_widget_title).';
}
		';
	} 
	
	// Widget content Text Color
	$airtheme_color_widget_con_color = airtheme_get_option('theme_option_color_widget_content_color') ? esc_attr(airtheme_get_option('theme_option_color_widget_content_color')) : '#606066';
	if($airtheme_color_widget_con_color){
		$custom_css .= '
.widget-container,.widget-container a ,.widget-container select
{ 
	color: '.esc_attr($airtheme_color_widget_con_color).';
}
		';
	}

	// Sidebar Widget Title Text Color
	$airtheme_color_widget_title_sidebar = airtheme_get_option('theme_option_color_widget_title_sidebar') ? esc_attr(airtheme_get_option('theme_option_color_widget_title_sidebar')) : false;
	if($airtheme_color_widget_title_sidebar){
		$custom_css .= '
.sidebar_widget .widget-container .widget-title,.sidebar_widget .widget-container .widget-title a
{ 
	color: '.esc_attr($airtheme_color_widget_title_sidebar).';
}
		';
	}

	// Sidebar Widget Title Bg Color
	$airtheme_color_widget_title_bg = airtheme_get_option('theme_option_color_widget_title_bg') ? esc_attr(airtheme_get_option('theme_option_color_widget_title_bg')) : false;
	if($airtheme_color_widget_title_bg){
		$custom_css .= '
.sidebar_widget .widget-title 
{ 
	background-color: '.esc_attr($airtheme_color_widget_title_bg).';
}
		';
	}


	//Footer
	//Footer Text Color
	$airtheme_color_footer_text = airtheme_get_option('theme_option_footer_text_color') ? esc_attr(airtheme_get_option('theme_option_footer_text_color')) : false;
	if($airtheme_color_footer_text){
		$custom_css .= '
.footer-bar,.footer-bar a,.copyright, .copyright a,.footer-info,.footer-info a,#footer .logo-h1
{ 
	color: '.esc_attr($airtheme_color_footer_text).'; 
}
		';
	}
	
	//Footer bg Color
	$airtheme_color_footer_bg = airtheme_get_option('theme_option_footer_bg_color') ? esc_attr(airtheme_get_option('theme_option_footer_bg_color')) : false;
	if($airtheme_color_footer_bg){
		$custom_css .= '
#footer 
{
	background-color: '.esc_attr($airtheme_color_footer_bg).'; 
}
		';
	}

	//Navigation Dot Color on the WooCommerce Product Page
	$airtheme_color_woo_product_dot = airtheme_get_option('woocommerce_product_slider_dot_color') ? esc_attr(airtheme_get_option('woocommerce_product_slider_dot_color')) : false;
	if ( $airtheme_color_woo_product_dot ) {
		$custom_css .= '
.woocommerce div.product div.images .flex-control-thumbs li img
{
	border-color: '.esc_attr( $airtheme_color_woo_product_dot ).'; 
}
.flex-control-thumbs li img.flex-active
{
	background-color: '.esc_attr( $airtheme_color_woo_product_dot ).'; 
}
		';
	}
	
	//## FONT ########################################################################################

	//////////////////////// LOGO
	// logo font
	$airtheme_logo_font = airtheme_get_option('theme_option_font_family_logo');
	$airtheme_logo_font = $airtheme_logo_font != -1 ? $airtheme_logo_font : false;
	if($airtheme_logo_font){
		$airtheme_logo_font = str_replace('+', ' ', $airtheme_logo_font);
		$custom_css .= '
.logo-h1 { font-family: '.esc_attr($airtheme_logo_font).'; }
		';
	}
	//logo size
	$airtheme_logo_font_size = airtheme_get_option('theme_option_font_size_logo');
	if($airtheme_logo_font_size && $airtheme_logo_font_size!='Select'){
		$custom_css .= '
.logo-h1 { font-size: '.esc_attr($airtheme_logo_font_size).';}
		';
	}
	//logo size mobile
	$airtheme_logo_font_size_m = airtheme_get_option('theme_option_font_size_logo_m');
	if($airtheme_logo_font_size_m && $airtheme_logo_font_size_m!='Mobile'){
		$custom_css .= '
.logo-h1 { --font-size-logo: '.esc_attr($airtheme_logo_font_size_m).';}
		';
	}
	//logo style
	$airtheme_logo_font_style = airtheme_get_option('theme_option_font_style_logo');
	if($airtheme_logo_font_style){
		$custom_css .= '
.logo-h1 { '.esc_attr(airtheme_theme_google_font_style($airtheme_logo_font_style)).'}
		';
	}

	//////////////////////// MENU 
	//Menu on Header font
	$airtheme_menu_header_font = airtheme_get_option('theme_option_font_family_menu_header');
	$airtheme_menu_header_font = $airtheme_menu_header_font != -1 ? $airtheme_menu_header_font : false;
	if($airtheme_menu_header_font){
		$airtheme_menu_header_font = str_replace('+', ' ', $airtheme_menu_header_font);
		$custom_css .= '
.navi-trigger-text, #navi-header a,.header-bar-social .socialmeida-a { font-family: '.esc_attr($airtheme_menu_header_font).'; }
		';
	}
	//Menu on Header size
	$airtheme_menu_header_size = airtheme_get_option('theme_option_font_size_menu_header');
	if($airtheme_menu_header_size && $airtheme_menu_header_size!='Select'){
		$custom_css .= '
.navi-trigger-text, #navi-header a,.header-bar-social .socialmeida-a { font-size: '.esc_attr($airtheme_menu_header_size).';}
		';
	}
	//Menu on Header size mobile
	$airtheme_menu_header_size_m = airtheme_get_option('theme_option_font_size_menu_header_m');
	if($airtheme_menu_header_size_m && $airtheme_menu_header_size_m!='Mobile'){
		$custom_css .= '
header { --font-size-headermenu: '.esc_attr($airtheme_menu_header_size_m).';}
		';
	}
	//Menu on Header style
	$airtheme_menu_header_style = airtheme_get_option('theme_option_font_style_menu_header');
	if($airtheme_menu_header_style){
		$custom_css .= '
.navi-trigger-text, #navi-header a,.header-bar-social .socialmeida-a { '.esc_attr(airtheme_theme_google_font_style($airtheme_menu_header_style)).'}
		';
	}

	//Menu on expanded font
	$airtheme_menu_expanded_font = airtheme_get_option('theme_option_font_family_menu_expanded');
	$airtheme_menu_expanded_font = $airtheme_menu_expanded_font != -1 ? $airtheme_menu_expanded_font : false;
	if($airtheme_menu_expanded_font){
		$airtheme_menu_expanded_font = str_replace('+', ' ', $airtheme_menu_expanded_font);
		$custom_css .= '
#navi a { font-family: '.esc_attr($airtheme_menu_expanded_font).'; }
		';
	}
	//Menu on expanded size
	$airtheme_menu_expanded_size = airtheme_get_option('theme_option_font_size_menu_expanded');
	if($airtheme_menu_expanded_size && $airtheme_menu_expanded_size!='Select'){
		$custom_css .= '
#navi a { font-size: '.esc_attr($airtheme_menu_expanded_size).';}
		';
	}
	//Menu on expanded size mobile
	$airtheme_menu_expanded_size_m = airtheme_get_option('theme_option_font_size_menu_expanded_m');
	if($airtheme_menu_expanded_size_m && $airtheme_menu_expanded_size_m!='Mobile'){
		$custom_css .= '
#navi { --font-size-expandmenu: '.esc_attr($airtheme_menu_expanded_size_m).';}
		';
	}
	//Menu on expanded style
	$airtheme_menu_expanded_style = airtheme_get_option('theme_option_font_style_menu_expanded');
	if($airtheme_menu_expanded_style){
		$custom_css .= '
#navi a { '.esc_attr(airtheme_theme_google_font_style($airtheme_menu_expanded_style)).'}
		';
	}

	//////////////////////// POST & PAGE
	//Post & page Title font
	$airtheme_post_page_title_font = airtheme_get_option('theme_option_font_post_page_title');
	$airtheme_post_page_title_font = $airtheme_post_page_title_font != -1 ? $airtheme_post_page_title_font : false;
	if($airtheme_post_page_title_font){
		$airtheme_post_page_title_font = str_replace('+', ' ', $airtheme_post_page_title_font);
		$custom_css .= '
body.single .title-wrap-tit,.title-wrap-h1, .archive-grid-item-tit,.title-wrap-meta-a,.archive-grid-item-meta-item,h1,h2,h3,h4,h5,h6
{ 
	font-family: '.esc_attr($airtheme_post_page_title_font).';
}
		';
	}
	//Post & page Title stlye
	$airtheme_post_page_title_font_style = airtheme_get_option('theme_option_font_style_post_page_title');
	if($airtheme_post_page_title_font_style){
		$custom_css .= '
body.single .title-wrap-tit,.title-wrap-h1, .archive-grid-item-tit,.title-wrap-meta-a,.archive-grid-item-meta-item,h1,h2,h3,h4,h5,h6
{ 
'	.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_title_font_style)).'
}
		';
	}
	
	//Post & page Title size
	$airtheme_post_page_title_font_size = airtheme_get_option('theme_option_font_size_post_page_title');
	if($airtheme_post_page_title_font_size && $airtheme_post_page_title_font_size !='Select' ){
		$custom_css .= '
body.single .title-wrap-tit,.title-wrap-h1 { font-size: '.esc_attr($airtheme_post_page_title_font_size).';}
		';
	}

	//Post & page Title size Mobile
	$airtheme_post_page_title_font_size_m = airtheme_get_option('theme_option_font_size_post_page_title_m');
	if($airtheme_post_page_title_font_size_m && $airtheme_post_page_title_font_size_m !='Mobile' ){
		$custom_css .= '
body { --font-size-pagetitle: '.esc_attr($airtheme_post_page_title_font_size_m).';}
		';
	}

	//Post & page content font
	$airtheme_post_page_content_font = airtheme_get_option('theme_option_font_post_page_content');
	$airtheme_post_page_content_font = $airtheme_post_page_content_font != -1 ? $airtheme_post_page_content_font : false;
	if($airtheme_post_page_content_font){
		$airtheme_post_page_content_font = str_replace('+', ' ', $airtheme_post_page_content_font);
		$custom_css .= '
body,.single-portfolio-fullscreen-slider .owl-dot.active { font-family: '.esc_attr($airtheme_post_page_content_font).'; }
		';
	}
	//Post & page content stlye
	$airtheme_post_page_content_font_style = airtheme_get_option('theme_option_font_style_post_page_content');
	if($airtheme_post_page_content_font_style){
		$custom_css .= '
body,.single-portfolio-fullscreen-slider .owl-dot.active { '.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_content_font_style)).' }
		';
	}
	//Post & page content size
	$airtheme_post_page_content_font_size = airtheme_get_option('theme_option_font_size_post_page_content');
	if($airtheme_post_page_content_font_size && $airtheme_post_page_content_font_size !='Select' ){
		$custom_css .= '
body { font-size: '.esc_attr($airtheme_post_page_content_font_size).';}
		';
	}

	//Post & page content size mobile
	$airtheme_post_page_content_font_size_m = airtheme_get_option('theme_option_font_size_post_page_content-m');
	if($airtheme_post_page_content_font_size_m && $airtheme_post_page_content_font_size_m !='Mobile' ){
		$custom_css .= '
body { --font-size-content: '.esc_attr($airtheme_post_page_content_font_size_m).';}
		';
	}

	//Post & page content heading 1-6 font
	$airtheme_post_page_content_heading_font = airtheme_get_option('theme_option_font_post_page_content_heading');
	$airtheme_post_page_content_heading_font = $airtheme_post_page_content_heading_font != -1 ? $airtheme_post_page_content_heading_font : false;
	if($airtheme_post_page_content_heading_font){
		$airtheme_post_page_content_heading_font = str_replace('+', ' ', $airtheme_post_page_content_heading_font);
		$custom_css .= '
.entry h1,.entry h2,.entry h3,.entry h4,.entry h5,.entry h6, .text_block h1,.text_block h2,.text_block h3,.text_block h4,.text_block h5,.text_block h6,.ux-portfolio-template-intro h1,.ux-portfolio-template-intro h2,.ux-portfolio-template-intro h3,.ux-portfolio-template-intro h4,.ux-portfolio-template-intro h5,.ux-portfolio-template-intro h6,.slider-con-inn h1,.slider-con-inn h2,.slider-con-inn h3,.slider-con-inn h4,.slider-con-inn h5,.slider-con-inn h6,
.infrographic-tit,.bignumber-item
{ 
	font-family: '.esc_attr($airtheme_post_page_content_heading_font).'; 
}
		';
	}

	//Post & page content heading 1-6 stlye
	$airtheme_post_page_content_heading_font_style = airtheme_get_option('theme_option_font_style_post_page_content_heading');
	if($airtheme_post_page_content_heading_font_style){
		$custom_css .= '
.entry h1,.entry h2,.entry h3,.entry h4,.entry h5,.entry h6, .text_block h1,.text_block h2,.text_block h3,.text_block h4,.text_block h5,.text_block h6,.ux-portfolio-template-intro h1,.ux-portfolio-template-intro h2,.ux-portfolio-template-intro h3,.ux-portfolio-template-intro h4,.ux-portfolio-template-intro h5,.ux-portfolio-template-intro h6,.slider-con-inn h1,.slider-con-inn h2,.slider-con-inn h3,.slider-con-inn h4,.slider-con-inn h5,.slider-con-inn h6,
.infrographic-tit,.bignumber-item 
{ 
	'.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_content_heading_font_style)).' 
}
		';
	}

	//H1 size 
	$airtheme_post_page_headding1_font_size = airtheme_get_option('theme_option_font_size_post_page_content_heading_1');
	if($airtheme_post_page_headding1_font_size && $airtheme_post_page_headding1_font_size !='Select' ){
		$custom_css .= '
.entry h1,.text_block h1,.ux-portfolio-template-intro h1,.slider-con-inn h1 { font-size: '.esc_attr($airtheme_post_page_headding1_font_size).';}
		';
	}

	//H1 size Mobile
	$airtheme_post_page_headding1_font_size_m = airtheme_get_option('theme_option_font_size_post_page_content_heading_1_m');
	if($airtheme_post_page_headding1_font_size_m && $airtheme_post_page_headding1_font_size_m !='Mobile' ){
		$custom_css .= '
body { --font-size-h1: '.esc_attr($airtheme_post_page_headding1_font_size_m).';}
		';
	}

	//H2 size 
	$airtheme_post_page_headding2_font_size = airtheme_get_option('theme_option_font_size_post_page_content_heading_2');
	if($airtheme_post_page_headding2_font_size && $airtheme_post_page_headding2_font_size !='Select' ){
		$custom_css .= '
.entry h2,.text_block h2,.ux-portfolio-template-intro h2,.slider-con-inn h2 { font-size: '.esc_attr($airtheme_post_page_headding2_font_size).';}
		';
	}

	//H2 size Mobile
	$airtheme_post_page_headding2_font_size_m = airtheme_get_option('theme_option_font_size_post_page_content_heading_2_m');
	if($airtheme_post_page_headding2_font_size_m && $airtheme_post_page_headding2_font_size_m !='Mobile' ){
		$custom_css .= '
body { --font-size-h2: '.esc_attr($airtheme_post_page_headding2_font_size_m).';}
		';
	}

	//H3 size 
	$airtheme_post_page_headding3_font_size = airtheme_get_option('theme_option_font_size_post_page_content_heading_3');
	if($airtheme_post_page_headding3_font_size && $airtheme_post_page_headding3_font_size !='Select' ){
		$custom_css .= '
.entry h3,.text_block h3,.ux-portfolio-template-intro h3,.slider-con-inn h3 { font-size: '.esc_attr($airtheme_post_page_headding3_font_size).';}
		';
	}

	//H3 size Mobile
	$airtheme_post_page_headding3_font_size_m = airtheme_get_option('theme_option_font_size_post_page_content_heading_3_m');
	if($airtheme_post_page_headding3_font_size_m && $airtheme_post_page_headding3_font_size_m !='Mobile' ){
		$custom_css .= '
body { --font-size-h3: '.esc_attr($airtheme_post_page_headding3_font_size_m).';}
		';
	}

	//H4 size 
	$airtheme_post_page_headding4_font_size = airtheme_get_option('theme_option_font_size_post_page_content_heading_4');
	if($airtheme_post_page_headding4_font_size && $airtheme_post_page_headding4_font_size !='Select' ){
		$custom_css .= '
.entry h4,.text_block h4,.ux-portfolio-template-intro h4,.slider-con-inn h4 { font-size: '.esc_attr($airtheme_post_page_headding4_font_size).';}
		';
	}

	//H4 size Mobile
	$airtheme_post_page_headding4_font_size_m = airtheme_get_option('theme_option_font_size_post_page_content_heading_4_m');
	if($airtheme_post_page_headding4_font_size_m && $airtheme_post_page_headding4_font_size_m !='Mobile' ){
		$custom_css .= '
body { --font-size-h4: '.esc_attr($airtheme_post_page_headding4_font_size_m).';}
		';
	}

	//H5 size 
	$airtheme_post_page_headding5_font_size = airtheme_get_option('theme_option_font_size_post_page_content_heading_5');
	if($airtheme_post_page_headding5_font_size && $airtheme_post_page_headding5_font_size !='Select' ){
		$custom_css .= '
.entry h5,.text_block h5,.ux-portfolio-template-intro h5,.slider-con-inn h5 { font-size: '.esc_attr($airtheme_post_page_headding5_font_size).';}
		';
	}

	//H5 size Mobile
	$airtheme_post_page_headding5_font_size_m = airtheme_get_option('theme_option_font_size_post_page_content_heading_5_m');
	if($airtheme_post_page_headding5_font_size_m && $airtheme_post_page_headding5_font_size_m !='Mobile' ){
		$custom_css .= '
body { --font-size-h5: '.esc_attr($airtheme_post_page_headding5_font_size_m).';}
		';
	}

	//H6 size 
	$airtheme_post_page_headding6_font_size = airtheme_get_option('theme_option_font_size_post_page_content_heading_6');
	if($airtheme_post_page_headding6_font_size && $airtheme_post_page_headding6_font_size !='Select' ){
		$custom_css .= '
.entry h6,.text_block h6,.ux-portfolio-template-intro h6,.slider-con-inn h6 { font-size: '.esc_attr($airtheme_post_page_headding6_font_size).';}
		';
	}

	//H6 size Mobile
	$airtheme_post_page_headding6_font_size_m = airtheme_get_option('theme_option_font_size_post_page_content_heading_6_m');
	if($airtheme_post_page_headding6_font_size_m && $airtheme_post_page_headding6_font_size_m !='Mobile' ){
		$custom_css .= '
body { --font-size-h6: '.esc_attr($airtheme_post_page_headding6_font_size_m).';}
		';
	}

	//Post & page meta font
	$airtheme_post_page_meta_font = airtheme_get_option('theme_option_font_post_page_meta');
	$airtheme_post_page_meta_font = $airtheme_post_page_meta_font != -1 ? $airtheme_post_page_meta_font : false;
	if($airtheme_post_page_meta_font){
		$airtheme_post_page_meta_font = str_replace('+', ' ', $airtheme_post_page_meta_font);
		$custom_css .= '
.article-meta, .comment-form .logged,.comment-meta,.archive-des,.archive-meta,.title-wrap-des,.blog_meta_cate { font-family: '.esc_attr($airtheme_post_page_meta_font).'; }
		';
	}
	//Post & page meta stlye
	$airtheme_post_page_meta_font_style = airtheme_get_option('theme_option_font_style_post_page_meta');
	if($airtheme_post_page_meta_font_style){
		$custom_css .= '
.article-meta, .comment-form .logged,.comment-meta,.archive-des,.archive-meta,.title-wrap-des,.blog_meta_cate { '.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_meta_font_style)).' }
		';
	}

	//Post & page meta size
	$airtheme_post_page_meta_font_size = airtheme_get_option('theme_option_font_size_post_page_meta');
	if($airtheme_post_page_meta_font_size && $airtheme_post_page_meta_font_size !='Select' ){
		$custom_css .= '
.article-meta, .comment-form .logged,.comment-meta,.archive-des,.archive-meta,.title-wrap-des,.blog_meta_cate { font-size: '.esc_attr($airtheme_post_page_meta_font_size).';}
		';
	}

	//Post & page meta size Mobile
	$airtheme_post_page_meta_font_size_m = airtheme_get_option('theme_option_font_size_post_page_meta_m');
	if($airtheme_post_page_meta_font_size_m && $airtheme_post_page_meta_font_size_m !='Mobile' ){
		$custom_css .= '
body { --font-size-meta: '.esc_attr($airtheme_post_page_meta_font_size_m).';}
		';
	}

	//Gallery Post Property Title font (Small Heading)
	$airtheme_post_page_property_title_font = airtheme_get_option('theme_option_font_post_page_property_title');
	$airtheme_post_page_property_title_font = $airtheme_post_page_property_title_font != -1 ? $airtheme_post_page_property_title_font : false;
	if($airtheme_post_page_property_title_font){
		$airtheme_post_page_property_title_font = str_replace('+', ' ', $airtheme_post_page_property_title_font);
		$custom_css .= '
.gallery-info-property-tit,.comment-author,.comment-author-a { font-family: '.esc_attr($airtheme_post_page_property_title_font).'; }
		';
	}
	//Gallery Post Property Title stlye
	$airtheme_post_page_property_title_font_style = airtheme_get_option('theme_option_font_style_post_page_property_title');
	if($airtheme_post_page_property_title_font_style){
		$custom_css .= '
.gallery-info-property-tit,.comment-author,.comment-author-a { '.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_property_title_font_style)).' }
		';
	}
	//Gallery Post Property Title size
	$airtheme_post_page_property_title_font_size = airtheme_get_option('theme_option_font_size_post_page_property_title');
	if($airtheme_post_page_property_title_font_size && $airtheme_post_page_property_title_font_size !='Select' ){
		$custom_css .= '
.gallery-info-property-tit { font-size: '.esc_attr($airtheme_post_page_property_title_font_size).';}
		';
	}
	//Gallery Post Property Title size mobile
	$airtheme_post_page_property_title_font_size_m = airtheme_get_option('theme_option_font_size_post_page_property_title_m');
	if($airtheme_post_page_property_title_font_size_m && $airtheme_post_page_property_title_font_size_m !='Mobile' ){
		$custom_css .= '
.gallery-property { --font-size-gallery-property-tit: '.esc_attr($airtheme_post_page_property_title_font_size_m).';}
		';
	}

	//Gallery Post Property content font
	$airtheme_post_page_property_content_font = airtheme_get_option('theme_option_font_post_page_property_content');
	$airtheme_post_page_property_content_font = $airtheme_post_page_property_content_font != -1 ? $airtheme_post_page_property_content_font : false;
	if($airtheme_post_page_property_content_font){
		$airtheme_post_page_property_content_font = str_replace('+', ' ', $airtheme_post_page_property_content_font);
		$custom_css .= '
.gallery-info-property-con { font-family: '.esc_attr($airtheme_post_page_property_content_font).'; }
		';
	}
	//Gallery Post Property content stlye
	$airtheme_post_page_property_content_font_style = airtheme_get_option('theme_option_font_style_post_page_property_content');
	if($airtheme_post_page_property_content_font_style){
		$custom_css .= '
.gallery-info-property-con { '.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_property_content_font_style)).' }
		';
	}
	//Gallery Post Property content size
	$airtheme_post_page_property_content_font_size = airtheme_get_option('theme_option_font_size_post_page_property_content');
	if($airtheme_post_page_property_content_font_size && $airtheme_post_page_property_content_font_size !='Select' ){
		$custom_css .= '
.gallery-info-property-con { font-size: '.esc_attr($airtheme_post_page_property_content_font_size).';}
		';
	}
	//Gallery Post Property content size Mobile
	$airtheme_post_page_property_content_font_size_m = airtheme_get_option('theme_option_font_size_post_page_property_content_m');
	if($airtheme_post_page_property_content_font_size_m && $airtheme_post_page_property_content_font_size_m !='Mobile' ){
		$custom_css .= '
.gallery-property { --font-size-gallery-property-con: '.esc_attr($airtheme_post_page_property_content_font_size_m).';}
		';
	}

	//Gallery Post LINK font
	$airtheme_post_page_link_font = airtheme_get_option('theme_option_font_post_page_link');
	$airtheme_post_page_link_font = $airtheme_post_page_link_font != -1 ? $airtheme_post_page_link_font : false;
	if($airtheme_post_page_link_font){
		$airtheme_post_page_link_font = str_replace('+', ' ', $airtheme_post_page_link_font);
		$custom_css .= '
.gallery-link-a { font-family: '.esc_attr($airtheme_post_page_link_font).'; }
		';
	}
	//Gallery Post LINK stlye
	$airtheme_post_page_link_font_style = airtheme_get_option('theme_option_font_style_post_page_link');
	if($airtheme_post_page_link_font_style){
		$custom_css .= '
.gallery-link-a { '.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_link_font_style)).' }
		';
	}
	//Gallery Post LINK size
	$airtheme_post_page_link_font_size = airtheme_get_option('theme_option_font_size_post_page_link');
	if($airtheme_post_page_link_font_size && $airtheme_post_page_link_font_size !='Select' ){
		$custom_css .= '
.gallery-link-a { font-size: '.esc_attr($airtheme_post_page_link_font_size).';}
		';
	}
	//Gallery Post LINK size mobile
	$airtheme_post_page_link_font_size_m = airtheme_get_option('theme_option_font_size_post_page_link_m');
	if($airtheme_post_page_link_font_size_m && $airtheme_post_page_link_font_size_m !='Mobile' ){
		$custom_css .= '
.gallery-link { --font-size-gallery-link: '.esc_attr($airtheme_post_page_link_font_size_m).';}
		';
	}

	//Gallery caption
	$airtheme_post_page_caption_font = airtheme_get_option('theme_option_font_post_page_caption');
	$airtheme_post_page_caption_font = $airtheme_post_page_caption_font != -1 ? $airtheme_post_page_caption_font : false;
	if($airtheme_post_page_caption_font){
		$airtheme_post_page_caption_font = str_replace('+', ' ', $airtheme_post_page_caption_font);
		$custom_css .= '
.list-layout-inside-caption { font-family: '.esc_attr($airtheme_post_page_caption_font).'; }
		';
	}
	//Gallery Post caption stlye
	$airtheme_post_page_caption_font_style = airtheme_get_option('theme_option_font_style_post_page_caption');
	if($airtheme_post_page_caption_font_style){
		$custom_css .= '
.list-layout-inside-caption { '.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_caption_font_style)).' }
		';
	}
	//Gallery Post Caption size
	$airtheme_post_page_caption_font_size = airtheme_get_option('theme_option_font_size_post_page_caption');
	if($airtheme_post_page_caption_font_size && $airtheme_post_page_caption_font_size !='Select' ){
		$custom_css .= '
.list-layout-inside-caption { font-size: '.esc_attr($airtheme_post_page_caption_font_size).';}
		';
	}
	//Gallery Post Caption size mobile
	$airtheme_post_page_caption_font_size_m = airtheme_get_option('theme_option_font_size_post_page_caption_m');
	if($airtheme_post_page_caption_font_size_m && $airtheme_post_page_caption_font_size_m !='Mobile' ){
		$custom_css .= '
.list-layout { --font-size-gallery-caption: '.esc_attr($airtheme_post_page_caption_font_size_m).';}
		';
	}

	//Post Navi font
	$airtheme_post_page_navi_font = airtheme_get_option('theme_option_font_post_page_navi');
	$airtheme_post_page_navi_font = $airtheme_post_page_navi_font != -1 ? $airtheme_post_page_navi_font : false;
	if($airtheme_post_page_navi_font){
		$airtheme_post_page_navi_font = str_replace('+', ' ', $airtheme_post_page_navi_font);
		$custom_css .= '
.post-navi-single { font-family: '.esc_attr($airtheme_post_page_navi_font).'; }
		';
	}
	//Post Navi stlye
	$airtheme_post_page_navi_font_style = airtheme_get_option('theme_option_font_style_post_page_navi');
	if($airtheme_post_page_navi_font_style){
		$custom_css .= '
.post-navi-single { '.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_navi_font_style)).' }
		';
	}
	//Post Navi size
	$airtheme_post_page_navi_font_size = airtheme_get_option('theme_option_font_size_post_page_navi');
	if($airtheme_post_page_navi_font_size && $airtheme_post_page_navi_font_size !='Select' ){
		$custom_css .= '
.post-navi-single { font-size: '.esc_attr($airtheme_post_page_navi_font_size).';}
		';
	}
	//Post Navi size mobile
	$airtheme_post_page_navi_font_size_m = airtheme_get_option('theme_option_font_size_post_page_navi_m');
	if($airtheme_post_page_navi_font_size_m && $airtheme_post_page_navi_font_size_m !='Mobile' ){
		$custom_css .= '
.post-navi-single { --font-size-postnavi: '.esc_attr($airtheme_post_page_navi_font_size_m).';}
		';
	}

	//Comments Title font (Medium Heading)
	$airtheme_post_page_comments_tit_font = airtheme_get_option('theme_option_font_post_page_comments_tit');
	$airtheme_post_page_comments_tit_font = $airtheme_post_page_comments_tit_font != -1 ? $airtheme_post_page_comments_tit_font : false;
	if($airtheme_post_page_comments_tit_font){
		$airtheme_post_page_comments_tit_font = str_replace('+', ' ', $airtheme_post_page_comments_tit_font);
		$custom_css .= '
.comment-box-tit,.comm-reply-title,#content_wrap .infrographic p,#content_wrap .promote-mod p, a.team-item-title { font-family: '.esc_attr($airtheme_post_page_comments_tit_font).'; }
		';
	}
	//Comments Title stlye
	$airtheme_post_page_comments_tit_font_style = airtheme_get_option('theme_option_font_style_post_page_comments_tit');
	if($airtheme_post_page_comments_tit_font_style){
		$custom_css .= '
.comment-box-tit,.comm-reply-title,#content_wrap .infrographic p,#content_wrap .promote-mod p, a.team-item-title { '.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_comments_tit_font_style)).' }
		';
	}
	//Comments Title size
	$airtheme_post_page_comments_tit_font_size = airtheme_get_option('theme_option_font_size_post_page_comments_tit');
	if($airtheme_post_page_comments_tit_font_size && $airtheme_post_page_comments_tit_font_size !='Select' ){
		$custom_css .= '
.comment-box-tit,.comm-reply-title,#content_wrap .infrographic p,#content_wrap .promote-mod p, a.team-item-title { font-size: '.esc_attr($airtheme_post_page_comments_tit_font_size).';}
		';
	}
	//Comments Title size mobile
	$airtheme_post_page_comments_tit_font_size_m = airtheme_get_option('theme_option_font_size_post_page_comments_tit_m');
	if($airtheme_post_page_comments_tit_font_size_m && $airtheme_post_page_comments_tit_font_size_m !='Mobile' ){
		$custom_css .= '
body { --font-size-comment-tit: '.esc_attr($airtheme_post_page_comments_tit_font_size_m).';}
		';
	}

	//Comments Content font
	$airtheme_post_page_comments_con_font = airtheme_get_option('theme_option_font_post_page_comments_con');
	$airtheme_post_page_comments_con_font = $airtheme_post_page_comments_con_font != -1 ? $airtheme_post_page_comments_con_font : false;
	if($airtheme_post_page_comments_con_font){
		$airtheme_post_page_comments_con_font = str_replace('+', ' ', $airtheme_post_page_comments_con_font);
		$custom_css .= '
.comment { font-family: '.esc_attr($airtheme_post_page_comments_con_font).'; }
		';
	}
	//Comments Content stlye
	$airtheme_post_page_comments_con_font_style = airtheme_get_option('theme_option_font_style_post_page_comments_con');
	if($airtheme_post_page_comments_con_font_style){
		$custom_css .= '
.comment { '.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_comments_con_font_style)).' }
		';
	}
	//Comments Content size
	$airtheme_post_page_comments_con_font_size = airtheme_get_option('theme_option_font_size_post_page_comments_con');
	if($airtheme_post_page_comments_con_font_size && $airtheme_post_page_comments_con_font_size !='Select' ){
		$custom_css .= '
.comment { font-size: '.esc_attr($airtheme_post_page_comments_con_font_size).';}
		';
	}
	//Comments Content size mobile
	$airtheme_post_page_comments_con_font_size_m = airtheme_get_option('theme_option_font_size_post_page_comments_con_m');
	if($airtheme_post_page_comments_con_font_size_m && $airtheme_post_page_comments_con_font_size_m !='Mobile' ){
		$custom_css .= '
.comment { --font-size-comment-con: '.esc_attr($airtheme_post_page_comments_con_font_size_m).';}
		';
	}

	//Comments Author Name Font Size
	$airtheme_comment_author = airtheme_get_option('theme_option_font_size_post_page_comments_author');
	if($airtheme_comment_author && $airtheme_comment_author !='Select'){
		$custom_css .= '
.comment-author { font-size: '.esc_attr($airtheme_comment_author).';}
		';
	}

	//Comments Author Name Font Size mobile
	$airtheme_comment_author_m = airtheme_get_option('theme_option_font_size_post_page_comments_author_m');
	if($airtheme_comment_author_m && $airtheme_comment_author_m !='Select'){
		$custom_css .= '
.comment-author { --font-size-comment-author: '.esc_attr($airtheme_comment_author_m).';}
		';
	}

	//////////////////////// List
	// Filter Font
	$airtheme_post_page_filter_font = airtheme_get_option('theme_option_font_post_page_filter');
	$airtheme_post_page_filter_font = $airtheme_post_page_filter_font != -1 ? $airtheme_post_page_filter_font : false;
	if($airtheme_post_page_filter_font){
		$airtheme_post_page_filter_font = str_replace('+', ' ', $airtheme_post_page_filter_font);
		$custom_css .= '
.filters-li { font-family: '.esc_attr($airtheme_post_page_filter_font).'; }
		';
	}
	// Filter stlye
	$airtheme_post_page_filter_font_style = airtheme_get_option('theme_option_font_style_post_page_filter');
	if($airtheme_post_page_filter_font_style){
		$custom_css .= '
.filters-li { '.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_filter_font_style)).' }
		';
	}
	// Filter size
	$airtheme_post_page_filter_font_size = airtheme_get_option('theme_option_font_size_post_page_filter');
	if($airtheme_post_page_filter_font_size && $airtheme_post_page_filter_font_size !='Select' ){
		$custom_css .= '
.filters-li { font-size: '.esc_attr($airtheme_post_page_filter_font_size).';}
		';
	}
	// Filter size Mobile
	$airtheme_post_page_filter_font_size_m = airtheme_get_option('theme_option_font_size_post_page_filter_m');
	if($airtheme_post_page_filter_font_size_m && $airtheme_post_page_filter_font_size_m !='Mobile' ){
		$custom_css .= '
.filters-li { --font-size-filter: '.esc_attr($airtheme_post_page_filter_font_size_m).';}
		';
	}

	// Load More Font
	$airtheme_post_page_loadmore_font = airtheme_get_option('theme_option_font_post_page_loadmore');
	$airtheme_post_page_loadmore_font = $airtheme_post_page_loadmore_font != -1 ? $airtheme_post_page_loadmore_font : false;
	if($airtheme_post_page_loadmore_font){
		$airtheme_post_page_loadmore_font = str_replace('+', ' ', $airtheme_post_page_loadmore_font);
		$custom_css .= '
.pagenums { font-family: '.esc_attr($airtheme_post_page_loadmore_font).'; }
		';
	}
	// Load More stlye
	$airtheme_post_page_loadmore_font_style = airtheme_get_option('theme_option_font_style_post_page_loadmore');
	if($airtheme_post_page_loadmore_font_style){
		$custom_css .= '
.pagenums { '.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_loadmore_font_style)).' }
		';
	}
	// Load More size
	$airtheme_post_page_loadmore_font_size = airtheme_get_option('theme_option_font_size_post_page_loadmore');
	if($airtheme_post_page_loadmore_font_size && $airtheme_post_page_loadmore_font_size !='Select' ){
		$custom_css .= '
.pagenums { font-size: '.esc_attr($airtheme_post_page_loadmore_font_size).';}
		';
	}
	// Load More size Mobile
	$airtheme_post_page_loadmore_font_size_m = airtheme_get_option('theme_option_font_size_post_page_loadmore_m');
	if($airtheme_post_page_loadmore_font_size_m && $airtheme_post_page_loadmore_font_size_m !='Mobile' ){
		$custom_css .= '
.pagenums { --font-size-loadmore: '.esc_attr($airtheme_post_page_loadmore_font_size_m).';}
		';
	}

	// Title of Item Font
	$airtheme_post_page_list_item_tit_font = airtheme_get_option('theme_option_font_post_page_list_item_tit');
	$airtheme_post_page_list_item_tit_font = $airtheme_post_page_list_item_tit_font != -1 ? $airtheme_post_page_list_item_tit_font : false;
	if($airtheme_post_page_list_item_tit_font){
		$airtheme_post_page_list_item_tit_font = str_replace('+', ' ', $airtheme_post_page_list_item_tit_font);
		$custom_css .= '
.grid-item-tit,.product-caption-title { font-family: '.esc_attr($airtheme_post_page_list_item_tit_font).'; }
		';
	}
	// Title of Item stlye
	$airtheme_post_page_list_item_tit_font_style = airtheme_get_option('theme_option_font_style_post_page_list_item_tit');
	if($airtheme_post_page_list_item_tit_font_style){
		$custom_css .= '
.grid-item-tit,.product-caption-title { '.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_list_item_tit_font_style)).' }
		';
	}
	// Title of Item size
	$airtheme_post_page_list_item_tit_font_size = airtheme_get_option('theme_option_font_size_post_page_list_item_tit');
	if($airtheme_post_page_list_item_tit_font_size && $airtheme_post_page_list_item_tit_font_size !='Select' ){
		$custom_css .= '
.grid-item-tit,.product-caption-title { font-size: '.esc_attr($airtheme_post_page_list_item_tit_font_size).';}
		';
	}
	// Title of Item size Mobile
	$airtheme_post_page_list_item_tit_font_size_m = airtheme_get_option('theme_option_font_size_post_page_list_item_tit_m');
	if($airtheme_post_page_list_item_tit_font_size_m && $airtheme_post_page_list_item_tit_font_size_m !='Mobile' ){
		$custom_css .= '
body{ --font-size-list-tit: '.esc_attr($airtheme_post_page_list_item_tit_font_size_m).';}
		';
	}

	// Tag of Item Font
	$airtheme_post_page_list_item_tag_font = airtheme_get_option('theme_option_font_post_page_list_item_tag');
	$airtheme_post_page_list_item_tag_font = $airtheme_post_page_list_item_tag_font != -1 ? $airtheme_post_page_list_item_tag_font : false;
	if($airtheme_post_page_list_item_tag_font){
		$airtheme_post_page_list_item_tag_font = str_replace('+', ' ', $airtheme_post_page_list_item_tag_font);
		$custom_css .= '
.grid-item-cate-a,.woocommerce .product-caption .price { font-family: '.esc_attr($airtheme_post_page_list_item_tag_font).'; }
		';
	}
	// Tag of Item stlye
	$airtheme_post_page_list_item_tag_font_style = airtheme_get_option('theme_option_font_style_post_page_list_item_tag');
	if($airtheme_post_page_list_item_tag_font_style){
		$custom_css .= '
.grid-item-cate-a,.woocommerce .product-caption .price { '.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_list_item_tag_font_style)).' }
		';
	}
	// Tag of Item size
	$airtheme_post_page_list_item_tag_font_size = airtheme_get_option('theme_option_font_size_post_page_list_item_tag');
	if($airtheme_post_page_list_item_tag_font_size && $airtheme_post_page_list_item_tag_font_size !='Select' ){
		$custom_css .= '
.grid-item-cate-a,.woocommerce .product-caption .price { font-size: '.esc_attr($airtheme_post_page_list_item_tag_font_size).';}
		';
	}
	// Tag of Item size Mobile
	$airtheme_post_page_list_item_tag_font_size_m = airtheme_get_option('theme_option_font_size_post_page_list_item_tag_m');
	if($airtheme_post_page_list_item_tag_font_size_m && $airtheme_post_page_list_item_tag_font_size_m !='Mobile' ){
		$custom_css .= '
body { --font-size-list-tag: '.esc_attr($airtheme_post_page_list_item_tag_font_size_m).';}
		';
	}

	//////////////////////// Masonry Blog
	// Title of Item Font
	$airtheme_post_page_blog_item_tit_font = airtheme_get_option('theme_option_font_post_page_blog_item_tit');
	$airtheme_post_page_blog_item_tit_font = $airtheme_post_page_blog_item_tit_font != -1 ? $airtheme_post_page_blog_item_tit_font : false;
	if($airtheme_post_page_blog_item_tit_font){
		$airtheme_post_page_blog_item_tit_font = str_replace('+', ' ', $airtheme_post_page_blog_item_tit_font);
		$custom_css .= '
.gird-blog-tit,.blog-unit-quote,.blog-unit-link-li { font-family: '.esc_attr($airtheme_post_page_blog_item_tit_font).'; }
		';
	}
	// Title of Item stlye
	$airtheme_post_page_blog_item_tit_font_style = airtheme_get_option('theme_option_font_style_post_page_blog_item_tit');
	if($airtheme_post_page_blog_item_tit_font_style){
		$custom_css .= '
.gird-blog-tit,.blog-unit-link-li { '.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_blog_item_tit_font_style)).' }
		';
	}
	// Title of Item size
	$airtheme_post_page_blog_item_tit_font_size = airtheme_get_option('theme_option_font_size_post_page_blog_item_tit');
	if($airtheme_post_page_blog_item_tit_font_size && $airtheme_post_page_blog_item_tit_font_size !='Select' ){
		$custom_css .= '
.gird-blog-tit { font-size: '.esc_attr($airtheme_post_page_blog_item_tit_font_size).';}
		';
	}
	// Title of Item size mobile
	$airtheme_post_page_blog_item_tit_font_size_m = airtheme_get_option('theme_option_font_size_post_page_blog_item_tit_m');
	if($airtheme_post_page_blog_item_tit_font_size_m && $airtheme_post_page_blog_item_tit_font_size_m !='Mobile' ){
		$custom_css .= '
.grid-item { --font-size-blog-tit: '.esc_attr($airtheme_post_page_blog_item_tit_font_size_m).';}
		';
	}

	// Meta of Item Font
	$airtheme_post_page_blog_item_meta_font = airtheme_get_option('theme_option_font_post_page_blog_item_meta');
	$airtheme_post_page_blog_item_meta_font = $airtheme_post_page_blog_item_meta_font != -1 ? $airtheme_post_page_blog_item_meta_font : false;
	if($airtheme_post_page_blog_item_meta_font){
		$airtheme_post_page_blog_item_meta_font = str_replace('+', ' ', $airtheme_post_page_blog_item_meta_font);
		$custom_css .= '
.gird-blog-meta { font-family: '.esc_attr($airtheme_post_page_blog_item_meta_font).'; }
		';
	}
	// Meta of Item stlye
	$airtheme_post_page_blog_item_meta_font_style = airtheme_get_option('theme_option_font_style_post_page_blog_item_meta');
	if($airtheme_post_page_blog_item_meta_font_style){
		$custom_css .= '
.gird-blog-meta { '.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_blog_item_meta_font_style)).' }
		';
	}
	// meta of Item size
	$airtheme_post_page_blog_item_meta_font_size = airtheme_get_option('theme_option_font_size_post_page_blog_item_meta');
	if($airtheme_post_page_blog_item_meta_font_size && $airtheme_post_page_blog_item_meta_font_size !='Select' ){
		$custom_css .= '
.gird-blog-meta { font-size: '.esc_attr($airtheme_post_page_blog_item_meta_font_size).';}
		';
	}
	// meta of Item size mobile
	$airtheme_post_page_blog_item_meta_font_size_m = airtheme_get_option('theme_option_font_size_post_page_blog_item_meta_m');
	if($airtheme_post_page_blog_item_meta_font_size_m && $airtheme_post_page_blog_item_meta_font_size_m !='Mobile' ){
		$custom_css .= '
.grid-item { --font-size-blog-meta: '.esc_attr($airtheme_post_page_blog_item_meta_font_size_m).';}
		';
	}

	// Excerpt of Item size
	$airtheme_post_page_blog_item_excerpt_font_size = airtheme_get_option('theme_option_font_post_page_blog_excerpt');
	if($airtheme_post_page_blog_item_excerpt_font_size && $airtheme_post_page_blog_item_excerpt_font_size !='Select' ){
		$custom_css .= '
.gird-blog-excerpt { font-size: '.esc_attr($airtheme_post_page_blog_item_excerpt_font_size).';}
		';
	}
	// Excerpt of Item size mobile
	$airtheme_post_page_blog_item_excerpt_font_size_m = airtheme_get_option('theme_option_font_post_page_blog_excerpt_m');
	if($airtheme_post_page_blog_item_excerpt_font_size_m && $airtheme_post_page_blog_item_excerpt_font_size_m !='Mobile' ){
		$custom_css .= '
.grid-item { --font-size-blog-excerpt: '.esc_attr($airtheme_post_page_blog_item_excerpt_font_size_m).';}
		';
	}


	//////////////////////// Button
	// Button Font
	$airtheme_post_page_button_font = airtheme_get_option('theme_option_font_post_page_button');
	$airtheme_post_page_button_font = $airtheme_post_page_button_font != -1 ? $airtheme_post_page_button_font : false;
	if($airtheme_post_page_button_font){
		$airtheme_post_page_button_font = str_replace('+', ' ', $airtheme_post_page_button_font);
		$custom_css .= '
button, input[type="submit"],.ux-btn-text { font-family: '.esc_attr($airtheme_post_page_button_font).'; }
		';
	}
	//Button stlye
	$airtheme_post_page_button_font_style = airtheme_get_option('theme_option_font_style_post_page_button');
	if($airtheme_post_page_button_font_style){
		$custom_css .= '
button, input[type="submit"],.ux-btn-text { '.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_button_font_style)).' }
		';
	}
	//Button size
	$airtheme_post_page_button_font_size = airtheme_get_option('theme_option_font_size_post_page_button');
	if($airtheme_post_page_button_font_size && $airtheme_post_page_button_font_size !='Select' ){
		$custom_css .= '
button, input[type="submit"],.ux-btn-text { font-size: '.esc_attr($airtheme_post_page_button_font_size).';}
		';
	}
	//Button size mobile
	$airtheme_post_page_button_font_size_m = airtheme_get_option('theme_option_font_size_post_page_button_m');
	if($airtheme_post_page_button_font_size_m && $airtheme_post_page_button_font_size_m !='Mobile' ){
		$custom_css .= '
body { --font-size-button: '.esc_attr($airtheme_post_page_button_font_size_m).';}
		';
	}

	//////////////////////// Form
	// Form Font
	$airtheme_post_page_form_font = airtheme_get_option('theme_option_font_post_page_form');
	$airtheme_post_page_form_font = $airtheme_post_page_form_font != -1 ? $airtheme_post_page_form_font : false;
	if($airtheme_post_page_form_font){
		$airtheme_post_page_form_font = str_replace('+', ' ', $airtheme_post_page_form_font);
		$custom_css .= '
textarea,input { font-family: '.esc_attr($airtheme_post_page_form_font).'; }
		';
	}
	//Form stlye
	$airtheme_post_page_form_font_style = airtheme_get_option('theme_option_font_style_post_page_form');
	if($airtheme_post_page_form_font_style){
		$custom_css .= '
textarea,input { '.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_form_font_style)).' }
		';
	}
	//Form size
	$airtheme_post_page_form_font_size = airtheme_get_option('theme_option_font_size_post_page_form');
	if($airtheme_post_page_form_font_size && $airtheme_post_page_form_font_size !='Select' ){
		$custom_css .= '
textarea,input { font-size: '.esc_attr($airtheme_post_page_form_font_size).';}
		';
	}
	//Form size mobile
	$airtheme_post_page_form_font_size_m = airtheme_get_option('theme_option_font_size_post_page_form_m');
	if($airtheme_post_page_form_font_size_m && $airtheme_post_page_form_font_size_m !='Select' ){
		$custom_css .= '
body { --font-size-form: '.esc_attr($airtheme_post_page_form_font_size_m).';}
		';
	}

	//////////////////////// Archive
	// Archive Title Font
	$airtheme_archive_tit_font = airtheme_get_option('theme_option_font_archive_tit');
	$airtheme_archive_tit_font = $airtheme_archive_tit_font != -1 ? $airtheme_archive_tit_font : false;
	if($airtheme_archive_tit_font){
		$airtheme_archive_tit_font = str_replace('+', ' ', $airtheme_archive_tit_font);
		$custom_css .= '
.archive-title .title-wrap-tit { font-family: '.esc_attr($airtheme_archive_tit_font).'; }
		';
	}
	// Archive Title stlye
	$airtheme_archive_tit_font_style = airtheme_get_option('theme_option_font_style_archive_tit');
	if($airtheme_archive_tit_font_style){
		$custom_css .= '
.archive-title .title-wrap-tit { '.esc_attr(airtheme_theme_google_font_style($airtheme_archive_tit_font_style)).' }
		';
	}
	// Archive Title size
	$airtheme_archive_tit_font_size = airtheme_get_option('theme_option_font_size_archive_tit');
	if($airtheme_archive_tit_font_size && $airtheme_archive_tit_font_size !='Select' ){
		$custom_css .= '
.archive-title .title-wrap-tit { font-size: '.esc_attr($airtheme_archive_tit_font_size).';}
		';
	}
	// Archive Title size mobile
	$airtheme_archive_tit_font_size_m = airtheme_get_option('theme_option_font_size_archive_tit_m');
	if($airtheme_archive_tit_font_size_m && $airtheme_archive_tit_font_size_m !='Mobile' ){
		$custom_css .= '
.archive-title { --font-size-archive-tit: '.esc_attr($airtheme_archive_tit_font_size_m).';}
		';
	}

	// Archive Posts Title Font
	$airtheme_archive_posts_tit_font = airtheme_get_option('theme_option_font_archive_posts_tit');
	$airtheme_archive_posts_tit_font = $airtheme_archive_posts_tit_font != -1 ? $airtheme_archive_posts_tit_font : false;
	if($airtheme_archive_posts_tit_font){
		$airtheme_archive_posts_tit_font = str_replace('+', ' ', $airtheme_archive_posts_tit_font);
		$custom_css .= '
.arvhive-tit { font-family: '.esc_attr($airtheme_archive_posts_tit_font).'; }
		';
	}
	// Archive Posts Title stlye
	$airtheme_archive_posts_tit_font_style = airtheme_get_option('theme_option_font_style_archive_posts_tit');
	if($airtheme_archive_posts_tit_font_style){
		$custom_css .= '
.arvhive-tit { '.esc_attr(airtheme_theme_google_font_style($airtheme_archive_posts_tit_font_style)).' }
		';
	}
	// Archive Posts Title size
	$airtheme_archive_posts_tit_font_size = airtheme_get_option('theme_option_font_size_archive_posts_tit');
	if($airtheme_archive_posts_tit_font_size && $airtheme_archive_posts_tit_font_size !='Select' ){
		$custom_css .= '
.arvhive-tit { font-size: '.esc_attr($airtheme_archive_posts_tit_font_size).';}
		';
	}
	// Archive Posts Title size mobile
	$airtheme_archive_posts_tit_font_size_m = airtheme_get_option('theme_option_font_size_archive_posts_tit_m');
	if($airtheme_archive_posts_tit_font_size_m && $airtheme_archive_posts_tit_font_size_m !='Mobile' ){
		$custom_css .= '
.archive-list { --font-size-archive-item-tit: '.esc_attr($airtheme_archive_posts_tit_font_size_m).';}
		';
	}

	//////////////////////// Widgets
	// Widgets Title Font
	$airtheme_post_page_widget_tit_font = airtheme_get_option('theme_option_font_post_page_widget_tit');
	$airtheme_post_page_widget_tit_font = $airtheme_post_page_widget_tit_font != -1 ? $airtheme_post_page_widget_tit_font : false;
	if($airtheme_post_page_widget_tit_font){
		$airtheme_post_page_widget_tit_font = str_replace('+', ' ', $airtheme_post_page_widget_tit_font);
		$custom_css .= '
.widget-title { font-family: '.esc_attr($airtheme_post_page_widget_tit_font).'; }
		';
	}
	// Widgets Title stlye
	$airtheme_post_page_widget_tit_font_style = airtheme_get_option('theme_option_font_style_post_page_widget_tit');
	if($airtheme_post_page_widget_tit_font_style){
		$custom_css .= '
.widget-title { '.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_widget_tit_font_style)).' }
		';
	}
	// Widgets Title size
	$airtheme_post_page_widget_tit_font_size = airtheme_get_option('theme_option_font_size_post_page_widget_tit');
	if($airtheme_post_page_widget_tit_font_size && $airtheme_post_page_widget_tit_font_size !='Select' ){
		$custom_css .= '
.widget-title { font-size: '.esc_attr($airtheme_post_page_widget_tit_font_size).';}
		';
	}
	// Widgets Title size mobile
	$airtheme_post_page_widget_tit_font_size_m = airtheme_get_option('theme_option_font_size_post_page_widget_tit_m');
	if($airtheme_post_page_widget_tit_font_size_m && $airtheme_post_page_widget_tit_font_size_m !='Mobile' ){
		$custom_css .= '
.widget-title { --font-size-widget-tit: '.esc_attr($airtheme_post_page_widget_tit_font_size_m).';}
		';
	}

	// Widget Content Font
	$airtheme_post_page_widget_con_font = airtheme_get_option('theme_option_font_post_page_widget_con');
	$airtheme_post_page_widget_con_font = $airtheme_post_page_widget_con_font != -1 ? $airtheme_post_page_widget_con_font : false;
	if($airtheme_post_page_widget_con_font){
		$airtheme_post_page_widget_con_font = str_replace('+', ' ', $airtheme_post_page_widget_con_font);
		$custom_css .= '
.widget-container { font-family: '.esc_attr($airtheme_post_page_widget_con_font).'; }
		';
	}
	// Widget Content stlye
	$airtheme_post_page_widget_con_font_style = airtheme_get_option('theme_option_font_style_post_page_widget_con');
	if($airtheme_post_page_widget_con_font_style){
		$custom_css .= '
.widget-container { '.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_widget_con_font_style)).' }
		';
	}
	// Widget Content size
	$airtheme_post_page_widget_con_font_size = airtheme_get_option('theme_option_font_size_post_page_widget_con');
	if($airtheme_post_page_widget_con_font_size && $airtheme_post_page_widget_con_font_size !='Select' ){
		$custom_css .= '
.widget-container { font-size: '.esc_attr($airtheme_post_page_widget_con_font_size).';}
		';
	}
	// Widget Content size
	$airtheme_post_page_widget_con_font_size_m = airtheme_get_option('theme_option_font_size_post_page_widget_con_m');
	if($airtheme_post_page_widget_con_font_size_m && $airtheme_post_page_widget_con_font_size_m !='Mobile' ){
		$custom_css .= '
.widget-container { --font-size-widget-con: '.esc_attr($airtheme_post_page_widget_con_font_size_m).';}
		';
	}

	// Footer Font
	$airtheme_post_page_footer_font = airtheme_get_option('theme_option_font_post_page_footer');
	$airtheme_post_page_footer_font = $airtheme_post_page_footer_font != -1 ? $airtheme_post_page_footer_font : false;
	if($airtheme_post_page_footer_font){
		$airtheme_post_page_footer_font = str_replace('+', ' ', $airtheme_post_page_footer_font);
		$custom_css .= '
.footer-info { font-family: '.esc_attr($airtheme_post_page_footer_font).'; }
		';
	}
	// Footer stlye
	$airtheme_post_page_footer_font_style = airtheme_get_option('theme_option_font_style_post_page_footer');
	if($airtheme_post_page_footer_font_style){
		$custom_css .= '
.footer-info { '.esc_attr(airtheme_theme_google_font_style($airtheme_post_page_footer_font_style)).' }
		';
	}
	// Footer size
	$airtheme_post_page_footer_font_size = airtheme_get_option('theme_option_font_size_post_page_footer');
	if($airtheme_post_page_footer_font_size && $airtheme_post_page_footer_font_size !='Select' ){
		$custom_css .= '
.footer-info { font-size: '.esc_attr($airtheme_post_page_footer_font_size).';}
		';
	}
	// Footer size mobile
	$airtheme_post_page_footer_font_size_m = airtheme_get_option('theme_option_font_size_post_page_footer_m');
	if($airtheme_post_page_footer_font_size_m && $airtheme_post_page_footer_font_size_m !='Mobile' ){
		$custom_css .= '
.footer-info { --font-size-footer: '.esc_attr($airtheme_post_page_footer_font_size_m).';}
		';
	}



	/////////////////  Featured Colors

	$featured_color_default = airtheme_get_option('theme_option_featured_color_default');
	if($featured_color_default){
		$custom_css .= ".post-bgcolor-default{color:" .esc_attr($featured_color_default). ";}\n";
		$custom_css .= ".post-bgcolor-default{background-color:" .esc_attr($featured_color_default). ";}\n";
	}

	//color 1-10
	for($color_num=1;$color_num<=10;$color_num++){
		$featured_color = airtheme_get_option('theme_option_featured_color_' .$color_num);
		if($featured_color){
			$custom_css .= ".theme-color-".$color_num."{color:" .esc_attr($featured_color). ";}\n";
			$custom_css .= ".bg-theme-color-".$color_num.",.promote-hover-bg-theme-color-".$color_num.":hover,.list-layout-con.bg-theme-color-".$color_num."{background-color:" .esc_attr($featured_color). ";}\n";
			$custom_css .= ".moudle .ux-btn.bg-theme-color-".$color_num." { border-color:" .esc_attr($featured_color). "; color:" .esc_attr($featured_color). "; }\n";
			$custom_css .= ".moudle .ux-btn.bg-theme-color-".$color_num."-hover:hover{ border-color:" .esc_attr($featured_color). "; color:" .esc_attr($featured_color). "; }\n";

			if($color_num == 10){
				$custom_css .= ".navi-bgcolor-default { background-color:" .esc_attr($featured_color). "; }\n";
			}
		}
	}

	//Global  
	//Logo height
	$airtheme_custom_logo_height = intval( airtheme_get_option( 'theme_option_custom_logo_height' ) );
	if ( $airtheme_custom_logo_height ) {
		$custom_css .= "
.logo-image,.woocommerce .logo-image,.woocommerce-page .logo-image { 
	max-height:none; max-width:none; height: ".esc_attr( $airtheme_custom_logo_height )."px; 
}
		";
	}
	$airtheme_custom_logo_height_mobile = intval( airtheme_get_option( 'theme_option_custom_logo_height_mobile' ) );
	if ( $airtheme_custom_logo_height_mobile ) {
		$custom_css .= "
body { --height-logo-m: ".esc_attr( $airtheme_custom_logo_height_mobile )."px; }
		";
	}

	//Footer logo height
	$airtheme_custom_foot_logo_height = intval(esc_attr(airtheme_get_option('theme_option_custom_foot_logo_height')));
	if($airtheme_custom_foot_logo_height) {
				$custom_css .= "
@media (min-width: 768px) {
	.logo-footer-img,.woocommerce .logo-footer-img,.woocommerce-page .logo-footer-img { 
    	max-height:none; max-width:none; height: ".$airtheme_custom_foot_logo_height."px; 
	}
}
		";
	}

	//Main Container width
	$airtheme_color_main_width = esc_attr(airtheme_get_option('theme_option_main_width'));

	if($airtheme_color_main_width == '1070') {
		$custom_css .= "
@media (min-width: 1200px) {
  .container,
  .bordery20px .container,
  .bordery30px .container,
  .bordery40px .container,
  .pagebuilder-wrap > .container-fluid,
  .fullwidth-wrap > .container-fluid {
    width: 1070px;
  }
}
		";
	} else if($airtheme_color_main_width == '970') {
		$custom_css .= "
@media (min-width: 1200px) {
  .container,
  .bordery20px .container,
  .bordery30px .container,
  .bordery40px .container,
  .pagebuilder-wrap > .container-fluid,
  .fullwidth-wrap > .container-fluid {
    width: 970px;
  }
}
		";
	}

	//Disable All Animation
	$airtheme_disable_all_animation = esc_attr(airtheme_get_option('theme_option_disable_all_animation'));
	if($airtheme_disable_all_animation) {
		$custom_css .= "
.container-masonry .grid-item-inside {
    opacity: 1;
    -webkit-transform: translateY(0);
    -moz-transform: translateY(0);
    transform: translateY(0);
}
		";		
	}

	//Mobile style

	//Header height on mobile
	$header_height_monbile = airtheme_get_option('theme_option_header_height_mobile');
	$enable_mobile = airtheme_get_option('theme_option_mobile_enable_responsive');

	if($enable_mobile && $header_height_monbile && $header_height_monbile != '80') {
		$custom_css .= '
@media(max-width:767px) {
	.responsive-ux #header,.responsive-ux .logo-a, .responsive-ux #logo, .responsive-ux .logo-h1,body.responsive-ux #header-main > .container-fluid,body.responsive-ux #header-main > .container,.responsive-ux #woocomerce-cart-side { height: '.esc_attr($header_height_monbile).'px; } 
	.responsive-ux .logo-a, .responsive-ux #logo, .responsive-ux .logo-h1,.responsive-ux #header #logo .logo-h1,.responsive-ux #woocomerce-cart-side { line-height: '.esc_attr($header_height_monbile).'px;  }
	.responsive-ux .logo-image,.woocommerce .logo-image, .woocommerce-page .logo-image { max-height: '.esc_attr($header_height_monbile).'px; } 
	body.responsive-ux.single-format-gallery.single-portfolio-fullwidth #title-wrap { padding-top: '.esc_attr($header_height_monbile).'px; }
}';

	}

	//Custom css
	$airtheme_custom_css = airtheme_get_option('theme_option_custom_css');
	if($airtheme_custom_css){ 
		$custom_css .= sanitize_text_field(stripslashes($airtheme_custom_css));
	}

	return $custom_css;

}

?>