<?php
/**
 * The Sidebar containing the main widget area
 */

$vispa_sidebar_position = null;
if ( function_exists( 'fw_ext_sidebars_get_current_position' ) ) :
	$vispa_sidebar_position = fw_ext_sidebars_get_current_position();
	if ( $vispa_sidebar_position !== 'full' && $vispa_sidebar_position !== null ) : ?>
		<aside class="sidebar">
			<?php if ( $vispa_sidebar_position === 'left' || $vispa_sidebar_position === 'right' ) : ?>
				<?php echo fw_ext_sidebars_show( 'blue' ); ?>
			<?php endif; ?>
		</aside>
	<?php endif; ?>
<?php else : ?>
	<aside class="sidebar">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside>
<?php endif; ?>