<?php
// Localization
function sena_localization( ) {
	load_theme_textdomain( 'sena', get_template_directory( ) . '/languages' );
}

add_action( 'after_setup_theme', 'sena_localization' );
