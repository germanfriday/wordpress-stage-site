<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
} ?>
<div class="text-block shortcode-container <?php echo esc_attr( $atts['class'] ); ?> sh-<?php echo esc_attr( $atts['unique_id'] ); ?>">
	<?php echo do_shortcode( $atts['text'] ); ?>
</div>