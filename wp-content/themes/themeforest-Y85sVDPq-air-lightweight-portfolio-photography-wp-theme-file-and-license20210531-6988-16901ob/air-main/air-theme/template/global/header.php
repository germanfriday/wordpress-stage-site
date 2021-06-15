<?php
$header_layout = airtheme_get_option('theme_option_header_layout') ? airtheme_get_option('theme_option_header_layout') : 'left_logo__right_menu_icon';
$show_icon_bg_color = airtheme_get_option('theme_option_show_icon_background_color');
$navi_trigger_bg_wrap = $header_layout == 'left_logo__right_menu_icon' && $show_icon_bg_color ? '<span class="navi-trigger-bg"></span>' : false;
$menu_panle_type = airtheme_get_option('theme_option_menu_panle_type') ? airtheme_get_option('theme_option_menu_panle_type') : 'open_menu_panel_below';
$menu_text = airtheme_get_option('theme_option_descriptions_menu') ? airtheme_get_option('theme_option_descriptions_menu') : esc_html__('MENU','air-theme');
$menu_close_text = airtheme_get_option('theme_option_descriptions_menu_close') ? airtheme_get_option('theme_option_descriptions_menu_close') : esc_html__('CLOSE','air-theme');
$header_width = airtheme_get_option('theme_option_header_width') ? airtheme_get_option('theme_option_header_width') : false;
$header_width_class =  $header_width == 'fixed' ? 'container' : 'container-fluid';
$expanded_show_cart = airtheme_get_option('theme_option_show_shopping_cart');
$show_social_link   = airtheme_get_option('theme_option_show_social');
$center_class  = $show_social_link ? ' center-ux' : false;


$start_from_page_top = false;
if(is_page()){
	$start_from_page_top = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_start_from_page_top');
	if($start_from_page_top){
		$start_from_page_top = 'start-from-top';
	}
}

?>

<header id="header" class="<?php echo sanitize_html_class($start_from_page_top); ?>">

    <div id="header-main">
    
        <div class="<?php echo sanitize_html_class($header_width_class); ?>">

            <?php
            if($expanded_show_cart && class_exists('Woocommerce')){
                do_action('airtheme_interface_wc_cart'); 
            } 
            ?>
            <span id="navi-trigger">
                <span class="navi-trigger-text">
                    <span class="navi-trigger-text-menu navi-trigger-text-inn"><?php echo esc_html($menu_text); ?></span>
                    <span class="navi-trigger-text-close navi-trigger-text-inn"><?php echo esc_html($menu_close_text); ?></span>
                </span>
                <span class="navi-trigger-inn">
                    <span class="navi-trigger-hamberg-line navi-trigger-hamberg-line1"></span>
                    <span class="navi-trigger-hamberg-line navi-trigger-hamberg-line2"></span>
                    <span class="navi-trigger-hamberg-line navi-trigger-hamberg-line3"></span>
                </span>
            </span>

            <?php

			//header meta
			if($header_layout == 'navi-show'){
                $show_search_header = airtheme_get_option('theme_option_show_search_on_header');
			?>
            
            <div class="heade-meta">

                <nav id="navi-header" class="<?php echo esc_attr($center_class); ?>">

                    <?php wp_nav_menu(array(
                        'theme_location'  => 'primary',
                        'container_id' => 'navi_wrap',
                        'items_wrap' => '<ul class="%2$s clearfix">%3$s</ul>'
                    )); ?><!--End #navi_wrap-->

                </nav>

                <?php if($show_search_header) { ?>
                <div class="search-button-header">
                    <span class="fa fa-search" id="search-button-header-fa"></span>
                </div>
                <?php } ?>
                
                <div class="header-bar-social">
                    <?php //** Function Social
                    if($show_social_link) {
                        airtheme_interface_header_social(); 
                    }
                    ?>
                </div>
               

            </div>
                
            <?php } // end header meta ?>
            
            <div class="navi-logo">

                <div class="logo-wrap">
                    <?php //** Function Logo for header
                    airtheme_interface_logo('header'); ?>
                </div><!--End logo wrap-->
                 
            </div>
        
        </div>
        
    </div><!--End header main-->
    
</header>