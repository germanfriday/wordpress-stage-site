<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$bg_color = $atts['bg_color'];
$bg_image = $atts['bg_image'];
$class    = $atts['class'];

// full width
if( $atts['is_fullwidth']['selected'] == 'yes' ) {
	$container_class = 'container-fluid';
}
else {
	$container_class = 'container';
}

// first section in builder
if ( isset( $atts['first_in_builder'] ) && $atts['first_in_builder'] ) {
	$class .= ' section-header-styled';
}

// background color and image
$style = '';
if ( ! empty( $bg_image ) && ! empty( $bg_color ) ) {
	$style = 'background-image: url(' . esc_url( $bg_image['url'] ) . '); background-color: ' . ( $bg_color ) . ';';
	$class .= ' section-text-white section-bg-image';
} elseif ( ! empty( $bg_image ) ) {
	$style = 'background-image: url(' . esc_url( $bg_image['url'] ) . ');';
	$class .= ' section-text-white section-bg-image';
} elseif ( ! empty( $bg_color ) ) {
	$style = 'background-color: ' . ( $bg_color ) . ';';
	$class .= ' section-text-white';
}

// section height
if ( $atts['height'] != 'auto' && $atts['height'] != 'section-height-sm' && $atts['height'] != 'section-height-md' && $atts['height'] != 'section-height-lg' ) {
	$height      = (int) $atts['height'];
	$data_height = 'height: ' . $height . 'px;';
	$class .= ' section-height-custom';
} else {
	$class .= ' ' . $atts['height'];
	$data_height = '';
}

// parallax
if( $atts['parallax']['selected'] == 'yes' ) {
	$class .= ' parallax filter';
}

$link_id = '';
if( !empty($atts['link_id']) ) {
	$link_id = 'id="'.$atts['link_id'].'"';
}

if ( isset($atts['video_bg']['selected']) && $atts['video_bg']['selected'] == 'yes' ) {
	$version = defined( 'FW' ) ? fw()->theme->manifest->get_version() : '1.0';
	wp_enqueue_script(
		'froogaloop2',
		'https://f.vimeocdn.com/js/froogaloop2.min.js',
		array(),
		$version,
		true
	);
}
?>
<section <?php echo $link_id; ?> class="<?php echo esc_attr( $class ); ?>" <?php echo 'style="' . $style . ' '.$data_height.'"'; ?>>
	<?php if( isset( $atts['video_bg']['selected'] ) && $atts['video_bg']['selected'] == 'yes' ) : ?>
		<?php if( $atts['video_bg']['yes']['video_type']['selected'] == 'uploaded' && isset( $atts['video_bg']['yes']['video_type']['uploaded']['video']['url'] ) && !empty( $atts['video_bg']['yes']['video_type']['uploaded']['video']['url'] ) ) : ?>
			<div class="video-container hidden-xs">
				<video autoplay loop muted width="1920" height="1080">
					<source src="<?php echo $atts['video_bg']['yes']['video_type']['uploaded']['video']['url'] ?>" type='video/mp4; codecs="avc1.4D401E, mp4a.40.2"'/>
				</video>
			</div>
		<?php elseif( $atts['video_bg']['yes']['video_type']['selected'] == 'vimeo' && isset( $atts['video_bg']['yes']['video_type']['vimeo']['video'] ) && !empty( $atts['video_bg']['yes']['video_type']['vimeo']['video'] ) ) : ?>
			<div class="video-container hidden-xs">
				<?php $vimeo_id = (int) substr(parse_url($atts['video_bg']['yes']['video_type']['vimeo']['video'], PHP_URL_PATH), 1); ?>
				<iframe id="vimeo-<?php echo $vimeo_id; ?>" class="video" src="//player.vimeo.com/video/<?php echo $vimeo_id; ?>?api=1;title=0&amp;byline=0&amp;portrait=0&amp;color=d01e2f" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				<script>
					jQuery(window).on('load', function() {
						var iframe<?php echo $atts['unique_id']; ?> = document.getElementById('vimeo-<?php echo $vimeo_id; ?>');
						var player<?php echo $atts['unique_id']; ?> = $f(iframe<?php echo $atts['unique_id']; ?>);

						player<?php echo $atts['unique_id']; ?>.addEvent('ready', function() {
							player<?php echo $atts['unique_id']; ?>.api('setVolume', 0);
							player<?php echo $atts['unique_id']; ?>.api('play');
						});
					});
				</script>
			</div>
		<?php elseif( $atts['video_bg']['yes']['video_type']['selected'] == 'youtube' && isset( $atts['video_bg']['yes']['video_type']['youtube']['video'] ) && !empty( $atts['video_bg']['yes']['video_type']['youtube']['video'] ) ) : ?>
		<?php $youtube_id = vispa_get_youtube_id($atts['video_bg']['yes']['video_type']['youtube']['video']); ?>
			<div class="video-container hidden-xs">
				<div id="youtube-<?php echo $youtube_id; ?>" class="video"></div>
			</div>
			<script>
				var tag = document.createElement('script');
				tag.src = "https://www.youtube.com/iframe_api";
				var firstScriptTag = document.getElementsByTagName('script')[0];
				firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

				var player<?php echo $atts['unique_id']; ?>;
				var video_id<?php echo $atts['unique_id']; ?> = 'youtube-<?php echo $youtube_id; ?>';
				var youtube_id<?php echo $atts['unique_id']; ?> = '<?php echo $youtube_id; ?>';

				jQuery(window).on('load', function() {
					player<?php echo $atts['unique_id']; ?> = new YT.Player(video_id<?php echo $atts['unique_id']; ?>, {
						width: '1920',
						height: '1080',
						videoId: youtube_id<?php echo $atts['unique_id']; ?>,
						events: {
							'onReady': function (event) {
								event.target.setVolume(0);
								event.target.playVideo();
							},
							'onStateChange': function(event) {
								if (event.data === YT.PlayerState.ENDED) {
									event.target.playVideo();
								}
							}
						}
					});
				});
			</script>
		<?php endif; ?>
	<?php endif; ?>
	<?php /* for section overlay */ ?>
	<?php if( isset( $atts['overlay']['selected'] ) && $atts['overlay']['selected'] == 'yes' ) : ?>
		<?php if( !empty($atts['overlay']['yes']['color']) ) : ?>
			<div class="fly-overlay" style="background-color: <?php echo ($atts['overlay']['yes']['color']); ?>"></div>
		<?php endif; ?>
	<?php endif; ?>
	<div class="<?php echo $container_class; ?>">
		<?php echo do_shortcode( $content ); ?>
	</div>
</section>
