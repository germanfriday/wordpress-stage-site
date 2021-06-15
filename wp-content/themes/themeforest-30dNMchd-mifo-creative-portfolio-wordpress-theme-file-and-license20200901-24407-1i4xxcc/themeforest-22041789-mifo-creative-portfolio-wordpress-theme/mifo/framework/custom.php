<?php
/*
dynamic css file. please don't edit it. it's update automatically when settins changed
*/
 add_action('wp_head', 'mifo_custom_colors', 160);
 function mifo_custom_colors() { 
   global $rs_option;

	if(!empty($rs_option['body_bg_color']))
	{
	$body_bg 	      = $rs_option['body_bg_color'];
	}	
	$body_color       = $rs_option['body_text_color'];	
	$site_color       = $rs_option['primary_color'];	
	$secondary_color  = $rs_option['secondary_color'];	
	$link_color       = $rs_option['link_text_color'];	
	$link_hover_color = $rs_option['link_hover_text_color'];	
	$footer_bg_color  = $rs_option['footer_bg_color'];
	$copyright_bg_color = $rs_option['copyright_bg_color'];
	$social_text_color = $rs_option['social_text_color'];
	$copyright_text_color  = $rs_option['copy_text_color'];
	$footer_text_color  = $rs_option['footer_text_color'];

	if(!empty($rs_option['menu_text_color'])){		
	$menu_text_color = $rs_option['menu_text_color'];
	}
	if(!empty($rs_option['menu_text_hover_color'])){		
	$menu_text_hover_color = $rs_option['menu_text_hover_color'];
	}
	if(!empty($rs_option['menu_text_active_color'])){		
		$menu_active_color = $rs_option['menu_text_active_color'];
	}
	if(!empty($rs_option['drop_down_bg_color'])){		
		$drop_down_bg = $rs_option['drop_down_bg_color'];	
	}
	if(!empty($rs_option['drop_text_color'])){		
		$dropdown_text_color = $rs_option['drop_text_color'];
	}	
	if(!empty($rs_option['drop_text_hover_color'])){		
		$drop_text_hover_color = $rs_option['drop_text_hover_color'];
	}
	if(!empty($rs_option['drop_text_hoverbg_color'])){		
		$drop_text_hoverbg_color = $rs_option['drop_text_hoverbg_color'];
	}
	
	//typography extract for body	
	if(!empty($rs_option['opt-typography-body']['color']))
	{
		$body_typography_color=$rs_option['opt-typography-body']['color'];
	}
	if(!empty($rs_option['opt-typography-body']['line-height']))
	{
		$body_typography_lineheight=$rs_option['opt-typography-body']['line-height'];
	}
		
	$body_typography_font=$rs_option['opt-typography-body']['font-family'];

	$body_typography_font_size=$rs_option['opt-typography-body']['font-size'];
	
	
	//typography extract for menu
	$menu_typography_color=$rs_option['opt-typography-menu']['color'];	
	$menu_typography_weight=$rs_option['opt-typography-menu']['font-weight'];	
	$menu_typography_font_family=$rs_option['opt-typography-menu']['font-family'];
	$menu_typography_font_fsize=$rs_option['opt-typography-menu']['font-size'];	
	if(!empty($rs_option['opt-typography-menu']['line-height']))
	{
		$menu_typography_line_height=$rs_option['opt-typography-menu']['line-height'];
	}
	
	//typography extract for heading
	
	$h1_typography_color=$rs_option['opt-typography-h1']['color'];		
	if(!empty($rs_option['opt-typography-h1']['font-weight']))
	{
		$h1_typography_weight=$rs_option['opt-typography-h1']['font-weight'];
	}
		
	$h1_typography_font_family=$rs_option['opt-typography-h1']['font-family'];
	$h1_typography_font_fsize=$rs_option['opt-typography-h1']['font-size'];	
	if(!empty($rs_option['opt-typography-h1']['line-height']))
	{
		$h1_typography_line_height=$rs_option['opt-typography-h1']['line-height'];
	}
	
	$h2_typography_color=$rs_option['opt-typography-h2']['color'];	

	$h2_typography_font_fsize=$rs_option['opt-typography-h2']['font-size'];	
	if(!empty($rs_option['opt-typography-h2']['font-weight']))
	{
		$h2_typography_font_weight=$rs_option['opt-typography-h2']['font-weight'];
	}	
	$h2_typography_font_family=$rs_option['opt-typography-h2']['font-family'];
	$h2_typography_font_fsize=$rs_option['opt-typography-h2']['font-size'];	
	if(!empty($rs_option['opt-typography-h2']['line-height']))
	{
		$h2_typography_line_height=$rs_option['opt-typography-h2']['line-height'];
	}
	
	$h3_typography_color=$rs_option['opt-typography-h3']['color'];	
	if(!empty($rs_option['opt-typography-h3']['font-weight']))
	{
		$h3_typography_font_weightt=$rs_option['opt-typography-h3']['font-weight'];
	}	
	$h3_typography_font_family=$rs_option['opt-typography-h3']['font-family'];
	$h3_typography_font_fsize=$rs_option['opt-typography-h3']['font-size'];	
	if(!empty($rs_option['opt-typography-h3']['line-height']))
	{
		$h3_typography_line_height=$rs_option['opt-typography-h3']['line-height'];
	}

	$h4_typography_color=$rs_option['opt-typography-h4']['color'];	
	if(!empty($rs_option['opt-typography-h4']['font-weight']))
	{
		$h4_typography_font_weight=$rs_option['opt-typography-h4']['font-weight'];
	}	
	$h4_typography_font_family=$rs_option['opt-typography-h4']['font-family'];
	$h4_typography_font_fsize=$rs_option['opt-typography-h4']['font-size'];	
	if(!empty($rs_option['opt-typography-h4']['line-height']))
	{
		$h4_typography_line_height=$rs_option['opt-typography-h4']['line-height'];
	}
	
	$h5_typography_color=$rs_option['opt-typography-h5']['color'];	
	if(!empty($rs_option['opt-typography-h5']['font-weight']))
	{
		$h5_typography_font_weight=$rs_option['opt-typography-h5']['font-weight'];
	}	
	$h5_typography_font_family=$rs_option['opt-typography-h5']['font-family'];
	$h5_typography_font_fsize=$rs_option['opt-typography-h5']['font-size'];	
	if(!empty($rs_option['opt-typography-h5']['line-height']))
	{
		$h5_typography_line_height=$rs_option['opt-typography-h5']['line-height'];
	}
	
	$h6_typography_color=$rs_option['opt-typography-6']['color'];	
	if(!empty($rs_option['opt-typography-6']['font-weight']))
	{
		$h6_typography_font_weight=$rs_option['opt-typography-6']['font-weight'];
	}
	$h6_typography_font_family=$rs_option['opt-typography-6']['font-family'];
	$h6_typography_font_fsize=$rs_option['opt-typography-6']['font-size'];	
	if(!empty($rs_option['opt-typography-6']['line-height']))
	{
		$h6_typography_line_height=$rs_option['opt-typography-6']['line-height'];
	}	
?>

<!-- Typography -->
<?php if(!empty($body_color)){
	?>
<style>
body{
	background:<?php echo esc_attr($body_bg); ?> !important;
	color:<?php echo esc_attr($body_color); ?> !important;
	font-family: <?php echo esc_attr($body_typography_font);?> !important;    
    font-size: <?php echo esc_attr($body_typography_font_size);?> !important;	
}
.preloader {
	background:<?php echo esc_attr($site_color); ?> !important;
}
.navbar a, .navbar li{	
	font-family:<?php echo esc_attr($menu_typography_font_family);?>!important;
	font-size:<?php echo esc_attr($menu_typography_font_fsize);?>;
}
.menu-area .navbar ul li > a,
.nav-link-container a{
	color: <?php echo esc_attr($menu_text_color); ?> !important;
}
.menu-area:not(.sticky) .navbar ul li.active a,
.page-template-page-single .menu-area:not(.sticky) .navbar ul li.active a {
	color: <?php echo esc_attr($menu_active_color); ?> !important;
}
.menu-area .navbar ul li ul.sub-menu{
	background:<?php echo esc_attr($drop_down_bg);?> !important;
}
#rs-header .menu-area .navbar ul li .sub-menu li a, 
#rs-header .menu-area .navbar ul li .children li a {
	color:<?php echo esc_attr($dropdown_text_color);?> !important;
}
#rs-header .menu-area .navbar ul ul li a:hover ,
#rs-header .menu-area .navbar ul ul li.current-menu-item > a{
	color:<?php echo esc_attr($drop_text_hover_color);?> !important
}
#rs-header .menu-area .navbar ul ul li a:hover, #rs-header .menu-area .navbar ul ul li.current-menu-item > a {
<?php if(!empty($drop_text_hoverbg_color))
{?>
  background:<?php echo esc_attr($drop_text_hoverbg_color); ?> !important;
<?php }?>	
}

