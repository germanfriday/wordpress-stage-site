<?php

/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php global $rs_option; ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
 <!--Preloader start here-->
   <?php require get_parent_theme_file_path( 'inc/header/preloader.php' ); ?>
 <!--Preloader area end here-->
 <?php
  if ( ! function_exists( 'wp_body_open' ) ) {
        function wp_body_open() {
                do_action( 'wp_body_open' );
        }
}
    if(is_page()):
       $page_bg = get_post_meta( $post->ID, 'page_bg', true ); 
       $page_bg_back = ( $page_bg == 'Dark' ) ? 'dark' : '';
       else:
       $page_bg_back = '';
    endif;
    ?>
  <div id="page" class="site <?php echo esc_attr($page_bg_back);?>">
    
  <?php require get_parent_theme_file_path( 'inc/header/top-head.php' ); ?> 

  <header id="rs-header" class="<?php echo esc_attr( $header_style ); ?>">  
    <!-- Header Menu Start -->
    <div class="menu-area <?php echo esc_attr( $sticky_menu ); ?>">
     
        <div class="container">
            <!-- logo include here -->
            <?php require get_parent_theme_file_path( 'inc/header/logo.php' ); ?>
            <!-- end logo here -->
            
            <!-- Menu include Start here -->
            <?php require get_parent_theme_file_path( 'inc/header/menu.php' ); ?>   
            <!-- Menu include End here -->
            
            <!-- Off canvas include Start here -->
            <?php require get_parent_theme_file_path( 'inc/header/off-canvas.php' ); ?> 
            <!-- Off canvas include End here -->
        </div>   
    </div>
    <!-- Header Menu End --> 
  </header>
  <!-- End Header Menu End -->
  <div class="main-contain">
