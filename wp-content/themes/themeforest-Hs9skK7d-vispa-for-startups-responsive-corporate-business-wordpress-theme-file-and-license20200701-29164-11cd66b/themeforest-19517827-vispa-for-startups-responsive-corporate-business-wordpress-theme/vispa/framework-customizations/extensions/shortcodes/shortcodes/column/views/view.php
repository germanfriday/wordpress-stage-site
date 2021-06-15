<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
} ?>

<?php
$id_to_class = array(
	'1_6' => 'col-md-2',
	'1_4' => 'col-md-3',
	'1_3' => 'col-md-4',
	'1_2' => 'col-md-6',
	'2_3' => 'col-md-8',
	'3_4' => 'col-md-9',
	'1_1' => 'col-md-12'
);

if ( $atts['tablet'] == 'same' ) {
	if ( $atts['width'] == '1_6' ) {
		$tablet_col = 'col-sm-2';
	} elseif ( $atts['width'] == '1_4' ) {
		$tablet_col = 'col-sm-3';
	} elseif ( $atts['width'] == '1_3' ) {
		$tablet_col = 'col-sm-4';
	} elseif ( $atts['width'] == '1_2' ) {
		$tablet_col = 'col-sm-6';
	} elseif ( $atts['width'] == '2_3' ) {
		$tablet_col = 'col-sm-8';
	} elseif ( $atts['width'] == '3_4' ) {
		$tablet_col = 'col-sm-9';
	} else {
		$tablet_col = 'col-sm-12';
	}
} else {
	$tablet_col = $atts['tablet'];
}

$bg_color = ( isset( $atts['bg_color'] ) && ! empty( $atts['bg_color'] ) ) ? $atts['bg_color'] : '';
$bg_image = ( isset( $atts['bg_image'] ) && ! empty( $atts['bg_image'] ) ) ? $atts['bg_image'] : '';

if ( ! empty( $bg_image ) && ! empty( $bg_color ) ) {
	$style = 'background-image: url(' . esc_url( $bg_image['url'] ) . '); background-color: ' . ( $bg_color ) . ';';
} elseif ( ! empty( $bg_image ) ) {
	$style = 'background-image: url(' . esc_url( $bg_image['url'] ) . ');';
} elseif ( ! empty( $bg_color ) ) {
	$style = 'background-color: ' . ( $bg_color ) . ';';
} else {
	$style = '';
}

?>
<div class="<?php echo esc_attr( $id_to_class[ $atts['width'] ] ); ?> <?php echo esc_attr( $tablet_col ); ?> <?php echo esc_attr( $atts['class'] ); ?> sh-<?php echo esc_attr( $atts['unique_id'] ); ?>">
	<div class="fly-col-inner <?php echo $atts['align']; ?>" <?php echo ! empty( $style ) ? 'style="' . $style . '"' : ''; ?>>
		<?php echo do_shortcode( $content ); ?>
	</div>
</div>

