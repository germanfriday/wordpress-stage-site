<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$icon = ( $atts['icon_box']['icon_type'] == 'awesome' ) ? $atts['icon_box']['awesome']['icon'] : $atts['icon_box']['custom']['icon'];

$icon_style = '';
if( !empty($atts['icon_color']) ) {
	$icon_style = 'style="color: '.$atts['icon_color'].';"';
}
?>
<!-- Service -->
<div class="fw-service info-icon <?php echo esc_attr( $atts['class'] ); ?> sh-<?php echo esc_attr( $atts['unique_id'] ); ?>">
	<div class="inner">
		<?php if ( ! empty( $icon ) ): ?>
			<div class="icon">
				<i class="<?php echo esc_attr( $icon ); ?>" <?php echo $icon_style; ?>></i>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $atts['title'] ) ): ?>
			<h3 class="fw-service-title"><?php echo esc_html( $atts['title'] ); ?></h3>
		<?php endif; ?>

		<?php if ( ! empty( $atts['desc'] ) ): ?>
			<div class="description">
				<?php echo do_shortcode( $atts['desc'] ); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
<!-- Service -->