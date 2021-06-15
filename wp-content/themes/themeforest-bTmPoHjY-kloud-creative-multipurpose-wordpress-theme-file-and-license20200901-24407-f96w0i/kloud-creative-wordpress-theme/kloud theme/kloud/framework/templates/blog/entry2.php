 <?php 
global $kloud_loop;
$num_comments = get_comments_number(); 
?>             
<?php if($kloud_loop[ 'thumbnail_show']=='1' ) : ?>
<div class="bog-image">
    <a href="<?php the_permalink() ?>">
        <?php echo kloud_get_post_thumbnail( 'large'); ?>
    </a>
    <div class="link_content">
        <a href="<?php the_permalink(); ?>"><span class="ion-ios-arrow-thin-right"></span></a>
    </div>
</div>
<?php endif; ?>
<div class="content-blog <?php if($kloud_loop[ 'thumbnail_show'] != '1') echo " border_top "; ?>">
    <div class="content-inner">
        <div class="blog-innfo"> <span class="child"><?php  echo get_the_date(); ?></span>
        </div>
        <div class="title">
            <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
        </div>
        <div class="blog-excrept">
            <?php the_excerpt(); ?>
        </div>
        <div class="blog-bottom display_flex">
            <div class="comment"><span class="ion-ios-chatbubble-outline"></span>
                <?php echo wp_kses_post($num_comments)?>
            </div>
            <?php if($kloud_loop[ 'review']=='1' ) : ?>
            <div class="review"><span class="ion-ios-eye-outline"></span>
                <?php echo getPostViews(get_the_ID());?>
            </div>
            <?php endif; ?>
            <?php if($kloud_loop[ 'like']=='1' && function_exists( 'zilla_likes')  ) : ?>
            <div class="like">
                <?php zilla_likes(); ?>
            </div>
            <?php endif; ?>
            <div class="author"><span class="child"><?php esc_html_e('By ', 'kloud'); ?></span>
                <?php the_author() ?>
            </div>
            <div class="share">
                <div class="action_ahare">
                    <span class="ion-android-share-alt"></span>
                </div>
                <?php echo jwstheme_social(); ?>
            </div>
        </div>

    </div>
</div>
