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

	}

	$loader = new EOF_Loader();
	$loader->run();
endif;
