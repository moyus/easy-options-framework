<?php  

function eof_sample_setings_setup() {

	$sections = array();
	$configs = array();

	//General Section
	$sections['general'] = array(
		'title' 	=> 'General',
		'id'		=> 'general',
		'priority'	=> 1,
		'fields'	=> array(
			'eof_input_heading' => array(
				'id' => 'eof_input_heading',
				'type' => 'heading',
				'title' => 'Input',
				'desc' => 'you can set different sizes for input field type.'
			),
			'eof_small_text' => array(
				'type'	=> 'text',
				'title'	=> 'Small Text',
				'desc'	=> '',
				'default' 	=> '',
				'sizes'	=> 'small'
			),
			'eof_regular_text' => array(
				'type'	=> 'text',
				'title'	=> 'Regular Text',
				'desc'	=> '',
				'default' 	=> '',
				'sizes'	=> 'regular'
			),
			'eof_large' => array(
				'type'	=> 'text',
				'title'	=> 'Large Text',
				'desc'	=> '',
				'default' 	=> '',
				'sizes'	=> 'large'
			),
			'eof_number' => array(
				'type'	=> 'number',
				'title'	=> 'Number',
				'desc'	=> 'default value is 150.',
				'default' 	=> '150',
				'sizes'	=> 'regular'
			),
			'eof_email' => array(
				'type'	=> 'email',
				'title'	=> 'Email',
				'desc'	=> '',
				'default' 	=> '',
				'sizes'	=> 'regular'
			),
			'date_date' => array(
				'type'	=> 'date',
				'title'	=> 'Date',
				'desc'	=> '',
				'sizes'	=> 'regular'
			),
			'select' => array(
				'title' => 'Select',
				'type' => 'select',
				'holder' => 'Select your country',
				'options' => array(
					'china' => 'China',
					'usa'	=> 'America',
					'germany' => 'Germany'
				)
			),
			'eof_checkboxradio_heading' => array(
				'id' => 'eof_checkboxradio_heading',
				'type' => 'heading',
				'title' => 'Chekbox/Radio',
				'desc' => 'you can set different style for checkbox/radio field type.'
			),
			'eof_checkbox' => array(
				'title' => 'CheckBox',
				'desc'	=> '',
				'type' => 'checkbox',
				'default' => '1' //1 = on | 0 = off
			),
			'eof_multi_checkbox' => array(
				'title'	=> 'Multi Checkbox 1',
				'desc'	=> 'Multi Checkbox style 1',
				'type'	=> 'checkbox',
				'style'		=> 1,
				'options'	=> array(
					'girl'	=> 'Are you girl?',
					'under_25' => 'Are you under 25?',
					'venus'		=> 'You are my venus!'
				),
				'default' => array(
					'girl' => '1',
					'venus'	=> '1'
				)
			),
			'eof_multi_checkbox2' => array(
				'title'	=> 'Multi Checkbox 2',
				'desc'	=> 'Multi Checkbox style 2',
				'type'	=> 'checkbox',
				'style'		=> 2,
				'options'	=> array(
					'girl'	=> 'Are you girl?',
					'under_25' => 'Are you under 25?',
					'venus'		=> 'You are my venus!'
				),
				'default' => array(
					'girl' => '1',
					'venus'	=> '1'
				)
			),
			'eof_radio' => array(
				'title'	=> 'Radio 1',
				'desc'	=> 'Radio style 1',
				'type'	=> 'radio',
				'style'		=> 1,
				'options'	=> array(
					'blue'	=> 'Blue',
					'red' => 'Red',
					'green' => 'Green'
				),
				'default' => 'red'
			),
			'eof_radio_2' => array(
				'title'	=> 'Radio 2',
				'desc'	=> 'Radio style 2',
				'type'	=> 'radio',
				'style'		=> 2,
				'options'	=> array(
					'blue'	=> 'Blue',
					'red' => 'Red',
					'green' => 'Green'
				),
				'default' => 'red'
			),
			'eof_editor_heading' => array(
				'id'	=> 'eof_editor_heading',
				'type'	=> 'heading',
				'title'	=> 'More'
			),
			'eof_html' => array(
				'id'	=> 'eof_html',
				'type'	=> 'html',
				'title'	=> 'HTML',
				'content' => '<div style="width:99%; padding: 5px;" class="updated below-h2">Start to code!</div>'
			),
			'eof_textarea' => array(
				'id'	=> 'eof_textarea',
				'type'	=> 'textarea',
				'sizes'	=> 'large',
				'title'	=> 'Textarea',
				'desc'	=> 'this is the description.'
			),
			'eof_richEditor' => array(
				'id' => 'eof_richEditor',
				'type' => 'rich_editor',
				'title' => 'Rich Editor',
				'default' => 'Hello, World!',
				'sizes' => 15
			),
			
		)
	);

	//Advanced
	$sections['advanced'] = array(
		'title' 	=> 'Advanced',
		'id'		=> 'advanced',
		'priority'	=> 11,
		'fields'	=> array(
			'eof_color' => array(
				'type' => 'color',
				'title' => 'Color',
				'desc'	=> '',
				'default' => '#dd3333'
			),
			'eof_media' => array(
				'type' => 'media',
				'title' => 'Media',
				'desc'	=> '',
				'sizes'	=> '',
				'preview' => true,
			),
			'post_select' => array(
				'title' => 'Page Select',
				'type' => 'post_select',
				'holder' => 'Select Page',
				'desc'	=> 'you can set custom postype select!',
				'data'	=> array('post_type' => 'page') // WP_Query args
			),
			'layout' => array(
				'title'	=> 'Image Select',
				'desc'  => '',
				'type'	=> 'image_select',
				'options' => array(
					'left_sidebar' => array(
						'label'	=> 'Left Sidebar',
						'img_url'	=> 'http://fakeimg.pl/100x100/?text=Left'
					),
					'right_sidebar' => array(
						'label'	=> 'Right Sidebar',
						'img_url'	=> 'http://fakeimg.pl/100x100/?text=Right'
					)
				),
				'default' => 'left_sidebar'
			),
			'eof_repeatHeading' => array(
				'type'	=> 'heading',
				'title' => 'Repeat'
			),
			'eof_repeat' => array(
				'title' => 'Repeat',
				'type' => 'repeat',
				'style' => 'large',
				'sub_fields' => array(
					'name' => array(
						'title' => 'Name',
						'type' => 'text',
						'holder' => 'Your Name',
						'default' => 'Michael Jackson'
					),
					'country' => array(
						'title' => 'Country',
						'type' => 'select',
						'options' => array(
							'china' => 'China',
							'usa'	=> 'America',
							'germany' => 'Germany'
						)
					),
					'sex' => array(
						'title' => 'Sex',
						'desc' => '',
						'type' => 'radio',
						'options' => array(
							'boy' => 'Boy',
							'girl'	=> 'Girl',
							'alien' => 'Alien'
						)
					),
					'subscribe' => array(
						'title' => 'Subscribe',
						'desc' => 'Subscribe our site.',
						'type' => 'checkbox',
						'default' => '1'
					)
				)
			)
		)
	);

	//Url
	$sections['url'] = array(
		'title'	=> 'Url',
		'id'	=> 'url',
		'priority'	=> 26,
		'type'	=> 'url',
		'url'	=> 'http://www.20theme.com'
	);

	//Blank
	$sections['blank'] = array(
		'title'	=> 'Blank',
		'id'	=> 'blank',
		'type'	=> 'blank',
		'callback' => 'eof_sample_blank_callback',
		'priority'	=> 36,
	);

	//Donate
	$sections['donate'] = array(
		'title'	=> 'Donate',
		'id'	=> 'donate',
		'type'	=> 'blank',
		'callback' => 'eof_donate_callback',
		'priority'	=> 41,
	);

	$configs = array(
		// This is where your data is stored in the database and also becomes your global variable name.
		'opt_name' 			=> 'eof_sample_options',
		// Set a different name for your global variable other than the opt_name
		'global_variable'   => '',
		// Specify if the admin menu should appear or not. Options: menu or submenu
		'menu_type' 		=> 'menu',
		// Show the sections below the admin menu item or not
		'allow_sub_menu'	=> false,
		// Admin menu title
		'menu_title' 		=> 'EOF',
		// Page title of admin menu page 
		'page_title' 		=> 'EOF',
		// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
		// 'page_parent'       => 'themes.php',
		// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
		'menu_priority'     => 105,
		// Specify a custom URL to an icon
		'menu_icon'         => 'dashicons-carrot',
		// Order where the menu divider appears in the admin area.
		'menu_divider'		=> null,
		// Permissions needed to access the options panel.
		'page_permissions'  => 'manage_options',
		// Page slug used to denote the panel
		'page_slug'         => '_eof_sample_options',
		// Show the panel pages on the admin bar
		'admin_bar'         => false,
		// Choose an icon for the admin bar menu
		'admin_bar_icon'     => 'dashicons-portfolio',
		// On load save the defaults to DB before user clicks save or not
		'save_defaults'		=> false,
		// Shows the Import/Export panel when not used as a field.
		'show_import_export'   => true,
		// Specify option page help tabs. array( array('id' => '', 'title' => '', 'content' => ''), )
		'help_tabs'			=> array(
			array(
				'id' => 'help',
				'title' => 'Help',
				'content' => '<p>If you learn how to use this framework, you can check <code>sample-config.php</code> in this plugin folder.</p>'
			),
			array(
				'id' => 'about',
				'title' => 'About',
				'content' => '<p>A framework for building WordPress theme and plugin options.</p><p>f you like this plugin and find it useful, help keep this plugin free and actively developed by <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=mr%2emoyus%40gmail%2ecom&lc=US&item_name=20Theme&no_note=0&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHostedGuest">Making a donation.</a></p>'
			)
		),
		// Specify option page help sidebar content
		'help_sidebar'		=> '<p>This is help sidebar, it is so cool, right?</p>'
	);	
	
	if(class_exists('eof')) {
		$sample_settings_configs = new eof(
			$configs, 
			apply_filters( 'eof_sample_option_sections', $sections )
		);
	} 

}
add_action( 'init', 'eof_sample_setings_setup' );

function eof_sample_blank_callback() {
	?>
	<p>This is a blank page, you can display whatever you want!</p>
	<?php
}

?>