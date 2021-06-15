<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */
?>
<?php if(has_post_thumbnail()){
?>
<?php //header style; ?>
<div class="bs-img">
  <?php the_post_thumbnail()?>
</div>
<?php
 }?>
<div class="single-content-full">
<div class="bs-info single-page-info">
  <ul class="bs-meta">
    <li><i class="fa fa-calendar"></i><span>
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
<?php
      the_content( sprintf(
        wp_kses(
          /* translators: %s: Name of current post. Only visible to screen readers */
          __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'mifo' ),
          array(
            'span' => array(
              'class' => array(),
            ),
          )
        ),
        get_the_title()
      ) );

      wp_link_pages( array(
        'before'      => '<div class="page-links">' . __( 'Pages:', 'mifo' ),
        'after'       => '</div>',
        'link_before' => '<span class="page-number">',
        'link_after'  => '</span>',
      ) );
    ?>
</div>
</div>
