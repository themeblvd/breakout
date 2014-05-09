<?php
/*-----------------------------------------------------------------------------------*/
/* Theme Functions
/*
/* In premium Theme Blvd themes, this file will contains everything that's needed
/* to modify the framework's default setting to construct the current theme.
/*-----------------------------------------------------------------------------------*/

// Define theme constants
define( 'TB_THEME_ID', 'breakout' );
define( 'TB_THEME_NAME', 'Breakout' );

// Modify framework's theme options
require_once( get_template_directory() . '/includes/options.php' );

/**
 * Breakout CSS Files
 *
 * @since 1.0.0
 */
function breakout_css() {

	// @TODO CHANGE CSS FILES TO MIN

	// For plugins not inserting their scripts/stylesheets
	// correctly in the admin.
	if ( is_admin() ) {
		return;
	}

	// Get theme version for stylesheets
	$theme_data = wp_get_theme( get_template() );
	$theme_version = $theme_data->get('Version');

	// Get stylesheet API
	$api = Theme_Blvd_Stylesheets_API::get_instance();

	$template_directory_uri = get_template_directory_uri();

	wp_register_style( 'themeblvd_breakout', $template_directory_uri . '/assets/css/theme.css', $api->get_framework_deps(), $theme_version );
	wp_register_style( 'themeblvd_dark', $template_directory_uri . '/assets/css/dark.css', array('themeblvd_breakout'), $theme_version );
	wp_register_style( 'themeblvd_responsive', $template_directory_uri . '/assets/css/responsive.css', array('themeblvd_breakout'), $theme_version );
	wp_register_style( 'themeblvd_ie', $template_directory_uri . '/assets/css/ie.css', array('themeblvd_breakout'), $theme_version );
	wp_register_style( 'themeblvd_theme', get_stylesheet_uri(), array('themeblvd_breakout'), $theme_version );

	wp_enqueue_style( 'themeblvd_breakout' );

	if ( themeblvd_get_option( 'content_color' ) == 'content_dark' ) {
		wp_enqueue_style( 'themeblvd_dark' );
	}

	if ( themeblvd_supports( 'display', 'responsive' ) ) {
		wp_enqueue_style( 'themeblvd_responsive' );
	}

	// IE Styles
	$GLOBALS['wp_styles']->add_data( 'themeblvd_ie', 'conditional', 'lt IE 9' ); // Add IE conditional
	wp_enqueue_style( 'themeblvd_ie' );

	// Inline styles from theme options --
	// Note: Using themeblvd_ie as $handle because it's the only
	// constant stylesheet just before style.css
	wp_add_inline_style( 'themeblvd_ie', breakout_styles() );

	// style.css -- This is mainly for WP continuity and Child theme modifications.
	wp_enqueue_style( 'themeblvd_theme' );

	// Level 3 client API-added styles
	$api->print_styles(3);

}
add_action( 'wp_enqueue_scripts', 'breakout_css', 20 );

if ( !function_exists( 'breakout_styles' ) ) :
/**
 * Breakout Styles
 *
 * @since 1.0.0
 *
 * @return string $styles Inline styles for wp_add_inline_style()
 */
