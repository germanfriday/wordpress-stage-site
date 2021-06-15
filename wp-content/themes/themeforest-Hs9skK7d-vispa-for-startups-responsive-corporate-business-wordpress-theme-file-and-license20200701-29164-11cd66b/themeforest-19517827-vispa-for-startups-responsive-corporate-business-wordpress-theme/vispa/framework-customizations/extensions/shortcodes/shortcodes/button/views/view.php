<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );

	/**
	 * @var array $atts
	 */
}

$before_btn = $after_btn = '';
if( $atts['align'] != 'none') {
	$before_btn = '<div class="' . $atts['align'] . '">';
	$after_btn  = '</div>';
}
?>

<?php echo $before_btn; ?>
<a href="<?php echo esc_url( $atts['link'] ); ?>" <?php echo 'target="' . $atts['target'] . '"' ?>
   class="btn sh-<?php echo esc_attr( $atts['unique_id'] ); ?> <?php echo esc_attr( $atts['size'] ); ?> <?php echo esc_attr( $atts['round'] ); ?> <?php echo esc_attr( $atts['type']['selected'] ); ?> <?php echo esc_attr( $atts['class'] ); ?>">
	<?php echo esc_html( $atts['label'] ); ?>
</a>
<?php echo $after_btn; ?>