<?php
$header_width = airtheme_get_option('theme_option_header_width') ? airtheme_get_option('theme_option_header_width') : false;
$header_width_class =  $header_width == 'fixed' ? 'container' : 'container-fluid';
?>

<div id="menu-panel">

    <div class="menu-panel-inn fullscreen-wrap">
     
        <nav id="navi">
            <?php wp_nav_menu(array(
				'theme_location'  => 'primary',
				'container_id' => 'navi-wrap',
				'items_wrap' => '<ul class="menu clearfix">%3$s</ul>'
			)); ?><!--End #navi_wrap-->
        </nav>
        <div id="menu-panel-bottom" class="<?php echo sanitize_html_class( $header_width_class ); ?>"> 
            <div class="menu-panel-bottom-left col-md-3 col-sm-3 col-xs-3">
                <?php     
                $expanded_show_search = airtheme_get_option('theme_option_show_search_on_expanded_menu_panel');
                $search_text = airtheme_get_option('theme_option_descriptions_search') ? airtheme_get_option('theme_option_descriptions_search') : esc_attr__('Type and Hit Enter','air-theme');
                if($expanded_show_search){ ?>
                <div class="search-top-btn-class">
                    <span class="fa fa-search"></span>
                    <form class="search_top_form"  method="get" action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="search" id="s" name="s" class="search_top_form_text" placeholder="<?php echo esc_attr($search_text); ?>">
                    </form>
                </div> 
                <?php
                }
				
				$expanded_show_wpml = airtheme_get_option('theme_option_show_wpml_on_expanded_menu_panel');
				if($expanded_show_wpml){
					airtheme_interface_language_flags(); 
				} ?>
            </div>
            <div class="menu-panel-bottom-right col-md-9 col-sm-9 col-xs-9">
                <?php
                $expanded_show_social = airtheme_get_option('theme_option_show_social');
                if($expanded_show_social){ ?>
                <section class="socialmeida-mobile">
        
                    <?php //** Function Social
                    airtheme_interface_header_social(); ?>
        
                </section>
                <?php
                } ?>
            </div>
        </div>
    </div>	
</div>