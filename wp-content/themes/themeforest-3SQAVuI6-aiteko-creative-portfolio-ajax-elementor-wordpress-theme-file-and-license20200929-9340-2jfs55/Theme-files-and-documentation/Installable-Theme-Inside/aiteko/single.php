<?php
/**
 * The template for displaying single post
 *
 * @package WordPress
 * @subpackage Aiteko
 * @since 1.0
 */

get_header();

get_template_part( 'template-parts/single/layout', aiteko_get_single_post_layout() );

get_footer();
