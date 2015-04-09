<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * EOF_Loader Class
 *
 * Load the dependencies, define the locale, 
 * and set the hooks for the admin area
 * 
 * @package EOF
 * @since 1.0.0
 */
if( !class_exists('EOF_Loader') ) :

	class EOF_Loader {

		/**
	 	 * Run the loader to execute all of the hooks with WordPress.
	 	 * Load the dependencies, define the locale, and set the hooks for the admin area
	 	 * 
	 	 * @since 1.0.0
	 	 * @return void
	 	 */
		public function run() {

			add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts') );
			add_filter( 'plugin_row_meta', array($this, 'donate_link'), 10, 2 );
			$this->i18n();
			$this->require_files();
		}

		/**
		 * Loads the core framework files
		 * 
		 * @since  1.0.0
		 * @return void
		 */
		function require_files() {
			require EOF_DIR . 'core/class-eof-admin.php';
			require EOF_DIR . 'core/class-eof-views.php';
			require EOF_DIR . 'core/class-eof-settings.php';
			require EOF_DIR . 'core/class-eof-import-export.php';
			require EOF_DIR . 'core/class-eof.php';
		}

		/**
		 * Enqueue the core framework scripts
		 *
		 * @since  1.0.0
		 * @return void
		 */
		function enqueue_scripts() {
			wp_enqueue_script('jquery');
			wp_enqueue_style( 'jquery-ui' );
			wp_enqueue_style('eof-style', EOF_URL . 'css/eof-style.css' );
			wp_enqueue_script('eof_custom_js', EOF_URL . 'js/eof-custom.js', array( 'jquery', 'wp-color-picker' ), '', true );
		}

		/**
		 * Load the framework translation file.
		 *
		 * @since  1.0.0
		 * @return void
		 */
		function i18n() {
			// set text domain
			load_textdomain( 'eof', EOF_DIR . 'languages/eof-' . get_locale() . '.mo' );
		}

		/**
		 * Add donate link to plugin description in /wp-admin/plugins.php
		 *
		 * @since  1.0.0
		 * @param  array $plugin_meta
		 * @param  string $plugin_file
		 * @return array
		 */
		function donate_link( $plugin_meta, $plugin_file ) {
			
			if ( strpos( $plugin_file, 'eof.php' ) !== false ) {
				$plugin_meta[] = sprintf(
					'<a href="%s" target="_blank">%s</a>',
					'https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=mr%2emoyus%40gmail%2ecom&lc=US&item_name=20Theme&no_note=0&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHostedGuest',
					__( 'Donate', 'eof' )
				);
			}
			return $plugin_meta;
		}

	}

	$loader = new EOF_Loader();
	$loader->run();
endif;