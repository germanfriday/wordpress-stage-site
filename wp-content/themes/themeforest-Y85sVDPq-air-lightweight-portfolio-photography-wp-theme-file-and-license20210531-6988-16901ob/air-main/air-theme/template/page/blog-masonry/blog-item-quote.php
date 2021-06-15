<section class="grid-item grid-item-audio">
    <div class="grid-item-inside">
        <div class="grid-text-wrap">
            <?php 
			$airtheme_quote = airtheme_get_post_meta(get_the_ID(), 'theme_meta_quote');
			$airtheme_quote_cite = airtheme_get_post_meta(get_the_ID(), 'theme_meta_quote_cite'); 
	
			if ($airtheme_quote) { ?>
			
			<div class="blog-unit-quote"><?php echo wp_kses_post($airtheme_quote); ?>
				<?php if($airtheme_quote_cite) { ?>
				<cite><span class="cite-line"></span> <?php echo wp_kses_post($airtheme_quote_cite); ?></cite>
				<?php } 
				?> 
			</div>
	
			<?php } ?>
        </div>
    </div>
</section>