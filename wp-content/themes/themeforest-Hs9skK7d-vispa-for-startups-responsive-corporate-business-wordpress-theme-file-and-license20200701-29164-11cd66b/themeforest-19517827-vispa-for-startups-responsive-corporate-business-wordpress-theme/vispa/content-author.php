<?php
$author_description = get_the_author_meta( 'description' );
$author             = get_the_author_meta( 'display_name' );

if ( ! empty( $author_description ) ): ?>
	<div class="widget widget_author">
		<div class="avatar-wrap"><?php echo get_avatar( get_the_author_meta( 'ID' ), '100' ); ?></div>

		<h4 class="widget-title"><?php esc_html_e('About the Author', 'vispa'); ?> - <?php echo esc_html( $author ); ?></h4>

		<p><?php echo esc_html( $author_description ); ?></p>
	</div>
<?php endif; ?>