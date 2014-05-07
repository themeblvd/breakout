<?php
/*-----------------------------------------------------------------------------------*/
/* Helpers
/*-----------------------------------------------------------------------------------*/

/**
 * The post thumbnail (must be within the loop)
 *
 * @since 2.0.0
 *
 * @param string $location Whether the thumbnail is currently in the featured area or not, not always applicable
 * @param string $size Size of post thumbnail
 * @param string $link Where link will go if it's active
 * @param string $link_url URL where link will go if applicable
 * @param boolean $allow_filters Whether to allow filters to be applied or not
 * @return string $output HTML to output thumbnail
 */

if( ! function_exists( 'themeblvd_get_post_thumbnail' ) ) {
	function themeblvd_get_post_thumbnail( $location = 'primary', $size = '', $link = true, $allow_filters = true ) {
		global $post;
		$attachment_id = get_post_thumbnail_id( $post->ID );
		$conditionals = apply_filters( 'thumbnail_conditionals', array( 'home', 'template_list.php', 'single', 'search', 'archive' ) );
		$fake_conditional = themeblvd_config( 'fake_conditional' );
		$sidebar_layout = themeblvd_config( 'sidebar_layout' );
		$link_target = null;
		$end_link = null;
		$output = null;
		$classes = null;
		$image = null;
		$title = null;

		// Set size if it wasn't already passed into the function
		if( ! $size ) {
			// Primary posts page, blog page template, single posts, archives, and search results
			if( in_array( $fake_conditional, $conditionals ) ) {
				// Get default size option
				if( $fake_conditional == 'home' || $fake_conditional == 'template_list.php' )	
					$thumb_size_option = themeblvd_get_option( 'blog_thumbs', null, 'small' );
				else if( $fake_conditional == 'search' || $fake_conditional == 'archive' )
					$thumb_size_option = themeblvd_get_option( 'archive_thumbs', null, 'small' );
				else if( $fake_conditional == 'single' )
					$thumb_size_option = themeblvd_get_option( 'single_thumbs', null, 'small' );
				// Single post page override
				if( $fake_conditional == 'single' ) {
					$thumb_size_meta = get_post_meta( $post->ID, '_tb_thumb', true );
					if( $thumb_size_meta == 'full' || $thumb_size_meta == 'small' || $thumb_size_meta == 'hide' ) {
						$thumb_size_option = $thumb_size_meta;
					}
				}
				// Handle size option
				if( $thumb_size_option ) {
					switch( $thumb_size_option ) {
						 case 'hide' :
						 	$size = null;
						 	break;
						 case 'full' :
						 	$sidebar_layout == 'full_width' ? $size = 'tb_large' : $size = 'tb_medium';
						 	break;
						 case 'small' :
						 	$size = 'tb_small';
						 	break;
					}
				}			
			}
		}
		// Handle $size option if it was manually feed in (like in template_list.php)
		if( $size == 'hide' )
			$size = null;
		if( $size == 'full' )
			$location == 'featured' || $sidebar_layout == 'full_width' ? $size = 'tb_large' : $size = 'tb_medium';
		if( $size == 'small' )
			$size = 'tb_small';
		
		// If $size was set to null, it means the post 
		// thumb should be hidden. So, return nothing.
		if( $size == null )
			return $output;
			
		// Since the link is completely dependant on the post 
		// and no external options, we can set it up with 
		// no conditionals.
		if( $link ) {
			$possible_link_options = array( 'post', 'thumbnail', 'image', 'video', 'external' );
			$thumb_link_meta = get_post_meta( $post->ID, '_tb_thumb_link', true );
			if( in_array( $thumb_link_meta, $possible_link_options ) ) {
				switch( $thumb_link_meta ) {
					case 'post' :
						$link_url = get_permalink( $post->ID );
						break;
					case 'thumbnail' :
						$link_url = wp_get_attachment_url( $attachment_id );
						$link_target = ' rel="featured_themeblvd_lightbox[gallery]"';
						break;
					case 'image' :
						$link_url = get_post_meta( $post->ID, '_tb_image_link', true );
						$link_target = ' rel="featured_themeblvd_lightbox[gallery]"';
						break;
					case 'video' :
						$link_url = get_post_meta( $post->ID, '_tb_video_link', true );
						$link_target = ' rel="featured_themeblvd_lightbox[gallery]"';
						break;
					case 'external' :
						$link_url = get_post_meta( $post->ID, '_tb_external_link', true );
						$target = get_post_meta( $post->ID, '_tb_external_link_target', true );
						if( ! $target )
							$target = '_blank';
						$link_target = ' target="'.$target.'"';
						break;
				}
				if( is_single() ) $link_target = str_replace('[gallery]', '', $link_target );
				$end_link = '<span class="image-overlay"><span class="image-overlay-bg"></span><span class="image-overlay-icon"></span></span>';
				$end_link = apply_filters( 'themeblvd_image_overlay', $end_link );
			} else {
				$link = false;
			}
		}
		
		// Image check
		$image = wp_get_attachment_image_src( $attachment_id, $size );
		
		// Attributes
		$size_class = $size;
		if( $size_class == 'tb_small' ) $size_class = 'small';
		$classes = 'attachment-'.$size_class.' wp-post-image';
		if( is_single() ) $title = ' title="'.get_the_title($post->ID).'"';
		
		// Final HTML output
		if( has_post_thumbnail( $post->ID ) ) {
			$output .= '<div class="featured-image-wrapper '.$classes.'">';
			$output .= '<div class="featured-image">';
			$output .= '<div class="featured-image-inner">';
			if( $link ) $output .= '<a href="'.$link_url.'"'.$link_target.' class="'.$thumb_link_meta.'"'.$title.'>';	
			$output .= get_the_post_thumbnail( $post->ID, $size, array( 'class' => '' ) );
			if( $link ) $output .= $end_link.'</a>';
			$output .= '</div><!-- .featured-image-inner (end) -->';
			$output .= '</div><!-- .featured-image (end) -->';
			$output .= '</div><!-- .featured-image-wrapper (end) -->';
		}
		
		// Apply filters if allowed
		if( $allow_filters )
			$output = apply_filters( 'themeblvd_post_thumbnail', $output, $location, $size, $link );
		
		// Return final output
		return $output;
	}
}

