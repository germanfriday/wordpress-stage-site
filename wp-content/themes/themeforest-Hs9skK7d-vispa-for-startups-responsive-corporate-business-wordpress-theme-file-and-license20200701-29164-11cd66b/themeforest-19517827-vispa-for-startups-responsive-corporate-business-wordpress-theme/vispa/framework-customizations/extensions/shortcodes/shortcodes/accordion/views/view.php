<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$accordion = $atts['accordion'];
if ( empty( $accordion ) ) {
	return;
}
?>
<!-- Widget Accordion -->
<div class="fly-accordion widget-accordion <?php echo esc_attr( $atts['class'] ); ?> sh-<?php echo esc_attr( $atts['unique_id'] ); ?>">
	<?php if ( ! empty( $atts['title'] ) ): ?>
		<h2 class="widget-title"><?php echo esc_html( $atts['title'] ); ?></h2>
	<?php endif; ?>

	<div class="panel-group" id="accordion<?php echo esc_attr( $atts['unique_id'] ); ?>">
		<?php $cnt = 0;
		foreach ( $accordion as $panel ): $cnt ++; ?>
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">
						<a class="panel-toggle <?php echo ( $cnt == 1 ) ? '' : 'collapsed' ?>" data-toggle="collapse"
						   data-parent="#accordion<?php echo esc_attr( $atts['unique_id'] ); ?>"
						   href="#accordion<?php echo esc_attr( $cnt ); ?>">
							<?php echo esc_html( $panel['title'] ); ?>
						</a>
					</h3>
				</div>
				<div id="accordion<?php echo esc_attr( $cnt ); ?>"
				     class="panel-collapse collapse <?php echo ( $cnt == 1 ) ? 'in' : '' ?>">
					<div class="panel-body">
						<?php echo( $panel['content'] ); ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<!--/ Widget Accordion -->