function breakout_styles() {
	$styles = '';
	$accent_color = themeblvd_get_option('accent_color');
	$textures = themeblvd_get_textures();
	$content_texture = themeblvd_get_option( 'content_texture' );
	$header_texture = themeblvd_get_option( 'header_texture' );
	$footer_texture = themeblvd_get_option('footer_texture' );
	$custom_styles = themeblvd_get_option( 'custom_styles' );
	$body_font = themeblvd_get_option( 'typography_body' );
	$header_font = themeblvd_get_option( 'typography_header' );
	$special_font = themeblvd_get_option( 'typography_special' );
	ob_start();
	?>
	/* Fonts */
	html,
	body {
		font-family: <?php echo themeblvd_get_font_face( $body_font ); ?>;
		font-size: <?php echo themeblvd_get_font_size( $body_font ); ?>;
		font-style: <?php echo themeblvd_get_font_style( $body_font ); ?>;
		font-weight: <?php echo themeblvd_get_font_weight( $body_font ); ?>;
	}
	h1, h2, h3, h4, h5, h6, .slide-title {
		font-family: <?php echo themeblvd_get_font_face( $header_font ); ?>;
		font-style: <?php echo themeblvd_get_font_style( $header_font ); ?>;
		font-weight: <?php echo themeblvd_get_font_weight( $header_font ); ?>;
	}
	#featured .media-full .slide-title,
	#content .media-full .slide-title,
	#featured_below .media-full .slide-title,
	.element-slogan .slogan .slogan-text,
	.element-tweet,
	.special-font {
		font-family: <?php echo themeblvd_get_font_face( $special_font ); ?>;
		font-style: <?php echo themeblvd_get_font_style( $special_font ); ?>;
		font-weight: <?php echo themeblvd_get_font_weight( $special_font ); ?>;
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
	.standard-slider .media-full .content .slide-title,
	.tb-nivo-slider-wrapper .nivo-caption .content .slide-title {
		background-color: <?php echo themeblvd_get_option('header_color'); ?>;
	}
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
	<?php
	// Compress inline styles
	$styles = themeblvd_compress( ob_get_clean() );

	// Add in user's custom CSS
	if ( $custom_styles ) {
		$styles .= "\n/* User Custom CSS */\n";
		$styles .= $custom_styles;
	}

	return $styles;
}
endif;

/**
 * Breakout Scripts
 *
 * @since 2.0.0
 */
function breakout_scripts() {

	global $themeblvd_framework_scripts;

	// Theme-specific script
	wp_enqueue_script( 'themeblvd_theme', get_template_directory_uri() . '/assets/js/breakout.js', $themeblvd_framework_scripts, '2.0.0', true );

}
add_action( 'wp_enqueue_scripts', 'breakout_scripts' );

/**
 * Breakout Google Fonts
 *
 * If any fonts need to be included from Google based
 * on the theme options, here's where we do it.
 *
 * @since 2.0.0
 */
function breakout_include_fonts() {
	themeblvd_include_google_fonts(
		themeblvd_get_option('typography_body'),
		themeblvd_get_option('typography_header'),
		themeblvd_get_option('typography_special')
	);
}
add_action( 'wp_head', 'breakout_include_fonts', 5 );

/**
 * Breakout Body Classes
 *
 * Here we filter WordPress's default body_class()
 * function to include necessary classes for Main
 * Styles selected in Theme Options panel.
 */
function breakout_body_class( $classes ) {

	$classes[] = themeblvd_get_option( 'content_color' );
	$classes[] = themeblvd_get_option( 'header_text' );
	$classes[] = themeblvd_get_option( 'footer_text' );

	if ( themeblvd_supports( 'display', 'responsive' ) ) {
		$classes[] = 'responsive';
	}

	return $classes;
}
add_filter( 'body_class', 'breakout_body_class' );

/*-----------------------------------------------------------------------------------*/
/* Add Sample Layout
/*
/* Here we add a sample layout to the layout builder's sample layouts.
/*-----------------------------------------------------------------------------------*/

/**
 * Add sample layouts to Layout Builder plugin.
 *
 * @since 2.0.0
 */
function breakout_sample_layouts() {

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
					'style' => 'framed',
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
		),
		array(
			'type' => 'columns',
			'location' => 'primary',
			'defaults' => array(
	           'setup' => array(
					'num' => '3',
					'width' => array(
						'2' => 'grid_6-grid_6',
						'3' => 'grid_4-grid_4-grid_4',
						'4' => 'grid_3-grid_3-grid_3-grid_3',
						'5' => 'grid_fifth_1-grid_fifth_1-grid_fifth_1-grid_fifth_1-grid_fifth_1'
					)
				),
		       'col_1' => array(
					'type'			=> 'raw',
					'page' 			=> null,
					'raw'			=> "<div class=\"text-center\">\n[vector_icon icon=\"star\" class=\"fa-5x\" color=\"#444\"]\n\n<h3>Hello, Breakout!</h3>\n\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\n</div>\n\n<div class=\"text-center\">\n[vector_icon icon=\"users\" class=\"fa-5x\" color=\"#444\"]\n\n<h3>For Everyone</h3>\n\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\n</div>",
					'raw_format'	=> 1
				),
                'col_2' => array(
					'type'			=> 'raw',
					'page'			=> null,
					'raw'			=> "<div class=\"text-center\">\n[vector_icon icon=\"mobile\" class=\"fa-5x\" color=\"#444\"]\n\n<h3>Totally Responsive</h3>\n\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\n</div>\n\n<div class=\"text-center\">\n[vector_icon icon=\"wrench\" class=\"fa-5x\" color=\"#444\"]\n\n<h3>Completely Customizable</h3>\n\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\n</div>",
					'raw_format'	=> 1
				),
                'col_3' => array(
					'type'			=> 'raw',
					'page'			=> null,
					'raw'			=> "<div class=\"text-center\">\n[vector_icon icon=\"magic\" class=\"fa-5x\" color=\"#444\"]\n\n<h3>Pixel-Perfect</h3>\n\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\n</div>\n\n<div class=\"text-center\">\n[vector_icon icon=\"question\" class=\"fa-5x\" color=\"#444\"]\n\n<h3>Outstanding Support</h3>\n\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\n</div>",
					'raw_format'	=> 1
				)
		    )
		),
	);
	themeblvd_add_sample_layout( 'breakout', 'Breakout Homepage', get_template_directory_uri().'/assets/images/sample-breakout.png', 'full_width', $elements );

}
add_action( 'after_setup_theme', 'breakout_sample_layouts' );

