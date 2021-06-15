<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( $atts['height'] != 'space-sm' && $atts['height'] != 'space-md' && $atts['height'] != 'space-lg' ) {
	$height         = ' custom-space';
	$custom_spacing = 'style="height:' . (int) $atts['height'] . 'px;"';
} else {
	$height         = $atts['height'];
	$custom_spacing = '';
}
?>
<div class="<?php echo esc_attr( $height ); ?> <?php echo esc_attr( $atts['class'] ); ?>" <?php echo( $custom_spacing ); ?>></div>