#rs-header .menu-area .navbar ul li .sub-menu li{

  <?php if(!empty($rs_option['drop_text_hoverbg_color'])){		
		?>
		border-color:<?php echo esc_attr($dropdown_border_color); ?> !important;
		<?php
	}	
	?>
}

h1{
	color:<?php echo esc_attr($h1_typography_color);?>;
	font-family:<?php echo esc_attr($h1_typography_font_family);?>!important;
	font-size:<?php echo esc_attr($h1_typography_font_fsize);?>!important;
	<?php if(!empty($h1_typography_weight)){
	?>
	font-weight:<?php echo esc_attr($h1_typography_weight);?>!important;
	<?php }?>
	
	<?php if(!empty($h1_typography_line_height)){
	?>
		line-height:<?php echo esc_attr($h1_typography_line_height);?>!important;
	<?php }?>
	
}
h2{
	color:<?php echo esc_attr($h2_typography_color);?>; 
	font-family:<?php echo esc_attr($h2_typography_font_family);?>!important;
	font-size:<?php echo esc_attr($h2_typography_font_fsize);?>;
	<?php if(!empty($h2_typography_font_weight)){
	?>
	font-weight:<?php echo esc_attr($h2_typography_font_weight);?>!important;
	<?php }?>
	
	<?php if(!empty($h2_typography_line_height)){
	?>
		line-height:<?php echo esc_attr($h2_typography_line_height);?>
	<?php }?>
}
h3{
	color:<?php echo esc_attr($h3_typography_color);?> ;
	font-family:<?php echo esc_attr($h3_typography_font_family);?>!important;
	font-size:<?php echo esc_attr($h3_typography_font_fsize);?>;
	<?php if(!empty($h3_typography_font_weight)){
	?>
	font-weight:<?php echo esc_attr($h3_typography_font_weight);?>!important;
	<?php }?>
	
	<?php if(!empty($h3_typography_line_height)){
	?>
		line-height:<?php echo esc_attr($h3_typography_line_height);?>!important;
	<?php }?>
}
h4{
	color:<?php echo esc_attr($h4_typography_color);?>;
	font-family:<?php echo esc_attr($h4_typography_font_family);?>!important;
	font-size:<?php echo esc_attr($h4_typography_font_fsize);?>;
	<?php if(!empty($h4_typography_font_weight)){
	?>
	font-weight:<?php echo esc_attr($h4_typography_font_weight);?>!important;
	<?php }?>
	
	<?php if(!empty($h4_typography_line_height)){
	?>
		line-height:<?php echo esc_attr($h4_typography_line_height);?>!important;
	<?php }?>
	
}
h5{
	color:<?php echo esc_attr($h5_typography_color);?>;
	font-family:<?php echo esc_attr($h5_typography_font_family);?>!important;
	font-size:<?php echo esc_attr($h5_typography_font_fsize);?>;
	<?php if(!empty($h5_typography_font_weight)){
	?>
	font-weight:<?php echo esc_attr($h5_typography_font_weight);?>!important;
	<?php }?>
	
	<?php if(!empty($h5_typography_line_height)){
	?>
		line-height:<?php echo esc_attr($h5_typography_line_height);?>!important;
	<?php }?>
}
h6{
	color:<?php echo esc_attr($h6_typography_color);?> ;
	font-family:<?php echo esc_attr($h6_typography_font_family);?>!important;
	font-size:<?php echo esc_attr($h6_typography_font_fsize);?>;
	<?php if(!empty($h6_typography_font_weight)){
	?>
	font-weight:<?php echo esc_attr($h6_typography_font_weight);?>!important;
	<?php }?>
	
	<?php if(!empty($h6_typography_line_height)){
	?>
		line-height:<?php echo esc_attr($h6_typography_line_height);?>!important;
	<?php }?>
}

