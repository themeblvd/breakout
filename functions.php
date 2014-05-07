<?php
/*-----------------------------------------------------------------------------------*/
/* Theme Configuration
/*-----------------------------------------------------------------------------------*/

// Constants
define( 'TB_FRAMEWORK_VERSION', '2.0.4' );
define( 'TB_UPDATE_LOG_URL', 'http://www.themeblvd.com/demo/breakout/wp-content/themes/breakout/changelog.txt' );
define( 'TB_FRAMEWORK_URL', TEMPLATEPATH.'/framework' );
define( 'TB_FRAMEWORK_DIRECTORY', get_template_directory_uri().'/framework' );
define( 'TB_GETTEXT_DOMAIN', 'themeblvd' );

/**
 * Breakout Setup 
 * 
 * You can override this function from a child 
 * theme if any basic setup things need to be changed.
 */

if( ! function_exists( 'breakout_setup' ) ) {
	function breakout_setup() {

		// Content Width
		$content_width = 940; // Default width of primary content area
		
		// Thumbnail sizes
		add_image_size( 'large', $content_width, 9999, false ); 	// 940 => Full width thumb for 1-col page
		add_image_size( 'medium', 620, 9999, false ); 				// 620 => Full width thumb for 2-col/3-col page
		add_image_size( 'small', 195, 195, false ); 				// Square'ish thumb floated left
		/* Slider - Heights equal at 350 */
		add_image_size( 'slider-large', 940, 350, true );			// Slider full-size image
		add_image_size( 'slider-staged', 564, 350, true );			// Slider staged image
		/* Grid - Ratio: 200:125 */
		add_image_size( 'grid_fifth_1', 200, 125, true );			// 1/5 Column
		add_image_size( 'grid_3', 240, 150, true );					// 1/4 Column
		add_image_size( 'grid_4', 320, 200, true );					// 1/3 Column
		add_image_size( 'grid_6', 472, 295, true );					// 1/2 Column
		
		// Localization
		load_theme_textdomain( TB_GETTEXT_DOMAIN, get_template_directory() . '/lang' );
	}
}
add_action( 'after_setup_theme', 'breakout_setup' );

/**
 * Breakout CSS Files
 *
 * To add styles or remove unwanted styles that you 
 * know you won't need to maybe save some frontend load 
 * time, this function can easily be re-done from a 
 * child theme.
 */

if( ! function_exists( 'breakout_css' ) ) {
	function breakout_css() {		
		if( ! is_admin() ) {
			wp_register_style( 'themeblvd_theme', get_template_directory_uri() . '/assets/css/theme.min.css', false, '1.0' );
			wp_register_style( 'themeblvd_responsive', get_template_directory_uri() . '/assets/css/responsive.min.css', false, '1.0' );
			wp_register_style( 'themeblvd_colors', get_template_directory_uri() . '/assets/css/colors.min.css', false, '1.0' );
			wp_register_style( 'themeblvd_ie', get_template_directory_uri() . '/assets/css/ie.css', false, '1.0' );
			wp_enqueue_style( 'themeblvd_theme' );
			if( themeblvd_get_option( 'responsive_css' ) != 'false' ) wp_enqueue_style( 'themeblvd_responsive' );
			wp_enqueue_style( 'themeblvd_colors' );
			$GLOBALS['wp_styles']->add_data( 'themeblvd_ie', 'conditional', 'lt IE 9' ); // Add IE conditional
			wp_enqueue_style( 'themeblvd_ie' );
		}
	}
}
add_action( 'wp_print_styles', 'breakout_css', 11 ); // Needs to come after framework CSS files

/**
 * Breakout Styles 
 * 
 * This is where the theme's configured styles 
 * from the Theme Options page get put into place 
 * by inserting CSS in the <head> of the site. It's 
 * shown here as clearly as possible to be edited, 
 * however it gets compressed when actually inserted 
 * into the front end of the site.
 */

