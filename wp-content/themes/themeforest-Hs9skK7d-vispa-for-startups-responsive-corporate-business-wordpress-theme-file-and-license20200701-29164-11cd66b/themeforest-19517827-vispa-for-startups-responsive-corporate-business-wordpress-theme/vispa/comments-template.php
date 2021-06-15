<?php
if ( ! function_exists( 'vispa_theme_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * To override this walker in a child theme without modifying the comments template
	 * simply create your own vispa_theme_comment(), and that function will be used instead.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 */
	function vispa_theme_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				?>
				<li <?php comment_class( '' ); ?> id="li-comment-<?php comment_ID(); ?>">
					<article class="comment-body">
						<div class="comment-avatar"><?php echo get_avatar( $comment, 80 ); ?></div>

						<div class="comment-meta">
							<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
							<?php comment_author_link(); ?>
							<span class="comment-date"><?php comment_date() ?></span>
						</div>

						<div class="comment-content">
							<p>
								<?php echo get_comment_text() ?>
							</p>
						</div>
						<div id="comment-<?php comment_ID(); ?>"></div>
					</article>
				</li>
				<?php
				break;
			default : ?>
				<li <?php comment_class( '' ); ?> id="li-comment-<?php comment_ID(); ?>">
					<article class="comment-body">
						<div class="comment-avatar"><?php echo get_avatar( $comment, 80 ); ?></div>

						<div class="comment-meta">
							<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
							<?php comment_author_link(); ?>
							<span class="comment-date"><?php comment_date() ?></span>
						</div>

						<div class="comment-content">
							<p>
								<?php echo get_comment_text() ?>
							</p>
						</div>
						<div id="comment-<?php comment_ID(); ?>"></div>
					</article>
				</li>
				<?php
				break;
		endswitch;
	}
endif; // ends check for vispa_theme_comment()