<?php
/**
 * Use Options API to add options onto options already
 * present in framework. This is possible in Theme Blvd
 * Framework 2.1.0+.
 *
 * @since 1.1.0
 */
function breakout_options() {

	// Textures
	$texture_options = array( 'none' => __( 'None', 'themeblvd' ) );
	$textures = themeblvd_get_textures();
	foreach( $textures as $id => $atts ) {
		$texture_options[$id] = $atts['name'];
	}

	// Add Styles
	themeblvd_add_option_tab( 'styles', __( 'Styles', 'themeblvd' ), true );

	// Add Styles > Main section
	$main_options = array(
		array(
			'name' 		=> __( 'Content Color', 'themeblvd' ),
			'desc'		=> __( 'Select the primary color. This color makes up the background of the site.', 'themeblvd' ),
			'id'		=> 'content_color',
			'std'		=> 'content_light',
			'type' 		=> 'select',
			'options'	=> array(
				'content_dark' 	=> __( 'Dark', 'themeblvd' ),
				'content_light' => __( 'Light', 'themeblvd' )
			)
		),
		array(
			'name' 		=> __( 'Content Background Texture', 'themeblvd' ),
			'desc'		=> __( 'This texture gets to the background in the main section of the theme.<br><br><em>Note: The "Light" textures tend to look nicer when combined with the "Light" content color selected in the previous option.</em>', 'themeblvd' ),
			'id'		=> 'content_texture',
			'std'		=> 'diagnol_thin_light',
			'type' 		=> 'select',
			'options'	=> $texture_options
		),
		array(
			'name' 		=> __( 'Accent Color', 'themeblvd' ),
			'desc' 		=> __( 'This color gets applied to some minor items throughout the theme such as the default color of buttons and elements within sliders.', 'themeblvd' ),
			'id' 		=> 'accent_color',
			'std' 		=> '#28313c',
			'type' 		=> 'color'
		),
		array(
			'name' 		=> __( 'Accent Color Brightness', 'themeblvd' ),
			'desc' 		=> __( 'In the previous option, did you choose a dark color or a light color? This will determine how text is styled in the areas with this background color.', 'themeblvd' ),
			'id' 		=> 'accent_text',
			'std' 		=> 'accent_text_light',
			'type' 		=> 'select',
			'options'	=> array(
				'accent_text_light' => __( 'I chose a dark color in the previous option.', 'themeblvd' ),
				'accent_text_dark' => __( 'I chose a light color in the previous option.', 'themeblvd' )
			)
		)
	);
	themeblvd_add_option_section( 'styles', 'main_styles', __( 'Main', 'themeblvd' ), null, $main_options, false );

	// Add Styles > Header section
	$header_options = array(
		array(
			'name' 		=> __( 'Header Color', 'themeblvd' ),
			'desc' 		=> __( 'This color gets applied to the background of the header.', 'themeblvd' ),
			'id' 		=> 'header_color',
			'std' 		=> '#28313c',
			'type' 		=> 'color'
		),
		array(
			'name' 		=> __( 'Header Color Brightness', 'themeblvd' ),
			'desc' 		=> __( 'In the previous option, did you choose a dark color or a light color? This will determine how text is styled for the header.', 'themeblvd' ),
			'id' 		=> 'header_text',
			'std' 		=> 'header_text_light',
			'type' 		=> 'select',
			'options'	=> array(
				'header_text_light' => __( 'I chose a dark color in the previous option.', 'themeblvd' ),
				'header_text_dark' => __( 'I chose a light color in the previous option.', 'themeblvd' )
			)
		),
		array(
			'name' 		=> __( 'Header Background Texture', 'themeblvd' ),
			'desc'		=> __( 'This texture gets applied over the background color of the header.', 'themeblvd' ),
			'id'		=> 'header_texture',
			'std'		=> 'denim',
			'type' 		=> 'select',
			'options'	=> $texture_options
		)
	);
	themeblvd_add_option_section( 'styles', 'header_styles', __( 'Header', 'themeblvd' ), null, $header_options, false );

	// Add Styles > Footer section
	$footer_options = array(
		array(
			'name' 		=> __( 'Footer Color', 'themeblvd' ),
			'desc' 		=> __( 'This color gets applied to the background of the footer.', 'themeblvd' ),
			'id' 		=> 'footer_color',
			'std' 		=> '#28313c',
			'type' 		=> 'color'
		),
		array(
			'name' 		=> __( 'Footer Color Brightness', 'themeblvd' ),
			'desc' 		=> __( 'In the previous option, did you choose a dark color or a light color? This will determine how text is styled for the footer.', 'themeblvd' ),
			'id' 		=> 'footer_text',
			'std' 		=> 'footer_text_light',
			'type' 		=> 'select',
			'options'	=> array(
				'footer_text_light' => __( 'I chose a dark color in the previous option.', 'themeblvd' ),
				'footer_text_dark' => __( 'I chose a light color in the previous option.', 'themeblvd' )
			)
		),
		array(
			'name' 		=> __( 'Footer Background Texture', 'themeblvd' ),
			'desc'		=> __( 'This texture gets applied over the background color of the footer.', 'themeblvd' ),
			'id'		=> 'footer_texture',
			'std'		=> 'denim',
			'type' 		=> 'select',
			'options'	=> $texture_options
		)
	);
	themeblvd_add_option_section( 'styles', 'footer_styles', __( 'Footer', 'themeblvd' ), null, $footer_options, false );

	// Add Styles > Links section
	$links_options = array(
		array(
			'name' 		=> __( 'Link Color', 'themeblvd' ),
			'desc' 		=> __( 'Choose the color you\'d like applied to links.', 'themeblvd' ),
			'id' 		=> 'link_color',
			'std' 		=> '#2a9ed4',
			'type' 		=> 'color'
		),
		array(
			'name' 		=> __( 'Link Hover Color', 'themeblvd' ),
			'desc' 		=> __( 'Choose the color you\'d like applied to links when they are hovered over.', 'themeblvd' ),
			'id' 		=> 'link_hover_color',
			'std' 		=> '#1a5a78',
			'type' 		=> 'color'
		),
		array(
			'name' 		=> __( 'Footer Link Color', 'themeblvd' ),
			'desc' 		=> __( 'Choose the color you\'d like applied to links in the footer.', 'themeblvd' ),
			'id' 		=> 'footer_link_color',
			'std' 		=> '#ffffff',
			'type' 		=> 'color'
		),
		array(
			'name' 		=> __( 'Footer Link Hover Color', 'themeblvd' ),
			'desc' 		=> __( 'Choose the color you\'d like applied to links in the footer when they are hovered over.', 'themeblvd' ),
			'id' 		=> 'footer_link_hover_color',
			'std' 		=> '#007bff',
			'type' 		=> 'color'
		)
	);
	themeblvd_add_option_section( 'styles', 'links', __( 'Links', 'themeblvd' ), null, $links_options, false );

	// Add Styles > Typography section
	$typography_options = array(
		array(
			'name' 		=> __( 'Primary Font', 'themeblvd' ),
			'desc' 		=> __( 'This applies to most of the text on your site.', 'themeblvd' ),
			'id' 		=> 'typography_body',
			'std' 		=> array('size' => '12px','face' => 'arial','color' => '', 'google' => ''),
			'atts'		=> array('size', 'face'),
			'type' 		=> 'typography'
		),
		array(
			'name' 		=> __( 'Header Font', 'themeblvd' ),
			'desc' 		=> __( 'This applies to all of the primary headers throughout your site (h1, h2, h3, h4, h5, h6). This would include header tags used in redundant areas like widgets and the content of posts and pages.', 'themeblvd' ),
			'id' 		=> 'typography_header',
			'std' 		=> array('size' => '','face' => 'helvetica','color' => '', 'google' => ''),
			'atts'		=> array('face'),
			'type' 		=> 'typography'
		),
		array(
			'name' 		=> __( 'Special Font', 'themeblvd' ),
			'desc' 		=> __( 'It can be kind of overkill to select a super fancy font for the previous option, but here is where you can go crazy. There are a few special areas in this theme where this font will get used.', 'themeblvd' ),
			'id' 		=> 'typography_special',
			'std' 		=> array('size' => '','face' => 'google','color' => '', 'google' => 'Josefin Sans'),
			'atts'		=> array('face'),
			'type' 		=> 'typography'
		)
	);
	themeblvd_add_option_section( 'styles', 'typography', __( 'Typography', 'themeblvd' ), null, $typography_options, false );

	// Add Styles > Custom section
	$custom_options = array(
		array(
			'name' 		=> __( 'Custom CSS', 'themeblvd' ),
			'desc' 		=> __( 'If you have some minor CSS changes, you can put them here to override the theme\'s default styles. However, if you plan to make a lot of CSS changes, it would be best to create a child theme.', 'themeblvd' ),
			'id' 		=> 'custom_styles',
			'type'		=> 'textarea'
		)
	);
	themeblvd_add_option_section( 'styles', 'custom', __( 'Custom', 'themeblvd' ), null, $custom_options, false );

	// Add social media option to Layout > Header
	$social_media = array(
		'name' 		=> __( 'Social Media Buttons', 'themeblvd' ),
		'desc' 		=> __( 'Configure the social media buttons you\'d like to show in the header of your site. Check the buttons you\'d like to use and then input the full URL you\'d like the button to link to in the corresponding text field that appears.<br><br>Example: http://twitter.com/jasonbobich<br><br><em>Note: On the "Email" button, if you want it to link to an actual email address, you would input it like this:<br><br><strong>mailto:you@youremail.com</strong></em><br><br><em>Note: If you\'re using the RSS button, your default RSS feed URL is:<br><br><strong>'.get_feed_link( 'feed' ).'</strong></em>', 'themeblvd' ),
		'id' 		=> 'social_media',
		'std' 		=> array(
			'includes' =>  array( 'facebook', 'google', 'twitter', 'rss' ),
			'facebook' => 'http://facebook.com/jasonbobich',
			'google' => 'https://plus.google.com/116531311472104544767/posts',
			'twitter' => 'http://twitter.com/jasonbobich',
			'rss' => get_bloginfo('rss_url')
		),
		'type' 		=> 'social_media'
	);
	themeblvd_add_option( 'layout', 'header', 'social_media', $social_media );

	// Add header text option to Layout > Header
	$header_text = array(
		'name' 		=> __( 'Header Text', 'themeblvd' ),
		'desc'		=> __( 'Enter a very brief piece of text you\'d like to show below the social icons.', 'themeblvd' ),
		'id'		=> 'header_tagline',
		'std'		=> '<strong>Call Now: 1-800-123-4567</strong>',
		'type' 		=> 'text'
	);
	themeblvd_add_option( 'layout', 'header', 'header_tagline', $header_text );

	// Add meta option for archive posts
	$archive_meta = array(
		'name' 		=> __( 'Show meta info?', 'themeblvd' ),
		'desc' 		=> __( 'Choose whether you want to show meta information under the title of each post.', 'themeblvd' ),
		'id' 		=> 'archive_meta',
		'std' 		=> 'show',
		'type' 		=> 'radio',
		'options' 	=> array(
			'show'	=> __( 'Show meta info.', 'themeblvd' ),
			'hide' 	=> __( 'Hide meta info.', 'themeblvd' )
		)
	);
	themeblvd_add_option( 'content', 'archives', 'archive_meta', $archive_meta );

	// Add tags option for archive posts
	$archive_meta = array(
		'name' 		=> __( 'Show tags?', 'themeblvd' ),
		'desc' 		=> __( 'Choose whether you want to show tags under at the bottom of each post.', 'themeblvd' ),
		'id' 		=> 'archive_tags',
		'std' 		=> 'show',
		'type' 		=> 'radio',
		'options' 	=> array(
			'show'	=> __( 'Show tags.', 'themeblvd' ),
			'hide' 	=> __( 'Hide tags.', 'themeblvd' )
		)
	);
	themeblvd_add_option( 'content', 'archives', 'archive_tags', $archive_meta );

	// Add post list options
	$post_list_description = __( 'These options apply to posts when they are shown from within any post list throughout your site. This includes the Primary Posts Display described above, as well.<br><br>Note: It may be confusing why these options are not present when editing a specific post list. The reason is because the options when working with a specific post list are incorporated into the actual theme framework, while these settings have been added to this particular theme design for your conveniance.', 'themeblvd' );
	$post_list = array(
		array(
			'name' 		=> __( 'Show meta info?', 'themeblvd' ),
			'desc' 		=> __( 'Choose whether you want to show meta information under the title of each post.', 'themeblvd' ),
			'id' 		=> 'post_list_meta',
			'std' 		=> 'show',
			'type' 		=> 'radio',
			'options' 	=> array(
				'show'	=> __( 'Show meta info.', 'themeblvd' ),
				'hide' 	=> __( 'Hide meta info.', 'themeblvd' )
			)
		),
		array(
			'name' 		=> __( 'Show tags?', 'themeblvd' ),
			'desc' 		=> __( 'Choose whether you want to show tags under at the bottom of each post.', 'themeblvd' ),
			'id' 		=> 'post_list_tags',
			'std' 		=> 'show',
			'type' 		=> 'radio',
			'options' 	=> array(
				'show'	=> __( 'Show tags.', 'themeblvd' ),
				'hide' 	=> __( 'Hide tags.', 'themeblvd' )
			)
		)

	);
	themeblvd_add_option_section( 'content', 'post_list', __( 'Post Lists', 'themeblvd' ), $post_list_description, $post_list );

	// Add post grid options
	$post_grid_description = __( 'These options apply to posts when they are shown from within any post grid throughout your site.<br><br>Note: It may be confusing why these options are not present when editing a specific post grid. The reason is because the options when working with a specific post grid are incorporated into the actual theme framework, while these settings have been added to this particular theme design for your conveniance.', 'themeblvd' );
	$post_grid = array(
		array(
			'name' 		=> __( 'Show title?', 'themeblvd' ),
			'desc' 		=> __( 'Choose whether or not you want to show the title below each featured image in post grids.', 'themeblvd' ),
			'id' 		=> 'post_grid_title',
			'std' 		=> 'show',
			'type' 		=> 'radio',
			'options' 	=> array(
				'show'	=> __( 'Show titles.', 'themeblvd' ),
				'hide' 	=> __( 'Hide titles.', 'themeblvd' )
			)
		),
		array(
			'name' 		=> __( 'Show excerpts?', 'themeblvd' ),
			'desc' 		=> __( 'Choose whether or not you want to show the excerpt on each post.', 'themeblvd' ),
			'id' 		=> 'post_grid_excerpt',
			'std' 		=> 'hide',
			'type' 		=> 'radio',
			'options' 	=> array(
				'show'	=> __( 'Show excerpts.', 'themeblvd' ),
				'hide' 	=> __( 'Hide excerpts.', 'themeblvd' )
			)
		),
		array(
			'name' 		=> __( 'Show buttons?', 'themeblvd' ),
			'desc' 		=> __( 'Choose whether or not you want to show a button that links to the single post.', 'themeblvd' ),
			'id' 		=> 'post_grid_button',
			'std' 		=> 'hide',
			'type' 		=> 'radio',
			'options' 	=> array(
				'show'	=> __( 'Show buttons.', 'themeblvd' ),
				'hide' 	=> __( 'Hide buttons.', 'themeblvd' )
			)
		)
	);
	themeblvd_add_option_section( 'content', 'post_grid', __( 'Post Grids', 'themeblvd' ), $post_grid_description, $post_grid, false );

	// Edit default values
	themeblvd_edit_option( 'content', 'blog', 'blog_thumbs', 'std', 'small' );
	themeblvd_edit_option( 'content', 'blog', 'blog_content', 'std', 'excerpt' );
	themeblvd_edit_option( 'layout', 'header', 'logo', 'std', array( 'type' => 'image', 'image' => get_template_directory_uri().'/assets/images/logo.png', 'image_width' => '172', 'image_2x' => get_template_directory_uri().'/assets/images/logo_2x.png' ) );
}
add_action( 'after_setup_theme', 'breakout_options' );

