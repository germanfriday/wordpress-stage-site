<?php
/**
 * Render custom styles.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jws_theme_custom_css' ) ) {
	function jws_theme_custom_css( $css = array() ) {
$cs = cs_get_option('body-font');
if(!empty($cs)) {
    
		// Logo width
		$logo_width = cs_get_option( 'logo-max-width' );
		if ( ! empty( $logo_width ) ) {
			$css[] = '
				.jws-logo {
					max-width: ' . esc_attr( $logo_width ) . 'px;
				}
			';
		}
		// Logo Height
		$logo_height = cs_get_option( 'logo-light-height' );
		if ( ! empty( $logo_height ) ) {
			$css[] = '
				.logo-kloud {
					line-height: ' . esc_attr( $logo_height ) . 'px;
				}
			';
		}
        // Logo Height
		$right_header_height = cs_get_option( 'right-header-light-height' );
		if ( ! empty( $right_header_height ) ) {
			$css[] = '
				#jws_header .right-header {
					height: ' . esc_attr( $right_header_height ) . 'px;
				}
			';
		}
		// Boxed layout
		$boxed_bg = cs_get_option( 'boxed-bg' );

		if ( ! empty( $boxed_bg['image'] ) ) {
			$css[] = '.boxed {';
				$css[] = '
					background-image:  url(' .  esc_url( $boxed_bg['image'] ) . ');
		
				';
				if ( ! empty( $boxed_bg['color'] ) ) {
					$css[] = 'background-color: ' .  $boxed_bg['color'] .';';
				}
			$css[] = '}';
		}

		// WC page title
		$wc_head_bg = cs_get_option( 'wc-pagehead-bg' );
        $is_shop = '';
        if ( class_exists( 'WooCommerce' ) ) { 
        $is_shop = is_shop();
        }
		if ( $is_shop && ! empty( $wc_head_bg ) ) {
			$css[] = '.woocommerce-page .title-bar-header {';
				$css[] = '
					background-image:  url(' .  esc_url( $wc_head_bg['image'] ) . ');

				';
				if ( ! empty( $wc_head_bg['color'] ) ) {
					$css[] = 'background-color: ' .  $wc_head_bg['color'] .';';
				}
			$css[] = '}';
		}
        $wc_head_single_bg = cs_get_option( 'wc-pagehead-single-bg');  
        if ( is_single() && ! empty( $wc_head_single_bg ) ) {
			$css[] = '.single-product .title-bar-header {';
				$css[] = '
					background-image:  url(' .  esc_url( $wc_head_single_bg['image'] ) . ');

				';
				if ( ! empty( $wc_head_single_bg['color'] ) ) {
					$css[] = 'background-color: ' .  $wc_head_single_bg['color'] .';';
				}
			$css[] = '}';
		} 
      

		// Portfolio page title
		$portfolio_head_bg = cs_get_option( 'pp-pagehead-bg' );
		if ( ! empty( $portfolio_head_bg ) ) {
			$css[] = '.single-portfolio .title-bar-header {';
				$css[] = '
					background-image:  url(' .  esc_url( $portfolio_head_bg['image'] ) . ');
				';
				if ( ! empty( $portfolio_head_bg['color'] ) ) {
					$css[] = 'background-color: ' .  $portfolio_head_bg['color'] .';';
				}
			$css[] = '}';
		}
        //  page golobo title
        $option_tt = get_post_meta( get_the_ID(), '_custom_page_options', true );
        if(!isset($option_tt['page_title_pg'])) {
           $golobal_head_bg = cs_get_option( 'golobal-enable-page-title-bg' );
        }else {
            $golobal_head_bg = $option_tt['page_title_pg'];
        }
        
		if ( ! empty( $golobal_head_bg ) ) {
			$css[] = ' .title-bar-header {';
				$css[] = '
					background-image:  url(' .  esc_url( $golobal_head_bg['image'] ) . ');
				';
				if ( ! empty( $golobal_head_bg['color'] ) ) {
					$css[] = 'background-color: ' .  $golobal_head_bg['color'] .';';
				}
			$css[] = '}';
		}
        $header_bg = cs_get_option( 'header_bg' );
        if ( ! empty( $header_bg ) ) {
			$css[] = ' #jws_header.jws-header-v2 {';
				$css[] = '
					background-image:  url(' .  esc_url( $header_bg['image'] ) . ');

				';
				if ( ! empty( $header_bg['color'] ) ) {
					$css[] = 'background-color: ' .  $header_bg['color'] .';';
				}
			$css[] = '}';
		}
		// Typography
        if ( cs_get_option( 'heading-color' ) ) {
			$css[] = 'h1, h2, h3, h4, h5, h6 , 	a ,.kloud-info-box.top_icon_border .box-icon-wrapper .info-box-icon .title_icon , .kloud-info-box.top_icon .info-box-content .info-box-inner:hover h4 , .vc_tta-title-text , .jws-blog-detail .blog-meta .post-tags span , .portfolio-single .pp_meta_box div ,.portfolio-single .nav-post .nav-box .text-nav p ,#content .action-filter-swaper .widgets-area .product-sort-by ul .current span:after,.slick-arrow,
			#footer-jws .wpcf7 form .submit_btn .wpcf7-submit , #content .action-filter-swaper , .price_slider_amount .price_label span {';
				$css[] = 'color:' . cs_get_option( 'heading-color' );
			$css[] = '}';
            $css[] = '
			.kloud-blog-holder.blog-menu .post-item .content-blog .content-inner .title h6 a {';
				$css[] = 'color:' . cs_get_option( 'heading-color' ); 
			$css[] = '!important;}';
            
            
            
		}
        
        
		$body_font    = cs_get_option( 'body-font' );
		$heading_font = cs_get_option( 'heading-font' );
        
		$css[] = 'body , .font-body {';
			// Body font family
			$css[] = 'font-family: "' . $body_font['family'] . '";';
			if ( '100italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 100;
					font-style: italic;
				';
			} elseif ( '300italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 300;
					font-style: italic;
				';
			} elseif ( '400italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 400;
					font-style: italic;
				';
			} elseif ( '700italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 700;
					font-style: italic;
				';
			} elseif ( '800italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 700;
					font-style: italic;
				';

			} elseif ( '900italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 900;
					font-style: italic;
				';
			} elseif ( 'regular' == $body_font['variant'] ) {
				$css[] = 'font-weight: 400;';
			} elseif ( 'italic' == $body_font['variant'] ) {
				$css[] = 'font-style: italic;';
			} else {
				$css[] = 'font-weight:' . $body_font['variant'] . ';';
			}

			// Body font size
			if ( cs_get_option( 'body-font-size' ) ) {
				$css[] = 'font-size:' . cs_get_option( 'body-font-size' ) . 'px;';
			}

			// Body color
			if ( cs_get_option( 'body-color' ) ) {
				$css[] = 'color:' . cs_get_option( 'body-color' );
			}
		$css[] = '}';
        $css[] = 'body .banner-inner ,  .sidebar_blog .widget.widget_categories ul li a , .sidebar_blog .widget.widget_tag_cloud .tagcloud a , .portfolio-single  .pp_meta_box div.tags ,.portfolio-single .nav-post .nav-box .text-nav > span ,.woocommerce div.product .content-product-right .shop-bottom form .variations tr td label ,.woocommerce-review-link ,.woocommerce div.product .content-product-right .shop-bottom .yith-btn .yith-wcwl-add-to-wishlist > div a,.team-member.member-layout-layout5 .team_container .team_inner .member-social ul li a ,
                .sidebar_blog .widget.widget_portfolio-list .portfolio-list li .cat a , .portfolio-single  .pp_meta_box div span , .portfolio-single .nav-post .nav-box .text-nav p span , .catalog-sidebar .widget_product_categories .product-categories li a, .shop-detail-sidebar .widget_product_categories .product-categories li a ,.woocommerce div.product .content-product-right .shop-bottom .info-product .social_share ul li a ,.woocommerce div.product .content-product-right .shop-bottom .info-product .product_meta > span a , 
                 .jws-blog-detail .single-blog-page .blog-details .post-meta > div.like .zilla-likes , .jws-blog-detail .blog-meta .post-tags a , .jws-blog-detail .blog-meta .social_share li a
         {';
			// Body color
			if ( cs_get_option( 'body-color' ) ) {
				$css[] = 'color:' . cs_get_option( 'body-color' );
			}
		$css[] = '}';
		$css[] = 'a , h1, h2, h3, h4, h5, h6, .f__pop  {';
			$css[] = 'font-family: "' . $heading_font['family'] . '";';
			if ( '100italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 100;
					font-style: italic;
				';
			} elseif ( '300italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 300;
					font-style: italic;
				';
			} elseif ( '400italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 400;
					font-style: italic;
				';
			} elseif ( '500italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 500;
					font-style: italic;
				';
			} elseif ( '600italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 600;
					font-style: italic;
				';
			} elseif ( '700italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 700;
					font-style: italic;
				';
			} elseif ( '900italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 900;
					font-style: italic;
				';
			} elseif ( 'regular' == $heading_font['variant'] ) {
				$css[] = 'font-weight: 400;';
			} elseif ( 'italic' == $heading_font['variant'] ) {
				$css[] = 'font-style: italic;';
			} else {
				$css[] = 'font-weight:' . $heading_font['variant'];
			}
		$css[] = '}';
		
		

		if ( cs_get_option( 'h1-font-size' ) ) {
			$css[] = 'h1 { font-size:' . cs_get_option( 'h1-font-size' ) . 'px; }';
		}
		if ( cs_get_option( 'h2-font-size' ) ) {
			$css[] = 'h2 { font-size:' . cs_get_option( 'h2-font-size' ) . 'px; }';
		}
		if ( cs_get_option( 'h3-font-size' ) ) {
			$css[] = 'h3 { font-size:' . cs_get_option( 'h3-font-size' ) . 'px; }';
		}
		if ( cs_get_option( 'h4-font-size' ) ) {
			$css[] = 'h4 { font-size:' . cs_get_option( 'h4-font-size' ) . 'px; }';
		}
		if ( cs_get_option( 'h5-font-size' ) ) {
			$css[] = 'h5 { font-size:' . cs_get_option( 'h5-font-size' ) . 'px; }';
		}
		if ( cs_get_option( 'h6-font-size' ) ) {
			$css[] = 'h6 { font-size:' . cs_get_option( 'h6-font-size' ) . 'px; }';
		}
        $color_cuttom = get_post_meta( get_the_ID(), '_custom_page_options', true );
        if( isset($color_cuttom['top_menu_color']) && !empty($color_cuttom['top_menu_color'])) {
          $top_menu = $color_cuttom['top_menu_color']; 
        }else {
           $top_menu = cs_get_option( 'top_menu_color');
        }
        
        
        if( isset($color_cuttom['top_menu_hover_color']) && !empty($color_cuttom['top_menu_hover_color'])) {
          $top_menu_hover = $color_cuttom['top_menu_hover_color']; 
        }else {
           $top_menu_hover = cs_get_option( 'top_menu_hover_color');
        }
        
        
        if( isset($color_cuttom['background_sticky_header']) && !empty($color_cuttom['background_sticky_header'])) {
          $background_stiky = $color_cuttom['background_sticky_header']; 
        }else {
           $background_stiky = cs_get_option( 'background_sticky_header');
        }
        
         if( isset($color_cuttom['sub_menu_color']) && !empty($color_cuttom['sub_menu_color'])) {
          $sub_menu = $color_cuttom['sub_menu_color']; 
        }else {
           $sub_menu = cs_get_option( 'sub_menu_color');
        }
        
        
        if( isset($color_cuttom['primary-color-cutom2']) && !empty($color_cuttom['primary-color-cutom2'])) {
          $primary_color_2 = $color_cuttom['primary-color-cutom2']; 
        }else {
            $primary_color_2 = cs_get_option( 'primary-color-2' ); 
        }
        
        
        if( isset($color_cuttom['primary-color-cutom']) && !empty($color_cuttom['primary-color-cutom'])) {
          $primary_color = $color_cuttom['primary-color-cutom']; 
        }else {
          $primary_color = cs_get_option( 'primary-color' ); 
        }
        
        
        if( isset($color_cuttom['logo_color']) && !empty($color_cuttom['logo_color'])) {
          $logo_color1 = $color_cuttom['logo_color']; 
        }else {
          $logo_color1 = "";  
        }
        
        if( isset($color_cuttom['logo_color2']) && !empty($color_cuttom['logo_color2'])) {
          $logo_color2 = $color_cuttom['logo_color2']; 
        }else {
          $logo_color2 = "";  
        }
         if ( $logo_color2 && $logo_color1 ) { 
           	$css[] = '
				.logo_text {
    				background: -webkit-linear-gradient(to left, ' . esc_attr( $logo_color1 ) . ' , ' . esc_attr($logo_color2) . ');
                	background: linear-gradient(to left, ' . esc_attr( $logo_color1 ) . ' , ' . esc_attr($logo_color2) . ');
				}
			'; 
        }else {
            $css[] = '
				.logo_text {
                background: -webkit-linear-gradient(to left, ' . esc_attr( $primary_color ) . ' , ' . esc_attr($primary_color_2) . ');
               	background: linear-gradient(to left, ' . esc_attr( $primary_color ) . ' , ' . esc_attr($primary_color_2) . ');
                	}
			';
        }
        $css[] = '
				.title_end ins {
                background: -webkit-linear-gradient(to left, ' . esc_attr( $primary_color ) . ' , ' . esc_attr($primary_color_2) . ');
               	background: linear-gradient(to left, ' . esc_attr( $primary_color ) . ' , ' . esc_attr($primary_color_2) . ');
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent; 
                letter-spacing: 0.8px;
                margin-right:10px;
               	}
                .mobile_menu .logo_text {
                background: -webkit-linear-gradient(to left, ' . esc_attr( $primary_color ) . ' , ' . esc_attr($primary_color_2) . ');
               	background: linear-gradient(to left, ' . esc_attr( $primary_color ) . ' , ' . esc_attr($primary_color_2) . ');
                	}
			';
        // Menu color
		if ( $sub_menu ) {
			$css[] = '
				#jws_header .sticky-wrapper .menu_nav .mainmenu > .nav > li.menu-item-design-mega_menu > .sub-menu-dropdown a {
					color: ' . esc_attr( $sub_menu ) . ';
				}
			';
		}
        // Menu color
		if ( $top_menu ) {
			$css[] = '
			    .add_menu , #jws_header .icon_footer li a i , #jws_header .sticky-wrapper .menu_nav .jws-action .search-form .action-search span ,  #jws_header .sticky-wrapper .menu_nav .mainmenu > .nav > li > a , #jws_header .sticky-wrapper .menu_nav .jws-action .jws-icon-cart .cart-contents > span:first-child , .button_menu {
					color: ' . esc_attr( $top_menu ) . '!important;
				}
			';
		}
            // Menu hover color
		if ( $top_menu_hover ) {
			$css[] = '
			 .button_menu:hover, #jws_header.jws-header-v2 .sticky-wrapper .menu_nav .mainmenu > .nav > li > a:hover ,  #jws_header .icon_footer li a i:hover ,  #jws_header .sticky-wrapper .menu_nav .jws-action .jws-icon-cart .cart-contents > span:first-child:hover , #jws_header .sticky-wrapper .menu_nav .jws-action .search-form .action-search span:hover ,  #jws_header .sticky-wrapper .menu_nav .mainmenu > .nav > li > a:hover  {
					color: ' . esc_attr( $top_menu_hover ) . '!important;
				}
                #jws_header .sticky-wrapper .menu_nav .mainmenu > .nav > li > a:before {
                   background: ' . esc_attr( $top_menu_hover ) . '; 
                }
			';
		}
        // Background Stiky color
		if ( $background_stiky ) {
			$css[] = '
			    #jws_header .is-sticky .mainmenu-area {
					background: '.esc_attr( $background_stiky ).' ;
                    box-shadow: 0 0 5px rgba(0,0,0,0.1);
                    -webkit-box-shadow: 0 0 5px rgba(0,0,0,0.1);
                    transition: 0.5s all;
                    -webkit-transition: 0.5s all;
				}
			';
		}
        // Primary Gradient Color
        if ( $primary_color && $primary_color_2 ) { 
           	$css[] = '
               .portfolio-filter .nav_2 li a:before , #footer-jws .wpcf7 form .submit_btn:after , .blog-footer .kloud-blog-load-more .icon , .blog-footer .kloud-blog-load-more:after ,  .pricing-tables .kloud-price-table.active .pricing_top ,  .portfolio-filter .nav_2 li a.filter-active , .teams-wrapper2 .team-member .team_inner:after , .masonry-container .item_portfolio .pp_inner .content_pp {
                  background: -webkit-linear-gradient(left, ' . esc_attr( $primary_color ) . ' , ' . esc_attr($primary_color_2) . '); 
                }
                .team-member.member-layout-layout9 .team_container .team_inner , #back-to-top , .kloud-info-box.process_icon:after , .kloud-blog-holder.default .post-item .item_inner:before, .team-member.member-layout-layout4 .team_container:after , .line-vertical , .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list .vc_tta-tab.vc_active:after , .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list .vc_tta-tab.vc_active , .kloud-info-box.left_icon.hover2:hover .has_icon:before , .instagram-pics li > a:after , .kloud-blog-holder .layout-2 .bog-image:after , .kloud-info-box.process_icon.active ,   .testimonials-wrapper.layout2 .slider_inner .testimonial-avatar .image:after , .team-member.member-layout-layout1 .team_container:after , .testimonials-wrapper #thmbnail-img .testimonial-avatar .image:after , .kloud-blog-holder.default .post-item .item_hover:after , .kloud-info-box .box-icon-wrapper .info-box-icon .has_icon:after , .promo-banner.banner-3:after {
                  background:linear-gradient(180deg, ' . esc_attr( $primary_color_2 ) . ' ,  ' . esc_attr( $primary_color ) . ');   
                }
				.logo_text {
                	-webkit-background-clip: text;
                	-webkit-text-fill-color: transparent;
                    font-family: penna;
                    font-size: 48px;
                    letter-spacing: 2.5px;
                    font-weight: bold;
				}
                .mobile_menu .logo_text {
                	-webkit-background-clip: text;
                	-webkit-text-fill-color: transparent;
                    font-family: penna;
                    font-size: 48px;
                    letter-spacing: 2.5px;
                    font-weight: bold;
				}
                .form2 .mc4wp-form button , .pricing-tables .kloud-price-table .kloud-plan-inner .kloud-plan-footer:after {
                    background-image: linear-gradient(to right,'.esc_attr( $primary_color ).' 0%,'.esc_attr( $primary_color_2 ).' 51%,'.esc_attr( $primary_color ).' 100%) !important;
                 }
			'; 
        }
		// Primary color
		if ( $primary_color ) {
			$css[] = '
	        .masonry-container.hover2 .item_portfolio.masonry2 .pp_inner .content_pp .content_pp_inner .title a ,.masonry-container.hover2 .item_portfolio.masonry .pp_inner .content_pp .content_pp_inner .title a ,  .kloud-price-table.layout1 .pricing_top  .kloud-plan-name h6 , .pricing-tables .kloud-price-table.layout1 .kloud-plan-inner .kloud-plan-price span , .team-member.member-layout-layout9 .team_container .team_inner .member-social ul li a:hover , .testimonials-wrapper.layout4 .slick-arrow ,.sidebar_blog .widget.widget_categories ul li a:hover , .catalog-sidebar .widget_product_categories .product-categories li.current-cat , .shop-detail-sidebar .widget_product_categories .product-categories li.current-cat ,.portfolio-filter .nav_3 li a:hover ,.team-member .team_container .member-image-wrapper .member-image .button a:hover ,.portfolio-single .nav-post .nav-box:hover .text-nav p ,.woocommerce div.product .content-product-right .shop-bottom .info-product .social_share ul li a:hover,
            .portfolio-filter ul.nav_3 li a.filter-active , 	.testimonials-wrapper.layout3 .slick-arrow,.masonry-container.hover2 .item_portfolio .pp_inner .content_pp .content_pp_inner .title , .catalog-sidebar .widget_product_categories .product-categories li.current-cat a , .shop-detail-sidebar .widget_product_categories .product-categories li.current-cat a ,.icon_footer li a i:hover,
            #jws_header .icon_footer li a:hover i , .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list .vc_tta-tab a i ,.jws-blog-detail .single-blog-page .blog-details .post-meta > div.like .zilla-likes.active:before ,#jws_header .sticky-wrapper .menu_nav .jws-action .jws-icon-cart .cart-contents .jws-menu-cart-count,.masonry-container .item_portfolio.grid .pp_inner .content_pp .content_pp_inner .redmore:hover a, .masonry-container .item_portfolio.masonry .pp_inner .content_pp .content_pp_inner .redmore:hover a, .masonry-container .item_portfolio.masonry2 .pp_inner .content_pp .content_pp_inner .redmore:hover a, .masonry-container .item_portfolio.metro .pp_inner .content_pp .content_pp_inner .redmore:hover a,
            .teams-wrapper2 .slick-arrow , .kloud-blog-holder .post-item.layout-2:hover .content-blog .blog-bottom div > span , .kloud-blog-holder .post-item.layout-2:hover .content-blog .like .zilla-likes ,.catalog-sidebar .widget_product_categories .product-categories li:hover a , .shop-detail-sidebar .widget_product_categories .product-categories li:hover a ,
            .kloud-blog-holder .post-item.layout-2 .content-blog .like .zilla-likes.active , .kloud-blog-holder .post-item.layout-2 .content-blog .like .zilla-likes.active:before ,.catalog-sidebar .widget_product_categories .product-categories li:hover , .shop-detail-sidebar .widget_product_categories .product-categories li:hover ,
            .kloud-blog-holder  .post-item.layout-2:hover .content-blog .blog-bottom .author , .kloud-blog-holder .post-item.layout-2:hover .content-blog .title h6 a  ,#content .action-filter-swaper .layout-shop .wc-col-switch a.active ,.team-member.member-layout-layout1 .team_inner .member-social ul li a:hover ,
            .kloud-blog-holder .post-item.layout-2:hover .content-blog .blog-innfo span ,  .testimonials-wrapper.layout2 .slider_inner footer h5 , .team-member.member-layout-default .team_inner .member-social ul li a:hover ,.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading strong,
            .kloud-info-box.top_icon .info-box-content .info-box-inner h4 ,   #jws_header .sticky-wrapper .menu_nav .mainmenu > .nav > li.menu-item-design-mega_menu > .sub-menu-dropdown a:hover ,.mc4wp-form button ,.kloud-blog-holder .content-blog .blog-bottom .share .social_share ul li a:hover ,
            .promo-banner.banner-3 .wrapper-content-baner .banner-inner h2 ,.jws-blog-detail .comments-area .comment-list li .comment-body .comment-header-info .reply a:hover,.kloud-blog-holder .link_content:hover a ,.jws-blog-detail .blog-meta .social_share li a:hover , 
            .contact_footer li i,#footer-jws .sub-menu li a:hover,#footer-jws .sub-menu-heical li a:hover ,#footer-jws .copy_right ins ,.extra-counter .text_content > span , .teams-wrapper2 .team-member .team_inner .member-details .member-social ul li a:hover , 
            .kloud-info-box.process_icon .info-box-icon .number_process , .jws-blog-detail .blog-meta .post-tags a:hover ,.jws-blog-detail .single-blog-page .blog-content blockquote:before,
       	    a:hover, a:active ,.testimonials-wrapper #thmbnail-img .slick-arrow:hover , .testimonials-wrapper .icon_inner , .custom-2 .tp-bullet.selected {
					color: ' . esc_attr( $primary_color ) . ';
				}
			
		 .team-member.member-layout-layout9 .team_container .team_inner:after , .action-popup-url.icon:hover , .kloud-pagination .item.current:after , .form_shadow .wpcf7 form .submit_btn .wpcf7-submit ,.jws-blog-detail .comments-area .comment-list li .comment-body .comment-header-info .reply a:hover,body .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading,.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading,
          .layout2 .extra-counter .text_content:after , #content .action-filter-swaper .layout-shop .wc-col-switch a.active , .hvr-bounce-to-right:hover,.team-member.member-layout-layout6 .team_container .team_inner .action_team .line:hover,.sidebar_blog .searchform:focus,.woocommerce div.product .content-product-right .shop-bottom form .variations tr td .tawcvs-swatches .swatch-label.selected ,
          .testimonials-wrapper.layout4 .slick-arrow:hover ,.testimonials-wrapper.layout3 .testimonial .slider_container .slider_inner:before , .woocommerce-pagination-number .page-numbers li .current:after,  .woocommerce-pagination-number .page-numbers li a:hover:after,.testimonials-wrapper .slick-dots li.slick-active:after,
          .testimonials-wrapper.layout3 .testimonial .slider_container .slider_inner:after , .button_footer , .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list .vc_tta-tab ,.ui-slider .ui-slider-handle:after,.teams-wrapper.layout2 #carousel ul li:after ,
          .testimonials-wrapper.layout2 .slick-dots li.slick-active:after ,  .owl-controls .owl-dots .owl-dot.active:after , .demo_con:hover , .portfolio-filter ul.nav_1 li a.filter-active ,.woocommerce div.product .content-product-right .shop-bottom .yith-btn .yith-wcwl-add-to-wishlist > div a:hover,
          .portfolio-filter ul.nav_2 li a.filter-active {
					border-color: ' . esc_attr( $primary_color ) . ';
				}
			
		  .pricing-tables .kloud-price-table.layout1 .kloud-plan-inner .kloud-plan-price .kloud-price-suffix:before , .team-member.member-layout-layout9 .team_container .member-image .ion-ios-plus-empty:hover , .action-popup-url.icon , .sidebar_blog .widget.widget_categories ul li a:after , .kloud-pagination .item.current , .hvr-rectangle-in:hover ,.jws-blog-detail .comments-area .comment-respond form .form-submit .submit,.ui-slider .ui-slider-range ,.ui-slider .ui-slider-handle,.woocommerce div.product .content-product-right .shop-bottom .single_add_to_cart_button, .woocommerce div.product .content-product-right .shop-bottom .single_add_to_cart_buttons,.hvr-bounce-to-right:before,.product-thumb .onsale,.team-member.member-layout-layout6 .team_container .team_inner .action_team .line:hover , .woocommerce div.product .content-product-right .shop-bottom .yith-btn .yith-wcwl-add-to-wishlist > div a:hover,.checkout-order-review .woocommerce-checkout-review-order .woocommerce-checkout-payment .place-order .button,
   	      .testimonials-wrapper.layout4 .slick-arrow:hover ,  #jws_header.jws-header-v2 .sticky-wrapper .menu_nav .jws-action .search-modal .modal-content form button , .custom_button .button_footer.button_ct2 , .tb-products-grid article .product-thumb .btn-inner-center a:hover ,.woocommerce .product-bottom .tab-product .woocommerce-tabs .panel .woocommerce-Reviews #respond input#submit ,.wpcf7 .form_contact .wpcf7-submit ,.team-member.member-layout-layout6 .team_container .team_inner .action_team .line:before, .team-member.member-layout-layout6 .team_container .team_inner .action_team .line:after ,.woocommerce div.product .content-product-right .shop-bottom form .variations tr td .tawcvs-swatches .swatch-label.selected ,
          .testimonials-wrapper.layout3 .testimonial .slider_container .slider_inner .slider_inner_child , .testimonials-wrapper.layout2 .slick-dots li.slick-active ,.sidebar_blog .widget.widget_tag_cloud .tagcloud a ,.woocommerce-pagination-number .page-numbers li a:hover:after,.tb-products-grid article .product-thumb .btn-inner-center a.added ,.cart-collaterals .cart_totals .wc-proceed-to-checkout a ,.coming-soon .mc4wp-form button ,.form_shadow .wpcf7 form .submit_btn:hover .wpcf7-submit ,.border.vc_custom_heading:before,.testimonials-wrapper.layout5 .slick-dots li.slick-active ,#yith-wcwl-popup-message,.search_item .link_content a,
   	      .testimonials-wrapper.layout2 .slider_inner footer h5:after ,  .owl-controls .owl-dots .owl-dot.active , .btn2 , .portfolio-footer .kloud-portfolio-load-more , .woocommerce-pagination-number .page-numbers li .current , .catalog-sidebar .widget_product_categories .product-categories li:before, .shop-detail-sidebar .widget_product_categories .product-categories li:before ,.jws-push-menu .widget_shopping_cart_content .jws-cart-panel-summary .woocommerce-mini-cart__buttons.in_product.buttons a ,.woocommerce-checkout .woocommerce-form-login .form-row .button,.woocommerce-checkout .checkout_coupon .button,
          .portfolio-filter ul.nav_1 li a.filter-active , .portfolio-filter ul.nav_2 li a.filter-active{
					background-color: ' . esc_attr( $primary_color ) . ';
				}
                
           .wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading , .wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading:hover {
					background-color: ' . esc_attr( $primary_color ) . '!important;
				} 
           .wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading , .hvr-rectangle-in:hover  , input:focus , textarea:focus {
					border-color: ' . esc_attr( $primary_color ) . '!important;
				}  
           #jws_header .sticky-wrapper .menu_nav .mainmenu>.nav>li>a.active , #jws_header .sticky-wrapper .menu_nav .mainmenu>.nav>li.menu-item-design-mega_menu .sub-menu-dropdown .sub-menu a.active , .icon_footer li a i:hover , .kloud-blog-holder.blog-menu .post-item .content-blog .content-inner .title h6 a:hover  {
					color: ' . esc_attr( $primary_color ) . '!important;
				} 
           .searchform:hover {
					border: 1px solid ' . esc_attr( $primary_color ) . ';
				}                         
                
                
			';
                

		}

      
		// Header color
		if ( cs_get_option( 'header-background' ) ) {
			$css[] = '.mainmenu-area { background-color: ' . esc_attr( cs_get_option( 'header-background' ) ) . '}';
		}
        // Header color
		if ( cs_get_option( 'body-background-color' ) ) {
			$css[] = 'body .main-content { background-color: ' . esc_attr( cs_get_option( 'body-background-color' ) ) . '}';
		}
		// Custom css
		if ( cs_get_option( 'custom-css' ) ) {
			$css[] = cs_get_option( 'custom-css' );
		}

		return preg_replace( '/\n|\t/i', '', implode( '', $css ) );
        }

	}
}