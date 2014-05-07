<?php
/*-----------------------------------------------------------------------------------*/
/* Theme Functions
/* 
/* In premium Theme Blvd themes, this file will contains everything that's needed 
/* to modify the framework's default setting to construct the current theme.
/*-----------------------------------------------------------------------------------*/

// Define theme ID
define( 'TB_THEME_ID', 'breakout' );

// Modify framework's theme options
require_once( get_template_directory() . '/includes/options.php' );

/**
 * Breakout Setup 
 * 
 * You can override this function from a child 
 * theme if any basic setup things need to be changed.
 */

if( ! function_exists( 'breakout_setup' ) ) {
	function breakout_setup() {
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
add_action( 'wp_print_styles', 'breakout_css' );

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
		$accent_color = themeblvd_get_option('accent_color');
		$textures = themeblvd_get_textures();
		$content_texture = themeblvd_get_option( 'content_texture' );
		$header_texture = themeblvd_get_option( 'header_texture' );
		$footer_texture = themeblvd_get_option('footer_texture' );
		$custom_styles = themeblvd_get_option( 'custom_styles' );
		$body_font = themeblvd_get_option( 'typography_body' );
		$header_font = themeblvd_get_option( 'typography_header' );
		$special_font = themeblvd_get_option( 'typography_special' );
		themeblvd_include_google_fonts( $body_font, $header_font, $special_font );
		echo '<style>'."\n";
		ob_start();
		?>
		/* Fonts */
		body {
			font-family: <?php echo themeblvd_get_font_face($body_font); ?>;
			font-size: <?php echo $body_font['size'];?>;
		}
		h1, h2, h3, h4, h5, h6, .slide-title {
			font-family: <?php echo themeblvd_get_font_face($header_font); ?>;
		}
		#featured .media-full .slide-title,
		#content .media-full .slide-title,
		#featured_below .media-full .slide-title,
		.element-slogan .slogan .slogan-text,
		.element-tweet,
		.special-font {
			font-family: <?php echo themeblvd_get_font_face($special_font); ?>;
		}
		/* Content Texture */
		#wrapper {
			<?php if( $content_texture == 'none' ) : ?>
			background-image: none;
			<?php else : ?>
			background-image: url(<?php echo $textures[$content_texture]['url']; ?>);
			background-position: <?php echo $textures[$content_texture]['position']; ?>;
			background-repeat: <?php echo $textures[$content_texture]['repeat']; ?>;
			<?php endif; ?>
		}
		/* Accent Color */
		#featured .media-full .slide-title span,
		#content .media-full .slide-title span,
		#featured_below .media-full .slide-title span,
		.standard-slider .image-link,
		.carrousel-slider .image-link,
		.default,
		.default:hover {
			background-color: <?php echo $accent_color; ?>;
			<?php if( 'accent_text_dark' == themeblvd_get_option( 'accent_text' ) ) : ?>
			color: #666666;
			<?php else : ?>
			color: #ffffff;
			<?php endif; ?>
		}
		.default {
			border: 1px solid <?php echo themeblvd_adjust_color( $accent_color ); ?>;
		}
		/* Header Color and Texture */
		#top {
			background-color: <?php echo themeblvd_get_option('header_color'); ?>;
			<?php if( $header_texture == 'none' ) : ?>
			background-image: none;
			<?php else : ?>
			background-image: url(<?php echo $textures[$header_texture]['url']; ?>);
			background-position: <?php echo $textures[$header_texture]['position']; ?>;
			background-repeat: <?php echo $textures[$header_texture]['repeat']; ?>;
			<?php endif; ?>
		}		
		<?php if( 'header_text_dark' == themeblvd_get_option( 'header_text' ) ) : ?>
		#top:after {
			content:"";
			background: url(<?php echo get_template_directory_uri(); ?>/assets/images/thin-light-divider.png) 0 bottom repeat-x;
			display:block;
			padding-bottom: 1px;
		}
		#top,
		#top a,
		.header_logo .tagline,
		#access li a,
		#access li a:hover {
			color: #666666;
		}
		#branding {
			background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/thick-light-divider.png);
		}
		#access li.home a,
		#access li.home a:hover {
			background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/menu-home-light.png);
		}
		#branding .themeblvd-contact-bar li a {
			background-image: url(<?php echo get_template_directory_uri(); ?>/framework/frontend/assets/images/parts/social-media-dark.png);
		}
		#access .container,
		#access:after,
		#access:before,
		#access li a:hover {
			background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/menu-bg-light.png);
		}
		#access li {
			background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/menu-divider-light.png);
		}
		#access li a > .sf-sub-indicator {
    		background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/sf-arrows-505050.png);
    	}
		<?php endif; ?>
		/* Footer Color and Texture */
		body,
		#bottom,
		#bottom .copyright span {
			background-color: <?php echo themeblvd_get_option('footer_color'); ?>;
			<?php if( $footer_texture == 'none' ) : ?>
			background-image: none;
			<?php else : ?>
			background-image: url(<?php echo $textures[$footer_texture]['url']; ?>);
			background-position: <?php echo $textures[$footer_texture]['position']; ?>;
			background-repeat: <?php echo $textures[$footer_texture]['repeat']; ?>;
			<?php endif; ?>
		}
		<?php if( 'footer_text_dark' == themeblvd_get_option( 'footer_text' ) ) : ?>
		#bottom {
			color: #666666;
		}
		#bottom #colophon,
		#bottom .copyright {
			background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/thick-light-divider.png);
		}
		#bottom .tb-contact_widget ul.simple-contact li.link,
		#bottom .tb-contact_widget ul.simple-contact li.phone,
		#bottom .tb-contact_widget ul.simple-contact li.email,
		#bottom .tb-contact_widget ul.simple-contact li.contact,
		#bottom .tb-contact_widget ul.simple-contact li.skype {
			background-image: url(<?php echo get_template_directory_uri(); ?>/framework/frontend/assets/images/parts/simple-contact.png);
		}
		<?php endif; ?>
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
		#featured_below .media-full .tb-button,
		.entry-title a:hover,
		#main .widget ul li a:hover,
		#main #breadcrumbs a:hover,
		.tags a:hover,
		.entry-meta a:hover {
			color: <?php echo themeblvd_get_option('link_hover_color'); ?> !important;
		}
		#bottom a {
			color: <?php echo themeblvd_get_option('footer_link_color'); ?>;
		}
		#top a:hover,
		#bottom a:hover ,
		#bottom .widget ul li a:hover {
			color: <?php echo themeblvd_get_option('footer_link_hover_color'); ?>;
		}
		<?php if( themeblvd_get_option( 'responsive_css' ) == 'false' ) : ?>
		/* Non-Responsive Structure */
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
		<?php else : ?>
			<?php if( themeblvd_get_option( 'mobile_nav' ) == 'mobile_nav_select' ) : ?>
			@media (max-width: 480px) {
				#access {
					display:none;
				}
				.responsive-nav {
					display: block;
				}
			}
			<?php endif; ?>
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
/* Add Sample Layout
/*
/* Here we add a sample layout to the layout builder's sample layouts.
/*-----------------------------------------------------------------------------------*/

