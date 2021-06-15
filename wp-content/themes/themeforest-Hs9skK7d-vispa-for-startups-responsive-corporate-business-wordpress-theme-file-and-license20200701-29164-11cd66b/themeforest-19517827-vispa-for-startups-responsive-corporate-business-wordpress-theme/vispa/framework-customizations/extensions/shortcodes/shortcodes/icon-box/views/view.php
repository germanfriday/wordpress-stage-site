<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}


$icon = ( $atts['icon_box']['icon_type'] == 'awesome' ) ? $atts['icon_box']['awesome']['icon'] : $atts['icon_box']['custom']['icon'];

$icon_style = '';
if( !empty($atts['icon_color']) ) {
	$icon_style = 'style="color: '.$atts['icon_color'].';"';
}
?>
<div class="fw-iconbox <?php echo esc_attr($atts['class']); ?> sh-<?php echo esc_attr($atts['unique_id']); ?>">
	<div class="info-pricing">
		<?php if ( ! empty( $icon ) ): ?>
			<div class="icon">
				<i class="icons-info <?php echo esc_attr( $icon ); ?>" <?php echo $icon_style; ?>></i>
			</div>
		<?php endif; ?>
		<div class="text">
			<?php if ( ! empty( $atts['title'] ) ): ?>
				<h3 class="title-info"><?php echo ($atts['title']); ?></h3>
			<?php endif; ?>
			<?php if ( ! empty( $atts['content'] ) ): ?>
				<div class="text-description text-gray">
					<?php echo do_shortcode( $atts['content'] ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>