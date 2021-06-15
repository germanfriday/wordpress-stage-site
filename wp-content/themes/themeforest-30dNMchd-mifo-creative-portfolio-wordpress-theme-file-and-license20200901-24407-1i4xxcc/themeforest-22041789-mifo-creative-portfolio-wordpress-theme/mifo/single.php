<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

get_header();
get_template_part( 'inc/page-header/breadcrumbs-single' ); ?>
<div class="container"> 
  <div id="content">
  <!-- Blog Detail Start -->
    <div class="rs-blog-details">
      <div class="row">
        <div class="col-md-9">
          <?php
           while ( have_posts() ) : the_post();
          ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <?php
                get_template_part( 'template-parts/post/content', get_post_format() );               
              ?>
              <div class="clear-fix"></div>
              <?php 
              if(has_tag()){
             //tag add
                $seperator = ','; // blank instead of comma
                $after = '';
                echo '<div class="tag-line"><i class="fa fa-tag"></i>';
                esc_html( 'Tags: ', 'mifo' );
                the_tags( '', $seperator, $after );
                echo '</div>';
               }?>    
          </article>
          <?php
            get_template_part( 'pagination');
          ?>          
          <!-- .ps-navigation -->          
          <?php          
            $author_meta = get_the_author_meta('description'); 
            if( !empty($author_meta) ){
            ?>
              <div class="author-block">
                <div class="author-img"> <?php echo get_avatar(get_the_author_meta( 'ID' ), 200);?> </div>
                <div class="author-desc">
                  <h3 class="author-title">
                    <?php the_author();?>
                  </h3>
                  <p>
                    <?php   
                      echo wpautop( get_the_author_meta( 'description' ) );
                    ?>
                  </p>
                  <a href="<?php echo esc_url(get_the_author_meta('user_url'))?>" target="_blank">
                    <?php echo esc_url(get_the_author_meta( 'user_url'))?></a> 
                  </div>
              </div>
              <!-- .author-block -->
              <?php }
          ?>
          <?php 
            $blog_author = '';
            if($blog_author == ""){
              if ( comments_open() || get_comments_number() ) :
              comments_template();
            endif;
            }
            else
            {
              $blog_author = $rs_option['blog-comments'];
              if($blog_author == 'show'){     
              // If comments are open or we have at least one comment, load up the comment template.
              if ( comments_open() || get_comments_number() ) :
                comments_template();
              endif;
              }
            }
          endwhile; // End of the loop.
          ?>
        </div>
        <?php
          get_sidebar();
        ?>      
      </div>
    </div>
  <!-- Blog Detail End --> 
  </div>
</div>
<!-- .container -->
<?php
get_footer();