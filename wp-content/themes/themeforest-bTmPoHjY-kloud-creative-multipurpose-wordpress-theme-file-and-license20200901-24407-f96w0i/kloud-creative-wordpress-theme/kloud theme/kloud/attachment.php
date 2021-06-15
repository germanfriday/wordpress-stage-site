<?php get_header(); ?>
<?php $page_title = cs_get_option('golobal-enable-page-title2'); if($page_title == "1") : 
        echo jwstheme_title_bar();
endif; ?>
	<div class="main-content">
		<div class="container">
			<div class="row">
				<?php
					if( have_posts() ) {
						while ( have_posts() ) : the_post();
							get_template_part( 'framework/templates/blog/entry-ar', get_post_format());
						endwhile;
					}else{
						get_template_part( 'framework/templates/entry', 'none');
					}
					?>
				</div>
			</div>
		</div>
<?php get_footer(); ?>