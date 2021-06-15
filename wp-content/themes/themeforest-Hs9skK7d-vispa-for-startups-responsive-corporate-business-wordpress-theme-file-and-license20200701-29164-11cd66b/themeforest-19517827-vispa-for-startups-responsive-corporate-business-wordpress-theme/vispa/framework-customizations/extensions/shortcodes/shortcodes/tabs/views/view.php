<?php if (!defined('FW')) die( 'Forbidden' ); ?>

<?php $tabs_id = 'fly-tabs-'.$atts['unique_id']; ?>
<div class="fly-tabs-container section section-our-clients <?php echo esc_attr( $atts['class'] ); ?> sh-<?php echo esc_attr( $atts['unique_id'] ); ?>" id="<?php echo esc_attr($tabs_id); ?>">
	<ul class="nav nav-text list-logos list-logos-danger list-gray-images" role="tablist">
		<?php $count = 0; ?>
		<?php foreach ($atts['tabs'] as $key => $tab) : $count++; ?>
			<li <?php if($count == 1) echo 'class="active"'; ?>>
				<a href="#<?php echo esc_attr($tabs_id . '-' . ($key + 1)); ?>" role="tab" data-toggle="tab">
					<div class="client-logo">
						<?php if($tab['icon_type']['selected'] == 'icon_class' && !empty($tab['icon_type']['icon_class']['class']) ) : ?>
							<?php echo '<i class="'.$tab['icon_type']['icon_class']['class'].'"></i>'; ?>
						<?php elseif($tab['icon_type']['selected'] == 'upload_icon' && !empty($tab['icon_type']['upload_icon']['img']) ) : ?>
							<?php echo '<img src="'.$tab['icon_type']['upload_icon']['img']['url'].'" alt="" />'; ?>
						<?php endif; ?>
						<h3 class="fly-tab-title"><?php echo $tab['tab_title']; ?></h3>
					</div>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php $count = 0; ?>
	<div class="tab-content">
		<?php foreach ( $atts['tabs'] as $key => $tab ) : $count++; ?>
			<div class="tab-pane fade <?php if($count == 1) echo 'in active'; ?>" id="<?php echo esc_attr($tabs_id . '-' . ($key + 1)); ?>">
				<div class="description"><?php echo do_shortcode( $tab['tab_content'] ) ?></div>
			</div>
		<?php endforeach; ?>
	</div>
</div>