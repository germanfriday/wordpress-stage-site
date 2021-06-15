<?php $vispa_search_enable = function_exists('fw_get_db_settings_option') ? fw_get_db_settings_option( 'enable_header_search', 'yes' ) : 'no'; ?>

<?php if ( $vispa_search_enable == 'yes' ): ?>
	<div class="search">
		<a href="#" class="fa fa-search form-search-open"></a>

		<!-- Search Form -->
		<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="form-search-header" method="get">
			<div class="inner">
				<div class="row">
					<div class="col-sm-8">
						<input type="search" name="s" class="form-control" placeholder="<?php esc_html_e( 'Type Keywords', 'vispa' ); ?>"/>
					</div>

					<div class="col-sm-4">
						<input type="submit" name="site-search-submit" class="btn btn-wide" value="<?php esc_html_e( 'search', 'vispa' ); ?>"/>
					</div>
				</div>
			</div>
		</form>
		<!--/ Search Form -->
	</div>
<?php endif; ?>