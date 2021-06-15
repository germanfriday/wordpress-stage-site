<?php 
$hide_backtop = airtheme_get_option('theme_option_hide_backtotop');
$hide_backtop_class= $hide_backtop ? 'hidden' : false;
?>
<footer id="footer" class="footer-cols-layout">

    <?php //** Template Footer Widget
	airtheme_interface_footer_widget();
	
	//** Template Footer Info
	airtheme_interface_footer_info(); ?>
    <div class="container-fluid back-top-wrap <?php echo sanitize_html_class($hide_backtop_class); ?>"><div id="back-top"></div></div>
</footer>
