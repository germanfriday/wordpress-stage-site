<?php 
      $blog_img = cs_get_option('blog-thumbnail');
      $blog_tt = cs_get_option('blog-title'); 
      $blog_meta = cs_get_option('blog-meta');  
      $num_comments = get_comments_number();
 ?>   
<?php if($blog_img) : ?>
<div class="blog-details-img">
    <?php if (has_post_thumbnail()) the_post_thumbnail( 'jws-imge-crop-thumbnail-blog-classic'); ?>
</div>
<?php endif; ?>
<div class="blog-details">
    <?php if($blog_tt) : ?>
            <h3><?php the_title(); ?></h3>
    <?php endif; ?>
    <div class="title-and-meta ">
        
        <?php if($blog_meta) : ?>
        <div class="post-meta display_flex">
            <div class="date">
                <?php echo esc_html(get_the_date()); ?>
            </div>
            <div class="comment">
                <span class="ion-ios-chatbubble-outline"></span>
                <?php echo wp_kses_post($num_comments) ?>
            </div>
            <div class="like">
                <?php if( function_exists( 'zilla_likes') ) zilla_likes(); ?>
            </div>
            <div class="author">
                <?php esc_html_e( 'By ' , 'kloud') . the_author(); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="blog-content">
        <?php the_content(); ?>
    </div>
</div>
                        