<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */
?>

<?php if(has_post_thumbnail()):
?>
	<div class="bs-img">
	  <?php the_post_thumbnail()?>
	</div>
<?php
endif;?>
<div class="single-content-full">
<div class="bs-info">
  <ul class="bs-meta">
    <li><i class="fa fa-clock-o"></i><span>
      <?php $post_date = get_the_date(); echo esc_attr($post_date);?>
      </span></li>
    <li><i class="fa fa-user"></i>
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
 <div class="bs-desc">
	<?php if ( is_single() || '' === get_the_post_thumbnail() ) {

		// Only show content if is a single post, or if there's no featured image.
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
		) 
	 );

	};
?>
</div>
</div>