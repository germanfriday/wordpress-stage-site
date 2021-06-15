 <?php 
global $kloud_loop;
$num_comments = get_comments_number(); 
?>  
<div class="top display_flex">          
<?php if($kloud_loop[ 'thumbnail_show']=='1' ) : ?>
<div class="bog-image">
    <a href="<?php the_permalink() ?>">
        <?php echo kloud_get_post_thumbnail( 'large'); ?>
    </a>
</div>
<?php endif; ?>
<div class="content-blog <?php if($kloud_loop[ 'thumbnail_show'] != '1') echo " border_top "; ?>">
    <div class="content-inner">
        
        <div class="title">
            <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
        </div>
       <div class="blog-innfo"> <span class="child"><?php  echo get_the_date(); ?></span>
        </div>
        <div class="blog-bottom display_flex">
            <div class="author"><span class="child"><?php esc_html_e('By ', 'kloud'); ?></span>
                <?php the_author() ?>
            </div>
            <div class="comment"><span class="ion-ios-chatbubble-outline"></span>
                <?php echo wp_kses_post($num_comments)?>
            </div>
        </div>
         <div class="blog-excrept">
            <?php the_excerpt(); ?>
        </div>
    </div>
</div>
</div>
<div class="link_content">
        <a href="<?php the_permalink(); ?>"><?php  echo esc_attr($kloud_loop[ 'readmore_text'] );  ?></a><span class="ion-ios-arrow-thin-right"></span>
</div>