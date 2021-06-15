<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */
get_header(); ?>

  <!-- Breadcrumbs Start -->
    <?php get_template_part( 'inc/page-header/breadcrumbs-portfolio' ); 

    function cmb2_output_file_list( $file_list_meta_key, $img_size = 'medium' ) {

        // Get the list of files
        $files = get_post_meta( get_the_ID(), $file_list_meta_key, 1 );
        if(is_array($files)){
         echo '<div class="ps-image-wrap clearfix">
            <h3 class="p-gallery-title">'.esc_html__('Project Gallery', 'mifo').'</h3>';
       
        echo '<div class="file-list-wrap row">';

        // Loop through them and output an image
        foreach ( (array) $files as $attachment_id => $attachment_url ) {
           
            echo '<div class="col-md-3"><div class="file-list-image">';
            echo wp_get_attachment_image( $attachment_id, $img_size );
            echo '<a class="image-popup p-zoom" href="'.$attachment_url.'"><i class="fa fa-search"></i></a>';
            echo '</div></div>';
        }
        echo '</div></div>';
      }
    }   
?>
  <!-- Breadcrumbs End --> 
  <div class="container">
    <div id="content">
      <!-- Portfolio Detail Start -->
      <div class="rs-porfolio-details">
    <div class="container">
      <?php while ( have_posts() ) : the_post();
			 $post_created = get_post_meta( get_the_ID(), 'created', true );
			 $post_date = get_post_meta( get_the_ID(), 'date', true );
			 $post_client = get_post_meta( get_the_ID(), 'client', true );
			 $post_skills = get_post_meta( get_the_ID(), 'skills', true );
			 $post_demo = get_post_meta( get_the_ID(), 'demo', true );
	  ?>
      <div class="ps-image-wrap clearfix">
        <div class="ps-image">
            <?php the_post_thumbnail(); ?>
        </div>
        <?php if($post_created||$post_date||$post_client||$post_skills||$post_demo){ ?>
        <div class="ps-informations">
            <h3 class="info-title"><?php esc_html_e('Portfolio Information','mifo');?></h3>
            <ul>
              <?php if($post_created){?>
              <li><span><?php esc_html_e('Created by:','mifo');?> </span><?php echo esc_html($post_created); ?></li>
              <?php }?>
              <?php if($post_date){?>
              <li><span><?php esc_html_e('Date:','mifo');?>  </span><?php   echo esc_html($post_date); ?></li>
              <?php }?>
              <?php if($post_skills){?>
              <li><span><?php esc_html_e('Skills:','mifo');?>  </span><?php  echo esc_html($post_skills); ?></li>
              <?php }?>
              <?php if($post_client){?>
              <li><span><?php esc_html_e('Client:','mifo');?>  </span><?php   echo esc_html($post_client); ?></li>
              <?php }?>
              <?php if($post_demo){?>
              <li><span><?php esc_html_e('Demo:','mifo');?>
              </span><a target="_blank" href="<?php  echo esc_url($post_demo); ?>"><?php esc_html_e('See Demo','mifo');?></a></li>
              <?php }?>
            </ul>
        </div>
        <?php } ?>
      </div>

      <div class="project-desc">
      
        <?php the_content(); ?>
      </div>

       
            <?php cmb2_output_file_list( 'Screenshot', 'small' ); ?>
      
      <?php endwhile; ?>      
      <?php
          get_template_part( 'pagination' );
      ?>          
      <!-- .ps-navigation -->  

     
      <!-- end custom related loop -->
      
    </div>
      </div>
    </div>
</div>
<!-- Portfolio Detail End -->
<?php
get_footer();