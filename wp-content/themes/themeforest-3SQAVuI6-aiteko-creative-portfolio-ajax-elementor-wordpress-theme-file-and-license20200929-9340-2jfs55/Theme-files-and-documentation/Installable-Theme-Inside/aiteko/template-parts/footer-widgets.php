<?php
/**
 * Template part to show the footer widgets
 *
 * @package Aiteko
 * @since 1.0
 */

?>

<div class="aiteko-row">

	<div class="aiteko-col-3">
		<?php 
			if ( is_active_sidebar( 'footer-col-one' ) ) {

				print '<div class="ft-widgets-holder">' . "\n";

					dynamic_sidebar( 'footer-col-one' );

				print '</div>' . "\n";

			}
		?>
	</div>

	<div class="aiteko-col-3">
		<?php 
			if ( is_active_sidebar( 'footer-col-two' ) ) {

				print '<div class="ft-widgets-holder">' . "\n";

					dynamic_sidebar( 'footer-col-two' );

				print '</div>' . "\n";

			}
		?>
	</div>

	<div class="aiteko-col-3">
		<?php 
			if ( is_active_sidebar( 'footer-col-three' ) ) {

				print '<div class="ft-widgets-holder">' . "\n";

					dynamic_sidebar( 'footer-col-three' );

				print '</div>' . "\n";

			}
		?>
	</div>

</div>
