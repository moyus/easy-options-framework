<?php  
/**
 * EOF Email Field Class
 *
 * All the logic for this field type
 *
 * @class       EOF_field_email
 * @extends     EOF_field
 * @package     EOF
 * @subpackages Fields
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists('EOF_field_email') ) :

class EOF_field_email extends EOF_field {

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
			'default' 		=> '',
			'holder'		=> '',
			'sizes'			=> 'regular',
			'readonly'		=> false,
		) );

		// If value does not set, use the default
		if( is_null($this->value) ) {
			$this->value = $this->field['default'];
		}

		parent::__construct($this->field);
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
		$class = 'regular-text';
	?>
		<input type="email" class="<?php echo esc_attr($class); ?>" name="<?php echo esc_attr($this->option_name); ?>" id="<?php echo esc_attr($this->option_id); ?>" placeholder="<?php echo esc_attr($this->field['holder']); ?>" value="<?php echo esc_attr( sanitize_email($this->value) ); ?>">
		<span class="description"><?php echo $this->field['desc']; ?></span>
	<?php
	}

	public function sanitize( $input ) {

		$sanitize_input = sanitize_email( $input );

		return $sanitize_input;
	}

}

endif;

?>