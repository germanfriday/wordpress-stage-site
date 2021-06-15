<?php
function SenaFontAwesomeSocial() {
	$icons = array(
		'fab fa-500px'				=>  esc_html__( '500px', 'sena' ),
		'fab fa-amazon'				=>	esc_html__( 'Amazon', 'sena' ),
		'fab fa-apple'				=>	esc_html__( 'Apple', 'sena' ),
		'fab fa-behance'			=>  esc_html__( 'Behance', 'sena' ),
		'fab fa-blogger-b'			=>  esc_html__( 'Blogger', 'sena' ),
		'fab fa-deviantart'			=>  esc_html__( 'DeviantArt', 'sena' ),
		'fab fa-dribbble'			=>  esc_html__( 'Dribbble', 'sena' ),
		'fab fa-ello'				=>	esc_html__( 'Ello', 'sena' ),
		'fas fa-envelope'			=>	esc_html__( 'Email', 'sena' ),
		'fab fa-evernote'			=>	esc_html__( 'Evernote', 'sena' ),
		'fab fa-facebook-f'			=>	esc_html__( 'Facebook', 'sena' ),
		'fab fa-flickr'				=>  esc_html__( 'Flickr', 'sena' ),
		'fab fa-flipboard'			=>  esc_html__( 'Flipboard', 'sena' ),
		'fab fa-foursquare'			=>	esc_html__( 'FourSquare', 'sena' ),
		'fab fa-github-alt'			=>  esc_html__( 'Github', 'sena' ),
		'fab fa-google-wallet'		=>  esc_html__( 'Google Wallet', 'sena' ),
		'fab fa-instagram'   		=>	esc_html__( 'Instagram', 'sena' ),
		'fab fa-lastfm'				=> 	esc_html__( 'LastFM', 'sena' ),
		'fab fa-linkedin-in'		=> 	esc_html__( 'LinkedIn', 'sena' ),
		'fab fa-medium-m'			=> 	esc_html__( 'Medium', 'sena' ),
		'fab fa-mix'				=>  esc_html__( 'Mix', 'sena' ),
		'fab fa-paypal'				=>	esc_html__( 'PayPal', 'sena' ),
		'fab fa-periscope'			=>	esc_html__( 'Periscope', 'sena' ),
		'fab fa-pinterest'			=> 	esc_html__( 'Pinterest', 'sena' ),	
		'fas fa-rss'				=>	esc_html__( 'RSS', 'sena' ),
		'fab fa-reddit-alien'		=>	esc_html__( 'Reddit', 'sena' ),
		'fab fa-shopify'			=>  esc_html__( 'Shopify', 'sena' ),
		'fab fa-skype'				=>  esc_html__( 'Skype', 'sena' ),
		'fab fa-soundcloud'			=>	esc_html__( 'SoundCloud', 'sena' ),
		'fab fa-spotify'			=>  esc_html__( 'Spotify', 'sena' ),
		'fab fa-stack-overflow'		=> 	esc_html__( 'Stack Overflow', 'sena' ),
		'fab fa-steam-symbol'		=> 	esc_html__( 'Steam', 'sena' ),
		'fab fa-telegram-plane'		=>  esc_html__( 'Telegram', 'sena' ),
		'fab fa-tiktok'				=>  esc_html__( 'TikTok', 'sena' ),
		'fab fa-tumblr'				=>  esc_html__( 'Tumblr', 'sena' ),
		'fab fa-twitch'				=>	esc_html__( 'Twitch', 'sena' ),		
		'fab fa-twitter'			=>	esc_html__( 'Twitter', 'sena' ),
		'fab fa-unsplash'			=>	esc_html__( 'Unsplash', 'sena' ),
		'fab fa-vk'					=>	esc_html__( 'VK', 'sena' ),
		'fab fa-vimeo-v'			=>  esc_html__( 'Vimeo', 'sena' ),
		'fab fa-vine'				=>	esc_html__( 'Vine', 'sena' ),	
		'fab fa-weibo'				=>  esc_html__( 'Weibo', 'sena' ),	
		'fab fa-whatsapp'			=>  esc_html__( 'WhatsApp', 'sena' ),
		'fab fa-wordpress-simple'	=>	esc_html__( 'WordPress', 'sena' ),
		'fab fa-xing'				=>	esc_html__( 'Xing', 'sena' ),
		'fab fa-yahoo'				=> 	esc_html__( 'Yahoo', 'sena' ),	
		'fab fa-yelp'				=>	esc_html__( 'Yelp', 'sena' ),
		'fab fa-youtube'			=>  esc_html__( 'YouTube', 'sena' )		
	);
	
	asort($icons);
	$options = array();
	
	foreach($icons as $key => $value) {
  		$options[ $key ] = $value;
	}

	return $options;
}