<?php
//** get portfolio image
$portfolio = airtheme_get_post_meta(get_the_ID(), 'theme_meta_portfolio');
$image_lazyload = airtheme_get_option('theme_option_enable_image_lazyload');
$data_lazy = $image_lazyload ? 'true' : 'false';
$swipe_icon = airtheme_get_post_meta(get_the_ID(), 'theme_meta_project_show_swipe_icon');
if($portfolio){ ?>

    <div class="blog-unit-gallery-wrap fullscreen-wrap">
    
        <div id="ux-slider-down"></div>
        <?php airtheme_get_template_part('single/gallery/portfolioslider', 'navi'); ?>
        <?php if($swipe_icon === true) { ?>
        <div class="swipe-tips"><svg height="64px" version="1.1" viewBox="0 0 64 64" width="64px"><title/><desc/><defs/><g fill="none" fill-rule="evenodd" id="Page-1" stroke="none" stroke-width="1"><g id="700-Hamoni-Icon-(-Update-&amp;-Fix-All-200-Icon-18-4-2016-)" transform="translate(-1664.000000, -4736.000000)"><g id="THICK"><g id="Group" transform="translate(17.000000, 4490.000000)"><g transform="translate(497.000000, 247.000000)"/><g id="Shape" stroke="#5A595C" stroke-width="2" transform="translate(1152.000000, 0.000000)"><path d="M547.94,297.734 L548,281.5 C548,279.843 546.657,278.5 545,278.5 C543.343,278.5 542,279.843 542,281.5 L542,278.5 L542,278.5 C542,276.843 540.657,275.5 539,275.5 C537.343,275.5 536,276.843 536,278.5 L536,278.5 L536,275.5 C536,273.843 534.657,272.5 533,272.5 C531.343,272.5 530,273.843 530,275.5 L530,275.5 L530,265.5 C530,263.843 528.657,262.5 527,262.5 C525.343,262.5 524,263.843 524,265.5 L524,289.843 C524,290.734 522.923,291.18 522.293,290.55 L517.465,285.721 C516.295,284.551 514.392,284.551 513.222,285.721 C512.052,286.891 512.052,288.794 513.222,289.964 C513.222,289.964 523.429,299.929 527,303.5 C529.562,306.062 532.655,308.5 536.5,308.5 C542.452,308.5 547.348,303.781 547.94,297.734"/></g></g></g><g id="THIN" stroke="#5A595C" transform="translate(0.000000, 1.000000)"><path d="M1716.94,4786.734 L1717,4770.5 C1717,4768.843 1715.657,4767.5 1714,4767.5 C1712.343,4767.5 1711,4768.843 1711,4770.5 L1711,4774.5 L1711,4767.5 C1711,4765.843 1709.657,4764.5 1708,4764.5 C1706.343,4764.5 1705,4765.843 1705,4767.5 L1705,4774.5 L1705,4764.5 C1705,4762.843 1703.657,4761.5 1702,4761.5 C1700.343,4761.5 1699,4762.843 1699,4764.5 L1699,4774.5 L1699,4754.5 C1699,4752.843 1697.657,4751.5 1696,4751.5 C1694.343,4751.5 1693,4752.843 1693,4754.5 L1693,4778.843 C1693,4779.734 1691.923,4780.18 1691.293,4779.55 L1686.465,4774.721 C1685.295,4773.551 1683.392,4773.551 1682.222,4774.721 C1681.052,4775.891 1681.052,4777.794 1682.222,4778.964 C1682.222,4778.964 1692.429,4788.929 1696,4792.5 C1698.562,4795.062 1701.655,4797.5 1705.5,4797.5 C1711.452,4797.5 1716.348,4792.781 1716.94,4786.734" id="Shape"/></g><g id="THICK_LINE" stroke="#59595C" stroke-width="2" transform="translate(1.000000, 274.000000)"><g id="Group" transform="translate(11.000000, 4207.000000)"><path d="M1714,269.877 L1694,269.877" id="Shape"/><path d="M1706,277.877 L1714,269.877" id="Shape"/><path d="M1706,261.877 L1714,269.877" id="Shape"/><g id="Shape" transform="translate(1654.000000, 261.000000)"><path d="M0,8.877 L20,8.877"/><path d="M8,0.877 L0,8.877"/><path d="M8,16.877 L0,8.877"/></g></g></g></g></g></svg></div>
        <?php } ?>
        <div class="owl-carousel" data-item="1" data-center="false" data-margin="0" data-autowidth="false" data-slideby="1" data-showdot="true" data-nav="false" data-loop="false" data-lazy="<?php echo esc_attr($data_lazy); ?>">
            <?php foreach($portfolio as $image){
                $thumb = wp_get_attachment_image_src($image, 'full');
				$thumb_url = $thumb[0];
				
				$image_lazyload_style = 'data-bg="' .esc_url($thumb_url). '"';
				if(!$image_lazyload){
					$image_lazyload_style = 'style="background-image:url(' .esc_url($thumb_url). ');"';
				} ?>
                <section class="item">
                    <div class="carousel-img-wrap fullscreen-wrap ux-background-img" <?php echo wp_kses($image_lazyload_style, airtheme_shapeSpace_allowed_html()); ?>></div>
                </section>
            <?php } ?>
         </div>
    </div>
<?php } ?>