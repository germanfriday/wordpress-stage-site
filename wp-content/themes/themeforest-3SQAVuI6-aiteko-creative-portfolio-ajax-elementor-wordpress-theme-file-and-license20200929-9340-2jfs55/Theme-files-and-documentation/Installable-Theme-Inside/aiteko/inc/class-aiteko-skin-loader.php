<?php
/**
 * The skin loader
 * Require the core plugin
 *
 * @package Aiteko
 * @since 1.0
 */

// Accessing directly?.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

// Dont bother if user decide to turn off the core plugin.
if ( ! class_exists( 'Wip_Themes_Core' ) ) {
	return false;
}

if ( ! class_exists( 'Aiteko_Skin_Loader' ) ) {
	/**
	 * This class is in charge of displaying custom skin.
	 * Compile the scss into css code
	 *
	 * @since 1.0
	 */
	class Aiteko_Skin_Loader {
		/**
		 * Custom skin status holder
		 *
		 * @var active
		 * @access public
		 */
		public $active = false;

		/**
		 * Path status holder
		 *
		 * @var path_ready
		 * @access public
		 */
		public $path_ready = false;

		/**
		 * Custom css path
		 *
		 * @var css_path
		 * @access public
		 */
		public $css_path = false;

		/**
		 * Custom css url
		 *
		 * @var css_path
		 * @access public
		 */
		public $css_url = false;

		/**
		 * Scss import path
		 *
		 * @var import_path
		 * @access private
		 */
		private $import_path = '';

		/**
		 * The constructor
		 *
		 * @since 1.0
		 * @return void
		 */
		public function __construct() {
			$this->set_status();
			$this->setup_path();

			// set the scss import path.
			$this->import_path = get_parent_theme_file_path( '/assets/scss/' );
		}

		/**
		 * Create path to place the css file if its not already exists
		 *
		 * @since 1.0
		 * @return void
		 */
		private function setup_path() {
			$upload_dir     = wp_upload_dir();
			$this->css_path = trailingslashit( $upload_dir['basedir'] ) . 'aiteko-dynamic-css';
			$this->css_url  = trailingslashit( $upload_dir['baseurl'] ) . 'aiteko-dynamic-css';

			if ( ! is_dir( $this->css_path ) ) {
				wip_themes_core_create_path( $this->css_path );

				// checking once again,
				// incase WP failed to create the dir.
				if ( is_dir( $this->css_path ) ) {
					$this->path_ready = true;
				}
			} else {
				$this->path_ready = true;
			}
		}

		/**
		 * get css url
		 *
		 * @since 1.0
		 * @return string
		 */
		public function get_css_url() {
			if ( ! $this->path_ready ) {
				return false;
			}

			if ( $this->css_url ) {
				return $this->css_url;
			}

			$upload_dir     = wp_upload_dir();
			$this->css_url  = trailingslashit( $upload_dir['baseurl'] ) . 'aiteko-dynamic-css';
			return $this->css_url;
		}

		/**
		 * Write the compiled css code into a file
		 *
		 * @since 1.0
		 * @return bool
		 */
		public function write_css_to_file() {
			// Cancel if we failed to create the path.
			if ( ! $this->path_ready ) {
				set_theme_mod( 'aiteko-failed-write-css', 'yes' );
				return false;
			}

			$css_code = $this->get_compiled_css();
			$css_file = $this->css_path . '/aiteko-custom-skin.css';

			if ( wip_themes_core_write_to_file( $css_file, $css_code ) ) {
				remove_theme_mod( 'aiteko-failed-write-css' );
				set_theme_mod( 'aiteko-custom-css-version', intval( time() ) );
				return true;
			} else {
				set_theme_mod( 'aiteko-failed-write-css', 'yes' );
				remove_theme_mod( 'aiteko-custom-css-version' );
				return false;
			}

			return false;
		}

		/**
		 * Running after customisation saved.
		 *
		 * @since 1.0
		 * @return bool
		 */
		public function take_action() {
			if ( $this->set_status() ) {
				$this->save_all();
			} else {
				$this->save_typography();
			}

			$this->write_css_to_file();
		}

		/**
		 * Get full compiled css
		 *
		 * @since 1.0
		 * @return string
		 */
		public function get_compiled_css() {
			$precompiled_code = $this->get_precompiled_scss();
			$module = new Wip_Themes_Core_Compiler_Scss( $precompiled_code, $this->import_path );
			$css_code = $module->compile();

			return $css_code;
		}

		/**
		 * Get typograhy compiled css
		 *
		 * @since 1.0
		 * @return string
		 */
		public function get_compiled_typography_css() {
			$precompiled_code = $this->get_precompiled_typography_scss();
			$module = new Wip_Themes_Core_Compiler_Scss( $precompiled_code, $this->import_path );
			$css_code = $module->compile();

			return $css_code;
		}

		/**
		 * Get editor style compiled css
		 *
		 * @since 1.0
		 * @return string
		 */
		public function get_compiled_editor_style_css() {
			$precompiled_code = $this->get_precompiled_editor_style_scss();
			$module = new Wip_Themes_Core_Compiler_Scss( $precompiled_code, $this->import_path );
			$css_code = $module->compile();

			return $css_code;
		}

		/**
		 * Save typography, running after customizer save
		 *
		 * @since 1.0
		 * @return string
		 */
		public function save_typography() {
			$css = $this->get_compiled_typography_css();
			set_theme_mod( 'aiteko_typography_skin_code', $css );
		}

		/**
		 * Save all, running after customizer save
		 *
		 * @since 1.0
		 * @return string
		 */
		public function save_all() {
			$css = $this->get_compiled_css();
			set_theme_mod( 'aiteko_custom_skin_code', $css );
		}

		/**
		 * Get precompiled scss for editor style
		 *
		 * @since 1.0
		 * @return string
		 */
		public function get_precompiled_editor_style_scss() {
			// Require colors.
			$primary           = get_theme_mod( 'aiteko_primary_color', '#ea3c53' );
			$body_bg           = get_theme_mod( 'body_bg', '#ffffff' );
			$text_main         = get_theme_mod( 'color_text_main', '#565656' );
			$text_heading      = get_theme_mod( 'color_text_heading', '#1a1a1a' );
			$text_light        = get_theme_mod( 'color_text_light', '#969696' );
			$color_link        = get_theme_mod( 'color_link', '#ea3c53' );
			$color_link_hover  = get_theme_mod( 'color_link_hover', '#ad1327' );
			
			$base_font_size    = get_theme_mod( 'body_font_size', '17' );
			$font_size_h1      = get_theme_mod( 'heading_h1', '2.75' );
			$font_size_h2      = get_theme_mod( 'heading_h2', '2' );
			$font_size_h3      = get_theme_mod( 'heading_h3', '1.75' );
			$font_size_h4      = get_theme_mod( 'heading_h4', '1.5' );
			$font_size_h5      = get_theme_mod( 'heading_h5', '1.25' );
			$font_size_h6      = get_theme_mod( 'heading_h6', '1' );
			$line_height       = get_theme_mod( 'body_line_height', '1.6' );

			// some need to set in default state when custom skin is not active
			if ( ! $this->set_status() ) {
				$primary           = '#ea3c53';
				$body_bg           = '#ffffff';
				$text_main         = '#565656';
				$text_heading      = '#1a1a1a';
				$text_light        = '#969696';
				$color_link        = '#ea3c53';
				$color_link_hover  = '#ad1327';	
			}

			// fonts.
			$heading_font = get_theme_mod( 'aiteko_heading_font', WIP_THEMES_DEFAULT_HEADING_FONT );
			$body_font    = get_theme_mod( 'aiteko_body_font', WIP_THEMES_DEFAULT_BODY_FONT );
			
			// heading font name.
			$heading_font_name = explode( ':', $heading_font );
			$heading_font_name = str_replace( '+', ' ', $heading_font_name[0] );

			// Body font name.
			$body_font_name = explode( ':', $body_font );
			$body_font_name = str_replace( '+', ' ', $body_font_name[0] );

			$scss = '
$grid-breakpoints: (
  xs: 0,
  ms: 321px,
  sm: 576px,
  md: 768px,
  lg: 992px,
  xl: 1200px
)!default;

@import "mixins";

$color__primary: ' . $primary . ' !default;
$color__body-background: ' . $body_bg . '	!default;
$color__text-main: ' . $text_main . ';
$color__text-heading: ' . $text_heading . ';
$color__text-light: ' . $text_light . ';
$color__link: ' . $color_link . ' !default;
$color__link-hover: ' . $color_link_hover . ' !default;

$color__content-border: set-diff-color($color__body-background, 6.5%);

$size__font-base: ' . $base_font_size . ' !default;
$size__font-h1: ' . $font_size_h1 . 'rem !default;
$size__font-h2: ' . $font_size_h2 . 'rem !default;
$size__font-h3: ' . $font_size_h3 . 'rem !default;
$size__font-h4: ' . $font_size_h4 . 'rem !default;
$size__font-h5: ' . $font_size_h5 . 'rem !default;
$size__font-h6: ' . $font_size_h6 . 'rem !default;

$line-height: ' . $line_height . '!default;
$base-font-weight: 400 !default;

$font-family-sans-serif: 	"' . $body_font_name . '", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji" !default;
$font-family-monospace: 	SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace !default;
$font-family-base: 			$font-family-sans-serif !default;
$font-family-heading:		"' . $heading_font_name . '", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji" !default;

body {
  font-family: $font-family-base;
  color: $color__text-main;
  background-color: $color__body-background;
  line-height: $line-height;
  font-size: $size__font-base+"px";
}
h1, h2, h3, h4, h5, h6 {
  font-family: $font-family-heading;
  color: $color__text-heading;

 	a {
		color: $color__text-heading;

		&:hover {
			color: $color__link;
		}
	}
}

h1 {
	font-size: $size__font-h1;
	line-height: 1.35;
}
h2 {
	font-size: $size__font-h2;
	line-height: 1.15;
}
h3 {
	font-size: $size__font-h3;
	line-height: 1.15;
}
h4 {
	font-size: $size__font-h4;
	line-height: 1.15;
}
h5 {
	font-size: $size__font-h5;
	line-height: 1.15;
}
h6 {
	font-size: $size__font-h6;
}

a {
	color: $color__link;

	&:hover {
		color: $color__link-hover;
	}
}

pre {
	font-family: $font-family-monospace;
}

/* Main column width */
.wp-block {
    max-width: 710px;
}

/* Width of "wide" blocks */
.wp-block[data-align="wide"] {
    max-width: 75%;
}

/* Width of "full-wide" blocks */
.wp-block[data-align="full"] {
    max-width: none;
}

p,ul,ol,blockquote {
	margin-top: 29px;
}
h1,
h2,
h3,
h4,
h5,
h6,
.wp-block-cover,
.wp-block-embed,
.wp-block-image:not(.alignleft):not(.alignright)  {
	margin-top: 50px;
	margin-bottom: 0;
	font-weight: 500;
}
.wp-block-cover,
.wp-block-embed,
.wp-block-image:not(.alignleft):not(.alignright)  {
	margin-bottom: 20px;
}
p.wp-block-cover-text {
	margin-top: 0;
}
h4 + p,
h3 + p,
h2 + p,
h1 + p {
	margin-top: 1rem;
}
h4 + *:not(p),
h3 + *:not(p),
h2 + *:not(p),
h1 + *:not(p) {
	margin-top: 1.5rem;
}
figure {
	margin-left: 0;
	margin-right: 0;

	&.alignleft {
		margin-top: 29px;
		margin-right: 2rem;
	}

	&.alignright {
		margin-top: 29px;
		margin-left: 2rem;
	}
}

ul,ol {
	list-style-position: outside;
	margin-left: 2rem;
	ul,ol {
		padding-left: 2rem;
		margin-top: .5rem;
		margin-bottom: 1rem;
		margin-left: 0;
	}
}
p.has-drop-cap:not(:focus)::first-letter {
	float: left;
	font-size: 3rem;
	line-height: 0.68;
	font-weight: 300;
	margin: 0.65rem 1rem 0 0;
	text-transform: uppercase;
	font-style: normal;
}

pre {
	margin-top: 29px;
	margin-bottom: 0;
	font-size: .875rem;
	border-radius: 3px;
}
.wp-block-code {
	padding: 2rem;
	background: set-diff-color( $color__body-background, 3%);
}
p code {
	padding: .5rem;
	font-size: .75rem;
	background: set-diff-color( $color__body-background, 3%);
	color: inherit;
	border-radius: 3px;
}
.wp-block-preformatted {
	padding: 2rem;
	border: 1px solid $color__content-border;
}

blockquote,
.wp-block-quote {
	position: relative;
	padding-left: 5rem !important;
	padding-right: 5rem !important;

	&:before {
		content: "";
		position: absolute;
		left: 0;
		width: 3rem;
		height: 3rem;
		line-height: 3rem;
		text-align: center;
		background-image: url(../images/quote.svg);
		background-position: center;
		background-repeat: no-repeat;
		background-size: 1.5rem;
		background-color: #ececec;
		color: #fff;
		border-radius: 50%;
	}

	cite,
	.wp-block-quote__citation {
		font-size: .75rem;
		font-weight: 600;
		position: relative;
		font-style: normal;

		&:before {
			content: "";
			position: absolute;
			width: 4rem;
			height: 1px;
			left: -5rem;
			top: 50%;
			background: set-diff-color( $color__body-background, 10%);
		}
	}

	&:not(.is-large):not(.is-style-large) {
		border-left-width: 0;
	}
}

.wp-block-quote.is-large p,
.wp-block-quote.is-style-large p {
	font-style: normal;
}

ul.wp-block-latest-posts {
	margin-left: 0!important;
	padding-left: 0!important;
	list-style-type: none;

	li {
		list-style-type: none;
		margin: 0;
		padding: .8rem 0 .8rem 2rem;
		position: relative;
		background-image: url(../images/post-icon.svg);
		background-position: 0 1.2rem;
		background-repeat: no-repeat;
		background-size: 1rem;

		a {
			display: inline-block;
			width: 100%;
			font-weight: 600;
		}

		&:last-child {
			padding-bottom: 0;
		}
	}

	&.is-grid {
		margin-left: -8px;
		margin-right: -8px;
		li {
			margin-left: 8px;
			margin-right: 8px;
			margin-bottom: 16px;
		}
	}

	&.alignfull {
		padding-left: 1rem;
		padding-right: 1rem;
	}
}

ul.wp-block-categories__list,
ul.wp-block-archives-list {
	margin-left: 0 !important;
	padding-left: 0 !important;
	list-style-type: none;

	li {
		list-style-type: none;
		margin: 0;
		padding: .8rem 0 .8rem 2rem;
		position: relative;
		display: -ms-flexbox;
		display: flex;
		-ms-flex-wrap: wrap;
		flex-wrap: wrap;
		-ms-flex-pack: justify;
		justify-content: space-between;
		-ms-align-items: center;
		align-items: center;
		font-size: .75rem;
		background-image: url(../images/category-icon.svg);
		background-position: 0 1.175rem;
		background-repeat: no-repeat;
		background-size: 1rem;

		a {
			font-size: 1rem;
			flex: 0 0 auto;
			font-weight: 600;
		}

		&:last-child {
			padding-bottom: 0;
		}

		ul {
			flex: 0 0 100%;
			max-width: 100%;
			padding-left: 0;
			margin-left: 0;
			margin-top: .8rem;

			li {
				background-position: 0 1.1rem;
			}

			a {
				font-size: .925rem;
				font-weight: normal;
			}
		}
	}		
}
ul.wp-block-archives-list {
	li {
		background-image: url(../images/calendar-icon.svg);
		background-position: 0 1.15rem;
	}
}
ol.wp-block-latest-comments {
	list-style-type: none;
	margin-left: 0 !important;
	padding-left: 0 !important;

	.wp-block-latest-comments__comment {
		border-bottom: 1px solid $color__content-border;
		margin-bottom: 2rem;
		padding-bottom: 2rem;
	}
	.wp-block-latest-comments__comment-author {
		display: inline-block;
		padding: 0 .35rem 0 .35rem;
		margin-right: .25rem;
		border-radius: 3px;
		font-size: .675rem;
		height: 20px;
		line-height: 20px;
		vertical-align: baseline;
		text-transform: uppercase;
		letter-spacing: .15em;
		background: $color__link;
		color: set-diff-color($color__link, 75%);	
	}
	.wp-block-latest-comments__comment-link {
		font-weight: 600;
	}
	.wp-block-latest-comments__comment-meta time {
		font-size: .675rem;
		text-transform: uppercase;
		letter-spacing: .15em;
		margin-top: .5rem;
	}
	.wp-block-latest-comments__comment-excerpt {
		padding: 1rem;
		border-radius: 3px;
		margin-top: 1rem;
		background: rgba(0,0,0, .05);

		p {
			margin: 0 0 0;
		}
	}
}

ul.wp-block-gallery {
	margin-left: 0 !important;
	.blocks-gallery-image figcaption,
	.blocks-gallery-item figcaption {
		position: relative;
		width: calc(100% - 2rem);
		left: 1rem;
		right: 1rem;
		bottom: 1rem;
		padding: 1rem;
		background: rgba(255,255,255, .85);
		color: rgba(0,0,0, .75);
		overflow: initial;
		padding-top: 40px;

		&:before {
			content: "";
			position: absolute;
			top: -4px;
			left: -4px;
			right: -4px;
			bottom: -4px;
			border: 2px solid rgba(255,255,255, .85);
		}
	}
}

.wp-block-file {
	padding: 1rem;
	margin-top: 29px;
	position: relative;
	display: -ms-flexbox;
	display: flex;
	-ms-flex-wrap: wrap;
	flex-wrap: wrap;
	-ms-flex-pack: justify;
	justify-content: space-between;
	-ms-align-items: center;
	align-items: center;
	border-radius: 3px;
	background: rgba(0,0,0, .05);

	.wp-block-file__button {
		border-radius: 2px;
	}
}

.wp-block-pullquote {
	margin-top: 29px;
	border-top-width: 6px;
	border-bottom-width: 6px;
	border-top-style: double;
	border-bottom-style: double;
}

.wp-block-pullquote.is-style-solid-color blockquote {
	max-width: 80%;
}

.wp-block-button {
	margin: 29px 0 15px;
	.wp-block-button__link {
		font-size: 1rem;
		line-height: 1;
		padding: 1rem 1.5rem;
	}
	&.is-style-squared {
		.wp-block-button__link {
			-webkit-border-radius: 2px;
			border-radius: 2px;
		}
	}
	&.is-style-default,
	&.is-style-squared {
		.wp-block-button__link {
			box-shadow: 0 3px 15px -1px rgba(0,0,0, .12);
			
			&:hover {
				box-shadow: inset 0 0 200px rgba(255,255,255, .1), 0 1px 2px 0 rgba(0,0,0, .3);
			}
		}
	}
	&.is-style-outline {
		.wp-block-button__link:hover {
			opacity: .65;
		}
	}
}

.wp-block-audio {
	margin-top: 29px;
	.mejs-container {
		width: 100% !important;
	}
}

hr.wp-block-separator {
	clear: both;
	text-align: center;
	margin: 50px 0 20px;

	&:not(.is-style-wide):not(.is-style-dots) {
		margin-left: auto;
		margin-right: auto;
	}

	&.is-style-dots {
		border-width: 0;
		&:before {
			content: "\00B7  \00B7  \00B7";
			font-size: 36px;
			vertical-align: top;
			line-height: 0.5;
			padding-left: 0;
			opacity: .75;
			letter-spacing: .5rem;
		}
	}
}

.wp-block-embed__wrapper {
	iframe {
		width: 100%;
		max-width: 100% !important;
	}
}

.wp-block-cover,
.wp-block-cover-image {
	min-height: 500px;
}


ul.wp-block-latest-posts,
ul.wp-block-categories__list,
ul.wp-block-archives-list {
	li:not(:first-child),
	ul.children {
		border-top: 1px solid $color__content-border;
	}

	&.is-grid {
		li:first-child {
			border-top: 1px solid $color__content-border;
		}
	}			
}

.wp-block-code {
	background: set-diff-color( $color__body-background, 5%);
	color: rgba(30,30,30, .75);
}

.wp-block-separator {
	border-bottom: 2px solid set-diff-color( $color__body-background, 25%);

	&.is-style-wide {
		border-bottom-width: 1px;
	}
	&.is-style-dots {
		border-color: transparent;
	}
}';

			return $scss;
		}

		/**
		 * Get precompiled scss for font settings and typography
		 * Some users might just want to change the font settings but keep the default theme skin
		 *
		 * @since 1.0
		 * @return string
		 */
		public function get_precompiled_typography_scss() {
			// font sizes.
			$base_font_size = get_theme_mod( 'body_font_size', '17' );
			$font_size_h1   = get_theme_mod( 'heading_h1', '2.75' );
			$font_size_h2   = get_theme_mod( 'heading_h2', '2' );
			$font_size_h3   = get_theme_mod( 'heading_h3', '1.75' );
			$font_size_h4   = get_theme_mod( 'heading_h4', '1.5' );
			$font_size_h5   = get_theme_mod( 'heading_h5', '1.25' );
			$font_size_h6   = get_theme_mod( 'heading_h6', '1' );
			$line_height    = get_theme_mod( 'body_line_height', '1.6' );

			// fonts.
			$heading_font = get_theme_mod( 'aiteko_heading_font', WIP_THEMES_DEFAULT_HEADING_FONT );
			$body_font    = get_theme_mod( 'aiteko_body_font', WIP_THEMES_DEFAULT_BODY_FONT );
			
			// heading font name.
			$heading_font_name = explode( ':', $heading_font );
			$heading_font_name = str_replace( '+', ' ', $heading_font_name[0] );

			// Body font name.
			$body_font_name = explode( ':', $body_font );
			$body_font_name = str_replace( '+', ' ', $body_font_name[0] );

			$scss = '
$grid-breakpoints: (
  xs: 0,
  smm: 440px,
  sm: 576px,
  md: 768px,
  lg: 992px,
  xl: 1200px,
  wd: 1310px
)!default;

@import "mixins";

// font sizes
$size__font-base: ' . $base_font_size . ' !default;
$size__font-h1: ' . $font_size_h1 . 'rem !default;
$size__font-h2: ' . $font_size_h2 . 'rem !default;
$size__font-h3: ' . $font_size_h3 . 'rem !default;
$size__font-h4: ' . $font_size_h4 . 'rem !default;
$size__font-h5: ' . $font_size_h5 . 'rem !default;
$size__font-h6: ' . $font_size_h6 . 'rem !default;

$line-height: ' . $line_height . ' !default;
$base-font-weight: 400 !default;

$font-family-sans-serif: 	"' . $body_font_name . '", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji" !default;
$font-family-monospace: 	SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace !default;
$font-family-base: 			$font-family-sans-serif !default;
$font-family-heading:		"' . $heading_font_name . '", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji" !default;

:root {
	font-size: calculation-fontsize($size__font-base, 0.85)+"px";
}
@include media-breakpoint-up(sm) {
	:root {
		font-size: calculation-fontsize($size__font-base, 0.9)+"px";
	}
}
@include media-breakpoint-up(md) {
	:root {
		font-size: calculation-fontsize($size__font-base, 0.95)+"px";
	}
}
@include media-breakpoint-up(lg) {
	:root {
		font-size: $size__font-base+"px";
	}
}

html {
	font-size: 1em;
}

body {
	font-family: $font-family-base;
	font-size: 1rem;
	font-weight: $base-font-weight;
	line-height: $line-height;
}
h1,h2,h3,h4,h5,h6 {
	font-family: $font-family-heading;
}

h1 {
	font-size: $size__font-h1;
	line-height: 1.35;
}
h2 {
	font-size: $size__font-h2;
	line-height: 1.15;
}
h3 {
	font-size: $size__font-h3;
	line-height: 1.15;
}
h4 {
	font-size: $size__font-h4;
	line-height: 1.15;
}
h5 {
	font-size: $size__font-h5;
	line-height: 1.15;
}
h6 {
	font-size: $size__font-h6;
}
pre,
code,
kbd,
samp {
	font-family: $font-family-monospace;
}
#aiteko-site-loader {
	.aiteko-load-text {
		font-family: $font-family-heading;
	}
}
ul#aiteko-nav {
	font-family: $font-family-heading;
}
.navigation{
	&.post-navigation {
		.nav-links {
			.nav-title {
				font-family: $font-family-heading;
			}
		}
	}
}
#comments {
	#cancel-comment-reply-link {
		font-family: $font-family-base;
	}
}';
			return $scss;
		}

		/**
		 * Get precompiled scss based on user settings
		 *
		 * @since 1.0
		 * @return string
		 */
		public function get_precompiled_scss() {
			// Primary color.
			$primary = get_theme_mod( 'aiteko_primary_color', '#ea3c53' );

			// Backgrounds.
			$body_bg          = get_theme_mod( 'body_bg', '#ffffff' );
			$side_bg          = get_theme_mod( 'sidebar_bg', '#141414' );
			$sm_side_bg       = get_theme_mod( 'small_side_bg', '#ffffff' );
			$preloader_bg     = get_theme_mod( 'preloader_bg', '#1a1a1a' );
			$preloaderline_bg = get_theme_mod( 'preloader_line_bg', '#454545' );
			$searchbar_bg     = get_theme_mod( 'searchbar_bg', '#141414' );
			$footer_bg        = get_theme_mod( 'footer_bg', '#141414' );
			$input_bg         = get_theme_mod( 'input_bg', '#ffffff' );
			$input_bg_focus   = get_theme_mod( 'input_bg_focus', '#ffffff' );

			// Texts.
			$text_main              = get_theme_mod( 'color_text_main', '#565656' );
			$text_heading           = get_theme_mod( 'color_text_heading', '#1a1a1a' );
			$text_light             = get_theme_mod( 'color_text_light', '#969696' );
			$text_sidebar           = get_theme_mod( 'color_text_sidebar', '#787878' );
			$text_sm_side           = get_theme_mod( 'color_text_small_side', '#565656' );
			$text_input             = get_theme_mod( 'color_text_input', '#989898' );
			$text_input_focus       = get_theme_mod( 'color_text_input_focus', '#565656' );
			$text_input_placeholder = get_theme_mod( 'color_text_input_placeholder', '#989898' );
			$text_footer            = get_theme_mod( 'color_text_footer', '#dadada' );
			$text_footer_heading    = get_theme_mod( 'color_text_footer_heading', '#989898' );
			$text_preloader         = get_theme_mod( 'color_text_preloader', '#ea3c53' );

			// Links.
			$color_link              = get_theme_mod( 'color_link', '#ea3c53' );
			$color_link_hover        = get_theme_mod( 'color_link_hover', '#ad1327' );
			$color_link_menu         = get_theme_mod( 'color_link_menu', '#878787' );
			$color_link_menu_hover   = get_theme_mod( 'color_link_menu_hover', '#dadada' );
			$color_link_menu_active  = get_theme_mod( 'color_link_menu_active', '#f4f4f4' );
			$color_link_footer       = get_theme_mod( 'color_link_footer', '#dadada' );
			$color_link_footer_hover = get_theme_mod( 'color_link_footer_hover', '#ffffff' );

			// If custom skin disabled, we should role back the skin to the default one!.
			if ( ! $this->set_status() ) {
				// Primary color.
				$primary = '#ea3c53';

				// Backgrounds.
				$body_bg          = '#ffffff';
				$side_bg          = '#141414';
				$sm_side_bg       = '#ffffff';
				$preloader_bg     = '#1a1a1a';
				$preloaderline_bg = '#454545';
				$searchbar_bg     = '#141414';
				$footer_bg        = '#141414';
				$input_bg         = '#ffffff';
				$input_bg_focus   = '#ffffff';

				// Texts.
				$text_main              = '#565656';
				$text_heading           = '#1a1a1a';
				$text_light             = '#969696';
				$text_sidebar           = '#787878';
				$text_sm_side           = '#565656';
				$text_input             = '#989898';
				$text_input_focus       = '#565656';
				$text_input_placeholder = '#989898';
				$text_footer            = '#dadada';
				$text_footer_heading    = '#989898';
				$text_preloader         = '#ea3c53';

				// Links.
				$color_link              = '#ea3c53';
				$color_link_hover        = '#ad1327';
				$color_link_menu         = '#878787';
				$color_link_menu_hover   = '#dadada';
				$color_link_menu_active  = '#f4f4f4';
				$color_link_footer       = '#dadada';
				$color_link_footer_hover = '#ffffff';			
			}

			// font sizes.
			$base_font_size = get_theme_mod( 'body_font_size', '17' );
			$font_size_h1   = get_theme_mod( 'heading_h1', '2.75' );
			$font_size_h2   = get_theme_mod( 'heading_h2', '2' );
			$font_size_h3   = get_theme_mod( 'heading_h3', '1.75' );
			$font_size_h4   = get_theme_mod( 'heading_h4', '1.5' );
			$font_size_h5   = get_theme_mod( 'heading_h5', '1.25' );
			$font_size_h6   = get_theme_mod( 'heading_h6', '1' );
			$line_height    = get_theme_mod( 'body_line_height', '1.6' );

			// fonts.
			$heading_font = get_theme_mod( 'aiteko_heading_font', WIP_THEMES_DEFAULT_HEADING_FONT );
			$body_font    = get_theme_mod( 'aiteko_body_font', WIP_THEMES_DEFAULT_BODY_FONT );
			
			// heading font name.
			$heading_font_name = explode( ':', $heading_font );
			$heading_font_name = str_replace( '+', ' ', $heading_font_name[0] );

			// Body font name.
			$body_font_name = explode( ':', $body_font );
			$body_font_name = str_replace( '+', ' ', $body_font_name[0] );

			$scss = '
$grid-breakpoints: (
  xs: 0,
  smm: 440px,
  sm: 576px,
  md: 768px,
  lg: 992px,
  xl: 1200px,
  wd: 1310px
)!default;

@import "mixins";

// primary the accent color
$color__primary: ' . $primary . ' !default;

// backgrounds
$color__body-background: ' . $body_bg . ' !default;
$color__side-background: ' . $side_bg . ' !default;
$color__smallside-background: ' . $sm_side_bg . ' !default;
$color__preloader-background: ' . $preloader_bg . ' !default;
$color__preloader-line: ' . $preloaderline_bg . ' !default;
$color__preloader-text: ' . $text_preloader . ' !default;
$color__searchbar-background: ' . $searchbar_bg . ' !default;
$color__footer-background: ' . $footer_bg . ' !default;
$color__input-background: ' . $input_bg . '	!default;
$color__input-background-focus: ' . $input_bg_focus . '	!default;

// Texts
$color__text-main: ' . $text_main . ';
$color__text-heading: ' . $text_heading . ';
$color__text-light: ' . $text_light . ';
$color__side-content: ' . $text_sidebar . ';
$color__smallside-text: ' . $text_sm_side . ';
$color__text-footer-heading: ' . $text_footer_heading . ';
$color__text-footer: ' . $text_footer . ';
$color__text-input: ' . $text_input . ';
$color__text-input-focus: ' . $text_input_focus . ';
$color__text-input-placeholder: ' . $text_input_placeholder . ';

// Links
$color__link: ' . $color_link . ' !default;
$color__link-hover: ' . $color_link_hover . ' !default;
$color__link-menu: ' . $color_link_menu . ' !default;
$color__link-menu-hover: ' . $color_link_menu_hover . ' !default;
$color__link-menu-active: ' . $color_link_menu_active . ' !default;
$color__link-footer: ' . $color_link_footer . ' !default;
$color__link-footer-hover: ' . $color_link_footer_hover . ' !default;

// Borders (auto compile)
$color__content-border: set-diff-color($color__body-background, 6.5%);
$color__side-border: set-diff-color($color__side-background, 6.5%);
$color__smallside-border: set-diff-color($color__smallside-background, 6.5%);
$color__searchbar-border: set-diff-color($color__searchbar-background, 6.5%);
$color__footer-border: set-diff-color($color__footer-background, 6.5%);

// font sizes
$size__font-base: ' . $base_font_size . ' !default;
$size__font-h1: ' . $font_size_h1 . 'rem !default;
$size__font-h2: ' . $font_size_h2 . 'rem !default;
$size__font-h3: ' . $font_size_h3 . 'rem !default;
$size__font-h4: ' . $font_size_h4 . 'rem !default;
$size__font-h5: ' . $font_size_h5 . 'rem !default;
$size__font-h6: ' . $font_size_h6 . 'rem !default;

$line-height: ' . $line_height . ' !default;
$base-font-weight: 400 !default;

$font-family-sans-serif: 	"' . $body_font_name . '", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji" !default;
$font-family-monospace: 	SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace !default;
$font-family-base: 			$font-family-sans-serif !default;
$font-family-heading:		"' . $heading_font_name . '", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji" !default;

// Start the Scss code below
:root {
	font-size: calculation-fontsize($size__font-base, 0.85)+"px";
}
@include media-breakpoint-up(sm) {
	:root {
		font-size: calculation-fontsize($size__font-base, 0.9)+"px";
	}
}
@include media-breakpoint-up(md) {
	:root {
		font-size: calculation-fontsize($size__font-base, 0.95)+"px";
	}
}
@include media-breakpoint-up(lg) {
	:root {
		font-size: $size__font-base+"px";
	}
}

html {
	font-size: 1em;
}

body {
	font-family: $font-family-base;
	font-size: 1rem;
	font-weight: $base-font-weight;
	color: $color__text-main;
	background-color: $color__body-background;
	line-height: $line-height;
}
h1,h2,h3,h4,h5,h6 {
	font-family: $font-family-heading;
	color: $color__text-heading;

	a {
		color: $color__text-heading;

		&:hover {
			color: $color__link;
		}
	}
}

h1 {
	font-size: $size__font-h1;
	line-height: 1.35;
}
h2 {
	font-size: $size__font-h2;
	line-height: 1.15;
}
h3 {
	font-size: $size__font-h3;
	line-height: 1.15;
}
h4 {
	font-size: $size__font-h4;
	line-height: 1.15;
}
h5 {
	font-size: $size__font-h5;
	line-height: 1.15;
}
h6 {
	font-size: $size__font-h6;
}

a {
	color: $color__link;
	-webkit-transition: all 0.25s ease 0s;
	transition: all 0.25s ease 0s;
	&:hover {
		color: $color__link-hover;
	}
}

pre,
code,
kbd,
samp {
	font-family: $font-family-monospace;
}

::-webkit-input-placeholder { /* Chrome/Opera/Safari */
	opacity: 1;
	color: $color__text-input-placeholder;
}
::-moz-placeholder { /* Firefox 19+ */
	opacity: 1;
	color: $color__text-input-placeholder;
}
:-ms-input-placeholder { /* IE 10+ */
	opacity: 1;
	color: $color__text-input-placeholder;
}
:-moz-placeholder { /* Firefox 18- */
	opacity: 1;
	color: $color__text-input-placeholder;
}
::placeholder {
	opacity: 1;
	color: $color__text-input-placeholder;	
}

input[type="submit"],
button[type="submit"] {
	background: $color__primary;
	color: set-diff-color($color__primary, 60%);
	border-width: 0;

	&:hover,
	&:active {
		background: $color__link-hover;
	}
}

table {
	border: 1px solid $color__content-border;
}

input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]),
select,
textarea {
	background: $color__input-background;
	background-clip: padding-box;
	outline-width: 0;
	border: 1px solid $color__content-border;
	-webkit-box-shadow: 0 1px 4px rgba($color__content-border, .5);
	box-shadow: 0 1px 4px rgba($color__content-border, .5);
	-webkit-transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
	transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;

	&:focus {
		background: $color__input-background-focus;
		border-color: set-diff-color($color__body-background, 10%);
		-webkit-box-shadow: 0 1px 3px rgba($color__content-border, .75);
		box-shadow: 0 1px 3px rgba($color__content-border, .75);		
	}
}