.mc4wp-form input[type="submit"], 
.rs-testimonial .testi-content, 
.rs-footer .footer-top .recent-post-widget .post-item .post-date, 
.rs-footer .footer-title::after, 
.rs-footer .footer-top .widget_nav_menu li a::after, 
.footer-style-6 .footer-bottom .footer-bottom-share ul li a:hover, 
#wp-megamenu-menu-1 > .wpmm-nav-wrap ul.wp-megamenu > li.wpmm_dropdown_menu  ul.wp-megamenu-sub-menu, 
#wp-megamenu-menu-1 > .wpmm-nav-wrap ul.wp-megamenu  li.wpmm-type-widget .wp-megamenu-sub-menu li .wp-megamenu-sub-menu, 
#wp-megamenu-menu-1 > .wpmm-nav-wrap ul.wp-megamenu > li.wpmm_mega_menu > ul.wp-megamenu-sub-menu,
.team-slider-style2 .team-item-wrap .team-content .display-table .display-table-cell .team-social .social-icon, 
.team-slider-style2 .team-item-wrap .team-content .display-table .display-table-cell .team-title:after,
.cl-testimonial2#cl-testimonial .slick-next, .cl-testimonial2#cl-testimonial .slick-prev, .video-page-price .featured .bottom ul li:nth-child(odd),
.rs-team .team-item .team-social .social-icon, .video-page-price .first-table .bottom .btn-table, .video-page-price .middle-table .bottom .btn-table,
.particles-section .particle-btn li:first-child a,
.bs-sidebar .tagcloud a,
.pagination-area .nav-links span.current,
.pagination-area .nav-links a:hover,
.rs-blog-details .author-block .author-title:after,
.comment-respond .form-submit #submit,
.rs-about .about-skill,
.rs-services .services-details .single-services:hover, .rs-services .services-details .single-services.active,
.rs-portfolio .portfolio-item .portfolio-content:before,
#rs-testimonial .slick-dots .slick-active button,
.rs-blog .blog-slider .single-blog-slide .images .overley,
input[type="button"], input[type="reset"], input[type="submit"],
.sidenav .nav-close-menu-li button:hover:after, .sidenav .nav-close-menu-li button:hover:before,
.rs-blog .blog-item .blog-img .blog-img-content:before,
.object,
code,
.clpricing-table .price-table.style15 .cl-pricetable-wrap .top .popular,
.clpricing-table .price-table.style15 .cl-pricetable-wrap .bottom .btn-table,
.clpricing-table .price-table.style14 .cl-pricetable-wrap .top .popular,
.clpricing-table .price-table.style14 .cl-pricetable-wrap .bottom .btn-table,
.primary-bg,
.sidenav,
.rs-team .team-item .team-content:before,
.woocommerce #respond input#submit, 
.woocommerce a.button, 
.woocommerce button.button, 
.woocommerce input.button,
.woocommerce #respond input#submit.alt,
.woocommerce a.button.alt, .woocommerce button.button.alt, 
.woocommerce input.button.alt,
.woocommerce span.onsale
{
	background:<?php echo esc_attr($site_color);?> !important;
}
.rs-portfolio-style4 .portfolio-item .portfolio-img:before {
	background-color:<?php echo esc_attr($site_color);?> !important;
}
.rs-footer, .rs-footer .footer-bottom, .rs-footer .footer-bottom2{
	background-color:<?php echo esc_attr($copyright_bg_color);?> !important;
}

