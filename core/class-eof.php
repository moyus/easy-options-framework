<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if( !class_exists('EOF') ) :

/**
 * EOF Class
 *
 * The main class
 * 
 * @package EOF
 * @since 1.0.0
 */
class EOF {

	// Hold setting configures
	var $configs = array();

	// Hold setting fields
	var $sections = array();

	// Hold options
	var $options = array();

	// Hold default options
	var $default_options = array();

	// Hold null value options
	var $null_options = array();

	// Hold admin object
	var $eof_admin;

	// Hold settings object
	var $eof_settings;

	// Hold admin setting views object
	var $eof_views;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin configures that can be used throughout the plugin.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $configs = array(), $sections = array() ) {

		$this->configs = wp_parse_args( $configs, $this->get_default_configs() );

		$this->eof_admin = new EOF_Admin($this);

		if($this->configs['show_import_export']) {
			$this->eof_port = new EOF_Import_Export($this);
		}
		
		$this->sections = $this->array_sort( 
			apply_filters( 'eof_sections', $sections ), 
			'priority', 
			SORT_ASC 
		);

		$this->eof_settings = new EOF_Settings($this);
		$this->eof_views = new EOF_Views($this);
		$this->set_global_variable();

	}

	/**
	 * Reload options from database
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function refresh() {

		$default_options = array();
		$null_options = array();

		foreach ($this->sections as $section) {
			if(isset($section['fields']) && !empty($section['fields'])) {
				foreach ($section['fields'] as $key => $field) {
					$default_options[$key] = isset($field['default']) ? $field['default'] : null;
					$null_options[$key] = null;
				}
			}
		}

		$this->default_options = $default_options;
		$this->null_options = $null_options;
		$this->options = wp_parse_args( get_option( $this->configs['opt_name'] ), $null_options );
	}
	/**
	 * Get default option configs
	 *
	 * @since  1.0.0
	 * @return array
	 */
	function get_default_configs() {

		$default = array(
			// This is where your data is stored in the database and also becomes your global variable name.
			'opt_name' 			=> 'eof_options',
			// Set a different name for your global variable other than the opt_name
			'global_variable'   => 'eof_options',
			// Specify if the admin menu should appear or not. Options: menu or submenu
			'menu_type' 		=> 'menu',
			// Show the sections below the admin menu item or not
			'allow_sub_menu'	=> false,
			// Specify admin menu title
			'menu_title' 		=> __('EOF', 'eof'),
			// Specify admin page title
			'page_title' 		=> __('EOF', 'eof'),
			// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
			'page_parent'       => 'themes.php',
			// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
			'menu_priority'     => 55,
			// Specify a custom URL to an icon
			'menu_icon'         => 'dashicons-carrot',
			// Order where the menu divider appears in the admin area. array(35,37)
			'menu_divider'		=> null,
			// Permissions needed to access the options panel.
			'page_permissions'  => 'manage_options',
			// Page slug used to denote the panel
			'page_slug'         => '_eof_options',
			// On load save the defaults to DB before user clicks save or not
			'save_defaults'		=> false,
			// Shows the Import/Export panel when not used as a field.
			'show_import_export'   => true,
			// Specify option page help tabs. array( array('id' => '', 'title' => '', 'content' => ''), )
			'help_tabs' => null,
			// Specify option page help sidebar content
			'help_sidebar' => ''
		);

		return $default;
	}

	/**
	 * Set a global variable by the global_variable argument
	 *
	 * @since 1.0
	 * @return void
	 */
	function set_global_variable() {

		$this->refresh();

		$GLOBALS[$this->configs['opt_name']] = (array) $this->options;

		if(isset($this->configs['global_variable']) && !empty($this->configs['global_variable'])) {
			$GLOBALS[$this->configs['global_variable']] = $GLOBALS[$this->configs['opt_name']];
		}

	}

	/**
	 * Sort an array by a specific key. 
	 * Maintains index association.
	 * 
	 * @param  array $array 	array which need be sort
	 * @param  array $on    	specific key
	 * @param  constant $order 	order type
	 * @return array       		sortable array
	 */
	function array_sort( $array, $on, $order = SORT_ASC ) {
		$new_array = array();
	    $sortable_array = array();
	    $null_count = 1001;
	    if (count($array) > 0) {
	        foreach ($array as $k => $v) {
	            if (is_array($v)) {
	            	$found = false;
	                foreach ($v as $k2 => $v2) {
	                    if ($k2 == $on) {
	                        $sortable_array[$k] = $v2;
	                        $found = true;
	                        break;
	                    }
	                }
	                if( !$found ) {
	                	$sortable_array[$k] = $null_count;
	                	$null_count += 1;
	                }
	            } else {
	                $sortable_array[$k] = $v;
	            }
	            
	        }
	        
	        switch ($order) {
	            case SORT_ASC:
	                asort($sortable_array);
	            	break;
	            case SORT_DESC:
	                arsort($sortable_array);
	            	break;
	        }

	        foreach ($sortable_array as $k => $v) {
	            $new_array[$k] = $array[$k];
	        }
	    }
	    
	    return $new_array;
	}

}

endif;