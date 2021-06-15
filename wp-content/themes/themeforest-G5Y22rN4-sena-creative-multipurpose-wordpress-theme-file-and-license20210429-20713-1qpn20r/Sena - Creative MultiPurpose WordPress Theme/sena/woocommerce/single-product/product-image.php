<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $post, $product;
?>
<div class="col-md-6">
	<div class="row">
		<?php
			if ( has_post_thumbnail() ) {
				$attachment_count = count( $product->get_gallery_image_ids() );

				if ( $attachment_count > 0 ) {
					$gallery = '[product-gallery]';
				} else {
					$gallery = '';
				}

				$slides = array_merge(
                    array( get_post_thumbnail_id( $post->ID ) ),
                    $product->get_gallery_image_ids()
                );
		?>
            <div class="col-md-10 pull-right">
                <div id="product-slider">
                    <?php 
                        foreach ( $slides as $slide ) {
                            $image_title 	= get_post_field( 'post_title', $slide );
                            $image_link  	= wp_get_attachment_url( $slide );

                            $image = wp_get_attachment_image( $slide, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
                                'title' => $image_title, 'data-caption' => get_post_field( 'post_excerpt', $slide ),
                                'alt'	=> $image_title
                            ));

                            echo apply_filters(
                                'woocommerce_single_product_image_html',
                                sprintf(
                                    '<div class="product-zoom" data-image-zoom="%s">%s</div>',
                                    wp_get_attachment_url($slide), $image
                                ),
                                $post->ID 
                            );
                        } 
                    ?>
                </div>
            </div>

            <div class="col-md-2 res-margin">
                <div id="product-slider-nav">
                    <?php 
                        foreach ( $slides as $slide ) {
                            $image = wp_get_attachment_image( $slide );
                            echo '<figure>' . $image . '</figure>';
                        } 
                    ?>
                </div>
            </div>
        <?php 
            } else {
                echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'sena' ) ), $post->ID );
            }
        ?>
	</div>
</div>
