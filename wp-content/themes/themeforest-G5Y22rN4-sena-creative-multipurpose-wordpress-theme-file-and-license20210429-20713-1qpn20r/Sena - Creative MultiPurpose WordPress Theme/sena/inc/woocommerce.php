<?php
// Extend WooCommerce
if ( class_exists( 'WooCommerce' ) ) {
    add_filter( 'loop_shop_per_page', 'sena_loop_shop_per_page', 20 );
    add_filter( 'woocommerce_sale_flash', 'sena_modify_saleflash_by_discount', 20 );
    
    if ( !function_exists( 'sena_loop_shop_per_page' ) ) {
        function sena_loop_shop_per_page( $cols ) {
            global $sena_config;
            return $sena_config['shop-products'];
        }
    }
    
    if ( !function_exists( 'sena_modify_saleflash_by_discount' ) ) {
        function sena_modify_saleflash_by_discount( $content ) {
            global $post, $product;

            $discount = '';
            $regular_price = get_post_meta( get_the_ID(), '_regular_price', true );
            $sale_price  = get_post_meta( get_the_ID(), '_sale_price', true );

            if ( $regular_price && $sale_price ) {
                $price = $sale_price * 100 / $regular_price;
                $discount = round(100 - $price);
                $discount = esc_html__( '-', 'sena' ) . $discount . esc_html__( '%', 'sena' );
            }

            if ( $product->is_on_sale() && $product->get_type() == 'simple' ) {
                $content =  '<span class="onsale">' . esc_html($discount) . '</span>';
            }

            return $content;
        }
    }

    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
    remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

    add_action( 'woocommerce_shop_loop_item_thumb_open', 'woocommerce_template_loop_product_thumb', 10 );
    add_action( 'woocommerce_shop_loop_item_thumb_close', 'woocommerce_template_loop_product_thumb_close', 5 );
    add_action( 'woocommerce_before_single_product', 'woocommerce_breadcrumb', 20 );

    add_action( 'woocommerce_shop_loop_item_thumb_cart', 'woocommerce_template_loop_add_to_cart', 10 );
    add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
    add_action( 'woocommerce_shop_loop_item_title_close', 'woocommerce_template_loop_product_title_close', 10 );

    if ( !function_exists( 'woocommerce_template_loop_product_thumb' ) ) {
        function woocommerce_template_loop_product_thumb() {
            global $product;
            
            $alt_thumb = $product->get_gallery_image_ids();
            ?>
            <div class="product-thumb">
                <a href="<?php echo esc_url( get_the_permalink() ); ?>">
                    <?php echo wc_get_template( 'loop/sale-flash.php' ) . woocommerce_get_product_thumbnail( 'shop_single' ); ?>

                    <?php if ( !empty( $alt_thumb ) ) { ?>
                        <figure class="image-switcher">
                            <?php echo wp_get_attachment_image( $alt_thumb[ 0 ], 'shop_single' ); ?>
                        </figure>
                    <?php } ?>          
                </a>
            <?php
        }
    }

    if ( !function_exists( 'woocommerce_template_loop_product_thumb_close' ) ) {
        function woocommerce_template_loop_product_thumb_close() {
            echo '</div>';
        }
    }

    if ( !function_exists( 'woocommerce_template_loop_product_title' ) ) {
        function woocommerce_template_loop_product_title() {
            global $product;
            
            $rating_count = $product->get_rating_count();
            $review_count = $product->get_review_count();
            $average = $product->get_average_rating();
            ?>  
            <div class="product-info">
                <h3>
                    <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo wp_kses_post( get_the_title() ); ?></a>
                </h3>

                <?php if ( $price_html = $product->get_price_html() ) { ?>
                <span class="product-price"><?php echo wp_kses_post( $price_html ); ?></span>
                <?php } ?>

                <?php if ( $rating_count > 0 ) { ?>
                <div class="product-rating" itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
                    <span class="product-stars">
                        <span class="product-rating-stars" style="width:<?php echo esc_html( ( $average / 5 ) * 100 ); ?>%"></span>
                    </span>
                </div>
                <?php } ?>
            
                <div class="add-to-cart-btn">
        <?php
        }
    }

    if ( !function_exists( 'woocommerce_template_loop_product_title_close' ) ) {
        function woocommerce_template_loop_product_title_close() {
            echo '  </div>
                  </div>';
        }
    }
    
    // Check if it's WooCommerce page
    if ( !function_exists( 'sena_is_woocommerce_page' ) ) {
        function sena_is_woocommerce_page() {
            if ( function_exists ( "is_woocommerce" ) && is_woocommerce() ) {
                return true;
            }
          
            $woocommerce_keys = array(
                "woocommerce_shop_page_id" ,
                "woocommerce_terms_page_id" ,
                "woocommerce_cart_page_id" ,
                "woocommerce_checkout_page_id" ,
                "woocommerce_pay_page_id" ,
                "woocommerce_thanks_page_id" ,
                "woocommerce_myaccount_page_id" ,
                "woocommerce_edit_address_page_id" ,
                "woocommerce_view_order_page_id" ,
                "woocommerce_change_password_page_id" ,
                "woocommerce_logout_page_id" ,
                "woocommerce_lost_password_page_id"
            );
            
            foreach ( $woocommerce_keys as $wc_page_id ) {
                if ( get_the_ID () == get_option ( $wc_page_id, 0 ) ) {
                    return true;
                }
            }
            
        return false;
      }
    }
    
    // WooCommerce Ajax cart
    add_filter( 'woocommerce_add_to_cart_fragments', 'sena_header_add_to_cart_fragment' );
    
    function sena_header_add_to_cart_fragment( $fragments ) {
        ob_start();
    ?>
        <div class="cart-open">            
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="navbar-shopping-bag">
                <i class="fas fa-shopping-bag"></i>                
            </a>

            <span class="cart-number"><?php echo WC()->cart->get_cart_contents_count(); ?></span>

            <div class="shopping-cart">
                <?php woocommerce_mini_cart(); ?>
            </div>            
        </div>
    <?php
        $fragments['.navbar .cart-open'] = ob_get_clean();

        return $fragments;
    }

}