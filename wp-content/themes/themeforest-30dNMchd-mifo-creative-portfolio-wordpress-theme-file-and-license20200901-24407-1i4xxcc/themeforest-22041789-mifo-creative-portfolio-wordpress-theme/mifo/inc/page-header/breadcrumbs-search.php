<div class="rs-breadcrumbs  porfolio-details">  
  <div class="rs-breadcrumbs-inner">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="breadcrumbs-inner">        	
  	        <?php if ( have_posts() ) : ?>
    			<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'mifo' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
    			<?php else : ?>
    			<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'mifo' ); ?></h1>
    			<?php endif; ?>     
          </div>
        </div>
      </div>
    </div>
  </div>
</div>