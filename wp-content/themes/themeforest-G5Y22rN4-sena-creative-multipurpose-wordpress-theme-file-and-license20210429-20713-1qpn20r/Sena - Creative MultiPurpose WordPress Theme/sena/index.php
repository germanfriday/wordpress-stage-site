<?php global $sena_config; ?>

<?php 
    $page_id = get_the_ID( );
    $subtitle = get_post_meta( $page_id, 'subtitle', true ); 
    $bg_image = ( has_post_thumbnail( $page_id ) ? esc_url( get_the_post_thumbnail_url( $page_id ) ) : '' );
?>

<?php get_header( ); ?>

<!-- Primary header -->
<section class="page-title valign parallax" 
		 data-image="<?php echo esc_url( $bg_image ); ?>"
>

	<?php if ( ! empty( $bg_image ) ) { ?>
		<div class="parallax-overlay colored"></div>
	<?php } ?>
	
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-xs-12 text-center">

				<!-- Title -->
				<h1 id="blog-title"><?php Sena_Theme::sena_page_title( ); ?></h1>
				
				<?php if ( ! empty( $subtitle ) ) : ?>
					<p class="blog-info info"><?php echo esc_html( $subtitle ); ?></p>
				<?php endif; ?>				

			</div>
		</div>
	</div>

</section>
	
<!-- Page -->
<section class="page">
	<div class="container">
		<div class="row">

			<!-- Content -->
			<div class="col-md-12">
				
				<?php if ( have_posts( ) ) : while ( have_posts( ) ) : the_post( ); ?>
					<?php the_content( ); ?>
					
					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sena' ),
							'after'  => '</div>',
							'link_before' => '',
							'link_after' => '',
							'next_or_number' => 'number',
							'pagelink' => '%',
							'echo' => 1
						) );
					?>
		
				<?php endwhile; endif; ?>
				
				<?php if ( comments_open( ) and is_singular( ) ) : ?>
					<?php comments_template( ); ?>
				<?php endif; ?>
				
			</div>

		</div>
	</div>
</section>

<?php get_footer( ); ?>