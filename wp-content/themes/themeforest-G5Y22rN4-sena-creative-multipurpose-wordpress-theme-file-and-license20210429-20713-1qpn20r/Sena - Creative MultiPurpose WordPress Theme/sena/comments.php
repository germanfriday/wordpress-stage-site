<?php 
	global $sena_config;

	if ( post_password_required( ) ) return;
	$comments_number = get_comments_number( get_the_ID( ) ); 
?>

<?php if ( $comments_number ) : ?>
	<div id="comments" class="comments">

        <div class="row">
            <div class="col-md-12">
                <header>
                    <h3>
                        <?php comments_number( esc_html__( '0 Comments', 'sena' ), esc_html__( '1 Comment', 'sena' ), esc_html__( '% Comments', 'sena' ) ); ?>
                    </h3>
                </header>
            </div>
        </div>	

		<?php if ( have_comments( ) ) : ?>
			<?php wp_list_comments( array( 'callback' => array( 'Sena_Theme', 'sena_comment' ), 'style' => 'div' ) ); ?>

			<?php if (get_comment_pages_count()>1 && get_option('page_comments')) : ?>
				<div class="navigation">
					
					<div class="btn-custom btn-fill btn-prev">
						<?php previous_comments_link( esc_html__( '&larr; Older Comments', 'sena' ) ); ?>
					</div>
					
					<div class="btn-custom btn-fill btn-next">
						<?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'sena' ) ); ?>
					</div>
					
				</div>
			<?php endif; ?>	
		<?php else :	
				// If there are no comments and comments are closed let's leave a little note
				if ( ! comments_open( ) ) :
			?>
				<p class="nocomments"><?php esc_html_e('Comments are closed.', 'sena'); ?></p>
			<?php endif; ?>
		<?php endif; ?>

	</div>
<?php endif; ?>

<?php
$commenter = wp_get_current_commenter( );
$required = ( get_option( 'require_name_email' ) ? " aria-required='true'" : '' );

comment_form( array(
	'comment_field' => '		
		<div class="row">
			<div class="col-md-12">
				<div class="field">
					<textarea id="comment" name="comment" class="w_focus_mark" rows="4" placeholder="' . esc_attr__( 'Comment', 'sena' ) . '"></textarea>
				</div>
			</div>
		</div>',
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
	'comment_notes_before' => '<p class="email-notification">' . sprintf( __( 'Your email address will not be published or shared.', 'sena' ) ) . '</p>',
	'comment_notes_after' => '',
	'logged_in_as' => '
		<p class="logged-in-as">' . sprintf( wp_specialchars_decode( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'sena' ) ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
	'must_log_in' => '
		<p class="must-log-in">' .  sprintf( wp_specialchars_decode( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'sena' ) ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>'
) );
?>