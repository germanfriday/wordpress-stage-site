<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! comments_open() ) {
	return;
}

global $woocommerce, $product;
if(comments_open()){
	$get_comments = get_comments(array(
		'post_id' => get_the_ID(),
		'status' => 'approve'
	)); ?>
	<div id="comments">
		<div id="comments_box">
			<span id="comments_inlist"></span>
			<?php if ( have_comments() ) : ?>
				<ol class="commentlist commentlist-only">
					<?php foreach($get_comments as $comment){
						$rating = esc_attr(get_comment_meta($comment->comment_ID, 'rating', true)); ?>
						<li id="comment-<?php echo esc_attr($comment->comment_ID); ?>" class="commlist-unit">
							<div class="comm-u-wrap">
								<div class="comment">
									<p><?php echo esc_attr($comment->comment_content); ?></p>
								</div><!--END comment-->
								<div class="comment-meta">
									<span class="comment-author"><a href="<?php esc_url( comment_author_url( $comment->comment_ID ) ); ?>"><?php esc_html( comment_author( $comment->comment_ID ) ); ?></a></span>
									<span class="date"><?php echo esc_html( human_time_diff( get_comment_date( 'U', $comment->comment_ID ), current_time( 'timestamp' ) ) );  esc_html_e(" ago",'air-theme'); ?></span>
									<?php if ( wc_review_ratings_enabled() ) { ?>
									<span class="rating_container">
									<div class="star-rating" title="<?php echo sprintf( esc_html__( 'Rated %d out of 5', 'air-theme' ), $rating ) ?>"><span style="width:<?php echo ( intval ( esc_attr( get_comment_meta( $comment->comment_ID, 'rating', true ) ) ) / 5 ) * 100; ?>%"><strong itemprop="ratingValue" class="rating"><?php echo intval( esc_attr( get_comment_meta( $comment->comment_ID, 'rating', true ) ) ); ?></strong> <?php esc_html_e( 'out of 5', 'air-theme' ); ?></span></div>
									</span>
									<?php } ?>
								</div><!--END comment-mate--> 
								<span class="reply"></span>		
							</div><!--END comm-u-wrap-->
	  
						</li><!-- #comment-## -->
					<?php } ?>
				</ol>
			<?php else : ?>
				<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'air-theme' ); ?></p>
			<?php endif; ?>
		</div><!-- #comments_box-->	
	</div>
<?php
}