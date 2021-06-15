<?php get_header(); ?>
<?php echo jwstheme_title_bar();  ?>
	<div class="main-content ro-container">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>
			<div style="clear: both;"></div>

				
					<?php //if ( comments_open() || get_comments_number() ) comments_template(); ?>
				


		<?php endwhile; // end of the loop. ?>
	</div>
<?php get_footer(); ?>