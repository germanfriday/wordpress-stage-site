<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @since 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<div class="comments-inner">
	<?php if ( have_comments() ) : ?>
		<header class="comments-title-header">
			<h3 class="comments-title">
				<?php comments_number( esc_html__( 'no responses', 'aiteko' ), esc_html__( '1 response', 'aiteko' ), esc_html__( '% responses', 'aiteko' ) ); ?>
			</h3>
		</header>
		<?php
	endif;

	comment_form(
		array(
			'label_submit'         => esc_html__( 'Submit', 'aiteko' ),
			'comment_notes_before' => '',
		)
	);

	if ( have_comments() ) :
		?>
	<div id="comment-contain-container">
		<ol class="comment-list">
			<?php
				wp_list_comments(
					array(
						'avatar_size' => 50,
						'style'       => 'ol',
						'short_ping'  => true,
						'reply_text'  => esc_html__( 'Reply', 'aiteko' ),
					)
				);
			?>
		</ol>

		<?php
		$compaglink = '';
		$paglink    = paginate_comments_links(
			array(
				'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M216.4 163.7c5.1 5 5.1 13.3.1 18.4L155.8 243h231.3c7.1 0 12.9 5.8 12.9 13s-5.8 13-12.9 13H155.8l60.8 60.9c5 5.1 4.9 13.3-.1 18.4-5.1 5-13.2 5-18.3-.1l-82.4-83c-1.1-1.2-2-2.5-2.7-4.1-.7-1.6-1-3.3-1-5 0-3.4 1.3-6.6 3.7-9.1l82.4-83c4.9-5.2 13.1-5.3 18.2-.3z"/></svg><span class="screen-reader-text">' . esc_html__( 'Previous', 'aiteko' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next', 'aiteko' ) . '</span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M295.6 163.7c-5.1 5-5.1 13.3-.1 18.4l60.8 60.9H124.9c-7.1 0-12.9 5.8-12.9 13s5.8 13 12.9 13h231.3l-60.8 60.9c-5 5.1-4.9 13.3.1 18.4 5.1 5 13.2 5 18.3-.1l82.4-83c1.1-1.2 2-2.5 2.7-4.1.7-1.6 1-3.3 1-5 0-3.4-1.3-6.6-3.7-9.1l-82.4-83c-4.9-5.2-13.1-5.3-18.2-.3z"/></svg>',
				'echo'      => false,
			)
		);

		if ( $paglink ) {
			$compaglink = '<nav class="navigation comments-pagination"><div class="nav-links">' . $paglink . '</div></nav>' . "\n";
		}

		print wp_kses_post( $compaglink );

		print '</div><!-- #comment-contain-container -->';

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'aiteko' ); ?></p>
		<?php
	endif;
	?>

	</div>
</div><!-- #comments -->