//loader here
#aiteko-site-loader {
	position: fixed;
	z-index: 999999;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	overflow: hidden;

	.asl-before,
	.asl-after {
		content: "";
		position: absolute;
		z-index: 1;
		width: 60%;
		height: 100%;
		top: 0;
		background: $color__preloader-background;
	}
	.asl-before {
		left: 0;
	}
	.asl-after {
		right: 0;
	}
	.aiteko-load-line {
		position: absolute;
		z-index: 3;
		top: 0;
		left: 50%;
		width: 160px;
		height: 0;
		overflow: hidden;
		margin-left: -80px;
		will-change: height;
		-webkit-transition: height 0.1s cubic-bezier(0.445, 0.05, 0.55, 0.95) 0s;
		transition: height 0.1s cubic-bezier(0.445, 0.05, 0.55, 0.95) 0s;

		&:before {
			content: "";
			position: absolute;
			left: 50%;
			top: 0;
			width: 2px;
			height: 100%;
			margin-left: -1px;
			background: $color__preloader-line;
		}
	}
	.aiteko-load-text {
		position: absolute;
		font-family: $font-family-heading;
		z-index: 4;
		left: 0;
		top: 50%;
		margin-top: -35px;
		width: 100%;
		height: 70px;
		line-height: 50px;
		font-size: 4rem;
		font-weight: bold;
		text-align: center;
		color: $color__preloader-text;
	}
}

