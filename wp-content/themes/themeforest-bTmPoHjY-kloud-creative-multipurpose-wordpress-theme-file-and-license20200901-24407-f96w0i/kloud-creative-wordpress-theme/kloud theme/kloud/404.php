<?php
get_header(); 
$content = cs_get_option( 'image_404' );
?>
<?php $page_title = cs_get_option('golobal-enable-page-title2'); if($page_title == "1") : 
        echo jwstheme_title_bar();
endif; ?>
<div id="jws-content">
    <div class="text-inner">
		<section class="error-404 not-found">
			<div id="content-wrapper">
                <?php echo do_shortcode($content); ?>
			</div>
		</section><!-- .error-404 -->
	</div>
</div>


<?php get_footer(); ?>