/** 
 * Grab placeholder image 
 *
 * @since 2.0.0
 *
 * @param $size string Size of image placeholder
 * @return $image_url string URL to image for placeholder
 */

if( ! function_exists( 'themeblvd_placeholder_image' ) ) {
	function themeblvd_placeholder_image( $size ) {
		$image_url = null;
		$images = array(
			'slider-large' 	=> TB_FRAMEWORK_DIRECTORY . '/frontend/assets/images/placeholders/slider-large.png',
			'slider-staged' => TB_FRAMEWORK_DIRECTORY . '/frontend/assets/images/placeholders/slider-large.png',
		);
		$images = apply_filters( 'themeblvd_placeholder_image', $images );
		if( isset( $images[$size] ) )
			$image_url = $images[$size];
		
		return $image_url;
	}
}

/**
 * Remove trailing space from string.
 *
 * @since 2.0.0 
 *
 * @param string $string Current string to check
 * @param string $char Character to remove from end of string if exists
 * @return string $string String w/out trailing space, if it had one
 */
 
if( ! function_exists( 'themeblvd_remove_trailing_char' ) ) {
	function themeblvd_remove_trailing_char( $string, $char = ' ' ) {
		$offset = strlen( $string ) - 1;
		$trailing_char = strpos( $string, $char, $offset );
		if( $trailing_char )
			$string = substr( $string, 0, -1 );
		return $string;
	}
}

/**
 * Get the name for a font face to be used within the CSS.
 *
 * @since 2.0.0 
 *
 * @param array $option Current option set by user for the font
 * @return string $stack Name of font to be used in CSS
 */

if( ! function_exists( 'themeblvd_get_font_face' ) ) {
	function themeblvd_get_font_face( $option ) {
		$stack = null;
		$stacks = themeblvd_font_stacks();
		if( $option['face'] == 'google'  ) {
			// Grab font face, making sure they didn't do the 
			// super, sneaky trick of including font weight or type.
			$name = explode( ':', $option['google'] ); 
			// And also check for accidental space at end
			$name = themeblvd_remove_trailing_char( $name[0] ); 
			// Add the deafult font stack to the end of the 
			// google font.
			$stack = $name.', '.$stacks['default'];
		} else {
			$stack = $stacks[$option['face']]; 
		}
		return $stack;
	}
}

/**
 * List pages as a main navigation menu when user
 * has not set one under Apperance > Menus in the
 * WordPress admin panel.
 *
 * @since 2.0.0
 */

