<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( $atts['height'] != 'fw-space-sm' && $atts['height'] != 'fw-space-md' && $atts['height'] != 'fw-space-lg' ) {
	$height         = ' custom-space';
	$margin         = (int) $atts['height']/2;
	$custom_spacing = 'style="margin-top:' . $margin . 'px; margin-bottom: '.$margin.'px"';
} else {
	$height         = $atts['height'];
	$custom_spacing = '';
}
?>
<div class="separator separator-danger sh-<?php echo esc_attr( $atts['unique_id'] ); ?> <?php echo esc_attr( $height ); ?> <?php echo esc_attr( $atts['class'] ); ?>" <?php echo( $custom_spacing ); ?>><?php echo vispa_theme_separator_symbol($atts['style']['type']); ?></div>