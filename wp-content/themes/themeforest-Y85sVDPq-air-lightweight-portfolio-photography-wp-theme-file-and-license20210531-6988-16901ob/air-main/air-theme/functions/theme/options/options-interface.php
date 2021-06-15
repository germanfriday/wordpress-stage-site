<div id="ux-option-interface" class="wrap">
	<div class="icon32" id="icon-themes"><br></div>
	<h2>
		<?php esc_html_e('Theme Options','air-theme') ?>
	</h2>
    
    <?php if(isset($_GET['message'])): ?>
		<?php if($_GET['message'] == 'restore'): ?>
        <div id="restore-defaults-msg">
            <div class="updated below-h2"><p><?php esc_html_e('Restore Defaults','air-theme') ?></p></div>
        </div>
        <?php endif; ?>
    <?php endif; ?>
    
    <?php airtheme_theme_option_save(); ?>
    <form id="ux-theme-option-form" action="<?php echo admin_url('admin.php?page=theme-option'); ?>" method="post">
        <input type="hidden" name="action" value="save" />
        <input type="hidden" name="_uxnonce" value="<?php echo wp_create_nonce(admin_url('admin.php?page=theme-option')); ?>" />
        <div class="ux-theme-box">
            <div class="ux-theme-tabs">
                <?php $theme_config_fields = airtheme_theme_options_config_fields();
                if(count($theme_config_fields) > 0){ ?>
                    <ul class="nav nav-tabs">
                        <?php foreach($theme_config_fields as $i => $config){
                            $active = ($i == 0) ? 'active' : false; ?>
                            <li class="<?php echo esc_attr($active); ?>"><a href="<?php echo esc_attr('#' .$config['id']); ?>" data-toggle="tab"><?php echo esc_html($config['name']); ?></a></li>
                        <?php } ?>
                    </ul>
                <?php } ?>
                
                <?php if(count($theme_config_fields) > 0){ ?>
                    <div class="tab-content">
                        <?php foreach($theme_config_fields as $i => $config){
                            $active = ($i == 0) ? 'active' : false; ?>
                            <div id="<?php echo esc_attr($config['id']); ?>" class="tab-pane <?php echo esc_attr($active); ?>">
                                <?php if(isset($config['section'])){
                                    foreach($config['section'] as $i => $section){
                                        $border = ($i != 0) ? 'border-top:1px dotted #ccc;' : false;
										$title = isset($section['title']) ? $section['title'] : false; ?>
                                        <div class="theme-option-item" style=" <?php echo sanitize_text_field($border); ?>">
                                            <h3 class="theme-option-item-heading"><?php echo esc_html($title); ?></h3>
                                            <?php if(isset($section['item'])){
                                                foreach($section['item'] as $item){
                                                    $no_margin_bottom = ($item['type'] == 'switch-color') ? 'margin-bottom:0px;' : false;
													$col_md_width = $item['type'] == 'color-scheme' ? 'col-md-12' : 'col-md-7';
                                                    $control = isset($item['control']) ? 'data-name="' .esc_attr($item['control']['name']). '" data-value="' .esc_attr($item['control']['value']). '"' : false;  ?>
                                                    <div class="row <?php echo esc_attr($item['name']); ?>" style=" <?php echo esc_attr($no_margin_bottom); ?>" <?php echo sanitize_text_field($control); ?>>
                                                        <?php if(isset($item['title']) && $item['type'] != 'switch-color'){ ?>
                                                            <h5 class="col-md-12"><?php echo esc_html($item['title']); ?></h5>
                                                        <?php } ?>
                                                        <div class="<?php echo esc_attr($col_md_width); ?>">
                                                            <?php if(isset($item['bind'])){
                                                                foreach($item['bind'] as $bind){
                                                                    if($bind['position'] == 'before'){
                                                                        airtheme_theme_option_getfield($bind, 'ux_theme_option');
                                                                    }
                                                                }
                                                            }
                                                            
                                                            airtheme_theme_option_getfield($item, 'ux_theme_option');
                                                            
                                                            if(isset($item['bind'])){
                                                                foreach($item['bind'] as $bind){
                                                                    if($bind['position'] == 'after'){
                                                                        airtheme_theme_option_getfield($bind, 'ux_theme_option');
                                                                    }
                                                                }
                                                            } ?>
                                                        </div>
                                                        <?php if($item['type'] != 'color-scheme'){ ?>
                                                            <div class="col-md-5 text-muted">
                                                                <?php if(isset($item['description'])){
                                                                    echo esc_html($item['description']);
                                                                }
                                                                
                                                                if(isset($item['help_url'])){ ?>
                                                                    <a title="<?php echo esc_attr($item['help_url']); ?>" class="themeoption-help-a" target="_blank" href="<?php echo esc_url($item['help_url']); ?>"><span class="themeoption-help">?</span></a>
                                                                <?php } ?>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                <?php
                                                }
                                            } ?>
                                        </div>
                                    <?php	
                                    }
                                } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
                <div class="ux-theme-option-submit">
                    <div class="row">
                        <div class="col-sm-6"><button type="button" class="btn btn-default btn-sm restore_defaults" data-notice="<?php esc_attr_e('All the settings you have done will be cover write to the default settings, are you sure you want to continue?','air-theme'); ?>"><?php esc_html_e('Restore Defaults','air-theme'); ?></button><a class="btn btn-default btn-sm" href="https://doc.seatheme.net/theme/air/" target="_blank" rel="noopener noreferrer" title="<?php esc_html_e('Documentation','air-theme'); ?>"><?php esc_html_e('Documentation','air-theme'); ?></a><a class="btn btn-default btn-sm btn-support" href="https://seatheme.net/forums/forum/air-wordpress-theme/" target="_blank" rel="noopener noreferrer" title="<?php esc_html_e('SeaTheme Support Forum','air-theme'); ?>"><?php esc_html_e('Support Forum','air-theme'); ?></a></div>
                        <div class="col-sm-6 text-right"><button type="submit" class="btn btn-primary btn-sm" data-loading="<?php esc_attr_e('Please waitting...','air-theme'); ?>"><?php esc_html_e('Save Options','air-theme'); ?></button></div>
                    </div>
                </div>
            </div>
            
            <?php airtheme_theme_option_modal(); ?>
        </div>
    </form>
</div>