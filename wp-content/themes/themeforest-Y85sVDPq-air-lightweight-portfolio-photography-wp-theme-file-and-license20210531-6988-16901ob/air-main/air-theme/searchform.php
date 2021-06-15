<?php  $enter_key =  esc_html__('Search','air-theme'); ?>
<form id="searchform" name="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">	
<input type="text" onBlur="if (this.value == '') {this.value = '<?php echo esc_attr($enter_key); ?>';}" onFocus="if (this.value == '<?php echo esc_attr($enter_key); ?>') {this.value = '';}" name="s" value="<?php echo esc_attr($enter_key); ?>">
</form>