#aiteko--pt0, #aiteko--ptpre {
	background: set-diff-color($color__body-background, 3%);
}
#aiteko--pt1, .sticky--post {
	background: $color__body-background;
}

.aiteko-side {
	background: $color__side-background;

	.brand {
		border-bottom: 1px solid $color__side-border;
	}

	.aiteko--header-footer {
		border-top: 1px solid $color__side-border;
		color: $color__side-content;
	}
}

.aiteko-side-handler {
	background: $color__smallside-background;
	color: $color__smallside-text;
	border-right: 1px solid $color__smallside-border;

	.aiteko-social--list-wrap {
		background: rgba(set-diff-color($color__smallside-background, 2%), .9);
		color: $color__smallside-text;
	}
	ul.aiteko-social--list {
		li {
			a {
				color: $color__smallside-text;
				fill: $color__smallside-text;

				&:hover {
					color: $color__primary;
					fill: $color__primary;
				}
			}
		}
	}
}


// hamburger menu button
$hamburger-padding-x           : 15px !default;
$hamburger-padding-y           : 15px !default;
$hamburger-layer-width         : 24px !default;
$hamburger-layer-height        : 2px !default;
$hamburger-layer-spacing       : 5px !default;
$hamburger-layer-color         : $color__smallside-text !default;
$hamburger-layer-border-radius : 2px !default;
$hamburger-hover-opacity       : 0.7 !default;
$hamburger-active-layer-color  : $hamburger-layer-color !default;
$hamburger-active-hover-opacity: $hamburger-hover-opacity !default;