if( ! function_exists( 'themeblvd_primary_menu_fallback' ) ) { 
	function themeblvd_primary_menu_fallback() {
		$home_text = themeblvd_get_local('home');
		echo '<ul id="primary-menu" class="sf-menu">';
		echo '<li class="home"><a href="'.home_url().'" title="'.$home_text.'">'.$home_text.'</a></li>';
		wp_list_pages('title_li=');
		echo '</ul>';
	}
}

/**
 * Generate the query string for a blog page.
 *
 * @since 2.0.0
 *
 * @param int $posts_per_page Optional number of posts per page
 * @return string $query_string Query string to get passed into query_posts()
 */

if( ! function_exists( 'themeblvd_query_string' ) ) { 
	function themeblvd_query_string( $posts_per_page = null ) {
		global $_themeblvd_paged;
		$query_string = null;
		$category_name_string = null;
		$categories = null;
		$posts_per_page_override = null;
		// Blog page templates
		if( is_page_template( 'template_list.php' ) || is_page_template( 'template_grid.php' ) ) {
			global $post;
			// Categories (IDs)
			$category_id_string = get_post_meta( $post->ID, 'categories', true );
			if( $category_id_string )
				$categories = 'cat='.$category_id_string; // Will get added to query_string towards end of function
			// Categories (slug)
			$category_name_string = get_post_meta( $post->ID, 'category_name', true );
			if( $category_name_string )
				$query_string .= 'category_name='.$category_name_string.'&';
			// Posts per page
			$posts_per_page_override = get_post_meta( $post->ID, 'posts_per_page', true );
			if( $posts_per_page_override )
				$query_string .= 'posts_per_page='.$posts_per_page_override.'&';
			// Orderby
			$orderby = get_post_meta( $post->ID, 'orderby', true ); 
			if( $orderby )
				$query_string .= 'orderby='.$orderby.'&';
			// Order
			$order = get_post_meta( $post->ID, 'order', true ); // ACS or DESC
			if( $order )
				$query_string .= 'order='.$order.'&';
			// Offset
			$offset = get_post_meta( $post->ID, 'offset', true );
			if( $offset )
				$query_string .= 'offset='.$offset.'&';
		}
		// If the categories (IDs) weren't already setup with custom fields, 
		// or this isn't even the page template, we'll look to the theme 
		// options for any category excludes. This only applies to the blog 
		// page template and primary posts page.
		if( is_home() || is_page_template( 'template_list.php' ) ) {
			if( ! $categories && ! $category_name_string ) {
				$exclude = themeblvd_get_option( 'blog_categories' );
				if( $exclude ) {
					$categories = 'cat=';
					foreach( $exclude as $key => $value )
						if( $value )
							$categories .= '-'.$key.',';
					$categories = themeblvd_remove_trailing_char( $categories, ',' );
				}
			}
		}
		// Categories (IDs)
		if( $categories )
			$query_string .= $categories.'&';
		// Posts per page
		if( ! $posts_per_page_override && $posts_per_page )
			$query_string .= 'posts_per_page='.$posts_per_page.'&';
		// Pagination
		if ( get_query_var('paged') )
	        $paged = get_query_var('paged');
	    else if ( get_query_var('page') )
	        $paged = get_query_var('page'); // This provides compatiblity with static frontpage
		else
	        $paged = 1;
		$_themeblvd_paged = $paged; // Set global variable for pagination compatiblity on static frontpage
		$query_string .= 'paged='.$paged;
		// Return query string
		return apply_filters( 'themeblvd_query_string', $query_string );
	}
}

/**
 * Setup arguement to pass into get_posts()
 *
 * @since 2.0.0
 *
 * @param array $options All options for query string
 * @param string $type Type of posts setup, grid or list
 * @param boolean $slider Whether or no this is a slider
 * @return array $args Arguments to get passed into get_posts()
 */

if( ! function_exists( 'themeblvd_get_posts_args' ) ) { 
	function themeblvd_get_posts_args( $options, $type, $slider = false ) {
		$args = array();
		
		// Number of posts
		if( $type == 'grid' && ! $slider ) {
			if( $options['rows'] )
				$args['numberposts'] = $options['rows']*$options['columns'];
		} else {
			if( $options['numberposts'] ) 
				$args['numberposts'] = $options['numberposts'];
		}
		if( ! isset( $args['numberposts'] ) )
			$args['numberposts'] = -1;
		// Categories
		if( ! $options['categories']['all'] ) {
			unset( $options['categories']['all'] );
			$categories = '';
			foreach( $options['categories'] as $category => $include ) {
				if( $include ) {
					$current_category = get_term_by( 'slug', $category, 'category' );
					$categories .= $current_category->term_id.',';
				}
			}
			if( $categories ) {
				$categories = themeblvd_remove_trailing_char( $categories, $char = ',' );
				$args['category'] = $categories;
			}
		}
		// Additional args
		if( isset( $options['orderby'] ) ) $args['orderby'] = $options['orderby'];
		if( isset( $options['order'] ) ) $args['order'] = $options['order'];
		if( isset( $options['offset'] ) ) $args['offset'] = intval( $options['offset'] );

		return $args;
	}
}

