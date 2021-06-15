<?php
// Some demo content
// And variables for Redux Framework
class Sena_Defaults {
	
	// Initialize
	public static function sena_initialize( ) {
		global $sena_config;

		if ( ! isset( $sena_config ) or count( $sena_config ) == 0 ) {
			$sena_config = self::sena_redux( );
		}
		
		if ( ! get_option( 'sena_started', false ) ) {
			self::sena_save( );
		}
	}

	// Save state
	public static function sena_save( ) {
		update_option( 'sena_started', 1 );
	}

	// Default options for Redux Framework
	public static function sena_redux( ) {
		return array(			
			'home-page-title'        => esc_html__( 'Home', 'sena' ),
            'home-magic-mouse'       => 1,
			'home-magic-mouse-url'   => '#mission',
			'preloader'              => 1,
			'preloader-only-home'    => 1,
			'animations'             => 1,
			'multiple-videos'        => '',
            'google-map-api'         => '',
			'settings'            	 => 0,
			
			'logo-dark'              => array( 'url' => '' ),
			'logo-light'             => array( 'url' => '' ),
			'logo-dark-retina'       => array( 'url' => '' ),
			'logo-light-retina'      => array( 'url' => '' ),
			'logo-height'            => 25,
			
			'header-sticky'          => 1,
			'search-icon'            => 1,
            'shop-icon'              => 0,
			'header-nav-bgcolor'   	 => '#333333',
			'header-bgcolor'   		 => '#000000',
			'header-bgimage'         => array( 'url' => '' ),
			
			'footer-button-top'      => 1,
			'footer-bgcolor'   	 	 => '#1a191d',
			'footer-bgimage'         => array( 'url' => '' ),
			'copyright-text'         => esc_html__( 'Copyright &copy; 2021 Sena', 'sena' ),
		
			'allow-share-posts'      => 1,
			'show-post-author'       => 1,
			'show-comments'      	 => 1,
			'excerpt-length'      	 => 50,
			'layout-blog'         	 => 3,
			'layout-search'          => 3,
			
			'typography-content'     => array( 'font-family' => 'Open Sans', 'google' => 1, 'font-size' => '14px' ),
			'typography-headers-h1'  => array( 'font-family' => 'Poppins', 	 'google' => 1, 'font-size' => '70px' ),
			'typography-headers-h2'  => array( 'font-family' => 'Poppins', 	 'google' => 1, 'font-size' => '40px' ),
			'typography-headers-h3'  => array( 'font-family' => 'Poppins',   'google' => 1, 'font-size' => '32px' ),
			'typography-headers-h4'  => array( 'font-family' => 'Poppins',   'google' => 1, 'font-size' => '24px' ),
			'typography-headers-h5'  => array( 'font-family' => 'Poppins',   'google' => 1, 'font-size' => '20px' ),
			'typography-headers-h6'  => array( 'font-family' => 'Poppins',   'google' => 1, 'font-size' => '16px' ),
			
			'styling-schema'         => 'orange',
			'body-bgcolor'   		 => '#ffffff',
			'loader-bgcolor' 		 => '#ffffff',
			
			'contact-email'          => '',
			'contact-template'       => '',
            
            'shop-sidebar'          => 0,
            'shop-columns'          => 3,
            'shop-products'         => 6			
		);
	}
	
}

add_action( 'after_setup_theme', array( 'Sena_Defaults', 'sena_initialize' ) );