.hamburger {
	padding: $hamburger-padding-y $hamburger-padding-x;
	display: inline-block;
	cursor: pointer;

	transition-property: opacity, filter;
	transition-duration: 0.15s;
	transition-timing-function: linear;

	// Normalize (<button>)
	font: inherit;
	color: inherit;
	text-transform: none;
	background-color: transparent;
	border: 0;
	margin: 0;
	overflow: visible;
	outline-width: 0;

	&:hover {
		opacity: $hamburger-hover-opacity;
	}

	&:focus,
	&:active {
		outline-width: 0;
	}
	&.is-active {
		outline-width: 0;

		&:hover {
			opacity: $hamburger-active-hover-opacity;
		}

		.hamburger-inner,
		.hamburger-inner::before,
		.hamburger-inner::after {
			background-color: $hamburger-active-layer-color;
		}
	}
}

.hamburger-box {
	width: $hamburger-layer-width;
	height: $hamburger-layer-height * 3 + $hamburger-layer-spacing * 2;
	display: inline-block;
	position: relative;
}

.hamburger-inner {
	display: block;
	top: 50%;
	margin-top: $hamburger-layer-height / -2;

	&,
	&::before,
	&::after {
		width: $hamburger-layer-width;
		height: $hamburger-layer-height;
		background-color: $hamburger-layer-color;
		border-radius: $hamburger-layer-border-radius;
		position: absolute;
		transition-property: transform;
		transition-duration: 0.15s;
		transition-timing-function: ease;
	}

	&::before,
	&::after {
		content: "";
		display: block;
	}

	&::before {
		top: ($hamburger-layer-spacing + $hamburger-layer-height) * -1;
	}

	&::after {
		bottom: ($hamburger-layer-spacing + $hamburger-layer-height) * -1;
	}
}

  .hamburger--arrowalt {
    .hamburger-inner {
      &::before {
        transition: top 0.15s 0.15s ease,
                    transform 0.15s cubic-bezier(0.165, 0.84, 0.44, 1);
      }

      &::after {
        transition: bottom 0.15s 0.15s ease,
                    transform 0.15s cubic-bezier(0.165, 0.84, 0.44, 1);
      }
    }

    &.is-active {
      .hamburger-inner {
        &::before {
          top: 0;
          transform: translate3d($hamburger-layer-width * -0.3, $hamburger-layer-width * -0.18, 0) rotate(-45deg) scale(0.5, 1);
          transition: top 0.15s ease,
                      transform 0.15s 0.15s cubic-bezier(0.895, 0.03, 0.685, 0.22);
        }

        &::after {
          bottom: 0;
          transform: translate3d($hamburger-layer-width * -0.3, $hamburger-layer-width * 0.18, 0) rotate(45deg) scale(0.5, 1);
          transition: bottom 0.15s ease,
                      transform 0.15s 0.15s cubic-bezier(0.895, 0.03, 0.685, 0.22);
        }
      }
    }
  }



