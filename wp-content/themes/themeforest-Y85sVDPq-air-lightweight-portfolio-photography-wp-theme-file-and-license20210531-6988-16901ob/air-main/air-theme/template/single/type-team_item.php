<?php
$team_position      = airtheme_get_post_meta(get_the_ID(), 'theme_meta_team_position');
$team_position      = $team_position;
$team_email         = airtheme_get_post_meta(get_the_ID(), 'theme_meta_team_email');
$team_email         = $team_email;
$team_phone_number  = airtheme_get_post_meta(get_the_ID(), 'theme_meta_team_phone_number');
$team_social_medias = airtheme_get_post_meta(get_the_ID(), 'theme_meta_team_social_medias');

if(has_post_thumbnail()){
    echo '<div class="team-photo-wrap">';
	echo get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'team-photo'));
    echo '</div>';
} ?><div class="entry"><?php the_content(); wp_link_pages(); ?></div><!--End entry-->

<?php if(airtheme_enable_team_template()){ ?>
    <section class="gallery-property">
        <ul class="gallery-info-property">
            <?php if($team_position) { ?>
            <li class="gallery-info-property-li">
                <div class="gallery-info-property-item gallery-info-property-tit"><?php echo esc_html__('POSITION','air-theme'); ?></div>
                <div class="gallery-info-property-item gallery-info-property-con"><?php echo wp_kses_post($team_position); ?></div>
            </li>
            <?php } ?>
            <?php if($team_email) { ?>
            <li class="gallery-info-property-li">
                <div class="gallery-info-property-item gallery-info-property-tit"><?php echo esc_html__('EMAIL','air-theme'); ?></div>
                <div class="gallery-info-property-item gallery-info-property-con"><?php echo wp_kses_post($team_email); ?></div>
            </li>
            <?php } ?>
            <?php if($team_phone_number) { ?>
            <li class="gallery-info-property-li">
                <div class="gallery-info-property-item gallery-info-property-tit"><?php echo esc_html__('PHONE NUMBER','air-theme'); ?></div>
                <div class="gallery-info-property-item gallery-info-property-con"><?php echo wp_kses_post($team_phone_number); ?></div>
            </li>
            <?php } ?>
        </ul> 
    </section>  
<?php } ?>