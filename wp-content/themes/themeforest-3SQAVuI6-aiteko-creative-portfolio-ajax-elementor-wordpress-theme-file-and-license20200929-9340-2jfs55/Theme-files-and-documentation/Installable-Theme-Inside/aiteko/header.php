<?php
/**
 * The header for our theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Aiteko
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js <?php aiteko_use_awesome_ajax(); ?>">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'aiteko_before_header' ); ?>

<div id="aiteko-master">

	<div class="aiteko-side">

		<div class="aiteko-side-ui">

			<div class="brand">
				<?php the_custom_logo(); ?>
			</div>

			<?php
				if ( has_nav_menu( 'main' ) ) :

				print '<div class="main-menu-container-wrap">' . "\n";

					wp_nav_menu( array(
						'theme_location' 	=> 'main',
						'menu_id'        	=> 'aiteko-nav',
						'depth'				=> 2,
						'container_class'	=> 'main-menu-container',
					) );

				print '</div>' . "\n";

				endif;
			?>

			<div class="aiteko--header-footer">
				<div class="aiteko--copyright-text">
					<?php print wp_kses_post( stripslashes( get_theme_mod( 'copyright_text', '&copy;2019. Aiteko by WIP Themes.' ) ) ); ?>
				</div>
			</div>
		</div>

	</div>

	<div class="aiteko-side-handler">
		<div class="aiteko-search-button">
			<button class="aiteko-search__button" type="button">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M443.5 420.2L336.7 312.4c20.9-26.2 33.5-59.4 33.5-95.5 0-84.5-68.5-153-153.1-153S64 132.5 64 217s68.5 153 153.1 153c36.6 0 70.1-12.8 96.5-34.2l106.1 107.1c3.2 3.4 7.6 5.1 11.9 5.1 4.1 0 8.2-1.5 11.3-4.5 6.6-6.3 6.8-16.7.6-23.3zm-226.4-83.1c-32.1 0-62.3-12.5-85-35.2-22.7-22.7-35.2-52.9-35.2-84.9 0-32.1 12.5-62.3 35.2-84.9 22.7-22.7 52.9-35.2 85-35.2s62.3 12.5 85 35.2c22.7 22.7 35.2 52.9 35.2 84.9 0 32.1-12.5 62.3-35.2 84.9-22.7 22.7-52.9 35.2-85 35.2z"/></svg>
			</button>
		</div>
		<button class="aiteko-hamburger__menu hamburger hamburger--arrowalt" type="button">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</button>
		<div class="aiteko-social-follow">
			<?php aiteko_get_site_social_icons(); ?>
		</div>
	</div>

	<div class="aiteko-main">

		<div class="aiteko-content-container" id="aiteko-content-container">