ul#aiteko-nav {
	font-family: $font-family-heading;

	a {
		color: $color__link-menu;

		&:hover {
			color: $color__side-background;
			text-shadow: -1px -1px 0 $color__link-menu-hover,  
				1px -1px 0 $color__link-menu-hover,
				-1px 1px 0 $color__link-menu-hover,
				1px 1px 0 $color__link-menu-hover;
		}

		&:before,
		&:after {
			background: $color__primary;
		}
	}

	li.current-menu-item>a {
		color: $color__side-background;
		text-shadow: -1px -1px 0 $color__link-menu-active,  
			1px -1px 0 $color__link-menu-active,
			-1px 1px 0 $color__link-menu-active,
			1px 1px 0 $color__link-menu-active;
		&:before {
			background: $color__primary;
		}
	}

	.arrow-yuk-down {
		color: $color__link-menu;
		background: set-diff-color($color__side-background, 5%);

		svg {
			fill: currentColor;
		}
	}
}


.post-grid {
	.entry-header .entry-title {
		border-bottom: 1px solid $color__content-border;
		&:before {
			background: $color__primary;
		}
	}
	.entry-footer {
		a {
			color: $color__text-light;
		}
	}
	.entry-thumbnail {
		background-color: set-diff-color($color__body-background, 5%);

		.preloader-block{
			background: $color__body-background;
		}

		.read-more-block {
			background: $color__primary;
			color: #fff;
			fill: #fff;
		}
	}
}

