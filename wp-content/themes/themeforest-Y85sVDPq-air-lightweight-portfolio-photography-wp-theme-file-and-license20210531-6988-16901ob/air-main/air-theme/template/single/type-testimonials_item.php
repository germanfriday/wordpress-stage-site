<?php
$testimonial_cite       = airtheme_get_post_meta(get_the_ID(), 'theme_meta_testimonial_cite');
$testimonial_position   = airtheme_get_post_meta(get_the_ID(), 'theme_meta_testimonial_position');
$testimonial_link_title = airtheme_get_post_meta(get_the_ID(), 'theme_meta_testimonial_link_title');
$testimonial_link       = airtheme_get_post_meta(get_the_ID(), 'theme_meta_testimonial_link'); ?>

<div class="entry">
    <div class="testimenials">
        <i class="fa fa-quote-left"></i>
        <?php the_content(); wp_link_pages(); ?>
        
        <?php if($testimonial_cite){ ?>
            <div class="cite">
                <?php echo esc_html($testimonial_cite); ?>
                <span class="testimonial-position"><?php echo esc_html($testimonial_position); ?></span>
                <span class="testimonial-company"><a class="testimonial-link" href="<?php echo esc_url($testimonial_link); ?>"><?php echo esc_html($testimonial_link_title); ?></a></span>
            </div>
        <?php } ?>
        <div class="arrow-bg"><p class="arrow-wrap"><span class="arrow"></span></p></div>
    </div>
</div><!--End entry-->