/**
 * Get posts per page for grid of posts.
 *
 * @since 2.0.0
 *
 * @param string $type Type of grid, template or builder
 * @param string $columns Number of columns to use
 * @param string $columns Number of rows to use
 * @return int $posts_per_page The number of posts per page for a grid.
 */

if( ! function_exists( 'themeblvd_posts_page_page' ) ) {
	function themeblvd_posts_page_page( $type, $columns = null, $rows = null ) {
		if( $type == 'template' ) {
			global $post;
			$possible_column_nums = array( 1, 2, 3, 4, 5 );
			$posts_per_page = null;
			// Columns
			$columns = get_post_meta( $post->ID, 'columns', true );
			if( ! in_array( intval($columns), $possible_column_nums ) )
				$columns = apply_filters( 'themeblvd_default_grid_columns', 3 );
			// Rows
			$rows = get_post_meta( $post->ID, 'rows', true );
			if( ! $rows )
				$rows = apply_filters( 'themeblvd_default_grid_columns', 4 );
		}
		// Posts per page
		$posts_per_page = $columns * $rows;
		return $posts_per_page;
	}
}

/**
 * Get the class to be used for a grid column.
 *
 * @since 2.0.0
 *
 * @param int $columns Number of columns
 * @return string $class class for each column of grid
 */

if( ! function_exists( 'themeblvd_grid_class' ) ) {
	function themeblvd_grid_class( $columns ) {
		$class = 'grid_3'; // default
		if( $columns == 1 )
			$class = 'grid_12';
		else if( $columns == 2 )
			$class = 'grid_6';
		else if( $columns == 3 )
			$class = 'grid_4';
		else if( $columns == 4 )
			$class = 'grid_3';
		else if( $columns == 5 )
			$class = 'grid_fifth_1';
		return $class;
	}
}

/**
 * Open a row in a post grid
 *
 * @since 2.0.0
 */

if( ! function_exists( 'themeblvd_open_row' ) ) {
	function themeblvd_open_row() {
		echo apply_filters( 'themeblvd_open_row', '<div class="grid-row">' );
	}
}

/**
 * Close a row in a post grid
 *
 * @since 2.0.0
 */

if( ! function_exists( 'themeblvd_close_row' ) ) {
	function themeblvd_close_row() {
		echo apply_filters( 'themeblvd_close_row', '<div class="clear"></div></div><!-- .grid-row (end) -->' );
	}
}

/**
 * Add wrapper around embedded videos to allow for respnsive videos.
 *
 * @since 2.0.0
 */

if( ! function_exists( 'themeblvd_oembed_result' ) ) {
	function themeblvd_oembed_result( $input, $url ) {
		
		// Since the framework applies this filter in two 
		// spots, we must first check if the filter has 
		// been applied or not. The reason for this is 
		// because WP has issues with caching the oembed 
		// result, and oembed_result doesn't always get 
		// applied when it's supposed to.
		$filter_applied = strpos( $input, 'themeblvd' );
		if( $filter_applied ) return $input;
		
		// Media Type (will use in future if we add audio player)
		// $mp3 = strpos( $url, '.mp3' );
		// $mp3 ? $media = 'audio' : $media = 'video';
		$media = 'video'; // Temporary while video is only media type.
		
		// Apply YouTube wmode fix
		if( strpos( $url, 'youtube' ) || strpos( $url, 'youtu.be' ) ) {
			if( ! strpos( $input, 'wmode=transparent' ) )
				$input = str_replace('feature=oembed', 'feature=oembed&wmode=transparent', $input);
		}
		
		// Wrap output
		$output  = '<div class="themeblvd-'.$media.'-wrapper">';
		$output .= '<div class="'.$media.'-inner">';
		$output .= $input;
		$output .= '</div><!-- .video-inner (end) -->';
		$output .= '</div><!-- .themeblvd-video-wrapper (end) -->';
		
		return $output;
	}
}

