<?php
/**
 * Template Name: Visual Builder Template
 */

get_header();

vispa_theme_header_image();

while ( have_posts() ) : the_post();
	the_content();
endwhile;

get_footer();