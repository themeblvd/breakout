<?php
/**
 * Use Options API to add options onto options already 
 * present in framework. This is possible in Theme Blvd 
 * Framework 2.1.0+.
 */

if( ! function_exists( 'breakout_options' ) ) {
	function breakout_options() {
		
		// Textures
		$texture_options = array( 'none' => __( 'None', TB_GETTEXT_DOMAIN ) );
		$textures = themeblvd_get_textures();
		foreach( $textures as $id => $atts ) {
			$texture_options[$id] = $atts['name'];
		}
		
		// Add Styles
		themeblvd_add_option_tab( 'styles', __( 'Styles', TB_GETTEXT_DOMAIN ), true );
		
		// Add Styles > Main section
		$main_options = array(
			array(	
				'name' 		=> __( 'Content Color', TB_GETTEXT_DOMAIN ),
				'desc'		=> __( 'Select the primary color. This color makes up the background of the site.', TB_GETTEXT_DOMAIN ),
				'id'		=> 'content_color',
				'std'		=> 'content_light',
				'type' 		=> 'select',
				'options'	=> array(
					'content_dark' 			=> __( 'Dark', TB_GETTEXT_DOMAIN ),
					'content_light' 		=> __( 'Light', TB_GETTEXT_DOMAIN ),
					'content_tan' 			=> __( 'Tan', TB_GETTEXT_DOMAIN )
				)
			),
			array(
				'name' 		=> __( 'Content Background Texture', TB_GETTEXT_DOMAIN ),
				'desc'		=> __( 'This texture gets to the background in the main section of the theme.<br><br><em>Note: The "Light" textures tend to look nicer when combined with the "Light" content color selected in the previous option.</em>', TB_GETTEXT_DOMAIN ),
				'id'		=> 'content_texture',
				'std'		=> 'diagnol_thin_light',
				'type' 		=> 'select',
				'options'	=> $texture_options
			),
			array( 
				'name' 		=> __( 'Accent Color', TB_GETTEXT_DOMAIN ),
				'desc' 		=> __( 'This color gets applied to some minor items throughout the theme such as the default color of buttons and elements within sliders.', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'accent_color',
				'std' 		=> '#28313c',
				'type' 		=> 'color'
			),
			array(
				'name' 		=> __( 'Accent Color Brightness', TB_GETTEXT_DOMAIN ),
				'desc' 		=> __( 'In the previous option, did you choose a dark color or a light color? This will determine how text is styled in the areas with this background color.', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'accent_text',
				'std' 		=> 'accent_text_light',
				'type' 		=> 'select',
				'options'	=> array(
					'accent_text_light' => __( 'I chose a dark color in the previous option.', TB_GETTEXT_DOMAIN ),
					'accent_text_dark' => __( 'I chose a light color in the previous option.', TB_GETTEXT_DOMAIN )
				)
			)
		);
		themeblvd_add_option_section( 'styles', 'main_styles', __( 'Main', TB_GETTEXT_DOMAIN ), null, $main_options, false );
		
		// Add Styles > Header section
		$header_options = array(
			array( 
				'name' 		=> __( 'Header Color', TB_GETTEXT_DOMAIN ),
				'desc' 		=> __( 'This color gets applied to the background of the header.', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'header_color',
				'std' 		=> '#28313c',
				'type' 		=> 'color'
			),
			array(
				'name' 		=> __( 'Header Color Brightness', TB_GETTEXT_DOMAIN ),
				'desc' 		=> __( 'In the previous option, did you choose a dark color or a light color? This will determine how text is styled for the header.', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'header_text',
				'std' 		=> 'header_text_light',
				'type' 		=> 'select',
				'options'	=> array(
					'header_text_light' => __( 'I chose a dark color in the previous option.', TB_GETTEXT_DOMAIN ),
					'header_text_dark' => __( 'I chose a light color in the previous option.', TB_GETTEXT_DOMAIN )
				)
			),
			array(
				'name' 		=> __( 'Header Background Texture', TB_GETTEXT_DOMAIN ),
				'desc'		=> __( 'This texture gets applied over the background color of the header.', TB_GETTEXT_DOMAIN ),
				'id'		=> 'header_texture',
				'std'		=> 'denim',
				'type' 		=> 'select',
				'options'	=> $texture_options
			)
		);
		themeblvd_add_option_section( 'styles', 'header_styles', __( 'Header', TB_GETTEXT_DOMAIN ), null, $header_options, false );
		
		// Add Styles > Footer section
		$footer_options = array(
			array( 
				'name' 		=> __( 'Footer Color', TB_GETTEXT_DOMAIN ),
				'desc' 		=> __( 'This color gets applied to the background of the footer.', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'footer_color',
				'std' 		=> '#28313c',
				'type' 		=> 'color'
			),
			array(
				'name' 		=> __( 'Footer Color Brightness', TB_GETTEXT_DOMAIN ),
				'desc' 		=> __( 'In the previous option, did you choose a dark color or a light color? This will determine how text is styled for the footer.', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'footer_text',
				'std' 		=> 'footer_text_light',
				'type' 		=> 'select',
				'options'	=> array(
					'footer_text_light' => __( 'I chose a dark color in the previous option.', TB_GETTEXT_DOMAIN ),
					'footer_text_dark' => __( 'I chose a light color in the previous option.', TB_GETTEXT_DOMAIN )
				)
			),
			array(
				'name' 		=> __( 'Footer Background Texture', TB_GETTEXT_DOMAIN ),
				'desc'		=> __( 'This texture gets applied over the background color of the footer.', TB_GETTEXT_DOMAIN ),
				'id'		=> 'footer_texture',
				'std'		=> 'denim',
				'type' 		=> 'select',
				'options'	=> $texture_options
			)
		);
		themeblvd_add_option_section( 'styles', 'footer_styles', __( 'Footer', TB_GETTEXT_DOMAIN ), null, $footer_options, false );

		// Add Styles > Links section
		$links_options = array(
			array( 
				'name' 		=> __( 'Link Color', TB_GETTEXT_DOMAIN ),
				'desc' 		=> __( 'Choose the color you\'d like applied to links.', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'link_color',
				'std' 		=> '#2a9ed4',
				'type' 		=> 'color'
			),
			array( 
				'name' 		=> __( 'Link Hover Color', TB_GETTEXT_DOMAIN ),
				'desc' 		=> __( 'Choose the color you\'d like applied to links when they are hovered over.', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'link_hover_color',
				'std' 		=> '#1a5a78',
				'type' 		=> 'color'
			),
			array(
				'name' 		=> __( 'Footer Link Color', TB_GETTEXT_DOMAIN ),
				'desc' 		=> __( 'Choose the color you\'d like applied to links in the footer.', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'footer_link_color',
				'std' 		=> '#ffffff',
				'type' 		=> 'color'
			),
			array(
				'name' 		=> __( 'Footer Link Hover Color', TB_GETTEXT_DOMAIN ),
				'desc' 		=> __( 'Choose the color you\'d like applied to links in the footer when they are hovered over.', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'footer_link_hover_color',
				'std' 		=> '#007bff',
				'type' 		=> 'color'
			)
		);
		themeblvd_add_option_section( 'styles', 'links', __( 'Links', TB_GETTEXT_DOMAIN ), null, $links_options, false );
		
		// Add Styles > Typography section
		$typography_options = array(
			array( 
				'name' 		=> __( 'Primary Font', TB_GETTEXT_DOMAIN ),
				'desc' 		=> __( 'This applies to most of the text on your site.', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'typography_body',
				'std' 		=> array('size' => '12px','face' => 'arial','color' => '', 'google' => ''),
				'atts'		=> array('size', 'face'),
				'type' 		=> 'typography'
			),
			array( 
				'name' 		=> __( 'Header Font', TB_GETTEXT_DOMAIN ),
				'desc' 		=> __( 'This applies to all of the primary headers throughout your site (h1, h2, h3, h4, h5, h6). This would include header tags used in redundant areas like widgets and the content of posts and pages.', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'typography_header',
				'std' 		=> array('size' => '','face' => 'helvetica','color' => '', 'google' => ''),
				'atts'		=> array('face'),
				'type' 		=> 'typography'
			),
			array(
				'name' 		=> __( 'Special Font', TB_GETTEXT_DOMAIN ),
				'desc' 		=> __( 'It can be kind of overkill to select a super fancy font for the previous option, but here is where you can go crazy. There are a few special areas in this theme where this font will get used.', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'typography_special',
				'std' 		=> array('size' => '','face' => 'google','color' => '', 'google' => 'Josefin Sans'),
				'atts'		=> array('face'),
				'type' 		=> 'typography'
			)
		);
		themeblvd_add_option_section( 'styles', 'typography', __( 'Typography', TB_GETTEXT_DOMAIN ), null, $typography_options, false );
		
		// Add Styles > Custom section
		$custom_options = array(
			array( 
				'name' 		=> __( 'Custom CSS', TB_GETTEXT_DOMAIN ),
				'desc' 		=> __( 'If you have some minor CSS changes, you can put them here to override the theme\'s default styles. However, if you plan to make a lot of CSS changes, it would be best to create a child theme.', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'custom_styles',
				'type'		=> 'textarea'
			)
		);
		themeblvd_add_option_section( 'styles', 'custom', __( 'Custom', TB_GETTEXT_DOMAIN ), null, $custom_options, false );
		
		// Add social media option to Layout > Header
		$social_media = array( 
			'name' 		=> __( 'Social Media Buttons', TB_GETTEXT_DOMAIN ),
			'desc' 		=> __( 'Configure the social media buttons you\'d like to show in the header of your site. Check the buttons you\'d like to use and then input the full URL you\'d like the button to link to in the corresponding text field that appears.<br><br>Example: http://twitter.com/jasonbobich<br><br><em>Note: On the "Email" button, if you want it to link to an actual email address, you would input it like this:<br><br><strong>mailto:you@youremail.com</strong></em><br><br><em>Note: If you\'re using the RSS button, your default RSS feed URL is:<br><br><strong>'.get_feed_link( 'feed' ).'</strong></em>', TB_GETTEXT_DOMAIN ),
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
			'name' 		=> __( 'Header Text', TB_GETTEXT_DOMAIN ),
			'desc'		=> __( 'Enter a very brief piece of text you\'d like to show below the social icons.', TB_GETTEXT_DOMAIN ),
			'id'		=> 'header_tagline',
			'std'		=> '<strong>Call Now: 1-800-123-4567</strong>',
			'type' 		=> 'text'
		);
		themeblvd_add_option( 'layout', 'header', 'header_tagline', $header_text );
		
		// Add meta option for archive posts
		$archive_meta = array(
			'name' 		=> __( 'Show meta info?', TB_GETTEXT_DOMAIN ),
			'desc' 		=> __( 'Choose whether you want to show meta information under the title of each post.', TB_GETTEXT_DOMAIN ),
			'id' 		=> 'archive_meta',
			'std' 		=> 'show',
			'type' 		=> 'radio',
			'options' 	=> array(
				'show'	=> __( 'Show meta info.', TB_GETTEXT_DOMAIN ),
				'hide' 	=> __( 'Hide meta info.', TB_GETTEXT_DOMAIN )
			)
		);
		themeblvd_add_option( 'content', 'archives', 'archive_meta', $archive_meta );
		
		// Add tags option for archive posts
		$archive_meta = array(
			'name' 		=> __( 'Show tags?', TB_GETTEXT_DOMAIN ),
			'desc' 		=> __( 'Choose whether you want to show tags under at the bottom of each post.', TB_GETTEXT_DOMAIN ),
			'id' 		=> 'archive_tags',
			'std' 		=> 'show',
			'type' 		=> 'radio',
			'options' 	=> array(
				'show'	=> __( 'Show tags.', TB_GETTEXT_DOMAIN ),
				'hide' 	=> __( 'Hide tags.', TB_GETTEXT_DOMAIN )
			)
		);
		themeblvd_add_option( 'content', 'archives', 'archive_tags', $archive_meta );
		
		// Add post list options 
		$post_list_description = __( 'These options apply to posts when they are shown from within any post list throughout your site. This includes the Primary Posts Display described above, as well.<br><br>Note: It may be confusing why these options are not present when editing a specific post list. The reason is because the options when working with a specific post list are incorporated into the actual theme framework, while these settings have been added to this particular theme design for your conveniance.', TB_GETTEXT_DOMAIN );
		$post_list = array(
			array(
				'name' 		=> __( 'Show meta info?', TB_GETTEXT_DOMAIN ),
				'desc' 		=> __( 'Choose whether you want to show meta information under the title of each post.', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'post_list_meta',
				'std' 		=> 'show',
				'type' 		=> 'radio',
				'options' 	=> array(
					'show'	=> __( 'Show meta info.', TB_GETTEXT_DOMAIN ),
					'hide' 	=> __( 'Hide meta info.', TB_GETTEXT_DOMAIN )
				)
			),
			array(
				'name' 		=> __( 'Show tags?', TB_GETTEXT_DOMAIN ),
				'desc' 		=> __( 'Choose whether you want to show tags under at the bottom of each post.', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'post_list_tags',
				'std' 		=> 'show',
				'type' 		=> 'radio',
				'options' 	=> array(
					'show'	=> __( 'Show tags.', TB_GETTEXT_DOMAIN ),
					'hide' 	=> __( 'Hide tags.', TB_GETTEXT_DOMAIN )
				)
			)
					
		);
		themeblvd_add_option_section( 'content', 'post_list', __( 'Post Lists', TB_GETTEXT_DOMAIN ), $post_list_description, $post_list );

		// Add post grid options 
		$post_grid_description = __( 'These options apply to posts when they are shown from within any post grid throughout your site.<br><br>Note: It may be confusing why these options are not present when editing a specific post grid. The reason is because the options when working with a specific post grid are incorporated into the actual theme framework, while these settings have been added to this particular theme design for your conveniance.', TB_GETTEXT_DOMAIN );
		$post_grid = array(
			array(
				'name' 		=> __( 'Show title?', TB_GETTEXT_DOMAIN ),
				'desc' 		=> __( 'Choose whether or not you want to show the title below each featured image in post grids.', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'post_grid_title',
				'std' 		=> 'show',
				'type' 		=> 'radio',
				'options' 	=> array(
					'show'	=> __( 'Show titles.', TB_GETTEXT_DOMAIN ),
					'hide' 	=> __( 'Hide titles.', TB_GETTEXT_DOMAIN )
				)
			),
			array(
				'name' 		=> __( 'Show excerpts?', TB_GETTEXT_DOMAIN ),
				'desc' 		=> __( 'Choose whether or not you want to show the excerpt on each post.', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'post_grid_excerpt',
				'std' 		=> 'hide',
				'type' 		=> 'radio',
				'options' 	=> array(
					'show'	=> __( 'Show excerpts.', TB_GETTEXT_DOMAIN ),
					'hide' 	=> __( 'Hide excerpts.', TB_GETTEXT_DOMAIN )
				)
			),
			array(
				'name' 		=> __( 'Show buttons?', TB_GETTEXT_DOMAIN ),
				'desc' 		=> __( 'Choose whether or not you want to show a button that links to the single post.', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'post_grid_button',
				'std' 		=> 'hide',
				'type' 		=> 'radio',
				'options' 	=> array(
					'show'	=> __( 'Show buttons.', TB_GETTEXT_DOMAIN ),
					'hide' 	=> __( 'Hide buttons.', TB_GETTEXT_DOMAIN )
				)
			)
		);
		themeblvd_add_option_section( 'content', 'post_grid', __( 'Post Grids', TB_GETTEXT_DOMAIN ), $post_grid_description, $post_grid, false );
		
		// Modify framework options
		themeblvd_edit_option( 'content', 'blog', 'blog_content', 'std', 'excerpt' );
	}
}
add_action( 'after_setup_theme', 'breakout_options' );

/**
 * Setup theme for customizer.
 */
 
if( ! function_exists( 'breakout_customizer' ) ) {
	function breakout_customizer(){
		
		// Textures
		$texture_options = array( 'none' => __( 'None', TB_GETTEXT_DOMAIN ) );
		$textures = themeblvd_get_textures();
		foreach( $textures as $id => $atts ) {
			$texture_options[$id] = $atts['name'];
		}
		
		// Setup logo options
		$logo_options = array(
			'logo' => array( 
				'name' 		=> __( 'Logo', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'logo',
				'type' 		=> 'logo',
				'transport'	=> 'postMessage'
			)
		);
		themeblvd_add_customizer_section( 'logo', __( 'Logo', TB_GETTEXT_DOMAIN ), $logo_options, 1 );
		
		// Setup header style options
		$header_options = array(
			'header_color' => array( 
				'name' 		=> __( 'Header Background Color', TB_GETTEXT_DOMAIN ),
				'id'		=> 'header_color',
				'type' 		=> 'color',
				'transport'	=> 'postMessage'
			),
			'header_text' => array(
				'name' 		=> __( 'Header Brightness', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'header_text',
				'type' 		=> 'radio',
				'options'	=> array(
					'header_text_light' => __( 'I chose a dark color in the previous option.', TB_GETTEXT_DOMAIN ),
					'header_text_dark' => __( 'I chose a light color in the previous option.', TB_GETTEXT_DOMAIN )
				),
				'transport'	=> 'postMessage'
			),
			'header_texture' => array(
				'name' 		=> __( 'Header Background Texture', TB_GETTEXT_DOMAIN ),
				'id'		=> 'header_texture',
				'type' 		=> 'select',
				'options'	=> $texture_options,
				'transport'	=> 'postMessage'
			),
			'header_tagline' => array( 
				'name' 		=> __( 'Header Text', TB_GETTEXT_DOMAIN ),
				'id'		=> 'header_tagline',
				'type' 		=> 'text',
				'transport'	=> 'postMessage'
			)
		);
		themeblvd_add_customizer_section( 'header', __( 'Header', TB_GETTEXT_DOMAIN ), $header_options, 2 );
		
		// Setup main content area options
		$main_options = array(
			'content_color' => array(	
				'name' 		=> __( 'Content Color', TB_GETTEXT_DOMAIN ),
				'id'		=> 'content_color',
				'type' 		=> 'select',
				'options'	=> array(
					'content_dark' => __( 'Dark', TB_GETTEXT_DOMAIN ),
					'content_light' => __( 'Light', TB_GETTEXT_DOMAIN ),
					'content_tan' => __( 'Tan', TB_GETTEXT_DOMAIN )
				),
				'transport'	=> 'postMessage'
			),
			'content_texture' => array(
				'name' 		=> __( 'Content Background Texture', TB_GETTEXT_DOMAIN ),
				'id'		=> 'content_texture',
				'type' 		=> 'select',
				'options'	=> $texture_options,
				'transport'	=> 'postMessage'
			),
			'accent_color' => array( 
				'name' 		=> __( 'Accent Color', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'accent_color',
				'type' 		=> 'color'
			),
			'accent_text' => array(
				'name' 		=> __( 'Accent Color Brightness', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'accent_text',
				'type' 		=> 'radio',
				'options'	=> array(
					'accent_text_light' => __( 'I chose a dark color in the previous option.', TB_GETTEXT_DOMAIN ),
					'accent_text_dark' => __( 'I chose a light color in the previous option.', TB_GETTEXT_DOMAIN )
				)
			)
		);
		themeblvd_add_customizer_section( 'main', __( 'Main', TB_GETTEXT_DOMAIN ), $main_options, 101 );
		
		// Setup footer style options
		$footer_options = array(
			'footer_color' => array( 
				'name' 		=> __( 'Footer Background Color', TB_GETTEXT_DOMAIN ),
				'id'		=> 'footer_color',
				'type' 		=> 'color',
				'transport'	=> 'postMessage'
			),
			'footer_text' => array(
				'name' 		=> __( 'Footer Brightness', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'footer_text',
				'type' 		=> 'radio',
				'options'	=> array(
					'footer_text_light' => __( 'I chose a dark color in the previous option.', TB_GETTEXT_DOMAIN ),
					'footer_text_dark' => __( 'I chose a light color in the previous option.', TB_GETTEXT_DOMAIN )
				),
				'transport'	=> 'postMessage'
			),
			'footer_texture' => array(
				'name' 		=> __( 'Footer Background Texture', TB_GETTEXT_DOMAIN ),
				'id'		=> 'footer_texture',
				'type' 		=> 'select',
				'options'	=> $texture_options,
				'transport'	=> 'postMessage'
			)
		);
		themeblvd_add_customizer_section( 'footer', __( 'Footer', TB_GETTEXT_DOMAIN ), $footer_options, 102 );
		
		// Setup primary font options
		$font_options = array(
			'typography_body' => array( 
				'name' 		=> __( 'Primary Font', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'typography_body',
				'atts'		=> array('size', 'face'),
				'type' 		=> 'typography',
				'transport'	=> 'postMessage'
			),
			'typography_header' => array( 
				'name' 		=> __( 'Header Font', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'typography_header',
				'atts'		=> array('face'),
				'type' 		=> 'typography',
				'transport'	=> 'postMessage'
			),
			'typography_special' => array(
				'name' 		=> __( 'Special Font', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'typography_special',
				'atts'		=> array('face'),
				'type' 		=> 'typography',
				'transport'	=> 'postMessage'
			)
		);
		themeblvd_add_customizer_section( 'typography', __( 'Typography', TB_GETTEXT_DOMAIN ), $font_options, 103 );
		
		// Setup link styles
		$link_options = array(
			'link_color' => array( 
				'name' 		=> __( 'Link Color', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'link_color',
				'type' 		=> 'color'
			),
			'link_hover_color' => array( 
				'name' 		=> __( 'Link Hover Color', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'link_hover_color',
				'type' 		=> 'color'
			),
			'footer_link_color' => array(
				'name' 		=> __( 'Footer Link Color', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'footer_link_color',
				'type' 		=> 'color'
			),
			'footer_link_hover_color' => array(
				'name' 		=> __( 'Footer Link Hover Color', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'footer_link_hover_color',
				'type' 		=> 'color'
			)
		);
		themeblvd_add_customizer_section( 'links', __( 'Links', TB_GETTEXT_DOMAIN ), $link_options, 104 );
		
		// Setup custom styles option
		$custom_styles_options = array(
			'custom_styles' => array( 
				'name' 		=> __( 'Enter styles to preview their results.', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'custom_styles',
				'type' 		=> 'textarea',
				'transport'	=> 'postMessage'
			)
		);
		themeblvd_add_customizer_section( 'custom_css', __( 'Custom CSS', TB_GETTEXT_DOMAIN ), $custom_styles_options, 121 );
	}
}
add_action( 'after_setup_theme', 'breakout_customizer' );

/**
 * Add specific theme elements to customizer.
 */

if( ! function_exists( 'breakout_customizer_init' ) ) {
	function breakout_customizer_init( $wp_customize ){
		// Add real-time option edits
		if ( $wp_customize->is_preview() && ! is_admin() ){
			add_action( 'wp_footer', 'breakout_customizer_preview', 21 );
		}
	}
}
add_action( 'customize_register', 'breakout_customizer_init' );

/**
 * Add real-time option edits for this theme in customizer.
 */

if( ! function_exists( 'breakout_customizer_preview' ) ) {
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
}