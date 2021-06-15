<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
	   <?php $comments_number = get_comments_number(); ?>
		<h3 class="comments-title">
				<?php
				if ( $comments_number ) {
					if ( '1' === $comments_number ) {
						/* translators: %s: post title */
						printf( _x( '1 Comment', 'comments title', 'kloud' ) );
					} else {
						printf(
						/* translators: 1: number of comments, 2: post title */
							_x(
								'Comments (%s)',
								'comments title',
								'kloud'
							),
							number_format_i18n( $comments_number )
						);
					}
				}
				?>
			</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation col-xs-12 col-sm-12 col-md-12 col-lg-12" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'kloud' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'kloud' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'kloud' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => 80,
					'callback' => 'jws_theme_custom_comment',
					'reply_text' => 'Reply <span class="ion-ios-redo" ></span>',
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'kloud' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'kloud' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'kloud' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'kloud' ); ?></p>
	<?php endif; ?>

	<?php
		$commenter = wp_get_current_commenter();
		
		$fields =  array(
			'author' =>
				'<p class="comment-form-author"><span>'.__('Name','kloud').'</span><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',

			'email' =>
				'<p class="comment-form-email"><span>'.__('Email','kloud').'</span><input id="email" name="email"  type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',

			'url' => '<p class="comment-form-url"><span>'.__('Website','kloud').'</span><input id="url" name="url" type="text" value="' . esc_attr(  $commenter['comment_author_url'] ) .
				'" size="30" aria-required="true" /></p>',
   	        
        );
		
		$args = array(
			'id_form'           => 'commentform',
			'id_submit'         => 'submit',
			'class_submit'      => 'submit ',
			'name_submit'       => 'submit',
			'title_reply'       => __( '<span>Leave A Comment</span>', 'kloud' ),
			'title_reply_to'    => __( 'Leave a reply %s', 'kloud' ),
			'cancel_reply_link' => __( '', 'kloud' ),
			'label_submit'      => __( 'post comment', 'kloud' ),
			'format'            => 'xhtml',
            'fields' => apply_filters( 'comment_form_default_fields', $fields ),
            
		

			'must_log_in' => '<p class="must-log-in">' .
			  sprintf(
				__( 'You must be <a href="%s">logged in</a> to post a comment.', 'kloud' ),
				wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
			  ) . '</p>',

			'logged_in_as' => '<p class="logged-in-as">' .
			  sprintf(
			  __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'kloud' ),
				admin_url( 'profile.php' ),
				$user_identity,
				wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
			  ) . '</p>',
            
			'comment_notes_before' => '',
            
			'comment_notes_after' => '',
            
            'comment_field' =>  '<p class="comment-form-comment2"><span>'.__('Comment','kloud').'</span><textarea id="comment" name="comment" cols="60" rows="6" aria-required="true">' . '</textarea></p>',
			
		  );

		comment_form($args);
	?>

</div><!-- #comments -->