$elements = array(
	array(
		'type' => 'slider',
		'location' => 'featured'
	),
	array(
		'type' => 'tabs',
		'location' => 'primary',
		'defaults' => array(
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
				'raw' => "[one_third]\n<h3>A WordPress Experience</h3>\n<img src=\"http://themeblvd.com/demo/assets/breakout/breakout_layout_1.png\" class=\"pretty\" />\n<p>Utilizing the all-new version 2 of the Theme Blvd Framework, Breakout provides a WordPress experience like you\'ve never experienced with things like the Layout Builder.</p>\n[/one_third]\n[one_third]\n<h3>Responsive Design</h3>\n<img src=\"http://themeblvd.com/demo/assets/breakout/breakout_layout_2.png\" class=\"pretty\" /><p>The entire Theme Blvd framework was built from the ground up with the intention of making sure all of its themes display gracefully no matter where you view them.</p>\n[/one_third]\n[one_third last]\n<h3>HTML5 and CSS3</h3>\n<img src=\"http://themeblvd.com/demo/assets/breakout/breakout_layout_3.png\" class=\"pretty\" /><p>Many themes around the community are marketing themselves with the HTML5 emblem, but Breakout is truly built to give you the most modern web experience possible.</p>\n[/one_third]",
				'raw_format' => 0
			),
			'tab_2' => array (
				'type' => 'raw',
				'raw' => "[two_third]\n[post_grid categories=\"portfolio\" columns=\"3\" rows=\"2\"]\n[/two_third]\n[one_third last]\n<h4>We're doing some awesome things.</h4>\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\n<a href=\"#\" class=\"lead-link\">View Portfolio →</a>\n[/one_third]\n[clear]",
				'raw_format' => 0
			)
        )
	)
);
themeblvd_add_sample_layout( 'breakout', 'Breakout Homepage', get_template_directory_uri().'/assets/images/sample-breakout.png', 'full_width', $elements );

