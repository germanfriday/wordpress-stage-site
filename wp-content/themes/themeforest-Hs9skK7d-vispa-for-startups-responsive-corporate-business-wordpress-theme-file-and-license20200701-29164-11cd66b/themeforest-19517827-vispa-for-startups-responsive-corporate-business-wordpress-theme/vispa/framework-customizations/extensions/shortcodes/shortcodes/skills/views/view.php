<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$skills = $atts['skills'];
if ( empty( $skills ) ) {
	return;
}
?>
<!-- Widget Skills -->
<div class="fly-skills widget-skills <?php echo esc_attr( $atts['class'] ); ?> sh-<?php echo esc_attr( $atts['unique_id'] ); ?>">
	<?php if ( ! empty( $atts['title'] ) ): ?>
		<h2 class="widget-title"><?php echo esc_html( $atts['title'] ); ?></h2>
	<?php endif; ?>
	<?php foreach ( $skills as $skill ) :
		if ( empty( $skill['content'] ) ) {
			continue;
		}
		$numb = (int) $skill['content'];
		?>
		<!-- Skill -->
		<div class="skill" data-percentage="<?php echo esc_attr( $numb ); ?>">
			<div class="skill-info">
				<span class="skill-title"><?php echo esc_html( $skill['title'] ); ?></span>
				<span class="skill-percentage"><?php echo esc_attr( $numb ); ?>%</span>
			</div>
			<div class="progress">
				<div class="progress-bar" style="width: <?php echo esc_attr( $numb ); ?>%;"></div>
			</div>
		</div>
		<!--/ Skill -->
	<?php endforeach; ?>
</div>
<!--/ Widget Skills -->