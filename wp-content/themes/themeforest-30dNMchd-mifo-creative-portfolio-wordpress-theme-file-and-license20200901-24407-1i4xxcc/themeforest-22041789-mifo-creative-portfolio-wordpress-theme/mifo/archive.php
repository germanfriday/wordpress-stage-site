<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

get_header(); ?>
<?php get_template_part( 'inc/page-header/breadcrumbs-archive'); ?>
<div class="container">
  <div id="content">
    <div class="rs-archive">
      <div class="row">
        <div class="col-md-9">
          <?php
          		if ( have_posts() ) :
          		?>                
          <?php
        			/* Start the Loop */
        			while ( have_posts() ) : the_post();
    		  ?>
              <div class="col-sm-12 col-xs-12 archive-post">
                <div class="archive-item">
                    <div class="row">
                        <?php if ( has_post_thumbnail() ) {	?>
                          <div class="col-md-5">
                            <div class="blog-item">
                              <div class="blog-img">
                                <a class="blog-link" href="<?php the_permalink();?>" title="<?php the_title();?>">
                                    <?php the_post_thumbnail(); ?>
                                </a>
                              </div>
                            </div>
                             </div>
                        <?php
                               $col_archive='7';
                          }
                            else{
                                $col_archive='12';
                            }?>
                          <div class="col-md-<?php echo esc_attr($col_archive);?>">
                            <div class="blog-desc">
                                <div class="blog-img-content">
                                    <h3 class="blog-title">
                                      <a href="<?php the_permalink();?>" title="<?php the_title();?>">
                                        <?php the_title();?>
                                      </a>
                                    </h3>
                                    <div class="blog-meta">
                                      <div class="blog-date">
                                        <i class="fa fa-calendar"></i>
                                        <?php the_time('F j, Y');?>
                                        <span class="author"> <i class="fa fa-user"></i>
                                        <?php the_author();?>
                                        </span> 
                                      </div>                    
                                    </div>
                                </div>
                              <?php the_excerpt();?>
                              <a href="<?php the_permalink();?>" class="readmore"><?php esc_html_e('Read More', 'mifo');?> <i class="fa fa-angle-right"></i></a>
                            </div>
                          </div>                        
                    </div>
                </div>
            </div>
          <?php  
            endwhile;   
		  ?>

            <div class="pagination-area">
            <?php
                the_posts_pagination();
            ?>
            </div><!-- .pagination-area -->

          <?php
    		  else :
    		    get_template_part( 'template-parts/content', 'none' );
    		  endif; ?>
        </div>
          <?php
            get_sidebar();
          ?>
      </div>
    </div>
  </div>
</div>
<?php
get_footer();