<?php
/**
 * The template for displaying a "No posts found" message
 */
?>

<header class="">
	<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'vispa' ); ?></h1>
</header>

<div class="page-content">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<p><?php printf( esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'vispa' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

	<?php elseif ( is_search() ) : ?>

		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'vispa' ); ?></p>

	<?php else : ?>

		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'vispa' ); ?></p>

	<?php endif; ?>
</div><!-- .page-content -->