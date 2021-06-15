<?php
/****************************************************************/
/*
/* Functions
/*
/****************************************************************/

//Function Woocommerce archive description
function airtheme_woocommerce_archive_description(){
	$description = false;
	
	if(is_tax(array('product_cat', 'product_tag')) && get_query_var('paged') == 0){
		$description = apply_filters('the_content', term_description());
	}elseif(is_post_type_archive('product') && get_query_var('paged') == 0){
		$shop_page = get_post(wc_get_page_id('shop'));
		if($shop_page){
			$description = apply_filters('the_content', $shop_page->post_content);
		}
	}
	
	if ( $description ) {
		echo '<div class="post-expert">' . wp_kses_post( $description ) . '</div>';
	}
}

//Function Woocommerce Subcategory Thumbnail
function airtheme_woocommerce_subcategory_thumbnail($category){
	global $woocommerce;
	
	$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );

	if ( $thumbnail_id ) {
		$image = wp_get_attachment_image_src( $thumbnail_id, 'airtheme-image-thumb-1' );
		$image = $image[0];
	} else {
		$image = wc_placeholder_img_src();
	}

	if ( $image ) {
		echo '<div class="product-img-wrap">';
		echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" class="product-img-front" />';
		echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" class="product-img-back" />';
		echo '</div>';
	}
}

//Function Woocommerce Template Loop Product Thumbnail
function airtheme_woocommerce_template_loop_product_thumbnail(){
	echo woocommerce_get_product_thumbnail();
}

//Function Woocommerce Default Product Tabs
function airtheme_woocommerce_default_product_tabs($tabs){
	if(comments_open()){
		$tabs['leave-reviews'] = array(
			'title'    => esc_attr__('Leave a Review', 'air-theme'),
			'priority' => 40,
			'callback' => 'airtheme_woocommerce_product_leave_reviews'
		);
	}
	return $tabs;
}

