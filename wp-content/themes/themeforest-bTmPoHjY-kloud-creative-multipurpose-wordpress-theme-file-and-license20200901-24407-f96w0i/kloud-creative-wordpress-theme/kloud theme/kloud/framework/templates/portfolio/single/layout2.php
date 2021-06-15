<?php get_header();
    $options = get_post_meta( get_the_ID(), '_custom_pp_options', true );
 ?>   
 <div class="row pp_row">
   <div class="pp-content-vc col-lg-6">
        <?php 
        while ( have_posts() ) : the_post();
			 the_content();
        endwhile; ?>
   </div> 
    <div class="content_pp col-lg-6">
           <div class="pp_meta">
   <div class="meta_left">
        <h3 class="pp-title"><?php the_title(); ?></h3>
        <div class="category">
            <?php
            if(is_object_in_term(get_the_ID(), 'portfolio_cat')) {  
                $terms = get_the_terms( get_the_ID() , 'portfolio_cat' );  
                    foreach ( $terms as $term ) {
                        $term_link = get_term_link( $term );
                        if ( is_wp_error( $term_link ) ) {
                        continue;
                    }
                    echo '<a class="category-pp" href=" '.esc_url( $term_link ).'">' .$term->name. '<span class="spec">, </span>' . '</a>';
                }
             } ?>    
        </div>
    </div>    
      
   </div>
   <div class="pp_meta_box">
        <div class="date"><span><?php echo esc_html('Date: ' , 'kloud')?></span><?php  echo get_the_date(); ?></div>
        <?php if(isset($options['pp_client'])) : ?>
        <div class="client">
            <span><?php esc_html_e('Client:' , 'kloud'); ?> </span> <?php echo wp_kses_post($options['pp_client']);  ?>
        </div>
        <?php endif; ?>
        <?php if(isset($options['pp_type'])) : ?>
        <div class="type">
            <span><?php esc_html_e('Project Type:' , 'kloud'); ?> </span> <?php echo wp_kses_post($options['pp_type']);  ?>
        </div>
        <?php endif; ?>
        <?php if(has_tag()) :  ?>
        <div class="tags">
                <?php if( the_tags()) { ?> 
                        <span><?php esc_html_e('Tags: ' , 'kloud')   ?></span> <?php  the_tags('', ', '); ?>
                <?php } ?>
        </div>
        <?php endif; ?>
   </div>
   <?php if(isset($options['pp_description'])) : ?>
   <div class="pp_description_2">
        <?php echo wp_kses_post($options['pp_description']);  ?>
   </div>
   <?php endif; ?>
     <div class="social_pp">
            <?php echo jwstheme_social_single(); ?>
        </div>
    </div>
    </div>