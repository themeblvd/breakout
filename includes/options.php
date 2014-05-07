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
			'link_color' => array( 
				'name' 		=> __( 'Link Color', TB_GETTEXT_DOMAIN ),
				'desc' 		=> __( 'Choose the color you\'d like applied to links.', TB_GETTEXT_DOMAIN ),
				'id' 		=> 'link_color',
				'std' 		=> '#2a9ed4',
				'type' 		=> 'color'
			),
			'link_hover_color' => array( 
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