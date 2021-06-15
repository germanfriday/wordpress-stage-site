<?php get_header();
$options = get_post_meta( get_the_ID(), '_custom_pp_options', true );
$layout = "";
if( !isset($options['pp-single-style'])) {
  $layout = cs_get_option('pp-single-style');  
}else {
  $layout = $options['pp-single-style'];  
}
 ?>
<?php $page_title = cs_get_option('golobal-enable-page-title2'); if($page_title == "1") : 
        echo jwstheme_title_bar();
endif; ?>
<div class="container portfolio-single <?php echo esc_attr($layout); ?>">
        <?php get_template_part( 'framework/templates/portfolio/single/'.$layout.'' );  ?>
   <div class="nav-post display_flex">
        <?php 
            $prev_post = get_previous_post(); $next_post = get_next_post();    
                if(!empty($prev_post)):
                                ?><div class="nav-box previous"><?php
                                   echo '<a href="'.get_the_permalink($prev_post->ID).'" >'.'<div class="text-nav display_flex"><span class="ion-ios-arrow-thin-left"></span><p><span class="prev">'.esc_html('Previous Post' , 'kloud').'</span>'.get_the_title($prev_post->ID).'</p></div></a>';  
                                ?></div> <?php    
                              endif;
                            if(!empty($next_post)):
                                ?><div class="nav-box next"><?php
                                   echo '<a href="'.get_the_permalink($next_post->ID).'" ><div class="text-nav display_flex"><p><span class="next-bt">'.esc_html('Next Post' , 'kloud').'</span>'.get_the_title($next_post->ID).'</p><span class="ion-ios-arrow-thin-right"></span></div></a>';  
                                ?></div> <?php   
                 endif;
                ?>              
    </div> 
     <div class="icon-get-link"><a href="<?php echo esc_url(home_url('/')); ?>"><span class="ion-android-menu"></span></a></div>
    <div class="related_pp ">
       <?php echo jws_related_post(); ?> 
    </div>                
</div>

<?php get_footer(); ?>