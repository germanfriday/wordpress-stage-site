<?php
define('UX_WOOCOMMERCE', get_template_directory_uri(). '/woocommerce');

// Theme Get Woo Template
function airtheme_get_woo_template_part($key, $name){
	get_template_part('woocommerce/airtheme-template/' . $key, $name);
}

//require theme woocommerce register
require_once get_template_directory() . '/woocommerce/airtheme-woocommerce-register.php';

//require theme woocommerce functions
require_once get_template_directory() . '/woocommerce/airtheme-woocommerce-functions.php';

//require theme woocommerce hook
require_once get_template_directory() . '/woocommerce/airtheme-woocommerce-hook.php';

?>