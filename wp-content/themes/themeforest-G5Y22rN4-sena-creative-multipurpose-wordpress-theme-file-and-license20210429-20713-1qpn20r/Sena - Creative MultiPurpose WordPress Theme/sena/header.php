<?php global $sena_config; ?>
<?php $isFrontPage = Sena_Theme::sena_is_front_page( get_the_ID( ) ); ?>

<!DOCTYPE html>
<html class="no-js <?php echo ( is_admin_bar_showing( ) ? 'wp-bar' : '' ); ?>" <?php language_attributes( ); ?>>
	
	<head>
		
		<!-- Meta -->
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
		<link rel="profile" href="https://gmpg.org/xfn/11" />
		
		<?php wp_head( ); ?>
		
	</head>
	
	<body <?php body_class( ); ?>>
		<?php wp_body_open( ); ?>
		
		<?php 
			$logo_dark = ! empty( $sena_config['logo-dark']['url'] ) ? $sena_config['logo-dark']['url'] : get_template_directory_uri( ) . '/images/logo/logo.png';
			$logo_light = ! empty( $sena_config['logo-light']['url'] ) ? $sena_config['logo-light']['url'] : get_template_directory_uri( ) . '/images/logo/logo.png';
		?>
	
		<?php if ( $sena_config['preloader'] or $sena_config === null ) { ?>
			<?php if ( ( $sena_config['preloader-only-home'] and $isFrontPage ) or ! $sena_config['preloader-only-home'] or $sena_config == null ) { ?>
				<!-- Loader -->
				<div class="page-loader">
					<div class="text-center loader-middle">
						<div class="loading-spinner"></div>
					</div>
				</div>
			<?php  } ?>
		<?php  } ?>
		
		<!-- Navigation bar -->
		<div class="navbar<?php echo ( isset( $sena_config['fixed-navbar'] ) ? ' fixed' : '' ); ?>" role="navigation">
			<div class="container">

				<div class="navbar-header">

					<!-- Menu for Tablets / Phones -->
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<!-- Logo -->
					<a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>">
						<img src="<?php echo esc_url( $logo_light ); ?>" data-alt="<?php echo esc_url( $logo_dark ); ?>" alt="<?php bloginfo('name'); ?>" data-rjs="2">
					</a>

				</div>

				<div class="collapse navbar-collapse" id="navbar-collapse">
					
					<?php 
                        $search_icon = false;
                        $shop_icon = false;                        
                    
                        if ( $sena_config['search-icon'] || $sena_config === null ) {
                            $search_icon = true;
                        }

                        if ( class_exists( 'WooCommerce' ) && 
                           ( sena_is_woocommerce_page() || $sena_config['shop-icon'] || $sena_config === null ) ) {
                            $shop_icon = true;
                        }
                    
                        if ( $search_icon || $shop_icon ) {
                    ?>
						<!-- Icons -->
						<div class="navbar-icon">
                            <?php if ( $shop_icon ) { ?>
                                <div class="cart-open">
                                    <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="navbar-shopping-bag">
                                        <i class="fas fa-shopping-bag"></i>
                                    </a>
                                    
                                    <span class="cart-number"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                                    
                                    <div class="shopping-cart">
                                        <?php woocommerce_mini_cart(); ?>
                                    </div>
                                </div>
                            <?php } ?>
                            
                            <?php if ( $search_icon ) { ?>
							    <a href="#" class="navbar-search"><i class="fas fa-search"></i></a>
                            <?php } ?>
						</div>
					<?php } ?>

					<!-- Items -->
					<?php echo Sena_Theme::sena_main_menu( get_the_ID( ), 'nav navbar-nav navbar-right' ); ?>

				</div>

			</div>
		</div>
		
		<?php if ( $sena_config['search-icon'] or $sena_config === null ) { ?>
			<!-- Search wrapper -->
			<div class="search-wrapper">

				<!-- Search form -->
				<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url() ); ?>">

					<input type="search" name="s" id="s"
						   placeholder="<?php esc_html_e('Search Keyword', 'sena'); ?>"
						   class="searchbox-input" autocomplete="off" required />

					<span>
						<?php esc_html_e( 'Input your search keywords and press Enter.', 'sena' ); ?>
					</span>

				</form>

				<!-- Close button -->
				<div class="search-wrapper-close">
					<a href="#" class="search-close-btn"></a>
				</div>

			</div>
		<?php } ?>
		