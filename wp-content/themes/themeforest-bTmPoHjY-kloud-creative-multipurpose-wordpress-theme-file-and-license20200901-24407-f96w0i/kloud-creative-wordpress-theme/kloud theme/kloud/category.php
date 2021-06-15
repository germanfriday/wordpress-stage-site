<?php get_header(); ?>
<?php $page_title = cs_get_option('golobal-enable-page-title2'); if($page_title == "1") : 
        echo jwstheme_title_bar();
endif; ?>
	<div class="main-content">
		<div class="container">
            <div class="kloud-blog-holder jws-masonry border-bottom row" data-masonry='{"selector":".post-item ", "columnWidth":".grid-sizer","layoutMode":"packery"}'>  
			     <div class="grid-sizer size-4"></div>
            	<?php
					if( have_posts() ) {
						while ( have_posts() ) : the_post();
						get_template_part( 'framework/templates/blog/home/entry', get_post_format());
						endwhile;
					}else{
						get_template_part( 'framework/templates/entry', 'none');
					}
					?>
				</div>
			</div>
		</div>
<?php get_footer(); ?>