/**
 * Filter Tweets
 * 
 * Special thanks to Allen Shaw & webmancers.com & Michael Voigt
 * The only mods from Allen and Michael I made are changing the 
 * links to open in new windows.
 *
 * @since 2.1.0
 *
 * @param string $text Tweet to filter
 * @return string $text Filtered tweet 
 */

if( ! function_exists( 'themeblvd_tweet_filter_default' ) ) {
	function themeblvd_tweet_filter_default( $text, $username ) {
		
		// Remove "UserName: " from Twitter API RSS on start of every tweet
		$text = str_ireplace( $username.': ', '', $text );
		
		// Format URL's to be links - http://whatever.com
		$text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\" target=\"_blank\">$1</a>", $text);
		
		// Format URL's to be links - http://www.whatever.com
		$text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\" target=\"_blank\">$1</a>", $text);    
		
		// Format emails - you@yourmail.com
		$text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
		
		// Format hash tags as links - #whatever
		$text = preg_replace("/#(\w+)/", "<a class=\"twitter-link\" href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $text);
		
		// Format @username as links
		$text = preg_replace("/@(\w+)/", "<a class=\"twitter-link\" href=\"http://twitter.com/\\1\" target=\"_blank\">@\\1</a>", $text);
	    
	    return $text;
	}
}

/**
 * This adjusts WordPress's transient lifetime for fetch_feed() 
 * from 12 hours to 2 hours. This was primarily implemented to 
 * work with the framework's retrieval of Twitter feeds. 
 *
 * This function is used to filter: wp_feed_cache_transient_lifetime
 *
 * @since 2.1.0
 */

if( ! function_exists( 'themeblvd_feed_transient' ) ) {
	function themeblvd_feed_transient( $seconds ) {
		// Change the default feed cache recreation period to 2 hours
		return 7200;
	}
}

/**
 * Get the Twitter RSS URL
 *
 * @since 2.1.0
 */

if( ! function_exists( 'themeblvd_get_twitter_rss_url' ) ) {
	function themeblvd_get_twitter_rss_url( $username ) {
		
		// Non API version, but tweets expire eventually. Can safely use this 
		// without transients working on server, because Twitter never cuts 
		// you off with this one.
		// $url = 'http://search.twitter.com/search.atom?q=from:'.$username;
		
		// Use API, tweets never expire, but transients must work properly 
		// on server. Sometimes there's issues with transients when using 
		// W3 Total Cache.
		$url = 'http://api.twitter.com/1/statuses/user_timeline.rss?screen_name='.$username; 
		
		// Return with filter applied so it's possible to change your 
		// RSS method from a Child theme or plugin.
		return apply_filters( 'themeblvd_twitter_rss', $url, $username );
	}
}

/**
 * Display Analytics code.
 *
 * @since 2.0.0 
 */
 
if( ! function_exists( 'themeblvd_analytics' ) ) {
	function themeblvd_analytics() {
		$analytics = themeblvd_get_option( 'analytics' );
		if( $analytics )
			echo $analytics;
	}
}

/**
 * Determine color of text depending on background color.
 * 
 * Huge thank you to Oscar for providing this:
 * http://stackoverflow.com/questions/3015116/hex-code-brightness-php
 *
 * @since 2.0.0
 *
 * @param string $bg_color Background color to determine text color for, ex: #ffffff
 * @return string $text_color Text color to show on inputed background color
 */
 
if( ! function_exists( 'themeblvd_text_color' ) ) {
	function themeblvd_text_color( $bg_color ) {
		
		// Pop off '#' from start.
		$bg_color = explode( '#', $bg_color );
		$bg_color = $bg_color[1];
		
		// Break up the color in its RGB components
		$r = hexdec( substr( $bg_color,0,2 ) );
		$g = hexdec( substr( $bg_color,2,2 ) );
		$b = hexdec( substr( $bg_color,4,2 ) );
		
		// Simple weighted average
		if( $r + $g + $b > 382 )
		    $text_color = apply_filters( 'themeblvd_dark_font', '#333333' ); // bright color, use dark font
		else
		    $text_color = apply_filters( 'themeblvd_light_font', '#ffffff' );; // dark color, use bright font
		
		return $text_color;
	}
}

/**
 * Darken or Lighten a hex color
 * 
 * Huge thank you to Jonas John for providing this:
 * http://www.jonasjohn.de/snippets/php/darker-color.htm
 *
 * @since 2.0.5
 *
 * @param string $color Hex color to adjust
 * @param string $difference Amount to adjust color
 * @param string $direction 'lighten' or 'darken'
 * @return string $new_color Adjusted color
 */

