<?php  
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists('EOF_Admin') ) :
/**
 * EOF_Admin Class
 *
 * This class is for registering new admin page for settings
 * 
 * @package EOF
 * @since 1.0.0
 */
class EOF_Admin {

	var $options_page_id = '';

	public function __construct( $parent ) {
		$this->parent = $parent;
		add_action('admin_menu', array($this, 'eof_admin_menu'));
		add_filter('admin_footer_text', array($this, 'admin_rate_us'));
	}

	/**
	 * Add admin menu page
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function eof_admin_menu() {
		global $menu, $submenu;

		$menu_type = $this->parent->configs['menu_type'];
		$page_parent = $this->parent->configs['page_parent'];
		$optioins_page = '';
		// Themes should use add_theme_page() for adding admin pages
		if($menu_type == 'submenu' && isset($page_parent) && !empty($page_parent)) {
			$optioins_page = add_submenu_page( 
				$this->parent->configs['page_parent'], 
				$this->parent->configs['page_title'], 
				$this->parent->configs['menu_title'], 
				$this->parent->configs['page_permissions'], 
				$this->parent->configs['page_slug'],
				array($this, 'eof_options_page_callback') 
			);
		} else {
			$optioins_page = add_menu_page( 
				$this->parent->configs['page_title'], 
				$this->parent->configs['menu_title'], 
				$this->parent->configs['page_permissions'], 
				$this->parent->configs['page_slug'], 
				array($this, 'eof_options_page_callback') , 
				$this->parent->configs['menu_icon'], 
				$this->parent->configs['menu_priority'] 
			);
		}
		$this->parent->configs['options_page_id'] = $optioins_page;
		$this->options_page_id = $optioins_page;

		// Adds help_tab when optioins_page loads
    	add_action('load-'.$optioins_page, array($this, 'options_page_add_help_tab'));

    	// Add submenu if it is allowed.
    	if(isset($this->parent->configs['allow_sub_menu']) && $this->parent->configs['allow_sub_menu']) {
    		foreach ($this->parent->sections as $key => $section) {
    			// if submenu is under Posts menu
    			$parent_menu = $this->parent->configs['page_slug'];
    			$submenu[$parent_menu][] = array( 
    				$section['title'], 
    				$this->parent->configs['page_permissions'], 
    				add_query_arg('tab', $key, menu_page_url($this->parent->configs['page_slug'], false))
    			);
    		}
    	}

    	// Add menu dividers if there is set any.
    	if(isset($this->parent->configs['menu_divider'])) {
	    	foreach ($this->parent->configs['menu_divider'] as $position) {
	    		$menu[$position] = array(
	    			0	=>	'',
					1	=>	'read',
					2	=>	'separator' . $position,
					3	=>	'',
					4	=>	'wp-menu-separator'
	    		);
	    	}
    	}
	}

	/**
	 * Display options page
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function eof_options_page_callback() {
		$this->parent->eof_views->admin_options_page();
	}

	/**
	 * Add help tab to options page
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function options_page_add_help_tab() {

		if( empty( $this->parent->configs['help_tabs'] ) ) {
			return;
		}

		$screen = get_current_screen();
		// Add my_help_tab if current screen is My Admin Page
		foreach ($this->parent->configs['help_tabs'] as $tab) {
			$screen->add_help_tab( array(
		        'id'	=> $tab['id'],
		        'title'	=> $tab['title'],
		        'content'	=> $tab['content']
		    ) );
		}
	    
	    if( !empty( $this->parent->configs['help_sidebar'] ) ) {
			$screen->set_help_sidebar( $this->parent->configs['help_sidebar'] );
		}
	    
	}

	/**
	 * Add custom admin footer text
	 *
	 * @since  1.0.0
	 * @param  array $footer_text 
	 * @return array
	 */
	function admin_rate_us( $footer_text ) {

		$screen = get_current_screen();

		if($screen->id == $this->options_page_id) {
			$rate_text = sprintf( __( 'Thank you for using <a href="%1$s" target="_blank">Easy Options Framework</a>!', 'eof' ),
				'http://www.20theme.com/plugins/easy-options-framework'
			);
			return str_replace( '</span>', '', $footer_text ) . ' | ' . $rate_text . '</span>';
		} else {
			return $footer_text;
		}
	}
}

endif;
?>