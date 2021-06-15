<?php
class Sena_Menu extends Walker_Nav_Menu {
	// Starts the list before the elements are added
	public function start_lvl( & $output, $depth = 0, $args = array( ) ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class=\"submenu\">\n";
	}

	// Fallback if Menu doesn't exists
	public static function fallback_cb( $args = array( ) ) {
		return wp_page_menu( array(
			'echo'          => $args['echo'],
			'depth'         => $args['depth'],
			'show_home'     => true,
			'sena_fallback'	=> true,
			'sena_class'    => $args['menu_class']
		) );
	}
}
