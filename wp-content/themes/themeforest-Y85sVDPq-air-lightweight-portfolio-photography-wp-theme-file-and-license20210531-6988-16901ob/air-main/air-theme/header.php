<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <?php if ( has_post_thumbnail() ) { ?><meta property="og:image" content="<?php the_post_thumbnail_url( 'full'); ?>" /><?php } ?>
    <link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    
    <?php //** Do Hook Web Head
	/**
	 * @hooked  airtheme_interface_webhead_viewport - 10
	 * @hooked  airtheme_interface_webhead_favicon - 15
	 */
	do_action('airtheme_interface_webhead'); ?>
    
    <?php wp_head(); ?>
  </head>
  
  <body <?php airtheme_interface_body_class(); ?>>
  	
    <div class="wrap-all">
      <?php //** Do Hook Wrap before
	  /**
	   * @hooked  airtheme_interface_page_loading - 15
	   * @hooked  airtheme_interface_jplayer - 20
	   * @hooked  airtheme_interface_wrap_outer_before - 25
	   */
	  do_action('airtheme_interface_wrap_before'); ?>
      
      <?php //** Do Hook header
	  /**
	   * @hooked  airtheme_interface_header - 10
	   */
	  do_action('airtheme_interface_header'); 
	  //** Do Hook menu_hidden_panel
	  /**
	   * @hooked  airtheme_interface_menu_hidden_panel - 10
	   */
	  do_action('airtheme_interface_menu_hidden_panel'); ?>
		
	  <?php //** Do Hook Content before
      /**
       * @hooked  airtheme_interface_content_before - 5
	   * @hooked  airtheme_interface_single_feature_image - 10
	   * @hooked  airtheme_interface_archive_titlewrap - 25
       */
      do_action('airtheme_interface_content_before'); ?>