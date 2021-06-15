<?php get_header(); ?>
<?php echo jwstheme_title_bar(); ?>
	<div class="main-content">
		<div class="container">
            <div class="kloud-blog-holder jws-masonry border-bottom row" data-masonry='{"selector":".post-item ", "columnWidth":".grid-sizer","layoutMode":"packery"}'>  
			     <div class="grid-sizer size-4"></div>
            	<?php
					if( have_posts() ) {
						while ( have_posts() ) : the_post();
                        ?> <div class="post-item layout-2 <?php if(is_sticky()) echo 'sticky' ?>  col-lg-4 col-md-4 col-sm-6 col-xs-12"><?php
						get_template_part( 'framework/templates/blog/entry-ar', get_post_format());
                        ?></div><?php
						endwhile;
					}else{
						get_template_part( 'framework/templates/entry', 'none');
					}
					?>
				</div>
			</div>
		</div>
<?php get_footer(); ?>