<?php
// Content width
if ( ! isset( $content_width ) ) {
	$content_width = 750;
}

// Localize
include ( get_template_directory() . '/inc/languages.php' );

// TGM plugin activation
include ( get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php' );
include ( get_template_directory() . '/inc/tgm/plugins.php' );

// Admin panel
include ( get_template_directory() . '/admin/metaboxes/section-type.php' );
include ( get_template_directory() . '/admin/metaboxes/subtitle.php' );

// Redux Framework
include ( get_template_directory() . '/admin/font-awesome/social-icons.php' );
include ( get_template_directory() . '/admin/redux.php' );
include ( get_template_directory() . '/admin/social/social.php' );

// Defaults
include ( get_template_directory() . '/inc/defaults.php' );

// Theme files
include ( get_template_directory() . '/inc/menu.php' );
include ( get_template_directory() . '/inc/functions.php' );
include ( get_template_directory() . '/inc/register.php' );
include ( get_template_directory() . '/inc/custom.php' );

// Extend WooCommerce
include ( get_template_directory() . '/inc/woocommerce.php' );

