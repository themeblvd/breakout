<?php
/*-----------------------------------------------------------------------------------*/
/* Run Theme Options - Based on Devin Price's Theme Options framework
/*-----------------------------------------------------------------------------------*/

/**
 * We check the user-role before actually adding the admin page the 
 * user sees, however we run the rest of the options framework in 
 * the background just in case its needed for other admin modules.
 */

function optionsframework_rolescheck () {
	if ( themeblvd_supports( 'admin', 'options' ) && current_user_can( themeblvd_admin_module_cap( 'options' ) ) ) {
		add_action( 'admin_menu', 'optionsframework_add_page');
	}
	add_action( 'admin_init', 'optionsframework_init' );
	add_action( 'admin_init', 'optionsframework_mlu_init' );
}
add_action('init', 'optionsframework_rolescheck' );

/**
 * Creates the settings in the database by looping through the array
 * we supplied in options.php.  This is a neat way to do it since
 * we won't have to save settings for headers, descriptions, or arguments.
 *
 * Read more about the Settings API in the WordPress codex:
 * http://codex.wordpress.org/Settings_API
 *
 */

if( ! function_exists( 'optionsframework_init' ) ) {
	function optionsframework_init() {
	
		// Include the required files
		// EDIT: Included in themeblvd.php as of v2.1.0
		// require_once dirname( __FILE__ ) . '/options-interface.php';
		// require_once dirname( __FILE__ ) . '/options-medialibrary-uploader.php';
		
		// Get current settings	
		$optionsframework_settings = get_option('optionsframework' );
		
		// Updates the unique option id in the database if it has changed
		optionsframework_option_name();
		
		// Gets the unique id, returning a default if it isn't defined
		if ( isset($optionsframework_settings['id']) ) {
			$option_name = $optionsframework_settings['id'];
		}
		else {
			$option_name = 'optionsframework';
		}
		
		// If the option has no saved data, load the defaults
		if ( ! get_option($option_name) ) {
			optionsframework_setdefaults();
		}
	
		// Registers the settings fields and callback
		register_setting( 'optionsframework', $option_name, 'optionsframework_validate' );
	}
}

/**
 * Adds default options to the database if they aren't already present.
 * May update this later to load only on plugin activation, or theme
 * activation since most people won't be editing the options.php
 * on a regular basis.
 *
 * http://codex.wordpress.org/Function_Reference/add_option
 *
 */

if( ! function_exists( 'optionsframework_setdefaults' ) ) {
	function optionsframework_setdefaults() {
	
		$optionsframework_settings = get_option('optionsframework');
	
		// Gets the unique option id
		$option_name = $optionsframework_settings['id'];
		
		/* 
		 * Each theme will hopefully have a unique id, and all of its options saved
		 * as a separate option set.  We need to track all of these option sets so
		 * it can be easily deleted if someone wishes to remove the plugin and
		 * its associated data.  No need to clutter the database.  
		 *
		 */
		
		if ( isset($optionsframework_settings['knownoptions']) ) {
			$knownoptions =  $optionsframework_settings['knownoptions'];
			if ( !in_array($option_name, $knownoptions) ) {
				array_push( $knownoptions, $option_name );
				$optionsframework_settings['knownoptions'] = $knownoptions;
				update_option('optionsframework', $optionsframework_settings);
			}
		} else {
			$newoptionname = array($option_name);
			$optionsframework_settings['knownoptions'] = $newoptionname;
			update_option('optionsframework', $optionsframework_settings);
		}
	
		// Gets the default options data from the array in options.php
		$options = themeblvd_get_formatted_options();
		
		// If the options haven't been added to the database yet, they are added now
		$values = of_get_default_values();
		
		if ( isset($values) ) {
			add_option( $option_name, $values ); // Add option with default settings
		}
	}
}

/** 
 * Add a subpage called "Theme Options" to the appearance menu. 
 */

if ( ! function_exists( 'optionsframework_add_page' ) ) {
	function optionsframework_add_page() {
	
		$title = __( 'Theme Options', TB_GETTEXT_DOMAIN );
		$of_page = add_theme_page( $title, $title, themeblvd_admin_module_cap( 'options' ), 'options-framework', 'optionsframework_page' );
		
		// Adds actions to hook in the required css and javascript
		add_action("admin_print_styles-$of_page",'optionsframework_load_styles');
		add_action("admin_print_scripts-$of_page", 'optionsframework_load_scripts');
		
	}
}

/** 
 * Loads the CSS 
 */

