<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */
get_header(); ?>
<?php 
global $rs_option;
get_template_part( 'inc/page-header/breadcrumbs-blog' ); ?>
<div class="rs-blog">
    <div class="container">
        <div id="content">
          <div class="row">
            <?php
                //checking blog layout form option  
                $col='';
                $blog_layout=''; 
                $column=''; 
                $blog_grid='';
                if(!empty($rs_option['blog-layout']))
                  {
                    $blog_layout=($rs_option['blog-layout']);
                    $blog_grid=$rs_option['blog-grid'];
                    if($blog_layout == 'full')
                      {
                         $layout ='full-layout';
                         $col = '-full';
                         $column = 'sidebar-none';  
                      } 
                      
                    elseif($blog_layout == '2left')
                      {
                         $layout = 'full-layout-left';  
                      }
                
                    elseif($blog_layout == '2right')
                      {
                         $layout = 'full-layout-right'; 
                      } 
                    else{
                      $col = '';
                      $blog_layout = ''; 
                    }
                  }
                  else{
                    $col='';
                    $blog_layout=''; 
                    $layout='';
                    $blog_grid='';
                  }
                ?>
            <div class="col-md-9<?php echo esc_attr($col); ?> <?php echo esc_attr($layout); ?>"> 
              <?php
              if ( have_posts() ) :           
                /* Start the Loop */
                while ( have_posts() ) : the_post();      
              ?>
               <article <?php post_class(); ?>>
                <div class="row">
                  <div class="col-sm-<?php echo esc_attr($blog_grid);?> col-xs-12">
                    <div class="blog-item">
                      <?php if ( has_post_thumbnail() ) {?>
                        <div class="blog-img">
                          <?php
                            the_post_thumbnail();
                          ?>
                          <div class="blog-img-content">
                            <div class="display-table">
                              <div class="display-table-cell">
                                <a class="blog-link" href="<?php the_permalink();?>">
                                  <i class="fa fa-link"></i>
                                </a>               
                              </div>
                            </div>
                          </div>       
                        </div><!-- .blog-img -->
                      <?php
                        }       
                      ?>
                      <div class="full-blog-content">
                        <div class="blog-meta">
                          <h3 class="blog-title"><a href="<?php the_permalink();?>">
                            <?php the_title();?>
                            </a>
                          </h3> 
                          <div class="blog-date"> <i class="fa fa-calendar"></i>
                            <?php $post_date = get_the_date(); echo esc_attr($post_date);?>
                            <span class="author"> <i class="fa fa-user"></i>
                            <?php the_author();?>
                            </span></div>                          
                        </div>
                        <div class="blog-desc">   
                          <?php the_excerpt();?>            
                        </div>                      

                    </div>

                      <ul class="btm-cate">
                         <?php if(get_the_category()){?>
                            <li class="category-name"><i class="fa fa-folder-open-o"></i>
                              <?php the_category(', '); 
                            ?>
                          </li>
                     <?php }?>
                      
                          <?php 
                           if(has_tag()):
                            ?>
                            <li>
                              <?php
                               //tag add
                                  $seperator = ', '; // blank instead of comma
                                  $after = '';
                                  $before = '';
                                  echo '<div class="tag-line">';
                                  the_tags( $before, $seperator, $after );
                                  echo '</div>';
                                  ?>
                              </li>
                              <?php
                              endif;
                           ?>                     
                    </ul>
                  </div>
                </div>
              </div>
            </article>
              <?php  
              endwhile;   
              ?>
              <div class="pagination-area">
                <?php
                    the_posts_pagination();
                  ?>
              </div>
              <?php
              else :
              get_template_part( 'template-parts/content', 'none' );
              endif; ?> 
          </div>
          <?php if( $layout != 'full-layout' ):     
             get_sidebar();    
           endif;
          ?>
        </div>  
    </div>
</div>
<?php
get_footer();