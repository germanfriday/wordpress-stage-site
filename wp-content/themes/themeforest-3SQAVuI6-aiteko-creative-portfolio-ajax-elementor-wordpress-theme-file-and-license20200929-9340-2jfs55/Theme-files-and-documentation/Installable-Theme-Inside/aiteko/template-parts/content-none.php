<?php
/**
 * No posts template
 *
 * @since 1.0
 * @package Aiteko
 */

?>

<div class="blank no-posts">
	
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php print esc_html__( 'Ready to publish your first post?', 'aiteko' ); ?>
				<a href="<?php print esc_url( admin_url( 'post-new.php' ) ); ?>"><?php print esc_html__( 'Get started here', 'aiteko' ); ?></a></p>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'aiteko' ); ?></p>
			<?php
				get_search_form();

		endif; ?>

</div>