/*-----------------------------------------------------------------------------------*/
/* Theme Blvd Filters
/*
/* Here we can take advantage of modifying anything in the framework that is
/* filterable.
/*-----------------------------------------------------------------------------------*/

/**
 * Theme Blvd Setup
 *
 * @since 2.0.0
 */
function breakout_global_config( $config ) {

	// If user turned off responsive CSS, then
	// filter the global config that applies
	// this throughout the framework.
	if ( themeblvd_get_option( 'responsive_css' ) == 'false' ) {
		$config['display']['responsive'] = false;
	}

	return $config;
}
add_filter( 'themeblvd_global_config', 'breakout_global_config' );

/**
 * Image sizes
 *
 * @since 1.0.0
 */
function breakout_image_sizes( $sizes ) {
	$sizes['slider-large']['width'] = 950;
	$sizes['slider-large']['height'] = 350;
	$sizes['slider-staged']['width'] = 564;
	$sizes['slider-staged']['height'] = 350;
	return $sizes;
}
add_filter( 'themeblvd_image_sizes', 'breakout_image_sizes' );

/**
 * De-register footer navigation for this theme
 *
 * @since 1.0.0
 */
function breakout_nav_menus( $menus ) {
	unset( $menus['footer'] );
	return $menus;
}
add_filter( 'themeblvd_nav_menus', 'breakout_nav_menus' );

/**
 * Theme Blvd WPML Bridge support
 *
 * @since 1.0.0
 */
function breakout_wpml_theme_locations( $current_locations ) {
	$new_locations = array();
	$new_locations['social_media_addon'] = array(
		'name' 		=> __( 'Social Media Addon', 'themeblvd' ),
		'desc' 		=> __( 'This will display your language flags next to your social icons in the header of your website.', 'themeblvd' ),
		'action' 	=> 'breakout_header_wpml'
	);
	$new_locations = array_merge( $new_locations, $current_locations );
	return $new_locations;
}
add_filter( 'tb_wpml_theme_locations', 'breakout_wpml_theme_locations' );

/**
 * Modify recommended plugins.
 *
 * @since 2.0.0
 */
function breakout_plugins( $plugins ){

	// Add Twitter
	$plugins['tweeple'] = array(
		'name'		=> 'Tweeple',
		'slug'		=> 'tweeple',
		'required'	=> false
	);

	return $plugins;
}
add_filter( 'themeblvd_plugins', 'breakout_plugins' );

/**
 * Apply gradient buttons, which were default
 * before Bootstrap 3.
 *
 * @since 2.0.0
 */
function akita_btn_gradient( $class ) {
	$class[] = 'tb-btn-gradient';
	return $class;
}
add_filter( 'body_class', 'akita_btn_gradient' );

/**
 * Element classes. Added "boxed-element" class to all
 * relvant elements.
 *
 * @since 2.0.0
 */
function breakout_element_classes( $classes, $type, $options, $location ) {

	$classes['element_content'][] = 'boxed-element';
	$classes['element_post_grid'][] = 'boxed-element';
	$classes['element_post_list'][] = 'boxed-element';
	$classes['element_columns'][] = 'boxed-element';
	$classes['element_slogan'][] = 'boxed-element';
	$classes['element_tweet'][] = 'boxed-element';

	$classes['element_slider'][] = 'top-shadow';

	return $classes;
}
add_filter( 'themeblvd_element_classes', 'breakout_element_classes', 10, 4 );

