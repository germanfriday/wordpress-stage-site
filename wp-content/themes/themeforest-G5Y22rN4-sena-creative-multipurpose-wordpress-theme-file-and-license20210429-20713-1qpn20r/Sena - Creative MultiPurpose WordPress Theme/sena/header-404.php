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
	
	<body <?php body_class( ); ?> >
		<?php wp_body_open( ); ?>
	
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