<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$manifest = array();

$manifest['id']           = 'vispa';
$manifest['name']         = esc_html__( 'Vispa', 'vispa' );
$manifest['requirements'] = array(
	'wordpress' => array(
		'min_version' => '4.5',
	)
);

$manifest['supported_extensions'] = array(
	'sidebars'      => array(),
	'page-builder'  => array(),
	'backups'       => array(),
	'seo'           => array(),
	'slider'        => array(),
	'portfolio'     => array(),
	'wp-shortcodes' => array(),
	'forms'         => array(),
	'mailer'        => array(),
);