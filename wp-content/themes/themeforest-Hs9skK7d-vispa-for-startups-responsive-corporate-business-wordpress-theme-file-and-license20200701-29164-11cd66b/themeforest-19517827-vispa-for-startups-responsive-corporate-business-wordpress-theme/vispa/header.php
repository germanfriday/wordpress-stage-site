<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body itemscope itemtype="http://schema.org/WebPage" <?php body_class(); ?>>
	<!-- Navigation Bar -->
	<nav class="navigation clearfix <?php vispa_theme_relative_menu(); ?>" data-become-sticky="600">
		<?php vispa_theme_type_logo(); ?>
		<div class="navigation-link visible-xs"><a href="#"></a></div>
		<?php get_template_part( 'search', 'form' ); ?>
		<?php vispa_theme_nav_menu( 'primary' ); ?>
	</nav>
	<!--/ Navigation Bar -->