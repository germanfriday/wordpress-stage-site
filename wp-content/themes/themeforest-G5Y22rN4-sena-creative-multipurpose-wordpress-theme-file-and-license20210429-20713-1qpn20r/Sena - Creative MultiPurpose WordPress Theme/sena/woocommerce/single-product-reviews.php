<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews" class="woocommerce-reviews">
	<div id="comments" class="comments">
        
        <!-- Title -->
        <div class="row">
            <div class="col-md-12">
                <header>
                    <h3>
                        <?php
                            if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) ) {
                                /* translators: 1: reviews count 2: product name */
                                printf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'sena' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
                            } else {
                                esc_html_e( 'Reviews', 'sena' );
                            }
                        ?>
                    </h3>
                </header>
            </div>
        </div>

        <!-- Reviews -->
		<?php if ( have_comments() ) : ?>
            <ol class="product-reviews">
                <?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
            </ol>
        
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
                    paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
                        'prev_text' => '&larr;',
                        'next_text' => '&rarr;',
                        'type'      => 'list',
                    ) ) );
				echo '</nav>';
			endif; ?>
		<?php else : ?>
			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'sena' ); ?></p>
		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
        <div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter( );
                    $required = ( get_option( 'require_name_email' ) ? " aria-required='true'" : '' );

					$comment_form = array(
                        'fields' => array(
                            'author' => '
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="field">
                                            <input type="text" id="author" name="author" class="w_focus_mark" placeholder="' . esc_attr__( 'Name', 'sena' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $required . '>
                                        </div>
                                    </div>',
                            'email' => '
                                    <div class="col-md-6 col-sm-6">
                                        <div class="field">
                                            <input type="email" id="email" name="email" class="w_focus_mark" placeholder="' . esc_attr__( 'Email', 'sena' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $required . '>
                                        </div>
                                    </div>
                                </div>'
                        ),
						'title_reply'          => have_comments() ? esc_html__( 'Add a review', 'sena' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'sena' ), get_the_title() ),
						'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'sena' ),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'label_submit'  => esc_html__( 'Submit', 'sena' ),
						'logged_in_as' => '<p class="logged-in-as">' . sprintf( wp_specialchars_decode( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'sena' ) ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
	                    'must_log_in' => '<p class="must-log-in">' .  sprintf( wp_specialchars_decode( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'sena' ) ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>'
					);

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'sena' ) . '</label><select name="rating" id="rating" aria-required="true" required>
							<option value="">'  . esc_html__( 'Rate&hellip;', 'sena' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'sena' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'sena' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'sena' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'sena' ) . '</option>
							<option value="1">' . esc_html__( 'Very poor', 'sena' ) . '</option>
						</select></div>';
					}

					$comment_form['comment_field'] .= '
                        <div class="row">
                            <div class="col-md-12">
                                <div class="field">
                                    <textarea id="comment" name="comment" class="w_focus_mark" rows="4" placeholder="' . esc_attr__( 'Your Review', 'sena' ) . '"></textarea>
                                </div>
                            </div>
                        </div>';

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>
	<?php else : ?>
		<p class="woocommerce-verification-required">
            <?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'sena' ); ?>
        </p>
    <?php endif; ?>

</div>
