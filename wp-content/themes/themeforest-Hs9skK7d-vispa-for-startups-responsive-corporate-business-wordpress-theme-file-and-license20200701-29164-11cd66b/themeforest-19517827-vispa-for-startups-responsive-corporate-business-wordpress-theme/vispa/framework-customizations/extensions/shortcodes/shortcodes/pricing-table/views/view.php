<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}


$style = '';
if( !empty($atts['bg_color']) ) {
	$style = 'style="background-color: '.$atts['bg_color'].';"';
}

$shortcodes = fw_ext( 'shortcodes' );
$button     = $shortcodes->get_shortcode( 'button' );
?>
<!-- Pricing -->
<div class="fw-pricing card card-price sh-<?php echo esc_attr($atts['unique_id']); ?> <?php echo esc_attr( $atts['class'] ); ?>" <?php echo ($style); ?>>
	<div class="content">
		<h4 class="title-header">
			<?php if ( ! empty( $atts['plan'] ) ): ?>
				<?php echo ( $atts['plan'] ); ?>
			<?php endif; ?>
			<br>
			<?php if( !empty($atts['time']) ) : ?>
				<small class="subtitle-header"><?php echo ( $atts['time'] ); ?></small>
			<?php endif; ?>
		</h4>
		<div class="price">
			<span class="price-currency"><?php echo ( $atts['currency'] ); ?></span>
			<div class="number"><?php echo ( $atts['price'] ); ?></div>
		</div>
		<div class="text-description">
			<?php if ( ! empty( $atts['rows'] ) ) : ?>
				<?php foreach ( $atts['rows'] as $row ): ?>
					<?php echo esc_html( $row['row'] ); ?><br>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<?php if ( $atts['button']['selected'] == 'yes' ) {
			echo do_shortcode( $button->render( $atts['button']['yes']['button_options'] ) );
		} ?>
	</div>
</div>
<!--/ Pricing -->