.rs-footer, .rs-footer .footer-bottom, .rs-footer .footer-bottom2, .footer-bottom-share li a {
	color:<?php echo esc_attr($copyright_text_color);?> 
}
.footer-top{
	background-color:<?php echo esc_attr($footer_bg_color);?> !important;
}

.footer-top{
	color:<?php echo esc_attr($footer_text_color);?>
}

.rs-about .about-exp, .rs-testimonial .testi-content::before, .rs-blog .blog-item:hover .blog-button a, .rs-services .services-icon,  .sec-title-single h3,
.team-slider-style2 .team-item-wrap .team-content .display-table .display-table-cell .team-social a, #ratings h3, #ratings #total-rat strong,
.rs-about .about-title h2, 
.bs-sidebar .recent-post-widget .post-desc a:hover,
article.sticky .blog-title a,
.full-blog-content:hover a,
.bs-sidebar ul a:hover,
article.sticky .blog-title a:after,
.rs-heading .title-inner h2,
.counter-top-area:hover i,
.cta-inner h3, .cta-inner h2,
.counter-top-area h2,
.rs-blog .blog-slider .single-blog-slide .blog-informations .blog-details h3 a:hover,
.rs-blog .blog-slider .single-blog-slide .blog-informations .blog-details .read-more a:hover,
.rs-blog .blog-slider .single-blog-slide .blog-informations .blog-details .read-more a:after,
.sidenav .nav-close-menu-li button:hover,
#contact-address #address-box h3, #contact-address #phone-box h3, #contact-address #email-box h3,
rs-blog .blog-item .blog-button a:hover, 
.clpricing-table .price-table.style15 .cl-pricetable-wrap .top .cl-subheader h3,
.owl-navigation-yes .owl-nav [class*="owl-"],
.woocommerce div.product p.price,
.woocommerce div.product span.price,
.woocommerce ul.products li.product .price{
	color:<?php echo esc_attr($site_color); ?> !important;
}
.rs-banner .banner-content .banner_title,
.rs-slider .slick-arrow {
	color:<?php echo esc_attr($site_color); ?>;
}
.rs-services .services-details .middle-content,
.rs-services .services-details .br-10,
.rs-services .services-details .bt-10,
#rs-testimonial .slick-dots .slick-active button,
#rs-testimonial .slick-dots button,
.pagination-area .nav-links a,
.pagination-area .nav-links span.current,
blockquote,
.rs-resume .resume-item,
.rs-slider .slick-arrow{
	border-color: <?php echo esc_attr($site_color); ?> !important;
}
a{
	color:<?php echo  esc_attr($link_color);?>
}
a:hover{
	color:<?php echo esc_attr($link_hover_color);?>
}