//Function Woocommerce Leave Reviews
function airtheme_woocommerce_product_leave_reviews(){
	global $post, $current_user, $woocommerce;
	
	if(!comments_open())
		return;
	
	if(get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), get_the_ID())){ ?>

		<div id="respondwrap">
            <?php 
                $commenter = wp_get_current_commenter();
                $req = get_option('require_name_email');
                $review_text = '';
                $aria_req = ( $req ? " aria-required='true'" : '' );
                $name_text = esc_attr__('Name','air-theme');
				$email_text = esc_attr__('Email','air-theme');
				$review_text = airtheme_get_option('theme_option_descriptions_your_message');
				$review_text = $review_text ? $review_text : esc_attr__('Leave your comment here','air-theme');
				$review_submit = airtheme_get_option('theme_option_descriptions_comment_submit');
				$review_submit = $review_submit ? $review_submit : esc_attr__( 'Submit','air-theme' );

                if(esc_attr( $commenter['comment_author'] )){
                $fields =  array(
                    'author' => '<p class="respond-half respond-name"><input id="author" name="author" type="text" class="requiredFieldcomm" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' tabindex="1" onfocus="if(this.value==\''.esc_attr($name_text).'\'){this.value=\'\';}" onblur="if(this.value==\'\'){this.value=\''.esc_attr($name_text).'\';}"/></p>',
                    'email' => '<p class="respond-half respond-mail"><input id="email" name="email" type="text" class="email requiredFieldcomm" value="' . is_email(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' tabindex="2" onfocus="if(this.value==\''.is_email($email_text).'\'){this.value=\'\';}" onblur="if(this.value==\'\'){this.value=\''.is_email($email_text).'\';}"/></p>'
                );
                }else{
                $fields =  array(
                    'author' => '<p class="respond-half respond-name"><input id="author" name="author" type="text" class="requiredFieldcomm" value="'.esc_attr($name_text).'" size="30"' . $aria_req . ' tabindex="1" onfocus="if(this.value==\''.esc_attr($name_text).'\'){this.value=\'\';}" onblur="if(this.value==\'\'){this.value=\''.esc_attr($name_text).'\';}"/></p>',
                    'email' => '<p class="respond-half respond-mail"><input id="email" name="email" type="text" class="email requiredFieldcomm" value="'.is_email($email_text).'" size="30"' . $aria_req . ' tabindex="2" onfocus="if(this.value==\''.is_email($email_text).'\'){this.value=\'\';}" onblur="if(this.value==\'\'){this.value=\''.is_email($email_text).'\';}"/></p>'
                );
                }
                $comments_args = array(
                    'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
                    'title_reply'          => '<span class="comm-reply-title">'.esc_attr__( 'LEAVE A REPLY', 'air-theme' ).'</span>',
                    'title_reply_to'       => esc_attr__( 'Leave a Reply to %s', 'air-theme' ),
                    'cancel_reply_link'    => esc_attr__( 'Cancel reply', 'air-theme' ),
                    'label_submit'         => esc_html( $review_submit ),
                    'comment_field'		   => '<p class="respond-full respond-comment"><textarea id="comment" name="comment" class="requiredFieldcomm" cols="100%" tabindex="4" aria-required="true" onfocus="if(this.value==this.defaultValue){this.value=\'\';}" onblur="if(this.value==\'\'){this.value=this.defaultValue;}" >'.esc_textarea($review_text).'</textarea></p>' . wp_nonce_field('comment_rating', true, false),
                    'comment_notes_after'  => '<p class="comment-form-rating clearfix"><label for="rating">Rating</label><select name="rating" id="rating" style="display:none;"><option value="">Rate&hellip;</option><option value="5">Perfect</option><option value="4">Good</option><option value="3">Average</option><option value="2">Not that bad</option><option value="1">Very Poor</option></select></p>',
                    'comment_notes_before' => ''
                );
				if ( ! wc_review_ratings_enabled() ) {
					$comments_args['comment_notes_after'] = '';
				}
            ?>
            <?php comment_form($comments_args); ?>
        </div>
	<?php }else{ ?>

		<p class="woocommerce-verification-required"><?php esc_html_e('Only logged in customers who have purchased this product may leave a review.', 'air-theme'); ?></p>

	<?php
	}
}

/****************************************************************/
/*
/* Template
/*
/****************************************************************/

//Template Woocommerce Page Title
function airtheme_woocommerce_page_title(){
	airtheme_get_woo_template_part('title', 'bar');
}

//Template Woocommerce Page Title
function airtheme_woocommerce_sidebar_cart(){
	airtheme_get_woo_template_part('sidebar', 'cart');
}
/****************************************************************/
/*
/* Ajax
/*
/****************************************************************/

//Ajax loop add to cart button
function blocker_woocommerce_loop_add_to_cart($product_id, $quantity){
	if(function_exists('WC')){
		
		//WC()->cart->add_to_cart
		
		if ( empty( $product_id ) || ! is_numeric( $product_id ) ) {
			return;
		}

		$product_id          = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $product_id ) );
		$was_added_to_cart   = false;
		$adding_to_cart      = wc_get_product( $product_id );

		if ( ! $adding_to_cart ) {
			return;
		}

		$add_to_cart_handler = apply_filters( 'woocommerce_add_to_cart_handler', $adding_to_cart->get_type(), $adding_to_cart );

		// Variable product handling
		if ( 'variable' === $add_to_cart_handler ) {
			

		// Grouped Products
		} elseif ( 'grouped' === $add_to_cart_handler ) {
			

		// Custom Handler
		} elseif ( has_action( 'woocommerce_add_to_cart_handler_' . $add_to_cart_handler ) ){

		// Simple Products
		} else {
			$passed_validation 	= apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

			if ( WC()->cart->add_to_cart( $product_id, $quantity ) !== false ) {
				$was_added_to_cart = true;
			}
		}

		// If we added the product to the cart we can now optionally do a redirect.
		if ( $was_added_to_cart && wc_notice_count( 'error' ) === 0 ) {
			
			echo 'ok';
			
		}
	}
}

