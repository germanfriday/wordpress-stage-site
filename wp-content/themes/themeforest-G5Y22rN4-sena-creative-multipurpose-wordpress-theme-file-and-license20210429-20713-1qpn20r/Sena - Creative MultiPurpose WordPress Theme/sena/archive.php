<?php global $sena_config; ?>
<?php get_header( ); ?>

<!-- Primary header -->
<section class="page-title valign parallax" 
		 data-image="<?php echo ( ! empty( $sena_config['header-bgimage']['url'] ) ? esc_url( $sena_config['header-bgimage']['url'] ) : '' ); ?>"
>

	<?php if ( ! empty( $sena_config['header-bgimage']['url'] ) ) { ?>
		<div class="parallax-overlay colored"></div>
	<?php } ?>
	
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-xs-12 text-center">

				<!-- Title -->
				<?php if ( is_category( ) ) { ?>
					<h1 class="blog-title"><?php esc_html_e( 'Category Archive', 'sena' ); ?></h1>
					<p class="blog-info info"><?php single_cat_title(); ?></p>
				<?php } elseif ( is_tag( ) ) { ?>
					<h1 class="blog-title"><?php esc_html_e( 'Posts Tagged', 'sena' ); ?></h1>
					<p class="blog-info info"><?php single_tag_title(); ?></p>
				<?php } elseif ( is_day( ) ) { ?>
					<h1 class="blog-title"><?php esc_html_e( 'Archive', 'sena' ); ?></h1>
					<p class="blog-info info"><?php printf( get_the_date( 'F jS, Y' ) ); ?></p>
				<?php } elseif ( is_month( ) ) { ?>
					<h1 class="blog-title"><?php esc_html_e( 'Archive for month', 'sena' ); ?></h1>
					<p class="blog-info info"><?php printf( get_the_date( 'F, Y' ) ); ?></p>
				<?php } elseif ( is_year( ) ) { ?>
					<h1 class="blog-title"><?php esc_html_e( 'Archive for', 'sena' ); ?></h1>
					<p class="blog-info info"><?php printf( get_the_date( 'Y' ) ); ?></p>
				<?php } elseif ( is_author( ) ) { ?>
					<h1 class="blog-title"><?php esc_html_e( 'Author Archive', 'sena' ); ?></h1>
				<?php } elseif ( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ) { ?>
					<h1 class="blog-title"><?php esc_html_e( 'Blog Archives', 'sena' ); ?></h1>
				<?php } ?>

			</div>
		</div>
	</div>

</section>

<?php
	if ( ! is_active_sidebar( 'sidebar-primary' ) ) {
		$sena_config['layout-blog'] = 1;
	}
?>
	
<!-- Blog -->
<section class="blog">
	<div class="container">
		<div class="row">

			<?php if ( $sena_config['layout-blog'] == 3 ) : ?>
				<!-- Content -->
				<div class="col-md-8 col-sm-12 res-margin">
					<?php get_template_part( 'templates/post' ); ?>
					<?php Sena_Theme::sena_nav_content( ); ?>
				</div>

				<!-- Sidebar -->
				<div class="col-md-4 col-sm-12">
					<?php get_sidebar( ); ?>
				</div>
			<?php elseif ( $sena_config['layout-blog'] == 2 ) : ?>
				<!-- Sidebar -->
				<div class="col-md-4 col-sm-12 res-margin">
					<?php get_sidebar( ); ?>
				</div>
				
				<!-- Content -->
				<div class="col-md-8 col-sm-12">
					<?php get_template_part( 'templates/post' ); ?>
					<?php Sena_Theme::sena_nav_content( ); ?>
				</div>
			<?php else : ?>
				<!-- Content -->
				<div class="col-md-12 col-sm-12">
					<?php get_template_part( 'templates/post' ); ?>
					<?php Sena_Theme::sena_nav_content( ); ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
</section>

<?php get_footer( ); ?>