/*-----------------------------------------------------------------------------------*/
/* Theme Blvd Hooked Functions
/*
/* The following functions either add elements to unsed hooks in the framework,
/* or replace default functions. These functions can be overridden from a child
/* theme.
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'breakout_social_media' ) ) :
/**
 * Header Addon
 *
 * @since 1.0.0
 */
function breakout_social_media() {
	$header_text = themeblvd_get_option( 'header_tagline' );
	$style = themeblvd_get_option( 'social_media_style', null, 'light' );
	?>
	<div class="header-addon<?php if($header_text) echo ' header-addon-with-text'; if(has_action('breakout_header_wpml')) echo ' header-addon-with-wpml';?>">
		<div class="social-media">
			<?php echo themeblvd_contact_bar( themeblvd_get_option('social_media'), $style ); ?>
		</div><!-- .social-media (end) -->
		<?php do_action('breakout_header_wpml'); ?>
		<?php if( $header_text ) : ?>
			<div class="header-text">
				<?php echo $header_text; ?>
			</div><!-- .header-text (end) -->
		<?php endif; ?>
	</div><!-- .header-addon (end) -->
	<?php
}
endif;

if( ! function_exists( 'breakout_footer_sub_content' ) ) :
/**
 * Copyright
 *
 * @since 1.0.0
 */
function breakout_footer_sub_content() {
	?>
	<div id="footer_sub_content" class="clearfix">
		<div class="footer_sub_content-inner">
			<div class="footer_sub_content-content">
				<div class="copyright">
					<p>
						<span><?php echo apply_filters( 'themeblvd_footer_copyright', themeblvd_get_option( 'footer_copyright' ) ); ?></span>
					</p>
				</div><!-- .copyright (end) -->
				<div class="clear"></div>
			</div><!-- .footer_sub_content-content (end) -->
		</div><!-- .footer_sub_content-inner (end) -->
	</div><!-- .footer_sub_content (end) -->
	<?php
}
endif;

if( ! function_exists( 'breakout_blog_meta' ) ) :
/**
 * Blog Meta
 *
 * @since 1.0.0
 */
function breakout_blog_meta() {
	?>
	<div class="entry-meta">
		<span class="sep"><?php echo themeblvd_get_local( 'posted_on' ); ?></span>
		<time class="entry-date updated" datetime="<?php the_time('c'); ?>"><?php the_time( get_option('date_format') ); ?></time>
		<span class="sep"> <?php echo themeblvd_get_local( 'by' ); ?> </span>
		<span class="author vcard"><a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo sprintf( esc_attr__( 'View all posts by %s', 'themeblvd_frontend' ), get_the_author() ); ?>" rel="author"><?php the_author(); ?></a></span>
		<span class="sep"> <?php echo themeblvd_get_local( 'in' ); ?> </span>
		<?php if ( 'portfolio_item' == get_post_type() ) : ?>
			<span class="category"><?php echo get_the_term_list( get_the_id(), 'portfolio', '', ', ' ); ?></span>
		<?php else : ?>
			<span class="category"><?php the_category(', '); ?></span>
		<?php endif; ?>
		<?php if ( comments_open() ) : ?>
			<span class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">'.themeblvd_get_local( 'no_comments' ).'</span>', '1 '.themeblvd_get_local( 'comment' ), '% '.themeblvd_get_local( 'comments' ) ); ?>
			</span>
		<?php endif; ?>
	</div><!-- .entry-meta -->
	<?php
}
endif;

if ( !function_exists( 'breakout_viewport_non_responsive' ) ) :
/**
 * Output meta viewport tag when the user turns OFF
 * responsive design.
 *
 * @since 2.0.0
 */
function breakout_viewport_non_responsive() {
	if ( ! themeblvd_supports( 'display', 'responsive' ) ) {
		echo '<meta name="viewport" content="width=1020">'."\n";
	}
}
endif;

/*-----------------------------------------------------------------------------------*/
/* Hook Adjustments on framework
/*-----------------------------------------------------------------------------------*/

// Remove hooks
remove_action( 'themeblvd_footer_sub_content', 'themeblvd_footer_sub_content_default' );
remove_action( 'themeblvd_blog_meta', 'themeblvd_blog_meta_default' );

// Add hooks
add_action( 'themeblvd_header_addon', 'breakout_social_media' );
add_action( 'themeblvd_footer_sub_content', 'breakout_footer_sub_content' );
add_action( 'themeblvd_blog_meta', 'breakout_blog_meta' );
add_action( 'wp_head', 'breakout_viewport_non_responsive' );