/****************************************************************/
/*
/* Show Sold Out on archive
/*
/****************************************************************/

add_action( 'woocommerce_before_shop_loop_item_title', 'airtheme_display_sold_out_loop_woocommerce' );
 
function airtheme_display_sold_out_loop_woocommerce() {
    global $product;
 	$sold_out_text = airtheme_get_option('theme_option_descriptions_woo_sold_out') ? airtheme_get_option('theme_option_descriptions_woo_sold_out') : esc_html__( 'Sold Out', 'air-theme' );

    if ( !$product->is_in_stock() ) {
        echo '<span class="sold-out"><span class="sold-out-inn">' . esc_html($sold_out_text) . '</span></span>';
    }
}
/****************************************************************/
/*
/* Ajax Cart number & Mina cart items
/*
/****************************************************************/

add_filter( 'woocommerce_add_to_cart_fragments', 'airtheme_wc_mini_cart_ajax_refresh' );

function airtheme_wc_mini_cart_ajax_refresh( $fragments ){
    $fragments['.woocomerce-cart-number'] = '<span class="woocomerce-cart-number">'.sizeof(WC()->cart->get_cart()).'</span>'; 
    return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'airtheme_wc_mini_cart_ajax_refresh_items' );

function airtheme_wc_mini_cart_ajax_refresh_items( $fragments ) {
	ob_start();
	?>
	<div id="woo-mini-cart" class="woo-mini-cart">
    	<span class="mini-car-arrow"></span>
        <?php woocommerce_mini_cart(); ?>
    </div>

    <?php $fragments['div.woo-mini-cart'] = ob_get_clean();

    return $fragments;
 
}

/****************************************************************/
/*
/* Show Cart icon on added_to_caer for archive
/*
/****************************************************************/

add_action('wp_footer','airtheme_jquery_add_to_cart_script');

function airtheme_jquery_add_to_cart_script(){
    if ( is_shop() || is_product_category() || is_product_tag() || is_product() || is_cart() ) {
?>
        <script type="text/javascript">
           (function(jQuery){
            	var sea_cart = jQuery('#woocomerce-cart-side');
                jQuery( document.body ).on( 'added_to_cart', function(){
                	if(sea_cart.hasClass('ux-woo-icon-hide')){
                		sea_cart.removeClass('ux-woo-icon-hide');
                	 }
                });
                jQuery( document.body ).on( 'removed_from_cart', function(){ 
                	if(!sea_cart.hasClass('ux-woo-icon-hide')){
                		if( Number( jQuery('.woocomerce-cart-number').html() ) <= 1 ){
                	 		sea_cart.addClass('ux-woo-icon-hide');
                	 	}
                	}
                });
            })(jQuery); 
        </script>
        <?php
	}
}

/****************************************************************/
/*
/* Single Product Image&Slider
/*
/****************************************************************/

add_action( 'after_setup_theme', 'airtheme_woo_product_slider' );

if ( ! function_exists ( 'airtheme_woo_product_slider' ) ) {
	function airtheme_woo_product_slider() {
		$airtheme_enable_zoom = airtheme_get_option( 'theme_option_woo_product_slider_zoom' );
		$airtheme_enable_lightbox = airtheme_get_option( 'theme_option_woo_product_slider_lightbox' );
		if ( $airtheme_enable_zoom ) {
			add_theme_support( 'wc-product-gallery-zoom' );
		}
		if ( $airtheme_enable_lightbox ) {
			add_theme_support( 'wc-product-gallery-lightbox' );
		}
		add_theme_support( 'wc-product-gallery-slider' );
	}
}

if ( ! function_exists ( 'airtheme_woo_product_slider_options' ) ) {
	function airtheme_woo_product_slider_options( $options ) {
		$options['slideshow'] = 'true';
		$options['animationLoop'] = 'true';
		$options['slideshowSpeed'] = '5000';
		return $options;
	}
}

add_filter( 'woocommerce_single_product_carousel_options', 'airtheme_woo_product_slider_options', 10 );
?>