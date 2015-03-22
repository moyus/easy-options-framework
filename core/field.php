<?php  
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists('EOF_field') ) :
/**
 * EOF_field class
 * 
 * Default setting field class
 * 
 * @package EOF
 * @since 1.0.0
 */
class EOF_field {

	/**
	 * __construct
	 *
	 * This function will setup the field type data
	 *
	 * @since  1.0.0
	 * @param array $field
	 * @return void
	 */
	public function __construct( $field = array() ) {
		add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
		add_filter('eof_settings_sanitize_' . $field['option_name'], array($this, 'sanitize') );
	}

	/**
	 * Enqueue scripts
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public static function admin_enqueue_scripts() {
		
	}

	/**
	 * Default field value sanitize
	 *
	 * @since  1.0.0
	 * @param  string $value - value to filter
	 * @return string        - filtered value
	 */
	public function sanitize( $value ) {
		
		return $value;
	}

	/**
	 * Beautify ID, replace '[',']' with '_'
	 *
	 * @since  1.0.0
	 * @param  string $id - value to filter
	 * @return string     - filtered id
	 */
	public function beautifyid( $id ) {

		$new_id = str_replace('[]', '_', $id);
		$new_id = str_replace('][', '_', $new_id);
		$new_id = str_replace('[', '_', $new_id);
		$new_id = str_replace(']', '_', $new_id);
		if(substr($new_id, -1) == '_') {
			$new_id = substr($new_id, 0, -1);
		}
		return $new_id;
	}

}
endif;
?>