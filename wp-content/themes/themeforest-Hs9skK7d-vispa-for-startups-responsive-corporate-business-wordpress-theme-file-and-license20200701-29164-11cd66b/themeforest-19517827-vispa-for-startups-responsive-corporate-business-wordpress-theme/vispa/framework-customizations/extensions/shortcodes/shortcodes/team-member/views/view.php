<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
?>
<!-- Team Member -->
<div class="fly-team-member card card-member card-plain <?php echo esc_attr( $atts['class'] ); ?> sh-<?php echo esc_attr( $atts['unique_id'] ); ?>">
	<div class="content">
		<?php if( !empty($atts['image']) && isset($atts['image']['url']) ) : ?>
			<div class="avatar">
				<img src="<?php echo esc_attr($atts['image']['url']); ?>" class="img-circle" alt="<?php echo esc_attr( $atts['name'] ); ?>" />
			</div>
		<?php endif; ?>
		<div class="fly-member-description">
			<h3 class="big-text"><?php echo ( $atts['name'] ); ?></h3>
			<?php if( !empty($atts['position']) ) : ?>
				<p class="small-text"><?php echo ( $atts['position'] ); ?></p>
			<?php endif; ?>
			<?php if( !empty($atts['text']) ) : ?>
				<div class="description">
					<?php echo do_shortcode( $atts['text'] ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<!-- / Team Member -->