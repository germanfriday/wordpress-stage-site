<?php 
  $next_post = get_next_post();
  $url_next = is_object( $next_post ) ? get_permalink( $next_post->ID ) : ''; 
  $previous_post = get_previous_post();
  $url_previous = is_object( $previous_post ) ? get_permalink( $previous_post->ID ) : '';
?>
<div class="ps-navigation">
	<ul>
	 <?php if($next_post):?>	
	  <li class="prev">
	    <a href="<?php echo esc_url( $url_next ) ?>"><i class="icon-arrows-slim-left"></i></a>
	  </li>
	  <?php endif; ?>
	  <?php if($previous_post):?>
	  <li class="next">
	    <a href="<?php echo esc_url( $url_previous ) ?>"><i class="icon-arrows-slim-right"></i></a>
	  </li>
	  <?php endif; ?>
	</ul>
	<div class="clear-fix"></div>
</div> 