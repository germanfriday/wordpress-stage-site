      <?php //** Do Hook Footer
	  /**
	   * @hooked  airtheme_interface_footer - 10
	   * @hooked  airtheme_pb_module_portfolio_ajaxwrap - 30
	   */
	  do_action('airtheme_interface_footer'); ?>

      <?php //** Do Hook Content after
      /**
       * @hooked  airtheme_interface_content_after - 10
       */
      do_action('airtheme_interface_content_after'); ?>
	  
	  <?php //** Do Hook Wrap after
	  /**
	   * @hooked  airtheme_interface_wrap_outer_after - 10
	   * @hooked  airtheme_interface_wrap_border - 13
	   * @hooked  airtheme_interface_photoswipe - 20
	   */
	  do_action('airtheme_interface_wrap_after'); ?>

	  <?php wp_footer(); ?>

  </body>
</html>