if( ! function_exists( 'optionsframework_load_styles' ) ) {
	function optionsframework_load_styles() {
		wp_enqueue_style('admin-style', OPTIONS_FRAMEWORK_DIRECTORY.'css/admin-style.css');
		wp_enqueue_style('sharedframework-style', THEMEBLVD_ADMIN_ASSETS_DIRECTORY . 'css/admin-style.css');
		wp_enqueue_style('color-picker', OPTIONS_FRAMEWORK_DIRECTORY.'css/colorpicker.css');
	}
}
	

/**
 * Loads the javascript
 */

if( ! function_exists( 'optionsframework_load_scripts' ) ) {
	function optionsframework_load_scripts() {
		
		// Enqueued scripts
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('sharedframework-scripts', THEMEBLVD_ADMIN_ASSETS_DIRECTORY . 'js/shared.min.js', array('jquery'));
		wp_enqueue_script('color-picker', OPTIONS_FRAMEWORK_DIRECTORY.'js/colorpicker.js', array('jquery'));
		wp_enqueue_script('options-custom', OPTIONS_FRAMEWORK_DIRECTORY.'js/options-custom.js', array('jquery'));
	}
}

/* 
 * Builds out the options panel.
 *
 * If we were using the Settings API as it was likely intended we would use
 * do_settings_sections here.  But as we don't want the settings wrapped in a table,
 * we'll call our own custom optionsframework_fields.  See options-interface.php
 * for specifics on how each individual field is generated.
 *
 * Nonces are provided using the settings_fields()
 *
 */

if ( ! function_exists( 'optionsframework_page' ) ) {
	function optionsframework_page() {
		
		$optionsframework_settings = get_option('optionsframework');
		
		// Gets the unique option id
		if (isset($optionsframework_settings['id']))
			$option_name = $optionsframework_settings['id'];
		else
			$option_name = 'optionsframework';
			
		$settings = get_option($option_name);
	    $options = themeblvd_get_formatted_options();
		$return = optionsframework_fields( $option_name, $options, $settings  );
		settings_errors();
		?>
	    
		<div class="wrap">
			<div class="admin-module-header">
				<?php do_action( 'themeblvd_admin_module_header', 'options' ); ?>
			</div>
		    <?php screen_icon( 'themes' ); ?>
		    <h2 class="nav-tab-wrapper">
		        <?php echo $return[1]; ?>
		    </h2>
		    
		    <div class="metabox-holder">
		    <div id="optionsframework">
				<form action="options.php" method="post">
					<?php settings_fields('optionsframework'); ?>
			
					<?php echo $return[0]; /* Settings */ ?>
			        
			        <div id="optionsframework-submit">
						<input type="submit" class="button-primary" name="update" value="<?php esc_attr_e( 'Save Options', TB_GETTEXT_DOMAIN ); ?>" />
			            <input type="submit" class="reset-button button-secondary" name="reset" value="<?php esc_attr_e( 'Restore Defaults', TB_GETTEXT_DOMAIN ); ?>" onclick="return confirm( '<?php print esc_js( __( 'Click OK to reset. Any theme settings will be lost!', TB_GETTEXT_DOMAIN ) ); ?>' );" />
			            <div class="clear"></div>
					</div>
				</form>
				<div class="tb-footer-text">
					<?php do_action( 'themeblvd_options_footer_text' ); ?>
				</div><!-- .tb-footer-text (end) -->
			</div> <!-- / #container -->
			<div class="admin-module-footer">
				<?php do_action( 'themeblvd_admin_module_footer', 'options' ); ?>
			</div>
		</div>
	</div> <!-- / .wrap -->
	<?php
	}
}

/** 
 * Options footer text
 */

if ( ! function_exists( 'optionsframework_footer_text' ) ) {
	function optionsframework_footer_text() {
		// Theme info and text
		if( function_exists( 'wp_get_theme' ) ) {
			// Use wp_get_theme for WP 3.4+
			$theme_data = wp_get_theme( get_template() );
			$theme_title = $theme_data->get('Name');
			$theme_version = $theme_data->get('Version');
		} else {
			// Deprecated theme data retrieval
			$theme_data = get_theme_data( get_template_directory() . '/style.css' );
			$theme_title = $theme_data['Title'];
			$theme_version = $theme_data['Version'];
		}
		// Changelog
		$changelog = null;
		if ( defined( 'TB_THEME_ID' ) ) {
			$changelog .= ' ( <a href="'.apply_filters( 'themeblvd_changelog_link', 'http://themeblvd.com/changelog/?theme='.TB_THEME_ID.'&TB_iframe=1', TB_THEME_ID ).'" class="thickbox tb-update-log" onclick="return false;">';
			$changelog .= __( 'Changelog', TB_GETTEXT_DOMAIN );
			$changelog .= '</a> )';
		}
		// Output
		echo $theme_title.' <strong>'.$theme_version.'</strong> with Theme Blvd Framework <strong>'.TB_FRAMEWORK_VERSION.'</strong>';
		echo $changelog;
	}
}