.portfolio-grid {
	.portfolio-inner {
		background: $color__body-background;
		border: 1px solid $color__content-border;

		.p__t_splash_o,
		.p__tt_splash_o,
		.p__y_splash_o {
			background: $color__body-background;
		}

		.p__t_splash_i,
		.p__tt_splash_i,
		.p__y_splash_i {
			background: set-diff-color($color__body-background, 5%);
		}
	}
}

.aiteko-portfolio-single {
	.p__tt_splash_o,
	.p__y_splash_o {
		background: $color__body-background;
	}

	.p__tt_splash_i,
	.p__y_splash_i {
		background: set-diff-color($color__body-background, 5%);
	}	
}

.aiteko-main {
	background: $color__body-background;
}

.aiteko-single-post {
	.single-post-opener {
		.single-post-featured-image {
			&:before {
				content: "";
				position: absolute;
				z-index: 0;
				top: -2rem;
				right: -2rem;
				width: 250px;
				height: 250px;
				background: set-diff-color($color__body-background, 5%);
				opacity: 1;
			}
		}
		.single-entry-headers {
			.cat-links {
				a {
					position: relative;
					-webkit-transition: color 0.5s cubic-bezier(.785,.135,.15,.86) 0s;
					transition: color 0.5s cubic-bezier(.785,.135,.15,.86) 0s;

					&:before {
						content: "";
						position: absolute;
						z-index: -1;
						display: block;
						top: 0;
						left: 0;
						width: 25px;
						height: 100%;
						will-change: width;
						background: set-diff-color($color__body-background, 5%);
						-webkit-transition: width 0.5s cubic-bezier(.785,.135,.15,.86) 0s, background 0.5s cubic-bezier(.785,.135,.15,.86) 0s;
						transition: width 0.5s cubic-bezier(.785,.135,.15,.86) 0s, background 0.5s cubic-bezier(.785,.135,.15,.86) 0s;
					}

					&:hover {
						color: set-diff-color($color__primary, 35%);

						&:before {
							width: 100%;
							background: $color__primary;
						}			
					}
				}
			}
		}
	}
}

