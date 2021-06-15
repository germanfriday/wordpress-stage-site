<?php
//register script
function airtheme_theme_interface_register_script($script){

	$script['jquery-jplayer-min'] = array(
		'handle'    => 'jquery-jplayer-min',
		'src'       => MUTI_LOCAL_URL. '/js/jquery.jplayer.min.js',
		'deps'      => array('jquery'),
		'ver'       => '2.2.0',
		'in_footer' => true
	);
	
	$script['airtheme-interface-main'] = array(
		'handle'    => 'airtheme-interface-main',
		'src'       => MUTI_LOCAL_URL. '/js/main.js',
		'deps'      => array('jquery'),
		'ver'       => '1.9.7.5',
		'in_footer' => true
	);

	$script['airtheme-interface-sticky'] = array(
		'handle'    => 'airtheme-interface-sticky',
		'src'       => MUTI_LOCAL_URL. '/js/sticky-kit.min.js',
		'deps'      => array('jquery'),
		'ver'       => '1.0.0',
		'in_footer' => true
	);
	
	$script['airtheme-interface-theme'] = array(
		'handle'    => 'airtheme-interface-theme',
		'src'       => MUTI_LOCAL_URL. '/js/custom.theme.js',
		'deps'      => array('jquery'),
		'ver'       => '1.0.0',
		'in_footer' => true
	);
	
	
	return $script;
}
add_filter('airtheme_theme_register_script', 'airtheme_theme_interface_register_script');

//register style
function airtheme_theme_interface_register_style($style){
	$style['bootstrap'] = array(
		'handle' => 'bootstrap',
		'src'    => MUTI_LOCAL_URL. '/styles/bootstrap.css',
		'deps'   => array(),
		'ver'    => '2.0.0',
		'media'  => 'screen'
	);
	
	$style['font-awesome'] = array(
		'handle' => 'font-awesome',
		'src'    => MUTI_LOCAL_URL. '/functions/theme/css/font-awesome.min.css',
		'deps'   => array(),
		'ver'    => '4.7.0',
		'media'  => 'screen'
	);
	
		$style['owl-carousel'] = array(
		'handle' => 'owl-carousel',
		'src'    => MUTI_LOCAL_URL. '/styles/owl.carousel.css',
		'deps'   => array(),
		'ver'    => '0.0.1',
		'media'  => 'screen'
	);

	$style['airtheme-interface-style'] = array(
		'handle' => 'airtheme-interface-style',
		'src'    => MUTI_LOCAL_URL. '/style.css',
		'deps'   => array(),
		'ver'    => '1.7.1',
		'media'  => 'screen'
	);

	$style['google-fonts-Poppins'] = array(
		'handle' => 'google-fonts-Poppins',
		'src'    => 'https://fonts.googleapis.com/css?family=Poppins:400,300',
		'deps'   => array(),
		'ver'    => '1.0.0',
		'media'  => 'screen'
	);

	$style['google-fonts-Libre+Baskerville'] = array(
		'handle' => 'google-fonts-Libre+Baskerville',
		'src'    => 'https://fonts.googleapis.com/css?family=Libre+Baskerville:400,700',
		'deps'   => array(),
		'ver'    => '1.0.0',
		'media'  => 'screen'
	);
	
	$style['photoswipe'] = array(
		'handle' => 'photoswipe',
		'src'    => MUTI_LOCAL_URL. '/styles/photoswipe.css',
		'deps'   => array(),
		'ver'    => '4.0.5',
		'media'  => 'screen',
	);
	
	$style['photoswipe-default-skin'] = array(
		'handle' => 'photoswipe-default-skin',
		'src'    => MUTI_LOCAL_URL. '/styles/skin/photoswipe/default/default-skin.css',
		'deps'   => array('photoswipe'),
		'ver'    => '4.0.5',
		'media'  => 'screen',
	);
	
	
	return $style;
}
add_filter('airtheme_theme_register_style', 'airtheme_theme_interface_register_style');
?>