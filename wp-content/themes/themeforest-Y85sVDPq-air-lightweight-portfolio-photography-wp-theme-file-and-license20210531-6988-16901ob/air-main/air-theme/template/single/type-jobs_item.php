<?php 
$jobs_location = airtheme_get_post_meta(get_the_ID(), 'theme_meta_jobs_location');
$jobs_number   = airtheme_get_post_meta(get_the_ID(), 'theme_meta_jobs_number'); 
?>

<div class="entry"><?php the_content(); wp_link_pages(); ?></div><!--End entry-->

<div class="job-info">
    <?php if($jobs_location){ ?>
        <span class="job-location"><?php echo esc_html__('Location:','air-theme'). ' ' .esc_html($jobs_location); ?></span>
    <?php }
    
    if($jobs_number){ ?>
        <span class="job-number"><?php echo esc_html__('Number:','air-theme'). ' ' .esc_html($jobs_number); ?></span>
    <?php } ?>
</div>