if( ! function_exists( 'breakout_styles' ) ) {
	function breakout_styles() {
		$custom_styles = themeblvd_get_option( 'custom_styles' );
		$body_font = themeblvd_get_option( 'typography_body' );
		$header_font = themeblvd_get_option( 'typography_header' );
		$special_font = themeblvd_get_option( 'typography_special' );
		themeblvd_include_google_fonts( $body_font, $header_font, $special_font );
		echo '<style>'."\n";
		ob_start();
		?>
		<?php if( themeblvd_config( 'featured' ) ) : ?>
		/* Main BG correction if featured area is showing */
		#main .main-inner {
			background-image: none;
		}
		<?php endif; ?>
		/* Fonts */
		body {
			font-family: <?php echo themeblvd_get_font_face($body_font); ?>;
			font-size: <?php echo $body_font['size'];?>;
		}
		h1, h2, h3, h4, h5, h6, .slide-title {
			font-family: <?php echo themeblvd_get_font_face($header_font); ?>;
		}
		#branding .header_logo .tb-text-logo,
		#featured .media-full .slide-title,
		#content .media-full .slide-title,
		.element-slogan .slogan .slogan-text,
		.element-tweet,
		.special-font {
			font-family: <?php echo themeblvd_get_font_face($special_font); ?>;
		}
		/* Primary Color */
		body,
		#top,
		#bottom,
		#bottom .copyright span,
		#featured .media-full .slide-title span,
		#content .media-full .slide-title span,
		.standard-slider .image-link,
		.carrousel-slider .image-link {
			background-color: <?php echo themeblvd_get_option('primary_color'); ?>;
		}
		/* Link Colors */
		a {
			color: <?php echo themeblvd_get_option('link_color'); ?>;
		}
		a:hover {
			color: <?php echo themeblvd_get_option('link_hover_color'); ?>;
		}
		#branding .header_logo .tb-text-logo:hover,
		#featured .media-full .tb-button,
		#content .media-full .tb-button,
		.entry-title a:hover,
		#main .widget ul li a:hover,
		#main #breadcrumbs a:hover,
		.tags a:hover,
		.entry-meta a:hover {
			color: <?php echo themeblvd_get_option('link_hover_color'); ?> !important;
		}
		#top a,
		#bottom a {
			color: <?php echo themeblvd_get_option('footer_link_color'); ?>;
		}
		#top a:hover,
		#bottom a:hover ,
		#bottom .widget ul li a:hover {
			color: <?php echo themeblvd_get_option('footer_link_hover_color'); ?>;
		}
		<?php if( themeblvd_get_option( 'responsive_css' ) == 'false' ) : ?>
		#top #branding .content,
		#main .main-content,
		#featured .featured-content,
		#colophon .footer_content,
		#colophon #footer_sub_content,
		#colophon .footer-below {
			width: 960px;
		}
		#top #branding .content {
			width: 976px;
		}
		#colophon #footer_sub_content {
			width: 980px;
		}
		<?php endif; ?>
		<?php
		// Ouptput compressed CSS
		echo themeblvd_compress( ob_get_clean() );
		// Add in user's custom CSS
		if( $custom_styles ) echo $custom_styles;
		echo "\n</style>\n";
	}
}
add_action( 'wp_head', 'breakout_styles' ); // Must come after framework loads styles, which are hooked with wp_print_styles

/**
 * Breakout Body Classes 
 * 
 * Here we filter WordPress's default body_class()
 * function to include necessary classes for Main 
 * Styles selected in Theme Options panel.
 */

if( ! function_exists( 'breakout_body_class' ) ) {
	function breakout_body_class( $classes ) {
		$classes[] = themeblvd_get_option( 'content_color' );
		return $classes;
	}
}
add_filter( 'body_class', 'breakout_body_class' );

/*-----------------------------------------------------------------------------------*/
/* Run ThemeBlvd Framework
/*-----------------------------------------------------------------------------------*/

require_once ( TB_FRAMEWORK_URL . '/themeblvd.php' );

/*-----------------------------------------------------------------------------------*/
/* Theme Filters
/*
/* Here we can take advantage of modifying anything in the framework that is 
/* filterable. 
/*-----------------------------------------------------------------------------------*/

/* Text String Overwrites */

if( ! function_exists( 'breakout_frontend_locals' ) ) {
	function breakout_frontend_locals( $locals ) {
		$locals['read_more'] = __( 'View Post', TB_GETTEXT_DOMAIN );
		return $locals;
	}
}

/* De-register footer navigation for this theme */

if( ! function_exists( 'breakout_nav_menus' ) ) {
	function breakout_nav_menus( $menus ) {
		unset( $menus['footer'] );
		return $menus;
	}
}

/* Remove header area widget area (not supported in theme) */

if( ! function_exists( 'breakout_sidebar_locations' ) ) {
	function breakout_sidebar_locations( $locations ) {
		unset( $locations['ad_header'] );
		return $locations;
	}
}

/* Add Breakout's Homepage to Layout Builder samples */