/*-----------------------------------------------------------------------------------*/
/* Theme Blvd Filters
/*
/* Here we can take advantage of modifying anything in the framework that is 
/* filterable. 
/*-----------------------------------------------------------------------------------*/

// Image Sizes
function breakout_image_sizes( $sizes ) {
	$sizes['slider-large']['width'] = 950;
	$sizes['slider-large']['height'] = 350;
	$sizes['slider-staged']['width'] = 564;
	$sizes['slider-staged']['height'] = 350;
	return $sizes;
}
add_filter( 'themeblvd_image_sizes', 'breakout_image_sizes' );

// Text String Overwrites
function breakout_frontend_locals( $locals ) {
	$locals['read_more'] = __( 'View Post', TB_GETTEXT_DOMAIN );
	return $locals;
}
add_filter( 'themeblvd_frontend_locals', 'breakout_frontend_locals' );

// De-register footer navigation for this theme
function breakout_nav_menus( $menus ) {
	unset( $menus['footer'] );
	return $menus;
}
add_filter( 'themeblvd_nav_menus', 'breakout_nav_menus' );

/*-----------------------------------------------------------------------------------*/
/* Theme Blvd Hooked Functions
/*
/* The following functions either add elements to unsed hooks in the framework, 
/* or replace default functions. These functions can be overridden from a child 
/* theme.
/*-----------------------------------------------------------------------------------*/

// Header Addon
if( ! function_exists( 'breakout_social_media' ) ) {
	function breakout_social_media() {
		$header_text = themeblvd_get_option( 'header_tagline' );
		?>
		<div class="header-addon<?php if($header_text) echo ' header-addon-with-text'; ?>">
			<div class="social-media">
				<?php echo themeblvd_contact_bar(); ?>
			</div><!-- .social-media (end) -->
			<?php if( $header_text ) : ?>
				<div class="header-text">
					<?php echo $header_text; ?>
				</div><!-- .header-text (end) -->
			<?php endif; ?>
		</div><!-- .header-addon (end) -->
		<?php
	}
}



// Featured slider on blog
if( ! function_exists( 'breakout_featured_blog' ) ) {
	function breakout_featured_blog() {
		if( themeblvd_get_option( 'blog_featured' ) ){
			echo '<div class="element">';
			themeblvd_slider( themeblvd_get_option( 'blog_slider' ) );
			echo '</div>';
		}
	}
}

// End of Featured section (adds the secondary bg panel)
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

// Copyright
if( ! function_exists( 'breakout_footer_sub_content' ) ) {
	function breakout_footer_sub_content() {
		?>
		<div id="footer_sub_content">
			<div class="container">
				<div class="content">
					<div class="copyright">
						<p>
							<span><?php echo apply_filters( 'themeblvd_footer_copyright', themeblvd_get_option( 'footer_copyright' ) ); ?></span>
						</p>
					</div><!-- .copyright (end) -->
					<div class="clear"></div>
				</div><!-- .content (end) -->
			</div><!-- .container (end) -->
		</div><!-- .footer_sub_content (end) -->
		<?php
	}
}

