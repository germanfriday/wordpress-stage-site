<?php
/**
 * Template Name: Front Page
 */
?>

<?php
	// Custom color schema
	if ( $color_schema = get_post_meta( get_the_ID( ), 'color_schema', true ) ) {
		if ($color_schema != 'default') {
			$sena_config['styling-schema'] = $color_schema;
		}
	}
?>

<?php get_header( ); ?>

<?php if ( Sena_Theme::sena_front_page( get_the_ID( ) ) ) : ?>
<?php echo "\n" . Sena_Theme::sena_front_sections( ); ?>
<?php endif; ?>

<?php get_footer( ); ?>