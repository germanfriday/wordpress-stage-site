<?php
//theme tgm register
function airtheme_theme_tgm_register(){
	$plugins = array(

		array(
			'name' 		=> 'Contact Form 7',
			'slug' 		=> 'contact-form-7',
			'version'	=> '',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Loco Translate',
			'slug' 		=> 'loco-translate',
			'version'	=> '',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'WooCommerce',
			'slug' 		=> 'woocommerce',
			'version'	=> '',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'WooCommerce Product CSV Import Export',
			'slug' 		=> 'product-import-export-for-woo',
			'version'	=> '',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'BM Pagebuilder',
			'slug' 		=> 'bm-pagebuilder',
			'version'	=> '1.1.9',
			'source'    => get_template_directory_uri() . '/functions/plugins/bm-pagebuilder.zip', 
			'required' 	=> true,
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name' 		=> 'BM Shortcodes',
			'slug' 		=> 'bm-shortcodes',
			'version'	=> '1.1',
			'source'    => get_template_directory_uri() . '/functions/plugins/bm-shortcodes.zip', 
			'required' 	=> false,
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),
		array(
			'name' 		=> 'BM Slider',
			'slug' 		=> 'bm-slider-air',
			'source'    => get_template_directory_uri() . '/functions/plugins/bm-slider-air.zip', 
			'version'	=> '1.1',
			'required' 	=> false,
			'force_activation'   => false,
			'force_deactivation' => true, 
			'external_url'       => '', 
			'is_callable'        => '', 
		)

	);

	$config = array(
		'id'       	   => 'air-theme',         	// Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',  						// Message to output right before the plugins table
		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'air-theme' ),
			'menu_title'                      => __( 'Install Plugins', 'air-theme' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'air-theme' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'air-theme' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'air-theme' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'air-theme'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'air-theme'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'air-theme'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'air-theme'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'air-theme'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'air-theme'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'air-theme'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'air-theme'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'air-theme'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'air-theme' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'air-theme' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'air-theme' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'air-theme' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'air-theme' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'air-theme' ),
			'dismiss'                         => __( 'Dismiss this notice', 'air-theme' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'air-theme' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'air-theme' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'airtheme_theme_tgm_register' );

//require tgm class
require_once get_template_directory() . '/functions/class/class-tgm-plugin-activation.php';
?>