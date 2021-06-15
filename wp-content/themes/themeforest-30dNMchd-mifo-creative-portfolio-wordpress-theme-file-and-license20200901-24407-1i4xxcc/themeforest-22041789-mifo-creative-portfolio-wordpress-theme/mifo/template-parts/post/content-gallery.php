<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
	if ( is_sticky() && is_home() ) {
		echo mifo_get_svg( array( 'icon' => 'thumb-tack' ) );
	}
	?>
	<div class="single-content-full">
	<div class="gallery-post-tp">
	<div class="bs-info single-page-info">

	  <ul class="bs-meta">
	    <li><i class="fa fa-calendar"></i><span>
	      <?php $post_date = get_the_date(); echo esc_attr($post_date);?>
	      </span>
	  </li>
	    <li>
	    	<i class="fa fa-user"></i>
	      	<?php the_author(); ?>
	     </li>
	    <?php if(get_the_category()){?>
	        <li class="category-name"><i class="fa fa-folder-open-o"></i>
	          <?php the_category(', '); 
	        ?>
	      </li>
	 <?php }?>
	  </ul> 
</div>  

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() && ! get_post_gallery() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'mifo-featured-image' ); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="entry-content">

		<?php
		if ( ! is_single() ) {

			// If not a single post, highlight the gallery.
			if ( get_post_gallery() ) {
				echo '<div class="entry-gallery">';
					echo get_post_gallery();
				echo '</div>';
			};

		};

		if ( is_single() || ! get_post_gallery() ) {

			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'mifo' ),
				get_the_title()
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'mifo' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );

		};
		?>

	</div><!-- .entry-content -->

	<?php
	if ( is_single() ) {
		//mifo_entry_footer();
	}
	?>
</div>
</div>
</article><!-- #post-## -->