/**
 * Setup theme for customizer.
 *
 * @since 1.1.0
 */
function breakout_customizer(){

	// Textures
	$texture_options = array( 'none' => __( 'None', 'themeblvd' ) );
	$textures = themeblvd_get_textures();
	foreach( $textures as $id => $atts ) {
		$texture_options[$id] = $atts['name'];
	}

	// Setup logo options
	$logo_options = array(
		'logo' => array(
			'name' 		=> __( 'Logo', 'themeblvd' ),
			'id' 		=> 'logo',
			'type' 		=> 'logo',
			'transport'	=> 'postMessage'
		)
	);
	themeblvd_add_customizer_section( 'logo', __( 'Logo', 'themeblvd' ), $logo_options, 1 );

	// Setup header style options
	$header_options = array(
		'header_color' => array(
			'name' 		=> __( 'Header Background Color', 'themeblvd' ),
			'id'		=> 'header_color',
			'type' 		=> 'color',
			'transport'	=> 'postMessage'
		),
		'header_text' => array(
			'name' 		=> __( 'Header Brightness', 'themeblvd' ),
			'id' 		=> 'header_text',
			'type' 		=> 'radio',
			'options'	=> array(
				'header_text_light' => __( 'I chose a dark color in the previous option.', 'themeblvd' ),
				'header_text_dark' => __( 'I chose a light color in the previous option.', 'themeblvd' )
			),
			'transport'	=> 'postMessage'
		),
		'header_texture' => array(
			'name' 		=> __( 'Header Background Texture', 'themeblvd' ),
			'id'		=> 'header_texture',
			'type' 		=> 'select',
			'options'	=> $texture_options,
			'transport'	=> 'postMessage'
		),
		'header_tagline' => array(
			'name' 		=> __( 'Header Text', 'themeblvd' ),
			'id'		=> 'header_tagline',
			'type' 		=> 'text',
			'transport'	=> 'postMessage'
		)
	);
	themeblvd_add_customizer_section( 'header', __( 'Header', 'themeblvd' ), $header_options, 2 );

	// Setup main content area options
	$main_options = array(
		'content_color' => array(
			'name' 		=> __( 'Content Color', 'themeblvd' ),
			'id'		=> 'content_color',
			'type' 		=> 'select',
			'options'	=> array(
				'content_dark' => __( 'Dark', 'themeblvd' ),
				'content_light' => __( 'Light', 'themeblvd' ),
				'content_tan' => __( 'Tan', 'themeblvd' )
			),
			'transport'	=> 'postMessage'
		),
		'content_texture' => array(
			'name' 		=> __( 'Content Background Texture', 'themeblvd' ),
			'id'		=> 'content_texture',
			'type' 		=> 'select',
			'options'	=> $texture_options,
			'transport'	=> 'postMessage'
		),
		'accent_color' => array(
			'name' 		=> __( 'Accent Color', 'themeblvd' ),
			'id' 		=> 'accent_color',
			'type' 		=> 'color'
		),
		'accent_text' => array(
			'name' 		=> __( 'Accent Color Brightness', 'themeblvd' ),
			'id' 		=> 'accent_text',
			'type' 		=> 'radio',
			'options'	=> array(
				'accent_text_light' => __( 'I chose a dark color in the previous option.', 'themeblvd' ),
				'accent_text_dark' => __( 'I chose a light color in the previous option.', 'themeblvd' )
			)
		)
	);
	themeblvd_add_customizer_section( 'main', __( 'Main', 'themeblvd' ), $main_options, 101 );

	// Setup footer style options
	$footer_options = array(
		'footer_color' => array(
			'name' 		=> __( 'Footer Background Color', 'themeblvd' ),
			'id'		=> 'footer_color',
			'type' 		=> 'color',
			'transport'	=> 'postMessage'
		),
		'footer_text' => array(
			'name' 		=> __( 'Footer Brightness', 'themeblvd' ),
			'id' 		=> 'footer_text',
			'type' 		=> 'radio',
			'options'	=> array(
				'footer_text_light' => __( 'I chose a dark color in the previous option.', 'themeblvd' ),
				'footer_text_dark' => __( 'I chose a light color in the previous option.', 'themeblvd' )
			),
			'transport'	=> 'postMessage'
		),
		'footer_texture' => array(
			'name' 		=> __( 'Footer Background Texture', 'themeblvd' ),
			'id'		=> 'footer_texture',
			'type' 		=> 'select',
			'options'	=> $texture_options,
			'transport'	=> 'postMessage'
		)
	);
	themeblvd_add_customizer_section( 'footer', __( 'Footer', 'themeblvd' ), $footer_options, 102 );

	// Setup primary font options
	$font_options = array(
		'typography_body' => array(
			'name' 		=> __( 'Primary Font', 'themeblvd' ),
			'id' 		=> 'typography_body',
			'atts'		=> array('size', 'face'),
			'type' 		=> 'typography',
			'transport'	=> 'postMessage'
		),
		'typography_header' => array(
			'name' 		=> __( 'Header Font', 'themeblvd' ),
			'id' 		=> 'typography_header',
			'atts'		=> array('face'),
			'type' 		=> 'typography',
			'transport'	=> 'postMessage'
		),
		'typography_special' => array(
			'name' 		=> __( 'Special Font', 'themeblvd' ),
			'id' 		=> 'typography_special',
			'atts'		=> array('face'),
			'type' 		=> 'typography',
			'transport'	=> 'postMessage'
		)
	);
	themeblvd_add_customizer_section( 'typography', __( 'Typography', 'themeblvd' ), $font_options, 103 );

	// Setup link styles
	$link_options = array(
		'link_color' => array(
			'name' 		=> __( 'Link Color', 'themeblvd' ),
			'id' 		=> 'link_color',
			'type' 		=> 'color'
		),
		'link_hover_color' => array(
			'name' 		=> __( 'Link Hover Color', 'themeblvd' ),
			'id' 		=> 'link_hover_color',
			'type' 		=> 'color'
		),
		'footer_link_color' => array(
			'name' 		=> __( 'Footer Link Color', 'themeblvd' ),
			'id' 		=> 'footer_link_color',
			'type' 		=> 'color'
		),
		'footer_link_hover_color' => array(
			'name' 		=> __( 'Footer Link Hover Color', 'themeblvd' ),
			'id' 		=> 'footer_link_hover_color',
			'type' 		=> 'color'
		)
	);
	themeblvd_add_customizer_section( 'links', __( 'Links', 'themeblvd' ), $link_options, 104 );

	// Setup custom styles option
	$custom_styles_options = array(
		'custom_styles' => array(
			'name' 		=> __( 'Enter styles to preview their results.', 'themeblvd' ),
			'id' 		=> 'custom_styles',
			'type' 		=> 'textarea',
			'transport'	=> 'postMessage'
		)
	);
	themeblvd_add_customizer_section( 'custom_css', __( 'Custom CSS', 'themeblvd' ), $custom_styles_options, 121 );

}
add_action( 'after_setup_theme', 'breakout_customizer' );