.aiteko-the-content {
	ul.wp-block-latest-posts,
	ul.wp-block-categories-list,
	ul.wp-block-archives-list {
		li:not(:first-child),
		ul.children {
			border-top: 1px solid $color__content-border;
		}

		&.is-grid {
			li:first-child {
				border-top: 1px solid $color__content-border;
			}
		}			
	}

	ol.wp-block-latest-comments {

		.wp-block-latest-comments__comment {
			border-bottom: 1px solid $color__content-border;
		}
		.wp-block-latest-comments__comment-excerpt {
			background: rgba(0,0,0, .05);
		}
		.wp-block-latest-comments__comment-author {
			background: $color__link;
			color: #fff;			
		}
	}

	.wp-block-file {
		background: rgba(0,0,0, .05);
	}
	.wp-block-audio {
		.mejs-container.aiteko-mejs-container .mejs-controls {
			-webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(0,0,0, .05);
			box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(0,0,0, .05);
		}
	}

	.wp-block-code {
		background: set-diff-color( $color__body-background, 3%);
		color: inherit;
	}
	code,
	p code {
		background: set-diff-color( $color__body-background, 3%);
		color: inherit;
	}

	.wp-block-preformatted {
		border: 1px solid $color__content-border;
	}

	blockquote,
	.wp-block-quote {
		cite {
			&:before {
				background: set-diff-color( $color__body-background, 10%);
			}
		}
	}

	.wp-block-separator {
		border-bottom: 2px solid set-diff-color( $color__body-background, 25%);

		&.is-style-wide {
			border-bottom-width: 1px;
		}
		&.is-style-dots {
			border-color: transparent;
		}
	}

	.wp-block-table {
		td,
		th {
			border: 1px solid $color__content-border;
		}
	}
	.wp-playlist {
		border: 1px solid $color__content-border;
		.mejs-container.aiteko-mejs-container .mejs-controls {
			-webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(0,0,0, .05);
			box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(0,0,0, .05);
		}
	}

	.tags-links a {
		background: set-diff-color( $color__body-background, 5%);

		&:hover {
			color: set-diff-color( $color__body-background, 50%);
			background: set-diff-color( $color__body-background, 10%);
		}
	}

	.post-password-form {
		border: 1px solid $color__content-border;
	}
}

@include media-breakpoint-up(md) {
	.aiteko-single-post {
		.single-post-opener {
			.single-post-featured-image {
				&:before {
					top: -3rem;
					right: -3rem;
				}
			}
		}
	}
}

.author-box-bio {
	background: set-diff-color($color__body-background, 5%);
}
.navigation{
	&.pagination,
	&.comments-pagination {
		.page-numbers {
			border: 1px solid $color__content-border;
		}
	}
}
.navigation{
	&.post-navigation {
		border: 1px solid $color__content-border;
		.nav-links {
			.nav-previous,
			.nav-next {
				background: $color__body-background;
			}
			.nav-previous {
				-webkit-box-shadow: 1px 0 0 0 $color__content-border;
				box-shadow: 1px 0 0 0 $color__content-border;
			}
			.nav-next {
				-webkit-box-shadow: -1px 0 0 0 $color__content-border, 0 -1px 0 0 $color__content-border;
				box-shadow: -1px 0 0 0 $color__content-border, 0 -1px 0 0 $color__content-border;
			}

			.nav-title {
				font-family: $font-family-heading;
				color: $color__body-background;
				letter-spacing: .15rem;
				text-shadow: -1px -1px 0 $color__text-main,
					1px -1px 0 $color__text-main,
					-1px 1px 0 $color__text-main,
					1px 1px 0 $color__text-main;
			}
		}
	}
}

@supports ((-webkit-text-stroke-color: #666666) and (-webkit-text-fill-color: #ffffff)) {
	.navigation{
		&.post-navigation {
			.nav-links {
				.nav-title {
					text-shadow: none;
					-webkit-text-stroke-color: $color__text-main;
					-webkit-text-fill-color: transparent;
					-webkit-text-stroke-width: 1px;
					-webkit-text-stroke-width-background-position: 100%;
					paint-order: stroke fill;
					letter-spacing: .025rem;
				}
			}
		}
	}
}

header#archive-title {
	.shadowed {
		display: block;
		font-size: .5em;
		text-transform: lowercase;
		letter-spacing: .15rem;
		padding-left: .175rem;
		opacity: .5;
		color: $color__body-background;
		text-shadow: -1px -1px 0 $color__text-main,
			1px -1px 0 $color__text-main,
			-1px 1px 0 $color__text-main,
			1px 1px 0 $color__text-main;
	}
}
.aiteko-page--404-content {
	h1 {
		color: $color__body-background;
		text-shadow: -1px -1px 0 $color__text-main,
			1px -1px 0 $color__text-main,
			-1px 1px 0 $color__text-main,
			1px 1px 0 $color__text-main;		
	}
}

@supports ((-webkit-text-stroke-color: #666666) and (-webkit-text-fill-color: #ffffff)) {
	.aiteko-page--404-content {
		h1 {
			text-shadow: none;
			-webkit-text-stroke-color: $color__text-main;
			-webkit-text-fill-color: transparent;
			-webkit-text-stroke-width: 1px;
			-webkit-text-stroke-width-background-position: 100%;
			paint-order: stroke fill;		
		}
	}	
}


@include media-breakpoint-up(md) {
	.navigation{
		&.post-navigation {
			.nav-links {
				.nav-next {
					-webkit-box-shadow: -1px 0 0 0 $color__content-border;
					box-shadow: -1px 0 0 0 $color__content-border;
				}
			}
		}
	}
}

.portfolio-default {
	.portfolio-inner {
		.portfolio-thumbnail-link:before {
			background-image: linear-gradient( to bottom, rgba($color__body-background, 0.01) 0%, rgba($color__body-background, 0.95) 100%);
		}
	}
}
@include media-breakpoint-up(lg) {
	.aiteko-single-post {
		.single-post-opener {
			.single-post-featured-image {
				&:before {
					top: -4rem;
					right: -4rem;
				}
			}
		}
	}
	.portfolio-default {
		.portfolio-inner {
			.portfolio-thumbnail-link:before {
				background-image: linear-gradient( to right, rgba($color__body-background, 0.01) 0%, rgba($color__body-background, 0.95) 100%);
			}
		}
	}
}

#autoload-pagination,
#moreload-pagination {
	span {
		border: 4px solid $color__primary;
	}
}

