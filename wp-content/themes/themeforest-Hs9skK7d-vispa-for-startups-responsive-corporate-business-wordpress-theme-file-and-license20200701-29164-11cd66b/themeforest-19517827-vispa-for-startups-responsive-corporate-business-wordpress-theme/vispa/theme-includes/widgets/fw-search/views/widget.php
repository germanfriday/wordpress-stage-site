<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

/**
 * @var $instance
 * @var $before_widget
 * @var $after_widget
 * @var $title
 */

?>
<?php if ( ! empty( $instance ) ) :
	echo do_shortcode( $before_widget );
	?>

	<section class="widget search">
		<?php if ( ! empty( $title ) ): ?>
			<?php echo do_shortcode( '<h4 class="widget-title">' . $title . '</h4>' ); ?>
		<?php endif;?>
		<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="form-search" method="get" role="search">
			<input type="search" name="s" class="form-control" placeholder="<?php esc_html_e( 'search for something', 'vispa' );?>"/>
			<button type="submit" name="" class="submit fa fa-search"></button>
		</form>
	</section>

	<?php echo do_shortcode( $after_widget );
endif; ?>