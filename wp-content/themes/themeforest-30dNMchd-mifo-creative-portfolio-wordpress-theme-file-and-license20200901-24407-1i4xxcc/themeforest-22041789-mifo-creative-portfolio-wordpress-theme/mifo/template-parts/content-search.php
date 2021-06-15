<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>  
  <header class="entry-header">
    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
    </header>
    <!-- .entry-header -->
    
    <div class="entry-summary">
      <?php the_excerpt(); ?>
        <div class="blog-button">
            <a href="<?php the_permalink()?>" class="readmore"><?php echo esc_html_e('Read More','mifo');?> <i class="icon-arrows-slim-right"></i></a>
          </div>
      </div>
    <!-- .entry-summary -->
    
    <footer class="entry-footer">
      <?php mifo_entry_footer(); ?>
    </footer>
    <!-- .entry-footer --> 
</article>