.page-links {
	.page-number {
		background: set-diff-color($color__body-background, 5%);
	}

	a .page-number {
		background: transparent;
	}
	a{
		&:hover {
			color: set-diff-color($color__primary, 50%);
		}
		&:before {
			background: $color__primary;
		}
	}
}

.blank.no-posts {
	background-color: set-diff-color($color__body-background, 1%);
	-webkit-box-shadow: 0 3px 15px rgba($color__content-border, .5);
	box-shadow: 0 3px 15px rgba($color__content-border, .5);
	border: 1px solid $color__content-border;
}

#aiteko-search-form {
	background: $color__searchbar-background;

	.aiteko--close-search-form {
		background-color: set-diff-color($color__searchbar-background, 15%);
		color: set-diff-color($color__searchbar-background, 40%);
		fill: set-diff-color($color__searchbar-background, 40%);

		&:hover {
			background-color: set-diff-color($color__searchbar-background, 25%);
			color: set-diff-color($color__searchbar-background, 60%);
			fill: set-diff-color($color__searchbar-background, 60%);			
		}
	}

	form.search-form {
		border-width: 0;
		border-bottom: 1px solid set-diff-color($color__searchbar-background, 20%);

		input[type="search"] {
			color: set-diff-color($color__searchbar-background, 60%);
			&::-webkit-input-placeholder {
				opacity: 1;
				color: set-diff-color($color__searchbar-background, 40%);
			}
			&::-moz-placeholder {
				opacity: 1;
				color: set-diff-color($color__searchbar-background, 40%);
			}
			&:-ms-input-placeholder {
				opacity: 1;
				color: set-diff-color($color__searchbar-background, 40%);
			}
			&:-moz-placeholder {
				opacity: 1;
				color: set-diff-color($color__searchbar-background, 40%);
			}
			&::placeholder {
				opacity: 1;
				color: set-diff-color($color__searchbar-background, 40%);
			}
		}
		label{
			&:before {
				color: set-diff-color($color__searchbar-background, 60%);
			}
		}
	}
}

.onviewport {
	&:before {
		background: set-diff-color($color__body-background, 5%);
	}
	&:after {
		background: $color__body-background;
	}
}

#comments {
	background: $color__body-background;

	p.comment-form-comment {
		#js-cancel-comment {
			border: 1px solid rgba(0,0,0, .1);
			color: rgba(0,0,0, .54);
			background: rgba(0,0,0,0);
			&:hover {
				border-color: rgba(0,0,0, .25);
				color: rgba(0,0,0, .82);
			}
		}
	}
	ol.comment-list {
		li.comment {
			article {
				background: $color__body-background;
				-webkit-box-shadow: 0 1px 4px rgba($color__content-border, .5);
				box-shadow: 0 1px 4px rgba($color__content-border, .5);
				border: 1px solid $color__content-border;			
			}
		}
		li.pingback {
			.comment-body {
				background: $color__body-background;
				-webkit-box-shadow: 0 1px 4px rgba($color__content-border, .5);
				box-shadow: 0 1px 4px rgba($color__content-border, .5);
				border: 1px solid $color__content-border;
			}
		}
	}
	#cancel-comment-reply-link {
		font-family: $font-family-base;
		border: 1px solid rgba(0,0,0, .1);
		color: rgba(0,0,0, .54);
		background: rgba(0,0,0,0);

		&:hover {
			border-color: rgba(0,0,0, .25);
			color: rgba(0,0,0, .82);
		}
	}
	.comment-reply-link {
		border: 1px solid rgba(0,0,0, .1);
		color: rgba(0,0,0, .54);
		background: rgba(0,0,0,0);

		&:hover {
			border-color: rgba(0,0,0, .25);
			color: rgba(0,0,0, .82);
		}
	}
	.no-comments {
		background: set-diff-color($color__body-background, 5%);
	}

	form {
		p.logged-in-as {
			background: set-diff-color($color__body-background, 5%);

			a:hover {
				text-decoration: underline;
			}
		}
	}
	.comment-content {
		code,
		p code,
		pre {
			background: set-diff-color( $color__body-background, 3%);
			color: inherit;
		}
	}
}

.aiteko-site-footer {
	background: $color__footer-background;
	color: $color__text-footer;
	border-color: $color__footer-border;

	.footer-widgets {
		border-bottom: 1px solid $color__footer-border;
	}

	a {
		color: $color__link-footer;
		fill: $color__link-footer;

		&:hover {
			color: $color__link-footer-hover;
			fill: $color__link-footer-hover;
		}
	}

	h1,h2,h3,h4,h5,h6 {
		color: $color__text-footer-heading;
	}
}

.sidebarbox,
div[class*="widget_"] {
	ul {
		ul,
		li:not(:first-child) {
			border-top: 1px solid $color__footer-border;
		}
	}
}
.widget_nav_menu {
	li.current-menu-item>a {
		padding-left: .25rem;
		padding-right: .25rem;
		border-radius: 3px;
		background: $color__link;
		color: set-diff-color( $color__link, 50%);
	}
}
.widget_categories {
	li.current-cat>a {
		padding-left: .25rem;
		padding-right: .25rem;
		border-radius: 3px;
		background: $color__link;
		color: set-diff-color( $color__link, 50%);			
	}
}
.widget_pages {
	li.current_page_item>a {
		padding-left: .25rem;
		padding-right: .25rem;
		border-radius: 3px;
		background: $color__link;
		color: set-diff-color( $color__link, 50%);
	}
}
.widget_recent_comments {
	.comment-author-link {
		background: $color__link;
		color: set-diff-color( $color__link, 50%);
		a {
			color: set-diff-color( $color__link, 50%);
		}	
	}
}
.widget_calendar {
	.calendar_wrap {
		background: $color__footer-background;
		table#wp-calendar {
			thead {
				th {
					background: rgba(0,0,0, .075);
				}
			}
			tbody {
				td a {
					background: $color__link;
					color: set-diff-color( $color__link, 50%);
				}
				tr:nth-child(even) td {
					background: rgba(0,0,0, .05);
				}
			}
			tfoot {
				td {
					border-top: 1px solid $color__footer-border;
					border-bottom: 2px solid $color__footer-border;
				}
			}
		}
	}
}
.tagcloud {
	ul li {
		a {
			background: $color__link;
			color: set-diff-color( $color__link, 50%);

			&:hover {
				background: $color__link-hover;
			}
		}
	}
}
._99crv-ig-wrap {
	p {
		a {
			background: $color__link;
			color: set-diff-color( $color__link, 50%);
		}
	}
}
._99crv-about-widget {
	background: $color__footer-background;
}

.pace .pace-progress {
	background: $color__primary;
}';

			return $scss;
		}

		/**
		 * Check if user has activate the custom skin or not
		 *
		 * @return bool
		 */
		public function set_status() {
			$status_check = get_theme_mod( 'enable_custom_skin' );
			
			if ( empty( $status_check ) ) {
				$status = false;
			} else {
				$status = true;
			}

			$this->active = $status;
			return $this->active;
		}
	} // End class.
} // End class exists check.