if( ! function_exists( 'breakout_sample_layouts' ) ) {
	function breakout_sample_layouts( $samples ) {
		$breakout = array(
			'breakout' => array(
				'name' => 'Breakout Homepage',
				'id' => 'breakout',
				'preview' => get_template_directory_uri().'/assets/images/sample-breakout.png',
				'credit' => 'This is the layout used in the <a href="http://themeblvd.com/demo/breakout" target="_blank">Breakout demo website\'s homepage</a>.',
				'sidebar_layout' => 'full_width',
				'featured' => array(
					'element_1' => array(
						'type' => 'slider',
						'query_type' => 'secondary',
						'options' => array(
							'slider_id' => null
						)
					)
				),
				'primary' => array(
					'element_2' => array(
						'type' => 'tabs',
						'query_type' => 'none',
						'options' => array(
							'setup' => array (
								'num' => 2,
								'style' => 'open',
								'names' => array(
									'tab_1' => 'Why Breakout?',
									'tab_2' => 'From the Portfolio'
								)
							),
							'height' => '',                 
							'tab_1' => array (
								'type' => 'raw',
								'raw' => '[raw]

[one_third]
<h3>A WordPress Experience</h3>
<img src="http://themeblvd.com/demo/assets/breakout/breakout_layout_1.png" class="pretty" />
<p>Utilizing the all-new version 2 of the Theme Blvd Framework, Breakout provides a WordPress experience like you\'ve never experienced with things like the Layout Builder.</p>
[/one_third]
[one_third]
<h3>Responsive Design</h3>
<img src="http://themeblvd.com/demo/assets/breakout/breakout_layout_2.png" class="pretty" />
<p>The entire Theme Blvd framework was built from the ground up with the intention of making sure all of its themes display gracefully no matter where you view them.</p>
[/one_third]
[one_third last]
<h3>HTML5 and CSS3</h3>
<img src="http://themeblvd.com/demo/assets/breakout/breakout_layout_3.png" class="pretty" />
<p>Many themes around the community are marketing themselves with the HTML5 emblem, but Breakout is truly built to give you the most modern web experience possible.</p>
[/one_third]

[/raw]'
							),
							'tab_2' => array (
								'type' => 'raw',
								'raw' => '[raw]
[two_third]
[post_grid categories="portfolio" columns="3" rows="2"]
[/two_third]
[one_third last]
<h4>We\'re doing some awesome things.</h4>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
<a href="#" class="lead-link">View Portfolio →</a>
[/one_third]
[/raw]'
							),
							'tab_3' => array (
								'type' => null
							),
							'tab_4' => array (
								'type' => null
							),
							'tab_5' => array (
								'type' => null
							),
							'tab_6' => array (
								'type' => null
							),
							'tab_7' => array (
								'type' => null
							),
							'tab_8' => array (
								'type' => null
							),
							'tab_9' => array (
								'type' => null
							),
							'tab_10' => array (
								'type' => null
							),
							'tab_11' => array (
								'type' => null
							),
							'tab_12' => array (
								'type' => null
							)
						)
					)
				)
			)
		);
		$samples = array_merge( $breakout, $samples );
		return $samples;
	}
}

/* Function of all filters to hook down under "Hook Adjustments" */

if( ! function_exists( 'breakout_filters' ) ) {
	function breakout_filters() {
		add_filter( 'themeblvd_frontend_locals', 'breakout_frontend_locals' );
		add_filter( 'themeblvd_nav_menus', 'breakout_nav_menus' );
		add_filter( 'themeblvd_sidebar_locations', 'breakout_sidebar_locations' );
		add_filter( 'themeblvd_sample_layouts', 'breakout_sample_layouts' );
	}
}

/*-----------------------------------------------------------------------------------*/
/* Theme Functions
/*
/* The following functions either add elements to unsed hooks in the framework, 
/* or replace default functions. These functions can be overridden from a child 
/* theme.
/*-----------------------------------------------------------------------------------*/

/* Header Addon */

if( ! function_exists( 'breakout_social_media' ) ) {
	function breakout_social_media() {
		?>
		<div class="social-media">
			<?php echo themeblvd_contact_bar(); ?>
		</div><!-- .social-media (end) -->
		<?php
	}
}

/* Featured slider on blog */

if( ! function_exists( 'breakout_featured_blog' ) ) {
	function breakout_featured_blog() {
		if( themeblvd_get_option( 'blog_featured' ) ){
			echo '<div class="element">';
			themeblvd_slider( themeblvd_get_option( 'blog_slider' ) );
			echo '</div>';
		}
	}
}

/* End of Featured section (adds the secondary bg panel) */

if( ! function_exists( 'breakout_featured_end' ) ) {
	function breakout_featured_end() {
		?>
					<div class="clear"></div>
				</div><!-- .featured-content (end) -->
				<div class="secondary-bg"></div>
			</div><!-- .featured-inner (end) -->
		</div><!-- #featured (end) -->
		
		<!-- FEATURED (end) -->
		<?php
	}
}

/* Archive Titles */

if( ! function_exists( 'breakout_content_top' ) ) {
	function breakout_content_top() {
		if( is_archive() ) {
			if( themeblvd_get_option( 'archive_title' ) != 'false' ) {
				echo '<div class="element element-headline primary-entry-title">';
				echo '<h1 class="entry-title">';
				themeblvd_archive_title();
				echo '</h1>';
				echo '</div><!-- .element (end) -->';
			}
		}
		
	}
}

/*-----------------------------------------------------------------------------------*/
/* Hook Adjustments on framework
/*-----------------------------------------------------------------------------------*/

// Remove hooks
remove_action( 'themeblvd_featured_end', 'themeblvd_featured_end_default' );

// Add hooks
add_action( 'after_setup_theme', 'breakout_filters' );
add_action( 'themeblvd_header_addon', 'breakout_social_media' );
add_action( 'themeblvd_featured_end', 'breakout_featured_end' );
add_action( 'themeblvd_featured_blog', 'breakout_featured_blog' );
add_action( 'themeblvd_content_top', 'breakout_content_top');