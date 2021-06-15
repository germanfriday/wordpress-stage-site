<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12">

		<!-- Section title -->
		<div class="section-title text-center">
			<h2>
				<?php esc_html_e( 'Nothing Found', 'sena' ); ?>
			</h2>
		</div>

	</div>
</div>


<p>
	<?php esc_html_e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'sena' ); ?>
</p>

<div class="row search-wrapper">
	<div class="col-md-12">
		
		<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<input type="text" class="search-field" placeholder="<?php esc_attr_e( 'Search &hellip;', 'sena' ); ?>" value="" name="s" title="<?php esc_attr_e( 'Search for:', 'sena' ); ?>" />
			<input type="submit" class="search-submit" value="<?php esc_attr_e( 'Search', 'sena' ); ?>" />
		</form>
		
	</div>
</div>