/**
 * Add specific theme elements to customizer.
 *
 * @since 1.1.0
 */
function breakout_customizer_init( $wp_customize ){
	// Add real-time option edits
	if ( $wp_customize->is_preview() && ! is_admin() ){
		add_action( 'wp_footer', 'breakout_customizer_preview', 21 );
	}
}
add_action( 'customize_register', 'breakout_customizer_init' );

/**
 * Add real-time option edits for this theme in customizer.
 *
 * @since 1.1.0
 */
function breakout_customizer_preview( $wp_customize ){

	// Global options name
	$option_name = themeblvd_get_option_name();

	// Begin output
	?>
	<script type="text/javascript">
	window.onload = function(){ // window.onload for silly IE9 bug fix
		(function($){

			// Variables
			var template_url = "<?php echo get_template_directory_uri(); ?>";

			// ---------------------------------------------------------
			// Logo
			// ---------------------------------------------------------

			<?php themeblvd_customizer_preview_logo(); ?>

			// ---------------------------------------------------------
			// Header
			// ---------------------------------------------------------

			/* Header Color */
			wp.customize('<?php echo $option_name; ?>[header_color]',function( value ) {
				value.bind(function(color) {
					$('#top').css('background-color', color );
				});
			});

			/* Header Brightness */
			wp.customize('<?php echo $option_name; ?>[header_text]',function( value ) {
				value.bind(function(brightness) {
					if( brightness == 'header_text_dark' )
					{
						$('body').removeClass('header_text_light');
						$('body').addClass('header_text_dark');
					}
					else
					{
						$('body').removeClass('header_text_dark');
						$('body').addClass('header_text_light');
					}
				});
			});

			/* Header Texture */
			wp.customize('<?php echo $option_name; ?>[header_texture]',function( value ) {
				value.bind(function(texture) {
					$('#top').css('background-image', 'url('+template_url+'/framework/frontend/assets/images/textures/'+texture+'.png)' );
				});
			});

			/* Header Tagline */
			wp.customize('<?php echo $option_name; ?>[header_tagline]',function( value ) {
				value.bind(function(to) {
					$('.header-text').html(to);
				});
			});

			// ---------------------------------------------------------
			// Main Content
			// ---------------------------------------------------------

			/* Content Color */
			wp.customize('<?php echo $option_name; ?>[content_color]',function( value ) {
				value.bind(function(body_class) {
					$('body').removeClass('content_dark');
					$('body').removeClass('content_light');
					$('body').removeClass('content_tan');
					$('body').addClass(body_class);
				});
			});

			/* Content Texture */
			wp.customize('<?php echo $option_name; ?>[content_texture]',function( value ) {
				value.bind(function(texture) {
					$('#wrapper').css('background-image', 'url('+template_url+'/framework/frontend/assets/images/textures/'+texture+'.png)' );
				});
			});

			// ---------------------------------------------------------
			// Footer
			// ---------------------------------------------------------

			/* Footer Color */
			wp.customize('<?php echo $option_name; ?>[footer_color]',function( value ) {
				value.bind(function(to) {
					$('body, #bottom, #bottom .copyright span').css('background-color', to );
				});
			});

			/* Footer Brightness */
			wp.customize('<?php echo $option_name; ?>[footer_text]',function( value ) {
				value.bind(function(brightness) {
					if( brightness == 'footer_text_dark' )
					{
						$('body').removeClass('footer_text_light');
						$('body').addClass('footer_text_dark');
					}
					else
					{
						$('body').removeClass('footer_text_dark');
						$('body').addClass('footer_text_light');
					}
				});
			});

			/* Footer Texture */
			wp.customize('<?php echo $option_name; ?>[footer_texture]',function( value ) {
				value.bind(function(texture) {
					$('body, #bottom, #bottom .copyright span').css('background-image', 'url('+template_url+'/framework/frontend/assets/images/textures/'+texture+'.png)');
				});
			});

			// ---------------------------------------------------------
			// Typography
			// ---------------------------------------------------------

			<?php themeblvd_customizer_preview_font_prep(); ?>
			<?php themeblvd_customizer_preview_primary_font(); ?>
			<?php themeblvd_customizer_preview_header_font(); ?>

			// ---------------------------------------------------------
			// Special Typography
			// ---------------------------------------------------------

			var special_font_selectors = '#featured .media-full .slide-title, #content .media-full .slide-title, #featured_below .media-full .slide-title, .element-slogan .slogan .slogan-text, .element-tweet, .special-font';

			/* Special Typography - Face */
			wp.customize('<?php echo $option_name; ?>[typography_special][face]',function( value ) {
				value.bind(function(face) {
					if( face == 'google' ){
						googleFonts.specialToggle = true;
						var google_font = googleFonts.specialName.split(":"),
							google_font = google_font[0];
						$(special_font_selectors).css('font-family', google_font);
					}
					else
					{
						googleFonts.specialToggle = false;
						$(special_font_selectors).css('font-family', fontStacks[face]);
					}
				});
			});

			/* Special Typography - Google */
			wp.customize('<?php echo $option_name; ?>[typography_special][google]',function( value ) {
				value.bind(function(google_font) {
					// Only proceed if user has actually selected for
					// a google font to show in previous option.
					if(googleFonts.specialToggle)
					{
						// Set global google font for reference in
						// other options.
						googleFonts.specialName = google_font;

						// Remove previous google font to avoid clutter.
						$('.preview_google_special_font').remove();

						// Format font name for inclusion
						var include_google_font = google_font.replace(/ /g,'+');

						// Include font
						$('head').append('<link href="http://fonts.googleapis.com/css?family='+include_google_font+'" rel="stylesheet" type="text/css" class="preview_google_special_font" />');

						// Format for CSS
						google_font = google_font.split(":");
						google_font = google_font[0];

						// Apply font in CSS
						$(special_font_selectors).css('font-family', google_font);
					}
				});
			});

			// ---------------------------------------------------------
			// Custom CSS
			// ---------------------------------------------------------

			<?php themeblvd_customizer_preview_styles(); ?>

		})(jQuery);
	} // End window.onload for silly IE9 bug
	</script>
	<?php
}