<?php  
/**
 * EOF Color Picker Field Class
 *
 * All the logic for this field type
 *
 * @class       EOF_field_color
 * @extends     EOF_field
 * @package     EOF
 * @subpackages Fields
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists('EOF_field_color') ) :

class EOF_field_color extends EOF_field {

	/**
	 * __construct
	 *
	 * This function will setup the field type data
	 * 
	 * @since 1.0.0
	 * @return void
	 */
	public function __construct( $field, $value, $parent ) {
		//vars
		$this->parent = $parent;
		$this->option_name = $field['option_name'];
		$this->option_id   = parent::beautifyid($field['option_name']);

		$this->value = $value;
		$this->field = wp_parse_args( $field, array(
			'id'			=> '',
			'title'			=> '',
			'desc'			=> '',
			'default' 		=> '#ffffff',
			'readonly'		=> false,
		) );

		// If value does not set, use the default
		if( is_null($this->value) ) {
			$this->value = $this->field['default'];
		}

		parent::__construct($this->field);
	}

	/**
	 * Enqueue scripts
	 *
	 * Enqueue scripts and styles that field needed.
	 * This function will be called by it parent class 
	 * by default, so you don't need to add action again.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function admin_enqueue_scripts() {
		
		if( is_admin() ) {
			wp_enqueue_style( 'wp-color-picker' );
		}
	}

	/**
	 * Render field
	 *
	 * Create the HTML interface for your field
	 *
	 * @param $field - an array holding all the field's data
	 *
	 * @since 1.0
	 * @return void
	 */
	public function render_field() {

		//input type can also be set as 'color', seems fun.
	?>
		<input type="text" class="eof-color-picker" name="<?php echo esc_attr($this->option_name); ?>" id="<?php echo esc_attr($this->option_id); ?>" value="<?php echo esc_attr( $this->value ); ?>">
		<span class="description"><?php echo esc_js( $this->field['desc'] ); ?></span>
	<?php
	}

	public function sanitize( $input ) {

		$sanitize_input = strip_tags($input);
		if( !preg_match( '/^#[a-f0-9]{6}$/i', $sanitize_input ) ) {
			//add_settings_error( $setting, $code, $message, $type );
		}
		return $sanitize_input;
	}

}

endif;

?>