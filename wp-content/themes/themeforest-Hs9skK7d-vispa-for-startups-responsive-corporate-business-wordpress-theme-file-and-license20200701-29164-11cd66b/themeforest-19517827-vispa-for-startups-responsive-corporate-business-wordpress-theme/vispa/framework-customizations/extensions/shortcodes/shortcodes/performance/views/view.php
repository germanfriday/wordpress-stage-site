<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$icon = ( $atts['icon_box']['icon_type'] == 'awesome' ) ? $atts['icon_box']['awesome']['icon'] : $atts['icon_box']['custom']['icon'];
?>
<!-- Performance -->
<div class="section-numbers">
	<div class="fly-performance card card-plain <?php echo esc_attr( $atts['class'] ); ?> sh-<?php echo esc_attr( $atts['unique_id'] ); ?>">
		<?php if ( ! empty( $icon ) ): ?>
			<div class="icon">
				<i class="<?php echo esc_attr($icon); ?>"></i>
			</div>
		<?php endif; ?>
		<?php if( !empty($atts['title']) ) : ?>
			<h3 class="performance-title"><?php echo ($atts['title']); ?></h3>
		<?php endif; ?>
		<?php if( !empty($atts['text']) ) : ?>
			<h5 class="text-gray"><?php echo do_shortcode($atts['text']); ?></h5>
		<?php endif; ?>
		<?php if( !empty($atts['number']) ) : ?>
			<div class="number stats-counter" data-duration="2" data-step=".1"><?php echo (int)$atts['number']; ?></div>
		<?php endif; ?>
	</div>
</div>
<!-- / Performance -->