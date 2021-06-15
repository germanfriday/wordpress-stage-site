<?php
$visible = 'visible';

//** enable page loading
$airtheme_enable_fadein_effect = airtheme_get_option('theme_option_enable_fadein_effect');

if($airtheme_enable_fadein_effect){ ?>
<div class="page-loading fullscreen-wrap <?php echo esc_attr($visible); ?>">
    <div class="page-loading-inn">
        <div class="page-loading-transform">
            <?php airtheme_interface_logo('loading'); ?>
        </div>
    </div>
</div>
<?php } ?>