#rs-header .menu-area .navbar ul li .sub-menu li a{
	color:<?php echo esc_attr($dropdown_text_color);?>;
}
#rs-header .menu-area .navbar ul ul li a:hover ,
#rs-header .menu-area .navbar ul ul li.current-menu-item > a{
	color:<?php echo esc_attr($drop_text_hover_color);?>
} 
.rs-footer.footer-style-3 .footer-top .footer-bottom-share ul li a:hover, 
.rs-footer.footer-style-3 .widget_contact_widget ul li:hover i {
	color: <?php echo esc_attr($secondary_color);?>	!important;
}
.menu-area .menu-main-menu-container .menu > li a:after,
.header-title-square-effect .title:after,
.portfolio-filter button.active:before,
.service-square-effect .services-desc:after,
.header-title-square-effect .title:after,
.banner-title-square-effect .work-position:after,
.slider-title-square-effect .slide-title:after,
.square-effect:after,
.rs-testimonial.slider8#cl-testimonial p:after,
#cl-testimonial .testimonial-content p:after{
	background: <?php echo esc_attr($secondary_color);?> !important;
}

.woocommerce-message,
.woocommerce-error, 
.woocommerce-info, 
.woocommerce-message{
	border-top-color: <?php echo esc_attr($secondary_color);?> !important;
}

.woocommerce-message::before,
.woocommerce-info::before{
	color: <?php echo esc_attr($secondary_color);?> !important;
}

<?php
}?>
</style>
<?php
if(is_page() || is_single()){
  	$padding_top = get_post_meta(get_the_ID(), 'content-top', true);
  	$padding_bottom = get_post_meta(get_the_ID(), 'content-bottom', true);
  	if($padding_top != '' || $padding_bottom != ''){
	  	?>
	  	  <style>
	  	  	.main-contain #content{
	  	  		<?php if(!empty($padding_top)): ?>padding-top:<?php echo esc_attr($padding_top); endif;?> !important;
	  	  		<?php if(!empty($padding_bottom)): ?>padding-bottom:<?php echo esc_attr($padding_bottom); endif;?> !important;
	  	  	}
	  	  </style>	
	  	<?php
	  }
  }	
   
}
?>