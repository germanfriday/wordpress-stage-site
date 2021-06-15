<?php global $sena_config; ?>
<?php get_header( ); ?>

<?php 
	if ( have_posts( ) ) : 
		while ( have_posts( ) ) : 
		the_post( );

		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID( ) ), 'full' );
		$bg = $thumb[0];
?>
	<!-- Primary header -->
	<section id="post-<?php the_ID(); ?>" class="page-title valign parallax" 
			 data-image="<?php echo esc_url( $bg ); ?>"
	>	
		
		<div class="parallax-overlay colored"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">

					<!-- Category -->
					<div class="blog-category">
						<?php the_category(' <span>/</span> '); ?>
					</div>

					<!-- Title -->
					<h1 id="share-title" class="blog-title">
						<?php the_title( ); ?>
					</h1>

					<!-- Date -->
					<div class="blog-date">
						<?php echo get_the_time( get_option( 'date_format' ) ); ?>
					</div>

				</div>
			</div>
		</div>
		
	</section>
<?php endwhile; endif; ?>

<?php
	if ( ! is_active_sidebar( 'sidebar-primary' ) ) {
		$sena_config['layout-blog'] = 1;
	}
?>

<!-- Content -->
<section class="blog">
	<div class="container">
		<div class="row">
			
			<?php if ( $sena_config['layout-blog'] == 3 ) : ?>
				<!-- Single Post -->
				<div class="col-md-8 col-sm-12 res-margin">
					<?php get_template_part( 'templates/post' ); ?>
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
				
				<!-- Single Post -->
				<div class="col-md-8 col-sm-12">
					<?php get_template_part( 'templates/post' ); ?>
				</div>
			<?php else : ?>
				<!-- Single Post -->
				<div class="col-md-12 col-sm-12">
					<?php get_template_part( 'templates/post' ); ?>
				</div>
			<?php endif; ?>
			
		</div>
	</div>
</section>

<?php get_footer( ); ?>