// Blog Meta
if( ! function_exists( 'breakout_blog_meta' ) ) {
	function breakout_blog_meta() {
		?>
		<div class="entry-meta">
			<span class="sep"><?php _e( 'Posted on', TB_GETTEXT_DOMAIN ); ?></span>
			<time class="entry-date" datetime="<?php the_time('c'); ?>" pubdate><?php the_time( get_option('date_format') ); ?></time>
			<span class="sep"> <?php _e( 'by', TB_GETTEXT_DOMAIN ); ?> </span>
			<span class="author vcard"><a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo sprintf( esc_attr__( 'View all posts by %s', TB_GETTEXT_DOMAIN ), get_the_author() ); ?>" rel="author"><?php the_author(); ?></a></span>
			<span class="sep"> <?php _e( 'in', TB_GETTEXT_DOMAIN ); ?> </span>
			<span class="category"><?php the_category(', '); ?></span>
			<?php if ( comments_open() ) : ?>
				<span class="comments-link">
					<?php comments_popup_link( __( '<span class="leave-reply">No Comments</span>', TB_GETTEXT_DOMAIN ), __( '1 Comment', TB_GETTEXT_DOMAIN ), __( '% Comments', TB_GETTEXT_DOMAIN ) ); ?>
				</span>
			<?php endif; ?>
		</div><!-- .entry-meta -->	
		<?php
	}
}

// Featured below start
if( ! function_exists( 'breakout_featured_below_start' ) ) {
	function breakout_featured_below_start() {
		$classes = '';
		$featured_below = themeblvd_config( 'featured_below' );
		if( $featured_below ) {
			foreach( $featured_below as $class )
				$classes .= " $class";

		}
		?>
		<!-- FEATURED BELOW (start) -->
		
		<div id="featured_below">
			<div class="featured_below-inner<?php echo $classes; ?>">
				<div class="featured_below-content">
					<div class="inner-wrapper">
		<?php
	}
}

// Featured below end
if( ! function_exists( 'breakout_featured_below_end' ) ) {
	function breakout_featured_below_end() {
		?>
						<div class="clear"></div>
					</div><!-- .inner-wrap (end) -->
				</div><!-- .featured_below-content (end) -->
			</div><!-- .featured_below-inner (end) -->
		</div><!-- #featured_below (end) -->
		
		<!-- FEATURED BELOW (end) -->
		<?php
	}
}

/*-----------------------------------------------------------------------------------*/
/* Hook Adjustments on framework
/*-----------------------------------------------------------------------------------*/

// Remove hooks
remove_action( 'themeblvd_featured_end', 'themeblvd_featured_end_default' );
remove_action( 'themeblvd_featured_blog', 'themeblvd_featured_blog_default' );
remove_action( 'themeblvd_footer_sub_content', 'themeblvd_footer_sub_content_default' );
remove_action( 'themeblvd_blog_meta', 'themeblvd_blog_meta_default' );
remove_action( 'themeblvd_featured_below_start', 'themeblvd_featured_below_start_default' );
remove_action( 'themeblvd_featured_below_end', 'themeblvd_featured_below_end_default' );

// Add hooks
add_action( 'themeblvd_header_addon', 'breakout_social_media' );
add_action( 'themeblvd_featured_end', 'breakout_featured_end' );
add_action( 'themeblvd_featured_blog', 'breakout_featured_blog' );
add_action( 'themeblvd_footer_sub_content', 'breakout_footer_sub_content' );
add_action( 'themeblvd_blog_meta', 'breakout_blog_meta' );
add_action( 'themeblvd_featured_below_start', 'breakout_featured_below_start' );
add_action( 'themeblvd_featured_below_end', 'breakout_featured_below_end' );