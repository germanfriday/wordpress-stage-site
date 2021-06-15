<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

$vispa_commenter = wp_get_current_commenter();
$vispa_req       = get_option( 'require_name_email' );
$vispa_aria_req  = ( $vispa_req ? " aria-required='true'" : '' );

if ( is_user_logged_in() ) {
	$vispa_comment_field        = '<textarea class="form-control" id="respondMessage" name="comment" placeholder="' . esc_html__( 'Write your message here', 'vispa' ) . '" ></textarea>';
	$vispa_textarea_field       = '';
	$vispa_comment_notes_before = '';
	$vispa_comment_notes_after  = '';
} else {
	$vispa_comment_field        = '';
	$vispa_comment_notes_before = '';
	$vispa_comment_notes_after  = '';
	$vispa_textarea_field       = '<textarea class="form-control" id="respondMessage" name="comment" placeholder="' . esc_html__( 'Write your message here', 'vispa' ) . '" ></textarea>';
}

$vispa_args = array(
	'class_form'           => 'form-comment',
	'id_form'              => 'commentform',
	'id_submit'            => 'submit',
	'title_reply'          => esc_html__( 'Leave a Comment', 'vispa' ),
	'title_reply_to'       => esc_html__( 'Leave Your Reply to %s', 'vispa' ),
	'cancel_reply_link'    => esc_html__( 'Cancel Reply', 'vispa' ),
	'label_submit'         => esc_html__( 'Submit Comment', 'vispa' ),
	'comment_field'        => $vispa_comment_field,
	'must_log_in'          => '<p class="must-log-in">' . sprintf( esc_html__( 'You must be <a href="%s">logged in</a> to post a comment.', 'vispa' ), esc_url( wp_login_url( apply_filters( 'the_permalink', esc_url( get_permalink() ) ) ) ) ) . '</p>',
	'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'vispa' ), esc_url( admin_url( 'profile.php' ) ), $user_identity, esc_url( wp_logout_url( apply_filters( 'the_permalink', esc_url( get_permalink() ) ) ) ) ) . '</p>',
	'comment_notes_before' => $vispa_comment_notes_before,
	'comment_notes_after'  => $vispa_comment_notes_after,
	'fields'               => apply_filters( 'comment_form_default_fields', array(
			'author'       => '<div class="inputs clearfix">
                               <input class="form-control" type="text" id="respondName" name="author" placeholder="' . esc_html__( 'Full Name (required)', 'vispa' ) . '" ' . $vispa_aria_req . ' />',
			'email'         => '<input class="form-control" type="email" id="respondEmail" name="email" placeholder="' . esc_html__( 'Email (required)', 'vispa' ) . '" ' . $vispa_aria_req . ' />',
			'url'           => '<input class="form-control" type="url" id="respondWebsite" name="subject" placeholder="' . esc_html__( 'Website', 'vispa' ) . '" />
                               </div>',
			'comment_field' => $vispa_textarea_field
		)
	)
);
?>
<!-- Comments -->
<section id="comments" class="comments">
	<?php if ( have_comments() ) : ?>
		<h5 class="title"><?php comments_number( esc_html__( '0 Comments', 'vispa' ), esc_html__( '1 Comment', 'vispa' ), esc_html__( '% Comments', 'vispa' ) ); ?></h5>

		<ol class="comment-list">
			<?php get_template_part( 'comments', 'template' ); ?>
			<?php wp_list_comments( array( 'callback' => 'vispa_theme_comment', 'style' => 'ol' ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="navigation paging-navigation" role="navigation">
				<div class="pagination loop-pagination">
					<?php
					$vispa_args = array(
						'prev_text' => '<span> ' . esc_html__( 'PREV', 'vispa' ) . '</span>',
						'next_text' => '<span>' . esc_html__( 'NEXT', 'vispa' ) . '</span>',
					);
					paginate_comments_links( $vispa_args ); ?>
				</div>
			</nav>
		<?php endif; // Check for comment navigation. ?>

		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'vispa' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php comment_form( $vispa_args ); ?>
</section>