/** 
 * Validate Options.
 *
 * This runs after the submit/reset button has been clicked and
 * validates the inputs.
 *
 * @uses $_POST['reset']
 * @uses $_POST['update']
 */

if ( ! function_exists( 'optionsframework_validate' ) ) {
	function optionsframework_validate( $input ) {
	
		/*
		 * Restore Defaults.
		 *
		 * In the event that the user clicked the "Restore Defaults"
		 * button, the options defined in the theme's options.php
		 * file will be added to the option for the active theme.
		 */
		 
		if ( isset( $_POST['reset'] ) ) {
			add_settings_error( 'options-framework', 'restore_defaults', __( 'Default options restored.', TB_GETTEXT_DOMAIN ), 'updated fade' );
			return of_get_default_values();
		}
	
		/*
		 * Udpdate Settings.
		 */
		 
		if ( isset( $_POST['update'] ) ) {
			$clean = array();
			$options = themeblvd_get_formatted_options();
			foreach ( $options as $option ) {
	
				if ( ! isset( $option['id'] ) ) {
					continue;
				}
	
				if ( ! isset( $option['type'] ) ) {
					continue;
				}
	
				$id = preg_replace( '/\W/', '', strtolower( $option['id'] ) );
	
				// Set checkbox to false if it wasn't sent in the $_POST
				if ( 'checkbox' == $option['type'] && ! isset( $input[$id] ) ) {
					$input[$id] = '0';
				}
	
				// Set each item in the multicheck to false if it wasn't sent in the $_POST
				if ( 'multicheck' == $option['type'] && ! isset( $input[$id] ) ) {
					foreach ( $option['options'] as $key => $value ) {
						$input[$id][$key] = '0';
					}
				}
	
				// For a value to be submitted to database it must pass through a sanitization filter
				if ( has_filter( 'of_sanitize_' . $option['type'] ) ) {
					$clean[$id] = apply_filters( 'of_sanitize_' . $option['type'], $input[$id], $option );
				}
			}
	
			add_settings_error( 'options-framework', 'save_options', __( 'Options saved.', TB_GETTEXT_DOMAIN ), 'updated fade' );
			return $clean;
		}
	
		/*
		 * Request Not Recognized.
		 */
		
		return of_get_default_values();
	}
}

/**
 * Format Configuration Array.
 *
 * Get an array of all default values as set in
 * options.php. The 'id','std' and 'type' keys need
 * to be defined in the configuration array. In the
 * event that these keys are not present the option
 * will not be included in this function's output.
 *
 * @return array Rey-keyed options configuration array.
 *
 * @access private
 */

if ( ! function_exists( 'of_get_default_values' ) ) {
	function of_get_default_values() {
		$output = array();
		$config = themeblvd_get_formatted_options();
		foreach ( (array) $config as $option ) {
			if ( ! isset( $option['id'] ) ) {
				continue;
			}
			if ( ! isset( $option['std'] ) ) {
				continue;
			}
			if ( ! isset( $option['type'] ) ) {
				continue;
			}
			if ( has_filter( 'of_sanitize_' . $option['type'] ) ) {
				$output[$option['id']] = apply_filters( 'of_sanitize_' . $option['type'], $option['std'], $option );
			}
		}
		return $output;
	}
}

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

if( ! function_exists( 'optionsframework_option_name' ) ) {
	function optionsframework_option_name() {
	
		// This gets the theme name from the stylesheet (lowercase and without spaces)
		if( function_exists( 'wp_get_theme' ) ) {
			// Use wp_get_theme for WP 3.4+
			$theme_data = wp_get_theme( get_stylesheet() );
			$themename = preg_replace('/\W/', '', strtolower( $theme_data->get('Name') ) );
		} else {
			// Deprecated theme data retrieval
			$themename = get_theme_data( get_stylesheet_directory() . '/style.css');
			$themename = $themename['Name'];
			$themename = preg_replace('/\W/', '', strtolower( $themename ) );
		}
		
		// This is what ID the options will be saved under in the database. 
		// By default, it's generated from the current installed theme. 
		// So that means if you activate a child theme, you'll then need 
		// re-configure theme options.
		$themename = apply_filters( 'themeblvd_option_id', $themename );

		// Update option
		$optionsframework_settings = get_option('optionsframework');
		$optionsframework_settings['id'] = $themename;
		update_option('optionsframework', $optionsframework_settings);
	}
}