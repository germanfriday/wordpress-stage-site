<?php 
/**
 * Layout Name: Header kloud One
 * Preview Image: /assets/images/headers/header-kloud-v2.jpg
 */


$option = get_post_meta( get_the_ID(), '_custom_page_options', true );
    if(!isset($option['show_cart'])) {
        $cart = cs_get_option( 'show_cart' );  
    }else {
        $cart = $option['show_cart'];  
    }
    if(!isset($option['show_search'])) {
        $search = cs_get_option( 'show_search' );  
    }else {
        $search = $option['show_search'];  
    }
    if(!isset($option['show_shortcode'])) {
        $shortcode = cs_get_option( 'show_shortcode' );  
    }else {
        $shortcode = $option['show_shortcode'];  
    }
    $shortcode_content =  cs_get_option( 'header-menu-right' );  
    
?>
<!-- Start Header -->
<header>
	<div id="jws_header" class="jws-header-v2"><!-- bt-header-stick/bt-header-fixed -->
		<!-- Start Header Menu -->
        <div id="mainmenu-area-sticky-wrapper" class="sticky-wrapper">
		<div class="mainmenu-area">
            <nav class="menu_nav hidden-sm hidden-xs">
                            <div class="logo-center text-center ">
                            <?php jws_kloud_logo(); ?>
                            </div>
                        <div class="mainmenu">
						<?php
						$attr = array(
                            'theme_location' => 'main_navigation',
							'menu_id' => 'nav',
							'menu' => '',
                            'container' => '',
							'container_class' => 'bt-menu-list hidden-xs hidden-sm ',
							'menu_class'      => ' nav',
							'echo'            => true,
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 0,
                            
						);
                        wp_nav_menu( $attr );
                        ?>
                        </div>
                            <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                            <div class="right-header jws-action ">
                            <?php if($search == '1') : 
                                echo jws_search_fix();
                             endif; ?>
                            <?php if($shortcode == '1') : ?>
                            <div class="menu_shortcode">
                                <?php
                                   echo do_shortcode( ''.$shortcode_content.'' );
                                 ?>
                            </div>
                            <?php endif; ?>
                            <?php 
                            if($cart == '1') {
                                echo jws_kloud_shopping_cart();
                            }
                           ?>
                            </div>
                        <?php } ?>  
                          
          </nav>  
                        <div class="button_menu hidden-lg hidden-md">
                            <span class="ion-android-menu"></span>
                        </div> 
		</div>
       </div> 
		<!-- End Header Menu -->
	</div>
    <?php if ( class_exists( 'WooCommerce' ) && !is_cart() ) : ?>	
		<div class="jws-mini-cart jws-push-menu">
			<div class="jws-mini-cart-content">
				<h3 class="title"><?php esc_html_e( 'YOUR CART', 'kloud' );?> <i class="close-cart pe-7s-close pa"></i></h3>
				<div class="widget_shopping_cart_content">
                    <?php woocommerce_mini_cart(); ?>
                </div>
			</div>
		</div><!-- .jws-mini-cart -->
	<?php endif ?>
</header>
<!-- End Header -->