if( ! function_exists( 'themeblvd_adjust_color' ) ) {
	function themeblvd_adjust_color( $color, $difference = 20, $direction = 'darken' ) {
		
		// Pop off '#' from start.
		$color = explode( '#', $color );
		$color = $color[1];
		
		// Send back in black if it's not a properly 
		// formatted 6-digit hex
		if ( strlen( $color ) != 6 )
			return '#000000';
		
		// Build new color
		$new_color = '';
		for ( $x = 0; $x < 3; $x++ ) {
		    if( $direction == 'lighten' )
		    	$c = hexdec( substr( $color, ( 2*$x ), 2 ) ) + $difference;
		    else
				$c = hexdec( substr( $color, ( 2*$x ), 2 ) ) - $difference;
		    $c = ( $c < 0 ) ? 0 : dechex( $c );
		    $new_color .= ( strlen( $c ) < 2 ) ? '0'.$c : $c;
		}
		return '#'.$new_color;
	}	
}

/**
 * Get additional classes for elements.
 *
 * @since 2.0.3
 *
 * @param string $element Element to get classes for
 * @param boolean $start_space Whether there should be a space at start
 * @param boolean $end_space Whether there should be a space at end
 * @param string $type Type of element (only relevant if there is a filter added utilizing it)
 * @param array $options Options for element (only relevant if there is a filter added utilizing it)
 * @return array $classes Classes for element.
 */
 
if( ! function_exists( 'themeblvd_get_classes' ) ) {
	function themeblvd_get_classes( $element, $start_space = false, $end_space = false, $type = null, $options = array() ) {
		$classes = '';
		$all_classes = array(
			'element_columns' 				=> '',
			'element_content' 				=> '',
			'element_divider' 				=> '',
			'element_headline' 				=> '',
			'element_post_grid_paginated' 	=> '',
			'element_post_grid' 			=> '',
			'element_post_grid_slider' 		=> '',
			'element_post_list_paginated' 	=> '',
			'element_post_list' 			=> '',
			'element_post_list_slider' 		=> '',
			'element_slider' 				=> '',
			'element_slogan' 				=> '',
			'element_tabs' 					=> '',
			'element_tweet' 				=> '',
			'slider_standard'				=> '',
			'slider_carrousel'				=> '',
		);
		$all_classes = apply_filters( 'themeblvd_element_classes', $all_classes, $type, $options );
		if( isset( $all_classes[$element] ) && $all_classes[$element] ) {
			if( $start_space ) $classes .= ' ';
			$classes .= $all_classes[$element];
			if( $end_space ) $classes .= ' ';
		}
		return $classes;
	}
}

/**
 * Get the class to be used for resposive visibility.
 * 
 * hide_on_standard
 * hide_on_standard_and_tablet
 * hide_on_standard_and_tablet_and_mobile
 * hide_on_standard_and_mobile
 * hide_on_tablet
 * hide_on_tablet_and_mobile
 * hide_on_mobile
 *
 * @since 2.1.0 
 *
 * @param array $devices Devices to be hidden on
 * @param boolean $start_space Whether there should be a space at start
 * @param boolean $end_space Whether there should be a space at end
 * @return var $class CSS class to use
 */
 
if( ! function_exists( 'themeblvd_responsive_visibility_class' ) ) {
	function themeblvd_responsive_visibility_class( $devices, $start_space = false, $end_space = false ) {
		// Build class
		$class = '';
		if( is_array( $devices ) && $devices ) {
			$class = 'hide_on_';
			if( $devices['hide_on_standard'] ) {
				// Standard Devices
				$class .= 'standard';
				if( $devices['hide_on_tablet'] )
					$class .= '_and_tablet';
				if( $devices['hide_on_mobile'] )
					$class .= '_and_mobile';
			} else if( $devices['hide_on_tablet'] ) {
				// Tablets
				$class .= 'tablet';
				if( $devices['hide_on_mobile'] )
					$class .= '_and_mobile';
			} else if( $devices['hide_on_mobile'] ) {
				// Mobile
				$class .= 'mobile';
			}
		}
		// Apply filter
		$class = apply_filters( 'themeblvd_responsive_visibility_class', $class, $devices );
		// Start/End spaces
		if( $class ) {
			if( $start_space )
				$class = ' '.$class;
			if( $end_space )
				$class .= ' ';
		}
		// Return class
		return $class;
	}
}